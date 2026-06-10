@extends('layouts.admin')

@section('title', 'Admin Users | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-10 sm:py-14">
        <div class="glass-card p-6">
            <h1 class="text-2xl font-bold text-white">Citizen Users</h1>
            <p class="mt-2 text-sm text-slate-300">প্রতিটি user-এর block count এবং total prize bond count দেখানো হচ্ছে।</p>

            <div class="mt-5 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-slate-300">
                        <tr>
                            <th class="py-2 pr-4">Name</th>
                            <th class="py-2 pr-4">Email</th>
                            <th class="py-2 pr-4">Phone</th>
                            <th class="py-2 pr-4">Joined</th>
                            <th class="py-2 pr-4">Total Block</th>
                            <th class="py-2 pr-4">Total Prize Bond</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t border-white/10 text-slate-200">
                                <td class="py-2 pr-4 font-semibold">{{ $user->name }}</td>
                                <td class="py-2 pr-4">{{ $user->email }}</td>
                                <td class="py-2 pr-4">{{ $user->phone ?: '-' }}</td>
                                <td class="py-2 pr-4">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-2 pr-4">{{ $user->prize_bond_blocks_count }}</td>
                                <td class="py-2 pr-4">{{ $user->prize_bonds_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-3 text-slate-400">No users found.</td>
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
