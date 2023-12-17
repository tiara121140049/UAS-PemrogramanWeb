<?php

$conn = mysqli_connect('localhost','root','','Karyawan UAS');

function query($query) {
    global $conn;
    $result = mysqli_query($conn,$query);
    $datas  = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $datas[] = $data ;
    }
    return $datas ;
}

function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);

    $foto = upload();
    if(!$foto){
        return false;
    }

    $query = "INSERT INTO data_karyawan VALUES
            ('', '$foto', '$nama' ,'$nip', '$email', '$alamat')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if($error == 4){
        echo "<script>
            alert('Masukan Gambar Terlebih Dahulu..!!')
        </script>";
        return false;
    }

    $gambarValid = ['jpg','jpeg','png','gif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($gambarValid));

    if( !in_array($ekstensiGambar,$gambarValid) ){
        echo "<script>
        alert('Masukkan Hanya Gambar..!!')
    </script>";
    return false;
    }

    if($ukuranFile > 1500000){
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar..!')
    </script>";
    return false;
    }

    $newFile = uniqid();
    $newFile .= '.';
    $newFile .= $ekstensiGambar;

    move_uploaded_file($tmpName,'../images/'.$newFile);


    return $newFile;
}

function update($data){
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $fotoLama = $data['fotoLama'];

    if($_FILES['foto']['error'] == 4){
        $foto = $fotoLama;
    }else{
        $foto = upload();
    }

    if($_FILES['foto']['size'] > 1500000){
        $foto = $fotoLama;
    }

    $query = "UPDATE data_karyawan SET 
                nama = '$nama',
                nip = '$nip',
                email ='$email',
                alamat = '$alamat',
                foto = '$foto' WHERE 
                id= $id ";
    
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}
//   

function cari($keyword){
    global $conn;
    $dataperHalaman = 3;
    $jumlahData1 = count(query("SELECT * FROM data_karyawan WHERE 
    nama LIKE '%$keyword%' OR
    nip LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    alamat LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData1 / $dataperHalaman);
    $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1 ;
    $awalanData = ($dataperHalaman * $halamanAktif) - $dataperHalaman;

    $query = "SELECT * FROM data_karyawan WHERE 
    nama LIKE '%$keyword%' OR
    nip LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    alamat LIKE '%$keyword%' LIMIT $awalanData , $dataperHalaman ";

    return query($query);
}

function delete($id){
    global $conn;

    mysqli_query($conn,"DELETE FROM data_karyawan WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function daftar($data){
    global $conn;

    $nama = htmlspecialchars($_POST['nama']);
    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $password2 = mysqli_real_escape_string($conn,$_POST['password2']);
    $email = htmlspecialchars($_POST['email']);

    $result = mysqli_query($conn,"SELECT username FROM user WHERE
                username = '$username' ");

    if( mysqli_fetch_assoc($result) ){
        echo "<script>
        alert('User Baru Berhasil Di Tambahkan');
    </script>";
    return false;
    }

    if( $password !== $password2){
        echo "<script>
        alert('Password Yang Anda Masukan Tidak Sesuai');
    </script>";
        return false;
    }

    $password = password_hash($password,PASSWORD_DEFAULT);

    mysqli_query($conn,"INSERT INTO user VALUES('','$nama','$username','$password','$email')");

    return mysqli_affected_rows($conn);

}


?>