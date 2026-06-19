    <!-- Footer -->
    <footer class="mt-12 border-t border-slate-100 bg-white/50">
        <div class="px-6 py-6">
            <div class="flex items-center justify-center">
                <p class="text-xs text-slate-400">
                    &copy; <?= date('Y') ?> <span class="font-semibold text-slate-500">Afif Nur Faizin</span> — Simulasi PBO TRPL
                </p>
            </div>
        </div>
    </footer>


    </div><!-- End main-content -->

    <!-- ============================================ -->
    <!-- JAVASCRIPT -->
    <!-- ============================================ -->
    <script>
        // =============================================
        // Sidebar Toggle (Mobile)
        // =============================================
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // =============================================
        // Section Switching (Dashboard / Tables)
        // =============================================
        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(el => {
                el.classList.add('hidden');
            });

            // Show selected section
            const section = document.getElementById('section-' + sectionName);
            if (section) {
                section.classList.remove('hidden');
                section.classList.add('animate-fade-in');
            }

            // Update nav active state
            document.querySelectorAll('.nav-item').forEach(el => {
                el.classList.remove('nav-item-active', 'text-white');
                el.classList.add('text-white/70');
            });
            const navItem = document.getElementById('nav-' + sectionName);
            if (navItem) {
                navItem.classList.add('nav-item-active', 'text-white');
                navItem.classList.remove('text-white/70');
            }

            // Update page title
            const titles = {
                'dashboard': 'Dashboard Overview',
                'reguler': 'Data Jalur Reguler',
                'prestasi': 'Data Jalur Prestasi',
                'kedinasan': 'Data Jalur Kedinasan',
            };
            const pageTitle = document.getElementById('pageTitle');
            if (pageTitle && titles[sectionName]) {
                pageTitle.textContent = titles[sectionName];
            }

            // Close mobile sidebar
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            // Clear search
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = '';
                filterTable('');
            }
        }

        // =============================================
        // Search / Filter Table
        // =============================================
        function filterTable(query) {
            const activeSection = document.querySelector('.content-section:not(.hidden)');
            if (!activeSection) return;

            const rows = activeSection.querySelectorAll('tbody tr');
            const q = query.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const match = text.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            const emptyState = activeSection.querySelector('.empty-search-state');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        // =============================================
        // Animated Counter
        // =============================================
        function animateCounters() {
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count);
                const duration = 1200;
                const start = performance.now();

                function update(now) {
                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(target * eased).toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(update);
                }
                requestAnimationFrame(update);
            });
        }

        // =============================================
        // Sortable Columns
        // =============================================
        function sortTable(tableId, colIndex, type = 'string') {
            const table = document.getElementById(tableId);
            if (!table) return;

            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const currentDir = table.dataset.sortDir === 'asc' ? 'desc' : 'asc';
            table.dataset.sortDir = currentDir;

            rows.sort((a, b) => {
                let aVal = a.cells[colIndex]?.textContent.trim() || '';
                let bVal = b.cells[colIndex]?.textContent.trim() || '';

                if (type === 'number') {
                    aVal = parseFloat(aVal.replace(/[^0-9.-]/g, '')) || 0;
                    bVal = parseFloat(bVal.replace(/[^0-9.-]/g, '')) || 0;
                }
                if (currentDir === 'asc') return aVal > bVal ? 1 : aVal < bVal ? -1 : 0;
                return aVal < bVal ? 1 : aVal > bVal ? -1 : 0;
            });

            rows.forEach(row => tbody.appendChild(row));

            table.querySelectorAll('.sort-icon').forEach(icon => {
                icon.textContent = '↕';
                icon.classList.remove('text-primary-600');
                icon.classList.add('text-slate-300');
            });
            const activeIcon = table.querySelector(`.sort-icon[data-col="${colIndex}"]`);
            if (activeIcon) {
                activeIcon.textContent = currentDir === 'asc' ? '↑' : '↓';
                activeIcon.classList.add('text-primary-600');
                activeIcon.classList.remove('text-slate-300');
            }
        }

        // =============================================
        // Export CSV
        // =============================================
        function exportCSV(tableId, filename) {
            const table = document.getElementById(tableId);
            if (!table) return;
            let csv = [];
            table.querySelectorAll('tr').forEach(row => {
                const cols = row.querySelectorAll('th, td');
                const rowData = Array.from(cols).map(col => '"' + col.textContent.trim().replace(/"/g, '""') + '"');
                csv.push(rowData.join(','));
            });
            const blob = new Blob([csv.join('\n')], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = filename + '.csv';
            link.click();
        }

        // =============================================
        // Chart.js — Initialization
        // =============================================
        function initCharts() {
            const chartColors = {
                blue: {
                    bg: 'rgba(59, 130, 246, 0.15)',
                    border: '#3b82f6',
                    solid: '#3b82f6'
                },
                amber: {
                    bg: 'rgba(245, 158, 11, 0.15)',
                    border: '#f59e0b',
                    solid: '#f59e0b'
                },
                emerald: {
                    bg: 'rgba(16, 185, 129, 0.15)',
                    border: '#10b981',
                    solid: '#10b981'
                },
            };

            // --- Doughnut Chart: Distribusi Jalur ---
            const doughnutCtx = document.getElementById('chartDistribusi');
            if (doughnutCtx) {
                new Chart(doughnutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Reguler', 'Prestasi', 'Kedinasan'],
                        datasets: [{
                            data: [
                                parseInt(doughnutCtx.dataset.reguler),
                                parseInt(doughnutCtx.dataset.prestasi),
                                parseInt(doughnutCtx.dataset.kedinasan)
                            ],
                            backgroundColor: [chartColors.blue.solid, chartColors.amber.solid, chartColors.emerald.solid],
                            borderWidth: 0,
                            hoverOffset: 8,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '72%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyleWidth: 10,
                                    font: {
                                        family: 'Inter',
                                        size: 12,
                                        weight: '500'
                                    },
                                    color: '#64748b',
                                }
                            },
                            tooltip: {
                                backgroundColor: '#1e293b',
                                titleFont: {
                                    family: 'Inter',
                                    weight: '600'
                                },
                                bodyFont: {
                                    family: 'Inter'
                                },
                                cornerRadius: 10,
                                padding: 12,
                                callbacks: {
                                    label: function(ctx) {
                                        const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                        const pct = ((ctx.parsed / total) * 100).toFixed(1);
                                        return ` ${ctx.label}: ${ctx.parsed} pendaftar (${pct}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // --- Bar Chart: Rata-Rata Nilai Ujian ---
            const barCtx = document.getElementById('chartNilai');
            if (barCtx) {
                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Reguler', 'Prestasi', 'Kedinasan'],
                        datasets: [{
                            label: 'Rata-rata Nilai',
                            data: [
                                parseFloat(barCtx.dataset.reguler),
                                parseFloat(barCtx.dataset.prestasi),
                                parseFloat(barCtx.dataset.kedinasan)
                            ],
                            backgroundColor: [chartColors.blue.bg, chartColors.amber.bg, chartColors.emerald.bg],
                            borderColor: [chartColors.blue.border, chartColors.amber.border, chartColors.emerald.border],
                            borderWidth: 2,
                            borderRadius: 10,
                            barPercentage: 0.6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 60,
                                max: 100,
                                grid: {
                                    color: '#f1f5f9'
                                },
                                ticks: {
                                    font: {
                                        family: 'Inter',
                                        size: 11
                                    },
                                    color: '#94a3b8',
                                    callback: val => val.toFixed(0),
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: 'Inter',
                                        size: 12,
                                        weight: '500'
                                    },
                                    color: '#64748b',
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e293b',
                                titleFont: {
                                    family: 'Inter',
                                    weight: '600'
                                },
                                bodyFont: {
                                    family: 'Inter'
                                },
                                cornerRadius: 10,
                                padding: 12,
                                callbacks: {
                                    label: ctx => ` Rata-rata: ${ctx.parsed.y.toFixed(2)}`
                                }
                            }
                        }
                    }
                });
            }

            // --- Horizontal Bar Chart: Perbandingan Biaya ---
            const biayaCtx = document.getElementById('chartBiaya');
            if (biayaCtx) {
                new Chart(biayaCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Reguler', 'Prestasi', 'Kedinasan'],
                        datasets: [{
                            label: 'Total Biaya (Rp)',
                            data: [
                                parseInt(biayaCtx.dataset.reguler),
                                parseInt(biayaCtx.dataset.prestasi),
                                parseInt(biayaCtx.dataset.kedinasan)
                            ],
                            backgroundColor: [chartColors.blue.solid, chartColors.amber.solid, chartColors.emerald.solid],
                            borderWidth: 0,
                            borderRadius: 8,
                            barPercentage: 0.5,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    color: '#f1f5f9'
                                },
                                ticks: {
                                    font: {
                                        family: 'Inter',
                                        size: 11
                                    },
                                    color: '#94a3b8',
                                    callback: val => 'Rp ' + val.toLocaleString('id-ID'),
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: 'Inter',
                                        size: 12,
                                        weight: '500'
                                    },
                                    color: '#64748b',
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e293b',
                                titleFont: {
                                    family: 'Inter',
                                    weight: '600'
                                },
                                bodyFont: {
                                    family: 'Inter'
                                },
                                cornerRadius: 10,
                                padding: 12,
                                callbacks: {
                                    label: ctx => ` Rp ${ctx.parsed.x.toLocaleString('id-ID')}`
                                }
                            }
                        }
                    }
                });
            }
        }

        // =============================================
        // Init on DOM Ready
        // =============================================
        document.addEventListener('DOMContentLoaded', () => {
            animateCounters();
            initCharts();
            showSection('dashboard');
        });
    </script>
    </body>

    </html>