<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Buku</title>
</head>
<body>

	<h1>Tambah Buku</h1>



	<form method="post" enctype="multipart/form-data">
		<label>
			Judul : 
			<input type="text" name="judul">
		</label><br>

		<label>
			Pengarang : 
			<input type="text" name="pengarang">
		</label><br>

		<label>
			Penerbit : 
			<input type="text" name="penerbit">
		</label><br>

		<label>
			Gambar : 
			<input type="file" name="gambar">
		</label><br>

		<label>
			<button name="tambah">Tambah</button>
		</label>

	</form>
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
			location='index.php'
		</script>";
}



?>



