<?php
/**
 * Komponen Sidebar Navigation
 * Dashboard PMB — Navigasi utama
 *
 * Variabel berikut didefinisikan di index.php sebelum file ini di-include:
 * @var int $countReguler
 * @var int $countPrestasi
 * @var int $countKedinasan
 */
?>
<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/40 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-primary-900 via-primary-800 to-primary-950 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-y-auto no-print">

    <!-- Brand -->
    <div class="px-6 py-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="relative">
                <div class="w-10 h-10 bg-white/15 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-400 rounded-full border-2 border-primary-900 badge-pulse"></div>
            </div>
            <div>
                <h1 class="text-base font-bold text-white leading-tight">Sistem PMB</h1>
                <p class="text-[11px] text-primary-300">Penerimaan Mahasiswa Baru</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="px-3 py-4">
        <p class="px-3 mb-2 text-[10px] font-bold text-primary-400 uppercase tracking-widest">Menu Utama</p>

        <!-- Dashboard -->
        <button onclick="showSection('dashboard')"
            id="nav-dashboard"
            class="nav-item nav-item-active w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:bg-white/10 transition-all duration-200 mb-1 text-left">
            <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Dashboard
        </button>

        <p class="px-3 mt-5 mb-2 text-[10px] font-bold text-primary-400 uppercase tracking-widest">Data Pendaftar</p>

        <!-- Jalur Reguler -->
        <button onclick="showSection('reguler')"
            id="nav-reguler"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-all duration-200 mb-1 text-left">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Jalur Reguler
            <span class="ml-auto bg-blue-500/20 text-blue-300 text-xs font-bold px-2 py-0.5 rounded-md"><?= $countReguler ?></span>
        </button>

        <!-- Jalur Prestasi -->
        <button onclick="showSection('prestasi')"
            id="nav-prestasi"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-all duration-200 mb-1 text-left">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
            Jalur Prestasi
            <span class="ml-auto bg-amber-500/20 text-amber-300 text-xs font-bold px-2 py-0.5 rounded-md"><?= $countPrestasi ?></span>
        </button>

        <!-- Jalur Kedinasan -->
        <button onclick="showSection('kedinasan')"
            id="nav-kedinasan"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-all duration-200 mb-1 text-left">
            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Jalur Kedinasan
            <span class="ml-auto bg-emerald-500/20 text-emerald-300 text-xs font-bold px-2 py-0.5 rounded-md"><?= $countKedinasan ?></span>
        </button>
    </nav>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-primary-950/50">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-gradient-to-br from-primary-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-lg">
                AF
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">Afif Nur Faizin</p>
                <p class="text-[11px] text-primary-400">TRPL — Simulasi PBO</p>
            </div>
        </div>
    </div>
</aside>
