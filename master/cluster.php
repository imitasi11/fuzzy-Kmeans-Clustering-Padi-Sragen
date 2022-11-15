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
    <!-- for_box -->
    <div class="for_box_bg" align="center">
        <div class="container" align="center">
            <div class="row" align="center">
                <div class="col-xl-3 col-lg-3 col-md-3 co-sm-l2" style="margin-left: 25%;">
                    <div class="for_box">
                        <i><img src="images/1.png" alt="#"/></i>
                        <span><?php echo $jml_panen;?> (Ha)</span>
                        <h3>Luas Panen</h3>
                    </div>
                </div>
                               <div class="col-xl-3 col-lg-3 col-md-3 co-sm-l2">
                    <div class="for_box">
                        <i><img src="images/3.png" alt="#"/></i>
                        <span><?php echo $jml_produksi;?> (Ton)</span>
                        <h3>Produksi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end for_box -->
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
    <?php 
    if(isset($_GET['berhasil'])){
        echo "<p>".$_GET['berhasil']." Data berhasil di tambahkan.</p>";
    }
    ?>
 
    <div class="c-logo-part" style=" width:1179px;">
        <!--c-logo-part-start-->
        <div class="container">      
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <form class="search" action="Cluster.php" method="get">
                                    <input class="form-control" type="text" placeholder="Cari Kecamatan" name="cari">
                                    <button><img src="images/search_icon.png"></button>
                                </form>
            </div>
        
    </div>
    </div>
    <?php 
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
}
?>
    <div class="table-responsive" style="width: 1179px;">

    <div style="height: 370px;overflow-y: scroll;">
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
        if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $data = mysqli_query($connect,"select * from data where nama like '%".$cari."%'");      
        }else{
        $data = mysqli_query($connect,"select * from data");       
        }
        
        while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['panen']; ?></td>
                <td><?php echo $d['produksi']; ?></td> 
                <td>
                <a class="btn btn-xs btn-warning" href="edit.php?id=<?php echo $d['id_data']; ?>">Edit</a>
                </td>
                <td>
                <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $d['id_data']; ?>" onclick="return confirm('Hapus data?')">Delete</a>
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
        <div class="col-md-12" style="margin-top: 120px;">
                         <a href="cluster-aksi.php" class="read-more">Cluster</a>
                    </div>
                     <div class="col-md-12" style="margin-left: 220px;">
                         <a href="tambah-aksi.php" class="read-more">Tambah</a>
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