<?php
// ============================================================
// Abstract Class Pendaftaran (Super Class)
// Tahap 3 : Implementasi Abstraksi (Abstraction)
// Proyek  : Simulasi PBO - Sistem Penerimaan Mahasiswa Baru
// Author  : Afif Nur Faizin
// ============================================================

abstract class Pendaftaran
{
    // ---------------------------------------------------------
    // Atribut Terenkapsulasi (protected)
    // Dapat diakses oleh subclass, namun aman dari akses luar
    // ---------------------------------------------------------
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    // ---------------------------------------------------------
    // Constructor: Inisialisasi properti dari data array
    // ---------------------------------------------------------
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id_pendaftaran       = $data['id_pendaftaran'] ?? null;
            $this->nama_calon           = $data['nama_calon'] ?? null;
            $this->asal_sekolah         = $data['asal_sekolah'] ?? null;
            $this->nilai_ujian          = $data['nilai_ujian'] ?? null;
            $this->biayaPendaftaranDasar = $data['biaya_pendaftaran_dasar'] ?? null;
        }
    }

    // ---------------------------------------------------------
    // Getter Methods (Encapsulation)
    // ---------------------------------------------------------
    public function getIdPendaftaran()
    {
        return $this->id_pendaftaran;
    }

    public function getNamaCalon()
    {
        return $this->nama_calon;
    }

    public function getAsalSekolah()
    {
        return $this->asal_sekolah;
    }

    public function getNilaiUjian()
    {
        return $this->nilai_ujian;
    }

    public function getBiayaPendaftaranDasar()
    {
        return $this->biayaPendaftaranDasar;
    }

    // ---------------------------------------------------------
    // Metode Abstrak (Wajib di-override oleh subclass)
    // ---------------------------------------------------------

    /**
     * Menghitung total biaya pendaftaran.
     * Logika perhitungan berbeda-beda di setiap jalur (Polimorfisme).
     * @return int Total biaya pendaftaran
     */
    abstract public function hitungTotalBiaya();

    /**
     * Menampilkan informasi spesifik dari jalur pendaftaran.
     * @return string Informasi jalur pendaftaran
     */
    abstract public function tampilkanInfoJalur();
}
