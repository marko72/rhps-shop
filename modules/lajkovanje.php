<?php
session_start();
header("Content-type: application/json");
$code = 409;
$data = null;
if(isset($_POST['poslato'])){
    include "connection.php";
    $idKorisnika = $_SESSION['korisnik']->korisnik_id;
    $idProizvoda = $_POST['id'];
    $upisiLajk = "INSERT INTO korisnik_proizvod_lajk SET id_korisnika=:idKorisnika, id_proizvod=:idProizvoda";
    $priprema = $konekcija->prepare($upisiLajk);
    $priprema->bindParam(":idKorisnika", $idKorisnika);
    $priprema->bindParam(":idProizvoda", $idProizvoda);
    try{
        $priprema->execute();
        if($priprema->rowCount()){
            $code = 201;
            $data = "Korisnik uspesno unet u bazu";
        }else{
            $code = 500;
            $data = "Serverska greska";
        }
    }catch (PDOException $e){
        $code = 409;
        $data = $e->getMessage();
        echo $e->getMessage();
    }
}
http_response_code($code);
echo json_encode($data);