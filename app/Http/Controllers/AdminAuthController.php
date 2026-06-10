<?php

namespace App\Http\Controllers;

use App\Models\PrizeBondDraw;
use App\Models\PrizeBondSeries;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => 'admin'], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function dashboard(): View
    {
        $stats = [
            'total_users' => User::query()->where('role', 'user')->count(),
            'total_blocks' => DB::table('prize_bond_blocks')->count(),
            'total_bonds' => DB::table('prize_bonds')->count(),
            'total_series' => PrizeBondSeries::query()->count(),
            'total_draws' => PrizeBondDraw::query()->count(),
            'valid_draws' => PrizeBondDraw::query()->where('is_valid', true)->count(),
        ];

        $recentDraws = PrizeBondDraw::query()
            ->with('series')
            ->latest('draw_date')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentDraws'));
    }

    public function series(): View
    {
        $series = PrizeBondSeries::query()->orderBy('name')->get();

        return view('admin.series', compact('series'));
    }

    public function users(): View
    {
        $users = User::query()
            ->where('role', 'user')
            ->withCount(['prizeBondBlocks', 'prizeBonds'])
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function results(): View
    {
        $draws = PrizeBondDraw::query()
            ->with(['series', 'winners'])
            ->latest('draw_date')
            ->paginate(10);

        return view('admin.results', compact('draws'));
    }

    public function storeSeries(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:prize_bond_series,name'],
        ]);

        PrizeBondSeries::create([
            'name' => strtoupper(trim($validated['name'])),
            'is_active' => true,
        ]);

        return redirect()->route('admin.series')->with('series_message', 'Series added.');
    }

    public function toggleSeries(PrizeBondSeries $series): RedirectResponse
    {
        $series->update([
            'is_active' => ! $series->is_active,
        ]);

        return redirect()->route('admin.series')->with('series_message', 'Series status updated.');
    }

    public function storeResult(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'draw_title' => ['required', 'string', 'max:255'],
            'draw_date' => ['required', 'date'],
            'first_prize_amount' => ['required', 'numeric', 'min:0'],
            'second_prize_amount' => ['required', 'numeric', 'min:0'],
            'third_prize_amount' => ['required', 'numeric', 'min:0'],
            'fourth_prize_amount' => ['required', 'numeric', 'min:0'],
            'fifth_prize_amount' => ['required', 'numeric', 'min:0'],
            'first_numbers' => ['required', 'string'],
            'second_numbers' => ['required', 'string'],
            'third_numbers' => ['required', 'string'],
            'fourth_numbers' => ['required', 'string'],
            'fifth_numbers' => ['required', 'string'],
        ]);

        $defaultSeriesId = PrizeBondSeries::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->value('id')
            ?? PrizeBondSeries::query()->orderBy('name')->value('id');

        if (! $defaultSeriesId) {
            return back()
                ->withInput()
                ->withErrors(['draw_title' => 'Please create at least one series before saving results.']);
        }

        $latestDraw = PrizeBondDraw::query()->latest('draw_date')->first();
        if ($latestDraw) {
            $minNextDate = $latestDraw->draw_date->copy()->addMonths(3);
            if (Carbon::parse($validated['draw_date'])->lt($minNextDate)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'draw_date' => 'Next draw should be at least 3 months after '.$latestDraw->draw_date->format('d M Y').'.',
                    ]);
            }
        }

        $first = $this->parsePrizeNumbers($validated['first_numbers']);
        $second = $this->parsePrizeNumbers($validated['second_numbers']);
        $third = $this->parsePrizeNumbers($validated['third_numbers']);
        $fourth = $this->parsePrizeNumbers($validated['fourth_numbers']);
        $fifth = $this->parsePrizeNumbers($validated['fifth_numbers']);

        $errors = [];
        if ($first->count() !== 1) {
            $errors['first_numbers'] = '1st prize must have exactly 1 number.';
        }
        if ($second->count() !== 1) {
            $errors['second_numbers'] = '2nd prize must have exactly 1 number.';
        }
        if ($third->count() !== 2) {
            $errors['third_numbers'] = '3rd prize must have exactly 2 numbers.';
        }
        if ($fourth->count() !== 2) {
            $errors['fourth_numbers'] = '4th prize must have exactly 2 numbers.';
        }
        if ($fifth->count() !== 40) {
            $errors['fifth_numbers'] = '5th prize must have exactly 40 numbers.';
        }

        $allNumbers = $first->concat($second)->concat($third)->concat($fourth)->concat($fifth);
        if ($allNumbers->unique()->count() !== $allNumbers->count()) {
            $errors['first_numbers'] = 'Winning numbers must be unique across all prize levels.';
        }

        if ($errors !== []) {
            return back()->withInput()->withErrors($errors);
        }

        DB::transaction(function () use ($validated, $first, $second, $third, $fourth, $fifth, $defaultSeriesId) {
            $draw = PrizeBondDraw::create([
                'prize_bond_series_id' => $defaultSeriesId,
                'draw_title' => $validated['draw_title'],
                'draw_date' => $validated['draw_date'],
                'first_prize_amount' => $validated['first_prize_amount'],
                'second_prize_amount' => $validated['second_prize_amount'],
                'third_prize_amount' => $validated['third_prize_amount'],
                'fourth_prize_amount' => $validated['fourth_prize_amount'],
                'fifth_prize_amount' => $validated['fifth_prize_amount'],
                'is_valid' => true,
            ]);

            foreach ($first as $number) {
                $draw->winners()->create(['prize_type' => 'first', 'bond_number' => $number]);
            }
            foreach ($second as $number) {
                $draw->winners()->create(['prize_type' => 'second', 'bond_number' => $number]);
            }
            foreach ($third as $number) {
                $draw->winners()->create(['prize_type' => 'third', 'bond_number' => $number]);
            }
            foreach ($fourth as $number) {
                $draw->winners()->create(['prize_type' => 'fourth', 'bond_number' => $number]);
            }
            foreach ($fifth as $number) {
                $draw->winners()->create(['prize_type' => 'fifth', 'bond_number' => $number]);
            }

            $this->syncValidDrawWindow();
        });

        return redirect()->route('admin.results')->with('result_message', 'Draw result added successfully.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    private function parsePrizeNumbers(string $input): Collection
    {
        return collect(preg_split('/[\s,]+/', strtoupper(trim($input))))
            ->filter()
            ->map(fn (string $number) => preg_replace('/[^A-Z0-9-]/', '', $number))
            ->filter();
    }

    private function syncValidDrawWindow(): void
    {
        PrizeBondDraw::query()->update(['is_valid' => false]);

        $lastEightIds = PrizeBondDraw::query()
            ->latest('draw_date')
            ->latest('id')
            ->limit(8)
            ->pluck('id');

        PrizeBondDraw::query()
            ->whereIn('id', $lastEightIds)
            ->update(['is_valid' => true]);
    }
}
