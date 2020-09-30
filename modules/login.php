<?php
session_start();
if(isset($_POST['btnLogin'])){
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];

    $paternPasswd = "/[\w\S]{5,}[\d]{1,10}/";
    //$paternPasswd = "/[\d]{1,}[\w\S]{,24}/";

    $greske = [];
    if(!$email){
        if(!filter_var($email,FILTER_VALIDATE-EMAIL)){
            array_push($greske,"Email nije u skladu sa paternom!");
        }
    }
    if($passwd){
        if(!preg_match($paternPasswd, $passwd)){
            array_push($greske, "Lozinka nije u obliku kakavom bi trebalo da bude");
        }
    }
    if(count($greske)!=0){
        header("Location: ".$_SERVER['PHP_SELF']);
        $_SESSION['greska']=$greske;
    }
    else{
        $passwd = md5($passwd);
        include "connection.php";
        $upitLogin = "SELECT * FROM korisnik k INNER JOIN uloga u ON k.id_uloga=u.uloga_id 
        WHERE email = :email AND lozinka=:passwd";
        $priprema = $konekcija->prepare($upitLogin);
        $priprema->bindParam(":email",$email);
        $priprema->bindParam(":passwd",$passwd);
        try{
            $priprema->execute();
            $rezultat = $priprema->fetch();
            if($rezultat){
                $_SESSION['korisnik']=$rezultat;
            }
            else{
                header("Location: ".$_SERVER['PHP_SELF']);
            }
        }catch (PDOException $e){
            echo $e->getMessage();
            $_SESSION['greska']=$e->getMessage();
        }
    }
header("Location: ".$_SERVER['PHP_SELF']);
}
else{
    header("Location: ../index.php?page=index");
}
