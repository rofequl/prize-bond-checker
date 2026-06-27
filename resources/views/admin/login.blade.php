@extends('layouts.admin')

@section('title', 'Admin Login | Price Bond Bangladesh')

@section('content')
    <div class="min-h-screen surface-app flex items-center justify-center px-4 py-12">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-40 left-1/4 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-violet-200/30 blur-3xl"></div>
        </div>

        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-3 mb-8">
                <img src="{{ asset('images/logo-mark.webp') }}" alt="Price Bond" class="h-16 w-auto object-contain">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[0.22em] text-indigo-600">Price Bond</p>
                    <p class="text-base font-bold text-slate-900">Admin Panel</p>
                </div>
            </a>

            <div class="card-elevated p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-violet-100 mb-4">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900">Admin Sign In</h1>
                    <p class="mt-1 text-sm text-slate-500">Manage series, draw results & users</p>
                </div>

                <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                               placeholder="admin@example.com"
                               class="input-field">
                        @error('email')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                        <input id="password" name="password" type="password" required
                               placeholder="••••••••"
                               class="input-field">
                        @error('password')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        Remember me
                    </label>

                    <button type="submit" class="btn-primary w-full">
                        Login
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-slate-500">
                © {{ date('Y') }}
                <a href="https://nayem.com.bd" target="_blank" rel="noopener" class="font-semibold text-slate-700 hover:text-indigo-600">Md Nayem</a>
                — Admin Portal
                <span class="block mt-1 text-slate-400">
                    <a href="https://github.com/rofequl/price-bond-checker" target="_blank" rel="noopener" class="hover:text-indigo-600">Open Source · MIT</a>
                </span>
            </p>
        </div>
    </div>
@endsection
