<?php
include "koneksi.php";
$q = mysqli_query($koneksi, "SELECT * FROM Peminjam");
$buku = mysqli_query($koneksi, "SELECT * FROM Buku");

if (isset($_POST["pinjam"])) {
    // var_dump($_POST["judulBuku"]);
    // die;

    // Tangkap data yang dikirimkan dari formulir
    $namaPeminjam = $_POST['PeminjamID'];
    $tanggalPinjam = $_POST['TanggalPinjam'];
    $tanggalKembali = $_POST['TanggalKembali'];
    $judulBuku = $_POST['judulBuku'];

    // Validasi data
    if (empty($namaPeminjam) || empty($tanggalPinjam) || empty($tanggalKembali)) {
        echo "Silakan lengkapi semua data yang diperlukan";
    } else {
        // Lakukan proses penyimpanan data peminjaman ke dalam database
        // Misalnya, Anda bisa menyimpan data peminjaman ke dalam tabel Peminjaman di database
        $query = "INSERT INTO Peminjaman (PeminjamanID,PeminjamID, TanggalPinjam, TanggalKembali) VALUES ('','$namaPeminjam', '$tanggalPinjam', '$tanggalKembali')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Ambil ID peminjaman terbaru
            $peminjamanID = mysqli_insert_id($koneksi);

            // Simpan detail buku yang dipinjam ke dalam tabel DetailPeminjaman
            foreach ($judulBuku as $idBuku) {
                if ($idBuku == $judulBuku[0]) {
                    continue;
                }
                $queryDetail = "INSERT INTO DetailPeminjaman (id_det, PeminjamanID, BukuID) VALUES ('','$peminjamanID', '$idBuku')";
                $resultDetail = mysqli_query($koneksi, $queryDetail);
            }

            if ($resultDetail) {
                echo "
                    <script>
                        alert('Peminjaman buku berhasil')
                        window.location.href = 'transaksi.php'
                    </script>
                ";
            } else {
                echo "Gagal menyimpan detail buku yang dipinjam";
            }
        } else {
            echo "Gagal menyimpan data peminjaman";
        }
    }
}

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
                    <select name="PeminjamID" id="PeminjamID">
                        <?php foreach ($q as $data) : ?>
                            <option value="<?= $data['PeminjamID'] ?>"><?= $data['NamaPeminjam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="TanggalPinjam">Tanggal Pinjam:</label>
                    <input type="date" id="TanggalPinjam" name="TanggalPinjam">
                </div>
                <div class="form-group">
                    <label for="TanggalKembali">Tanggal Kembali:</label>
                    <input type="date" id="TanggalKembali" name="TanggalKembali">
                </div>
                <div class="form-group">
                    <label for="judulBuku">Buku yang Dipinjam:</label>
                    <select name="judulBuku[]" id="judulBuku">
                        <option value="Pilih Buku">Pilih Buku</option>
                        <?php foreach ($buku as $data) : ?>
                            <option value="<?= $data['BukuID'] ?>"><?= $data['Judul'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <button type="button" id="tambah_buku" onclick="tambahDataDariInputan()">Tambah Buku</button>
                </div>
            </div>
            <div class="form-container">
                <table class="responsive-table" id="tabelData">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Aksi</th>
                    </tr>
                </table>
                <a href="transaksi.php">
                    <button type="button">Kembali</button>
                </a>
                <button type="submit" name="pinjam">Pinjam Buku</button>
            </div>
        </form>

    </section>
    <script src="script.js"></script>
    <script>
        // Membuat fungsi untuk menambahkan data dari inputan ke dalam tabel
        var noUrut = 1;

        // function tambahDataDariInputan() {
        // var namaBuku = document.getElementById('judulBuku');

        // // Pastikan elemen dengan id 'judulBuku' dapat diakses
        // if (namaBuku) {
        // var selectedOption = namaBuku.options[namaBuku.selectedIndex];

        // // Pastikan opsi terpilih ada sebelum menambahkan data ke dalam tabel
        // if (selectedOption) {
        // var selectedText = selectedOption.innerHTML;

        // // Tambahkan buku yang dipilih ke dalam tabel
        // var tabel = document.getElementById('tabelData');
        // var row = tabel.insertRow(-1);
        // var cell1 = row.insertCell(0);
        // var cell2 = row.insertCell(1);
        // var cell3 = row.insertCell(2);
        // cell1.innerHTML = noUrut;
        // cell2.innerHTML = selectedText;
        // cell3.innerHTML = "<input type='hidden' name='judulBuku[]' value='" + selectedOption.value + "'>" +
        // "<button type='button' onclick='hapusData(this)'>Hapus</button>";

        // // Bersihkan pemilihan untuk buku berikutnya
        // namaBuku.selectedIndex = 0;

        // noUrut++;
        // } else {
        // alert('Pilih buku terlebih dahulu.');
        // }
        // } else {
        // alert('Terjadi kesalahan dalam mengakses elemen judulBuku.');
        // }
        // }
        function tambahDataDariInputan() {
            var namaBuku = document.getElementById('judulBuku');

            // Pastikan elemen dengan id 'judulBuku' dapat diakses
            if (namaBuku) {
                var selectedOption = namaBuku.options[namaBuku.selectedIndex];

                // Pastikan opsi terpilih ada sebelum menambahkan data ke dalam tabel
                if (selectedOption && selectedOption.value !== 'Pilih Buku') {
                    var selectedText = selectedOption.innerHTML;

                    // Tambahkan buku yang dipilih ke dalam tabel
                    var tabel = document.getElementById('tabelData');
                    var row = tabel.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    cell1.innerHTML = noUrut;
                    cell2.innerHTML = selectedText;
                    cell3.innerHTML = "<input type='hidden' name='judulBuku[]' value='" + selectedOption.value + "'>" +
                        "<button type='button' onclick='hapusData(this)'>Hapus</button>";

                    // Bersihkan pemilihan untuk buku berikutnya
                    namaBuku.selectedIndex = 0;
                    noUrut++;
                } else {
                    alert('Pilih buku terlebih dahulu.');
                }
            } else {
                alert('Terjadi kesalahan dalam mengakses elemen judulBuku.');
            }
        }
        // function tambahDataDariInputan() {
        // var namaBuku = document.getElementById('judulBuku');

        // // Pastikan elemen dengan id 'judulBuku' dapat diakses
        // if (namaBuku) {
        // var selectedOption = namaBuku.options[namaBuku.selectedIndex];

        // // Pastikan opsi terpilih ada dan bukan opsi default sebelum menambahkan data ke dalam tabel
        // if (selectedOption && selectedOption.value !== "Pilih Buku") {
        // var selectedText = selectedOption.innerHTML;

        // // Tambahkan buku yang dipilih ke dalam tabel
        // var tabel = document.getElementById('tabelData');
        // var row = tabel.insertRow(-1);
        // var cell1 = row.insertCell(0);
        // var cell2 = row.insertCell(1);
        // var cell3 = row.insertCell(2);
        // cell1.innerHTML = noUrut;
        // cell2.innerHTML = selectedText;
        // cell3.innerHTML = "<input type='hidden' name='judulBuku[]' value='" + selectedOption.value + "'>" +
        // "<button type='button' onclick='hapusData(this)'>Hapus</button>";

        // // Bersihkan pemilihan untuk buku berikutnya
        // namaBuku.remove(namaBuku.selectedIndex);

        // noUrut++;
        // } else {
        // alert('Pilih buku terlebih dahulu.');
        // }
        // } else {
        // alert('Terjadi kesalahan dalam mengakses elemen judulBuku.');
        // }
        // }

        function hapusData(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</body>

</html>