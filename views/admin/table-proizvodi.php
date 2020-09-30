<?php
define("BASE_URL","index.php");

var_dump($sviProizvodi)



?>
<div class="container">
    <a href="admin.php?page=insert" class="btn-success btn">Dodaj novog</a>
    <div class="row">
        <?php $br=1; ?>
        <?php if(count($sviProizvodi)): ?>
            <table class="table table-hover table-bordered table-striped">
                <tr><th>#</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Username</th><th>Uloga</th><th>Izmeni</th><th>Obrisi</th></tr>
                <?php foreach($sviProizvodi as $p):
                    //$id = $u->id;
                    ?>
                    <tr id="hide" >
                        <td><?= $br++ ?></td>
                        <td><?= $p->naziv ?></td>
                        <td><?= $p->cena ?></td>
                        <td><?= $p->stanje ?></td>
                        <td><?= $p->novo ?></td>
                        <td class="oblik"><img src="<?= $p->putanja?>" alt="<?= strtolower($p->opis) ?>"></td>
                        <td>
                            <a href="<?=BASE_URL?>?page=registracija&id=<?= $p->korisnik_id ?>" class="btn btn-primary btn-xs">Izmeni</a>
                        </td>
                        <td><a href="" class="btn btn-danger btn-xs del"  data-id="<?=$p->korisnik_id?>">Obrisi</a></td>
                    </tr>
                <?php endforeach;?>
            </table>
        <?php else: ?>
            <h1>Nema zapisa</h1>
        <?php endif; ?>
    </div>

</div>