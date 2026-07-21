@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <div class="mb-6">
        <h1 class="font-display text-2xl font-semibold text-ink-700 dark:text-slate-100">Buat Akun Baru</h1>
        <p class="text-sm text-ink-500 dark:text-slate-400 mt-1">Daftar untuk mulai mengelola toko kelontong Anda.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-ink-600 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama Anda"
                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-4 py-2.5 text-sm text-ink-700 placeholder:text-ink-400 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-100"
            >
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-ink-600 dark:text-slate-300 mb-1.5">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
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
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-4 py-2.5 text-sm text-ink-700 placeholder:text-ink-400 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-100"
            >
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-ink-600 dark:text-slate-300 mb-1.5">Konfirmasi Kata Sandi</label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi kata sandi"
                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-4 py-2.5 text-sm text-ink-700 placeholder:text-ink-400 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-100"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-mustard-400 px-4 py-2.5 text-sm font-semibold text-ink-800 shadow-paper transition hover:bg-mustard-500 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:ring-offset-2"
        >
            Daftar
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-ink-500 dark:text-slate-400">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-mustard-600 hover:text-mustard-700 dark:text-mustard-400">Masuk di sini</a>
    </p>
@endsection
