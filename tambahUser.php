<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Tambah User | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Tambah User</h2>


        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username : </label>
                <input type="text" name="username">
            </div>

            <div class="form-group">
                Email : 
                <input type="email" name="email">
            </div>

            <div class="form-group">
                Password : 
                <input type="password" name="password">
            </div>


            <div class="form-group">
                Konfirmasi Password : 
                <input type="password" name="password2">
            </div>

            <button class="btn btn-primary" name="tambah">Tambah</button>
        </form>

    </main>


    <?php require "script.php" ?>
</body>

</html>

<?php

if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
    $password2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password2']));


    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location = 'tambahUser.php'
            </script>";
    }

    if ($password !== $password2) {
        echo "<script>
            alert('password tidak sesuai')
            location = 'tambahUser.php'
            </script>";
    }


    $ambil = $conn->query("SELECT * FROM user WHERE email = '$email' OR username = '$username' ");
    $yangcocok = $ambil->num_rows;

    if ($yangcocok > 1 || $yangcocok === 1) {
        echo "<script>
            alert('Email atau username sudah ada')
            location = 'tambahUser.php'
            </script>";
        exit();
    }else{

        $passwordBaru = password_hash($password, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO user VALUES(null,'$username', '$email', '$passwordBaru')");

        echo "<script>
                alert('Data berhasil ditambahkan')
                location = 'user.php'
                </script>";

    }

}







?>