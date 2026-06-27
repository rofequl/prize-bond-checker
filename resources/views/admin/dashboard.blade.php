@extends('layouts.admin')

@section('title', 'Admin Dashboard | Price Bond Bangladesh')
@section('page_title', 'Dashboard')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <span class="section-label">Admin Overview</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">System at a glance</h1>
            <p class="mt-1 text-sm text-slate-500">Monitor key metrics and recent activity across the platform.</p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-indigo h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Total Users</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['total_users'] }}</p>
            </div>

            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-emerald h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Total Blocks</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['total_blocks'] }}</p>
            </div>

            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-amber h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Prize Bonds</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['total_bonds'] }}</p>
            </div>

            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-rose h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Series</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['total_series'] }}</p>
            </div>

            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-indigo h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">All Draws</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['total_draws'] }}</p>
            </div>

            <div class="card-elevated p-5">
                <div class="flex items-center justify-between">
                    <div class="icon-badge-emerald h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Valid Draws</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $stats['valid_draws'] }}</p>
            </div>
        </div>

        {{-- Two columns --}}
        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            {{-- Shortcuts --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="icon-badge-brand">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Quick Actions</h2>
                        <p class="text-xs text-slate-500">Common admin tasks</p>
                    </div>
                </div>

                <div class="grid gap-2">
                    <a href="{{ route('admin.series') }}" class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-indigo-300 hover:bg-indigo-50/30">
                        <span class="icon-badge-amber h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6"></path></svg>
                        </span>
                        <div class="flex-1">
                            <p class="font-semibold text-slate-900">Manage Series</p>
                            <p class="text-xs text-slate-500">Add or toggle series availability</p>
                        </div>
                        <svg class="h-5 w-5 text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>

                    <a href="{{ route('admin.users') }}" class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-indigo-300 hover:bg-indigo-50/30">
                        <span class="icon-badge-emerald h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <div class="flex-1">
                            <p class="font-semibold text-slate-900">View User List</p>
                            <p class="text-xs text-slate-500">Browse all registered citizens</p>
                        </div>
                        <svg class="h-5 w-5 text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>

                    <a href="{{ route('admin.results') }}" class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-indigo-300 hover:bg-indigo-50/30">
                        <span class="icon-badge-rose h-10 w-10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10"></path></svg>
                        </span>
                        <div class="flex-1">
                            <p class="font-semibold text-slate-900">Add Draw Result</p>
                            <p class="text-xs text-slate-500">Enter a new quarterly draw</p>
                        </div>
                        <svg class="h-5 w-5 text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Latest Draws --}}
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="icon-badge-emerald">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Latest Draws</h2>
                            <p class="text-xs text-slate-500">Last 8 draws — used for citizen verification</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    @forelse($recentDraws as $draw)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-3 hover:bg-slate-50/60 transition">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $draw->draw_title }}</p>
                                <p class="text-xs text-slate-500">{{ $draw->draw_date->format('d M Y') }}</p>
                            </div>
                            @if($draw->is_valid)
                                <span class="badge-success">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Valid
                                </span>
                            @else
                                <span class="badge-muted">Expired</span>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">No draw results added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
