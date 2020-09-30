<?php
session_start();
if(isset($_SESSION['korisnik'])&& $_SESSION['korisnik']->id_uloga=2){
    include "modules/connection.php";
    include "views/head.php";
    include "views/header.php";
    if(isset($_GET['admin'])){
        $admin = $_GET['admin'];
        switch ($admin){
            case "unos":

                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $upitProizvod = "SELECT * FROM proizvod where proizvod_id=:id";
                    $prpremaProizvoda = $konekcija->prepare($upitProizvod);
                    $prpremaProizvoda->bindParam(":id", $id);
                    try{
                        $dali=$prpremaProizvoda->execute();
                        if($dali){
                            $proizvod = $prpremaProizvoda->fetch();
                        }
                    }catch (PDOException $e){
                        echo $e->getMessage();
                    }
                }

                include "admin/unosProizvoda.php";
                break;
            case "user":
                include "admin/table.php";
                break;
            case "ostalo":
                include "admin/unosOstalo.php";
                break;
            case "tabela-ostalo":
                include "admin/lajkovi-ankete.php";
                break;
            case "products":
                $dohvatiSveProizvode = 'SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod GROUP BY p.proizvod_id';
                $sviProizvodi = executeQuery($dohvatiSveProizvode);
                include "admin/table-proizvodi.php";
                break;
        }

    }
    include "views/footer.php";
    include "views/script.php";
}
else {
    header("Location: index.php?page=index");
}
?>