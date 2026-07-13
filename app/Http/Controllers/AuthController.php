<?php

namespace App\Http\Controllers;

use App\Models\PrizeBond;
use App\Models\PrizeBondDraw;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Models\UserResultVerification;
use App\Support\MailConfigurator;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
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

    public function sitemap(): Response
    {
        $latestDraw = PrizeBondDraw::query()->max('updated_at');
        $latestModified = $latestDraw ? \Illuminate\Support\Carbon::parse($latestDraw)->toAtomString() : now()->toAtomString();

        $urls = [
            ['loc' => url('/'), 'lastmod' => $latestModified, 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => route('results.public'), 'lastmod' => $latestModified, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('help'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n"
                ."    <loc>".htmlspecialchars($u['loc'], ENT_XML1)."</loc>\n"
                ."    <lastmod>{$u['lastmod']}</lastmod>\n"
                ."    <changefreq>{$u['changefreq']}</changefreq>\n"
                ."    <priority>{$u['priority']}</priority>\n"
                ."  </url>\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function showLogin(): View
    {
        return view('auth.login', [
            'smtpActive' => SmtpSetting::isActive(),
        ]);
    }

    public function showRegister(): View
    {
        return view('auth.register', [
            'smtpActive' => SmtpSetting::isActive(),
        ]);
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

        $smtpActive = SmtpSetting::isActive();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
        ]);

        // Role is set outside mass assignment to prevent privilege escalation.
        $user->forceFill([
            'role' => 'user',
            'email_verified_at' => $smtpActive ? null : now(),
        ])->save();

        if ($smtpActive) {
            MailConfigurator::apply();
            try {
                $user->sendEmailVerificationNotification();
            } catch (\Throwable $e) {
                // If sending fails, still let them log in; they can resend from the notice page.
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($smtpActive) {
            return redirect()->route('verification.notice');
        }

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

    // ── Email verification ────────────────────────────────────────────────

    public function showVerifyNotice(Request $request): View|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-email', [
            'smtpActive' => SmtpSetting::isActive(),
        ]);
    }

    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('dashboard')->with('verified_message', 'Email verified successfully.');
    }

    public function resendVerification(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        if (! SmtpSetting::isActive()) {
            return back()->with('verify_error', 'Email delivery is not configured yet. Please contact the administrator.');
        }

        MailConfigurator::apply();

        try {
            $request->user()->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            return back()->with('verify_error', 'Failed to send verification email: '.$e->getMessage());
        }

        return back()->with('verify_message', 'Verification link sent to your email.');
    }

    // ── Password reset ────────────────────────────────────────────────────

    public function showForgotPassword(): View|RedirectResponse
    {
        if (! SmtpSetting::isActive()) {
            return redirect()->route('login')->withErrors(['login' => 'Password reset is not available yet.']);
        }

        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request): RedirectResponse
    {
        if (! SmtpSetting::isActive()) {
            return redirect()->route('login')->withErrors(['login' => 'Password reset is not available yet.']);
        }

        $request->validate(['email' => ['required', 'email']]);

        MailConfigurator::apply();

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, string $token): View|RedirectResponse
    {
        if (! SmtpSetting::isActive()) {
            return redirect()->route('login')->withErrors(['login' => 'Password reset is not available yet.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        if (! SmtpSetting::isActive()) {
            return redirect()->route('login')->withErrors(['login' => 'Password reset is not available yet.']);
        }

        $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password,
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
