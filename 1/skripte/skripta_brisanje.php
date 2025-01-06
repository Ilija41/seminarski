<?php
  include '../konekcija.php';
    if(isset($_GET['vest_id'])){
      $vest_id = $_GET['vest_id'];
      $sql = "DELETE FROM vesti WHERE id = '$vest_id'";
      if(mysqli_query($mysqli, $sql)){
        echo "Vest je uspesno obrisana";
      }else{
        echo "Greska prilikom brisanja";
      }
    }

?>