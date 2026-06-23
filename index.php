<?php
// 1. LOAD CONFIG DAN MODELS
require_once 'config/koneksi.php';
require_once 'models/Karyawan.php';
require_once 'models/KaryawanKontrak.php';
require_once 'models/KaryawanTetap.php';
require_once 'models/KaryawanMagang.php';

// 2. INISIALISASI ARRAY BERDASARKAN KELOMPOK JABATAN
$kelompokTetap   = [];
$kelompokKontrak = [];
$kelompokMagang  = [];

try {
    // Ambil seluruh data dari single table database
    $stmt = $pdo->query("SELECT * FROM tabel_karyawan");

    while ($row = $stmt->fetch()) {
        // Polimorfisme & Pengelompokan Data Dinamis
        if ($row['jenis_karyawan'] === 'tetap') {
            $kelompokTetap[] = new KaryawanTetap(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                'Departemen Utama',  // Dummy Dept
                22,                  // Dummy Hari Kerja Masuk
                250000,              // Dummy Gaji Dasar/Hari
                500000,              // Tunjangan Kesehatan Spesifik
                'SHM-' . str_pad($row['id_karyawan'], 4, '0', STR_PAD_LEFT)
            );
        } elseif ($row['jenis_karyawan'] === 'kontrak') {
            $kelompokKontrak[] = new KaryawanKontrak(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                'Divisi Operasional', // Dummy Dept
                20,                  // Dummy Hari Kerja Masuk
                180000,              // Dummy Gaji Dasar/Hari
                $row['durasi_kontrak_bulan'] ?? 12,
                $row['agensi_karyawan'] ?? 'Mitra Vendor'
            );
        } elseif ($row['jenis_karyawan'] === 'magang') {
            $kelompokMagang[] = new KaryawanMagang(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                'Digital Innovation', // Dummy Dept
                18,                  // Dummy Hari Kerja Masuk
                100000,              // Dummy Gaji Dasar/Hari
                0, 
                true                 // Sertifikat Kampus Merdeka
            );
        }
    }
} catch (PDOException $e) {
    die("Gagal memuat data antarmuka: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Slip Gaji Terkelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header class="bg-slate-800 text-white shadow-md">
        <div class="container mx-auto px-6 py-5">
            <h1 class="text-2xl font-bold tracking-tight">💵 Sistem Informasi Slip Gaji & Ketenagakerjaan</h1>
            <p class="text-slate-400 text-xs mt-1">Implementasi Terpisah & Terkelompok Berdasarkan Kategori Jabatan Konkrit</p>
        </div>
    </header>

    <main class="container mx-auto px-6 py-10 space-y-12">

        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="border-b border-gray-100 pb-4 mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-emerald-800 flex items-center gap-2">
                        <span>🟢</span> Kelompok Karyawan Tetap
                    </h2>
                    <p class="text-gray-500 text-xs mt-0.5">Spesifikasi: Memiliki Tunjangan Kesehatan & Hak Opsi Saham ID</p>
                </div>
                <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-md border border-emerald-200">
                    <?php echo count($kelompokTetap); ?> Personel
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($kelompokTetap as $kt): ?>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-emerald-600 text-white text-[10px] uppercase font-bold px-3 py-1 rounded-bl-lg">Tetap</div>
                        <span class="text-xs font-mono text-gray-400 block mb-1">ID: #<?php echo $kt->getIdKaryawan(); ?></span>
                        <h3 class="text-base font-bold text-gray-800 mb-3"><?php echo $kt->getNamaKaryawan(); ?></h3>
                        
                        <div class="text-xs space-y-1 border-t border-b border-gray-200 border-dashed py-2.5 my-3 text-gray-600">
                            <p>💼 <strong>Dept:</strong> <?php echo $kt->getDepartemen(); ?></p>
                            <p>🔑 <strong>Opsi Saham ID:</strong> <span class="font-mono text-emerald-700"><?php echo $kt->getOpsiSahamId(); ?></span></p>
                            <p>🏥 <strong>Tunj. Kesehatan:</strong> Rp <?php echo number_format($kt->getTunjanganKesehatan(), 0, ',', '.'); ?></p>
                        </div>
                        
                        <div class="flex justify-between items-center bg-white p-2.5 rounded-lg border border-gray-150">
                            <span class="text-[11px] font-semibold text-gray-400 uppercase">Gaji Bersih</span>
                            <span class="text-md font-extrabold text-emerald-600">Rp <?php echo number_format($kt->hitungGajiBersih(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="border-b border-gray-100 pb-4 mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-blue-800 flex items-center gap-2">
                        <span>🔵</span> Kelompok Karyawan Kontrak
                    </h2>
                    <p class="text-gray-500 text-xs mt-0.5">Spesifikasi: Terikat Durasi Periode Kerja & Instansi Agensi Penyalur</p>
                </div>
                <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-md border border-blue-200">
                    <?php echo count($kelompokKontrak); ?> Personel
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($kelompokKontrak as $kk): ?>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] uppercase font-bold px-3 py-1 rounded-bl-lg">Kontrak</div>
                        <span class="text-xs font-mono text-gray-400 block mb-1">ID: #<?php echo $kk->getIdKaryawan(); ?></span>
                        <h3 class="text-base font-bold text-gray-800 mb-3"><?php echo $kk->getNamaKaryawan(); ?></h3>
                        
                        <div class="text-xs space-y-1 border-t border-b border-gray-200 border-dashed py-2.5 my-3 text-gray-600">
                            <p>💼 <strong>Dept:</strong> <?php echo $kk->getDepartemen(); ?></p>
                            <p>🏢 <strong>Agensi Penyalur:</strong> <?php echo $kk->getAgensiPenyalur(); ?></p>
                            <p>⏳ <strong>Durasi Sisa:</strong> <?php echo $kk->getDurasiKontrakBulan(); ?> Bulan</p>
                        </div>
                        
                        <div class="flex justify-between items-center bg-white p-2.5 rounded-lg border border-gray-150">
                            <span class="text-[11px] font-semibold text-gray-400 uppercase">Gaji Bersih</span>
                            <span class="text-md font-extrabold text-blue-600">Rp <?php echo number_format($kk->hitungGajiBersih(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="border-b border-gray-100 pb-4 mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-purple-800 flex items-center gap-2">
                        <span>🟣</span> Kelompok Karyawan Magang (Internship)
                    </h2>
                    <p class="text-gray-500 text-xs mt-0.5">Spesifikasi: Pemotongan Biaya Pelatihan Organisasi 20% & Verifikasi Kampus Merdeka</p>
                </div>
                <span class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-md border border-purple-200">
                    <?php echo count($kelompokMagang); ?> Personel
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($kelompokMagang as $km): ?>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-purple-600 text-white text-[10px] uppercase font-bold px-3 py-1 rounded-bl-lg">Magang</div>
                        <span class="text-xs font-mono text-gray-400 block mb-1">ID: #<?php echo $km->getIdKaryawan(); ?></span>
                        <h3 class="text-base font-bold text-gray-800 mb-3"><?php echo $km->getNamaKaryawan(); ?></h3>
                        
                        <div class="text-xs space-y-1 border-t border-b border-gray-200 border-dashed py-2.5 my-3 text-gray-600">
                            <p>💼 <strong>Dept:</strong> <?php echo $km->getDepartemen(); ?></p>
                            <p>🎓 <strong>Kampus Merdeka:</strong> <?php echo $km->getSertifikatKampusMerdeka() ? '✅ Terverifikasi' : '❌ Non-MSIB'; ?></p>
                            <p>⚠️ <strong>Skema Upah:</strong> Potongan Orientasi 20%</p>
                        </div>
                        
                        <div class="flex justify-between items-center bg-white p-2.5 rounded-lg border border-gray-150">
                            <span class="text-[11px] font-semibold text-gray-400 uppercase">Uang Saku</span>
                            <span class="text-md font-extrabold text-purple-600">Rp <?php echo number_format($km->hitungGajiBersih(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <footer class="bg-slate-800 text-slate-400 text-center py-6 mt-20 text-xs">
        &copy; 2026 Arsitektur MVC View Terkelompok & Polimorfisme Pola Bersih. All rights reserved.
    </footer>

</body>
</html>
