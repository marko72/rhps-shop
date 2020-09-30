<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                Budite u toku
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    Imate pitanje? Kontaktirajte nas na telefon 062/222/222
                </p>

                <div class="flex-m p-t-30">
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                </div>
            </div>
        </div>
        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Kategorije
            </h4>
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
                    </li>
                <?php endforeach;?>
                <?php
                $dohvatiPotategorije = "SELECT * FROM potkategorija LIMIT 0,4";
                $potkategorije = executeQuery($dohvatiPotategorije);
                foreach ($potkategorije as $p):
                    ?>
                    <li class="p-t-4 kat">
                        <a href="<?=$_SERVER['PHP_SELF']?>?page=products&podkat=<?=$p->podkat_id?>" class="s-text13">
                            <?=$p->naziv?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Linkovi
            </h4>

            <ul>

                <li class="p-b-9">
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=about" class="s-text7">
                        O nama
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=contact" class="s-text7">
                        Kontaktirajte nas
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="../dokumentacija.pdf" class="s-text7">
                        Dokumentacija
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="<?=$_SERVER['PHP_SELF']?>?page=autor" class="s-text7">
                        Autor
                    </a>
                </li>
            </ul>
        </div>
        <div class="t-center p-l-15 p-r-15">
            <a href="#">
                <img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
            </a>

            <a href="#">
                <img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
            </a>

            <div class="t-center s-text8 p-t-20">
                Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            </div>
        </div>
    </div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>