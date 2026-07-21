<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelontong.id - @yield('title', 'Masuk')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        paper: '#F7F3E8',
                        ink: {
                            50: '#EDF1EE', 100: '#D3DCD5', 300: '#8FA292', 400: '#5C7563',
                            500: '#3A4F40', 600: '#2A3B2F', 700: '#1E2B24', 800: '#161F1A', 900: '#101613',
                        },
                        mustard: {
                            50: '#FBF3DF', 100: '#F7E7BE', 200: '#EFCE85', 300: '#E8BE5C',
                            400: '#DDAF3E', 500: '#C99A26', 600: '#A97D1B', 700: '#8A6415',
                        },
                        clay: {
                            50: '#FBEAEA', 100: '#F5CFCF', 300: '#DE9494', 400: '#C25C5C',
                            500: '#A83232', 600: '#8A2727', 700: '#6E1E1E',
                        },
                        leaf: {
                            50: '#EEF5EE', 100: '#D2E7D5', 300: '#8CB894', 400: '#5E9468',
                            500: '#3F6B47', 600: '#2F5233',
                        },
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Space Mono"', 'monospace'],
                    },
                    boxShadow: {
                        paper: '0 1px 2px rgba(30,43,36,0.06), 0 4px 14px rgba(30,43,36,0.06)',
                    },
                },
            },
        };

        (function () {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const shouldUseDark = storedTheme === 'dark' || (!storedTheme && prefersDark);

            if (shouldUseDark) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; }
        [x-cloak] { display: none !important; }

        .dark .bg-white { background-color: #0f172a !important; }
        .dark .bg-paper { background-color: #111827 !important; }
        .dark .border-ink-100 { border-color: #334155 !important; }
        .dark .text-ink-700 { color: #e2e8f0 !important; }
        .dark .text-ink-500 { color: #94a3b8 !important; }
        .dark .text-ink-400 { color: #cbd5e1 !important; }
        .dark .bg-ink-50 { background-color: #0f172a !important; }
        .dark .bg-leaf-50 { background-color: #122b1a !important; }
        .dark .bg-clay-50 { background-color: #2b1011 !important; }
        .dark .shadow-paper { box-shadow: 0 1px 2px rgba(255, 255, 255, 0.04), 0 4px 14px rgba(255, 255, 255, 0.04) !important; }
    </style>
</head>
<body class="bg-paper text-ink-700 antialiased dark:bg-slate-950 dark:text-slate-100">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10" x-data>

        <button id="themeToggleBtn"
                type="button"
                onclick="toggleTheme()"
                class="fixed top-4 right-4 inline-flex items-center justify-center rounded-full border border-ink-200 bg-white/90 text-ink-700 p-2 shadow-sm transition hover:bg-mustard-50 dark:border-slate-700 dark:bg-slate-800/90 dark:text-slate-100 dark:hover:bg-slate-700/80"
                aria-label="Toggle dark mode">
            <span data-light class="text-lg">🌙</span>
            <span data-dark class="hidden text-lg">☀️</span>
        </button>

        <div class="mb-8 flex flex-col items-center gap-3 text-center">
            <span class="shrink-0 w-14 h-14 rounded-2xl bg-mustard-400 flex items-center justify-center shadow-paper">
                <svg class="w-7 h-7 text-ink-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 9h16l-1.4 9.8A2 2 0 0 1 16.62 20.6H7.38a2 2 0 0 1-1.98-1.8L4 9Z"/>
                    <path d="M8 9V6.5a4 4 0 0 1 8 0V9"/>
                    <path d="M9 13v4M12 13v4M15 13v4"/>
                </svg>
            </span>
            <div>
                <p class="font-display font-semibold text-2xl leading-tight text-ink-700 dark:text-slate-100">Kelontong.id</p>
                <p class="text-[11px] uppercase tracking-widest text-mustard-600 dark:text-mustard-400">Kelontong &amp; Kasir</p>
            </div>
        </div>

        <div class="w-full max-w-md bg-white rounded-2xl shadow-paper border border-ink-100 p-6 sm:p-8 dark:border-slate-700">
            @if (session('success'))
                <div class="mb-5 flex items-start gap-3 rounded-lg border border-leaf-300/60 bg-leaf-50 px-4 py-3 text-sm text-leaf-600 shadow-paper">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <p class="flex-1">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 flex items-start gap-3 rounded-lg border border-clay-300/60 bg-clay-50 px-4 py-3 text-sm text-clay-600 shadow-paper">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4m0 4h.01M10.3 3.86l-8.2 14.2A1.5 1.5 0 0 0 3.5 20h17a1.5 1.5 0 0 0 1.4-2L13.7 3.86a1.5 1.5 0 0 0-2.6 0Z"/></svg>
                    <ul class="flex-1 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

        <p class="mt-8 text-[11px] text-ink-400 dark:text-slate-500">&copy; {{ date('Y') }} Kelontong.id &mdash; Catat setiap barang, tiap rupiah.</p>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeToggle(isDark);
        }

        function updateThemeToggle(isDark = document.documentElement.classList.contains('dark')) {
            const button = document.getElementById('themeToggleBtn');
            if (!button) return;
            button.querySelector('[data-light]').classList.toggle('hidden', isDark);
            button.querySelector('[data-dark]').classList.toggle('hidden', !isDark);
            button.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateThemeToggle();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
</body>
</html>
