<div class="wrap_menu">
    <nav class="menu">
        <ul class="main_menu">
            <li>
                <a href="index.php?page=index">Početna</a>
            </li>

            <li>
                <a href="index.php?page=products&pg=1">Prodavnica</a>
            </li>
            <?php if(isset($_SESSION['korisnik'])):?>
            <li>
                <a href="index.php?page=korpa">Korpa</a>
            </li>
            <?php endif;?>
            <li>
                <a href="index.php?page=blog">Novosti</a>
            </li>

            <li>
                <a href="index.php?page=about">O nama</a>
            </li>

            <li>
                <a href="index.php?page=contact">Kontakt</a>
            </li>
            <?php
                if(isset($_SESSION['korisnik'])){
                    if($_SESSION['korisnik']->uloga_id==2):?>
                        <li>
                            <a href="admin.php?admin=user">Admin</a>
                            <ul class="sub_menu">
                                <li><a href="admin.php?admin=user">Svi korisnici</a></li>
                                <li><a href="admin.php?admin=products">Svi proizvodi</a></li>
                                <li><a href="admin.php?admin=unos">Unos proizvoda</a></li>
                                <li><a href="admin.php?admin=ostalo">Unos/update ostalo</a></li>
                                <li><a href="admin.php?admin=tabela-kategorija">Kategorije</a></li>
                                <li><a href="admin.php?admin=tabela-ostalo">Lajkovi/Ankete rezultati</a></li>
                            </ul>
                        </li>
                    <?php endif;

                }
            ?>
        </ul>
    </nav>
</div>