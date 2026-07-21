@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div class="mb-6">
        <h1 class="font-display text-2xl font-semibold text-ink-700 dark:text-slate-100">Selamat Datang Kembali</h1>
        <p class="text-sm text-ink-500 dark:text-slate-400 mt-1">Masuk untuk mengelola toko kelontong Anda.</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-ink-600 dark:text-slate-300 mb-1.5">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@contoh.com"
                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-4 py-2.5 text-sm text-ink-700 placeholder:text-ink-400 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-100"
            >
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-ink-600 dark:text-slate-300 mb-1.5">Kata Sandi</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-4 py-2.5 text-sm text-ink-700 placeholder:text-ink-400 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-100"
            >
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-ink-600 dark:text-slate-300 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-ink-300 text-mustard-500 focus:ring-mustard-400">
                Ingat saya
            </label>
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-mustard-400 px-4 py-2.5 text-sm font-semibold text-ink-800 shadow-paper transition hover:bg-mustard-500 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:ring-offset-2"
        >
            Masuk
        </button>
    </form>
@endsection
