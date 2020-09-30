
<!------ Include the above in your HEAD tag ---------->
<?php

    if(isset($proizvod)){
        var_dump($proizvod);
    }
    else{
        echo  "Nema proizvoda";
    }

?>
<span class="help-block" id="poruka">
            <?php
            if(isset($_SESSION['unosProizvoda'])){
                echo "Uspesno unet proizvod<br/>";
                echo $_SESSION['unosProizvoda'];
                unset($_SESSION['unosProizvoda']);
            }
            if(isset($_SESSION['greske'])):
                $greske = $_SESSION['greske'];
                ?>
                <ul>
                    <?php foreach ($greske as $greska):?>
                        <li><?=$greska?></li>
                    <?php endforeach;?>
            </ul>

            <?php unset($_SESSION["greske"]); endif;?>
        </span>
<div class="container">
    <div class="form-row-lg">
        <form class="form-horizontal" action="modules/unosProizvoda.php" method="post" enctype="multipart/form-data">
            <fieldset>

                <!-- Form Name -->
                <legend>Unos proizvoda</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="naziv">Naziv proizvoda</label>
                    <div class="col-lg-6">
                        <input id="naziv" name="naziv" type="text" placeholder="Naziv proizvoda" class="form-control input-md" required="">
                        <span class="help-block naziv-help"></span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="cena">Cena</label>
                    <div class="col-lg-6">
                        <input id="cena" name="cena" type="number" placeholder="Cena proizvoda" class="form-control input-md" required="">
                        <span class="help-block cena-help">Cenu unesite sa tackom ili bez nje: 3000|3000.00 </span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Stanje</label>
                    <div class="col-lg-6">
                        <input id="stanje" name="stanje" type="number" placeholder="Unesite broj proizvoda" class="form-control input-md" required="">
                        <span class="help-block stanje-help"></span>
                    </div>
                </div>


                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Opis proizvoda: </label>
                    <div class="col-lg-6">
                        <textarea class="form-control" aria-label="With textarea" name="opis" id="opis"></textarea>

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="kategorija">Izaberite kategoriju: </label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="kategorija" id="kategorija">
                            <option value="0">Izaberite</option>
                            <?php
                                $upitKategorije = "select * from kategorija";
                                $kategorije = executeQuery($upitKategorije);
                                foreach ($kategorije as $kategorija):
                            ?>
                                    <option value="<?=$kategorija->kategorija_id?>"><?=$kategorija->naziv?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="podkategorija">Izaberite podkategoriju: </label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="podkategorija" id="podkategorija">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitPodkategorije = "select * from podkategorija";
                            $podkategorije = executeQuery($upitPodkategorije);
                            foreach ($podkategorije as $podkategorija):
                                ?>
                                <option value="<?=$podkategorija->podkat_id?>"><?=$podkategorija->naziv?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="podkategorija">Akcija: </label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="akcija" id="akcija">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitAkcija = "select * from akcija";
                            $akcije = executeQuery($upitAkcija);
                            foreach ($akcije as $akcija):
                                ?>
                                <option value="<?=$akcija->akcija_id?>"><?=$akcija->naziv_akcije?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirmasipassword">Slika proizvoda:</label>
                    <div class="col-lg-6">
                        <input id="slika" name="slika" type="file" class="form-control flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" >
                        <span class="help-block slika-help"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirmasipassword">Druga slika proizvoda:</label>
                    <div class="col-lg-6">
                        <input id="slika2" name="slika2" type="file" class="form-control flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" >
                        <span class="help-block slika-help"></span>
                    </div>
                </div>

                <!-- Multiple Radios (inline) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="gender">Novo</label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="novo">
                            <input type="radio" name="novo" id="novoDa" value="da" checked="checked">
                            Da
                        </label>
                        <label class="radio-inline" for="novo">
                            <input type="radio" name="novo" id="novoNe" value="ne">
                            Ne
                        </label>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btnUnosProizvoda"></label>
                    <div class="col-md-4">
                        <button id="btnUnosProizvoda" name="btnUnosProizvoda" class="btn btn-primary">Unesi Proizvod</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
</div>