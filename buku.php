<?php
require 'koneksi.php';
if (empty($_SESSION['pelanggan'])) {
    echo "<script>
            alert('Anda belum login, silahkan login terlebih dahulu')
            location = 'login.php'
            </script>";
}


$data = [];
$cari = "";

$ambil = $conn->query("SELECT * FROM buku");
if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($conn, htmlspecialchars($_GET['keyword']));
    $cari = $_GET['keyword'];

    if (isset($keyword)) {
        $ambil = $conn->query("SELECT * FROM buku WHERE judul LIKE '%$keyword%' ");
    }
}

while($pecah = $ambil->fetch_assoc()){
    $data[] = $pecah;
}






?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Buku | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Daftar Buku</h2>


        <a href="tambahBuku.php" class="btn btn-primary btn-sm">Tambah Buku</a>

        <form method="get">
            <div class="form-group my-20">
                <div class="input-group">
                    <label>
                        <input type="text" value="<?php echo $cari ?>" name="keyword" placeholder="Cari Buku">
                    </label>

                    <button class="btn btn-primary btn-sm">Cari</button>
                </div>
            </div>
        </form>



        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value["judul"] ?></td>
                        <td><?php echo $value["pengarang"] ?></td>
                        <td><?php echo $value["penerbit"] ?></td>
                        <td>
                            <img width="100" height="80" src="foto_buku/<?php echo $value['gambar'] ?>">
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="ubahBuku.php?id=<?php echo $value['id_buku'] ?>">Ubah</a>
                            <a class="btn btn-danger btn-sm" href="hapusBuku.php?id=<?php echo $value['id_buku'] ?>" onclick="return confirm('Yakin akan menghapus data ini?')" >Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <?php if (count($data) === 0): ?>
                        <td colspan="6" style="text-align: center;"><h2>Tidak ada data yang sesuai</h2></td>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

    </main>


    <?php require "script.php" ?>
</body>

</html>