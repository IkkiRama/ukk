<?php require "koneksi.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register User</title>
</head>
<body>
	<h1>Register User</h1>
	<form  method="post">
		<label for="">
			Username
			<input type="text" name="username">
		</label><br>

		<label for="">
			Email
			<input type="email" name="email">
		</label><br>

		<label for="">
			Password
			<input type="password" name="password">
		</label><br>

		<label for="">
			Konfirmasi Password
			<input type="password" name="password2">
		</label><br>

		<button name="register">Register</button>
	</form>

</body>
</html>


<?php

if (isset($_POST['register'])) {
	$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
	$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
	$password2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password2']));


	if (empty($username) || empty($email) || empty($password) || empty($password2)) {
		echo "<script>
			alert('Harap isi semua formulir')
			location = 'register.php'
			</script>";
	}

	if ($password !== $password2) {
		echo "<script>
			alert('password tidak sesuai')
			location = 'register.php'
			</script>";
	}


	$ambil = $conn->query("SELECT * FROM user WHERE email = '$email' OR username='$username' ");
	$yangcocok = $ambil->num_rows;

	if ($yangcocok === 1) {
		echo "<script>
			alert('Email atau username sudah ada')
			location = 'register.php'
			</script>";
	}

	$passwordBaru = password_hash($password, PASSWORD_DEFAULT);

	$conn->query("INSERT INTO user VALUES(null,'$username', '$email', '$passwordBaru')");

	echo "<script>
			alert('Anda berhasil mendaftar, silahkan login')
			location = 'login.php'
			</script>";



}







?>