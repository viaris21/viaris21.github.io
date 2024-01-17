<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Daftar Transaksi</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="tambah.php">Tambah Buku</a></li>
                <li><a href="anggota.php"> Anggota</a></li>
                <li><a href="tambah_anggota.php">Tambah Anggota</a></li>
                <li><a href="transaksi.php">Transaksi Peminjaman</a></li>
                <li><a href="tambah_transaksi.php">Tambah Transaksi Peminjaman</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <!-- Formulir Pencarian -->
        <form action="transaksi.php" method="GET" class="search-form">
            <div class="search-container">
                <input type="text" id="search" name="search" placeholder="Transaksi" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
            <button type="submit">Cari Transaksi</button>
        </form>
        <!-- Tabel Daftar Buku -->
        <table class="responsive-table">
            <tr>
                <th>Peminjaman ID</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
            <?php
            include('koneksi.php');
            // Logika Pencarian
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM Peminjaman LEFT JOIN Peminjam
            ON Peminjaman.PeminjamID = Peminjam.PeminjamID
            WHERE Peminjaman.PeminjamID LIKE '%$search%' OR Peminjam.NamaPeminjam LIKE '%$search%'";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['PeminjamanID'] . "</td>";
                echo "<td>" . $row['NamaPeminjam'] . "</td>";
                echo "<td>" . $row['TanggalPinjam'] . "</td>";
                echo "<td>" . $row['TanggalKembali'] . "</td>";
                echo "<td>";
                echo "<a href='detail_transaksi.php?id=" . $row['PeminjamanID'] . "'>Detail</a> 
| ";
                echo "<a href='#' onclick='hapusTransaksi(" . $row['PeminjamanID'] .
                    ")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    <script src="script.js"></script>
    <script>
        function hapusTransaksi(transaksiID) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus transaksi ini ? ");
            if (konfirmasi) {
                window.location.href = 'hapus_transaksi.php?id=' + transaksiID;
            }
        }
    </script>
</body>

</html>