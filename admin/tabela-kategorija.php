
<?php
define("BASE_URL","index.php");

?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row justify-content-end">
                <div class="col-4 align-self-end">
                    <select name="ddlKategorije" id="ddlKategorije" class="w-full form-control">
                        <option value="0">Izaberite kategoriju</option>
                        <?php
                            foreach ($kategorije as $kat):
                        ?>
                                <option value="<?=$kat->kategorija_id?>"><?=$kat->naziv?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mb-4">
                    <h2 class="h3 ">Potkategorije</h2>
                </div>
                <div class="col-md-10">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Pol</th>
                                <th>Kategorija</th>
                                <th>Obrisi</th>
                            </tr>
                        </thead>
                        <tbody id="tBodyPotkategorije">
                        <tr>
                            <td colspan="4">Izbaerite kategoriju za koju zelite prikazati kategorije</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-gorup bg-light p-4 rounded mb-4">
        <div class="row justify-content-around align-items-baselinene">
            <div class="col-md-3">
                <label for="potkatName">Naziv potkategorije: </label>
            </div>
            <div class="col-md-5">
                <input type="text" name="tbPotkatName" id="potkatName" placeholder="Unesite naziv.." class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-full" id="btnUnesiPotkat">Unesi</button>
            </div>
        </div>
    </div>
    <div class="form-gorup bg-light p-4 rounded mb-4">
        <div class="row justify-content-around align-items-baselinene">
            <div class="col-md-3">
                <label for="potkatName">Naziv potkategorije: </label>
            </div>
            <div class="col-md-5">
                <input type="text" name="tbPotkatName" id="potkatName" placeholder="Unesite naziv.." class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-full" id="btnUnesiPotkat">Unesi</button>
            </div>
        </div>
    </div>
    <div class="form-gorup bg-light p-4 rounded mb-4">
        <div class="row justify-content-around align-items-baselinene">
            <div class="col-md-5">
                <select name="ddlKategorije" id="ddlKategorijePotkat" class="w-full form-control">
                    <option value="0">Izaberite kategoriju</option>
                    <?php
                        foreach ($kategorije as $kat):
                    ?>
                        <option value="<?=$kat->kategorija_id?>"><?=$kat->naziv?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </div>
            <div class="col-md-5">
                <select name="ddlPotkategorije" id="ddlPotkat" class="w-full form-control">
                    <option value="0">Izaberite potkategoriju</option>
                    <?php
                        $potkategorije = executeQuery("SELECT * FROM potkategorija");
                        foreach ($potkategorije as $potkat):
                    ?>
                        <option value="<?=$potkat->potkat_id?>"><?=$potkat->naziv?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-full" id="btnKatPotkat">Unesi</button>
            </div>
        </div>
    </div>
</div>