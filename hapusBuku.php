<?php

require 'koneksi.php';

$id = $_GET['id'];

$ambil = $conn->query("SELECT * FROM buku WHERE id_buku = '$id' ");
$pecah = $ambil->fetch_assoc();

unlink("foto_buku/".$pecah['gambar']);


$conn->query("DELETE FROM buku WHERE id_buku = '$id' ");
echo "<script>
			alert('Data berhasil dihapus')
			location='buku.php'
		</script>";

?>