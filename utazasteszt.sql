-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2025 at 08:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utazasteszt`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `category` enum('accommodation','transport','food','activity','other') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `dest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price_huf` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `detail_url` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_global` tinyint(1) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `ar` int(11) NOT NULL,
  `leiras` text NOT NULL,
  `foglallimit` int(11) NOT NULL,
  `evszak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `slug`, `title`, `price_huf`, `start_date`, `end_date`, `image_path`, `detail_url`, `name`, `country`, `description`, `is_global`, `user_id`, `ar`, `leiras`, `foglallimit`, `evszak`) VALUES
(4, 'trip-olasz', 'Észak-Olaszországi körút', 156000, '2026-06-20', '2026-06-26', '/oldal/images/italy.jpg', '/trip-olasz', 'Észak-Olaszországi körút', NULL, NULL, 0, NULL, 156000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n            <p><b>Észak-Olaszországi körutazás – 6 nap / 5 éjszaka</b>\n\n            Verona – Garda-tó – Sirmione – Milánó – Comói-tó – Bergamo – Velence\n            Autóbuszos utazás – 50 fős csoport számára</p><hr>\n\n            <p>1. nap: Indulás – Verona – Garda-tó<br> Indulás: Kora reggeli órákban indulás Magyarországról (pl. Budapest vagy Győr), pihenőkkel útközben. <br>Érkezés Veronába: Kora délután, városnézés helyi idegenvezetővel:\n                <ul>\n                    <li>Aréna di Verona – a híres római amfiteátrum</li>\n                    <li>Julietta háza – a híres erkély</li>\n                    <li>Piazza delle Erbe, Piazza dei Signori</li>\n                    <li>Továbbutazás a Garda-tóhoz, szállás elfoglalása a tó közelében (pl. Peschiera del Garda vagy Desenzano).</li>\n                    <li>Vacsora, szállás a Garda-tónál.</li>\n\n                </ul>\n\n            </p><hr>\n\n            <p>2. nap: Garda-tó – Sirmione – Bergamo<br>\n\n            Délelőtt: Látogatás Sirmionéba, a Garda-tó ékszerdobozába:<br>\n            <ul>\n                <li>Scaligeri vár, séta az óvárosban</li>\n                <li>Fakultatív hajókirándulás a Garda-tavon (kb. 30-45 perc)</li>\n                <li>Délután: Továbbutazás Bergamóba</li>\n                <li>Siklóval fel a Felsővárosba (Città Alta)</li>\n                <li>Piazza Vecchia, Santa Maria Maggiore-bazilika, Colleoni kápolna</li>\n            </ul>\n\n            Este: Szállás Bergamo vagy környékén, vacsora.</p><hr>\n\n            <p>3. nap: Milánó – a divat és kultúra fővárosa<br>\n\n            Egész napos kirándulás Milánóba, városnézés:<br>\n            <ul>\n                <li>Milánói dóm, a világ egyik legnagyobb katedrálisa</li>\n                <li>Galleria Vittorio Emanuele II</li>\n                <li>La Scala operaház</li>\n                <li>Fotószünet a Castello Sforzesco előtt</li>\n                <li>Szabadidő vásárlásra vagy egyéni felfedezésre.</li>\n            </ul>\n            Visszautazás a szállásra, vacsora.</p><hr>\n\n\n            <p><b>4. nap:</b> Comói-tó – Tremezzo – Bellagio (fakultatív hajókirándulás)<br>\n\n            Kirándulás a festői Comói-tóhoz:<br>\n            <ul>\n                <li>Látogatás Como városába – Dóm, tóparti sétány</li>\n                <li>Fakultatív hajókirándulás a tavon: Tremezzo (Villa Carlotta) és Bellagio – a tó gyöngyszeme</li>\n                <li>Visszatérés a szállásra a kora esti órákban.</li>\n            </ul>\n            Vacsora, szállás.</p><hr>\n\n            <p>5. nap: Velence – a lagúnák városa<br>\n\n            Kora reggeli indulás Velencébe, átszállás hajóra Punta Sabbioni kikötőjében.<br>\n            Városnézés Velencében:<br>\n            <ul>\n                <li>Szent Márk tér, Bazilika, Dózse-palota, Campanile</li>\n                <li>Rialto-híd, Canale Grande</li>\n                <li>Szabadidő, vásárlási lehetőség, kávézás a híres kávézókban.</li>\n                <li>Késő délután visszatérés a kikötőbe, utazás a szállásra Velence környékén (pl. Mestre vagy Lido di Jesolo).</li>\n                <li>Vacsora, szállás.</li>\n            </ul>\n\n            </p><hr>\n\n            <p>6. nap: Hazautazás – Udine vagy Grado (megálló útközben)<br>\n\n            Reggeli után indulás Magyarország felé.<br>\n            <ul>\n                <li>Útközbeni rövid megálló Udine vagy a tengerparti Grado városában, pihenő, szabadprogram.</li>\n                <li>Érkezés Magyarországra az esti órákban.</li>\n            </ul>\n            </p><hr>\n\n            <p>Részvételi díj tartalmazza:<br>\n            <ul>\n                <li>Kényelmes, légkondicionált, 50 fős autóbusz bérleti díját</li>\n                <li>5 éjszaka szállást 3*-os szállodákban, reggelivel és vacsorával</li>\n                <li>Helyi idegenvezetést Veronában, Milánóban és Velencében</li>\n                <li>Útlemondási biztosítás</li>\n                <li>Magyar nyelvű csoportkísérőt</li>\n            </ul>\n            </p><hr>\n\n            <p>Fakultatív programok (külön fizetendők):<br>\n            <ul>\n                <li>Hajókirándulás Sirmionéban (kb. 15 EUR)</li>\n                <li>Comói-tavi hajózás Bellagio és Tremezzo között (kb. 25–30 EUR)</li>\n                <li>Belépők: Velencei Dózse-palota, Milánói dóm kupolája stb. (összesen kb. 40–60 EUR)</li>\n            </ul>\n            </p><hr>\n            <p>Ár: 156.000 Ft / fő</p><hr>\n\n\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/olaszo.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 25, 3),
(5, 'trip-mallorca', 'Mallorca', 190000, '2026-04-03', '2026-04-08', '/oldal/images/mallorca2.jpg', '/trip-mallorca', 'Mallorca', NULL, NULL, 0, NULL, 190000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n          <p><b>Mallorcai csoportosutazás – 5 nap / 4 éjszaka</b><hr>\n\n            <p>1. nap: Érkezés és ismerkedés<br>\n                <ul>\n                    <li>Indulás Budapestről közvetlen járattal Mallorca repülőterére.</li>\n                    <li>Transzfer a szállodába (4 csillagos, tengerparti elhelyezkedésű).</li>\n                    <li>Szállás elfoglalása, rövid pihenő.</li>\n                    <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li>\n                    <li>Rövid tájékoztató a programról és Mallorcáról.</li>\n\n                </ul>\n            </p><hr>\n\n            <p>2. nap: Palma városnézés és kultúra<br>\n\n                <ul>\n\n                    <li>Reggeli a szállodában.</li>\n                    <li>Egész napos városnézés Palma de Mallorca történelmi belvárosában:</li>\n                    <li>La Seu katedrális megtekintése.</li>\n                    <li>Királyi palota (Palau de l’Almudaina) látogatása.</li>\n                    <li>Hangulatos piac és bevásárlóutca felfedezése.</li>\n                    <li>Szabadprogram és ebéd egy helyi étteremben (opcionális).</li>\n                    <li>Délután visszautazás a szállodába, pihenés.</li>\n                    <li>Esti fakultatív program: tengeri naplemente hajókirándulás (külön díj ellenében).</li>\n                </ul>\n            </p><hr>\n\n            <p>3. nap: Kirándulás a Tramuntana-hegységbe<br>\n\n                <ul>\n                    <li>Reggeli után egész napos buszos kirándulás a lenyűgöző Tramuntana-hegységbe, UNESCO világörökség.</li>\n                    <li>Látogatás Valldemossa hangulatos falujába, sétálás a szűk utcákon.</li>\n                    <li>Kávészünet egy helyi cukrászdában, ahol megkóstolhatók a helyi sütemények.</li>\n                    <li>Délután Port de Sóller, séta a tengerparti sétányon.</li>\n                    <li>Visszatérés a szállodába, vacsora.</li>\n                </ul>\n            </p><hr>\n\n\n            <p>4. nap: Szabadprogram és fakultatív programok<br>\n\n            <ul>\n                <li>Reggeli után szabadprogram:</li>\n                <li>Pihenés a tengerparton vagy a medencénél.</li>\n                <li>Javasolt fakultatív programok:</li>\n                <li>Palma akvárium látogatás.</li>\n                <li>Kerékpár- vagy e-bike túra a sziget belsejében.</li>\n                <li>Borászat látogatás és borkóstoló.</li>\n                <li>Este búcsúvacsora egy tradicionális mallorcai étteremben, élő zenével.</li>\n            </ul></p><hr>\n\n\n            <p>5. nap: Hazautazás<br>\n\n            <ul>\n                <li>Reggeli a szállodában.</li>\n                <li>Transzfer a repülőtérre.</li>\n                <li>Visszautazás Budapestre.</li>\n            </ul>\n\n            </p><hr>\n            <p>Részvételi díj tartalmazza:<br>\n                <ul>\n                \n                    <li>Repülőjegy Budapest–Mallorca–Budapest útvonalon.</li>\n                    <li>Transzferek a repülőtértől a szállodáig és vissza.</li>\n                    <li>4 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li>\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\n                    <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetővel.</li>\n                    <li>Belépők a megadott látványosságokhoz.</li>\n                    <li>Utasbiztosítás.</li>\n                </ul>\n            </p><hr>\n\n            <p>Fakultatív programok (külön fizetendők):<br>\n            <ul>\n                <li>Egyéni fakultatív programok díjai.</li>\n                <li>Ebéd.</li>\n                <li>Egyéb személyes költségek.</li>\n            </ul>\n            </p><hr>\n            <p>Ár: 190.000 Ft / fő</p><hr>\n\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/mallorca.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 20, 3),
(6, 'trip-norway', 'Norvégia', 330000, '2026-12-22', '2026-12-27', '/oldal/images/norway.jpg', '/trip-norway', 'Norvégia', NULL, NULL, 0, NULL, 330000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n                      <p><b>Norvégiai csoportos utazás – 5 nap / 4 éjszaka</b><hr>\n\n            <p>1. nap: Érkezés Osloba és városnézés<br>\n                <ul>\n                    <li>Indulás Budapestről közvetlen vagy átszállásos járattal Oslo repülőterére.</li>\n                    <li>\n                    Transzfer a szállodába, szállás elfoglalása.</li>\n                    <li>Délutáni városnézés Oslo nevezetességeinél:<br>- Vigeland szoborpark megtekintése.<br>-Operaház és kikötői séta.<br>- Királyi Palota kívülről.</li>\n                    <li>Vacsora a szállodában vagy helyi étteremben.</li>\n                </ul>\n            </p><hr>\n\n            <p>2. nap: Bergen felé utazás és fjordok felfedezése<br>\n\n                <ul>\n\n                    <li>Reggeli után vonatozás Bergenbe, Európa egyik legszebb vasútvonalán (Flåm-vasút egy fakultatív program lehet).\n                    </li>\n                    <li>Érkezés Bergenbe, rövid városnézés:<br>- Bryggen – az UNESCO világörökség részét képező régi kereskedőházak.<br>- Halpiac látogatása.</li>\n                    <li>Szállás Bergenben, vacsora.</li>\n                </ul>\n            </p><hr>\n\n            <p>3. nap: Fjordkirándulás a Hardanger- vagy Sognefjordhoz<br>\n\n                <ul>\n                    <li>Egész napos hajókirándulás a lenyűgöző fjordokhoz:<br>- Csodás tájak, vízesések és kis halászfalvak megtekintése.<br>- Fotószünetek és rövid túrák a természetben.</li>\n                    <li>Látogatás Valldemossa hangulatos falujába, sétálás a szűk utcákon.</li>\n                    <li>Visszatérés Bergenbe, vacsora és szállás.</li>\n                </ul>\n            </p><hr>\n\n\n            <p>4. nap: Bergen szabadprogram vagy fakultatív programok<br>\n\n            <ul>\n                <li>Reggeli után szabadprogram vagy fakultatív programok:<br>- Fløibanen siklóval fel a Fløyen-hegyre, panorámás városnézés.<br>- Helyi múzeumok és galériák látogatása.<br>- Rövid túra a környező természetben.</li>\n                <li>Este közös vacsora egy tradicionális norvég étteremben.</li>\n            </ul></p><hr>\n\n\n            <p>5. nap: Hazautazás<br>\n\n            <ul>\n                <li>Reggeli után transzfer Bergen repülőterére.</li>\n                <li>Visszautazás Budapestre.</li>\n            </ul>\n\n            </p><hr>\n            <p>Részvételi díj tartalmazza:<br>\n                <ul>\n                \n                    <li>Repülőjegy Budapest–Oslo–Bergen–Budapest útvonalon.</li>\n                    <li>Transzferek a repülőterek és szállodák között.</li>\n                    <li>4 éjszaka szállás 3-4 csillagos szállodákban, kétágyas szobákban.</li>\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\n                    <li>\n                    Programban szereplő városnézések és fjordkirándulás magyar nyelvű idegenvezetéssel.</li>\n                    <li>Vonatjegy Oslo–Bergen útvonalon.</li>\n                    <li>Belépők és hajójegyek a programokhoz.</li>\n                    <li>Utasbiztosítás.</li>\n                </ul>\n            </p><hr>\n\n            <p>Az ár nem tartalmazza:<br>\n            <ul>\n                <li>Egyéni fakultatív programok díjai.</li>\n                <li>Ebéd.</li>\n                <li>Személyes költségek.</li>\n            </ul>\n            </p><hr>\n            <p>Ár: 330.000 Ft / fő</p><hr>\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/norway.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 10, 1),
(7, 'trip-turkey', 'Törökország', 170000, '2026-03-03', '2026-03-09', '/oldal/images/Töröko.jpg', '/trip-turkey', 'Törökország', NULL, NULL, 0, NULL, 170000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n            <p><b>Norvégiai csoportos utazás – 6 nap / 5 éjszaka</b><hr>\n\n            <p>1. nap: Érkezés Antalyába, transzfer a szállodába<br>\n                <ul>\n                    <li>Indulás Budapestről közvetlen járattal Antalya repülőterére.</li>\n                    <li>\n                    Transzfer a 4 csillagos tengerparti szállodába, szállás elfoglalása.</li>\n                    <li>\n                    Ismerkedés a szállodával és környékével.</li>\n                    <li>Esti vacsora a szállodában.</li>\n                </ul>\n            </p><hr>\n\n            <p>2. nap: Antalya városnézés és óváros felfedezése<br>\n\n                <ul>\n                    <li>\n                    Reggeli a szállodában.\n                    </li>\n                    <li>Egész napos városnézés Antalyában:<br>- Kaleiçi (óváros) szűk, macskaköves utcái.<br>- Hadrianus kapuja és a kikötő látványa.<br>- Régészeti múzeum látogatása.</li>\n                    <li>Szabadprogram a városközpontban, ebéd egy helyi étteremben.</li>\n                    <li>Visszautazás a szállodába, vacsora.</li>\n                </ul>\n            </p><hr>\n\n            <p>3. nap: Kirándulás a Düden-vízeséshez és Perge ókori városába<br>\n\n                <ul>\n                    <li>Reggeli után buszos kirándulás:<br>- Düden-vízesés megtekintése, fotózási lehetőség.<br>- Perge romváros látogatása, az ókori Pamphylia fontos központja.</li>\n                    <li>Délután visszaérkezés, pihenés a szállodában vagy a tengerparton.</li>\n                    <li>Vacsora a szállodában.</li>\n                </ul>\n            </p><hr>\n\n\n            <p>4. nap: Hajókirándulás a Török Riviérán<br>\n\n            <ul>\n                <li>\n                Egész napos hajókirándulás a kristálytiszta tengeren:<br>- Fürdési és napozási lehetőség a fedélzeten.<br>- Út közben látogatás kis öblökben és szigeteken.<br>- Ebéd a hajón (tengeri specialitásokkal).</li>\n                <li>Este visszatérés a szállodába, vacsora.</li>\n            </ul></p><hr>\n\n\n            <p>5. nap: Szabadprogram vagy fakultatív programok<br>\n\n            <ul>\n                <li>Reggeli után szabadprogram:<br>- Pihenés a tengerparton vagy wellness a szállodában.</li>\n                <li>Fakultatív programlehetőségek:<br>- Jeep szafari a Taurus-hegységben.<br>- Látogatás a Köprülü-kanyon Nemzeti Parkba.<br>- Vásárlás és piacnézés Antalyában.</li>\n                <li>Búcsúvacsora egy tradicionális török étteremben, élő zene mellett.</li>\n            </ul>\n\n            </p><hr>\n\n            <p>6. nap: Hazautazás<br>\n\n                <ul>\n                    <li>Reggeli a szállodában.</li>\n                    <li>Transzfer Antalya repülőterére.</li>\n                    <li>Visszautazás Budapestre.</li>\n                </ul>\n            </p><hr>\n\n            <p>Részvételi díj tartalmazza:<br>\n                <ul>\n                \n                    <li>Repülőjegy Budapest–Antalya–Budapest útvonalon.</li>\n                    <li>Transzferek repülőtértől a szállodáig és vissza.</li>\n                    <li>5 éjszaka szállás 4 csillagos tengerparti szállodában, kétágyas szobákban.</li>\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\n                    <li>Program szerinti kirándulások, városnézések és hajókirándulás busszal és hajóval, magyar nyelvű idegenvezetéssel.</li>\n                    <li>Belépők a programban szereplő helyszínekre.</li>\n                    <li>Utasbiztosítás.</li>\n                </ul>\n            </p><hr>\n\n            <p>Az ár nem tartalmazza:<br>\n            <ul>\n                <li>Egyéni fakultatív programok díjai.</li>\n                <li>Ebéd.</li>\n                <li>Személyes költségek.</li>\n            </ul>\n            </p><hr>\n            <p>Ár: 170.000 Ft / fő</p><hr>\n\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/töröko.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 12, 2),
(8, 'trip-prague', 'Prága', 75000, '2026-10-23', '2026-10-25', '/oldal/images/praga.jpg', '/trip-prague', 'Prága', NULL, NULL, 0, NULL, 75000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n            <p><b>Prágai csoportosutazás – 3 nap / 2 éjszaka</b><hr>\n\n            <p>1. nap: Indulás és érkezés Prágába<br>\n                <ul>\n                    <li>Kora reggeli indulás Budapestről kényelmes, légkondicionált busszal.</li>\n                    <li>Útközben rövid megállók pihenőre.</li>\n                    <li>Érkezés Prágába délután, transzfer a szállodába (3-4 csillagos, belvárosi elhelyezkedéssel).</li>\n                    <li>Szállás elfoglalása, pihenő.</li>\n                    <li>Este séta a Vencel téren, közös vacsora egy hangulatos cseh étteremben.</li>\n                </ul>\n\n            </p><hr>\n\n            <p>2. nap: Prága főbb nevezetességei<br>\n\n                <ul>\n                    <li>Reggeli a szállodában.</li>\n                    <li>Egész napos városnézés gyalogosan és busszal:<br>- Károly-híd, Óvárosi tér az Orloj órával.<br>-Prágai vár és Szent Vitus-székesegyház.<br>-Kisoldal (Malá Strana) hangulatos utcái.<br>-Ebéd egy helyi étteremben (nem tartozik az árba).</li>\n                    <li>Délután szabadprogram vagy fakultatív programlehetőség:<br>-Vltava folyó hajókirándulás.<br>-Zsidó negyed látogatása.</li>\n                    <li>Este csoportos vacsora, hagyományos cseh specialitásokkal.</li>\n                </ul>\n            </p><hr>\n\n            <p>3. nap: Szabadprogram és hazautazás<br>\n\n                <ul>\n                    <li>Reggeli után szabadidő vásárlásra, kávézásra vagy múzeumlátogatásra.</li>\n                    <li>Kora délutáni indulás vissza Budapestre.</li>\n                    <li>Érkezés Budapestre az esti órákban.</li>\n                </ul>\n            </p><hr>\n\n            <p>Az ár tartalmazza:<br>\n\n                <ul>\n                    <li>Kényelmes, légkondicionált buszos utazást oda-vissza Budapestről Prágába.</li>\n                    <li>2 éjszaka szállás 3-4 csillagos szállodában, kétágyas szobákban.</li>\n                    <li>Reggeli a szállodában.</li>\n                    <li>Magyar nyelvű idegenvezetés a városnézés alatt.</li>\n                    <li>Transzferek Prágán belül.</li>\n                    <li>Csoportos vacsorák a program szerint.</li>\n                    <li>Utasbiztosítás.<li>\n                </ul>\n            </p><hr>\n\n            <p>Nem tartalmazza:<br>\n\n                <ul>\n                    <li>Ebéd.</li>\n                    <li>Egyéni fakultatív programok díjai.</li>\n                    <li>Személyes kiadások.</li>\n                </ul>\n            </p><hr>\n\n            <p>Ár: 75.000 Ft / fő</p><hr>\n\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/praga.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 8, 4),
(9, 'trip-lisbon', 'Lisszabon', 250000, '2026-09-01', '2026-09-06', '/oldal/images/Lisbon.jpg', '/trip-lisbon', 'Lisszabon', NULL, NULL, 0, NULL, 250000, '<div class=\"site-section\">\n\n      <div class=\"container\">\n        </div>\n\n\n        <div class=\"row mt-5 pt-5\">\n          <div class=\"col-md-6\">\n            <p><b>Csoportos utazás Lisszabonba – 5 nap / 4 éjszaka</b><hr>\n\n            <p>1. nap: Érkezés Lisszabonba és városnézés<br>\n                <ul>\n                    <li>Indulás Budapestről közvetlen vagy átszállásos járattal Lisszabonba.</li>\n                    <li>\n                    Transzfer a szállodába, szállás elfoglalása.</li>\n                    <li>Rövid pihenő után városnézés:<br>-\n                    Belém negyed felfedezése: Jeromos kolostor, Belémi torony, Felfedezők emlékműve.<br>- Kóstolja meg a híres Pastéis de Belém-t!</li>\n                    <li>Vacsora a szállodában vagy helyi étteremben.</li>\n                </ul>\n            </p><hr>\n\n            <p>2. nap: Lisszabon történelmi belvárosa és Alfama<br>\n\n                <ul>\n                    <li>Reggeli után egész napos városnézés:<br>- Szent György vár (Castelo de São Jorge) panorámás kilátóval.<br>- Alfama negyed hangulatos utcái és piacai.<br>- Praça do Comércio és a város főtere.</li>\n                    <li>Ebéd szabadprogram keretében.</li>\n                    <li>Este fakultatív programlehetőség: Fado est egy tradicionális étteremben.</li>\n                </ul>\n            </p><hr>\n\n            <p>3. nap: Kirándulás Sintrába és Cascais-ba<br>\n\n                <ul>\n                    <li>Reggeli után egész napos kirándulás:<br>- Sintra: Pena Palota és a Quinta da Regaleira látogatása.<br>- Cascais: tengerparti séta és városnézés.</li>\n                    <li>Ebéd egy helyi étteremben.</li>\n                    <li>Visszatérés Lisszabonba, vacsora.</li>\n                </ul>\n            </p><hr>\n\n\n            <p>4. nap: Modern Lisszabon és szabadprogram<br>\n\n            <ul>\n                <li>Reggeli után látogatás a Parque das Nações modern negyedben:<br>- Oceanário de Lisboa (akvárium).<br>- Vasúti állomás és futurisztikus épületek.</li>\n                <li>Délután szabadprogram vásárlásra, múzeumlátogatásra vagy pihenésre.</li>\n                <li>Búcsúvacsora egy helyi étteremben, portugál specialitásokkal.</li>\n            </ul></p><hr>\n\n\n            <p>5. nap: Hazautazás<br>\n\n            <ul>\n                <li>Reggeli után transzfer a repülőtérre.</li>\n                <li>Visszautazás Budapestre.</li>\n            </ul>\n\n            </p><hr>\n            <p>Részvételi díj tartalmazza:<br>\n                <ul>\n                \n                    <li>Repülőjegy Budapest–Lisszabon–Budapest útvonalon.</li>\n                    <li>Transzferek repülőtértől a szállodáig és vissza.</li>\n                    <li>4 éjszaka szállás 3-4 csillagos szállodában, kétágyas szobákban.</li>\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\n                    <li>Program szerinti városnézések és kirándulások busszal, magyar nyelvű idegenvezetéssel.</li>\n                    <li>Belépők a programban szereplő helyszínekre.</li>\n                    <li>Utasbiztosítás.</li>\n                </ul>\n            </p><hr>\n\n            <p>Az ár nem tartalmazza:<br>\n            <ul>\n                <li>Egyéni fakultatív programok díjai.</li>\n                <li>Ebéd.</li>\n                <li>Személyes költségek.</li>\n            </ul>\n            </p><hr>\n            <p>Ár: 250.000 Ft / fő</p><hr>\n            <p><a href=\"contact.html\" class=\"btn btn-primary py-3 px-4 my-4\">Contact Us</a></p>\n          </div>\n          <div class=\"col-md-6\">\n            <img src=\"/oldal/images/lisbon.jpg\" alt=\"Image\" class=\"img-fluid\">\n          </div>\n        </div>\n\n      </div>\n    </div>\n\n\n    \n    </div>', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_25_100000_create_destination_table', 2),
(5, '2025_09_25_103300_alter_destination_add_missing_columns', 3),
(6, '2025_09_25_110000_create_reservations_table', 4),
(7, '2025_09_25_111000_alter_reservations_add_fields', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` enum('email','push','popup') NOT NULL,
  `threshold` decimal(10,2) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricewatch`
--

CREATE TABLE `pricewatch` (
  `id` int(11) NOT NULL,
  `item_type` enum('flight','hotel','program') NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `people_count` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routedestinations`
--

CREATE TABLE `routedestinations` (
  `route_id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `settings`) VALUES
(3, 'Teszt Felha', 'hkogites@gmail.com', '$2y$12$Owz3HZz1afLnKqAIvAaPlew7Aq3kboxnc6yMzzTbdRyixqlRbqbqC', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `conditions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destination_slug_unique` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_index` (`user_id`),
  ADD KEY `reservations_destination_id_index` (`destination_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD PRIMARY KEY (`route_id`,`dest_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pricewatch`
--
ALTER TABLE `pricewatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_3` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD CONSTRAINT `pricewatch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD CONSTRAINT `routedestinations_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routedestinations_ibfk_2` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `weather_ibfk_1` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
