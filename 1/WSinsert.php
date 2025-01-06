<?php 
    include 'konekcija.php';
    include "kategorija.class.php";


    $sve_kategorije = Kategorija::vratiKategorije();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset='utf-8'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'includes/navbar.php'?>
<div class='container'>
  <div class="col-lg-12">
    <?php include 'includes/jumbotron.php'?>
  </div>
</div>
<div class='container'>
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Dodaj vest</h1>
    </div>
  </div>
  <div class='row dodaj_vest'>
    <div class="col-lg-2 col-xs-12"></div>
    <div class="col-lg-8 col-xs-12">
      <div class='well'>
        <form action="" method='POST'>
          <select name="kategorija" id="kategorija" class='form-control'>
            <option value="">Izaberi kategoriju</option>
            <?php
              for($i=0; $i<count($sve_kategorije);$i++){
            ?><option value="<?php echo $sve_kategorije[$i]->id;?>"><?php echo $sve_kategorije[$i]->naziv;?></option>
            <?php
              }
            ?>
            
            
          </select>
          <input type="text" id='naslov' name='naslov' class='form-control' placeholder='Naslov'>
          <textarea name="tekst" id="tekst" cols='30' rows='10' class='form-control' placeholder='Unesite tekst'></textarea>
          <br>
          <input type="button" id='submit' name='submit' onClick="dodajVest();" class='btn btn-success btn-block' value='Posalji'>
        </form>
      </div>
    </div>
    <div class="col-lg-2 col-xs-12"></div>
    
  </div>
</div>
<?php include 'includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script>
    function Vest(naslov, kategorija, tekst){
      this.naslov = naslov;
      this.kategorija_id = kategorija;
      this.tekst = tekst;
    }


    function dodajVest(){
      var naslov=$("#naslov").val();
      var kategorija=$("#kategorija").val();
      var tekst=$("#tekst").val();

      if(naslov.length == 0 || kategorija.length == 0 || tekst.length == 0){
        alert("Popunite sva polja");
      }else{
        var vest = new Vest(naslov, kategorija, tekst);
        var json_vest = JSON.stringify(vest);
      $.post( "http://localhost/blog/3/dodajVest.json", json_vest, function( json ) {
        var data = JSON.parse(json);
        alert(data.poruka);
        ocisti();
      });
    }

      
    }
    function ocisti(){
      $('#naslov').val("");
      $('#tekst').val("");
      $('#kategorija').val("");
    }
  </script>
</body>
</html>