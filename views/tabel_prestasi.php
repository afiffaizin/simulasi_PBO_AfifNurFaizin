<?php
/**
 * Komponen Tabel Jalur Prestasi
 * Menampilkan data pendaftaran jalur Prestasi dengan metode OOP
 */
?>
<div id="section-prestasi" class="content-section hidden">
    <div class="animate-slide-up">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Data Pendaftar Jalur Prestasi</h2>
                    <p class="text-sm text-slate-400">Potongan apresiasi prestasi sebesar Rp 50.000</p>
                </div>
            </div>
            <button onclick="exportCSV('table-prestasi', 'data_jalur_prestasi')"
                class="no-print inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export CSV
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="table-prestasi" class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-500 to-amber-600 text-white">
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-prestasi', 0, 'number')">
                                No <span class="sort-icon text-amber-200 ml-1" data-col="0">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-prestasi', 1)">
                                Nama Calon <span class="sort-icon text-amber-200 ml-1" data-col="1">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-prestasi', 2)">
                                Asal Sekolah <span class="sort-icon text-amber-200 ml-1" data-col="2">↕</span>
                            </th>
                            <th class="px-5 py-4 text-center font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-prestasi', 3, 'number')">
                                Nilai <span class="sort-icon text-amber-200 ml-1" data-col="3">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Jenis Prestasi</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Tingkat</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Info Jalur</th>
                            <th class="px-5 py-4 text-right font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-prestasi', 7, 'number')">
                                Total Biaya <span class="sort-icon text-amber-200 ml-1" data-col="7">↕</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (!empty($dataPrestasi)): ?>
                            <?php $no = 1; foreach ($dataPrestasi as $row):
                                $obj = new PendaftaranPrestasi($row);
                            ?>
                            <tr class="table-row-hover">
                                <td class="px-5 py-3.5 font-medium text-slate-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-xs shrink-0">
                                            <?= strtoupper(substr($row['nama_calon'], 0, 2)) ?>
                                        </div>
                                        <span class="font-semibold text-slate-800"><?= htmlspecialchars($row['nama_calon']) ?></span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-slate-600"><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold
                                        <?= $row['nilai_ujian'] >= 85 ? 'bg-emerald-50 text-emerald-700' : ($row['nilai_ujian'] >= 75 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') ?>">
                                        <?= number_format($row['nilai_ujian'], 2) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 text-slate-700">
                                        <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <?= htmlspecialchars($obj->getJenisPrestasi()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <?php
                                        $tingkat = $obj->getTingkatPrestasi();
                                        $badgeColor = match($tingkat) {
                                            'Internasional' => 'bg-purple-50 text-purple-700',
                                            'Nasional'      => 'bg-emerald-50 text-emerald-700',
                                            'Provinsi'      => 'bg-blue-50 text-blue-700',
                                            default         => 'bg-slate-100 text-slate-600',
                                        };
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badgeColor ?>">
                                        <?= htmlspecialchars($tingkat) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="text-xs text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg font-medium">
                                        <?= htmlspecialchars($obj->tampilkanInfoJalur()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <span class="font-bold text-slate-800">Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?></span>
                                    <div class="text-[11px] text-emerald-500 font-medium">- Rp 50.000</div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="px-5 py-16 text-center text-slate-400">Belum ada data pendaftar jalur Prestasi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="empty-search-state hidden px-5 py-12 text-center text-slate-400">Data tidak ditemukan.</div>
        </div>
    </div>
</div>
