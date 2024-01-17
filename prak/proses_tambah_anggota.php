<?php
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai dari formulir tambah.php
    $NamaPeminjam = $_POST['NamaPeminjam'];
    $Alamat = $_POST['Alamat'];
    $NoTelepon = $_POST['NoTelepon'];
    // Query untuk menambahkan data ke dalam tabel buku
    $queryTambah = "INSERT INTO Peminjam (NamaPeminjam, Alamat, NoTelepon) VALUES ('$NamaPeminjam', '$Alamat', '$NoTelepon')";
    // Eksekusi query
    if (mysqli_query($koneksi, $queryTambah)) {
        // Jika berhasil, redirect ke halaman index.php
        header("Location: anggota.php");
        exit();
    } else {
        // Jika terjadi error, tampilkan pesan error
        echo "Error: " . $queryTambah . "<br>" .
            mysqli_error($koneksi);
    }
} else {
    // Jika bukan metode POST, redirect ke halaman tambah.php
    header("Location: anggota.php");
    exit();
}
