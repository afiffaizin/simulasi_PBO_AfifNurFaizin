<?php
/**
 * Komponen Tabel Jalur Kedinasan
 * Menampilkan data pendaftaran jalur Kedinasan dengan metode OOP
 */
?>
<div id="section-kedinasan" class="content-section hidden">
    <div class="animate-slide-up">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Data Pendaftar Jalur Kedinasan</h2>
                    <p class="text-sm text-slate-400">Surcharge administrasi 25% dari biaya dasar</p>
                </div>
            </div>
            <button onclick="exportCSV('table-kedinasan', 'data_jalur_kedinasan')"
                class="no-print inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export CSV
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="table-kedinasan" class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white">
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-kedinasan', 0, 'number')">
                                No <span class="sort-icon text-emerald-200 ml-1" data-col="0">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-kedinasan', 1)">
                                Nama Calon <span class="sort-icon text-emerald-200 ml-1" data-col="1">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-kedinasan', 2)">
                                Asal Sekolah <span class="sort-icon text-emerald-200 ml-1" data-col="2">↕</span>
                            </th>
                            <th class="px-5 py-4 text-center font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-kedinasan', 3, 'number')">
                                Nilai <span class="sort-icon text-emerald-200 ml-1" data-col="3">↕</span>
                            </th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">SK Ikatan Dinas</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Instansi Sponsor</th>
                            <th class="px-5 py-4 text-left font-semibold whitespace-nowrap">Info Jalur</th>
                            <th class="px-5 py-4 text-right font-semibold cursor-pointer select-none whitespace-nowrap" onclick="sortTable('table-kedinasan', 7, 'number')">
                                Total Biaya <span class="sort-icon text-emerald-200 ml-1" data-col="7">↕</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (!empty($dataKedinasan)): ?>
                            <?php $no = 1; foreach ($dataKedinasan as $row):
                                $obj = new PendaftaranKedinasan($row);
                            ?>
                            <tr class="table-row-hover">
                                <td class="px-5 py-3.5 font-medium text-slate-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs shrink-0">
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
                                    <span class="inline-flex items-center gap-1.5 font-mono text-xs bg-slate-50 text-slate-700 px-2.5 py-1 rounded-lg">
                                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <?= htmlspecialchars($obj->getSkIkatanDinas()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700">
                                        <?= htmlspecialchars($obj->getInstansiSponsor()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg font-medium">
                                        <?= htmlspecialchars($obj->tampilkanInfoJalur()) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <span class="font-bold text-slate-800">Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?></span>
                                    <div class="text-[11px] text-red-400 font-medium">+ Surcharge 25%</div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="px-5 py-16 text-center text-slate-400">Belum ada data pendaftar jalur Kedinasan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="empty-search-state hidden px-5 py-12 text-center text-slate-400">Data tidak ditemukan.</div>
        </div>
    </div>
</div>
