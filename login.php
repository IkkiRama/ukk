<?php

require "koneksi.php";

if (isset($_SESSION['pelanggan'])) {
    echo "<script>
            alert('Anda sudah login')
            location = 'index.php'
            </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan SMK N 2 Purbalingga</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>
    <div class="container-form">
        <div class="form">
            <img src="img/logo.png" alt="Logo SMK N 2 Purbalingga" class="logo">
            <h3>Login Aplikasi</h3>
            <form method="post">
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

                <button type="submit" name="login">Login</button>

                <div class="keterangan">
                    <p>Belum punya akun? <a href="daftar.php">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));

    if (empty($email) || empty($password)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location = 'login.php'
            </script>";
    }

    $ambil = $conn->query("SELECT * FROM user WHERE email = '$email'");
    $pecah = $ambil->fetch_assoc();     
    $yangCocok = $ambil->num_rows;

    if ($yangCocok !== 1) {
        echo "<script>
            alert('Tidak ada akun yang cocok')
            location = 'login.php'
            </script>";
    }

    if (password_verify( $password, $pecah['password'])) {
        echo "<script>
            alert('Password salah')
            location = 'login.php'
            </script>";
    }

    if ($yangCocok === 1) {

        $_SESSION['pelanggan'] = $pecah;
        
        echo "<script>
            alert('Anda berhasil login')
            location = 'index.php'
            </script>";
    }
}


?>
