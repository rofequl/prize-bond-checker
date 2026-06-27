<?php

namespace App\Http\Controllers;

use App\Models\PrizeBond;
use App\Models\PrizeBondDraw;
use App\Models\User;
use App\Models\UserResultVerification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function home(): View
    {
        $latestResults = PrizeBondDraw::query()
            ->latest('draw_date')
            ->limit(8)
            ->get();

        $latestDraw = $latestResults->first();

        $stats = [
            'total_bonds' => PrizeBond::query()->count(),
            'total_matches' => UserResultVerification::query()->count(),
        ];

        return view('home', compact('latestResults', 'latestDraw', 'stats'));
    }

    public function publicResults(Request $request): View
    {
        $draws = PrizeBondDraw::query()
            ->with('winners')
            ->latest('draw_date')
            ->paginate(6)
            ->withQueryString();

        return view('public.results', compact('draws'));
    }

    public function help(): View
    {
        return view('public.help');
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password'], 'role' => 'user'], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
        ]);

        // Role is set outside mass assignment to prevent privilege escalation.
        $user->forceFill(['role' => 'user'])->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function dashboard(): View
    {
        return view('dashboard');
    }

    public function resultVerify(): View
    {
        return view('citizen.result-verify');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
