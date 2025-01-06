<?php
class Vest{
  private $naslov;
  private $tekst;
  private $kategorija_id;

  public function __construct($naslov, $tekst, $kategorija_id){
    $this->naslov = $naslov;
    $this->tekst = $tekst;
    $this->kategorija_id = $kategorija_id;
  }
  public function dodajVest(){
    global $mysqli;
    $sql = "INSERT INTO vesti (naslov, tekst, kategorija_id) VALUES ('".$this->naslov."', '".$this->tekst."', '".$this->kategorija_id."')";
    if($q=$mysqli->query($sql)){
      return true;
    }else {
      return false;
    }
  }
  public function izmeniVest($id){
    global $mysqli;
    $sql = "UPDATE vesti SET kategorija_id='$this->kategorija_id' WHERE id='$id'";  
    if($q=$mysqli->query($sql)){
      return true;
  }else{
    return false;
  }
}

  public static function vratiVesti(){
    global $mysqli;
    $sql="SELECT * FROM vesti";
    $q=$mysqli->query($sql);
    $niz = [];
    while($red=$q->fetch_object()){
      $niz[] = $red;
    }
    return $niz;
  }
  
    public static function obrisiVest($id){
      global $mysqli;
      $sql="DELETE FROM vesti WHERE id='$id'";
      if($q=$mysqli->query($sql)){
        return true;
    }else{
      return false;
    } 
    }
    public static function pretraga($kategorija, $pretraga){
      global $mysqli;
      if($kategorija == 999 && empty($pretraga)){
        $sql = "SELECT * FROM vesti ORDER BY id DESC";
      }else if($kategorija != 999 && empty($pretraga)){
        $sql = "SELECT * FROM vesti WHERE kategorija_id = '$kategorija' ORDER BY id DESC";
      }else if($kategorija = 999 && !empty($pretraga)){
        $sql = "SELECT * FROM vesti WHERE naslov LIKE '%$pretraga%' ORDER BY id DESC";
      }else {
        $sql = "SELECT * FROM vesti WHERE kategorija_id = '$kategorija' AND naslov LIKE '%$pretraga%' ORDER BY id DESC";
      }
      $q=$mysqli->query($sql);
    $niz = [];
    while($red=$q->fetch_object()){
      $niz[] = $red;
    }
    return $niz;
    }
}

?>