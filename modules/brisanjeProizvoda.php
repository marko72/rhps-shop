<?php
header("Content-type: aplication/json");
$code = 403;
$data = "null";
if(isset($_POST['poslato'])){
    include "connection.php";
    $idProizvoda = $_POST['idProizvoda'];
    $obrisiSlikuProizvoda = "DELETE FROM slika_proizvod WHERE id_proizvod=:idProizvoda";
    $pripremaBrisanjaSlikeProizvoda = $konekcija->prepare($obrisiSlikuProizvoda);
    $pripremaBrisanjaSlikeProizvoda->bindParam(":idProizvoda",$idProizvoda);
    $obrisiProizvodLajk = "DELETE FROM korisnik_proizvod_lajk WHERE id_proizvod=:idProizvoda";
    $pripremaBrisanjLajk = $konekcija->prepare($obrisiProizvodLajk);
    $pripremaBrisanjLajk->bindParam(":idProizvoda",$idProizvoda);
    $obrisiProizvod = "DELETE FROM proizvod WHERE proizvod_id=:idProizvoda";
    $pripremaBrisanjaProizvoda = $konekcija->prepare($obrisiProizvod);

    $pripremaBrisanjaProizvoda->bindParam(":idProizvoda", $idProizvoda);
    try{
        $konekcija->beginTransaction();
        $pripremaBrisanjaSlikeProizvoda->execute();
        if($pripremaBrisanjaSlikeProizvoda->rowCount()){
            try{
                $rez = $pripremaBrisanjLajk->execute();
                if($rez){
                    try{
                        $pripremaBrisanjaProizvoda->execute();
                        if($pripremaBrisanjaProizvoda->rowCount()){
                            $code = 201;
                            $data = executeQuery("SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod GROUP BY p.proizvod_id");
                        }else{
                            $code = 500;
                            $data = "Serverska greska pri brisanju";
                        }
                    }catch (PDOException $e){
                        $konekcija->rollBack();
                        $code = 422;
                        $data= $e->getMessage();
                    }
                }else{
                    echo $rez;
                    $code = 500;
                }
                $konekcija->commit();
            }catch (PDOException $e){
                $code = 422;
                $data= $e->getMessage();
            }
        }else{
            $code = 500;
            $data= $e->getMessage();
        }
    }catch (PDOException $e){
        $code = 422;
        $data = $e->getMessage();
    }
}
http_response_code($code);
echo json_encode($data);