@extends('layouts.portal')

@section('title', 'লগইন | Price Bond Bangladesh')
@section('meta_description', 'Price Bond Bangladesh অ্যাকাউন্টে লগইন করে আপনার সংরক্ষিত প্রাইজ বন্ড ও ড্র ফলাফল দেখুন।')
@section('robots', 'noindex, follow')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="grid gap-12 lg:grid-cols-[1fr_1.05fr] lg:items-center">
            <div class="space-y-7">
                <span class="section-label">সিটিজেন লগইন</span>
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900 leading-tight">
                    আপনার অ্যাকাউন্টে <span class="text-indigo-600">ফিরে আসুন</span>
                </h1>
                <p class="max-w-md text-base leading-7 text-slate-600">
                    মোবাইল নম্বর বা ইমেইল দিয়ে লগইন করে আপনার সংরক্ষিত প্রাইজ বন্ড এবং সাম্প্রতিক ড্র ফলাফল দেখুন।
                </p>

                <div class="space-y-3">
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                        <div class="icon-badge-indigo h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">নিরাপদ অ্যাকাউন্ট</p>
                            <p class="text-sm text-slate-500">আপনার তথ্য পাসওয়ার্ড-সুরক্ষিত এবং কেবল আপনিই দেখতে পারবেন।</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                        <div class="icon-badge-emerald h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">স্বয়ংক্রিয় ফলাফল মিল</p>
                            <p class="text-sm text-slate-500">লগইনের পর এক ক্লিকে আপনার সব বন্ড সাম্প্রতিক ড্র-এর সাথে যাচাই হয়।</p>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-slate-600">
                    এখনো অ্যাকাউন্ট নেই?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">রেজিস্ট্রেশন করুন →</a>
                </p>
            </div>

            <div class="card-elevated p-8 sm:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="icon-badge-brand">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">সাইন ইন</h2>
                        <p class="text-sm text-slate-500">আপনার তথ্য দিয়ে লগইন করুন</p>
                    </div>
                </div>

                @if(session('status'))
                    <div class="alert-success mb-4">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="login" class="mb-1.5 block text-sm font-medium text-slate-700">মোবাইল নম্বর / ইমেইল</label>
                        <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                               placeholder="01XXXXXXXXX বা email@example.com"
                               class="input-field">
                        @error('login')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-slate-700">পাসওয়ার্ড</label>
                            @if($smtpActive)
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">পাসওয়ার্ড ভুলে গেছেন?</a>
                            @endif
                        </div>
                        <input id="password" name="password" type="password" required
                               placeholder="••••••••"
                               class="input-field">
                        @error('password')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        আমাকে মনে রাখুন
                    </label>

                    <button type="submit" class="btn-primary w-full">
                        লগইন করুন
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500 lg:hidden">
                    এখনো অ্যাকাউন্ট নেই?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">রেজিস্ট্রেশন</a>
                </p>
            </div>
        </div>
    </section>
@endsection
