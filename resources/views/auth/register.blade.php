@extends('layouts.portal')

@section('title', 'রেজিস্ট্রেশন | Prize Bond Bangladesh')
@section('meta_description', 'বিনামূল্যে Prize Bond Bangladesh অ্যাকাউন্ট তৈরি করুন এবং আপনার প্রাইজ বন্ড নম্বর সংরক্ষণ করে ড্র ফলাফল যাচাই শুরু করুন।')
@section('robots', 'noindex, follow')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="grid gap-12 lg:grid-cols-[1fr_1.05fr] lg:items-center">
            <div class="space-y-7">
                <span class="section-label">নতুন অ্যাকাউন্ট</span>
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900 leading-tight">
                    আজই আপনার বন্ড <span class="text-indigo-600">ট্র্যাক করা শুরু করুন</span>
                </h1>
                <p class="max-w-md text-base leading-7 text-slate-600">
                    মাত্র কয়েক সেকেন্ডে অ্যাকাউন্ট তৈরি করুন, আপনার প্রাইজ বন্ড নম্বরগুলো সংরক্ষণ করুন এবং প্রতিটি ড্র-এর ফলাফল স্বয়ংক্রিয়ভাবে যাচাই করুন।
                </p>

                <div class="space-y-3">
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                        <div class="icon-badge-emerald h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">সম্পূর্ণ বিনামূল্যে</p>
                            <p class="text-sm text-slate-500">যত খুশি প্রাইজ বন্ড নম্বর সংরক্ষণ করুন, কোনো খরচ নেই।</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                        <div class="icon-badge-indigo h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">ব্লক অনুযায়ী সংগঠিত</p>
                            <p class="text-sm text-slate-500">একাধিক "ব্লক"-এ বন্ড ভাগ করে রাখুন, প্রতি ব্লকে সর্বোচ্চ ১০০টি।</p>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-slate-600">
                    আগে থেকেই অ্যাকাউন্ট আছে?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">লগইন করুন →</a>
                </p>
            </div>

            <div class="card-elevated p-8 sm:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="icon-badge-brand">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">অ্যাকাউন্ট তৈরি করুন</h2>
                        <p class="text-sm text-slate-500">কয়েক ধাপেই শুরু করুন</p>
                    </div>
                </div>

                @if($smtpActive)
                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-indigo-100 bg-indigo-50/60 p-3 text-sm text-indigo-900">
                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>রেজিস্ট্রেশনের পর আপনার ইমেইলে একটি যাচাইকরণ লিংক পাঠানো হবে। লিংকে ক্লিক করার পরই ড্যাশবোর্ড ব্যবহার করা যাবে।</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">পূর্ণ নাম</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                               placeholder="আপনার পূর্ণ নাম"
                               class="input-field">
                        @error('name')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">ইমেইল</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               placeholder="email@example.com"
                               class="input-field">
                        @error('email')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-medium text-slate-700">মোবাইল নম্বর <span class="text-slate-400 font-normal">(ঐচ্ছিক)</span></label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="01XXXXXXXXX"
                               class="input-field">
                        <p class="mt-1.5 text-xs text-slate-500">দিলে ভবিষ্যতে মোবাইল নম্বর দিয়েও লগইন করতে পারবেন।</p>
                        @error('phone')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">পাসওয়ার্ড</label>
                            <input id="password" name="password" type="password" required
                                   placeholder="••••••••"
                                   class="input-field">
                            <p class="mt-1.5 text-xs text-slate-500">কমপক্ষে ৮ অক্ষর</p>
                            @error('password')
                                <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">নিশ্চিত করুন</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   placeholder="••••••••"
                                   class="input-field">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        রেজিস্টার করুন
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500 lg:hidden">
                    আগে থেকেই অ্যাকাউন্ট আছে?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">লগইন</a>
                </p>
            </div>
        </div>
    </section>
@endsection
