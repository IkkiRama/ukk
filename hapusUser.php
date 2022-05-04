<?php

require 'koneksi.php';

$id = $_GET['id'];


$conn->query("DELETE FROM user WHERE id_user = '$id' ");
echo "<script>
			alert('Data berhasil dihapus')
			location='user.php'
		</script>";

?>