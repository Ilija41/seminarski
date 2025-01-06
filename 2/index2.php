<?php
include 'konekcija.php';
  $sql="SELECT k.*, v.naslov, kat.naziv FROM komentari as k JOIN vesti as v ON k.vest_id=v.id JOIN kategorije AS kat ON v.kategorija_id=kat.id";
  $q=$mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datatable</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/r-3.0.3/datatables.min.css" rel="stylesheet">
  <style>
    #button{
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1>DT tabela</h1>
    </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
        <button class="btn btn-danger" id="button">Obrisi</button>
        <div class="table-responsive">
        <table id="example" class="display table table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Komentar</th>
                <th>Vest</th>
                <th>Kategorija</th>
                <th>Kategorija2</th>
                <th>Kategorija3</th>
            </tr>
        </thead>
        <tbody>
          <?php while($red = $q -> fetch_object()){ ?>
              <tr>
              <td><?php echo $red->id; ?></td>
                <td><?php echo $red->komentar; ?></td>
                <td><?php echo $red->naslov; ?></td>
                <td><?php echo $red->naziv; ?></td>
                <td><?php echo $red->naziv; ?></td>
                <td><?php echo $red->naziv; ?></td> 
              </tr>           
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
            <th>ID</th>
            <th>Komentar</th>
            <th>Vest</th>
            <th>Kategorija</th>
            <th>Kategorija2</th>
            <th>Kategorija3</th>
            </tr>
        </tfoot>
    </table>
        </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/r-3.0.3/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
      responsive: true
    });
    var table = $('#example').DataTable();
    $('#example tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('selected')){
          $(this).removeClass('selected');
        }else{
          table.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
        }
    });
    $('#button').click( function () {
      var id_komentara = table.row('.selected').data()[0];
      $.get("skripta_brisanje.php?id_komentara=" + id_komentara, function(data){});
      table.row('.selected').remove().draw( false );
    });
    
});
</script>
</body>
</html>
