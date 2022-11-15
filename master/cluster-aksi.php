<?php
include "koneksi.php";
set_time_limit(0);
$count=1;

function largest($arr, $n)
{
    $i;
    // Initialize maximum element
    $max = $arr[1];
 
    // Traverse array elements
    // from second and
    // compare every element 
    // with current max 
    for ($i = 1; $i < $n; $i++)
        if ($arr[$i] > $max)
            $max = $arr[$i];
 
    return $max;
}  
function littest($arr, $n)
{
    $i;
     
    // Initialize maximum element
    $max = $arr[1];
 
    // Traverse array elements
    // from second and
    // compare every element 
    // with current max 
    for ($i = 1; $i < $n; $i++)
        if ($arr[$i] < $max)
            $max = $arr[$i];
 
    return $max;
}   

$sql = 'SELECT * FROM data ORDER BY id_data' ;
$result = $db->query($sql);
$jml_panen = 0;
$jml_produksi = 0;
$count=1;
foreach ($result as $row) {
    $iddata[$count]=$row['id_data'];
    $panen[$row['id_data']]=$row['panen'];
    $produksi[$row['id_data']]=$row['produksi'];
    $count=$count+1;
    }
    $maxpanen=largest($panen, count($panen));
    $minpanen=littest($panen, count($panen));
    $maxproduksi=largest($produksi, count($produksi));
    $minproduksi=littest($produksi, count($produksi));

$sql = 'SELECT * FROM cluster ORDER BY id_cluster' ;
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$pcluster=array();
//-- melakukan iterasi pengisian array cluster pertama untuk tiap record data yang didapat
$count=1;
$clustername=array();
foreach ($result as $row) {
    $clustername[$count]=$row['nama'];
    $pcluster[0][$count][1]=$row['panen'];
    $pcluster[0][$count][2]=$row['produksi'];
    $count=$count+1;
    } 


$count=1;
$filterhasil=0;

$sql = 'SELECT * FROM data ORDER BY id_data' ;
$result = $db->query($sql);
$data=array();
$cluzbowl=array();
$jumlahc=array();
$keterangan=0;

//iterasi pertama
foreach ($result as $row) {
    $normalizepanen=(1-(($row['panen']-$minpanen)/($maxpanen-$minpanen)));
    $normalizeproduksi=(1-(($row['produksi']-$minproduksi)/($maxproduksi-$minproduksi)));
    $data[0][$count][1]=$row['id_data'];
    $data[0][$count][2]=$row['nama'];
    $data[0][$count][3]=$normalizepanen;
    $data[0][$count][4]=$normalizeproduksi;
    //perhitungan cluster 1
    $cluzbowl[1]=sqrt(pow(($normalizepanen-$pcluster[0][1][1]),2)+pow(($normalizeproduksi-$pcluster[0][1][2]),2));
    //perhitungan cluster 2
    $cluzbowl[2]=sqrt(pow(($normalizepanen-$pcluster[0][2][1]),2)+pow(($normalizeproduksi-$pcluster[0][2][2]),2));
    //perhitungan cluster 3
    $cluzbowl[3]=sqrt(pow(($normalizepanen-$pcluster[0][3][1]),2)+pow(($normalizeproduksi-$pcluster[0][3][2]),2));
    //penampungan data cluster
    $data[0][$count][5]=$cluzbowl[1];
    $data[0][$count][6]=$cluzbowl[2];
    $data[0][$count][7]=$cluzbowl[3];
    //pencarian cluster dengan nilai terkecil
    $min=MIN($cluzbowl[1],$cluzbowl[2],$cluzbowl[3]);
    //pencarian jumlah pada tiap cluster untuk iterasi 1 dan penulisan keterangan
    for($i=1;$i<=count($cluzbowl);$i++){
    if($min==$cluzbowl[$i]){
        $keterangan=$i; 
        if(!isset($pcluster[1][$i][1])){
        $pcluster[1][$i][1]=$normalizepanen;
        $pcluster[1][$i][2]=$normalizeproduksi;
        $jumlahc[1][$i]=1;
        }else{
        $pcluster[1][$i][1]=$pcluster[1][$i][1]+$normalizepanen;
        $pcluster[1][$i][2]=$pcluster[1][$i][2]+$normalizeproduksi;
        $jumlahc[1][$i]=$jumlahc[1][$i]+1;
        }
    }
    }
    //menyimpan data hasil
    $data[0][$count][8]=$keterangan;
    $count=$count+1;
    }


        //membuat perulangan dan batasan iterasi sejumlah 100
        for($i=1;$i<100;$i++){
            //$w digunakan untuk mengambil data yang sebelumnya
        $w=$i-1;
        $v=$i+1;
        //melakukan pembuatan cluster baru, sesuai dari cluster sebelumnya
        for($j=1;$j<=3;$j++){
        for($k=1;$k<=2;$k++){
            $pcluster[$i][$j][$k]=$pcluster[$i][$j][$k]/$jumlahc[$i][$j];
            }
        }
        //melakukan perulangan untuk tiap baris data
        for($j=1;$j<=count($data[0]);$j++){
        $data[$i][$j][1]=$data[$w][$j][1];
        $data[$i][$j][2]=$data[$w][$j][2];
        $data[$i][$j][3]=$data[$w][$j][3];
        $data[$i][$j][4]=$data[$w][$j][4];
        //melakukan perulangan pada tiap cluster untuk melakukan perhitungan cluster
        $cluzbowl[1]=sqrt(pow(($data[$i][$j][3]-$pcluster[$i][1][1]),2)+pow(($data[$i][$j][4]-$pcluster[$i][1][2]),2));
        //perhitungan cluster 2
        $cluzbowl[2]=sqrt(pow(($data[$i][$j][3]-$pcluster[$i][2][1]),2)+pow(($data[$i][$j][4]-$pcluster[$i][2][2]),2));
        //perhitungan cluster 3
        $cluzbowl[3]=sqrt(pow(($data[$i][$j][3]-$pcluster[$i][3][1]),2)+pow(($data[$i][$j][4]-$pcluster[$i][3][2]),2));
        
        //melakukan penampungan data cluster
        $data[$i][$j][5]=$cluzbowl[1];
        $data[$i][$j][6]=$cluzbowl[2];
        $data[$i][$j][7]=$cluzbowl[3];
        //pencarian cluster dengan nilai terkecil
        $min=MIN($cluzbowl[1],$cluzbowl[2],$cluzbowl[3]);

        for($k=1;$k<=count($cluzbowl);$k++){
            if($min==$cluzbowl[$k]){
            $keterangan=$k; 
            if(!isset($pcluster[$v][$k][1])){
            $pcluster[$v][$k][1]=$data[$i][$j][3];
            $pcluster[$v][$k][2]=$data[$i][$j][4];
            $jumlahc[$v][$k]=1;
            }else{
            $pcluster[$v][$k][1]=$pcluster[$v][$k][1]+$data[$i][$j][3];
            $pcluster[$v][$k][2]=$pcluster[$v][$k][2]+$data[$i][$j][4];
            $jumlahc[$v][$k]=$jumlahc[$v][$k]+1;
            }
            }
        }
        $data[$i][$j][8]=$keterangan;
        //melakukan stop bila pada iterasi sekarang dan sebelumnya nilai cluster sama
        if($data[$i][$j][8]==$data[$w][$j][8]){
            $filterhasil=$filterhasil+1;
        }
        
    }
    //melakukan stop bila pada iterasi sekarang dan sebelumnya nilai cluster sama
    if($filterhasil==count($data[0])){
        if($i==1){

        }else{
                $i=100;
            }
    }
    //melakukan peresetan pada filter
    $filterhasil=0;
}
?>
<?php include('linka.php'); ?>
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
            <div class="container" style="padding:0px;">
                <div class="row">
                     <h2 style="color: white;">Perhitungan Akhir Cluster</h2>
                     <?php 
                     $i=count($data)-1;
                     ?>
                    

                    <table border="1px" style="color: white;" class="table table-bordered table-hover table-striped" width="100%">
                        <thead class="thead-dark">
                        <tr>
                        <th>No</th>
                        <th>Kecamatan</th>
                        <th>Luas Panen</th>
                        <th>Produksi</th>
                        <th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
                        <th>kriteria</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php for($j=1;$j<=count($data[0]);$j++){?>
                        <tr>
                            <?php for($k=1;$k<=8;$k++){?>
                            <td><?php echo $data[$i][$j][$k];?></td>
                            <?php }
                            $wid_data=$data[$i][$j][1];
                            $inputcluster=$data[$i][$j][8];
                            mysqli_query($connect,"UPDATE data SET cluster='$inputcluster' WHERE id_data ='$wid_data'");
                            } ?>
                       </tr>
                    </tbody>
                    </table>
              

                </div>
                <div class="row">
                    <h3 style="color: white;"> Hasil Akhir Cluster </h3>
    <?php 
          $i=count($data)-1;
          $v=$i+1;
        
    ?>
    <table border="1px" style="color: white;" class="table table-bordered table-hover table-striped" width="100%">
        <tr>
            <td>#</td>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td><?php echo $jumlahc[$v][1];?></td>
            <td><?php echo $jumlahc[$v][2];?></td>
            <td><?php echo $jumlahc[$v][3];?></td>
        </tr>
    </table>
    </div>
    <div class="row">
    <div id="div1">
    <table border="1px" style="color: white;" class="table table-bordered table-hover table-striped" width="100%">
        <tr>
            <td><?php echo $clustername[1];?></td>
            <td><?php echo $clustername[2];?></td>
            <td><?php echo $clustername[3];?></td>
        </tr>
        <tr>
            <td valign="top">
                <?php for($j=1;$j<=count($data[0]);$j++){ ?>
                <?php 
                if($data[$i][$j][8]==1){?>
                    <?php
                    echo $data[$i][$j][2];?>
                    <br>
                <?php }} ?>


            </td>
            <td valign="top"><?php for($j=1;$j<=count($data[0]);$j++){ ?>
                <?php 
                if($data[$i][$j][8]==2){?>
                    <?php
                    echo $data[$i][$j][2];?>
                    <br>
                <?php }} ?>
            </td>
            <td valign="top">
            <?php for($j=1;$j<=count($data[0]);$j++){ ?>
                <?php 
                if($data[$i][$j][8]==3){?>
                    <?php
                    echo $data[$i][$j][2];?>
                    <br>
                <?php }} ?>
            </td>
        </tr>
    </table>
</div></div>
<div class="col-md-12" style="margin-top: 120px;">
                        <a href="map.php" class="read-more">MAP</a>
                    </div>
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