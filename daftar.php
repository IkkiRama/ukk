<?php require "koneksi.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perpustakaan SMK N 2 Purbalingga</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>
    <div class="container-form">
        <div class="form">
            <img src="img/logo.png" alt="Logo SMK N 2 Purbalingga" class="logo">
            <h3>Daftar Aplikasi</h3>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="username" id="username" required>
                    <label for="username">
                        <span>Username</span>
                    </label>
                </div>

                 <div class="form-group">
                    <input type="email" name="email" id="email" required>
                    <label for="email">
                        <span>Email</span>
                    </label>
                </div>


                <div class="form-group">
                    <input type="password" name="password" id="password" required>
                    <label for="password">
                        <span>Password</span>
                    </label>
                </div>

                <div class="form-group">
                    <input type="password" name="password2" id="password2" required>
                    <label for="password2">
                        <span>Konfirmasi Password</span>
                    </label>
                </div>

                <button type="submit" name="daftar">Login</button>

                <div class="keterangan">
                    <p>Sudah punya akun? <a href="login.php">Login Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>



<?php

if (isset($_POST['daftar'])) {
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
    $password2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password2']));


    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location = 'daftar.php'
            </script>";
    }

    if ($password !== $password2) {
        echo "<script>
            alert('password tidak sesuai')
            location = 'daftar.php'
            </script>";
    }


    $ambil = $conn->query("SELECT * FROM user WHERE email = '$email' OR username='$username' ");
    $yangcocok = $ambil->num_rows;

    if ($yangcocok > 1 || $yangcocok === 1) {
        echo "<script>
            alert('Email atau username sudah ada')
            location = 'daftar.php'
            </script>";
    }else{

        $passwordBaru = password_hash($password, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO user VALUES(null,'$username', '$email', '$passwordBaru')");

        echo "<script>
                alert('Anda berhasil mendaftar, silahkan login')
                location = 'login.php'
                </script>";
    }

}







?>