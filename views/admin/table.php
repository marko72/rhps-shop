<?php
define("BASE_URL","index.php");
$upit = "select * from korisnik";
$users = $konekcija->query($upit)->fetchAll();
#$users = $konekcija->fatchAll();
#$users = $konekcija->fatchAll();
var_dump($users)



?>
<div class="container">
    <a href="admin.php?page=insert" class="btn-success btn">Dodaj novog</a>
    <div class="row">
        <?php $br=1; ?>
        <?php if(count($users)): ?>
            <table class="table table-hover table-bordered table-striped">
                <tr><th>#</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Uloga</th><th>Izmeni</th><th>Obrisi</th></tr>
                <?php foreach($users as $u):
                    //$id = $u->id;
                    ?>
                <tr id="hide">
                    <td><?= $br++ ?></td>
                    <td><?= $u->ime ?></td>
                    <td><?= $u->prezime ?></td>
                    <td><?= $u->email ?></td>
                    <td><?= $u->naziv ?></td>
                    <td>
                        <a href="<?=BASE_URL?>?page=registracija&id=<?= $u->korisnik_id ?>" class="btn btn-primary btn-xs">Izmeni</a>
                    </td>
                    <td><a href="" class="btn btn-danger btn-xs del"  data-id="<?=$u->korisnik_id?>">Obrisi</a></td>
                </tr>
                <?php endforeach;?>
            </table>
        <?php else: ?>
            <h1>Nema zapisa</h1>
        <?php endif; ?>
    </div>

</div>