<?php
session_start();

if( !$_SESSION['login'] ){
    header('Location: login/login.php');
}

require ('functions/functions.php');

$dataperHalaman = 3;
$jumlahData = count(query("SELECT * FROM data_karyawan"));
$jumlahHalaman = ceil($jumlahData / $dataperHalaman);
$halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1 ;
$awalanData = ($dataperHalaman * $halamanAktif) - $dataperHalaman;


$data_pekerja = query("SELECT * FROM data_karyawan LIMIT $awalanData , $dataperHalaman ");

if( isset($_POST['serch']) ){
    $data_pekerja =  cari($_POST['keyword']);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Data Karyawan</title>
</head>
<body>
    <div class="container" >
        <h1 class="tittle">Data Karyawan PT.Tiara Putri Elisa</h1>
        <div class="menu" >
            <a href="tambah/tambah.php" class="tambah"  >Tambah Karyawan</a>
            <a href="logout.php" class="logout">Keluar</a>
        </div>
        <div class="serching">
            <form action="" method="post" >
                <input type="text" name="keyword" placeholder="Masukan Kata Kunci" class="keyword" id="keyword" >
                <button type="submit" name="serch" class="serch" id="btnCari" >Serch</button>
            </form>
        </div>

        <div class="paginations">
            <div class="prev" >
                <?php if($halamanAktif > 1): ?>
                    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                    <?php else : ?>
                    <?php endif; ?>
            </div>
            <div class="aktiv" >
                <?php for($i = 1 ;$i <= $jumlahHalaman; $i++ ) : ?>

                    <?php if($i == $halamanAktif) : ?>
                        <a href="?halaman=<?= $i ?>" class="on"  style="font-weight:bolder;color:red;" ><?= $i ?></a>

                        <?php else : ?>
                            <a href="?halaman=<?= $i ?>" class="off"  ><?= $i ?></a>
                        <?php endif; ?>
                <?php endfor; ?>
            </div>
            
            <div class="aft" >
                <?php if($halamanAktif < $jumlahHalaman): ?>
                    <a href="?halaman=<?= $halamanAktif + 1; ?>" >&raquo;</a>
                    <?php else : ?>
                    <?php endif; ?>
            </div>
        </div>

        <div class="table" id="container" >
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
        
                <?php $i = 1  ?>
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

    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script><script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script src="js/index.js" ></script>
</body>
</html>