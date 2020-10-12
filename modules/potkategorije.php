<?php
    header("Content-type: application/json");
    $code = 404;
    $data = null;
    if(isset($_POST['sent']) && isset($_POST['getKategorije'])){
        if($_POST['katID']==0){
            $code = 422;
            $data = "Nema šta da se dohvati";
        }else{
            $katID = $_POST['katID'];
//            $katID = 7;
            include "./connection.php";
            try {
                $queryStr = "SELECT *, k.kategorija_id, p.potkat_id, p.naziv AS potkat_naziv, k.naziv AS kat_naziv, p.class 
                                        FROM kategorija_potkategorija kp 
                                        INNER JOIN kategorija k ON kp.id_kat = k.kategorija_id 
                                        INNER JOIN potkategorija p ON kp.id_potkat = p.potkat_id
                                        WHERE k.kategorija_id = :katID";
                $prepare = $konekcija->prepare($queryStr);
                $prepare->bindParam(':katID',$katID);
                $prepare->execute();
                $potkategorije =$prepare->fetchAll();
                if(count($potkategorije) == 0){
                    $data = "Nema potkategorija ove kategorije";
                    $code = 200;
                }else{
                    $data = $potkategorije;
                    $code = 200;
                }
            }catch (PDOException $e){
                $data = $e->getMessage();
                $code = 500;
            }
        }


    }
    if(isset($_POST['sent'] )&& isset($_POST['insert'])){
        include './connection.php';
        $nazivPotkat = $_POST['naziv'];
        $queryStr = "INSERT INTO potkategorija SET naziv=:naziv";

        try {
            $prepare = $konekcija->prepare($queryStr);
            $prepare->bindParam(':naziv',$nazivPotkat);
            $prepare->execute();
            if($prepare->rowCount()==1){
                $code = 201;
                $data = "Uspesno uneta potkategorija!";
            }else{
                $code = 500;
                $data = "Unos potkategorije nije uspeo";
            }
        }catch (PDOException $e){
            $code = 409;
            $data = $e->getMessage();
        }
    }
if(isset($_POST['sent'] )&& isset($_POST['insertKatPotkat'])){
    include './connection.php';
    $katID = $_POST['katID'];
    $potkatID = $_POST['potkatID'];
    $queryStr = "INSERT INTO kategorija_potkategorija SET id_kat=:katID, id_potkat=:potkat_id";

    try {
        $prepare = $konekcija->prepare($queryStr);
        $prepare->bindParam(':katID',$katID);
        $prepare->bindParam(':potkat_id',$potkatID);
        $prepare->execute();
        if($prepare->rowCount()==1){
            $code = 201;
            $data = "Uspesno uneta potkategorija!";
        }else{
            $code = 500;
            $data = "Unos potkategorije nije uspeo";
        }
    }catch (PDOException $e){
        $code = 409;
        $data = $e->getMessage();
    }
}
    if(isset($_POST['delete'])){
        include './connection.php';
        $idPotkat = $_POST['idPotkat'];
        $queryStr = "DELETE FROM potkategorije WHERE potkat_id=:id";
        try {
            $prepare = $konekcija->prepare($queryStr);
            $prepare->bindParam(':id',$idPotkat);
            $prepare->execute();
            if($prepare->rowCount()==1){
                $code = 201;
                $data = "Uspesno izbrisana potkategorija!";
            }else{
                $code = 500;
                $data = "Brisanje potkategorije nije uspeo";
            }
        }catch (PDOException $e){
            $code = 409;
            $data = $e->getMessage();
        }
    }

if(isset($_POST['deleteKatPotkat'])){
    include './connection.php';
    $idKatPotkat = $_POST['idKatPotkat'];
    $queryStr = "DELETE FROM kategorija_potkategorija WHERE id_kat_potkat=:id";
    try {
        $prepare = $konekcija->prepare($queryStr);
        $prepare->bindParam(':id',$idKatPotkat);
        $prepare->execute();
        if($prepare->rowCount() == 1){
            $code = 201;
            $data['message'] = "Uspesno izbrisana potkategorija!";
//            $queryStr = "SELECT *, k.kategorija_id, p.potkat_id, p.naziv AS potkat_naziv, k.naziv AS kat_naziv, p.class
//                                        FROM kategorija_potkategorija kp
//                                        INNER JOIN kategorija k ON kp.id_kat = k.kategorija_id
//                                        INNER JOIN potkategorija p ON kp.id_potkat = p.potkat_id
//                                        WHERE k.kategorija_id = :katID";
//            $prepare = $konekcija->prepare($queryStr);
//            $prepare->bindParam(':katID',$katID);
//            $prepare->execute();
//            $potkategorije =$prepare->fetchAll();
        }else{
            $code = 500;
            $data = "Brisanje potkategorije nije uspeo";
        }
    }catch (PDOException $e){
        $code = 409;
        $data = $e->getMessage();
    }
}
    http_response_code($code);
    echo json_encode($data);
