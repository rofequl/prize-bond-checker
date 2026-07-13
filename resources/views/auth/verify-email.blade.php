@extends('layouts.portal')

@section('title', 'ইমেইল যাচাই | Price Bond Bangladesh')
@section('robots', 'noindex, nofollow')

@section('content')
    <section class="portal-shell py-14 sm:py-20">
        <div class="mx-auto max-w-lg card-elevated p-8 sm:p-10 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <h1 class="mt-6 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">
                ইমেইল যাচাই করুন
            </h1>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                আমরা <span class="font-semibold text-slate-900">{{ auth()->user()->email }}</span> ঠিকানায় একটি যাচাইকরণ লিংক পাঠিয়েছি। লিংকে ক্লিক করে ইমেইল যাচাই করুন, তারপর আপনার ড্যাশবোর্ড ব্যবহার করতে পারবেন।
            </p>

            @if(session('verify_message'))
                <div class="alert-success mt-5 text-left">{{ session('verify_message') }}</div>
            @endif
            @if(session('verify_error'))
                <div class="alert-error mt-5 text-left">{{ session('verify_error') }}</div>
            @endif

            @if($smtpActive)
                <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="btn-primary w-full">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        যাচাইকরণ ইমেইল আবার পাঠান
                    </button>
                </form>
            @else
                <div class="alert-warning mt-6 text-left">
                    ইমেইল সেবা এই মুহূর্তে সচল নেই। অনুগ্রহ করে অ্যাডমিনের সাথে যোগাযোগ করুন।
                </div>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn-ghost w-full text-sm">
                    লগআউট
                </button>
            </form>
        </div>
    </section>
@endsection
