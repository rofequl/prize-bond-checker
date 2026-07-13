<?php

namespace App\Http\Controllers;

use App\Models\PrizeBondDraw;
use App\Models\PrizeBondSeries;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Support\MailConfigurator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            ->with('winners')
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
            'result_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

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

        $pdfPath = null;
        if ($request->hasFile('result_pdf')) {
            $file = $request->file('result_pdf');
            $filename = Str::slug($validated['draw_title']).'-'.now()->format('YmdHis').'.'.$file->getClientOriginalExtension();
            $pdfPath = $file->storeAs('results', $filename, 'public');
        }

        DB::transaction(function () use ($validated, $first, $second, $third, $fourth, $fifth, $pdfPath) {
            $draw = PrizeBondDraw::create([
                'draw_title' => $validated['draw_title'],
                'draw_date' => $validated['draw_date'],
                'first_prize_amount' => $validated['first_prize_amount'],
                'second_prize_amount' => $validated['second_prize_amount'],
                'third_prize_amount' => $validated['third_prize_amount'],
                'fourth_prize_amount' => $validated['fourth_prize_amount'],
                'fifth_prize_amount' => $validated['fifth_prize_amount'],
                'is_valid' => true,
                'result_pdf_path' => $pdfPath,
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

    public function editResult(PrizeBondDraw $draw): View
    {
        $draw->load('winners');

        $grouped = $draw->winners->groupBy('prize_type');

        $existing = [
            'first_numbers' => $grouped->get('first', collect())->pluck('bond_number')->join(', '),
            'second_numbers' => $grouped->get('second', collect())->pluck('bond_number')->join(', '),
            'third_numbers' => $grouped->get('third', collect())->pluck('bond_number')->join(', '),
            'fourth_numbers' => $grouped->get('fourth', collect())->pluck('bond_number')->join(', '),
            'fifth_numbers' => $grouped->get('fifth', collect())->pluck('bond_number')->join(', '),
        ];

        return view('admin.results-edit', compact('draw', 'existing'));
    }

    public function updateResult(Request $request, PrizeBondDraw $draw): RedirectResponse
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
            'result_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'remove_pdf' => ['nullable', 'boolean'],
        ]);

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

        $newPdfPath = $draw->result_pdf_path;
        $oldPdfPath = $draw->result_pdf_path;
        $deleteOldPdf = false;

        if ($request->boolean('remove_pdf') && $oldPdfPath) {
            $newPdfPath = null;
            $deleteOldPdf = true;
        }

        if ($request->hasFile('result_pdf')) {
            $file = $request->file('result_pdf');
            $filename = Str::slug($validated['draw_title']).'-'.now()->format('YmdHis').'.'.$file->getClientOriginalExtension();
            $newPdfPath = $file->storeAs('results', $filename, 'public');
            if ($oldPdfPath && $oldPdfPath !== $newPdfPath) {
                $deleteOldPdf = true;
            }
        }

        DB::transaction(function () use ($draw, $validated, $first, $second, $third, $fourth, $fifth, $newPdfPath) {
            $draw->update([
                'draw_title' => $validated['draw_title'],
                'draw_date' => $validated['draw_date'],
                'first_prize_amount' => $validated['first_prize_amount'],
                'second_prize_amount' => $validated['second_prize_amount'],
                'third_prize_amount' => $validated['third_prize_amount'],
                'fourth_prize_amount' => $validated['fourth_prize_amount'],
                'fifth_prize_amount' => $validated['fifth_prize_amount'],
                'result_pdf_path' => $newPdfPath,
            ]);

            $draw->winners()->delete();

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

        if ($deleteOldPdf && $oldPdfPath) {
            Storage::disk('public')->delete($oldPdfPath);
        }

        return redirect()->route('admin.results')->with('result_message', 'Draw result updated successfully.');
    }

    public function destroyResult(PrizeBondDraw $draw): RedirectResponse
    {
        $oldPdfPath = $draw->result_pdf_path;

        DB::transaction(function () use ($draw) {
            $draw->winners()->delete();
            $draw->delete();
            $this->syncValidDrawWindow();
        });

        if ($oldPdfPath) {
            Storage::disk('public')->delete($oldPdfPath);
        }

        return redirect()->route('admin.results')->with('result_message', 'Draw deleted.');
    }

    public function system(): View
    {
        $storageLinked = is_link(public_path('storage')) || is_dir(public_path('storage'));

        return view('admin.system', [
            'storageLinked' => $storageLinked,
        ]);
    }

    public function runStorageLink(): RedirectResponse
    {
        try {
            Artisan::call('storage:link');
            $output = trim(Artisan::output());

            return redirect()->route('admin.system')->with('system_message', $output !== '' ? $output : 'Storage link created.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.system')->with('system_error', 'Failed: '.$e->getMessage());
        }
    }

    public function runClearCache(): RedirectResponse
    {
        try {
            Artisan::call('optimize:clear');
            $output = trim(Artisan::output());

            return redirect()->route('admin.system')->with('system_message', $output !== '' ? $output : 'All caches cleared.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.system')->with('system_error', 'Failed: '.$e->getMessage());
        }
    }

    public function runMigrate(): RedirectResponse
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            $output = trim(Artisan::output());

            return redirect()->route('admin.system')->with('system_message', $output !== '' ? $output : 'Migrations ran.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.system')->with('system_error', 'Failed: '.$e->getMessage());
        }
    }

    public function smtp(): View
    {
        $setting = SmtpSetting::current();

        return view('admin.smtp', compact('setting'));
    }

    public function updateSmtp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'encryption' => ['nullable', 'in:tls,ssl'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'from_address' => ['required', 'email', 'max:255'],
            'from_name' => ['required', 'string', 'max:255'],
            'enabled' => ['nullable', 'boolean'],
        ]);

        $setting = SmtpSetting::current();

        $payload = [
            'host' => $validated['host'],
            'port' => (int) $validated['port'],
            'encryption' => $validated['encryption'] ?: null,
            'username' => $validated['username'] ?: null,
            'from_address' => $validated['from_address'],
            'from_name' => $validated['from_name'],
            'enabled' => $request->boolean('enabled'),
        ];

        if (filled($validated['password'] ?? null)) {
            $payload['password'] = $validated['password'];
        } elseif ($setting === null) {
            $payload['password'] = null;
        }

        if ($setting) {
            $setting->update($payload);
        } else {
            SmtpSetting::create($payload);
        }

        MailConfigurator::apply();

        return redirect()->route('admin.smtp')->with('smtp_message', 'SMTP settings saved.');
    }

    public function sendSmtpTest(Request $request): RedirectResponse
    {
        $request->validate([
            'recipient' => ['required', 'email'],
        ]);

        if (! SmtpSetting::isActive()) {
            return redirect()->route('admin.smtp')->with('smtp_error', 'Enable and save SMTP settings before sending a test.');
        }

        MailConfigurator::apply();

        try {
            Mail::raw(
                "This is a test email from Prize Bond Bangladesh.\n\nIf you received it, SMTP is configured correctly.",
                fn ($message) => $message->to($request->string('recipient'))->subject('SMTP test — Prize Bond Bangladesh')
            );
        } catch (\Throwable $e) {
            return redirect()->route('admin.smtp')->with('smtp_error', 'Failed to send test: '.$e->getMessage());
        }

        return redirect()->route('admin.smtp')->with('smtp_message', 'Test email dispatched to '.$request->string('recipient').'.');
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
