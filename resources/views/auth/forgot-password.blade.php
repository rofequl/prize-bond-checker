@extends('layouts.portal')

@section('title', 'পাসওয়ার্ড রিসেট | Prize Bond Bangladesh')
@section('robots', 'noindex, nofollow')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="mx-auto max-w-lg card-elevated p-8 sm:p-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="icon-badge-brand">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">পাসওয়ার্ড ভুলে গেছেন?</h2>
                    <p class="text-sm text-slate-500">আপনার ইমেইল দিন, আমরা রিসেট লিংক পাঠিয়ে দিব</p>
                </div>
            </div>

            @if(session('status'))
                <div class="alert-success mb-4">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">ইমেইল</label>
                    <input id="email" name="email" type="email" required autofocus
                           value="{{ old('email') }}"
                           placeholder="email@example.com"
                           class="input-field">
                    @error('email')
                        <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full">
                    রিসেট লিংক পাঠান
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">← লগইন পাতায় ফিরুন</a>
            </p>
        </div>
    </section>
@endsection
