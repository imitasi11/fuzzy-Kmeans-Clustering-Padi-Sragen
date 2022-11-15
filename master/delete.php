<?php 
include 'koneksi.php';
$id = $_GET['id'];
$delete_id= "DELETE FROM data where id_data ='$id' ";
$id_result = $db->query($delete_id);
header("location:cluster.php");
?>