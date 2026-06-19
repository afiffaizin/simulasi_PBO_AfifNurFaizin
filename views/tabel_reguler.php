<?php
/**
 * Komponen Tabel Jalur Reguler
 * Menampilkan data pendaftaran jalur Reguler dengan metode OOP
 */
?>
<div id="section-reguler" class="content-section hidden">
    <div class="animate-slide-up">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Data Pendaftar Jalur Reguler</h2>
                    <p class="text-sm text-slate-400">Tarif standar murni — tanpa biaya tambahan/potongan</p>
                </div>
            </div>
            <button onclick="exportCSV('table-reguler', 'data_jalur_reguler')"
                class="no-print inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-primary-50 hover:text-primary-600 hover:border-primary-200 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export CSV
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="table-reguler" class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-reguler', 0, 'number')">
                                No <span class="sort-icon text-primary-200 ml-1" data-col="0">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-reguler', 1)">
                                Nama Calon <span class="sort-icon text-primary-200 ml-1" data-col="1">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-reguler', 2)">
                                Asal Sekolah <span class="sort-icon text-primary-200 ml-1" data-col="2">↕</span>
                            </th>
                            <th class="px-5 py-4 text-center font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-reguler', 3, 'number')">
                                Nilai <span class="sort-icon text-primary-200 ml-1" data-col="3">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Pilihan Prodi</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Lokasi Kampus</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Info Jalur</th>
                            <th class="px-5 py-4 text-right font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-reguler', 7, 'number')">
                                Total Biaya <span class="sort-icon text-primary-200 ml-1" data-col="7">↕</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (!empty($dataReguler)): ?>
                            <?php $no = 1; foreach ($dataReguler as $row):
                                $obj = new PendaftaranReguler($row);
                            ?>
                            <tr class="table-row-hover">
                                <td class="px-5 py-3.5 font-medium text-slate-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-xs shrink-0">
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
                                <td class="px-5 py-3.5 text-slate-600"><?= htmlspecialchars($obj->getPilihanProdi()) ?></td>
                                <td class="px-5 py-3.5 text-slate-600"><?= htmlspecialchars($obj->getLokasiKampus()) ?></td>
                                <td class="px-5 py-3.5">
                                    <span class="text-xs text-primary-600 bg-primary-50 px-2.5 py-1 rounded-lg font-medium">
                                        <?= htmlspecialchars($obj->tampilkanInfoJalur()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right font-bold text-slate-800">
                                    Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="px-5 py-16 text-center text-slate-400">Belum ada data pendaftar jalur Reguler.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="empty-search-state hidden px-5 py-12 text-center text-slate-400">Data tidak ditemukan.</div>
        </div>
    </div>
</div>
