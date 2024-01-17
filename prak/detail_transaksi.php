<?php
include "koneksi.php";
$peminjaman = mysqli_query($koneksi, "SELECT * FROM Peminjam");
$buku = mysqli_query($koneksi, "SELECT * FROM Buku");

$id = $_GET["id"];
$detail = mysqli_query($koneksi, "SELECT * FROM Peminjaman LEFT JOIN Peminjam
ON Peminjaman.PeminjamID = Peminjam.PeminjamID LEFT JOIN DetailPeminjaman
ON Peminjaman.PeminjamanID = DetailPeminjaman.PeminjamanID LEFT JOIN Buku
ON DetailPeminjaman.BukuID = Buku.BukuID
 WHERE Peminjaman.PeminjamanID = '$id'");
$row = mysqli_fetch_assoc($detail);
// var_dump($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Tambah Transaksi Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Form Peminjaman Buku Dan Detail Peminjaman</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <form action="" method="POST" class="addform">
            <div class="form-container">
                <!-- Formulir Tambah Data -->
                <div class="form-group">
                    <label for="">Nama Peminjam:</label>
                    <input type="text" readonly id="NamaPeminjam" name="NamaPeminjam" value="<?= $row['NamaPeminjam'] ?>">
                </div>
                <div class="form-group">
                    <label for="TanggalPinjam">Tanggal Pinjam:</label>
                    <input type="date" readonly id="TanggalPinjam" name="TanggalPinjam" value="<?= $row['TanggalPinjam'] ?>">
                </div>
                <div class="form-group">
                    <label for="TanggalKembali">Tanggal Kembali:</label>
                    <input type="date" readonly id="TanggalKembali" name="TanggalKembali" value="<?= $row['TanggalKembali'] ?>">
                </div>
                <div class="form-group">
                    <label for="BukuID">Buku yang Dipinjam:</label>
                    <select name="Judul" id="" multiple>
                        <?php foreach ($detail as $data) : ?>
                            <option value="<?= $data['Judul'] ?>"><?= $data['Judul'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <a href="transaksi.php">
                    <button type="button">Kembali</button>
                </a>
            </div>
        </form>

    </section>
    <script src="script.js"></script>
    <script>
        function hapusBuku(bukuID) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus buku ini ? ");
            if (konfirmasi) {
                window.location.href = 'hapus_buku_sementara.php?id=' + bukuID;
            }
        }
    </script>
</body>

</html>