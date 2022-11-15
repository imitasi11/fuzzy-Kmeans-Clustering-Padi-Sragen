<?php
include 'koneksi.php';
$panen=1;
$produksi=1;
$id = $_POST['id'];
$nama = $_POST['nama'];
$panen = $_POST['panen'];
$produksi = $_POST['produksi'];

$target_dir = "Geojson/";
$target_check = $target_dir . basename($_FILES["file"]["name"]);
$titik='.';
$imageFileType = strtolower(pathinfo($target_check,PATHINFO_EXTENSION));
$target_file = $target_dir . basename($nama.$titik.$imageFileType);
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  if($imageFileType != "geojson") {
  echo "Maaf hanya geojson yang diperbolehkan ";
  echo '<br><a href="tambah.php">Kembali</a>';
    $uploadOk = 0;
}
}


// Allow certain file formats


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
// if everything is ok, try to upload file
} else {
	if (file_exists($target_file)) {
   		unlink($target_file);
	}
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
  	
    $querys_mysql = "UPDATE data SET nama ='$nama',panen ='$panen',produksi ='$produksi' WHERE id_data='$id'";
    $responden_result = $db->query($querys_mysql);
    header('location: cluster.php', true, 301);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

?>