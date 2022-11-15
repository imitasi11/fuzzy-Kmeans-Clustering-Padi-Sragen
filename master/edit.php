<!DOCTYPE html>
<html lang="en">
<?php include('koneksi.php');

$sql = 'SELECT * FROM data ORDER BY id_data' ;
$result = $db->query($sql);
$jml_panen = 0;
$jml_produksi = 0;
foreach ($result as $row) {
    $jml_panen = $jml_panen+$row['panen'];
    $jml_produksi = $jml_produksi+$row['produksi'];
    }
?>
<?php include('linka.php'); ?>
<div id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Edit<br><strong class="black">Data Cluster</strong></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid padddd" >
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 padddd" >
            <div class="map_section" >
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12" style="margin-left: 15%;margin-top: -50px;">
                            <?php 

  $ids = $_GET['id'];
  $query_mysql = "SELECT * FROM data WHERE id_data='$ids'";
  $result = $db->query($query_mysql);

  foreach($result as $id){
                            ?>

                            <form class="main_form" action="edit-aksi.php" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input type="hidden" name="id" value="<?php echo $id['id_data'] ?>">
                                        <input class="form-control" placeholder="Nama Kecamatan" type="text" name="nama"  value="<?php echo $id['nama'] ?>" readonly>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                        <input class="form-control" placeholder="Jumlah Panen" type="number" name="panen"  value="<?php echo $id['panen'] ?>" required>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="Jumlah produksi" type="number" name="produksi"  value="<?php echo $id['produksi'] ?>" required>
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputFile">File GeoJson</label>
                                        <input type="file" name="file" id="file" required>
                                    </div>
                                    
                                    
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" name="upload" value="Upload" class="send">Update</button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        </div>
                    </div>
                </div>
               <div class="offer-bg">
            <div class="container">
                <div class="row" style="height: 450px;">
              
            </div>
        </div></div>
            </div>
        </div>
    </div>



    <!-- footer -->
    <!--  footer -->
    <footr>
     
        <div class="copyright">
            <div class="container">
                <p>© 2019 All Rights Reserved. Design By<a href="https://html.design/"> Free Html Templates</a></p>
           
        </div>
        </div>
    </footr>

    <!-- end footer -->
 
</body>

</html>