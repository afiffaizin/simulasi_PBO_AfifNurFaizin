<?php
// ============================================================
// Subclass PendaftaranKedinasan (extends Pendaftaran)
// Tahap 4 : Implementasi Pewarisan (Inheritance)
// Proyek  : Simulasi PBO - Sistem Penerimaan Mahasiswa Baru
// Author  : Afif Nur Faizin
// ============================================================

require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran
{
    // ---------------------------------------------------------
    // Properti Tambahan Jalur Kedinasan
    // ---------------------------------------------------------
    protected $skIkatanDinas;
    protected $instansiSponsor;

    // ---------------------------------------------------------
    // Constructor: Mewarisi constructor parent + atribut tambahan
    // ---------------------------------------------------------
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->skIkatanDinas   = $data['sk_ikatan_dinas'] ?? null;
        $this->instansiSponsor = $data['instansi_sponsor'] ?? null;
    }

    // ---------------------------------------------------------
    // Getter Tambahan
    // ---------------------------------------------------------
    public function getSkIkatanDinas()
    {
        return $this->skIkatanDinas;
    }

    public function getInstansiSponsor()
    {
        return $this->instansiSponsor;
    }

    // ---------------------------------------------------------
    // Metode Spesifik: Query data jalur Kedinasan dari database
    // ---------------------------------------------------------
    public function getDaftarKedinasan($db)
    {
        $stmt = $db->prepare("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ---------------------------------------------------------
    // Override: hitungTotalBiaya() — Tahap 5 (Polimorfisme)
    // Kedinasan = Biaya Pendaftaran Dasar + (25% dari Biaya Dasar)
    // (Dikenakan surcharge administrasi khusus instansi)
    // ---------------------------------------------------------
    public function hitungTotalBiaya()
    {
        return $this->biayaPendaftaranDasar + ($this->biayaPendaftaranDasar * 0.25);
    }

    // ---------------------------------------------------------
    // Override: tampilkanInfoJalur() — Tahap 5 (Polimorfisme)
    // ---------------------------------------------------------
    public function tampilkanInfoJalur()
    {
        return "Jalur Kedinasan | SK: {$this->skIkatanDinas} | Instansi: {$this->instansiSponsor}";
    }
}
