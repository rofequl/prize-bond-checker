@extends('layouts.portal')

@section('title', 'নতুন পাসওয়ার্ড সেট করুন | Prize Bond Bangladesh')
@section('robots', 'noindex, nofollow')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="mx-auto max-w-lg card-elevated p-8 sm:p-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="icon-badge-brand">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">নতুন পাসওয়ার্ড সেট করুন</h2>
                    <p class="text-sm text-slate-500">নতুন পাসওয়ার্ড দিন এবং নিশ্চিত করুন</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">ইমেইল</label>
                    <input id="email" name="email" type="email" required
                           value="{{ old('email', $email) }}"
                           class="input-field">
                    @error('email')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">নতুন পাসওয়ার্ড</label>
                    <input id="password" name="password" type="password" required
                           placeholder="••••••••"
                           class="input-field">
                    <p class="mt-1.5 text-xs text-slate-500">কমপক্ষে ৮ অক্ষর</p>
                    @error('password')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           placeholder="••••••••"
                           class="input-field">
                </div>

                <button type="submit" class="btn-primary w-full">
                    পাসওয়ার্ড রিসেট করুন
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
            </form>
        </div>
    </section>
@endsection
