<span class="help-block" id="poruka">
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
<div class="container">
    <div class="form-row-lg">
                <legend>Unos kategorije</legend>

                <div class="form-group">
                    <label class="col-lg-4 control-label" for="kategorija">Naziv kategorije</label>
                    <div class="col-lg-6">
                        <input id="kategorija" name="kategorija" type="text" placeholder="Naziv kategorije" class="form-control input-md">
                        <span class="help-block" id="kat-help"></span>
                    </div>
                    <button id="btnKat" name="btnKat" class="btn btn-primary">Unesi Kategoriju</button>
                </div>
                <legend>Unos potkategorije</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="ddlKat">Izaberite kategoriju: </label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="ddlKat" id="ddlKat">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitKat = "select * from kategorija";
                            $kategorije = executeQuery($upitKat);
                            foreach ($kategorije as $kat):
                                ?>
                                <option value="<?=$kat->kategorija_id?>"><?=$kat->naziv?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="help-block" id="podkatkat-help"></span>
                    </div>
                    <label class="col-lg-4 control-label" for="podkat">Naziv potkategorije</label>
                    <div class="col-lg-6">
                        <input id="podkat" name="podkat" type="text" placeholder="Naziv potkategorije" class="form-control input-md">
                        <span class="help-block" id="podkat-help"></span>
                        <button id="btnPodKat" name="btnPodKat" class="btn btn-primary">Unesi potkategoriju</button>
                    </div>
                </div>
                <legend>Unos akcije</legend>
                <div class="form-group">
                    <div class="col-lg-6">
                        <label class="col-lg-4 control-label" for="akcija">Naziv akcije</label>
                        <input id="akcija" name="akcija" type="text" placeholder="Naziv akcije" class="form-control input-md">
                        <span class="help-block" id="akcija-help"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-4 control-label" for="akcija">Trajanje akcije</label>
                        <input id="datumAkcija" name="datumAkcija" type="date" placeholder="Trajanje akcije" class="form-control input-md">
                        <span class="help-block" id="datum-akcije-help"></span>
                    </div>
                    <button id="btnAkcija" name="btnAkcija" class="btn btn-primary">Unesi Akciju</button>
                </div>
                <legend>Update akcije</legend>
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="akcija">Izaberite akciju za update</label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="ddlAkcija" id="ddlAkcija">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitAkcija = "select * from akcija";
                            $akcije = executeQuery($upitAkcija);
                            foreach ($akcije as $akcija):
                                ?>
                                <option value="<?=$akcija->akcija_id?>"><?=$akcija->naziv_akcije?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="help-block" id="ddlAkcija-help"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-4 control-label" for="akcija">Naziv akcije</label>
                        <input id="akcijaUpdate" name="akcijaUpdate" type="text" placeholder="Naziv akcije" class="form-control input-md">
                        <span class="help-block" id="akcija-update-help"></span>
                        <label class="col-lg-4 control-label" for="akcija">Trajanje akcije</label>
                        <input id="datumAkcijaUpdate" name="datumAkcijaUpdate" type="date" placeholder="Trajanje akcije" class="form-control input-md">
                        <span class="help-block" id="datum-akcije-help-update"></span>
                    </div>
                    <button id="btnUpdateAkcija" name="btnUpdateAkcija" class="btn btn-primary">Update-uj Akciju</button>
                </div>
        <div class="form-group">
            <label class="col-lg-4 control-label" for="ddlAkcijaDel">Obrisite akciju</label>
            <div class="col-lg-6">
                <select class="custom-select col-lg-6" name="ddlAkcijaDel" id="ddlAkcijaDel">
                    <option value="0">Izaberite</option>
                    <?php
                    $upitAkcija = "select * from akcija";
                    $akcije = executeQuery($upitAkcija);
                    foreach ($akcije as $akcija):
                        ?>
                        <option value="<?=$akcija->akcija_id?>"><?=$akcija->naziv_akcije?></option>
                    <?php endforeach;?>
                </select>
                <span class="help-block" id="ddlAkcijaDel-help"></span>
            </div>
            <button id="btnDelAkcija" name="btnDelAkcija" class="btn btn-primary">Obrisi akciju</button>
        </div>
    </div>
</div>