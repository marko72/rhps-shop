<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <!-- block1 -->
                <?php
                    $dohvatiKategorije = "SELECT * FROM kategorija";
                    $kategorije = executeQuery($dohvatiKategorije);
                    foreach ($kategorije as $k):
                ?>

                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="<?=$k->slika?>" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">
                        <!-- Button -->
                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products&kat=<?=$k->kategorija_id?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            <?=$k->naziv?>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <!-- block1 -->
                <?php
                    $dohvatiPotkategorije = "SELECT *, kp.slika AS potkat_slika, p.naziv AS p_naziv, p.class AS p_class, k.class AS k_class 
                    FROM potkategorija p inner join kategorija_potkategorija kp on p.potkat_id=kp.id_potkat 
                    inner join kategorija k on kp.id_kat=k.kategorija_id 
                    WHERE k.class='muskarci' LIMIT 0,2";
                    $potkategorije = executeQuery($dohvatiPotkategorije);
                    if(is_null($potkategorije)):
                ?>
                    <h3>Nema potkategorija</h3>
                <?php
                else:
                    foreach ($potkategorije as $p):
                ?>
                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="<?=$p->potkat_slika?>" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">
                        <!-- Button -->
                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products&potkat=<?=$p->id_kat_potkat?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            <?=$p->p_naziv?>
                        </a>
                    </div>
                </div>
                <?php
                    endforeach;
                    endif;
                    ?>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <!-- block1 -->
                <?php
                if(isset($_SESSION['korisnik'])):
                $dohvatiPotkategorije = "SELECT *, kp.slika AS potkat_slika, p.naziv AS p_naziv FROM potkategorija p 
                inner join kategorija_potkategorija kp on p.potkat_id=kp.id_potkat 
                inner join kategorija k on kp.id_kat=k.kategorija_id
                WHERE k.class='zene' LIMIT 0,2";

                $potkategorije = executeQuery($dohvatiPotkategorije);
                if(is_null($potkategorije)):
                ?>
                    <h3>Nema potkategorija zene</h3>
                <?php
                else:
                    foreach ($potkategorije as $p):
                ?>
                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="<?=$p->potkat_slika?>" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">
                        <!-- Button -->
                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products&potkat=<?=$p->id_kat_potkat?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            <?=$p->p_naziv?>
                        </a>
                    </div>
                </div>
                <?php
                    endforeach;
                    endif;
                else:
                $dohvatiPotkategorije = "SELECT *, kp.slika AS potkat_slika, p.naziv AS p_naziv FROM potkategorija p 
                inner join kategorija_potkategorija kp on p.potkat_id=kp.id_potkat 
                inner join kategorija k on kp.id_kat=k.kategorija_id 
                WHERE k.class='zene' LIMIT 0,1";
                $potkategorije = executeQuery($dohvatiPotkategorije);
                if(is_null($potkategorije)):
                    ?>
                    <h3>Nema potkategorija zene</h3>
                <?php
                else:
                foreach ($potkategorije as $p):
                    ?>
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img src="<?=$p->potkat_slika?>" alt="IMG-BENNER">

                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=products&potkat=<?=$p->id_kat_potkat?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                <?=$p->p_naziv?>
                            </a>
                        </div>
                    </div>
                <?php
                endforeach;
                endif;
                endif;?>

                <!-- block2 -->
                <?php if(!isset($_SESSION['korisnik'])):?>
                <div class="block2 wrap-pic-w pos-relative m-b-30">
                    <img src="images/icons/bg-01.jpg" alt="IMG">

                    <div class="block2-content sizefull ab-t-l flex-col-c-m">
                        <h4 class="m-text4 t-center w-size3 p-b-8">
                            Registrujte se sada i dobite 20% popusta
                        </h4>

                        <p class="t-center w-size4">
                            Prvi saznajte šta imamo u ponudi za vas
                        </p>

                        <div class="w-size2 p-t-25">
                            <!-- Button -->
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=registracija" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                                Registrujte se
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>