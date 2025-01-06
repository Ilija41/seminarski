<?php
  include 'konekcija.php';
  $sql = "SELECT * FROM vesti";
  $q=$mysqli->query($sql);
  $niz = array();
  while($red = $q->fetch_object()){
    $niz[] = $red;
  }
  echo json_encode($niz);
?>