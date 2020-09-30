<?php
session_start();
if(isset($_SESSION['korisnik'])){
    unset($_SESSION['korisnik']);
    session_destroy();
    header("location: ../index.php?page=index");
}
else{
    header("location: ../index.php?page=index");
}
