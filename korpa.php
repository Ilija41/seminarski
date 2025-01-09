<?php
include 'konekcija.php';
session_start();
if(!isset($_SESSION['userid'])){
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <title>Simple shop</title>
</head>
<body onload="ucitajKorpu();">
<?php include "inc/nav.php" ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <?php include "inc/jumbo.php" ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
    <div class="page-header">
        <h1>Korpa</h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <button class="btn btn-primary" onClick="otvoriModal();">Posalji porudzbinu</button>
      <table class="table">
        <thead>
        <tr>
          <th>Naziv proizvoda</th>
          <th>Kolicina</th>
          <th>Cena</th>
          <th>Ukupno</th>
          <th>Obrisi</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Unos adrese</h4>
      </div>
      <div class="modal-body">
      <p>Unesite adresu: </p>
          <div class="form-group">
            <label for="adresa">Adresa</label>
            <input type="text" class="form-control" id="adresa" name="adresa" placeholder="Adresa...">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-primary" onClick="posaljiPorudzbinu();">Posalji</button>
      </div>
    </div>
  </div>
 </div>
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

  <script>
function ucitajKorpu(){
    $.get("controller.php?akcija=vratiProizvodeIzKorpe", function(json) {
        var data = JSON.parse(json);
        $("table tbody").empty();
        if(data.status==0){
          alert(data.poruka);
        }else{
          $.each(data, function(key, value) {
          $("table tbody").append("<tr><td>" + value.proizvod + "</td><td>" + value.kolicina + "</td><td>" + value.cena + " EUR</td><td>" + value.ukupno + " EUR</td><td><button class='btn btn-primary btn-sm' onclick='obrisiIzKorpe(" + value.proizvod_id + ")'>Obrisi proizvod</button></td></tr>");
        });
        }

    });
}


function posaljiPorudzbinu(){
  var adresa = $("#adresa").val();
  if(adresa.length == 0){
    alert("Unesite adresu!");
  }else{
  var json_proizvod = '{"adresa":"'+adresa+'"}';
  console.log(json_proizvod);
  $.post( "controller.php?akcija=posaljiPorudzbinu", json_proizvod ,function( json ) {
  var data = JSON.parse(json);
  alert(data.poruka);
  $(".modal").modal("hide");
  $("#adresa").val("");
  ucitajKorpu();
  });

}
}
function otvoriModal(){
  $(".modal").modal("show");
}


function obrisiIzKorpe(id){
  $.get("controller.php?akcija=obrisiProizvodIzKorpe&proizvod_id=" +id ,function (json){
    var data = JSON.parse(json);
    alert(data.poruka);
    ucitajKorpu();

  });
}
  </script>
</body>
</html>