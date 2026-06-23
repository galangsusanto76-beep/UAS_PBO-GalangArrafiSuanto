<?php
// index.php
require_once 'koneksi.php';
require_once 'Karyawan.php';       // Load Parent Class dulu
require_once 'KaryawanKontrak.php';// Load Sub-Class
require_once 'KaryawanTetap.php';  // Load Sub-Class
require_once 'KaryawanMagang.php'; // Load Sub-Class

// Sekarang Anda bisa membuat objek dari masing-masing kelas secara instan!
$karyawan1 = new KaryawanTetap(101, "Aditya", "IT", 22, 200000, 750000, "SHM-0092");
$karyawan1->tampilProfilKaryawan();