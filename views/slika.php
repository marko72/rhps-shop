<!------ Include the above in your HEAD tag ---------->
<?php if(isset($_SESSION['korisnik'])) {
    $korisnik = $_SESSION['korisnik'];
}?>
<div class="container">
    <div class="form-row-lg">
        <form class="form-horizontal">
            <fieldset>
                    <legend>Upload slike korisnika</legend>

                <?php if($korisnik):?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="confirmasipassword">Postavite sliku profila:</label>
                        <div class="col-lg-6">
                            <input id="slika" name="slika" type="file" class="form-control flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" >
                            <span class="help-block slika-help">OPCIONO!</span>
                        </div>
                    </div>
                <?php endif;?>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirmation"></label>
                    <div class="col-md-4">
                        <button id="btnSlika" name="btnSlika" class="btn btn-primary">Postavi sliku</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>