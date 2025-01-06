<?php
    include 'konekcija.php';
    include "Kategorija.class.php";
    include "Vest.class.php";
    $sve_kategorije = Kategorija::vratiKategorije(); 
    $sve_vesti = Vest::vratiVesti();
    
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
  <div class="row">
  <div class="col-lg-12">
    <?php include 'includes/jumbotron.php'?>
  </div>
</div>
<div class='container'>
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Procitaj sve vesti <small>Procitaj ili pretrazi</small></h1>
    </div>
  </div>
</div>
  <div class='row pretraga_vesti'>
      <div class="col-lg-3">
        <h2>Filteri</h2>
        <select name="kategorija" id="kategorija" class='form-control'>
        <option value="999">Sve kategorije</option>
              <?php
               for($i=0;$i<count($sve_kategorije);$i++){
              ?>
              <option value="<?php echo $sve_kategorije[$i]->id;?>"><?php echo $sve_kategorije[$i]->naziv;?></option>
              <?php
                }
              ?>
          </select>
        <br>
        <br>
        <p>
          Unesi naslov vesti za pretragu
        </p>
        <input type="text" id='pretraga' class='form-control' placeholder='Unesi naslov'>
        <br>
        <button onClick="primeniFiltere()" class="btn btn-primary btn-block">Primeni filtere</button>

      </div>
      <div class="col-lg-9">
        <h2>Vesti</h2>
        <div id='sve_vesti'>
          <div class="row">
        <?php for($i=0; $i<count($sve_vesti);$i++){?>
            <div class="col-lg-12">
              <h3><?php echo $sve_vesti[$i]->naslov; ?></h3>
              <p><?php echo $sve_vesti[$i]->tekst; ?></p>
              <hr>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
  </div>
</div>
<?php include 'includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script>
    function primeniFiltere(){
      var kategorija = $('#kategorija').val();
      var pretraga = $('#pretraga').val();

      $.post( "controller.php?akcija=pretraga", {kategorijaP: kategorija, pretragaP: pretraga}).done(function( data ){$("#sve_vesti").html(data);
      });
    }
  </script>
</body>
</html>