<?php

session_start();

if( !$_SESSION['login'] ){
    header('Location: ../login/login.php');
}

require '../functions/functions.php';

$id = $_GET['id'];

$datas = query("SELECT * FROM data_karyawan WHERE id = $id ")[0];

if(isset($_POST['submit'])){

    if( update($_POST) > 0){
        echo "<script>
        alert('Data Berhasil Di Update');
        document.location.href = '../index.php';
        </script>";
    }else{
    echo "<script>
        alert('Data Gagal Di Update');
        document.location.href = reload();
    </script>";
      
    }
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updates.css">
    <title>Update Data</title>
</head>
<body>
<div class="container">
    <h1>Update Data Karyawan</h1>
    <div class="wrap">
        <form action="" method="post" enctype="multipart/form-data"  >
            <input type="hidden" name="fotoLama" value="<?= $datas['foto'] ?>" >
            <input type="hidden" name="id" value="<?= $datas['id'] ?>">
            <div class="card">
                <h3>Nama :</h3>
                <input type="text" name="nama" size="80" value="<?= $datas['nama'] ?>" required >
            </div>
            <div class="card" >
                <h3>NIP :</h3>
                <input type="text" name="nip"  size="80" value="<?= $datas['nip'] ?>" required>
            </div>
            <div class="card" >
                <h3>Email :</h3>
                <input type="text" name="email"  size="80" value="<?= $datas['email'] ?>" required>
            </div>
            <div class="card" >
                <h3>Alamat :</h3>
                <textarea name="alamat" id="" cols="76" rows="8"><?= $datas['alamat']?></textarea>
            </div>
            <div class="card" >
                <h3>Foto :</h3>
                <img src="../images/<?= $datas['foto']; ?>" class="gambar" alt="">
                <div class="posisi">
                <input type="file" name="foto" style="cursor:pointer;" value="<?= $datas['foto'] ?>" >
                </div>
            </div>
            <div class="btn">
                <button type="submit" name="submit" onclick="return confirm('Apakah Anda Yakin ??')" >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>