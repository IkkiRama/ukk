<?php


require 'koneksi.php';
$id = $_GET['id'];

$ambil = $conn->query("SELECT * FROM buku WHERE id_buku = $id ");
$pecah = $ambil->fetch_assoc();



?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Buku</title>
</head>
<body>

	<h1>Ubah Buku</h1>



	<form method="post" enctype="multipart/form-data">
		<label>
			Judul : 
			<input type="text" value="<?php echo $pecah['judul'] ?>" name="judul">
		</label><br>

		<label>
			Pengarang : 
			<input type="text" value="<?php echo $pecah['pengarang'] ?>" name="pengarang">
		</label><br>

		<label>
			Penerbit : 
			<input type="text" value="<?php echo $pecah['penerbit'] ?>" name="penerbit">
		</label><br>

		<label>
			Gambar : 
			<br>
			<img width="100" height="100" src="foto_buku/<?php echo $pecah['gambar'] ?>" >
			<br>
			<input type="file" name="gambar">
		</label><br>

		<label>
			<button name="ubah">Ubah</button>
		</label>

	</form>
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
			location='ubah.php?id=$id'
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
				location='ubah.php?id=$id'
			</script>";
		}

		if ($size >= 3000000) {
			echo "<script>
				alert('File foto terlalu besar')
				location='ubah.php?id=$id'
			</script>";
		}

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
			location='index.php'
		</script>";
}



?>



