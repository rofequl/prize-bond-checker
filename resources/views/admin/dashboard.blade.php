@extends('layouts.admin')

@section('title', 'Admin Dashboard | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-10 sm:py-14">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <div class="glass-card p-5"><p class="text-sm text-slate-300">Total Users</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['total_users'] }}</p></div>
            <div class="glass-card p-5"><p class="text-sm text-slate-300">Total Blocks</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['total_blocks'] }}</p></div>
            <div class="glass-card p-5"><p class="text-sm text-slate-300">Total Prize Bonds</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['total_bonds'] }}</p></div>
            <div class="glass-card p-5"><p class="text-sm text-slate-300">Series</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['total_series'] }}</p></div>
            <div class="glass-card p-5"><p class="text-sm text-slate-300">All Draws</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['total_draws'] }}</p></div>
            <div class="glass-card p-5"><p class="text-sm text-slate-300">Valid Draws</p><p class="mt-2 text-3xl font-bold text-white">{{ $stats['valid_draws'] }}</p></div>
        </div>

        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-white">Admin Shortcuts</h2>
                <div class="mt-4 grid gap-3">
                    <a href="{{ route('admin.series') }}" class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-100">Manage Series</a>
                    <a href="{{ route('admin.users') }}" class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-100">View User List</a>
                    <a href="{{ route('admin.results') }}" class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-100">Entry Draw Result</a>
                </div>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-white">Latest 8 Draws</h2>
                <p class="mt-1 text-sm text-slate-300">Only latest 8 draws are considered valid.</p>
                <div class="mt-4 space-y-3">
                    @forelse($recentDraws as $draw)
                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-white">{{ $draw->draw_title }}</p>
                                <span class="text-xs {{ $draw->is_valid ? 'text-emerald-300' : 'text-slate-400' }}">{{ $draw->is_valid ? 'Valid' : 'Expired' }}</span>
                            </div>
                            <p class="mt-1 text-sm text-slate-300">{{ $draw->series->name }} | {{ $draw->draw_date->format('d M Y') }}</p>
                        </div>
                    @empty
                        <p class="text-slate-400">No draw result added yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
