<?php
header("Content-type: aplication/json");
session_start();
$code = 403;
$data = null;
if(isset($_POST['poslato'])){
    include "connection.php";
    if(isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->id_uloga==1){
        $code = 502;
        $data = null;
        //DOHVATANJE PODATAKA KOJE UPISUJEM U BAZU
        $id = $_SESSION['korisnik']->korisnik_id;
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $pol = $_POST['pol'];
        $lozinka = $_POST['passwd'];
        $lozinka = md5($lozinka);

        //PATERNI ZA PROVERU IMENA I LOZINKE

        $paternImePrezime = "/^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13}){0,2}$/";
        $paternPasswd = "/[\w\S]{5,}[\d]{1,10}/";

        //NIZ U KOJI SMESTAM GRESKE

        $greske = [];

        //VALIDACIJA PODATAKA

        if(!$ime){
            if(!preg_match($paternImePrezime, $ime)){
                array_push($greske, "Ime nije u skladu sa paternom");
            }
        }
        if(!$prezime){
            if(!preg_match($paternImePrezime, $prezime)){
                array_push($greske, "Prezime nije u skladu sa paternom");
            }
        }
        if(!$lozinka){
            if(!preg_match($paternPasswd, $lozinka)){
                array_push($greske, "Lozinka nije u skladu sa paternom");
            }
        }
        if(!$email){
            if(!filter_var($email,FILTER_VALIDATE_EMAIL )){
                array_push($greske, "Email ne odgovara pravilima");
            }
        }
        if($pol){
            if($pol=='m'){
                $pol=1;
            }
            else{
                $pol=2;
            }
        }else{
            array_push($greske, "Nije izabran pol");
        }
        if(count($greske)==0){
            $updateKorisnik = "UPDATE korisnik SET ime=:ime, prezime=:prezime, id_pol=:pol, email=:email, lozinka=:passwd WHERE korisnik_id=:id";
            $pripremaUpdate = $konekcija->prepare($updateKorisnik);
            $pripremaUpdate->bindParam(":ime",$ime);
            $pripremaUpdate->bindParam(":prezime",$prezime);
            $pripremaUpdate->bindParam(":email",$email);
            $pripremaUpdate->bindParam(":passwd",$lozinka);
            $pripremaUpdate->bindParam(":pol",$pol);
            $pripremaUpdate->bindParam(":id",$id);
            try{
                $pripremaUpdate->execute();
                if($pripremaUpdate->rowCount()){
                    $code = 201;
                    $data = "Uspesno izmenjen korisnik";
                }
                else{
                    $code = 500;
                    $data = "Serverska greska";
                }
            }catch (PDOException $e){
                echo $e->getMessage();
                $code=409;
                $data = "Greska pri upitu";

            }
        }
        else{
            $code = 422;
            $data = "Klijentski podaci nisu u redu";
        }
        http_response_code($code);
        echo json_encode($data);
    }
    elseif (isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->id_uloga==2){
        //DOHVATANJE PODATAKA KOJE UPISUJEM U BAZU
        $id = $_SESSION['korisnik']->korisnik_id;
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $pol = $_POST['pol'];
        $lozinka = $_POST['passwd'];
        $uloga = '';
        if(isset($_POST['uloga'])){
            $uloga = $_POST['uloga'];
        }else{
            $uloga = $_SESSION['korisnik']->uloga_id;
        }
        $aktivan = "";
        if(isset($_POST['aktivan'])){
            $aktivan = $_POST['aktivan'];
        }
        $id = '';
        if(isset($_POST['korId'])){
            $id = $_POST['korId'];
        }else{
            $id =$_SESSION['korisnik']->korisnik_id;
        }
        $lozinka = md5($lozinka);
        //PATERNI ZA PROVERU IMENA I LOZINKE

        $paternImePrezime = "/^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13}){0,2}$/";
        $paternPasswd = "/[\w\S]{5,}[\d]{1,10}/";

        //NIZ U KOJI SMESTAM GRESKE

        $greske = [];

        //VALIDACIJA PODATAKA

        if(!$ime){
            if(!preg_match($paternImePrezime, $ime)){
                array_push($greske, "Ime nije u skladu sa paternom");
            }
        }
        if(!$prezime){
            if(!preg_match($paternImePrezime, $prezime)){
                array_push($greske, "Prezime nije u skladu sa paternom");
            }
        }
        if(!$lozinka){
            if(!preg_match($paternPasswd, $lozinka)){
                array_push($greske, "Lozinka nije u skladu sa paternom");
            }
        }
        if(!$email){
            if(!filter_var($email,FILTER_VALIDATE_EMAIL )){
                array_push($greske, "Email ne odgovara pravilima");
            }
        }
        if($pol){
            if($pol=='m'){
                $pol=1;
            }
            else{
                $pol=2;
            }
        }else{
            array_push($greske, "Nije izabran pol");
        }
        if(count($greske)==0){
            $updateKorisnik = "UPDATE korisnik SET ime=:ime, prezime=:prezime, id_pol=:pol, email=:email, lozinka=:passwd, id_uloga=:uloga WHERE korisnik_id=:id";
            $pripremaUpdate = $konekcija->prepare($updateKorisnik);
            $pripremaUpdate->bindParam(":ime",$ime);
            $pripremaUpdate->bindParam(":prezime",$prezime);
            $pripremaUpdate->bindParam(":email",$email);
            $pripremaUpdate->bindParam(":passwd",$lozinka);
            $pripremaUpdate->bindParam(":pol",$pol);
            $pripremaUpdate->bindParam(":id",$id);
            $pripremaUpdate->bindParam(":uloga",$uloga);
            try{
                $pripremaUpdate->execute();
                if($pripremaUpdate->rowCount()){
                    $code = 201;
                    $data = "Uspesno izmenjen korisnik";
                }
                else{
                    $code = 500;
                    $data = "Serverska greska";
                }
            }catch (PDOException $e){
                echo $e->getMessage();
                $code=409;
                $data = "Greska pri upitu";

            }
        }
        else{
            $code = 422;
            $data = "Klijentski podaci nisu u redu";
        }
    }
}
http_response_code($code);
echo json_encode($data);
