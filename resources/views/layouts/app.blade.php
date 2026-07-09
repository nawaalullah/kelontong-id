<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelontong.id - @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
    </script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #D3DCD5; border-radius: 999px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-paper text-ink-700 antialiased">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

        <!-- Sidebar -->
        <aside
            class="fixed z-30 inset-y-0 left-0 w-64 bg-ink-700 text-ink-100 flex flex-col transform transition-transform duration-200 ease-in-out -translate-x-full lg:translate-x-0"
            :class="sidebarOpen && '!translate-x-0'"
        >
            <div class="h-20 flex items-center gap-3 px-6 border-b border-white/10">
                <span class="shrink-0 w-10 h-10 rounded-lg bg-mustard-400 flex items-center justify-center">
                    <svg class="w-5.5 h-5.5 text-ink-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 9h16l-1.4 9.8A2 2 0 0 1 16.62 20.6H7.38a2 2 0 0 1-1.98-1.8L4 9Z"/>
                        <path d="M8 9V6.5a4 4 0 0 1 8 0V9"/>
                        <path d="M9 13v4M12 13v4M15 13v4"/>
                    </svg>
                </span>
                <div>
                    <p class="font-display font-semibold text-lg leading-tight text-white">Kelontong.id</p>
                    <p class="text-[11px] uppercase tracking-widest text-mustard-300">Kelontong &amp; Kasir</p>
                </div>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'dashboard', 'is' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z'],
                        ['route' => 'kategori.index', 'is' => 'kategori.*', 'label' => 'Kategori', 'icon' => 'M4 6h16M4 12h16M4 18h7'],
                        ['route' => 'supplier.index', 'is' => 'supplier.*', 'label' => 'Supplier', 'icon' => 'M3 7h13l3 5v6h-2m-14 0H3V7Zm0 11a2 2 0 1 0 4 0 2 2 0 0 0-4 0Zm10 0a2 2 0 1 0 4 0 2 2 0 0 0-4 0Z'],
                        ['route' => 'produk.index', 'is' => 'produk.*', 'label' => 'Produk', 'icon' => 'M20 7l-8-4-8 4m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['route' => 'transaksi.index', 'is' => 'transaksi.*', 'label' => 'Transaksi', 'icon' => 'M9 14l2 2 4-4m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    @php $active = request()->routeIs($item['is']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                              {{ $active ? 'bg-mustard-400 text-ink-800' : 'text-ink-100 hover:bg-white/5 hover:text-mustard-200' }}">
                        <svg class="w-4.5 h-4.5 shrink-0 {{ $active ? 'text-ink-800' : 'text-ink-300 group-hover:text-mustard-300' }}"
                             width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="{{ $item['icon'] }}" />
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="px-6 py-5 border-t border-white/10 text-[11px] text-ink-300">
                <p>&copy; {{ date('Y') }} Kelontong.id</p>
                <p>Catat setiap barang, tiap rupiah.</p>
            </div>
        </aside>

        <!-- Overlay (mobile) -->
        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-ink-900/50 lg:hidden"></div>

        <!-- Main -->
        <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
            <header class="sticky top-0 z-10 bg-paper/90 backdrop-blur border-b border-ink-100 px-4 sm:px-8 py-4 flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-ink-600 -ml-1 p-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="min-w-0">
                    <p class="text-[11px] uppercase tracking-widest text-mustard-600 font-semibold">@yield('eyebrow', 'Kelontong.id')</p>
                    <h1 class="font-display text-xl sm:text-2xl font-semibold text-ink-700 truncate">@yield('title', 'Dashboard')</h1>
                </div>
            </header>

            <main class="flex-1 px-4 sm:px-8 py-6 sm:py-8">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-cloak
                         class="mb-5 flex items-start gap-3 rounded-lg border border-leaf-300/60 bg-leaf-50 px-4 py-3 text-sm text-leaf-600 shadow-paper">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <p class="flex-1">{{ session('success') }}</p>
                        <button @click="show = false" class="text-leaf-500/70 hover:text-leaf-600">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-cloak
                         class="mb-5 flex items-start gap-3 rounded-lg border border-clay-300/60 bg-clay-50 px-4 py-3 text-sm text-clay-600 shadow-paper">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4m0 4h.01M10.3 3.86l-8.2 14.2A1.5 1.5 0 0 0 3.5 20h17a1.5 1.5 0 0 0 1.4-2L13.7 3.86a1.5 1.5 0 0 0-2.6 0Z"/></svg>
                        <ul class="flex-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button @click="show = false" class="text-clay-500/70 hover:text-clay-600">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
</body>
</html>
