<?php
// ============================================================
// Subclass PendaftaranReguler (extends Pendaftaran)
// Tahap 4 : Implementasi Pewarisan (Inheritance)
// Proyek  : Simulasi PBO - Sistem Penerimaan Mahasiswa Baru
// Author  : Afif Nur Faizin
// ============================================================

require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran
{
    // ---------------------------------------------------------
    // Properti Tambahan Jalur Reguler
    // ---------------------------------------------------------
    protected $pilihanProdi;
    protected $lokasiKampus;

    // ---------------------------------------------------------
    // Constructor: Mewarisi constructor parent + atribut tambahan
    // ---------------------------------------------------------
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->pilihanProdi = $data['pilihan_prodi'] ?? null;
        $this->lokasiKampus = $data['lokasi_kampus'] ?? null;
    }

    // ---------------------------------------------------------
    // Getter Tambahan
    // ---------------------------------------------------------
    public function getPilihanProdi()
    {
        return $this->pilihanProdi;
    }

    public function getLokasiKampus()
    {
        return $this->lokasiKampus;
    }

    // ---------------------------------------------------------
    // Metode Spesifik: Query data jalur Reguler dari database
    // ---------------------------------------------------------
    public function getDaftarReguler($db)
    {
        $stmt = $db->prepare("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ---------------------------------------------------------
    // Implementasi Abstract Method (Tahap 5)
    // ---------------------------------------------------------
    public function hitungTotalBiaya()
    {
        // TODO: Akan diimplementasikan di Tahap 5
    }

    public function tampilkanInfoJalur()
    {
        // TODO: Akan diimplementasikan di Tahap 5
    }
}
