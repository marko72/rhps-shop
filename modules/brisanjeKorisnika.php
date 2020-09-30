<?php
header("Content-type: aplication/json");
$code = 404;
$data = null;
if(isset($_POST['poslato'])){
    include "connection.php";
    $id = $_POST['id'];
    $upitBrisanje = "DELETE FROM korisnik WHERE korisnik_id = :id";
    $priprema = $konekcija->prepare($upitBrisanje);
    $priprema->bindParam(":id",$id);
    try{
        $priprema->execute();
        if($priprema->rowCount()==1){
            $code = 201;
            $data = "Uspesno obrisan korisnik";
        }
        else{
            $code = 500;
            $data = "Greska na serveru!";
        }
    }catch (PDOException $e){
        $code = 409;
        echo $e->getMessage();
        $data = $e->getMessage()." Neuspesno brisanje korisnika";
    }
}
http_response_code($code);
echo json_encode($data);