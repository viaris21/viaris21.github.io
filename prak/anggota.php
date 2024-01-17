<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Daftar Anggota</h1>
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
        <form action="anggota.php" method="GET" class="search-form">
            <div class="search-container">
                <input type="text" id="search" name="search" placeholder="Nama Anggota" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
            <button type="submit">Cari Anggota</button>
        </form>
        <!-- Tabel Daftar Buku -->
        <table class="responsive-table">
            <tr>
                <th>AnggotaID</th>
                <th>Nama Anggota</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
            <?php
            include('koneksi.php');
            // Logika Pencarian
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM Peminjam WHERE NamaPeminjam LIKE '%$search%'";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['PeminjamID'] . "</td>";
                echo "<td>" . $row['NamaPeminjam'] . "</td>";
                echo "<td>" . $row['Alamat'] . "</td>";
                echo "<td>" . $row['NoTelepon'] . "</td>";
                echo "<td>";
                echo "<a href='edit_anggota.php?id=" . $row['PeminjamID'] . "'>Edit</a> 
| ";
                echo "<a href='#' onclick='hapusAnggota(" . $row['PeminjamID'] . ")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    <script src="script.js"></script>
    <script>
        function hapusAnggota(anggotaID) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus anggota ini ? ");
            if (konfirmasi) {
                window.location.href = 'hapus_anggota.php?id=' + anggotaID;
            }
        }
    </script>
</body>

</html>