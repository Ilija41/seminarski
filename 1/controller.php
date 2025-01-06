<?php
include "konekcija.php";
include "Kategorija.class.php";
include "Vest.class.php";

if(isset($_GET['akcija']) && $_GET['akcija']=='obrisiVest'){
  if(Vest::obrisiVest($_GET['vest_id'])==true){
    echo "Uspesno obrisana vest";
  }else{
    echo "Greska prilikom brisanja vesti";
  }
}

if(isset($_GET['akcija']) && $_GET['akcija']=='pretraga'){
  $pretraga = Vest::pretraga(trim($_POST['kategorijaP']),trim($_POST['pretragaP']));
  
  ?>
    <div class="row">
      <?php for ($i=0; $i<count($pretraga); $i++){?>
          <div class="col-lg-12">
            <h3><?php echo $pretraga[$i]->naslov; ?></h3>
            <p><?php echo $pretraga[$i] -> tekst; ?></p>
            <hr>
          </div>
        <?php } ?>
      </div>

  <?php
  }
?>