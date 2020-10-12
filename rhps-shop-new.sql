-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 02:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radnja_rhps`
--

-- --------------------------------------------------------

--
-- Table structure for table `akcija`
--

CREATE TABLE `akcija` (
  `akcija_id` int(10) NOT NULL,
  `trajanje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `naziv_akcije` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akcija_proizvod`
--

CREATE TABLE `akcija_proizvod` (
  `akcija_proizvod_id` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `id_akcija` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boja`
--

CREATE TABLE `boja` (
  `boja_id` int(10) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boja`
--

INSERT INTO `boja` (`boja_id`, `naziv`) VALUES
(1, 'Crvena'),
(2, 'Plava');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorija_id` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorija_id`, `naziv`, `class`, `slika`) VALUES
(1, 'Muškarci', 'muskarci', 'kat_muskarci.jpg'),
(2, 'Žene', 'zene', 'kat_zene.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_potkategorija`
--

CREATE TABLE `kategorija_potkategorija` (
  `id_kat_potkat` int(10) NOT NULL,
  `id_kat` int(10) NOT NULL,
  `id_potkat` int(10) NOT NULL,
  `slika` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija_potkategorija`
--

INSERT INTO `kategorija_potkategorija` (`id_kat_potkat`, `id_kat`, `id_potkat`, `slika`) VALUES
(4, 1, 4, 'podkat_pantalone.jpg'),
(5, 2, 5, 'podkat_suknje.jpg'),
(6, 1, 6, 'podkat_kosulje_m.jpg'),
(7, 2, 7, 'podkat_kosulje_z.jpg'),
(10, 1, 9, 'podkat_kravate.jpg'),
(11, 1, 10, 'podkat_prsluci.jpg'),
(12, 2, 11, 'podkat_haljine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(10) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `datum_registracije` timestamp NOT NULL DEFAULT current_timestamp(),
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_uloga` int(10) NOT NULL,
  `id_pol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `email`, `datum_registracije`, `slika`, `lozinka`, `token`, `id_uloga`, `id_pol`) VALUES
(2, 'Markor', 'Radivojevic', 'mradivojevic37@gmail.com', '2020-09-14 04:23:34', '', '1164f9e5b8cef768396dcd5374e4b6eb', 'c315997493d4efe61ef0480bef7b814da4cacd15', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_kupon`
--

CREATE TABLE `korisnik_kupon` (
  `id_kor_kup` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_kupon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_proizvod_lajk`
--

CREATE TABLE `korisnik_proizvod_lajk` (
  `id_korisnika` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `korpa_id` int(10) NOT NULL,
  `kupon` tinyint(1) NOT NULL,
  `otkazano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpa_stavka`
--

CREATE TABLE `korpa_stavka` (
  `korpa_stavka_id` int(10) NOT NULL,
  `id_korpa` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `korisnik_id` int(10) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `otkazano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kupon`
--

CREATE TABLE `kupon` (
  `kupon_id` int(10) NOT NULL,
  `trajanje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `naziv_kupona` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pol`
--

CREATE TABLE `pol` (
  `pol_id` int(10) NOT NULL,
  `naziv` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pol`
--

INSERT INTO `pol` (`pol_id`, `naziv`) VALUES
(1, 'Muški'),
(2, 'Ženski');

-- --------------------------------------------------------

--
-- Table structure for table `potkategorija`
--

CREATE TABLE `potkategorija` (
  `potkat_id` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `potkategorija`
--

INSERT INTO `potkategorija` (`potkat_id`, `naziv`, `class`) VALUES
(4, 'Pantalone', 'muskarci'),
(5, 'Suknje', 'zene'),
(6, 'Košulje', 'muskarci'),
(7, 'Košulje', 'zene'),
(8, 'Potkat1', ''),
(9, 'Kravate', ''),
(10, 'Prsluci', ''),
(11, 'Haljine', '');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `proizvod_id` int(10) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `stanje` int(5) NOT NULL,
  `novo` tinyint(1) NOT NULL,
  `id_kat_potkat` int(10) NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `id_pro_boj` int(10) NOT NULL,
  `id_akc_pro` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`proizvod_id`, `naziv`, `cena`, `stanje`, `novo`, `id_kat_potkat`, `opis`, `id_pro_boj`, `id_akc_pro`) VALUES
(4, '1990S FOLIAGE HAWAIIAN SHIRT - M', '15', 6, 1, 4, '1990s foliage hawaiian shirt. Comes in multi-colour with one pocket.', 0, 0),
(5, 'REWORKED NATE SHORT SLEEVE SHIRT WITH ZIP - L', '11', 7, 1, 6, 'Beyond Retro Label reworked nate short sleeve shirt with zip in light brown with outer pocket.\r\n\r\nAt Beyond Retro Label, all of our products are made from handpicked recycled clothing. This means each shirt is not only unique, but has also saved a top from going to landfill.', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod_boja`
--

CREATE TABLE `proizvod_boja` (
  `proizvod_boja_id` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `id_boja` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proizvod_velicina`
--

CREATE TABLE `proizvod_velicina` (
  `proizvod_velicna_id` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `id_velicina` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slika_proizvod`
--

CREATE TABLE `slika_proizvod` (
  `slika_id` int(10) NOT NULL,
  `id_proizvod` int(10) NOT NULL,
  `putanja` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika_proizvod`
--

INSERT INTO `slika_proizvod` (`slika_id`, `id_proizvod`, `putanja`) VALUES
(7, 4, 'images/proizvodi/1602503481foliage-hawaiian-shirt-1.jpg'),
(8, 4, 'images/proizvodi/1602503481foliage-hawaiian-shirt-1.jpg'),
(9, 5, 'images/proizvodi/1602502192reworked-nate-short-sleeve-shirt-with-zip-1.jpg'),
(10, 5, 'images/proizvodi/1602502192reworked-nate-short-sleeve-shirt-with-zip-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv`) VALUES
(1, 'korisnik'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `velicina`
--

CREATE TABLE `velicina` (
  `velicina_id` int(10) NOT NULL,
  `velicina` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velicina`
--

INSERT INTO `velicina` (`velicina_id`, `velicina`) VALUES
(1, 'Novo'),
(2, 'Polovno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akcija`
--
ALTER TABLE `akcija`
  ADD PRIMARY KEY (`akcija_id`);

--
-- Indexes for table `akcija_proizvod`
--
ALTER TABLE `akcija_proizvod`
  ADD PRIMARY KEY (`akcija_proizvod_id`),
  ADD KEY `id_proizvod` (`id_proizvod`),
  ADD KEY `id_akcija` (`id_akcija`);

--
-- Indexes for table `boja`
--
ALTER TABLE `boja`
  ADD PRIMARY KEY (`boja_id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorija_id`);

--
-- Indexes for table `kategorija_potkategorija`
--
ALTER TABLE `kategorija_potkategorija`
  ADD PRIMARY KEY (`id_kat_potkat`),
  ADD KEY `id_kat` (`id_kat`),
  ADD KEY `id_potkat` (`id_potkat`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_uloga` (`id_uloga`),
  ADD KEY `id_post` (`id_pol`);

--
-- Indexes for table `korisnik_kupon`
--
ALTER TABLE `korisnik_kupon`
  ADD PRIMARY KEY (`id_kor_kup`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_kupon` (`id_kupon`);

--
-- Indexes for table `korisnik_proizvod_lajk`
--
ALTER TABLE `korisnik_proizvod_lajk`
  ADD PRIMARY KEY (`id_korisnika`,`id_proizvod`),
  ADD KEY `id_korisnika` (`id_korisnika`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`korpa_id`);

--
-- Indexes for table `korpa_stavka`
--
ALTER TABLE `korpa_stavka`
  ADD PRIMARY KEY (`korpa_stavka_id`),
  ADD KEY `id_korpa` (`id_korpa`),
  ADD KEY `id_proizvod` (`id_proizvod`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `kupon`
--
ALTER TABLE `kupon`
  ADD PRIMARY KEY (`kupon_id`);

--
-- Indexes for table `pol`
--
ALTER TABLE `pol`
  ADD PRIMARY KEY (`pol_id`);

--
-- Indexes for table `potkategorija`
--
ALTER TABLE `potkategorija`
  ADD PRIMARY KEY (`potkat_id`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`proizvod_id`),
  ADD KEY `id_kat_potkat` (`id_kat_potkat`),
  ADD KEY `id_pro_boj` (`id_pro_boj`),
  ADD KEY `id_akc_pro` (`id_akc_pro`);

--
-- Indexes for table `proizvod_boja`
--
ALTER TABLE `proizvod_boja`
  ADD PRIMARY KEY (`proizvod_boja_id`),
  ADD KEY `id_proizvod` (`id_proizvod`),
  ADD KEY `id_boja` (`id_boja`);

--
-- Indexes for table `proizvod_velicina`
--
ALTER TABLE `proizvod_velicina`
  ADD PRIMARY KEY (`proizvod_velicna_id`),
  ADD KEY `id_proizvod` (`id_proizvod`),
  ADD KEY `id_velicina` (`id_velicina`);

--
-- Indexes for table `slika_proizvod`
--
ALTER TABLE `slika_proizvod`
  ADD PRIMARY KEY (`slika_id`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `velicina`
--
ALTER TABLE `velicina`
  ADD PRIMARY KEY (`velicina_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akcija`
--
ALTER TABLE `akcija`
  MODIFY `akcija_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akcija_proizvod`
--
ALTER TABLE `akcija_proizvod`
  MODIFY `akcija_proizvod_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boja`
--
ALTER TABLE `boja`
  MODIFY `boja_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorija_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorija_potkategorija`
--
ALTER TABLE `kategorija_potkategorija`
  MODIFY `id_kat_potkat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik_kupon`
--
ALTER TABLE `korisnik_kupon`
  MODIFY `id_kor_kup` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `korpa_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korpa_stavka`
--
ALTER TABLE `korpa_stavka`
  MODIFY `korpa_stavka_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kupon`
--
ALTER TABLE `kupon`
  MODIFY `kupon_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pol`
--
ALTER TABLE `pol`
  MODIFY `pol_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `potkategorija`
--
ALTER TABLE `potkategorija`
  MODIFY `potkat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `proizvod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proizvod_boja`
--
ALTER TABLE `proizvod_boja`
  MODIFY `proizvod_boja_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proizvod_velicina`
--
ALTER TABLE `proizvod_velicina`
  MODIFY `proizvod_velicna_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slika_proizvod`
--
ALTER TABLE `slika_proizvod`
  MODIFY `slika_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `velicina`
--
ALTER TABLE `velicina`
  MODIFY `velicina_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akcija_proizvod`
--
ALTER TABLE `akcija_proizvod`
  ADD CONSTRAINT `akcija_proizvod_ibfk_1` FOREIGN KEY (`id_akcija`) REFERENCES `akcija` (`akcija_id`),
  ADD CONSTRAINT `akcija_proizvod_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`);

--
-- Constraints for table `kategorija_potkategorija`
--
ALTER TABLE `kategorija_potkategorija`
  ADD CONSTRAINT `kategorija_potkategorija_ibfk_1` FOREIGN KEY (`id_kat`) REFERENCES `kategorija` (`kategorija_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategorija_potkategorija_ibfk_2` FOREIGN KEY (`id_potkat`) REFERENCES `potkategorija` (`potkat_id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`uloga_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_ibfk_2` FOREIGN KEY (`id_pol`) REFERENCES `pol` (`pol_id`) ON UPDATE CASCADE;

--
-- Constraints for table `korisnik_kupon`
--
ALTER TABLE `korisnik_kupon`
  ADD CONSTRAINT `korisnik_kupon_ibfk_1` FOREIGN KEY (`id_kupon`) REFERENCES `kupon` (`kupon_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `korisnik_kupon_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `korisnik_proizvod_lajk`
--
ALTER TABLE `korisnik_proizvod_lajk`
  ADD CONSTRAINT `korisnik_proizvod_lajk_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_proizvod_lajk_ibfk_2` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `korpa_stavka`
--
ALTER TABLE `korpa_stavka`
  ADD CONSTRAINT `korpa_stavka_ibfk_1` FOREIGN KEY (`id_korpa`) REFERENCES `korpa` (`korpa_id`),
  ADD CONSTRAINT `korpa_stavka_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `korpa_stavka_ibfk_3` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_ibfk_1` FOREIGN KEY (`id_kat_potkat`) REFERENCES `kategorija_potkategorija` (`id_kat_potkat`);

--
-- Constraints for table `proizvod_boja`
--
ALTER TABLE `proizvod_boja`
  ADD CONSTRAINT `proizvod_boja_ibfk_1` FOREIGN KEY (`id_boja`) REFERENCES `boja` (`boja_id`),
  ADD CONSTRAINT `proizvod_boja_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`);

--
-- Constraints for table `proizvod_velicina`
--
ALTER TABLE `proizvod_velicina`
  ADD CONSTRAINT `proizvod_velicina_ibfk_1` FOREIGN KEY (`id_velicina`) REFERENCES `velicina` (`velicina_id`),
  ADD CONSTRAINT `proizvod_velicina_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`);

--
-- Constraints for table `slika_proizvod`
--
ALTER TABLE `slika_proizvod`
  ADD CONSTRAINT `slika_proizvod_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
