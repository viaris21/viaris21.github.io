<?php
// Sisipkan file koneksi ke database
include "koneksi.php";

// Tangkap ID transaksi yang akan dihapus
$idTransaksi = $_GET['id'];

// Hapus detail transaksi terlebih dahulu
$queryHapusDetail = "DELETE FROM DetailPeminjaman WHERE PeminjamanID = '$idTransaksi'";
$resultHapusDetail = mysqli_query($koneksi, $queryHapusDetail);

if ($resultHapusDetail) {
    // Setelah detail transaksi dihapus, hapus transaksi peminjaman
    $queryHapusTransaksi = "DELETE FROM Peminjaman WHERE PeminjamanID = '$idTransaksi'";
    $resultHapusTransaksi = mysqli_query($koneksi, $queryHapusTransaksi);

    if ($resultHapusTransaksi) {
        echo "
            <script>
                alert('Transaksi peminjaman berhasil dihapus!')
                window.location.href = 'transaksi.php'
            </script>
        ";
    } else {
        echo "Gagal menghapus transaksi peminjaman";
    }
} else {
    echo "Gagal menghapus detail transaksi peminjaman";
}
