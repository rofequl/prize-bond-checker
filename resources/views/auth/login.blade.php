@extends('layouts.portal')

@section('title', 'Login | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="mx-auto w-full max-w-xl glass-card p-8 sm:p-10">
            <h1 class="text-3xl font-bold text-white">Citizen Login</h1>
            <p class="mt-2 text-sm text-slate-300">Login with phone or email and password.</p>

            <form method="POST" action="{{ route('login.attempt') }}" class="mt-8 space-y-4">
                @csrf

                <div>
                    <label for="login" class="mb-2 block text-sm text-slate-200">Phone / Email</label>
                    <input id="login" name="login" type="text" value="{{ old('login') }}" required
                           class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-3 text-white outline-none transition focus:border-emerald-400">
                    @error('login')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm text-slate-200">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-3 text-white outline-none transition focus:border-emerald-400">
                    @error('password')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-300">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-white/20 bg-slate-900">
                    Remember me
                </label>

                <button type="submit" class="w-full rounded-xl bg-emerald-400 px-4 py-3 font-semibold text-slate-950">
                    Login
                </button>
            </form>
        </div>
    </section>
@endsection
