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

    <!-- about -->
    
    <!-- offer -->
    <div class="offer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Cluster Padi<strong class="black"> Sragen</strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="offer-bg">
            <div class="container">
                <div class="row">
                    
<section class="main-section paddind" id="Portfolio">
        <!--main-section-start-->
        <div class="container" >
        <div class="table-responsive" style="width: 1179px;">

    <div style="height: 700px;">
    <table border="1px" style="color: white;" class="table table-bordered table-hover table-striped" width="100%">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Luas Panen</th>
            <th>Produksi</th>
            <th colspan="2">Aksi</th>
        </tr>
        </thead>
        <tbody>
            
            
        
        <?php 
        include 'koneksi.php';
        $no=1;
        
        $data = mysqli_query($connect,"select * from cluster");       

        
        while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['panen']; ?></td>
                <td><?php echo $d['produksi']; ?></td> 
                <td>
                <a class="btn btn-xs btn-warning" href="edit_class.php?id=<?php echo $d['id_cluster'];?>">Edit</a>
                </td>
             </tr>
            <?php 
        }
        ?>
         
 </tbody>

    </table>
 </div>
</div>
 
 </div>
    </section>
                    
                </div>

            </div>
        </div>
    </div>

    <!-- end offer -->

   

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