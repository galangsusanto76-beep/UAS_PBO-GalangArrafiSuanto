<?php
// FILE: KaryawanKontrak.php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $durasi, $agensi) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_penyalur = $agensi;
    }

    // OVERRIDING: Penggajian murni berdasarkan kehadiran
    public function hitungGajiBersih() {
        return $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
    }

    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Kontrak]</h3>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}