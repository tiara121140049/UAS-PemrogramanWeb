<?php

session_start();

require ('../functions/functions.php');

if( isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id ");
    $data = mysqli_fetch_assoc($result);
    
    if( $key === hash('sha256',$data['username'])){
        $_SESSION['login'] = true;
    }

}

if( isset($_SESSION['login'])){
    header('Location: ../index.php');
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $result = mysqli_query($conn,"SELECT * FROM user WHERE username ='$username' ");
    if(mysqli_num_rows($result) === 1 ){
        $data = mysqli_fetch_assoc($result);

        if(password_verify($password,$data['password'])){
            $_SESSION['login'] = true;
        }
        
        if( isset($_POST['remember'])){
            setcookie('id',$data['id'],time() + 120);
            setcookie('key',hash('sha256',$data['usernmae']),time() + 120);
        }
        header('Location: ../index.php');
        exit;
    }

    $error = true;

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginn.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class=" d-flex flex-column ">
            <h1 class="mb-5">Welcome <span style="color:blue">to</span> PT. Tiara Putri Elisa</h1>
            
            <?php if(isset($error)) :?>
                <p style="color:red; font-style:italic;">Username Atau Password Salah !!</p>
                <div class=" d-flex flex-column mt-3 gap-2">
                    <?php endif; ?>
                <form action="" method="post" >
                <label for="passwordLength" class="text-uppercase fw-bold">Username</label>
                <input class="form-control form-control-lg" id="passwordLength" type="text" name="username" />

                <label for="password" class="text-uppercase fw-bold">Password</label>
                <input class="form-control form-control-lg " id="password" type="password" name="password" />
                <div class="chxbox">
                    <input type="checkbox" class="remember" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit" name="login" class="btn btn-dark text-uppercase  fw-bold mt-2 btn-control-lg" >Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>