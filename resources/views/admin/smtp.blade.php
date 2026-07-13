@extends('layouts.admin')

@section('title', 'SMTP | Price Bond Bangladesh')
@section('page_title', 'Email / SMTP Settings')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <span class="section-label">Communication</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">SMTP mail settings</h1>
            <p class="mt-1 text-sm text-slate-500">Configure your outgoing mail server. Once enabled, the app will send verification and password-reset emails through it.</p>
        </div>

        @if(session('smtp_message'))
            <div class="alert-success mb-4">{{ session('smtp_message') }}</div>
        @endif
        @if(session('smtp_error'))
            <div class="alert-error mb-4">{{ session('smtp_error') }}</div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">
            {{-- SMTP form --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="icon-badge-indigo">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Server configuration</h2>
                        <p class="text-xs text-slate-500">These credentials override the values from your .env file at runtime.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.smtp.update') }}" class="space-y-4">
                    @csrf

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="host" class="mb-1.5 block text-sm font-medium text-slate-700">Host</label>
                            <input id="host" name="host" type="text" required
                                   value="{{ old('host', $setting->host ?? '') }}"
                                   placeholder="smtp.gmail.com"
                                   class="input-field">
                            @error('host')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="port" class="mb-1.5 block text-sm font-medium text-slate-700">Port</label>
                            <input id="port" name="port" type="number" min="1" max="65535" required
                                   value="{{ old('port', $setting->port ?? 587) }}"
                                   class="input-field">
                            @error('port')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="encryption" class="mb-1.5 block text-sm font-medium text-slate-700">Encryption</label>
                        <select id="encryption" name="encryption" class="input-field">
                            @php $enc = old('encryption', $setting->encryption ?? 'tls'); @endphp
                            <option value="tls" @selected($enc === 'tls')>TLS (STARTTLS, recommended)</option>
                            <option value="ssl" @selected($enc === 'ssl')>SSL</option>
                            <option value="" @selected($enc === '' || $enc === null)>None</option>
                        </select>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="username" class="mb-1.5 block text-sm font-medium text-slate-700">Username</label>
                            <input id="username" name="username" type="text"
                                   value="{{ old('username', $setting->username ?? '') }}"
                                   placeholder="you@example.com"
                                   class="input-field">
                        </div>
                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                            <input id="password" name="password" type="password"
                                   placeholder="{{ $setting && $setting->password ? '•••••••• (leave blank to keep)' : 'App password or SMTP secret' }}"
                                   class="input-field"
                                   autocomplete="new-password">
                            <p class="mt-1.5 text-xs text-slate-500">Stored encrypted. Leave blank to keep the existing value.</p>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="from_address" class="mb-1.5 block text-sm font-medium text-slate-700">From address</label>
                            <input id="from_address" name="from_address" type="email" required
                                   value="{{ old('from_address', $setting->from_address ?? '') }}"
                                   placeholder="no-reply@example.com"
                                   class="input-field">
                            @error('from_address')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="from_name" class="mb-1.5 block text-sm font-medium text-slate-700">From name</label>
                            <input id="from_name" name="from_name" type="text" required
                                   value="{{ old('from_name', $setting->from_name ?? config('app.name')) }}"
                                   class="input-field">
                            @error('from_name')<p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <input type="checkbox" name="enabled" value="1" class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                               @checked(old('enabled', $setting->enabled ?? false))>
                        <span class="text-sm">
                            <span class="block font-semibold text-slate-900">Enable SMTP delivery</span>
                            <span class="block text-slate-500 text-xs mt-0.5">When enabled, email verification and password reset become available to citizens.</span>
                        </span>
                    </label>

                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save settings
                        </button>
                    </div>
                </form>
            </div>

            {{-- Status + test --}}
            <div class="space-y-4">
                <div class="card p-6">
                    <h3 class="text-base font-bold text-slate-900">Current status</h3>
                    <div class="mt-3 space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Configured</span>
                            @if($setting)
                                <span class="badge-success"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Saved</span>
                            @else
                                <span class="badge-warning">Not saved</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Delivery</span>
                            @if($setting && $setting->enabled && $setting->isConfigured())
                                <span class="badge-success"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active</span>
                            @else
                                <span class="badge-warning">Disabled</span>
                            @endif
                        </div>
                        @if($setting)
                            <div class="flex items-center justify-between">
                                <span class="text-slate-600">Host</span>
                                <span class="text-slate-900 font-medium truncate max-w-[60%]">{{ $setting->host }}:{{ $setting->port }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-600">From</span>
                                <span class="text-slate-900 font-medium truncate max-w-[60%]">{{ $setting->from_address }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card p-6">
                    <h3 class="text-base font-bold text-slate-900">Send a test email</h3>
                    <p class="mt-1 text-xs text-slate-500">Save the settings first, then send a test message to yourself to confirm delivery.</p>
                    <form method="POST" action="{{ route('admin.smtp.test') }}" class="mt-4 space-y-3">
                        @csrf
                        <input type="email" name="recipient" required
                               value="{{ old('recipient', auth()->user()->email) }}"
                               placeholder="you@example.com"
                               class="input-field">
                        @error('recipient')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                        <button type="submit" class="btn-primary w-full text-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send test
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
