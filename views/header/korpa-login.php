
<?php if(isset($_SESSION['korisnik'])){
    $korisnik = $_SESSION['korisnik'];
}?>
<div class="header-icons">
    <!-- Ikonica kupca -->
    <div class="header-wrapcon2">
        <img src="<?php #$korisnik?$korisnik->slika:?>images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <div class="header-cart header-dropdown">
            <?php
            if(isset($_SESSION['korisnik'])):
            $korisnik = $_SESSION['korisnik'];
            ?>
                <a href="modules/logout.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Odjava
                </a>
                <a href="index.php?page=registracija" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Izmena
                </a>
                <a href="index.php??page=slika&id=<?=$korisnik->korisnik_id?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    <?=($korisnik->slika=="")?"Postavi sliku":"Izmeni sliku"?>
                </a>
            <?php else:?>
            <form action="modules/login.php" method="post">
                <ul class="header-cart-wrapitem">
                    <li class="header-cart-item">
                        <table>
                            <tr>
                                <td>
                                    <label for="email">Email: &nbsp&nbsp&nbsp</label>
                                </td>
                                <td>
                                    <input type="text" name="email" placeholder="Unesite email">
                                </td>
                            </tr>
                        </table>
                    </li>

                    <li class="header-cart-item">
                        <table>
                            <tr>
                                <td>
                                    <label for="passwd">Lozinka: &nbsp&nbsp&nbsp</label>
                                </td>
                                <td>
                                    <input type="password" name="passwd" placeholder="Unesite lozinku">
                                </td>
                            </tr>
                        </table>
                    </li>

                </ul>
                <input type="submit" name="btnLogin" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" value="Prijava">
            </form>
            <div class=" column-1">
                    <!-- Button -->

                <!-- Button -->



                <a href="<?=$_SERVER['PHP_SELF']?>?page=registracija" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Registracija
                </a>
            </div>

            <?php endif;
            if (isset($_SESSION['greska'])):?>
            <span class="help-block greske">

                <?php
                if(is_array($_SESSION['greska'])){
                    foreach($_SESSION['greska'] as $greska){
                        echo $greska;
                    }
                }
                else {
                    echo $_SESSION['greska'];
                }
                unset($_SESSION['greska'])
                ?></span>
            <?php endif;?>
        </div>
    </div>


    <span class="linedivide1"></span>
    <?php if(isset($_SESSION['korisnik'])):?>
    <!-- Ikonica korpa -->
    <div class="header-wrapicon2">
        <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <span class="header-icons-noti">7</span>

        <!-- Header cart noti -->
        <div class="header-cart header-dropdown">
            <ul class="header-cart-wrapitem">
                <li class="header-cart-item">
                    <div class="header-cart-item-img">
                        <img src="images/item-cart-01.jpg" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt">
                        <a href="#" class="header-cart-item-name">
                            White Shirt With Pleat Detail Back
                        </a>

                        <span class="header-cart-item-info">
											1 x $19.00
                        </span>
                    </div>
                </li>
            </ul>

            <div class="header-cart-total">
                Total: $75.00
            </div>

            <div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        Pregledaj korpu
                    </a>
                </div>

                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        Odjavi korpu
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
</div>
</div>
</header>