<?php
header("Content-type: application/json");
$code = 403;
$data = null;
if(isset($_POST['poslato'])){
    var_dump($_POST);
    include "connection.php";
    if(isset($_POST['nazivKat'])) {
        $nazivKat = $_POST['nazivKat'];
        $upisiKategoriju = "INSERT INTO kategorija SET naziv = :nazivKat";
        echo "INSERT INTO kategorija SET naziv = :nazivKat";
        $priprema = $konekcija->prepare($upisiKategoriju);
        $priprema->bindParam(":nazivKat", $nazivKat);
        try {
            $priprema->execute();
            if ($priprema->rowCount()) {
                $code = 201;
                $data = "Uspesno uneta kategorija";
            } else {
                $code = 500;
                $data = "Serverska greska";
            }
        } catch (PDOException $e) {
            $data = $e->getMessage();
            $code = 409;
        }
    }
    if(isset($_POST['insertAkcija'])) {
        $nazivAkcije ='';
        $trajanje = "";
        $greske = [];
        if($_POST['trajanje']){
            $trajanje=$_POST['trajanje'];
        }else{
            array_push($greske,"Niste uneli trajanje akcije");
        }
        if(count($greske)==0){
            $nazivAkcije = $_POST['nazivAkcije'];
            $upisiAkciju = "INSERT INTO akcija SET naziv_akcije = :nazivAkcije, trajanje=:trajanje";
            echo "INSERT INTO kategorija SET naziv = $nazivAkcije";
            $priprema = $konekcija->prepare($upisiAkciju);
            $priprema->bindParam(":nazivAkcije", $nazivAkcije);
            $priprema->bindParam(":trajanje", $trajanje);
            try {
                $priprema->execute();
                if ($priprema->rowCount()) {
                    $code = 201;
                    $data = "Uspesno uneta akcija";
                } else {
                    $code = 500;
                    $data = "Serverska greska";
                }
            } catch (PDOException $e) {
                $data = $e->getMessage();
                $code = 409;
            }
        }
    }
    if(isset($_POST['podkat'])){
        $greske = [];
        $podkat = $_POST['podkat'];
        $kat ='';
        if(isset($_POST['kat'])){
            $kat=$_POST['kat'];
            if($kat==0){
                array_push($greske,"Niste izabrali kategoriju");
            }
        }
        if($podkat==''){
            array_push($greske,"Niste uneli naziv potkategorije");
        }
        if(count($greske)==0){
            $upisiPotkategoriju = 'INSERT INTO potkategorija SET naziv=:podkat';
            //echo "INSERT INTO podkategorija SET naziv=$podkat";
            $pripremaPodkat = $konekcija->prepare($upisiPotkategoriju);
            $pripremaPodkat->bindParam(":podkat",$podkat);
            try{
                $konekcija->beginTransaction();
                $pripremaPodkat->execute();
                if($pripremaPodkat->rowCount()){
                    $idPodkategorije = $konekcija->lastInsertId();
                    $upisiKatPodkat = "INSERT INTO kategorija_potkategorija SET id_kat=:kat, id_potkat=:podkat";
                    //echo "INSERT INTO kategorija_potkategorija SET id_kat=$kat, id_potkat=$idPodkategorije";
                    $pripremaKatPodkat = $konekcija->prepare($upisiKatPodkat);
                    $pripremaKatPodkat->bindParam(":kat",$kat);
                    $pripremaKatPodkat->bindParam(":podkat",$idPodkategorije);
                    $pripremaKatPodkat->execute();
                    if($pripremaKatPodkat->rowCount()){
                        $code = 201;
                        $data="Uspesno izvrsen unos ptdkategorije";
                        $konekcija->commit();
                    }else{
                        $konekcija->rollBack();
                        $code=500;
                        $data = "Serverska greska pri upisu u kat potkat";
                    }
                }else{

                    $code=500;
                    $data="Serverska greska pri upisu katPotkat";
                }
            }catch (PDOException $e){
                $code = 409;
                $data = $e->getMessage();
            }
        }else{
            $code=422;
            $data = $greske;
        }
    }
    if(isset($_POST['updateAkcija'])){
        $idAkcije = $_POST['idAkcije'];
        $trajanje = '';
        $nazivAkcije = '';
        $greske =[];
        if(isset($_POST['trajanje'])){
            $trajanje=$_POST['trajanje'];
            if($trajanje==''){
                array_push($greske, "Niste uneli trajanje akcije");
            }
        }else{
            array_push($greske, "Niste uneli trajanje akcije");
        }
        if(isset($_POST['nazivAkcije'])){
            $nazivAkcije = $_POST['nazivAkcije'];
        }if(count($greske)==0&&$nazivAkcije==""){
            $updateBezNaziva="UPDATE akcija SET trajanje=:trajanje WHERE akcija_id=:idAkcije";
            echo "UPDATE akcija SET trajanje=$trajanje WHERE akcija_id=$idAkcije";
            $pripremaUpdateAkcije = $konekcija->prepare($updateBezNaziva);
            $pripremaUpdateAkcije->bindParam(":trajanje",$trajanje);
            $pripremaUpdateAkcije->bindParam(":idAkcije",$idAkcije);
            try{
                $pripremaUpdateAkcije->execute();
                if($pripremaUpdateAkcije->rowCount()){
                    $code = 201;
                    $data = "Uspesno izmenjena akcija";
                }else{
                    $code=500;
                    $data="Serverska greska pri unosu";
                }
            }catch (PDOException $e){
                echo $e->getMessage();
                $data = $e->getMessage();
                $code = 409;
            }
        }else{
            $updateSaNazivom="UPDATE akcija SET trajanje=:trajanje, naziv_akcije=:naziv WHERE akcija_id=:idAkcije";
            echo "UPDATE akcija SET trajanje=$trajanje, naziv=$nazivAkcije WHERE akcija_id=$idAkcije";
            $pripremaUpdateAkcije = $konekcija->prepare($updateSaNazivom);
            $pripremaUpdateAkcije->bindParam(":trajanje",$trajanje);
            $pripremaUpdateAkcije->bindParam(":naziv",$nazivAkcije);
            $pripremaUpdateAkcije->bindParam(":idAkcije",$idAkcije);
            try{
                $pripremaUpdateAkcije->execute();
                if($pripremaUpdateAkcije->rowCount()){
                    $code = 201;
                    $data = "Uspesno izmenjena akcija";
                }else{
                    $code=500;
                    $data="Serverska greska pri unosu";
                }
            }catch (PDOException $e){
                echo $e->getMessage();
                $data = $e->getMessage();
                $code = 409;
            }
        }
        if(count($greske)>0){
            $data=$greske;
            $code=422;
        }
    }
    if(isset($_POST['delAkcija'])){
        $greske=[];
        $idAkcije = $_POST['delAkcija'];
        if($idAkcije==0){
            $greske="Niste izabrali akciju za brisanje";
        }
        if(count($greske)==0){
            $obrisiAkciju = "DELETE FROM akcija WHERE akcija_id=:idAkcije";
            $priprema = $konekcija->prepare($obrisiAkciju);
            $priprema->bindParam(":idAkcije",$idAkcije);
            try{
                $priprema->execute();
                if($priprema->rowCount()){
                    $code = 201;
                    $akcije = executeQuery("SELECT * FROM akcija");
                    $data = executeQuery("SELECT * FROM akcija");
                }else{
                    $code=500;
                    $data="Serverska greska pri brisanju akcije";
                }
            }catch (PDOException $e){
                echo $e->getMessage();
                $data=$e->getMessage();
                $code=409;
            }
        }else{
            $code=422;
            $data=$greske;
        }
    }
}
http_response_code($code);
echo json_encode($data);