<?php
// FILE: KaryawanKontrak.php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    // Properti Tambahan Spesifik
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $durasi, $agensi) {
        // Meneruskan data ke constructor milik parent class (Karyawan)
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_penyalur = $agensi;
    }

    // Getter khusus untuk properti spesifik karyawan kontrak
    public function getDurasiKontrakBulan() { return $this->durasi_kontrak_bulan; }
    public function getAgensiPenyalur() { return $this->agensi_penyalur; }

    // Implementasi abstract method dari kelas induk
    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
    }

    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Kontrak]</h3>";
        echo "ID: {$this->id_karyawan}<br>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Agensi Penyalur: {$this->agensi_penyalur}<br>";
        echo "Durasi Kontrak: {$this->durasi_kontrak_bulan} Bulan<br>";
        echo "Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}