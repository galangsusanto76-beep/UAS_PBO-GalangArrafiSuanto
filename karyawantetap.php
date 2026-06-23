<?php
// FILE: KaryawanTetap.php
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $tunjanganKes, $opsiSahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->tunjangan_kesehatan = $tunjanganKes;
        $this->opsi_saham_id = $opsiSahamId;
    }

    // OVERRIDING: Total Gaji Harian + Tunjangan Kesehatan
    public function hitungGajiBersih() {
        $gajiDasarTotal = $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
        return $gajiDasarTotal + $this->tunjangan_kesehatan;
    }

    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Tetap]</h3>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Tunjangan Kesehatan: Rp " . number_format($this->tunjangan_kesehatan, 0, ',', '.') . "<br>";
        echo "Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}