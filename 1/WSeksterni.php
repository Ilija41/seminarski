<?php
$xml=simplexml_load_file("https://www.b92.net/rss/b92/info") or die("Error: Cannot create object");


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
      <h1>Sve vesti <small>sa web servisa</small></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table class="table">
  <thead>
        <tr>
          <th>Naslov</th>
          <th>Tekst</th>
          <th>Kategorije</th>
        </tr>
  </thead>
      <tbody>
        <?php
          foreach($xml->channel->item as $i){
            
            ?>
            <tr>
              <td><?php echo $i-> title; ?></td>
              <td><?php echo $i->description; ?></td>
              <td><a target="_blank" href="<?php echo $i->link; ?>">Procitaj vest</a></td>
            </tr>
            <?php

          }
        ?>
      </tbody>
      </table>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'?>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</body>
</html>