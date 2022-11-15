<html lang="en">
<?php include('koneksi.php');?>
<?php $coba=1;

?>
  <head>
    <meta charset="utf-8" />
    <script src="jquery-3.6.0.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="leaflet/leaflet.js"></script>
    <link rel="stylesheet" href="leaflet/leaflet.css" />
    <style>
      html, body {
        height: 100%;
        padding: 0;
        margin: 0;
      }
    </style>
  </head>
  <?php include('linka.php'); ?>
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
    <div id="map" style="width:1200px; height:500px"></div>
  </div>
  </div>
</div>
</div>
    <script>
      // initialize Leaflet
      var map = L.map('map').setView([-7.421638, 111.022733], 11);

      // add the OpenStreetMap tiles
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
      }).addTo(map);
      // show the scale bar on the lower left corner
      L.control.scale().addTo(map);

      function addShape(name, cluster) {
      $.getJSON("Geojson/"+name+".geojson",function(data){
      var clusterJson = cluster;
      var warna;
      var keterangan;
      if(clusterJson==1) { warna = 'green';keterangan = 'banyak';}
      if(clusterJson==2) { warna = 'yellow';keterangan = 'cukup';}
      if(clusterJson==3) { warna = 'red';keterangan = 'sedikit';}

      // add GeoJSON layer to the map once the file is loaded
      L.geoJson(data, {
        style: function(feature){
          return{
            opacity: 1.0,
            color: warna,
            fillcolor: warna,
          }
        },
        onEachFeature: function( feature, layer ){
        layer.bindPopup( "<strong>" + name + "</strong><br/>Termasuk Cluster : " + keterangan)
        }

      }).addTo(map);
      });
      }




        <?php

          $query = mysqli_query($connect,"SELECT * from data");
          while ($data = mysqli_fetch_array($query)) {
            $nama = $data['nama'];
            $cluster= $data['cluster'];
            echo ("addShape('$nama','$cluster');\n");                        
          }
          ?>
       
    </script>
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