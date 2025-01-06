<?php
  include 'konekcija.php';
  $sql = "SELECT count(v.id) as ukupno, k.naziv as kategorija FROM vesti as v JOIN kategorije as k ON v.kategorija_id=k.id GROUP BY k.id";
  $q=$mysqli->query($sql);
  $niz = array();
  while($red = $q->fetch_object()){
    $niz[] = $red;
  }
  echo json_encode($niz);
?>