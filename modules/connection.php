<?php
include "config.php";
$konekcija = null;
try{
    //Update check
    $opt = array(
        PDO::MYSQL_ATTR_FOUND_ROWS   => true
    );
    $konekcija = new PDO("mysql:host=".MYSQL_HOSTNAME.";dbname=".MYSQL_DBNAME.";charset=utf8",MYSQL_USERNAME, MYSQL_PASSWD,$opt);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch (PDOException $e){
    echo $e->getMessage();
}
function executeQuery($upit){
    global $konekcija;
    try{
        $rezultat =$konekcija->query($upit)->fetchAll();
        if($rezultat){
            return $rezultat;
        }
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }
}
//UKOLIKO SE PROMENLJIVOJ daLi PROSLEDI 1 ONA CE URADITI fetchAll ODNOSNO OVAJ PARAMETAR JOJ GOVORI DA LI DA DOHVATI NIZ OBJEKATA ILI SAMO 1
function dohvatiNaOsnovuID($upit,$id,$daLi=0){
    global $konekcija;
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $priprema->execute();
        if($daLi==1){
            $rezultat = $priprema->fetchAll();
        }else{
            $rezultat = $priprema->fetch();
        }
        if($rezultat){
            return $rezultat;
        }else{
            return "nije izvrsen upit";
        }
    }catch (PDOException $e){
        echo $e->getMessage();
        return $e->getMessage();
    }
}
function ispisiMeni($roditelj){
    global $konekcija;
    $dohvatiDecuMenija = "SELECT * FROM meni WHERE roditelj=:roditelj";
    $pripremaPodmenija = $konekcija->prepare($dohvatiDecuMenija);
    $pripremaPodmenija->bindParam(":roditelj",$roditelj);
    try{
        $pripremaPodmenija->execute();
        $podmeniji = $pripremaPodmenija->fetchAll();
        if($podmeniji){
            echo "<ul class='sub_menu'>";
                foreach ($podmeniji as $p){
                    echo "<li><a href='admin.php?admin=$p->putanja'>$p->naziv</a></li>";
                }
            echo "</ul>";
        }else{
            echo "Serverska greska pri dohvatanju";
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }

}
//funkcija za ispisivanje podkategorija odredjenih kategorija
function prikaziKategorije($idKat){
    global $konekcija;
    $dohvatiPodkategorije ="SELECT *, p.naziv AS p_naziv, k.naziv AS k_naziv, k.class AS k_class, p.class AS p_class 
                            FROM kategorija k INNER JOIN kategorija_potkategorija kp ON k.kategorija_id = kp.id_kat 
                            INNER JOIN potkategorija p ON kp.id_potkat=p.potkat_id 
                            WHERE kp.id_kat=:idKat";
    $priprema = $konekcija->prepare($dohvatiPodkategorije);
    $priprema->bindParam(":idKat",$idKat);
    try{
        $priprema->execute();
        if($priprema->rowCount()>0){
            $podkategorije =$priprema->fetchAll();
            echo '<ul class="padajuci-meni">';
            foreach ($podkategorije as $p) {
                echo '<li><a href="'.$_SERVER['PHP_SELF']."?page=products&podkat=".$p->id_kat_potkat.'">'.$p->p_naziv.'</a></li>';
            }
            echo "</ul>";
        }else{
            echo "</ul>";
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}