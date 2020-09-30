<?php
    session_start();
    include "modules/connection.php";
    include "views/head.php";
    include "views/header.php";
if(isset($_GET['page'])){
    $page = $_GET['page'];
    switch ($page){
        case "registracija":
            include "views/registration.php";
            break;
        case "slika":
            include "views/slika.php";
            break;
        case "autor":
            include "views/autor.php";
            break;
        case "about":
            include "views/about.php";
            break;
        case "blog":
            include "views/blog.php";
            break;
        case "korpa":
            include "views/korpa.php";
            break;
        case "contact":
            include "views/contact.php";
            break;
        case "about":
            include "views/about.php";
            break;
        case "blog-detail":
            include "views/blog-detail.php";
            break;
        case "products":
            $upitProizvod="SELECT * FROM proizvod p inner join slika_proizvod sp on p.proizvod_id=sp.id_proizvod 
                              group by p.proizvod_id";
            $proizvodi = executeQuery($upitProizvod);

            include "views/products.php";
            break;
        case "product-detail":
            if(isset($_GET['id'])){
                $idProizvoda =$_GET['id'];
                $upitDohvatiProizvod = "SELECT *, p.naziv AS p_naziv, pk.naziv AS pk_naziv, k.naziv AS k_naziv FROM proizvod p
                                        INNER JOIN kategorija_potkategorija kp on p.id_kat_potkat=kp.id_kat_potkat 
                                        INNER JOIN kategorija k ON kp.id_kat=k.kategorija_id 
                                        INNER JOIN potkategorija pk ON kp.id_potkat=pk.potkat_id 
                                        INNER JOIN slika_proizvod sp ON p.proizvod_id= sp.id_proizvod WHERE p.proizvod_id=$idProizvoda";
                $proizvod = executeQuery($upitDohvatiProizvod);
            }
            include "views/product-detail.php";
            break;
        case "index":
            include "views/index.php";
            break;
        default:
            include "views/index.php";
            break;
    }

}else{
    include "views/index.php";
}
include "views/footer.php";
include "views/script.php";