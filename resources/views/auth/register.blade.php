@extends('layouts.portal')

@section('title', 'Registration | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="mx-auto w-full max-w-xl glass-card p-8 sm:p-10">
            <h1 class="text-3xl font-bold text-white">Citizen Registration</h1>
            <p class="mt-2 text-sm text-slate-300">Create account with name, email and password.</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-4">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm text-slate-200">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-3 text-white outline-none transition focus:border-emerald-400">
                    @error('name')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm text-slate-200">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-3 text-white outline-none transition focus:border-emerald-400">
                    @error('email')
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

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm text-slate-200">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-3 text-white outline-none transition focus:border-emerald-400">
                </div>

                <button type="submit" class="w-full rounded-xl bg-emerald-400 px-4 py-3 font-semibold text-slate-950">
                    Register
                </button>
            </form>
        </div>
    </section>
@endsection
