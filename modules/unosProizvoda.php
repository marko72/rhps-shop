<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1); 
if(isset($_SESSION['korisnik'])&&($_SESSION['korisnik']->id_uloga==2)){
    include "connection.php";
    $naziv = "";
    $cena = 0;
    $stanje = 0;
    $opis = "";
    $kategorija = 0;
    $potkategorija = 0;
    $akcija = "";
    $novo = false;
    $greske = [];

    if(isset($_POST['naziv'])){
        $naziv = $_POST['naziv'];
    }else{
        array_push($greske,"Nije unet naziv");
    }

    if(isset($_POST['cena'])){
        $cena = $_POST['cena'];
    }
    else{
        array_push($greske,"Nije uneta cena!");
    }
    if(isset($_POST['stanje'])){
        $stanje = $_POST['stanje'];
    }
    else{
        array_push($greske,"Morate uneti stanje");
    }
    if(isset($_POST['opis'])){
        $opis = $_POST['opis'];
    }
    else{
        array_push($greske,"Morate imati opis proizvoda");
    }
    if(isset($_POST['kategorija'])){
        $kategorija = $_POST['kategorija'];
        if($kategorija==0){
            array_push($greske,"Izaberite kategoriju!");
        }
    }
    if(isset($_POST['podkategorija'])){
        $potkategorija = $_POST['podkategorija'];
        if($potkategorija==0){
            array_push($greske,"Izaberite potkategoriju!");
        }
    }

    if(isset($_POST['akcija'])){
        $akcija = $_POST['akcija'];
    }

    if(isset($_POST['novo'])){
        $novo = $_POST['novo'];
        if($novo=="da"){
            $novo = true;
        }
    }
    $id_kat_potkat =0;



    //DOHVATANJE PRIMARNOG KLJUCA IZ TABELE KATEGORIJA_potKATEGORIJA, KOJI NAM TREBA JER U TABELU O PROIZVODIMA UPISUJEMO
    //ID_KAT_potKAT KOJI JE PRIMARNI KLJUC TABELE KATEGORIJA_potKATEGORIJA

    $dohvatiKatPotkat = "SELECT id_kat_potkat FROM kategorija_potkategorija where id_kat=:kategorija and id_potkat=:potkategorija";
    $pripremaKatPotkat = $konekcija->prepare($dohvatiKatPotkat);
    $pripremaKatPotkat->bindParam(":kategorija",$kategorija);
    $pripremaKatPotkat->bindParam(":potkategorija",$potkategorija);
    // echo "SELECT id_kat_potkat FROM kategorija_potkategorija where id_kat=".$kategorija." and id_potkat=".$potkategorija."";
    try{
        $pripremaKatPotkat->execute();
        if($pripremaKatPotkat->rowCount()){
            $obj_id_kat_potkat = $pripremaKatPotkat->fetch();
            $id_kat_potkat = $obj_id_kat_potkat->id_kat_potkat;
        }
        else{
            array_push($greske , "Ne postoji kategorija ove potkategorije!");
        }

    }
    catch (PDOException $e){
        echo $e->getMessage();
        array_push($greske, "Nema potkategorije te kategorije");
    }


//PREMESTANJE SLIKE I POSTAVLJANJE NOVOG IMENA SLIKE

    $slika1 = "";
    $slika2 = "";
    $bezSlika = '';
    if($_FILES['slika']['tmp_name']!=""){
        $slika1 = $_FILES['slika'];
        //echo "Edituje se sa slikom";
    }else{
        $bezSlika=1;
//        echo "edituje se bez slika";
    }

    if(isset($_FILES['slika2'])){
        $slika2 = $_FILES['slika2'];
    }else{
        $bezSlika=1;
    }

    if($bezSlika != 1){
        $imeSlike1 = premestiSliku($slika1);
        $imeSlike2 = premestiSliku($slika2);
    }

    if(count($greske)==0){
            if(isset($_POST['btnUnosProizvoda'])){
                $unosProizvoda = "INSERT INTO proizvod set naziv=:naziv, cena=:cena, stanje=:stanje, novo=:novo, 
                          id_kat_potkat=:id_kat_potkat, opis=:opis, id_akc_pro=:akcija";
                $priprema = $konekcija->prepare($unosProizvoda);
                $priprema->bindParam(":naziv",$naziv);
                $priprema->bindParam(":cena",$cena);
                $priprema->bindParam(":stanje",$stanje);
                $priprema->bindParam(":novo",$novo);
                $priprema->bindParam(":id_kat_potkat",$id_kat_potkat);
                $priprema->bindParam(":opis",$opis);
                $priprema->bindParam(":akcija",$akcija);

                try{
                    $konekcija->beginTransaction();
                    $priprema->execute();
                    if($priprema->rowCount()==1){
                        $_SESSION['unosProizvoda']=$konekcija->lastInsertId();
                        $idProizvoda = $_SESSION['unosProizvoda'];

                        $dali = ubaciSlikuUBazu($imeSlike2,$idProizvoda);
                        if(!$dali){
                            $_SESSION['greske']= array("Nije uspesno izvrsen upis slike u bazu!");
//                            echo "Nije uspesno izvrsen upis slike u bazu!";
                            header("Location: ../admin.php?admin=unos");
                        }
                        //PROVERA DA LI JE UNETA DRUGA SLIKA U BAZU
                        $dali1 =ubaciSlikuUBazu($imeSlike1,$idProizvoda);
                        if(!$dali1){
                            $_SESSION['greske']= array("Nije uspesno izvrsen upis slike2 u bazu!");
//                            echo "Nije uspesno izvrsen upis slike u bazu!";
                            header("Location: ../admin.php?admin=unos");
                        }
                        $konekcija->commit();
                        header("Location: ../admin.php?admin=unos");
//                        echo "Uspesno uneto";
                    }
                    else{
                        $konekcija->rollBack();
                        $_SESSION['greske']=$greske;
                        array_push($greske,"Taj proizvod vec postoji");
                        header("Location: ../admin.php?admin=unos");
//                        echo "Taj proizvod vec postoji";
                    }
                }catch (PDOException $e){
//                    echo $e->getMessage();
                    array_push($greske,$e->getMessage());
                    $_SESSION['greske']=$greske;
                    header("Location: ../admin.php?admin=unos");
//                    var_dump($_SESSION['greske']);
                }
            }elseif (isset($_POST['btnIzmenaProizvoda'])){
                if($bezSlika==1){
                    $idProizvoda = $_POST['idProizvoda'];
                    $updateProizvoda = "UPDATE proizvod SET naziv=:naziv, cena=:cena, stanje=:stanje, novo=:novo, 
                          id_kat_potkat=:id_kat_potkat, opis=:opis, id_akc_pro=:akcija WHERE proizvod_id=:idProizvoda";
                    $priprema = $konekcija->prepare($updateProizvoda);
                    $priprema->bindParam(":naziv",$naziv);
                    $priprema->bindParam(":cena",$cena);
                    $priprema->bindParam(":stanje",$stanje);
                    $priprema->bindParam(":novo",$novo);
                    $priprema->bindParam(":id_kat_potkat",$id_kat_potkat);
                    $priprema->bindParam(":opis",$opis);
                    $priprema->bindParam(":akcija",$akcija);
                    $priprema->bindParam(":idProizvoda",$idProizvoda);
                    try{
                        $priprema->execute();
                        echo "Rezultat rowCount-a pri apdejtu bez slike: ";
                        var_dump($priprema->rowCount());
                        if ($priprema->rowCount()){
                            $_SESSION['updateProizvoda']="Uspesno update-ovan proizvod";
                            header("Location: ../admin.php?admin=unos");
                        }else{
                            echo "Nista nije izmenjeno!";
                            $_SESSION['greske']= array("Greška prilikom izmene!");
                            header("Location: ../admin.php?admin=unos");
                        }
                    }catch (PDOException $e){
                        $_SESSION['greske']= array("Greška prilikom izmene!");
                        header("Location: ../admin.php?admin=unos");
                    }
                }else{
                    $idProizvoda = $_POST['idProizvoda'];
                    $updateProizvoda = "UPDATE proizvod SET naziv=:naziv, cena=:cena, stanje=:stanje, novo=:novo, 
                          id_kat_potkat=:id_kat_potkat, opis=:opis, id_akc_pro=:akcija WHERE proizvod_id=:idProizvoda";
                    $priprema = $konekcija->prepare($updateProizvoda);
                    $priprema->bindParam(":naziv",$naziv);
                    $priprema->bindParam(":cena",$cena);
                    $priprema->bindParam(":stanje",$stanje);
                    $priprema->bindParam(":novo",$novo);
                    $priprema->bindParam(":id_kat_potkat",$id_kat_potkat);
                    $priprema->bindParam(":opis",$opis);
                    $priprema->bindParam(":akcija",$akcija);
                    $priprema->bindParam(":idProizvoda",$idProizvoda);

                    try{
                        $konekcija->beginTransaction();
                        $rez = $priprema->execute();
                        $izmenjeno = 0;
                        $izmenjeno = $priprema->rowCount();
                        $dali = ubaciSlikuUBazu($imeSlike2,$idProizvoda,1);
                        if($izmenjeno == 0){
                            $izmenjeno = $dali;
                        }
                        $dali1 =ubaciSlikuUBazu($imeSlike1,$idProizvoda,1);
                        if($izmenjeno == 0){
                            $izmenjeno = $dali1;
                        }
                        if($izmenjeno == 1){
                            $konekcija->commit();
                            $_SESSION['updateProizvoda']="Uspesno update-ovan proizvod";
                            header("Location: ../admin.php?admin=unos");
                        }else{
                            $konekcija->rollBack();
                            $_SESSION['greske'] = "Nista nije izmenjeno";
                            header("Location: ../admin.php?admin=unos");
                        }
                    }catch (PDOException $e){
                        array_push($greske,$e->getMessage());
                        $_SESSION['greske'] = "Greška prilikom izmene";
                        header("Location: ../admin.php?admin=unos");
                    }
                }

            }
                else{
                    $_SESSION['greske']= array("Nije kliknuto na odgovarajuce dugme");
                    header("Location: ../admin.php?admin=unos");
                }
        }
        else{
            $_SESSION['greske']=$greske;
            header("Location: ../admin.php?admin=unos");
        }
    }
else{
    header("Location: index.php?page=index");
}

function premestiSliku($slika){
    global $greske;
    $maxVelicinaSlike = (2 *1024) *1024;

    if($slika['size']>$maxVelicinaSlike){
        array_push($greske,"Slika je veca od 2MB");
        return;
    }
    else{
        $staroMesto = $slika['tmp_name'];
        $novoMesto = "../images/proizvodi/";
        $staroIme = $slika['name'];
        $novoIme = time().$staroIme;
        $novoMesto = $novoMesto.$novoIme;
        // move_uploaded_file($staroMesto,$novoMesto);
        if(!move_uploaded_file($staroMesto,$novoMesto)){
            //var_dump($dali);
            array_push($greske,"Neuspesan upload slike");
            echo "Neuspesan upload slike";
        }
        return $novoIme;
    }

}
//PARAMETAR unsertUpdate SLUZI DA SE UTVRDI DA LI SE VRSI UNOS ILI IZMENA SLIKE U BAZU, UKOLIKO JE ON JEDNAK 1 TADA SE VRSI IZMENA
//U SUPROTNOM SE VRSI INSERT SLIKE
function ubaciSlikuUBazu($imeSlike,$id,$insertUpdate=0){
    global $konekcija;
    global $greske;
    $putanja = "images/proizvodi/".$imeSlike;
    $putanja = $putanja;
    if($insertUpdate==1){
        $updateSLike = "UPDATE slika_proizvod SET putanja=:putanja WHERE id_proizvod=:id";
        $priprema = $konekcija->prepare($updateSLike);
        echo "update slike";
    }else{
        $unosSlike="INSERT INTO slika_proizvod SET id_proizvod=:id, putanja=:putanja";
        $priprema = $konekcija->prepare($unosSlike);
        echo "Unos slike";
    }
    $priprema->bindParam(":id",$id);
    $priprema->bindParam(":putanja",$putanja);

    try{
        $priprema->execute();
        return $priprema->rowCount();
//        echo "rowCount izmene slike je: ";
//        var_dump($priprema->rowCount());
//        if(!$priprema->rowCount()){
//            array_push($greske,"Neuspesan upit u bazu");
//            echo "Neuspesan upit u bazu";
//            return false;
//        }
    }catch (PDOException $e){
        echo $e->getMessage();
        array_push($greske,$e->getMessage());
        return false;
    }
    return true;
}