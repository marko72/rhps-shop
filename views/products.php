<!-- Title Page -->


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <!-- levi deo strane gde se dinamicki ispisuju kategorije -->
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <h4 class="m-text14 p-b-7">
                        Categories
                    </h4>
                    <?php
                        $dohvatiKategorije = "SELECT * FROM kategorija";
                        $kategorije = executeQuery($dohvatiKategorije);
                        foreach ($kategorije as $k):
                    ?>
                    <?php endforeach;?>
                    <ul class="p-b-54">
                        <li class="p-t-4 kat">
                            <a href="<?=$_SERVER['PHP_SELF']?>?page=products&pg=1" class="s-text13 active1">
                                Svi proizvodi
                            </a>
                        </li>
                        <?php
                        $dohvatiKategorije = "SELECT * FROM kategorija";
                        $kategorije = executeQuery($dohvatiKategorije);
                        foreach ($kategorije as $k):
                            ?>
                            <li class="p-t-4 kat">
                                <a href="<?=$_SERVER['PHP_SELF']?>?page=products&kat=<?=$k->kategorija_id?>" class="s-text13">
                                    <?=$k->naziv?>
                                </a>
                                <?php if(isset($_SESSION['korisnik'])):?>
                                    <?php prikaziKategorije($k->kategorija_id);?>
                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Default Sorting</option>
                                <option>Popularity</option>
                                <option>Price: low to high</option>
                                <option>Price: high to low</option>
                            </select>
                        </div>

                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Price</option>
                                <option>$0.00 - $50.00</option>
                                <option>$50.00 - $100.00</option>
                                <option>$100.00 - $150.00</option>
                                <option>$150.00 - $200.00</option>
                                <option>$200.00+</option>

                            </select>
                        </div>
                    </div>

                    <span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
                </div>

                <!-- Product -->
                <div class="row">
                    <?php if(isset($_GET['podkat'])):
                        $id_potkat = $_GET['podkat'];
                        $dohvatiProizvodePotkategorije="SELECT *,p.naziv AS p_naziv FROM proizvod p 
                                                        INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod 
                                                        INNER JOIN kategorija_potkategorija kp ON p.id_kat_potkat=kp.id_kat_potkat 
                                                        INNER JOIN potkategorija pk ON kp.id_potkat=pk.potkat_id 
                                                        WHERE kp.id_kat_potkat=:id_potkat GROUP BY p.proizvod_id";
                        $pripremaProizvodaPotkategorije = $konekcija->prepare($dohvatiProizvodePotkategorije);
                        $pripremaProizvodaPotkategorije->bindParam(":id_potkat", $id_potkat);
                        try{
                            $pripremaProizvodaPotkategorije->execute();
                            $proizvodiPotkategorije = $pripremaProizvodaPotkategorije->fetchAll();
                            if($proizvodiPotkategorije){
                                foreach ($proizvodiPotkategorije as $pp):
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">

                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($pp->novo==1)?'block2-labelnew':'';?>">
                                                <img src="<?=$pp->putanja?>" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4 lajk" data-id="<?= $pp->proizvod_id?>" >
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true" ></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" ></i>
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
                                                <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?= $pp->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?= $pp->p_naziv?>
                                                </a>

                                                <span class="block2-price m-text6 p-r-5">
										<?= $pp->cena?>din
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


                    //  DOHVATANJE PROIZVODA NA OSNOVU KATEGORIJE




                        elseif(isset($_GET['kat'])):
                            $id_kat = $_GET['kat'];
                            $dohvatiProizvodeKategorije="SELECT *,p.naziv AS p_naziv FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod INNER JOIN kategorija_potkategorija kp ON p.id_kat_potkat=kp.id_kat_potkat INNER JOIN kategorija k ON kp.id_kat=k.kategorija_id WHERE kategorija_id=:id_kat GROUP BY p.proizvod_id";
                            $pripremaProizvodaKategorije = $konekcija->prepare($dohvatiProizvodeKategorije);
                            $pripremaProizvodaKategorije->bindParam(":id_kat", $id_kat);
                            try{
                                $pripremaProizvodaKategorije->execute();
                                $proizvodiKategorije = $pripremaProizvodaKategorije->fetchAll();
                                if($proizvodiKategorije){
                                    foreach ($proizvodiKategorije as $pk):
                                        ?>
                                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">

                                            <!-- Block2 -->
                                            <div class="block2">
                                                <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($pk->novo==1)?'block2-labelnew':'';?>">
                                                    <img src="<?=$pk->putanja?>" alt="IMG-PRODUCT">

                                                    <div class="block2-overlay trans-0-4">
                                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4 lajk" data-id="<?= $pp->proizvod_id?>" >
                                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" ></i>
                                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" ></i>
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
                                                    <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?= $pk->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                                        <?= $pk->p_naziv?>
                                                    </a>

                                                    <span class="block2-price m-text6 p-r-5">
										<?= $pk->cena?>din
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

                    <?php else:
                            $ukupnoProizvoda = count($proizvodi);
                            $brojProizvodaPoStrani = 6;
                            $brojStrana = ceil($ukupnoProizvoda/$brojProizvodaPoStrani);
                            if(isset($_GET['pg'])):
                                $pg=$_GET['pg'];
                                $prikaziOd= ($pg-1)*$brojProizvodaPoStrani;
                                $dohvatiProizvode = "SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod 
                                  GROUP BY p.proizvod_id LIMIT $prikaziOd,$brojProizvodaPoStrani";
                                $proizvodiPG = executeQuery($dohvatiProizvode);
                                foreach ($proizvodiPG as $p):
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">

                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo($p->novo==1)?'block2-labelnew':'';?>">
                                                <img src="<?=$p->putanja?>" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4 lajk" data-id="<?= $p->proizvod_id?>" >
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true" ></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" ></i>
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
                                                <a href="<?=$_SERVER['PHP_SELF']?>?page=product-detail&id=<?= $p->proizvod_id?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?= $p->naziv?>
                                                </a>

                                                <span class="block2-price m-text6 p-r-5">
                                            <?= $p->cena?>din
                                        </span>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                endforeach;
                            ?>
                        <?php
                            endif;
                        endif;
                    ?>

                </div>

                <!-- Pagination -->
                <?php if(isset($_GET['pg'])):?>
                <div class="pagination flex-m flex-w p-t-26">
                    <?php for ($i=0;$i<$brojStrana;$i++):?>
                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products&pg=<?=($i+1)?>" class="item-pagination flex-c-m trans-0-4 active-pagination"><?=($i+1)?></a>
                    <?php endfor;?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
