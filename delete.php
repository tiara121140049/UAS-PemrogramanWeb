<?php

session_start();

if( !$_SESSION['login'] ){
    header('Location: login/login.php');
}

require 'functions/functions.php';

$id = $_GET['id'];

if( delete($id) ){
    echo "<script>
    alert('Data Berhasil Di Hapus');
    document.location.href = 'index.php';
</script>";
}else{
    echo
"<script>
    alert('Data Gagal Di Hapus');
    document.location.href = 'index.php';
</script>";
}

?>
