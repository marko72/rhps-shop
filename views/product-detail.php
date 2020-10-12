<?php
    if(isset($proizvod)){
    }else{
        echo "nema proizvoda";
    }
?>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="index.php?page=index" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="index.php?page=products&kat=<?=$proizvod[0]->kategorija_id?>" class="s-text16">
        <?=$proizvod[0]->k_naziv?>
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="index.php?page=products&kat=<?=$proizvod[0]->potkat_id?>" class="s-text16">
        <?=$proizvod[0]->pk_naziv?>
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
			<?=$proizvod[0]->p_naziv?>
    </span>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots">

                </div>

                <div class="slick3">
                    <div class="item-slick3" data-thumb="<?=$proizvod[1]->putanja?>">
                        <div class="wrap-pic-w">
                            <img src="<?=$proizvod[1]->putanja?>" alt="<?=strtolower($proizvod[1]->pk_naziv)?>">
                        </div>
                    </div>
                    <div class="item-slick3" data-thumb="<?=$proizvod[0]->putanja?>">
                        <div class="wrap-pic-w">
                            <img src="<?=$proizvod[0]->putanja?>" alt="<?=strtolower($proizvod[0]->pk_naziv)?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text16 p-b-13">
                <?=$proizvod[0]->p_naziv?>
            </h4>

            <span class="m-text17 text-info">
					<?=$proizvod[0]->cena?>.00 $
				</span>

                <div class="flex-r-m flex-w p-t-10">
                    <div class="w-size16 flex-m flex-w">
                        <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                            </button>

                            <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                            <!-- Button -->
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Dodaj u korpu
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-b-45">
                <span class="s-text8">Categories: <?=$proizvod[0]->k_naziv?>/<?=$proizvod[0]->pk_naziv?></span>
            </div>

            <!--  -->
            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Opis
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        <?=$proizvod[0]->opis?>
                    </p>
                </div>
            </div>

            <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Lajkova:
                    <?php
                        $id= $proizvod[0]->proizvod_id;
                        $upitBrojLajova = "SELECT COUNT(id_proizvod) AS broj_lajkova FROM korisnik_proizvod_lajk WHERE id_proizvod=:id";
                        $rez = dohvatiNaOsnovuID($upitBrojLajova,$id);
                        echo $rez->broj_lajkova;
                    ?>
                </h5>
            </div>
        </div>
    </div>
</div>


<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Related Products
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <?php
                        $idPotkategorije = $proizvod[0]->potkat_id;
                        $dohvatiProizvodeIstePotkategorije = "SELECT *,p.naziv AS p_naziv FROM proizvod p 
                        INNER JOIN slika_proizvod sp ON p.proizvod_id=sp.id_proizvod 
                        INNER JOIN kategorija_potkategorija kp ON p.id_kat_potkat=kp.id_kat_potkat 
                        INNER JOIN potkategorija pk ON kp.id_potkat=pk.potkat_id 
                        WHERE potkat_id=:id GROUP BY p.proizvod_id limit 0,2";
                        $rez = dohvatiNaOsnovuID($dohvatiProizvodeIstePotkategorije, $idPotkategorije,1);
                        foreach ($rez as $p):
                    ?>
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                            <img src="<?=$p->putanja?>" alt="<?=strtolower($p->opis)?>">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
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

                            <span class="block2-price m-text6 p-r-5 text-info">
                                <?=$p->cena?>.00 $
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>
</section>