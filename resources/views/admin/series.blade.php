@extends('layouts.admin')

@section('title', 'Admin Series | Prize Bond Bangladesh')
@section('page_title', 'Series Management')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <span class="section-label">Series Management</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Manage prize bond series</h1>
            <p class="mt-1 text-sm text-slate-500">Activate or deactivate series available to citizens.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
            {{-- Add new series --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="icon-badge-brand">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Add New Series</h2>
                        <p class="text-xs text-slate-500">Create a new prize bond series</p>
                    </div>
                </div>

                <div class="help-callout">
                    Only <span class="font-semibold text-emerald-700">active</span> series appear as an option for citizens when they add a prize bond. Deactivating a series hides it without deleting past data.
                </div>

                @if(session('series_message'))
                    <div class="alert-success mt-4">{{ session('series_message') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.series.store') }}" class="mt-5 space-y-3">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700">Series Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="Example: E"
                               class="input-field">
                        @error('name')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Series
                    </button>
                </form>
            </div>

            {{-- All series --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="icon-badge-emerald">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">All Series</h2>
                        <p class="text-xs text-slate-500">{{ count($series) }} total series</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                        <tr>
                            <th>Series</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($series as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-100 to-violet-100 text-sm font-bold text-indigo-700">
                                            {{ $item->name }}
                                        </span>
                                        <span class="font-semibold text-slate-900">Series {{ $item->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge-success">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="badge-muted">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <form method="POST" action="{{ route('admin.series.toggle', $item) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-secondary text-xs px-3 py-1.5">
                                            {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-10">
                                    <div class="empty-state">No series available yet. Add one on the left.</div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
