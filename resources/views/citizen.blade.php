@extends('layouts.portal')

@section('title', 'Prize Bond Bangladesh | Citizen Panel')

@section('content')
    <section class="portal-shell pt-10 sm:pt-16">
        <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr] lg:items-start">
            <div class="space-y-5">
                <span class="section-label">Citizen Panel</span>
                <h1 class="text-4xl font-black leading-tight text-white sm:text-5xl">নাগরিকের জন্য একাউন্ট, বন্ড, আর ড্র ট্র্যাকিং।</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-200/85">
                    এখানে নাগরিক লগইন, রেজিস্টার, prize bond number সংরক্ষণ, এবং draw result search করার ডিজাইন রাখা হলো।
                    পরে এগুলো backend authentication এবং database flow এর সাথে যুক্ত করা যাবে।
                </p>

                <div class="flex flex-wrap gap-3">
                    <span class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm text-slate-200">সরাসরি লগইন</span>
                    <span class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm text-slate-200">নতুন রেজিস্টার</span>
                    <span class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm text-slate-200">বন্ড সেভ</span>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="glass-card p-6">
                    <p class="text-sm text-slate-300">Login</p>
                    <h2 class="mt-2 text-2xl font-bold text-white">সিটিজেন সাইন ইন</h2>
                    <div class="mt-5 space-y-3">
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">মোবাইল নাম্বার / ইমেইল</div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">পাসওয়ার্ড</div>
                        <button class="w-full rounded-2xl bg-emerald-300 px-4 py-3 font-semibold text-slate-950">লগইন করুন</button>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <p class="text-sm text-slate-300">Register</p>
                    <h2 class="mt-2 text-2xl font-bold text-white">নতুন একাউন্ট</h2>
                    <div class="mt-5 space-y-3">
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">পূর্ণ নাম</div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">মোবাইল নাম্বার</div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">পাসওয়ার্ড</div>
                        <button class="w-full rounded-2xl border border-white/15 bg-white/5 px-4 py-3 font-semibold text-white">রেজিস্টার করুন</button>
                    </div>
                </div>

                <div class="glass-card p-6 sm:col-span-2">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm text-slate-300">Bond Vault</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">সংরক্ষিত prize bond নম্বর</h2>
                        </div>
                        <div class="rounded-full bg-amber-300/15 px-4 py-2 text-sm font-semibold text-amber-100">পরবর্তী ড্র-এর জন্য প্রস্তুত</div>
                    </div>

                    <div class="mt-5 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Bond</p>
                            <p class="mt-2 text-xl font-bold text-white">A-120448</p>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Status</p>
                            <p class="mt-2 text-xl font-bold text-emerald-200">Saved</p>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Draw</p>
                            <p class="mt-2 text-xl font-bold text-white">Matched</p>
                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl border border-dashed border-white/15 p-4 text-sm leading-7 text-slate-300">
                        পরে এখানে একাধিক bond যোগ করা, search by number, draw history, এবং winner notifications বসবে।
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
