@extends('layouts.admin')

@section('title', 'System | Price Bond Bangladesh')
@section('page_title', 'System Tools')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <span class="section-label">Maintenance</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">System tools</h1>
            <p class="mt-1 text-sm text-slate-500">Run common artisan tasks without shell access. All actions are logged and restricted to admins.</p>
        </div>

        @if(session('system_message'))
            <div class="alert-success mb-4">
                <pre class="whitespace-pre-wrap font-mono text-xs">{{ session('system_message') }}</pre>
            </div>
        @endif

        @if(session('system_error'))
            <div class="alert-error mb-4">{{ session('system_error') }}</div>
        @endif

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Storage Link --}}
            <div class="card p-6 flex flex-col">
                <div class="flex items-center justify-between mb-3">
                    <div class="icon-badge-indigo">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    @if($storageLinked)
                        <span class="badge-success">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Linked
                        </span>
                    @else
                        <span class="badge-warning">Not linked</span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-slate-900">Storage Link</h3>
                <p class="mt-1 text-sm text-slate-500 flex-1">Creates the <code class="text-xs bg-slate-100 px-1 rounded">public/storage</code> symlink so uploaded PDFs are publicly accessible.</p>
                <form method="POST" action="{{ route('admin.system.storage-link') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="btn-primary w-full text-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Run storage:link
                    </button>
                </form>
            </div>

            {{-- Clear cache --}}
            <div class="card p-6 flex flex-col">
                <div class="flex items-center justify-between mb-3">
                    <div class="icon-badge-amber">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Clear Cache</h3>
                <p class="mt-1 text-sm text-slate-500 flex-1">Runs <code class="text-xs bg-slate-100 px-1 rounded">optimize:clear</code> — clears route, view, config, event and compiled caches in one go.</p>
                <form method="POST" action="{{ route('admin.system.clear-cache') }}" class="mt-4" onsubmit="return confirm('Clear all caches?');">
                    @csrf
                    <button type="submit" class="btn-primary w-full text-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Run optimize:clear
                    </button>
                </form>
            </div>

            {{-- Migrate --}}
            <div class="card p-6 flex flex-col">
                <div class="flex items-center justify-between mb-3">
                    <div class="icon-badge-emerald">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Run Migrations</h3>
                <p class="mt-1 text-sm text-slate-500 flex-1">Runs pending database migrations (<code class="text-xs bg-slate-100 px-1 rounded">--force</code> mode). Safe to run anytime; only pending migrations execute.</p>
                <form method="POST" action="{{ route('admin.system.migrate') }}" class="mt-4" onsubmit="return confirm('Run pending migrations?');">
                    @csrf
                    <button type="submit" class="btn-primary w-full text-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Run migrate
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-8 card p-6">
            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <svg class="h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                Safety notes
            </h3>
            <ul class="mt-3 space-y-2 text-sm text-slate-600 leading-relaxed">
                <li class="flex gap-2"><span class="text-slate-400">•</span> All actions are protected by admin authentication and CSRF tokens.</li>
                <li class="flex gap-2"><span class="text-slate-400">•</span> These tools use Laravel's <code class="text-xs bg-slate-100 px-1 rounded">Artisan</code> facade — same as running the commands via SSH.</li>
                <li class="flex gap-2"><span class="text-slate-400">•</span> On shared hosting, <code class="text-xs bg-slate-100 px-1 rounded">storage:link</code> may fail if the host blocks symlink creation. Contact support if so.</li>
                <li class="flex gap-2"><span class="text-slate-400">•</span> Migrations are run in <code class="text-xs bg-slate-100 px-1 rounded">--force</code> mode; back up your database before running new ones.</li>
            </ul>
        </div>
    </section>
@endsection
