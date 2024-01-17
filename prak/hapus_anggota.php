<?php
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Mendapatkan ID buku dari parameter URL
    $PeminjamID = $_GET['id'];
    // Query untuk memeriksa apakah buku sedang dipinjam
    $queryCekPeminjam = "SELECT COUNT(*) as count FROM Peminjaman WHERE PeminjamID = $PeminjamID";
    $resultCekPeminjam = mysqli_query($koneksi, $queryCekPeminjam);
    $rowCekPeminjam = mysqli_fetch_assoc($resultCekPeminjam);
    $jumlahPeminjam = $rowCekPeminjam['count'];
    if ($jumlahPeminjam > 0) {
        // Jika buku sedang dipinjam, tampilkan pesan dan redirect ke halaman index.php
        echo "
            <script>
                alert('Anggota sedang meminjam buku. Tidak dapat dihapus.')
                window.location.href = 'anggota.php'
            </script>
        ";
    } else {
        $queryHapus = "DELETE FROM Peminjam WHERE PeminjamID = $PeminjamID";
        // Eksekusi query
        if (mysqli_query($koneksi, $queryHapus)) {
            // Jika berhasil, redirect ke halaman index.php
            header("Location: anggota.php");
            exit();
        } else {
            // Jika terjadi error, tampilkan pesan error
            echo "Error: " . $queryHapus . "<br>" .
                mysqli_error($koneksi);
        }
    }
} else {
    // Jika bukan metode GET, redirect ke halaman index.php
    header("Location: anggota.php");
    exit();
}
