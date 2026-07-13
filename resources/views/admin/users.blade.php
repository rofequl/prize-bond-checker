@extends('layouts.admin')

@section('title', 'Admin Users | Prize Bond Bangladesh')
@section('page_title', 'Users')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <span class="section-label">Citizen Users</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">All registered citizens</h1>
            <p class="mt-1 text-sm text-slate-500">Each row shows how many blocks and prize bonds a citizen has saved.</p>
        </div>

        <div class="card p-6">
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Joined</th>
                            <th>Blocks</th>
                            <th>Prize Bonds</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                                            {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                                        </span>
                                        <span class="font-semibold text-slate-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-slate-600">{{ $user->email }}</td>
                                <td class="text-slate-600">{{ $user->phone ?: '—' }}</td>
                                <td class="text-slate-500">{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge-indigo">{{ $user->prize_bond_blocks_count }}</span>
                                </td>
                                <td>
                                    <span class="badge-success">{{ $user->prize_bonds_count }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10">
                                    <div class="empty-state">No users found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
