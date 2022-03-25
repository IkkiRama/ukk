<?php
require "koneksi.php";


unset($_SESSION['pelanggan']);
session_destroy();

echo "<script>
		alert('Anda berhasil logout')
		location='login.php'
	</script>";






?>