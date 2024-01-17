<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Edit Anggota</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <?php
        include('koneksi.php');
        // Mendapatkan ID buku dari parameter URL
        $peminjamID = $_GET['id'];
        // Query untuk mengambil data buku berdasarkan ID
        $queryEdit = "SELECT * FROM Peminjam WHERE PeminjamID = $peminjamID";
        $resultEdit = mysqli_query($koneksi, $queryEdit);
        if (mysqli_num_rows($resultEdit) == 1) {
            $rowEdit = mysqli_fetch_assoc($resultEdit);
        ?>
            <!-- Formulir Edit Data -->
            <form action="proses_edit_anggota.php" method="POST" class="editform">
                <input type="hidden" name="PeminjamID" value="<?php echo $rowEdit['PeminjamID']; ?>">
                <label for="NamaPeminjam">Nama Anggota:</label>
                <input type="text" id="NamaPeminjam" name="NamaPeminjam" value="<?php echo $rowEdit['NamaPeminjam']; ?>" required>
                <label for="Alamat">Alamat:</label>
                <input type="text" id="Alamat" name="Alamat" value="<?php echo $rowEdit['Alamat']; ?>">
                <label for="NoTelepon">Telepon:</label>
                <input type="text" id="NoTelepon" name="NoTelepon" value="<?php echo $rowEdit['NoTelepon']; ?>">
                <div><br></div>
                <div>
                    <a href="anggota.php">
                        <button type="button">Kembali</button>
                    </a>
                    <button type="submit">Simpan Perubahan</button>
                </div>
            </form>
        <?php
        } else {
            echo "Data anggota tidak ditemukan.";
        }
        ?>
    </section>
    <script src="script.js"></script>
</body>

</html>