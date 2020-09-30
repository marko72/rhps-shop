<?php
//DOHVATANJE KATEGORIJE NA OSNOVU NAZIVA NJENIH PODKATEGORIJA
$upit = "SELECT kp.id_kat_podkat FROM kategorija_podkategorija kp INNER JOIN podkategorija p on kp.id_podkat = p.podkat_id INNER JOIN kategorija k ON kp.id_kat = k.kategorija_id
WHERE k.naziv = 'Muški' AND p.naziv='Pantalone'";
$upitDohvatiProizvode ="SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id = sp.id_proizvod GROUP BY p.proizvod_id LIMIT 0,12 ";
$upitDohvatiLajkove = "SELECT * FROM proizvod p INNER JOIN slika_proizvod sp ON p.proizvod_id = sp.id_proizvod INNER JOIN korisnik_proizvod_lajk kpl ON p.proizvod_id=kpl.id_proizvod INNER JOIN korisnik k ON k.korisnik_id= kpl.id_korisnika WHERE k.korisnik_id = 1 OR 1=1 GROUP BY p.proizvod_id LIMIT 0,12";
