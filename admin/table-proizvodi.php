<?php
define("BASE_URL","index.php");
?>
<div class="container">
    <a href="admin.php?admin=unos" class="btn-success btn">Dodaj novog</a>
    <div class="row">
        <?php $br=1; ?>
        <?php if(count($sviProizvodi)): ?>
            <table class="table table-hover table-bordered table-striped" id="tabelaProizvodi">
                <tr><th>#</th><th>Naziv</th><th>Cena</th><th>Stanje</th><th>Novo</th><th>Slika</th><th>Izmeni</th><th>Obrisi</th></tr>
                <?php foreach($sviProizvodi as $p):
                    //$id = $u->id;
                    ?>
                    <tr id="hide" >
                        <td><?= $br++ ?></td>
                        <td><?= $p->naziv ?></td>
                        <td><?= $p->cena ?></td>
                        <td><?= $p->stanje ?></td>
                        <td><?= $p->novo ?></td>
                        <td class="oblik"><img src="<?= $p->putanja?>" alt="<?= strtolower($p->opis) ?>" class="img-fluid"></td>
                        <td>
                            <a href="admin.php?admin=unos&id=<?= $p->proizvod_id?>" class="btn btn-primary btn-xs">Izmeni</a>
                        </td>
                        <td><a class="btn btn-danger btn-xs del btnObrisi"  data-id="<?=$p->proizvod_id?>" name="btnObrisi">Obrisi</a></td>
                    </tr>
                <?php endforeach;?>
            </table>
        <?php else: ?>
            <h1>Nema zapisa</h1>
        <?php endif; ?>
    </div>

</div>