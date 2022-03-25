<?php
require 'koneksi.php';
if (empty($_SESSION['pelanggan'])) {
	echo "<script>
			alert('Anda belum login, silahkan login terlebih dahulu')
			location = 'login.php'
			</script>";
}


$data = [];

$ambil = $conn->query("SELECT * FROM buku");
if (isset($_GET['cari'])) {
	$_GET['cari'] = true;
	$keyword = mysqli_real_escape_string($conn, htmlspecialchars($_GET['keyword']));
	
	if (isset($keyword)) {
		$ambil = $conn->query("SELECT * FROM buku WHERE judul LIKE '%$keyword%' ");
	}
}

while($pecah = $ambil->fetch_assoc()){
	$data[] = $pecah;
}






?>

<!DOCTYPE html>
<html>
<head>
	<title>Toko Buku Anjay</title>
</head>
<body>

	<h1>Toko Buku Anjay</h1>

	<a href="tambah.php">Tambah Buku</a><br><br>

	<form method="get">
		<label>
			<input type="text" name="keyword">
		</label>

		<button name="cari">Cari</button>
	</form>

	<br>
	<a href="logout.php">Logout</a>
	<br>
	<br>
	<br>


	<table border="1" cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>Gambar</th>
				<th>Aksi</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($data as $key => $value): ?>
			<tr>
				<td><?php echo $key+1 ?></td>
				<td><?php echo $value["judul"] ?></td>
				<td><?php echo $value["pengarang"] ?></td>
				<td><?php echo $value["penerbit"] ?></td>
				<td>
					<img width="100" height="80" src="foto_buku/<?php echo $value['gambar'] ?>">
				</td>
				<td>
					<a href="ubah.php?id=<?php echo $value['id_buku'] ?>">Ubah</a>
					<a href="hapus.php?id=<?php echo $value['id_buku'] ?>" onclick="return confirm('Yakin akan menghapus data ini?')" >Hapus</a>
				</td>
			</tr>
			<?php endforeach ?>

			<?php if (count($data) === 0): ?>
				<td colspan="6" style="text-align: center;"><h2>Tidak ada data yang sesuai</h2></td>
			<?php endif ?>
		</tbody>
	</table>


</body>
</html>