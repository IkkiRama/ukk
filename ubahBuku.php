<?php


require 'koneksi.php';
$id = $_GET['id'];

$ambil = $conn->query("SELECT * FROM buku WHERE id_buku = '$id' ");
$pecah = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Ubah Buku <?php echo $pecah['judul'] ?> | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Ubah Buku <?php echo $pecah['judul'] ?></h2>


        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Judul : </label>
            <input type="text" value="<?php echo $pecah['judul'] ?>" name="judul">
            </div>

            <div class="form-group">
                Pengarang : 
                <input type="text" value="<?php echo $pecah['pengarang'] ?>" name="pengarang">
            </div>

            <div class="form-group">
                Penerbit : 
                <input type="text" value="<?php echo $pecah['penerbit'] ?>" name="penerbit">
            </div>

            <div class="form-group">
                Gambar : 
                <br>
                <img width="100" height="100" src="foto_buku/<?php echo $pecah['gambar'] ?>" >
                <br>
                <input type="file" name="gambar">
            </div>

            <button class="btn btn-warning" name="ubah">Ubah</button>
        </form>

    </main>


    <?php require "script.php" ?>
</body>

</html>
<?php

if (isset($_POST['ubah'])) {


    $judul = mysqli_real_escape_string($conn, htmlspecialchars($_POST['judul']));
    $pengarang = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pengarang']));
    $penerbit = mysqli_real_escape_string($conn, htmlspecialchars($_POST['penerbit']));

    $namaFoto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $type = $_FILES['gambar']['type'];
    $error = $_FILES['gambar']['error'];
    $size = $_FILES['gambar']['size'];


    if (empty($judul) || empty($penerbit) || empty($pengarang)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location='ubahBuku.php?id=$id'
        </script>";
    }


    if (empty($tmp)) {

        $conn->query("UPDATE buku SET
            judul = '$judul',
            pengarang = '$pengarang',
            penerbit = '$penerbit'
            WHERE id_buku = '$id'
            ");

    }else{


        if ($error === 4) {
            echo "<script>
                alert('Harap upload foto terlebih dahulu')
                location='ubahBuku.php?id=$id'
            </script>";
        }

        if ($size >= 3000000) {
            echo "<script>
                alert('File foto terlalu besar')
                location='ubahBuku.php?id=$id'
            </script>";
        }


        unlink("foto_buku/".$pecah['gambar']);

        $ekstansiFiles = ['jpg', 'jpeg', 'png'];
        $ekstansiFile = end(explode('.', strtolower($namaFoto)));
        $namaFiks = uniqid(). "." . $ekstansiFile;


        move_uploaded_file($tmp, "foto_buku/".$namaFiks);

        
        $conn->query("UPDATE buku SET
            judul = '$judul',
            pengarang = '$pengarang',
            penerbit = '$penerbit',
            gambar = '$namaFiks'
            WHERE id_buku = '$id'
            ");

    }

    echo "<script>
            alert('Data berhasil diubah')
            location='buku.php'
        </script>";
}



?>

