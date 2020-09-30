<?php
//funkcija za ispisivanje podkategorija odredjenih kategorija
function prikaziKategorije($idKat,$konekcija){
    $dohvatiPodkategorije ="SELECT *, p.naziv AS p_naziv, k.naziv AS k_naziv, k.class AS k_class, p.class AS p_class FROM kategorija k INNER JOIN kategorija_podkategorija kp ON k.kategorija_id = kp.id_kat INNER JOIN podkategorija p ON kp.id_podkat=p.podkat_id WHERE kp.id_kat=:idKat";
    $priprema = $konekcija->prepare($dohvatiPodkategorije);
    $priprema->bindParam(":idKat",$idKat);
    try{
        $priprema->execute();
        if($priprema->rowCount()>0){
            $podkategorije =$priprema->fetchAll();
            echo '<ul class="padajuci-meni">';
            foreach ($podkategorije as $p) {
                echo '<li><a href="" class="'.$p->k_class.$p->p_class.'">'.$p->p_naziv.'</a></li>';
            }
            echo "</ul>";
        }else{
            echo "</ul>";
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}
?>
<?php
$dohvatiKategorije = "SELECT * FROM kategorija";
$kategorije = executeQuery($dohvatiKategorije);
foreach ($kategorije as $k):
    ?>
    <li class="p-t-4 kat">
        <a href="#" class="s-text13 <?=$k->class?>">
            <?=$k->naziv?>
        </a>
        <?php prikaziKategorije($k->kategorija_id,$konekcija);?>
    </li>
<?php endforeach;?>
