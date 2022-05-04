<?php


require 'koneksi.php';
$id = $_GET['id'];

$ambil = $conn->query("SELECT * FROM user WHERE id_user = '$id' ");
$pecah = $ambil->fetch_assoc(); 

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <?php require "meta.php" ?>
    <title>Ubah User | Admin</title>
    <?php require "css.php" ?>
</head>

<body>

    <?php require "header.php" ?>

    <?php require 'aside.php' ?>


    <main>
        <h2>Ubah User</h2>


        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Username : </label>
                <input type="text" value="<?php echo $pecah['username'] ?>" name="username">
            </div>

            <div class="form-group">
                Email : 
                <input type="email" value="<?php echo $pecah['email'] ?>" name="email">
            </div>

            <button class="btn btn-warning" name="ubah">Ubah</button>
        </form>

    </main>


    <?php require "script.php" ?>
</body>

</html>
<?php

if (isset($_POST['ubah'])) {


    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));


    if (empty($username) || empty($email)) {
        echo "<script>
            alert('Harap isi semua formulir')
            location='ubahUser.php?id=$id'
        </script>";
    }


    $conn->query("UPDATE user SET
        username = '$username',
        email = '$email'
        WHERE id_user = '$id'
    ");

    echo "<script>
            alert('Data berhasil diubah')
            location='user.php'
        </script>";
}



?>

