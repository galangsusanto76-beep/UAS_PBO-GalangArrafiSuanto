<?php

// Abstract Class sebagai blueprint global
abstract class Karyawan {
    // Atribut Global
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $jenis_karyawan;

    public function __construct($id, $nama, $jenis) {
        $this->id_karyawan = $id;
        $this->nama_karyawan = $nama;
        $this->jenis_karyawan = $jenis;
    }

    // Getter untuk atribut global
    public function getNama() {
        return $this->nama_karyawan;
    }

    // Abstract Method: Wajib diimplementasikan oleh semua kelas anak
    abstract public function hitungPendapatan();
    abstract public function tampilkanDetailSpesifik();
}

// Pola Kelas Anak: Karyawan Kontrak
class KaryawanKontrak extends Karyawan {
    // Atribut Spesifik
    private $durasi_kontrak_bulan;
    private $agensi_karyawan;

    public function __construct($id, $nama, $durasi, $agensi) {
        parent::__construct($id, $nama, 'kontrak');
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_karyawan = $agensi;
    }

    // Implementasi abstract method
    public function hitungPendapatan() {
        return "Menghitung gaji berdasarkan nilai kontrak kerja.";
    }

    public function tampilkanDetailSpesifik() {
        return "Durasi Kontrak: {$this->durasi_kontrak_bulan} bulan, Agensi: {$this->agensi_karyawan}";
    }
}

// Pola Kelas Anak: Karyawan Tetap
class KaryawanTetap extends Karyawan {
    public function __construct($id, $nama) {
        parent::__construct($id, $nama, 'tetap');
    }

    public function hitungPendapatan() {
        return "Menghitung gaji pokok + tunjangan bulanan.";
    }

    public function tampilkanDetailSpesifik() {
        return "Karyawan Tetap tidak memiliki agensi maupun batasan durasi kontrak.";
    }
}