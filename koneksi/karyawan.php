<?php
// FILE: Karyawan.php

// ==========================================
// 1. ABSTRACT CLASS INDUK (PARENT CLASS)
// ==========================================
abstract class Karyawan {
    // Properti Terenkapsulasi (Protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_perhari;

    // Constructor Global
    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari) {
        $this->id_karyawan = $id;
        $this->nama_karyawan = $nama;
        $this->departemen = $dept;
        $this->hari_kerja_masuk = $hariKerja;
        $this->gaji_dasar_perhari = $gajiPerhari;
    }

    // Getter & Setter Global
    public function getIdKaryawan() { return $this->id_karyawan; }
    public function getNamaKaryawan() { return $this->nama_karyawan; }
    public function getDepartemen() { return $this->departemen; }
    public function getHariKerjaMasuk() { return $this->hari_kerja_masuk; }
    public function getGajiDasarPerhari() { return $this->gaji_dasar_perhari; }

    // ============================================================
    // DEKLARASI ABSTRACT METHOD (Tanpa isi/body, wajib di sub-class)
    // ============================================================
    abstract public function hitungGajiBersih();
    abstract public function tampilProfilKaryawan();
}


// ==========================================
// 2. SUB-CLASS: KARYAWAN TETAP
// ==========================================
class KaryawanTetap extends Karyawan {
    private $tunjangan_jabatan;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $tunjangan = 500000) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->tunjangan_jabatan = $tunjangan;
    }

    // Implementasi Rumus Gaji Bersih Karyawan Tetap
    public function hitungGajiBersih() {
        $gajiKotor = $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
        $pajak = $gajiKotor * 0.05; // Potongan pajak 5% untuk karyawan tetap
        return ($gajiKotor + $this->tunjangan_jabatan) - $pajak;
    }

    // Implementasi Tampilan Profil Karyawan Tetap
    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Tetap]</h3>";
        echo "ID: {$this->id_karyawan}<br>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Status: Karyawan Tetap Perusahaan<br>";
        echo "Gaji Bersih Bulan Ini: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}


// ==========================================
// 3. SUB-CLASS: KARYAWAN KONTRAK
// ==========================================
class KaryawanKontrak extends Karyawan {
    private $durasi_kontrak_bulan;
    private $agensi_karyawan;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari, $durasi, $agensi) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_karyawan = $agensi;
    }

    // Implementasi Rumus Gaji Bersih Karyawan Kontrak
    public function hitungGajiBersih() {
        $gajiKotor = $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
        $potonganAgensi = $gajiKotor * 0.10; // Potongan manajemen agensi 10%
        return $gajiKotor - $potonganAgensi;
    }

    // Implementasi Tampilan Profil Karyawan Kontrak
    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Kontrak]</h3>";
        echo "ID: {$this->id_karyawan}<br>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Agensi Penyalur: {$this->agensi_karyawan}<br>";
        echo "Sisa Kontrak: {$this->durasi_kontrak_bulan} Bulan<br>";
        echo "Gaji Bersih Bulan Ini: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}


// ==========================================
// 4. SUB-CLASS: KARYAWAN MAGANG
// ==========================================
class KaryawanMagang extends Karyawan {
    
    public function __construct($id, $nama, $dept, $hariKerja, $gajiPerhari) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiPerhari);
    }

    // Implementasi Rumus Gaji Bersih Karyawan Magang
    public function hitungGajiBersih() {
        // Karyawan magang menerima gaji murni tanpa tunjangan atau potongan pajak
        return $this->hari_kerja_masuk * $this->gaji_dasar_perhari;
    }

    // Implementasi Tampilan Profil Karyawan Magang
    public function tampilProfilKaryawan() {
        echo "<h3>[Profil Karyawan Magang]</h3>";
        echo "ID: {$this->id_karyawan}<br>";
        echo "Nama: {$this->nama_karyawan}<br>";
        echo "Departemen: {$this->departemen}<br>";
        echo "Status: Intern/Magang<br>";
        echo "Uang Saku Bulan Ini: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br><hr>";
    }
}