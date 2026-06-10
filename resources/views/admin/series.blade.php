@extends('layouts.admin')

@section('title', 'Admin Series | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-10 sm:py-14">
        <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="glass-card p-6">
                <h1 class="text-2xl font-bold text-white">Series Management</h1>
                <p class="mt-2 text-sm text-slate-300">Series তালিকা থেকে citizen panel-এ bond entry option দেখা যাবে।</p>

                @if(session('series_message'))
                    <p class="mt-4 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ session('series_message') }}</p>
                @endif

                <form method="POST" action="{{ route('admin.series.store') }}" class="mt-5 space-y-3">
                    @csrf
                    <div>
                        <label class="mb-1 block text-sm text-slate-300">New Series</label>
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="Example: E"
                               class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="rounded-xl bg-emerald-400 px-4 py-2.5 font-semibold text-slate-950">Add Series</button>
                </form>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-white">All Series</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="text-slate-300">
                        <tr>
                            <th class="py-2 pr-4">Series</th>
                            <th class="py-2 pr-4">Status</th>
                            <th class="py-2 pr-4">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($series as $item)
                            <tr class="border-t border-white/10 text-slate-200">
                                <td class="py-2 pr-4 font-semibold">{{ $item->name }}</td>
                                <td class="py-2 pr-4">
                                    @if($item->is_active)
                                        <span class="rounded-full bg-emerald-400/20 px-2 py-1 text-xs text-emerald-200">Active</span>
                                    @else
                                        <span class="rounded-full bg-slate-400/20 px-2 py-1 text-xs text-slate-200">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-2 pr-4">
                                    <form method="POST" action="{{ route('admin.series.toggle', $item) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded-lg border border-white/20 px-3 py-1.5 text-xs text-white">
                                            {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-3 text-slate-400">No series available.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
