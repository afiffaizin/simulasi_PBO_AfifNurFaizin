<?php
// ============================================================
// Koneksi Database menggunakan PDO
// Proyek  : Simulasi PBO - Sistem Penerimaan Mahasiswa Baru
// Author  : Afif Nur Faizin
// ============================================================

$host     = 'localhost';
$dbname   = 'DB_SIMULASI_PBO_TRPL_AfifNurFaizin';
$username = 'root';
$password = '';
$charset  = 'utf8mb4';

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $db = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
