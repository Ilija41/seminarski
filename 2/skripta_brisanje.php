<?php
include "konekcija.php";
  $id=$_GET['id_komentara'];
  $sql="DELETE FROM komentari WHERE id='$id'";
  $q=$mysqli->query($sql);
?>