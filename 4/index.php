<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset='utf-8'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <style>#map{height: 300px;}</style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>Grafik</h1>
        <button onClick="ucitaj_grafikon();"> Ucitaj grafik</button>
      <div id="chart_div"></div>
      </div>
      <div class="col-lg-6">
        <h1>Mapa</h1>
        <button onClick="ucitajMarkere();"> Ucitaj markere</button>
        <br><br>
          <div id="map"></div>
      </div>
    </div>
  </div>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
  <script>//Uneti svoj api key kada hocemo da pokrenemo mapu</script>
  <script>
    
    google.charts.load('current', {packages: ['corechart', 'bar']});
  //google.charts.setOnLoadCallback(drawColColors);
  var chart;
  var data;
function ucitaj_grafikon(){
  $.getJSON("skripta_ukupno.php", function(json){
    var jsonData = '{"cols": [{"Kategorija":"","label":"Kategorija","type":"string"},{"Ukupno":"","label":"Ukupno","type":"number"}],"rows": [';
    $.each(json, function(i, value){
      if(i == json.length - 1){
        jsonData+= '{"c":[{"v":"'+value.kategorija+'"},{"v":'+value.ukupno+'}]}'
      }else {
        jsonData+= '{"c":[{"v":"'+value.kategorija+'"},{"v":'+value.ukupno+'}]},'
      }
      
    });
    jsonData += ']}';
    data = new google.visualization.DataTable(jsonData);
    chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data);
    google.visualization.events.addListener(chart, 'select', selectHandler)
  });
}
function selectHandler(){
  var selectedItem = chart.getSelection()[0];
  if(selectedItem){
    var kategorija = data.getValue(selectedItem.row, 0);
    alert('Izabrali ste ' + kategorija+ ' kategoriju');
  }
}
var map;
function initMap(){
  map = new google.maps.Map(document.getElementById('map'),{
    center: {lat: 44.8025174, lng: 20.4560219},
    zoom: 8
  });
}
function ucitajMarkere(){
  $.getJSON("skripta_mapa.php", function(json){
    $.each(json, function(i, value){
      addMarker(parseFloat(value.lat), parseFloat(value.lon), value.naslov, value.tekst);
    });
  });
}
function addMarker(lat, lon, naslov, tekst){
  var marker = google.maps.Marker({
    position: {lat: lat, lng: lon},
    map: map,
    title: naslov
  });
  var infowindow = new google.maps.InfoWindow({
    content: '<h6>'+naslov+'</h6><p>'+tekst+'</p>'
  });
      marker.addListener('click', function(){
      infowindow.open(map, marker);
    });
}



  </script>
</body>
</html>
