<?php
require_once 'flight/Flight.php';
$json_podaci=file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);
// require 'flight/autoload.php';

Flight::route('/', function () {
    echo 'Hello world!';
});

Flight::route('GET /vratiVesti.json', function () {
   include 'konekcija.php';
   $sql="SELECT * FROM vesti as v JOIN kategorije as k ON v.kategorija_id = k.id";
   $q=$mysqli->query($sql);
   $niz = array();
   while($red=$q->fetch_object()){
    $niz[] = $red;
   }
   echo json_encode($niz);
});
Flight::route('POST /dodajVest.json', function () {
    include 'konekcija.php';
    $podaci_json = Flight::get('json_podaci');
    $podaci = json_decode($podaci_json);
    if($podaci == null){
        $odgovor['status'] = 0;
        $odgovor['poruka'] = "Niste prosledili podatke";
        echo json_encode($odgovor);
        return false;
    }else{
        if(!property_exists($podaci, 'naslov') || !property_exists($podaci, 'tekst') || !property_exists($podaci, 'kategorija_id')){
            $odgovor['status'] = 0;
            $odgovor['poruka'] = "Nisu prosledjeni korektni podaci";
            echo json_encode($odgovor);
            return false;
        }else{
            $naslov = $podaci->naslov;
            $tekst = $podaci->tekst;
            $kategorija_id = $podaci->kategorija_id;
            $sql = "INSERT INTO vesti (naslov, tekst, kategorija_id) VALUES ('$naslov', '$tekst', $kategorija_id)";
            if($q = $mysqli->query($sql)){
                $odgovor['status'] = 1;
            $odgovor['poruka'] = "Vest je uspesno dodata";
            echo json_encode($odgovor);
            return false;
            }else{
                $odgovor['status'] = 0;
            $odgovor['poruka'] = "Doslo je do greske";
            echo json_encode($odgovor);
            return false;
            }
        }
    }


});
 



Flight::start();
?>
