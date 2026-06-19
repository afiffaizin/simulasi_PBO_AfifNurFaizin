<?php
// ============================================================
// TAHAP 6: Dashboard Penerimaan Mahasiswa Baru (PMB)
// Entry Point — index.php (Sidebar Layout + Chart.js)
// Proyek  : Simulasi PBO - Sistem PMB
// Author  : Afif Nur Faizin
// ============================================================

// --- Koneksi Database ---
require_once __DIR__ . '/config/koneksi.php';

// --- Load Models (OOP) ---
require_once __DIR__ . '/models/Pendaftaran.php';
require_once __DIR__ . '/models/PendaftaranReguler.php';
require_once __DIR__ . '/models/PendaftaranPrestasi.php';
require_once __DIR__ . '/models/PendaftaranKedinasan.php';

// --- Ambil Data menggunakan metode OOP (Tahap 4) ---
$reguler   = new PendaftaranReguler();
$prestasi  = new PendaftaranPrestasi();
$kedinasan = new PendaftaranKedinasan();

$dataReguler   = $reguler->getDaftarReguler($db);
$dataPrestasi  = $prestasi->getDaftarPrestasi($db);
$dataKedinasan = $kedinasan->getDaftarKedinasan($db);

// --- Hitung Statistik ---
$totalPendaftar = count($dataReguler) + count($dataPrestasi) + count($dataKedinasan);
$countReguler   = count($dataReguler);
$countPrestasi  = count($dataPrestasi);
$countKedinasan = count($dataKedinasan);

// --- Hitung rata-rata nilai per jalur ---
$avgNilaiReguler   = $countReguler > 0   ? array_sum(array_column($dataReguler, 'nilai_ujian')) / $countReguler : 0;
$avgNilaiPrestasi  = $countPrestasi > 0  ? array_sum(array_column($dataPrestasi, 'nilai_ujian')) / $countPrestasi : 0;
$avgNilaiKedinasan = $countKedinasan > 0 ? array_sum(array_column($dataKedinasan, 'nilai_ujian')) / $countKedinasan : 0;

// --- Hitung biaya per jalur (menggunakan OOP / Polimorfisme) ---
$biayaReguler   = 0;
$biayaPrestasi  = 0;
$biayaKedinasan = 0;

foreach ($dataReguler as $row) {
    $obj = new PendaftaranReguler($row);
    $biayaReguler += $obj->hitungTotalBiaya();
}
foreach ($dataPrestasi as $row) {
    $obj = new PendaftaranPrestasi($row);
    $biayaPrestasi += $obj->hitungTotalBiaya();
}
foreach ($dataKedinasan as $row) {
    $obj = new PendaftaranKedinasan($row);
    $biayaKedinasan += $obj->hitungTotalBiaya();
}

$totalBiaya = $biayaReguler + $biayaPrestasi + $biayaKedinasan;

// --- Header ---
require_once __DIR__ . '/views/partials/header.php';

// --- Sidebar ---
require_once __DIR__ . '/views/partials/sidebar.php';
?>

    <!-- ============================================ -->
    <!-- MAIN CONTENT (Right of Sidebar) -->
    <!-- ============================================ -->
    <div class="main-content lg:ml-64 min-h-screen">

        <!-- Top Bar -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 no-print">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h2 id="pageTitle" class="text-lg font-bold text-slate-800">Dashboard Overview</h2>
                        <p class="text-xs text-slate-400"><?= date('l, d F Y') ?></p>
                    </div>
                </div>

                <!-- Search -->
                <div class="relative hidden sm:block w-72">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input id="searchInput" type="text" placeholder="Cari data pendaftar..."
                        oninput="filterTable(this.value)"
                        class="search-glow w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary-400 focus:bg-white transition-all duration-200">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-6">

            <!-- ============================================ -->
            <!-- SECTION: DASHBOARD (Stat Cards + Charts) -->
            <!-- ============================================ -->
            <div id="section-dashboard" class="content-section">

                <!-- Stat Cards Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                    <!-- Total Pendaftar -->
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-slate-100 cursor-default">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pendaftar</p>
                                <p class="text-3xl font-extrabold text-slate-800" data-count="<?= $totalPendaftar ?>">0</p>
                                <p class="text-xs text-slate-400 mt-1">Seluruh jalur</p>
                            </div>
                            <div class="w-11 h-11 bg-primary-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Reguler -->
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-slate-100 cursor-pointer" onclick="showSection('reguler')">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Jalur Reguler</p>
                                <p class="text-3xl font-extrabold text-primary-600" data-count="<?= $countReguler ?>">0</p>
                                <p class="text-xs text-slate-400 mt-1">Biaya: Rp <?= number_format($biayaReguler, 0, ',', '.') ?></p>
                            </div>
                            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi -->
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-slate-100 cursor-pointer" onclick="showSection('prestasi')">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Jalur Prestasi</p>
                                <p class="text-3xl font-extrabold text-amber-500" data-count="<?= $countPrestasi ?>">0</p>
                                <p class="text-xs text-slate-400 mt-1">Biaya: Rp <?= number_format($biayaPrestasi, 0, ',', '.') ?></p>
                            </div>
                            <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kedinasan -->
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-slate-100 cursor-pointer" onclick="showSection('kedinasan')">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Jalur Kedinasan</p>
                                <p class="text-3xl font-extrabold text-emerald-500" data-count="<?= $countKedinasan ?>">0</p>
                                <p class="text-xs text-slate-400 mt-1">Biaya: Rp <?= number_format($biayaKedinasan, 0, ',', '.') ?></p>
                            </div>
                            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Biaya Banner -->
                <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 rounded-2xl p-6 mb-8 text-white shadow-lg shadow-primary-500/20">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-primary-200 mb-1">Total Pendapatan Biaya Pendaftaran</p>
                            <p class="text-3xl font-extrabold">Rp <?= number_format($totalBiaya, 0, ',', '.') ?></p>
                            <p class="text-xs text-primary-300 mt-1">Dihitung secara otomatis melalui metode polimorfik hitungTotalBiaya()</p>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <div class="bg-white/15 backdrop-blur-sm rounded-xl px-4 py-2.5 text-center">
                                <p class="text-xs text-primary-200">Reguler</p>
                                <p class="font-bold">Rp <?= number_format($biayaReguler, 0, ',', '.') ?></p>
                            </div>
                            <div class="bg-white/15 backdrop-blur-sm rounded-xl px-4 py-2.5 text-center">
                                <p class="text-xs text-primary-200">Prestasi</p>
                                <p class="font-bold">Rp <?= number_format($biayaPrestasi, 0, ',', '.') ?></p>
                            </div>
                            <div class="bg-white/15 backdrop-blur-sm rounded-xl px-4 py-2.5 text-center">
                                <p class="text-xs text-primary-200">Kedinasan</p>
                                <p class="font-bold">Rp <?= number_format($biayaKedinasan, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                    <!-- Doughnut Chart: Distribusi Jalur -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-sm font-bold text-slate-700 mb-1">Distribusi Pendaftar</h3>
                        <p class="text-xs text-slate-400 mb-4">Perbandingan jumlah per jalur</p>
                        <div class="chart-container" style="height: 260px;">
                            <canvas id="chartDistribusi"
                                data-reguler="<?= $countReguler ?>"
                                data-prestasi="<?= $countPrestasi ?>"
                                data-kedinasan="<?= $countKedinasan ?>">
                            </canvas>
                        </div>
                    </div>

                    <!-- Bar Chart: Rata-rata Nilai -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-sm font-bold text-slate-700 mb-1">Rata-rata Nilai Ujian</h3>
                        <p class="text-xs text-slate-400 mb-4">Perbandingan rata-rata per jalur</p>
                        <div class="chart-container" style="height: 260px;">
                            <canvas id="chartNilai"
                                data-reguler="<?= round($avgNilaiReguler, 2) ?>"
                                data-prestasi="<?= round($avgNilaiPrestasi, 2) ?>"
                                data-kedinasan="<?= round($avgNilaiKedinasan, 2) ?>">
                            </canvas>
                        </div>
                    </div>

                    <!-- Horizontal Bar Chart: Total Biaya -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-sm font-bold text-slate-700 mb-1">Total Biaya per Jalur</h3>
                        <p class="text-xs text-slate-400 mb-4">Hasil kalkulasi OOP polimorfik</p>
                        <div class="chart-container" style="height: 260px;">
                            <canvas id="chartBiaya"
                                data-reguler="<?= $biayaReguler ?>"
                                data-prestasi="<?= $biayaPrestasi ?>"
                                data-kedinasan="<?= $biayaKedinasan ?>">
                            </canvas>
                        </div>
                    </div>
                </div>

                <!-- Info Biaya Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Reguler -->
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-3 h-3 bg-primary-500 rounded-full"></div>
                            <h4 class="text-sm font-bold text-slate-700">Jalur Reguler</h4>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between text-slate-500">
                                <span>Biaya Dasar</span>
                                <span class="font-semibold text-slate-700">Rp 500.000</span>
                            </div>
                            <div class="flex justify-between text-slate-500">
                                <span>Potongan / Tambahan</span>
                                <span class="font-semibold text-slate-500">—</span>
                            </div>
                            <div class="border-t border-slate-100 pt-2 flex justify-between">
                                <span class="font-bold text-slate-700">Total Biaya</span>
                                <span class="font-extrabold text-primary-600">Rp 500.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi -->
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                            <h4 class="text-sm font-bold text-slate-700">Jalur Prestasi</h4>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between text-slate-500">
                                <span>Biaya Dasar</span>
                                <span class="font-semibold text-slate-700">Rp 500.000</span>
                            </div>
                            <div class="flex justify-between text-slate-500">
                                <span>Potongan Prestasi</span>
                                <span class="font-semibold text-emerald-500">- Rp 50.000</span>
                            </div>
                            <div class="border-t border-slate-100 pt-2 flex justify-between">
                                <span class="font-bold text-slate-700">Total Biaya</span>
                                <span class="font-extrabold text-amber-600">Rp 450.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kedinasan -->
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <h4 class="text-sm font-bold text-slate-700">Jalur Kedinasan</h4>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between text-slate-500">
                                <span>Biaya Dasar</span>
                                <span class="font-semibold text-slate-700">Rp 500.000</span>
                            </div>
                            <div class="flex justify-between text-slate-500">
                                <span>Surcharge 25%</span>
                                <span class="font-semibold text-red-400">+ Rp 125.000</span>
                            </div>
                            <div class="border-t border-slate-100 pt-2 flex justify-between">
                                <span class="font-bold text-slate-700">Total Biaya</span>
                                <span class="font-extrabold text-emerald-600">Rp 625.000</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- End section-dashboard -->

            <!-- ============================================ -->
            <!-- SECTION: Tabel Data (Reguler/Prestasi/Kedinasan) -->
            <!-- ============================================ -->
            <?php require_once __DIR__ . '/views/tabel_reguler.php'; ?>
            <?php require_once __DIR__ . '/views/tabel_prestasi.php'; ?>
            <?php require_once __DIR__ . '/views/tabel_kedinasan.php'; ?>

        </div><!-- End p-6 -->

<?php
// --- Footer ---
require_once __DIR__ . '/views/partials/footer.php';
?>
