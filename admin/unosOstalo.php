<div class="container">
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
</div>


<div class="container p-2">
    <div class="form-group bg-light p-4">
        <legend class="">Unos kategorije</legend>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="kategorija">Naziv kategorije: </label>
                    </div>
                    <div class="col-md-8">
                        <input id="kategorija" name="kategorija" type="text" placeholder="Naziv kategorije" class="form-control input-md">
                        <span class="help-block text-danger small" id="kat-help"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row h-100 align-items-end justify-content-end">
                    <div class="col-10 align-self-end">
                        <button id="btnKat" name="btnKat" class="btn btn-primary w-full">Unesi Kategoriju</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group bg-light p-4">
        <legend>Unos potkategorije</legend>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="ddlKat">Izaberite kategoriju: </label>
                    </div>
                    <div class="col-md-8">
                        <select class="custom-select w-full" name="ddlKat" id="ddlKat">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitKat = "select * from kategorija";
                            $kategorije = executeQuery($upitKat);
                            foreach ($kategorije as $kat):
                                ?>
                                <option value="<?=$kat->kategorija_id?>"><?=$kat->naziv?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="row m-t-6">
                    <div class="col-md-4">
                        <label class="control-label" for="podkat">Naziv potkategorije: </label>
                    </div>
                    <div class="col-md-8">
                        <input id="podkat" name="podkat" type="text" placeholder="Naziv potkategorije" class="form-control input-md">
                        <span class="help-block text-danger small" id="podkat-help"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row h-100 align-items-end justify-content-end">
                    <div class="col-10 align-self-end">
                        <button id="btnPodKat" name="btnPodKat" class="btn btn-primary w-full">Unesi potkategoriju</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 bg-light">
        <div class="form-group">
            <legend>Unos Akcije: </legend>
            <div class="row ">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label" for="akcija">Unesite naziv akcije: </label>
                        </div>
                        <div class="col-md-8">
                            <input id="akcija" name="akcija" type="text" placeholder="Naziv akcije" class="form-control input-md">
                            <span class="help-block text-danger small" id="akcija-help"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="control-label" for="akcija">Trajanje akcije: </label>
                        </div>
                        <div class="col-md-8">
                            <input id="datumAkcija" name="datumAkcija" type="date" class="form-control input-md">
                            <span class="help-block text-danger small" id="datum-akcije-help"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-end align-items-end h-100">
                        <div class="col-10 align-self-end">
                            <button id="btnAkcija" name="btnAkcija" class="btn btn-primary w-full">Unesi Akciju</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="form-group">
            <legend>Update akcije</legend>
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="row pt-2">
                        <label class="col-md-4 control-label small" for="akcija">Izaberite akciju za update: </label>
                        <div class="col-md-8">
                            <select class="custom-select col-lg-6 w-full" name="ddlAkcija" id="ddlAkcija">
                                <option value="0">Izaberite</option>
                                <?php
                                $upitAkcija = "select * from akcija";
                                $akcije = executeQuery($upitAkcija);
                                foreach ($akcije as $akcija):
                                    ?>
                                    <option value="<?=$akcija->akcija_id?>"><?=$akcija->naziv_akcije?></option>
                                <?php endforeach;?>
                            </select>
                            <span class="help-block text-danger small" id="ddlAkcija-help"></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label class="control-label" for="akcijaUpdate">Naziv akcije: </label>
                        </div>
                        <div class="col-md-8">
                            <input id="akcijaUpdate" name="akcijaUpdate" type="text" placeholder="Naziv akcije" class="form-control input-sm">
                            <span class="help-block text-danger small" id="akcija-update-help"></span>
                        </div>
                    </div>
                    <div class="row p-t-5 ">
                        <div class="col-md-4">
                            <label class="control-label" for="akcija">Trajanje akcije: </label>
                        </div>
                        <div class="col-md-8">
                            <input id="datumAkcijaUpdate" name="datumAkcijaUpdate" type="date" placeholder="Trajanje akcije" class="form-control input-sm">
                            <span class="help-block text-danger small" id="datum-akcije-help-update text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-end align-items-end h-100">
                        <div class="col-10 align-self-end">
                            <button id="btnUpdateAkcija" name="btnUpdateAkcija" class="btn btn-primary w-full">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="ddlAkcijaDel">Obrišite akciju:</label>
                    </div>
                    <div class="col-md-8">
                        <select class="custom-select w-full" name="ddlAkcijaDel" id="ddlAkcijaDel">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitAkcija = "select * from akcija";
                            $akcije = executeQuery($upitAkcija);
                            foreach ($akcije as $akcija):
                                ?>
                                <option value="<?=$akcija->akcija_id?>"><?=$akcija->naziv_akcije?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="help-block text-danger small" id="ddlAkcijaDel-help"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row h-full justify-content-end align-items-end">
                    <div class="col-10">
                        <button id="btnDelAkcija" name="btnDelAkcija" class="btn btn-danger w-full">Obriši</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>