<?php
// FILE: KaryawanTetap.php
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Properti Tambahan Spesifik
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $tunjanganKes, $opsiSahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->tunjangan_kesehatan = $tunjanganKes;
        $this->opsi_saham_id = $opsiSahamId;
    }

    // Getter khusus untuk properti spesifik karyawan tetap
    public function getTunjanganKesehatan() { return $this->tunjangan_kesehatan; }
    public function getOpsiSahamId() { return $this->opsi_saham_id; }

    // Implementasi abstract method dengan memperhitungkan tunjangan kesehatan
    public function hitungGajiBersih() {
        $gajiPokok = $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
        return $gajiPokok + $this->tunjangan_kesehatan;
    }

    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Tetap]</h3>";
        echo "ID: {$this->id_karyawan}<br>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "ID Opsi Saham: {$this->opsi_saham_id}<br>";
        echo "Tunjangan Kesehatan: Rp " . number_format($this->tunjangan_kesehatan, 0, ',', '.') . "<br>";
        echo "Gaji Bersih (Inc. Tunjangan): Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}