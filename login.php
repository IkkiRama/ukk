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
	<title>Login User</title>
</head>
<body>
	<h1>Login User</h1>

	<form method="post">
		<label for="">
			Email
			<input type="email" name="email">
		</label><br>

		<label for="">
			Password
			<input type="password" name="password">
		</label><br>

		<button name="login">Login</button>
	</form>


	<br>
	Register <a href="register.php">Di sini</a>
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
