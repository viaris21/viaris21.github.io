<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Tambah Anggota</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="form-container">
            <!-- Formulir Tambah Data -->
            <form action="proses_tambah_anggota.php" method="POST" class="addform">
                <div class="form-group">
                    <label for="NamaPeminjam">Nama Anggota:</label>
                    <input type="text" id="NamaPeminjam" name="NamaPeminjam" required>
                </div>
                <div class="form-group">
                    <label for="Alamat">Alamat:</label>
                    <input type="text" id="Alamat" name="Alamat">
                </div>
                <div class="form-group">
                    <label for="NoTelepon">Telepon:</label>
                    <input type="text" id="NoTelepon" name="NoTelepon">
                </div>
                <a href="anggota.php">
                    <button type="button">Kembali</button>
                </a>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>

</html>