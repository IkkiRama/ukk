<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Tambah Buku | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Tambah Buku</h2>


        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Judul : </label>
            <input type="text" name="judul">
            </div>

            <div class="form-group">
                Pengarang : 
                <input type="text" name="pengarang">
            </div>

            <div class="form-group">
                Penerbit : 
                <input type="text" name="penerbit">
            </div>

            <div class="form-group">
                Gambar : 
                <input type="file" name="gambar">
            </div>

            <button class="btn btn-primary" name="tambah">Tambah</button>
        </form>

    </main>


    <?php require "script.php" ?>
</body>

</html>

<?php

if (isset($_POST['tambah'])) {

    $judul = mysqli_real_escape_string($conn, htmlspecialchars($_POST['judul']));
    $pengarang = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pengarang']));
    $penerbit = mysqli_real_escape_string($conn, htmlspecialchars($_POST['penerbit']));

    $namaFoto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $type = $_FILES['gambar']['type'];
    $error = $_FILES['gambar']['error'];
    $size = $_FILES['gambar']['size'];

    if ($error === 4) {
        echo "<script>
            alert('Harap upload foto terlebih dahulu')
            location='tambah.php'
        </script>";
    }

    if ($size >= 3000000) {
        echo "<script>
            alert('File foto terlalu besar')
            location='tambah.php'
        </script>";
    }


    if (empty($judul) || empty($penerbit) || empty($pengarang)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location='tambah.php'
        </script>";
    }

    
    $ekstansiFile = end(explode('.', strtolower($namaFoto)));
    $namaFiks = uniqid(). "." . $ekstansiFile;


    move_uploaded_file($tmp, "foto_buku/".$namaFiks);

    $conn->query("INSERT INTO buku VALUES(null, '$judul', '$pengarang', '$penerbit', '$namaFiks', null, null)");

    echo "<script>
            alert('Data berhasil ditambahkan')
            location='buku.php'
        </script>";
}



?>


