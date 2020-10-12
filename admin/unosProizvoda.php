<span class="help-block text-danger" id="poruka">
            <?php
            if(isset($_SESSION['unosProizvoda'])){
                echo "Uspesno unet proizvod<br/>";
                unset($_SESSION['unosProizvoda']);
            }elseif (isset($_SESSION['updateProizvoda'])){
                echo "Uspesan update proizvoda";
                unset($_SESSION['updateProizvoda']);
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
<div class="container bg-light rounded p-4">

    <legend class="form-legend">Unos proizvoda</legend>
    <form class="form-horizontal" action="modules/unosProizvoda.php" method="post" enctype="multipart/form-data">
        <div class="form-group form-row">
            <label class="col-md-4 col-form-label" for="naziv">Naziv proizvoda: </label>
            <div class="col-md-8">
                <input id="naziv" name="naziv" type="text" placeholder="Naziv proizvoda" class="form-control input-md" required="" value="<?php echo isset($proizvod)?$proizvod->naziv:"";?>">
                <span class="help-block naziv-help"></span>
            </div>
        </div>
        <div class="form-group form-row">
            <label class="col-md-4 col-form-label" for="cena">Cena:</label>
            <div class="col-md-8">
                <input id="cena" name="cena" type="number" placeholder="Cena proizvoda" class="form-control input-md" required="" value="<?php echo isset($proizvod)?$proizvod->cena:"";?>">
                <span class="help-block cena-help">Cenu unesite sa tackom ili bez nje: 3000|3000.00 </span>
            </div>
        </div>
        <div class="form-group form-row">
            <label for="stanje" class="col-md-4 col-form-label">Stanje: </label>
            <div class="col-md-8">
                <input id="stanje" name="stanje" type="number" placeholder="Unesite broj proizvoda" class="form-control input-md" value="<?php echo isset($proizvod)?$proizvod->stanje:"";?>"  required="">
                <span class="help-block stanje-help"></span>
            </div>
        </div>
        <div class="form-group form-row">
            <label class="col-md-4 col-form-label" for="opis">Opis proizvoda: </label>
            <div class="col-md-8">
                <textarea class="form-control" aria-label="With textarea" name="opis" id="opis"><?php echo isset($proizvod)?$proizvod->opis:"";?></textarea>
            </div>
        </div>
        <div class="form-group form-row">
            <label class="col-md-4 col-form-label" for="kategorija">Izaberite kategoriju: </label>
            <div class="col-md-8">
                <select class="custom-select w-full" name="kategorija" id="kategorija">
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
        <div class="form-group form-row">
            <label class="col-md-4" for="podkategorija">Izaberite podkategoriju: </label>
            <div class="col-md-8">
                <select class="custom-select col-lg-6" name="podkategorija" id="podkategorija">
                    <option value="0">Izaberite</option>
                    <?php
                    $upitPotkategorije = "select * from potkategorija";
                    $potkategorije = executeQuery($upitPotkategorije);
                    foreach ($potkategorije as $potkategorija):
                        ?>
                        <option value="<?=$potkategorija->potkat_id?>"><?=$potkategorija->naziv?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group form-row">
            <label for="akcija" class="col-md-4 col-form-label">Akcija: </label>
            <div class="col-md-8">
                <select class="form-control" name="akcija" id="akcija">
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
        <div class="form-group form-row">
            <label class="col-md-4 control-label" for="confirmasipassword">Slika proizvoda:</label>
            <div class="col-md-8">
                <input id="slika" name="slika" type="file" class="form-control flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" >
                <span class="help-block slika-help"></span>
            </div>
        </div>
        <div class="form-group form-row">
            <label class="col-md-4 control-label" for="confirmasipassword">Druga slika proizvoda: </label>
            <div class="col-md-8">
                <input id="slika2" name="slika2" type="file" class="form-control flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" >
                <span class="help-block slika-help"></span>
            </div>
        </div>
        <div class="form-group-form-row">
            <label class="col-md-4 col-form-label" for="gender">Novo: </label>
                <label class="radio-inline col-form-label" for="novo">
                    <input type="radio" name="novo" id="novoDa" value="da" checked="checked">
                    Da
                </label>
                <label class="radio-inline col-form-label" for="novo">
                    <input type="radio" name="novo" id="novoNe" value="ne">
                    Ne
                </label>
        </div>
        <div class="form-row form-group justify-content-center align-items-center">
            <div class="col-md-2">
                <?php
                if(isset($_GET['id'])):
                    ?>
                    <button id="btnIzmenaProizvoda" name="btnIzmenaProizvoda" class="btn btn-primary">Izmeni Proizvod</button>
                    <input type="hidden" name="idProizvoda" id="idProizvoda" value="<?php echo(isset($_GET['id']))?$_GET['id']:"";?>">
                <?php
                else:
                    ?>
                    <button id="btnUnosProizvoda" name="btnUnosProizvoda" class="btn btn-primary">Unesi Proizvod</button>
                <?php endif;?>
            </div>
        </div>
    </form>
</div>