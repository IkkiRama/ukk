<?php
require 'koneksi.php';
if (empty($_SESSION['pelanggan'])) {
    echo "<script>
            alert('Anda belum login, silahkan login terlebih dahulu')
            location = 'login.php'
            </script>";
}


$ambilUser = $conn->query("SELECT * FROM user");
$ambilBuku = $conn->query("SELECT * FROM buku");


$hitungUser = $ambilUser->num_rows;
$hitungBuku = $ambilBuku->num_rows;



?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Dashboard | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Selamat Datang Admin</h2>


        <div class="fitur">
            <div class="perFitur">
                <div class="caption">
                    <h3><?php echo $hitungUser ?></h3>
                    <p>Pelanggan</p>
                </div>

                <div class="icon">
                    <i class="fas fa-user-alt"></i>
                </div>
            </div>


            <div class="perFitur">
                <div class="caption">
                    <h3><?php echo $hitungBuku ?></h3>
                    <p>Buku</p>
                </div>

                <div class="icon">
                    <i class="fas fa-book-open"></i>
                </div>
            </div>
        </div>

    </main>


    <?php require "script.php" ?>
</body>

</html>