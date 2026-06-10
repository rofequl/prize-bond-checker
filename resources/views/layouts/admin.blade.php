<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Admin | Price Bond Bangladesh')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen antialiased">
        <div class="relative flex min-h-screen flex-col">
            <header class="portal-shell pt-6">
                <div class="glass-card flex flex-col gap-4 px-5 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold text-white">Admin Panel</a>

                    <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-200">
                        <a href="{{ route('admin.dashboard') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">Dashboard</a>
                        <a href="{{ route('admin.series') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('admin.series*') ? 'bg-white/20' : 'hover:bg-white/10' }}">Series</a>
                        <a href="{{ route('admin.users') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('admin.users') ? 'bg-white/20' : 'hover:bg-white/10' }}">Users</a>
                        <a href="{{ route('admin.results') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('admin.results*') ? 'bg-white/20' : 'hover:bg-white/10' }}">Results</a>
                    </nav>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="rounded-full px-4 py-2 text-sm text-slate-200 transition hover:bg-white/10">Logout</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </header>

            <main class="flex-1">
                @yield('content')
            </main>
        </div>
    </body>
</html>
