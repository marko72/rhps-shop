<!------ Include the above in your HEAD tag ---------->
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $dohvatiKorisnika = "SELECT * FROM korisnik where korisnik_id = :id";
    $priprema = $konekcija->prepare($dohvatiKorisnika);
    $priprema->bindParam(":id",$id);
    try{
        $dali = $priprema->execute();
        if($dali){
            $korisnik = $priprema->fetch();
        }
        else{
            echo "Korisnik ne postoji";
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}?>
<div class="container">
    <div class="form-row-lg">
        <form class="form-horizontal">
            <fieldset>

                <!-- Form Name -->
                <?php if(isset($korisnik)):?>
                <legend>Forma za izmenu korisnika</legend>
                <?php else:?>
                <legend>Registraciona Forma</legend>
                <?php endif;?>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="lastname">Prezime</label>
                    <div class="col-lg-6">
                        <input id="prezime" name="prezime" type="text" placeholder="Vase prezime" class="form-control input-md" required="" <?php if(isset($korisnik)){echo 'value="'.$korisnik->prezime.'"';}?>>
                        <span class="help-block prezime-help"></span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstname">Ime</label>
                    <div class="col-lg-6">
                        <input id="ime" name="ime" type="text" placeholder="Vase ime" class="form-control input-md" required=""<?php if(isset($korisnik)){echo 'value="'.$korisnik->ime.'"';}?>>
                        <span class="help-block ime-help"></span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email</label>
                    <div class="col-lg-6">
                        <input id="email" name="email" type="text" placeholder="Your email here" class="form-control input-md" required=""<?php if(isset($korisnik)){echo 'value="'.$korisnik->email.'"';}?>>
                        <span class="help-block email-help">email@email.com</span>
                    </div>
                </div>


                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password"><?php if(isset($korisnik)){echo 'Nova Lozinka';}else{echo "Lozinka";}?> </label>
                    <div class="col-lg-6">
                        <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirmasipassword">Potvrdite Lozinku</label>
                    <div class="col-lg-6">
                        <input id="confPass" name="confPass" type="password" placeholder="Confirmation password" class="form-control input-md" required="">
                        <span class="help-block passwd-help"></span>
                    </div>
                </div>

                <!-- Multiple Radios (inline) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="gender">Pol</label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="gender-0">
                            <input type="radio" name="pol" id="gender-0" value="m" checked="checked">
                            Muski
                        </label>
                        <label class="radio-inline" for="gender-1">
                            <input type="radio" name="pol" id="gender-1" value="z">
                            Zenski
                        </label>
                    </div>
                </div>
                <?php if(isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->naziv='administrator'&&isset($_GET['id'])):?>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="ddlUloga">Izaberite ulogu: </label>
                    <div class="col-lg-6">
                        <select class="custom-select col-lg-6" name="ddlUloga" id="ddlUloga">
                            <option value="0">Izaberite</option>
                            <?php
                            $upitUloge = "select * from uloga";
                            $uloge = executeQuery($upitUloge);
                            foreach ($uloge as $uloga):
                                ?>
                                <option value="<?=$uloga->uloga_id?>"><?=$uloga->naziv?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="kategorija">Aktivan: </label>
                        <div class="col-lg-6">
                            <input type="checkbox" class="custom-checkbox col-lg-6" name="aktivan" id="aktivan">
                        </div>
                    </div>
                <?php endif;?>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirmation"></label>
                    <div class="col-md-4">
                        <?php if((isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->naziv='administrator')&&isset($_GET['id'])):?>
                            <input type="hidden" id="korisnikID" value="<?=$_GET['id']?>">
                        <button id="btnUnosAdmin" name="btnUnosAdmin" class="btn btn-primary">Admin izvrsi izmenu</button>
                        <?php else: if(isset($_SESSION['korisnik'])):?>
                            <button id="btnIzmena" name="btnIzmena" class="btn btn-primary">Izvrsi izmenu</button>
                            <input type="hidden" id="korisnikID" value="<?=$_SESSION['korisnik']->korisnik_id?>">
                        <?php else:?>
                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Registruj se</button>
                        <?php endif; endif;?>
                    </div>
                </div>

            </fieldset>
        </form>
        <span class="help-block" id="poruka"></span>
    </div>
</div>