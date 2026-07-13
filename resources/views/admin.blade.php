@extends('layouts.portal')

@section('title', 'Prize Bond Bangladesh | Admin Panel')

@section('content')
    <section class="portal-shell pt-10 sm:pt-16">
        <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr] lg:items-start">
            <div class="space-y-5">
                <span class="section-label">Admin Panel</span>
                <h1 class="text-4xl font-black leading-tight text-white sm:text-5xl">ড্র, ব্যবহারকারী, আর বিজয়ী যাচাইয়ের নিয়ন্ত্রণ কক্ষ।</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-200/85">
                    admin side-এ draw upload, winner verification, নাগরিক account review, আর result publish করার জন্য একটি
                    clean dashboard design রাখা হয়েছে।
                </p>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="glass-card p-5">
                        <p class="text-sm text-slate-300">Users</p>
                        <p class="mt-2 text-3xl font-black text-white">18.4k</p>
                    </div>
                    <div class="glass-card p-5">
                        <p class="text-sm text-slate-300">Draws</p>
                        <p class="mt-2 text-3xl font-black text-white">59</p>
                    </div>
                    <div class="glass-card p-5">
                        <p class="text-sm text-slate-300">Winners</p>
                        <p class="mt-2 text-3xl font-black text-white">248</p>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6">
                <p class="text-sm text-slate-300">Operations</p>
                <h2 class="mt-2 text-2xl font-bold text-white">দ্রুত অ্যাডমিন টাস্ক</h2>

                <div class="mt-5 space-y-3 text-sm text-slate-200/85">
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">নতুন ড্র আপলোড</div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">Winner list publish</div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">Citizen account review</div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">Prize bond data cleanup</div>
                </div>

                <div class="mt-5 rounded-2xl border border-rose-300/20 bg-rose-500/10 p-4 text-sm leading-7 text-rose-50/90">
                    production এ role-based middleware, audit logs, and result approval workflow যোগ করা উচিত।
                </div>
            </div>
        </div>
    </section>

    <section class="portal-shell pb-8 pt-16 sm:pb-14 sm:pt-20">
        <div class="grid gap-4 lg:grid-cols-3">
            <div class="glass-card p-6 lg:col-span-2">
                <span class="section-label">Dashboard</span>
                <h2 class="mt-4 text-2xl font-bold text-white">Result approval queue</h2>
                <div class="mt-5 space-y-3">
                    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                        <div>
                            <p class="text-sm text-slate-300">59th draw validation</p>
                            <p class="mt-1 text-base font-semibold text-white">Pending verification</p>
                        </div>
                        <span class="rounded-full bg-amber-300/15 px-3 py-1 text-sm text-amber-100">Review</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                        <div>
                            <p class="text-sm text-slate-300">Archived winners</p>
                            <p class="mt-1 text-base font-semibold text-white">Synced to public board</p>
                        </div>
                        <span class="rounded-full bg-emerald-300/15 px-3 py-1 text-sm text-emerald-100">Live</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6">
                <p class="text-sm text-slate-300">System note</p>
                <h2 class="mt-2 text-2xl font-bold text-white">বাংলা first, trust first</h2>
                <p class="mt-4 text-sm leading-7 text-slate-300">
                    Admin designে তথ্য কম, নির্দেশনা স্পষ্ট, আর publish buttons সহজ রাখলে কাজ দ্রুত হবে।
                </p>
            </div>
        </div>
    </section>
@endsection
