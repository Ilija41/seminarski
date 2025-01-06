<?php
  include 'konekcija.php';
  $sql="SELECT * FROM komentari as k JOIN vesti as v ON k.vest_id=v.id JOIN kategorije AS kat ON v.kategorija_id=kat.id";
  $q=$mysqli->query($sql);
  $niz = array();
  while($red = $q -> fetch_object()){
    $niz[] = $red;
  }
  echo json_encode($niz);
?>