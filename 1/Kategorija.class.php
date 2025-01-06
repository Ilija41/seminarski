<?php
class Kategorija{
  public static function vratiKategorije(){
    global $mysqli;
    $sql="SELECT * FROM kategorije";
    $q=$mysqli->query($sql);
    $niz = [];
    while($red=$q->fetch_object()){
      $niz[] = $red;
    }
    return $niz;
  }
}
?>