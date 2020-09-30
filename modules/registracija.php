<?php
header("Content-type: application/json");
include "connection.php";
$code = 502;
$data = null;
if(isset($_POST['poslato'])){
    //DOHVATANJE PODATAKA KOJE UPISUJEM U BAZU
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $pol = $_POST['pol'];
    $lozinka = $_POST['passwd'];
    var_dump($email);

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

    //KREIRANJE DATUMA REGISTRACIJE

    $datum = date("Y-m-d H:i:s",time());
    var_dump($datum);
    $kupon = 1;
    $token = sha1(time().$email);
    $lozinka = md5($lozinka);

    //UPISIVANJE KORISNIKA U BAZU

    if(count($greske)==0){
        $upisKorisnika = "INSERT INTO korisnik (ime, prezime, email, datum_registracije, lozinka, token, id_uloga, id_pol) VALUES (:ime, :prezime, :email, :datum, :lozinka, :token, 1, :pol)";
        $priprema = $konekcija->prepare($upisKorisnika);
        $priprema->bindParam(":ime",$ime);
        $priprema->bindParam(":prezime",$prezime);
        $priprema->bindParam(":email",$email);
        $priprema->bindParam(":datum",$datum);
        $priprema->bindParam(":pol",$pol);
        $priprema->bindParam(":lozinka", $lozinka);
        //$priprema->bindParam(":kupon", $kupon);
        $priprema->bindParam(":token", $token);

        try{
            $priprema->execute();
            if($priprema){
                $code = 201;
                $data = "Uspesno unet korisnik!";
            }
        }catch (PDOException $e) {
            $code = 409;
            $data = "Vec postoji korisnik sa tim email-om";
            echo $e->getMessage();
        }
    }
    else{
        $code=422;
        $data = $greske;
    }
}
echo json_encode($data);
http_response_code($code);
