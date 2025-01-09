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
<body>
<?php include "inc/nav.php" ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <?php include "inc/jumbo.php" ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
    <div class="page-header">
        <h1>Svi proizvodi</h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table class="table">
        <thead>
        <tr>
          <th>Naziv proizvoda</th>
          <th>Cena</th>
          <th>Dodaj proizvod</th>
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
        <h4 class="modal-title" id="myModalLabel">Unos kolicine</h4>
      </div>
      <div class="modal-body">
      <p>Unesite kolicinu: </p>
          <div class="form-group">
            <label for="kolicina">Kolicina</label>
            <input type="text" class="form-control" id="kolicina" name="kolicina" placeholder="Kolicina...">
          </div>
          <input type="text" class="form-control" id="product_id" name="product_id" style="display: none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-primary" onClick="dodajProizvodUKorpu();">Dodaj proizvod</button>
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
    $.get( "controller.php?akcija=vratiProizvode", function( json ) {
        var data = JSON.parse(json);
        console.log(data);
        $.each( data, function( key, value ) {
          $("table tbody").append("<tr><td>"+value.product_name+"</td><td>"+value.price+" EUR</td><td><button class='btn btn-primary btn-sm' onClick='otvoriModal()'"+value.id+")'>Dodaj proizvod</button></td></tr>")
        });
    });

function otvoriModal(id){
  $("#product_id").val(id);
  $(".modal").modal("show");
}

function Proizvod(kolicina, product_id){
  this.kolicina = kolicina;
  this.product_id = product_id;
}

function dodajProizvodUKorpu(){
  var kolicina = $("#kolicina").val();
  var product_id = $("#product_id").val();
  if(kolicina.length == 0){
    alert("Unesite kolicinu!");
  }else{
  var proizvod = new Proizvod(kolicina, product_id);
  var json_proizvod = JSON.stringify(proizvod);
  $.post( "controller.php?akcija=dodajProizvodUKorpu", json_proizvod ,function( json ) {
  var data = JSON.parse(json);
  alert(data.poruka);
  $(".modal").modal("hide");
  $("#kolicina").val("");
  });

}
}
  </script>
</body>
</html>