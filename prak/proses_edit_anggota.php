<?php
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai dari formulir edit.php
    $PeminjamID = $_POST['PeminjamID'];
    $NamaPeminjam = $_POST['NamaPeminjam'];
    $Alamat = $_POST['Alamat'];
    $NoTelepon = $_POST['NoTelepon'];
    // Query untuk mengupdate data buku
    $queryUpdate = "UPDATE Peminjam SET NamaPeminjam = '$NamaPeminjam', Alamat = '$Alamat', NoTelepon = '$NoTelepon' WHERE PeminjamID = $PeminjamID";
    // Eksekusi query
    if (mysqli_query($koneksi, $queryUpdate)) {
        // Jika berhasil, redirect ke halaman index.php
        header("Location: anggota.php");
        exit();
    } else {
        // Jika terjadi error, tampilkan pesan error
        echo "Error: " . $queryUpdate . "<br>" .
            mysqli_error($koneksi);
    }
} else {
    // Jika bukan metode POST, redirect ke halaman index.php
    header("Location: anggota.php");
    exit();
}
