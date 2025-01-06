<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datatable</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1>Serverska obrada</h1>
    </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
        <table id="example" class="display table table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
            </tr>
        </tfoot>
    </table>
        </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "server_processing.php",
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/sr-SP.json"
        }
    });
});
</script>
</body>
</html>
