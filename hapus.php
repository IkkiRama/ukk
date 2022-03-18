<?php

require 'koneksi.php';

$id = $_GET['id'];

$conn->query("DELETE FROM buku WHERE id_buku = $id ");
echo "<script>
			alert('Data berhasil dihapus')
			location='index.php'
		</script>";

?>