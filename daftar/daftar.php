<?php

    require ('../functions/functions.php');

    if(isset($_POST['daftar'])){
        if( daftar($_POST) > 0 ){
            echo "<script>
        alert('User Baru Berhasil Di Tambahkan');
        </script>";
    }else{
        echo mysqli_error($conn);
    }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="daftars.css">
</head>
<body>
    <div class="container" >
        <h1 class="tittle">Registrasi Akun</h1>
        <div  class="wrap" >
            <form action="" method="post">
            <div class="card" >
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama">
                </div>
                <div class="card">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="card">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="card">
                    <label for="password2">Konpirmasi Password</label>
                    <input type="password" name="password2" id="password2">
                </div>
                <div class="card">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div>
                    <button type="submit" name="daftar" >Daftar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>