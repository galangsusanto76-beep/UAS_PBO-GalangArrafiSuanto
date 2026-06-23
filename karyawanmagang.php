<?php
// FILE: KaryawanMagang.php
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uang_saku_bulan; // Tetap dipertahankan jika ada benefit bulanan lain
    private $sertifikat_kampus_merdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $uangSaku, $sertifikatKM) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->uang_saku_bulan = $uangSaku;
        $this->sertifikat_kampus_merdeka = $sertifikatKM;
    }

    // OVERRIDING: Potongan upah harian sebesar 20% (dikali 0.80)
    public function hitungGajiBersih() {
        $gajiKotorHarian = $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
        return $gajiKotorHarian * 0.80;
    }

    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Magang]</h3>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Uang Saku Bersih (Setelah Potongan 20%): Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}