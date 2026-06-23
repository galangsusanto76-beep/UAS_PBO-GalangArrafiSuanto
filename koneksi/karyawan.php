<?php
// ==========================================
// 1. KONFIGURASI DAN KONEKSI DATABASE (PDO)
// ==========================================
$host = "localhost";
$db   = "nama_database_anda";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


// ==========================================
// 2. DEFINISI ABSTRACT CLASS KARYAWAN
// ==========================================
abstract class Karyawan {
    // Atribut Global (sesuai kolom database)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $jenis_karyawan;

    public function __construct($id, $nama, $jenis) {
        $this->id_karyawan = $id;
        $this->nama_karyawan = $nama;
        $this->jenis_karyawan = $jenis;
    }

    // Getter & Setter Global
    public function getId() { return $this->id_karyawan; }
    public function getNama() { return $this->nama_karyawan; }
    public function getJenis() { return $this->jenis_karyawan; }

    // Abstract Method yang WAJIB diimplementasikan oleh setiap jenis karyawan
    abstract public function dapatkanDetailKaryawan();
}


// ==========================================
// 3. IMPLEMENTASI KELAS ANAK (SUB-CLASS)
// ==========================================

// --- Kelas Karyawan Kontrak ---
class KaryawanKontrak extends Karyawan {
    // Atribut Spesifik
    private $durasi_kontrak_bulan;
    private $agensi_karyawan;

    public function __construct($id, $nama, $durasi, $agensi) {
        // Memanggil constructor dari abstract class parent
        parent::__construct($id, $nama, 'kontrak');
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_karyawan = $agensi;
    }

    // Mengimplementasikan abstract method dari parent
    public function dapatkanDetailKaryawan() {
        return [
            'id' => $this->id_karyawan,
            'nama' => $this->nama_karyawan,
            'jenis' => $this->jenis_karyawan,
            'info_spesifik' => "Durasi: {$this->durasi_kontrak_bulan} bulan, Agensi: {$this->agensi_karyawan}"
        ];
    }
}

// --- Kelas Karyawan Tetap ---
class KaryawanTetap extends Karyawan {
    public function __construct($id, $nama) {
        parent::__construct($id, $nama, 'tetap');
    }

    // Mengimplementasikan abstract method dari parent
    public function dapatkanDetailKaryawan() {
        return [
            'id' => $this->id_karyawan,
            'nama' => $this->nama_karyawan,
            'jenis' => $this->jenis_karyawan,
            'info_spesifik' => "Karyawan Tetap Perusahaan"
        ];
    }
}

// --- Kelas Karyawan Magang ---
class KaryawanMagang extends Karyawan {
    public function __construct($id, $nama) {
        parent::__construct($id, $nama, 'magang');
    }

    // Mengimplementasikan abstract method dari parent
    public function dapatkanDetailKaryawan() {
        return [
            'id' => $this->id_karyawan,
            'nama' => $this->nama_karyawan,
            'jenis' => $this->jenis_karyawan,
            'info_spesifik' => "Karyawan Magang / Internship"
        ];
    }
}