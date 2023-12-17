<?php

session_start();

if( !$_SESSION['login'] ){
    header('Location: ../login/login.php');
}

require ('../functions/functions.php');

if(isset($_POST['submit'])){
    if(tambah($_POST) > 0){
        echo "<script>
        alert('Data Berhasil Di Tambahkan');
        document.location.href = '../index.php';
</script>";
}else{
    echo
    "<script>
        alert('Data Gagal Di Tambahkan');
        document.location.href = '../index.php';
</script>";
}
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title>Tambah Data</title>
</head>
<body>
<div class="container">
    <h1>Tambah Data Karyawan</h1>
    <div class="wrap">
        <form action="" method="post" enctype="multipart/form-data" >
            <div class="card">
                <h3>Nama :</h3>
                <input type="text" name="nama" size="80" required >
            </div>
            <div class="card" >
                <h3>NIP :</h3>
                <input type="text" name="nip"  size="80" required >
            </div>
            <div class="card" >
                <h3>Email :</h3>
                <input type="text" name="email"  size="80" required >
            </div>
            <div class="card" >
                <h3>Alamat :</h3>
                <textarea type="text" name="alamat"  cols="76" rows="8" required ></textarea>
            </div>
            <div class="card" >
                <h3>Foto :</h3>
                <input type="file" name="foto" style="cursor:pointer;" >
            </div>
            <div class="btn">
                <button type="submit" name="submit" >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>