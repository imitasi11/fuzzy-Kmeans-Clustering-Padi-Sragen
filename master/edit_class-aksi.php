<?php
include 'koneksi.php';
$panen=1;
$produksi=1;
$id = $_POST['id'];
$nama = $_POST['nama'];
$panen = $_POST['panen'];
$produksi = $_POST['produksi'];


$querys_mysql = "UPDATE cluster SET nama ='$nama',panen ='$panen',produksi ='$produksi' WHERE id_cluster='$id'";
$responden_result = $db->query($querys_mysql);
    header('location: class.php', true, 301);

?>