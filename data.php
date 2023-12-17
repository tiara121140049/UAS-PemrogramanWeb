<?php
require('functions/functions.php');

$keyword = $_GET['keyword'];

$query = "SELECT * FROM data_karyawan WHERE 
nama LIKE '%$keyword%' OR
nip LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
alamat LIKE '%$keyword%'";

$dataperHalaman = 3;
$jumlahData = count(query($query));
$jumlahHalaman = ceil($jumlahData / $dataperHalaman);
$halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1 ;
$awalanData = ($dataperHalaman * $halamanAktif) - $dataperHalaman;

$result= "SELECT * FROM data_karyawan WHERE 
nama LIKE '%$keyword%' OR
nip LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
alamat LIKE '%$keyword%' LIMIT $awalanData,$dataperHalaman ";

$data_pekerja = query($query);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document Tiara Putri Elisa</title>
</head>
<body>
    <div class="container">
        <div class="table" >
            <table  cellpadding="10" cellspacing="0"; >
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Edit</th>
                </tr>
                <?php $i = 1 ?>
                <?php foreach($data_pekerja as $datas) :?>
                <tr>
                    <td><?= $i + $awalanData ?></td>
                    <td><img src="images/<?= $datas['foto']; ?>" alt=""></td>
                    <td><?= ucwords($datas['nama']) ; ?></td>
                    <td><?= $datas['nip']; ?></td>
                    <td><?= $datas['email']; ?></td>
                    <td><?= ucwords($datas['alamat']); ?></td>
                    <div class="ubah">
                        <td class="change" >
                            <a href="update/update.php?id=<?= $datas['id']; ?>" class="update" >Update</a> |
                            <a href="delete.php?id=<?= $datas['id']; ?>" class="delete"  onclick="return confirm('Apakah Anda Yakin..??')">Delete</a>
                        </td>
                    </div>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
