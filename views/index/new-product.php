<section class="newproduct bgwhite p-t-45 p-b-105">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Istaknuti proizvodi
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
            <?php
                if(isset($_SESSION['korisnik'])):
                    $pol_korisnika = $_SESSION['korisnik']->id_pol;
                    if($pol_korisnika==1){
                        $pol_korisnika = "muskarci";
                    }else{
                        $pol_korisnika = "zene";
                    }
                    $proizvodiKorisnika = "SELECT *, p.naziv AS p_naziv FROM proizvod p 
                    INNER JOIN slika_proizvod sp ON p.proizvod_id = sp.id_proizvod 
                    INNER JOIN kategorija_potkategorija kp ON p.id_kat_potkat=kp.id_kat_potkat 
                    INNER JOIN kategorija k ON kp.id_kat=k.kategorija_id WHERE k.class=:pol_korisnika 
                    GROUP BY p.proizvod_id LIMIT 0,12";
                    $pripremaProizvodaKorisnika = $konekcija->prepare($proizvodiKorisnika);
                    $pripremaProizvodaKorisnika->bindParam(":pol_korisnika", $pol_korisnika);
                    try{
                        $pripremaProizvodaKorisnika->execute();
                        $proizvodiKorisnika = $pripremaProizvodaKorisnika->fetchAll();
                        if($proizvodiKorisnika){
                            foreach ($proizvodiKorisnika as $p):
                                ?>
                                <div class="item-slick2 p-l-15 p-r-15">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($p->novo==1)?'block2-labelnew':'';?>">
                                            <img src="<?=$p->putanja?>" alt="<?= strtolower($p->opis)?>">

                                            <div class="block2-overlay trans-0-4">
                                                <a href="#" class="block2-btn-addwishlist lajk hov-pointer trans-0-4" data-id="<?=$p->proizvod_id?>">
                                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                </a>

                                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    <!-- Button -->
                                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                        Dodaj u korpu
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                            <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?=$p->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                                <?=$p->p_naziv?>
                                            </a>

                                            <span class="block2-price m-text6 p-r-5">
									<?=$p->cena?>
								</span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        }else{
                            $dohvatiProizvode = "SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id = sp.id_proizvod GROUP BY p.proizvod_id LIMIT 0,12";
                            $proizvodi = executeQuery($dohvatiProizvode);
                            foreach ($proizvodi as $p):
                                ?>
                                <div class="item-slick2 p-l-15 p-r-15">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($p->novo==1)?'block2-labelnew':'';?>">
                                            <img src="<?=$p->putanja?>" alt="<?= strtolower($p->opis)?>">

                                            <div class="block2-overlay trans-0-4">
                                                <a href="#" class="block2-btn-addwishlist lajk hov-pointer trans-0-4" data-id="<?=$p->proizvod_id?>">
                                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                </a>

                                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    <!-- Button -->
                                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                        Dodaj u korpu
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                            <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?=$p->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                                <?=$p->naziv?>
                                            </a>

                                            <span class="block2-price m-text6 p-r-5">
									<?=$p->cena?>
								</span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        }

                    }catch (PDOException $e){
                        echo $e->getMessage();
                    }
                ?>
            <?php
            else:
                $dohvatiProizvode = "SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id = sp.id_proizvod GROUP BY p.proizvod_id LIMIT 0,12";
                $proizvodi = executeQuery($dohvatiProizvode);
                foreach ($proizvodi as $p):
            ?>
                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($p->novo==1)?'block2-labelnew':'';?>">
                            <img src="<?=$p->putanja?>" alt="<?= strtolower($p->opis)?>">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist lajk hov-pointer trans-0-4" data-id="<?=$p->proizvod_id?>">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Dodaj u korpu
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?=$p->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                <?=$p->naziv?>
                            </a>

                            <span class="block2-price m-text6 p-r-5">
									<?=$p->cena?>
								</span>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                    endif;
                ?>
            </div>
        </div>

    </div>
</section>

<!-- Banner2 -->
<section class="banner2 bg5 p-t-55 p-b-55">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
                <div class="hov-img-zoom pos-relative">
                    <?php
                        if(isset($_SESSION['korisnik'])):
                            $pol_korisnika = $_SESSION['korisnik']->id_pol;
                            if($pol_korisnika==1){
                                $pol_korisnika = "muskarci";
                            }else{
                                $pol_korisnika = "zene";
                            }
                            $kategorijaKorisnika = "SELECT * FROM kategorija WHERE class = :pol_korisnika";
                            $pripremaKategorijaKorisnika = $konekcija->prepare($kategorijaKorisnika);
                            $pripremaKategorijaKorisnika->bindParam(":pol_korisnika", $pol_korisnika);
                            try{
                                $pripremaKategorijaKorisnika->execute();
                                $rezKat = $kategorijaKorisnika = $pripremaKategorijaKorisnika->fetch();
                            if($rezKat){
                                echo '<img src="'.$rezKat->slika.'" alt="IMG-BANNER">';
                            }else{
                                echo "Neuspesno";
                            }
                            }catch (PDOException $e){
                                echo $e->getMessage();
                            }
                    ?>
                    <?php else:?>
                        <img src="images/kat.jpg" alt="IMG-BANNER">
                    <?php endif;?>

                    <div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
							<span class="m-text9 p-t-45 fs-20-sm">
								Proizvodi
							</span>

                        <h3 class="l-text1 fs-35-sm">
                            <?php
                                if(isset($_SESSION['korisnik'])){
                                $korisnik = $_SESSION['korisnik'];
                                $pol_id = $korisnik->id_pol;
                                $upitPolKorisnik = "select naziv from korisnik k inner join pol p on k.id_pol=p.pol_id 
                                                                where pol_id = :pol_id";
                                $priprema = $konekcija->prepare($upitPolKorisnik);
                                $priprema->bindParam(":pol_id",$pol_id);
                                try{
                                    $priprema->execute();
                                    $rezultat = $priprema->fetch();
                                    if(!$rezultat){
                                        echo "Proizvodi!";
                                    }
                                    else{
                                        echo $rezultat->naziv;
                                    }
                                }
                                catch (PDOException $e){
                                    echo $e->getMessage();
                                }
                                }
                            ?>
                        </h3>

                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products" class="s-text4 hov2 p-t-20 ">
                            Samo za vas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>