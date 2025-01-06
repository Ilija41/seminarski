<?php
  include 'konekcija.php'; 
  include "Vest.class.php";
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
  <div class="col-lg-12">
    <?php include 'includes/jumbotron.php'?>
  </div>
</div>
<div class='container'>
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Obrisi vest</h1>
    </div>
  </div>
  <div class='row dodaj_vest'>
    <div class="col-lg-2 col-xs-12"></div>
    <div class="col-lg-8 col-xs-12">
      <div class='well'>
        <form action="" method='POST'>
        <select name="vest" id="vest" class='form-control'>
            <option value="">Izaberi vest...</option>
              <?php
               for($i=0;$i<count($sve_vesti);$i++){
              ?>
              <option value="<?php echo $sve_vesti[$i]->id;?>"><?php echo $sve_vesti[$i]->naslov;?></option>
              <?php
                }
              ?>
          </select>
          <br>
          <button type="button" id='submit' name='submit' onClick="obrisi()" class='btn btn-danger btn-block' value='Obrisi'>Obrisi</button>
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
    function obrisi(){
      var vest_id=$("#vest").val();
      
      $.get( "controller.php?vest_id=" + vest_id+"&akcija=obrisiVest", function( data ) {
        alert( data );

      });

    }
  </script>
</body>
</html>