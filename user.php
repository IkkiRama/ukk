<?php
$cari = "";
require 'koneksi.php';
if (empty($_SESSION['pelanggan'])) {
    echo "<script>
            alert('Anda belum login, silahkan login terlebih dahulu')
            location = 'login.php'
            </script>";
}


$data = [];

$ambil = $conn->query("SELECT * FROM user");
if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($conn, htmlspecialchars($_GET['keyword']));
    $cari = $_GET['keyword'];

    if (isset($keyword)) {
        $ambil = $conn->query("SELECT * FROM user WHERE 
            username LIKE '%$keyword%'  
            ");
    }
}

while($pecah = $ambil->fetch_assoc()){
    $data[] = $pecah;
}






?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>User | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Daftar User</h2>


        <a href="tambahUser.php" class="btn btn-primary btn-sm">Tambah User</a>

        <form method="get">
            <div class="form-group my-20">
                <div class="input-group">
                    <label>
                        <input type="text" value="<?php echo $cari ?>" name="keyword" placeholder="Cari User">
                    </label>

                    <button class="btn btn-primary btn-sm">Cari</button>
                </div>
            </div>
        </form>



        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value["username"] ?></td>
                        <td><?php echo $value["email"] ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="ubahUser.php?id=<?php echo $value['id_user'] ?>">Ubah</a>
                            <a class="btn btn-danger btn-sm" href="hapusUser.php?id=<?php echo $value['id_user'] ?>" onclick="return confirm('Yakin akan menghapus data ini?')" >Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <?php if (count($data) === 0): ?>
                        <td colspan="6" style="text-align: center;"><h2>Tidak ada data yang sesuai</h2></td>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

    </main>


    <?php require "script.php" ?>
</body>

</html>