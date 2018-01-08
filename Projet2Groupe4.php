<!DOCTYPE html>
<html>
  <head>
    <link href="style.css" rel="stylesheet"><link>
    <h1> Reporting du projet 2 </h1>
    <meta charset=UTF-8>
    <form>
    <h3>Veuillez sélectionner une ville : </h3> 
    <select name="Ville" id="Ville">
      <option>Amsterdam</option>
      <option>Paris</option>
    </select>
    <input type='submit' value="Sélectionner">
	</form>
  </head>  
  <body>
  
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php
$ville = $_GET['Ville'];
$requete = "SELECT SUM(price)/COUNT(price) FROM " . $ville ; //REQUETE ADR
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['ADR', " . $row[0] . "],\n";
$db->close();
?>          
        ]);

        var options = {
          width: 300, height: 300,
          redFrom: 110, redTo: 150,
          yellowFrom:60, yellowTo: 110,
          minorTicks: 10,
          greenFrom: 0, greenTo: 60,
          max : 150
        };

        var chart = new google.visualization.Gauge(document.getElementById('adr'));

        chart.draw(data, options);


      }
    </script>


   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php
$ville = $_GET['Ville'];
$requete = "SELECT SUM(60-availability_60)/(COUNT(price))*1.66 FROM " . $ville ; //REQUETE Occupancy Rate
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['Occupancy Rate', " . $row[0] . "],\n";
$db->close();
?>          
        ]);

          var options = {
          width: 300, height: 300,
          redFrom: 80, redTo: 100,
          yellowFrom: 50, yellowTo: 80,
          minorTicks: 10,
          greenFrom: 0, greenTo: 50,
          max : 100
        };

        var chart = new google.visualization.Gauge(document.getElementById('occupancyrate'));

        chart.draw(data, options);


      }
    </script>


   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php
$ville = $_GET['Ville'];
$requete = "SELECT (SUM(price)/COUNT(price))*(SUM(60-availability_60)/(COUNT(price))*0.0166)*30 FROM " . $ville ; //REQUETE ADR
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['Revenue', " . $row[0] . "],\n";
$db->close();
?>          
        ]);

          var options = {
          width: 300, height: 300,
          redFrom: 3000, redTo: 4000,
          yellowFrom: 1500, yellowTo: 3000,
          minorTicks: 10,
          greenFrom: 0, greenTo: 1500,
          max : 4000
        };

        var chart = new google.visualization.Gauge(document.getElementById('revenue'));

        chart.draw(data, options);


      }
    </script>



   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php
$ville = $_GET['Ville'];
$requete = "SELECT COUNT(*) FROM " . $ville ; //REQUETE Active Rentals
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['Active Rentals', " . $row[0] . "],\n";
$db->close();
?>          
        ]);

          var options = {
          width: 300, height: 300,
          redFrom: 50000, redTo: 60000,
          yellowFrom: 30000, yellowTo: 50000,
          minorTicks: 10,
          greenFrom: 0, greenTo: 30000,
          max : 60000
        };


        var chart = new google.visualization.Gauge(document.getElementById('activerentals'));

        chart.draw(data, options);


      }
    </script>



   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php
$ville = $_GET['Ville'];
$requete = "SELECT COUNT(calendar_updated) FROM " . $ville . " WHERE (calendar_updated<60)"; //REQUETE Active Hosts
$db = new SQLite3('hugo.db'); //a modif
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['Active Hosts', " . $row[0] . "],\n";
$db->close();
?>          
        ]);

        var options = {
          width: 300, height: 300,
          redFrom: 33000, redTo: 40000,
          yellowFrom: 19000, yellowTo: 33000,
          minorTicks: 10,
          greenFrom: 0, greenTo: 19000,
          max : 40000
        };

        var chart = new google.visualization.Gauge(document.getElementById('activehosts'));

        chart.draw(data, options);


      }
    </script>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Hosts',"Nombre d'hôtes"],

<?php
$ville = $_GET['Ville'];
$requete = "SELECT 'Superhost',count(host_is_superhost) FROM  " . $ville . " where (host_is_superhost) like 't' UNION
SELECT 'Single-listing Hosts',COUNT(host_listings_count) FROM " . $ville . " WHere (host_listings_count <=1) AND
(calendar_updated<60) UNION select 'Multi-listing Hosts',count(host_listings_count) from " . $ville . " where
(host_listings_count > 1) and (calendar_updated<60)"; //REQUETE ADR
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
    echo "['" . $row[0] . "', ". $row[1] . "],\n";
$db->close();
?>
]);
          

        var options = {
          chart: {
            title: "Diagrammes en barres représentant le nombre d'hôtes par type d'hôte",
            subtitle: 'Source : AIRDNA, 2017',
          },
				bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('hosts'));

        chart.draw(data, options);
      }
    </script>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
					['Rental Type','Nombre de types \n de biens différents'],

<?php
$ville = $_GET['Ville'];
$requete = "select room_type,count(room_type) from " . $ville . " group by room_type having count(room_type) > 2;"; //REQUETE Rental Type
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['" . $row[0] . "', ". $row[1] . "],\n";
$db->close();
?>
]);
          

        var options = {
          chart: {
            title: 'Diagrammes en barres représentant le nombre de biens par type',
            subtitle: 'Source : AIRDNA, 2017',
          },
				bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('rentaltype'));

        chart.draw(data, options);
      }
    </script>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
					['Rental Size','Nombre de biens'],

<?php
$ville = $_GET['Ville'];
$requete = "SELECT 'Studio',count(bedrooms) from " . $ville . " where bedrooms=0 UNION select bedrooms,count(bedrooms)
from amsterdam where bedrooms=1 UNION select bedrooms,count(bedrooms) from " . $ville . " where bedrooms=2 UNION select bedrooms,
count(bedrooms) from " . $ville . " where bedrooms=3 UNION select bedrooms,count(bedrooms) from " . $ville . " where bedrooms=4
UNION select '5 et +',count(bedrooms) from " . $ville . " where bedrooms >=5;"; //REQUETE Rental Size
$db = new SQLite3('hugo.db');
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['" . $row[0] . "', ". $row[1] . "],\n";
$db->close();
?>
]);
          

        var options = {
          chart: {
            title: 'Diagrammes en barres représentant le nombre de chambres disponibles par bien',
            subtitle: 'Source : AIRDNA, 2017',
          },

        };

        var chart = new google.charts.Bar(document.getElementById('rentalsize'));

        chart.draw(data, options);
      }
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Temps', 'Nombre de locations'],
<?php
$ville = $_GET['Ville'];
$requete = "select 'De 1 à 3 mois',count(price) from " . $ville . " where (availability_365)<91 UNION
select 'De 4 à 6 mois',count(price) from " . $ville . " where (availability_365)>90 AND (availability_365)<182 UNION
select 'De 7 à 9 mois',count(price) from " . $ville . " where (availability_365)>181 AND (availability_365)<273 UNION
select 'de 10 à 12 mois',count(price) from " . $ville . " where (availability_365)>272"; //REQUETE Rental Activity
$db = new SQLite3('hugo.db'); 
$results = $db->query($requete);
while ($row = $results->fetchArray())
	echo "['" . $row[0] . "', ". $row[1] . "],\n";
$db->close();
?>          
]);

        var options = {
          title: "Rental Activity : Nombre de mois où les propriétés actives sont disponibles",
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('rentalactivity'));
        chart.draw(data, options);
      }
    </script>
    
    <table>
    <tr>
    <td><div id="adr" style="width: 400px; height: 320px;"></div></td>
    <td><td><td><td><td><td><td><td><td><td><td><td><td><td><td><td>
    <td><div id="occupancyrate" style="width: 400px; height: 320px;"></div></td>
    <td><td><td><td><td><td><td><td><td><td><td><td><td><td><td><td>
    <td><div id="revenue" style="width: 400px; height: 320px;"></div></td>
    </tr>
    </table>
    <table>
    <tr>
    <td><div id="rentalsize" style="width: 900px; height: 500px;"></div></td>
    <td><td><td><td><td><td><td><td><td><td><td><td><td><td><td><td>
    <td><div id="activerentals" style="width: 400px; height: 320px;"></div></td>  
    </tr>
    </table>
    <table>
    <tr>
    <td><div id="rentaltype" style="width: 750px; height: 400px;"></div></td>
    <td><div id="rentalactivity" style="width: 750px; height: 400px;"></div></td>
    </tr>
    </table>
    <table>
    <tr>
    <td><div id="hosts" style="width: 900px; height: 500px;"></div></td>
    <td><td><td><td><td><td><td><td><td><td><td><td><td><td><td><td>
    <td><div id="activehosts" style="width: 400px; height: 320px;"></div></td>
    </tr>
    </table>
    <div id="Ville"></div>
    <h2>Reporting web réalisé par Clément Leconte, Hugo Broucke, Romain Douesnard et Camille Ollivier</h2>
  </body>
</html>
