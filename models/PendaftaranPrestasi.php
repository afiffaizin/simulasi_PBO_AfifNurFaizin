<?php
// ============================================================
// Subclass PendaftaranPrestasi (extends Pendaftaran)
// Tahap 4 : Implementasi Pewarisan (Inheritance)
// Proyek  : Simulasi PBO - Sistem Penerimaan Mahasiswa Baru
// Author  : Afif Nur Faizin
// ============================================================

require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran
{
    // ---------------------------------------------------------
    // Properti Tambahan Jalur Prestasi
    // ---------------------------------------------------------
    protected $jenisPrestasi;
    protected $tingkatPrestasi;

    // ---------------------------------------------------------
    // Constructor: Mewarisi constructor parent + atribut tambahan
    // ---------------------------------------------------------
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->jenisPrestasi   = $data['jenis_prestasi'] ?? null;
        $this->tingkatPrestasi = $data['tingkat_prestasi'] ?? null;
    }

    // ---------------------------------------------------------
    // Getter Tambahan
    // ---------------------------------------------------------
    public function getJenisPrestasi()
    {
        return $this->jenisPrestasi;
    }

    public function getTingkatPrestasi()
    {
        return $this->tingkatPrestasi;
    }

    // ---------------------------------------------------------
    // Metode Spesifik: Query data jalur Prestasi dari database
    // ---------------------------------------------------------
    public function getDaftarPrestasi($db)
    {
        $stmt = $db->prepare("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ---------------------------------------------------------
    // Override: hitungTotalBiaya() — Tahap 5 (Polimorfisme)
    // Prestasi = Biaya Pendaftaran Dasar - Rp 50.000
    // (Mendapat potongan apresiasi prestasi)
    // ---------------------------------------------------------
    public function hitungTotalBiaya()
    {
        return $this->biayaPendaftaranDasar - 50000;
    }

    // ---------------------------------------------------------
    // Override: tampilkanInfoJalur() — Tahap 5 (Polimorfisme)
    // ---------------------------------------------------------
    public function tampilkanInfoJalur()
    {
        return "Jalur Prestasi | Jenis: {$this->jenisPrestasi} | Tingkat: {$this->tingkatPrestasi}";
    }
}
