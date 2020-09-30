<?php
define("BASE_URL","index.php");
$upit = $upitBrojLajova = "SELECT *, COUNT(kpl.id_proizvod) AS broj_lajkova FROM korisnik_proizvod_lajk kpl INNER JOIN proizvod p ON kpl.id_proizvod=p.proizvod_id GROUP by p.proizvod_id ORDER BY broj_lajkova DESC";
$lajkovi = executeQuery($upitBrojLajova);
?>
<legend>Tabela lajkovi</legend>
<div class="container">
    <div class="row">
        <?php $br=1; ?>
        <?php if(count($lajkovi)): ?>
            <table class="table table-hover table-bordered table-striped">
                <tr><th>#</th><th>Naziv proizvoda</th><th>Cena</th><th>Lajkova</th></tr>
                <?php foreach($lajkovi as $l):
                    //$id = $u->id;
                    ?>
                <tr id="hide">
                    <td><?= $br++ ?></td>
                    <td><?= $l->naziv ?></td>
                    <td><?= $l->cena ?></td>
                    <td><?= $l->broj_lajkova ?></td>
                </tr>
                <?php endforeach;?>
            </table>
        <?php else: ?>
            <h1>Nema lajkova</h1>
        <?php endif; ?>
    </div>

</div>