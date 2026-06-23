<?php
// index.php
require_once 'Karyawan.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanMagang.php';

// Membuat list karyawan heterogen dalam satu array
$daftarKaryawan = [
    new KaryawanKontrak(1, "Hendra", "IT", 20, 150000, 12, "PT Sumber Daya"),
    new KaryawanTetap(2, "Aditya", "HRD", 22, 200000, 500000, "SHM-01"),
    new KaryawanMagang(3, "Oki", "Marketing", 15, 100000, 0, true)
];

// POLIMORFISME: Mengambil total gaji bersih tanpa perlu tahu apa rumusnya di dalam
foreach ($daftarKaryawan as $karyawan) {
    echo "Karyawan: " . $karyawan->getNamaKaryawan() . " | ";
    echo "Gaji Bersih: Rp " . number_format($karyawan->hitungGajiBersih(), 0, ',', '.') . "<br>";
}
