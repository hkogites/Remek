-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Nov 12. 10:15
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `utazasteszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cost`
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
-- Tábla szerkezet ehhez a táblához `destination`
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
  `evszak` int(11) NOT NULL,
  `image2_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `destination`
--

INSERT INTO `destination` (`id`, `slug`, `title`, `price_huf`, `start_date`, `end_date`, `image_path`, `detail_url`, `name`, `country`, `description`, `is_global`, `user_id`, `ar`, `leiras`, `foglallimit`, `evszak`, `image2_path`) VALUES
(4, 'trip-olasz', 'Észak-Olaszországi körút', 156000, '2026-06-20', '2026-06-26', '/oldal/images/olaszo.jpg', '/trip-olasz', 'Észak-Olaszországi körút', NULL, NULL, 0, NULL, 156000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n            <p><b>Észak-Olaszországi körutazás – 6 nap / 5 éjszaka</b>\r\n\r\n            Verona – Garda-tó – Sirmione – Milánó – Comói-tó – Bergamo – Velence\r\n            Autóbuszos utazás – 50 fős csoport számára</p><hr>\r\n\r\n            <p>1. nap: Indulás – Verona – Garda-tó<br> Indulás: Kora reggeli órákban indulás Magyarországról (pl. Budapest vagy Győr), pihenőkkel útközben. <br>Érkezés Veronába: Kora délután, városnézés helyi idegenvezetővel:\r\n                <ul>\r\n                    <li>Aréna di Verona – a híres római amfiteátrum</li>\r\n                    <li>Julietta háza – a híres erkély</li>\r\n                    <li>Piazza delle Erbe, Piazza dei Signori</li>\r\n                    <li>Továbbutazás a Garda-tóhoz, szállás elfoglalása a tó közelében (pl. Peschiera del Garda vagy Desenzano).</li>\r\n                    <li>Vacsora, szállás a Garda-tónál.</li>\r\n\r\n                </ul>\r\n\r\n            </p><hr>\r\n\r\n            <p>2. nap: Garda-tó – Sirmione – Bergamo<br>\r\n\r\n            Délelőtt: Látogatás Sirmionéba, a Garda-tó ékszerdobozába:<br>\r\n            <ul>\r\n                <li>Scaligeri vár, séta az óvárosban</li>\r\n                <li>Fakultatív hajókirándulás a Garda-tavon (kb. 30-45 perc)</li>\r\n                <li>Délután: Továbbutazás Bergamóba</li>\r\n                <li>Siklóval fel a Felsővárosba (Città Alta)</li>\r\n                <li>Piazza Vecchia, Santa Maria Maggiore-bazilika, Colleoni kápolna</li>\r\n            </ul>\r\n\r\n            Este: Szállás Bergamo vagy környékén, vacsora.</p><hr>\r\n\r\n            <p>3. nap: Milánó – a divat és kultúra fővárosa<br>\r\n\r\n            Egész napos kirándulás Milánóba, városnézés:<br>\r\n            <ul>\r\n                <li>Milánói dóm, a világ egyik legnagyobb katedrálisa</li>\r\n                <li>Galleria Vittorio Emanuele II</li>\r\n                <li>La Scala operaház</li>\r\n                <li>Fotószünet a Castello Sforzesco előtt</li>\r\n                <li>Szabadidő vásárlásra vagy egyéni felfedezésre.</li>\r\n            </ul>\r\n            Visszautazás a szállásra, vacsora.</p><hr>\r\n\r\n\r\n            <p><b>4. nap:</b> Comói-tó – Tremezzo – Bellagio (fakultatív hajókirándulás)<br>\r\n\r\n            Kirándulás a festői Comói-tóhoz:<br>\r\n            <ul>\r\n                <li>Látogatás Como városába – Dóm, tóparti sétány</li>\r\n                <li>Fakultatív hajókirándulás a tavon: Tremezzo (Villa Carlotta) és Bellagio – a tó gyöngyszeme</li>\r\n                <li>Visszatérés a szállásra a kora esti órákban.</li>\r\n            </ul>\r\n            Vacsora, szállás.</p><hr>\r\n\r\n            <p>5. nap: Velence – a lagúnák városa<br>\r\n\r\n            Kora reggeli indulás Velencébe, átszállás hajóra Punta Sabbioni kikötőjében.<br>\r\n            Városnézés Velencében:<br>\r\n            <ul>\r\n                <li>Szent Márk tér, Bazilika, Dózse-palota, Campanile</li>\r\n                <li>Rialto-híd, Canale Grande</li>\r\n                <li>Szabadidő, vásárlási lehetőség, kávézás a híres kávézókban.</li>\r\n                <li>Késő délután visszatérés a kikötőbe, utazás a szállásra Velence környékén (pl. Mestre vagy Lido di Jesolo).</li>\r\n                <li>Vacsora, szállás.</li>\r\n            </ul>\r\n\r\n            </p><hr>\r\n\r\n            <p>6. nap: Hazautazás – Udine vagy Grado (megálló útközben)<br>\r\n\r\n            Reggeli után indulás Magyarország felé.<br>\r\n            <ul>\r\n                <li>Útközbeni rövid megálló Udine vagy a tengerparti Grado városában, pihenő, szabadprogram.</li>\r\n                <li>Érkezés Magyarországra az esti órákban.</li>\r\n            </ul>\r\n            </p><hr>\r\n\r\n            <p>Részvételi díj tartalmazza:<br>\r\n            <ul>\r\n                <li>Kényelmes, légkondicionált, 50 fős autóbusz bérleti díját</li>\r\n                <li>5 éjszaka szállást 3*-os szállodákban, reggelivel és vacsorával</li>\r\n                <li>Helyi idegenvezetést Veronában, Milánóban és Velencében</li>\r\n                <li>Útlemondási biztosítás</li>\r\n                <li>Magyar nyelvű csoportkísérőt</li>\r\n            </ul>\r\n            </p><hr>\r\n\r\n            <p>Fakultatív programok (külön fizetendők):<br>\r\n            <ul>\r\n                <li>Hajókirándulás Sirmionéban (kb. 15 EUR)</li>\r\n                <li>Comói-tavi hajózás Bellagio és Tremezzo között (kb. 25–30 EUR)</li>\r\n                <li>Belépők: Velencei Dózse-palota, Milánói dóm kupolája stb. (összesen kb. 40–60 EUR)</li>\r\n            </ul>\r\n            </p><hr>\r\n            <p>Ár: 156.000 Ft / fő</p><hr>\r\n\r\n\r\n            <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> </div>\r\n          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/olaszo.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 25, 3, '/oldal/images/italy.jpg'),
(5, 'trip-mallorca', 'Mallorca', 190000, '2026-04-03', '2026-04-08', '/oldal/images/mallorca.jpg', '/trip-mallorca', 'Mallorca', NULL, NULL, 0, NULL, 190000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n          <p><b>Mallorcai csoportosutazás – 5 nap / 4 éjszaka</b><hr>\r\n\r\n            <p>1. nap: Érkezés és ismerkedés<br>\r\n                <ul>\r\n                    <li>Indulás Budapestről közvetlen járattal Mallorca repülőterére.</li>\r\n                    <li>Transzfer a szállodába (4 csillagos, tengerparti elhelyezkedésű).</li>\r\n                    <li>Szállás elfoglalása, rövid pihenő.</li>\r\n                    <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li>\r\n                    <li>Rövid tájékoztató a programról és Mallorcáról.</li>\r\n\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>2. nap: Palma városnézés és kultúra<br>\r\n\r\n                <ul>\r\n\r\n                    <li>Reggeli a szállodában.</li>\r\n                    <li>Egész napos városnézés Palma de Mallorca történelmi belvárosában:</li>\r\n                    <li>La Seu katedrális megtekintése.</li>\r\n                    <li>Királyi palota (Palau de l’Almudaina) látogatása.</li>\r\n                    <li>Hangulatos piac és bevásárlóutca felfedezése.</li>\r\n                    <li>Szabadprogram és ebéd egy helyi étteremben (opcionális).</li>\r\n                    <li>Délután visszautazás a szállodába, pihenés.</li>\r\n                    <li>Esti fakultatív program: tengeri naplemente hajókirándulás (külön díj ellenében).</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>3. nap: Kirándulás a Tramuntana-hegységbe<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli után egész napos buszos kirándulás a lenyűgöző Tramuntana-hegységbe, UNESCO világörökség.</li>\r\n                    <li>Látogatás Valldemossa hangulatos falujába, sétálás a szűk utcákon.</li>\r\n                    <li>Kávészünet egy helyi cukrászdában, ahol megkóstolhatók a helyi sütemények.</li>\r\n                    <li>Délután Port de Sóller, séta a tengerparti sétányon.</li>\r\n                    <li>Visszatérés a szállodába, vacsora.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n\r\n            <p>4. nap: Szabadprogram és fakultatív programok<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után szabadprogram:</li>\r\n                <li>Pihenés a tengerparton vagy a medencénél.</li>\r\n                <li>Javasolt fakultatív programok:</li>\r\n                <li>Palma akvárium látogatás.</li>\r\n                <li>Kerékpár- vagy e-bike túra a sziget belsejében.</li>\r\n                <li>Borászat látogatás és borkóstoló.</li>\r\n                <li>Este búcsúvacsora egy tradicionális mallorcai étteremben, élő zenével.</li>\r\n            </ul></p><hr>\r\n\r\n\r\n            <p>5. nap: Hazautazás<br>\r\n\r\n            <ul>\r\n                <li>Reggeli a szállodában.</li>\r\n                <li>Transzfer a repülőtérre.</li>\r\n                <li>Visszautazás Budapestre.</li>\r\n            </ul>\r\n\r\n            </p><hr>\r\n            <p>Részvételi díj tartalmazza:<br>\r\n                <ul>\r\n                \r\n                    <li>Repülőjegy Budapest–Mallorca–Budapest útvonalon.</li>\r\n                    <li>Transzferek a repülőtértől a szállodáig és vissza.</li>\r\n                    <li>4 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li>\r\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n                    <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetővel.</li>\r\n                    <li>Belépők a megadott látványosságokhoz.</li>\r\n                    <li>Utasbiztosítás.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Fakultatív programok (külön fizetendők):<br>\r\n            <ul>\r\n                <li>Egyéni fakultatív programok díjai.</li>\r\n                <li>Ebéd.</li>\r\n                <li>Egyéb személyes költségek.</li>\r\n            </ul>\r\n            </p><hr>\r\n            <p>Ár: 190.000 Ft / fő</p><hr>\r\n\r\n            <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> </div>          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/mallorca.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 20, 3, '/oldal/images/mallorca2.jpg'),
(6, 'trip-norway', 'Norvégia', 330000, '2026-12-22', '2026-12-27', '/oldal/images/norway.jpg', '/trip-norway', 'Norvégia', NULL, NULL, 0, NULL, 330000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n                      <p><b>Norvégiai csoportos utazás – 5 nap / 4 éjszaka</b><hr>\r\n\r\n            <p>1. nap: Érkezés Osloba és városnézés<br>\r\n                <ul>\r\n                    <li>Indulás Budapestről közvetlen vagy átszállásos járattal Oslo repülőterére.</li>\r\n                    <li>\r\n                    Transzfer a szállodába, szállás elfoglalása.</li>\r\n                    <li>Délutáni városnézés Oslo nevezetességeinél:<br>- Vigeland szoborpark megtekintése.<br>-Operaház és kikötői séta.<br>- Királyi Palota kívülről.</li>\r\n                    <li>Vacsora a szállodában vagy helyi étteremben.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>2. nap: Bergen felé utazás és fjordok felfedezése<br>\r\n\r\n                <ul>\r\n\r\n                    <li>Reggeli után vonatozás Bergenbe, Európa egyik legszebb vasútvonalán (Flåm-vasút egy fakultatív program lehet).\r\n                    </li>\r\n                    <li>Érkezés Bergenbe, rövid városnézés:<br>- Bryggen – az UNESCO világörökség részét képező régi kereskedőházak.<br>- Halpiac látogatása.</li>\r\n                    <li>Szállás Bergenben, vacsora.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>3. nap: Fjordkirándulás a Hardanger- vagy Sognefjordhoz<br>\r\n\r\n                <ul>\r\n                    <li>Egész napos hajókirándulás a lenyűgöző fjordokhoz:<br>- Csodás tájak, vízesések és kis halászfalvak megtekintése.<br>- Fotószünetek és rövid túrák a természetben.</li>\r\n                    <li>Látogatás Valldemossa hangulatos falujába, sétálás a szűk utcákon.</li>\r\n                    <li>Visszatérés Bergenbe, vacsora és szállás.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n\r\n            <p>4. nap: Bergen szabadprogram vagy fakultatív programok<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után szabadprogram vagy fakultatív programok:<br>- Fløibanen siklóval fel a Fløyen-hegyre, panorámás városnézés.<br>- Helyi múzeumok és galériák látogatása.<br>- Rövid túra a környező természetben.</li>\r\n                <li>Este közös vacsora egy tradicionális norvég étteremben.</li>\r\n            </ul></p><hr>\r\n\r\n\r\n            <p>5. nap: Hazautazás<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után transzfer Bergen repülőterére.</li>\r\n                <li>Visszautazás Budapestre.</li>\r\n            </ul>\r\n\r\n            </p><hr>\r\n            <p>Részvételi díj tartalmazza:<br>\r\n                <ul>\r\n                \r\n                    <li>Repülőjegy Budapest–Oslo–Bergen–Budapest útvonalon.</li>\r\n                    <li>Transzferek a repülőterek és szállodák között.</li>\r\n                    <li>4 éjszaka szállás 3-4 csillagos szállodákban, kétágyas szobákban.</li>\r\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n                    <li>\r\n                    Programban szereplő városnézések és fjordkirándulás magyar nyelvű idegenvezetéssel.</li>\r\n                    <li>Vonatjegy Oslo–Bergen útvonalon.</li>\r\n                    <li>Belépők és hajójegyek a programokhoz.</li>\r\n                    <li>Utasbiztosítás.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Az ár nem tartalmazza:<br>\r\n            <ul>\r\n                <li>Egyéni fakultatív programok díjai.</li>\r\n                <li>Ebéd.</li>\r\n                <li>Személyes költségek.</li>\r\n            </ul>\r\n            </p><hr>\r\n            <p>Ár: 330.000 Ft / fő</p><hr>\r\n           <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n          </div>\r\n          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/norway.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 10, 1, '/oldal/images/norway2.jpg'),
(7, 'trip-turkey', 'Törökország', 170000, '2026-03-03', '2026-03-09', '/oldal/images/Töröko.jpg', '/trip-turkey', 'Törökország', NULL, NULL, 0, NULL, 170000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n            <p><b>Norvégiai csoportos utazás – 6 nap / 5 éjszaka</b><hr>\r\n\r\n            <p>1. nap: Érkezés Antalyába, transzfer a szállodába<br>\r\n                <ul>\r\n                    <li>Indulás Budapestről közvetlen járattal Antalya repülőterére.</li>\r\n                    <li>\r\n                    Transzfer a 4 csillagos tengerparti szállodába, szállás elfoglalása.</li>\r\n                    <li>\r\n                    Ismerkedés a szállodával és környékével.</li>\r\n                    <li>Esti vacsora a szállodában.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>2. nap: Antalya városnézés és óváros felfedezése<br>\r\n\r\n                <ul>\r\n                    <li>\r\n                    Reggeli a szállodában.\r\n                    </li>\r\n                    <li>Egész napos városnézés Antalyában:<br>- Kaleiçi (óváros) szűk, macskaköves utcái.<br>- Hadrianus kapuja és a kikötő látványa.<br>- Régészeti múzeum látogatása.</li>\r\n                    <li>Szabadprogram a városközpontban, ebéd egy helyi étteremben.</li>\r\n                    <li>Visszautazás a szállodába, vacsora.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>3. nap: Kirándulás a Düden-vízeséshez és Perge ókori városába<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli után buszos kirándulás:<br>- Düden-vízesés megtekintése, fotózási lehetőség.<br>- Perge romváros látogatása, az ókori Pamphylia fontos központja.</li>\r\n                    <li>Délután visszaérkezés, pihenés a szállodában vagy a tengerparton.</li>\r\n                    <li>Vacsora a szállodában.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n\r\n            <p>4. nap: Hajókirándulás a Török Riviérán<br>\r\n\r\n            <ul>\r\n                <li>\r\n                Egész napos hajókirándulás a kristálytiszta tengeren:<br>- Fürdési és napozási lehetőség a fedélzeten.<br>- Út közben látogatás kis öblökben és szigeteken.<br>- Ebéd a hajón (tengeri specialitásokkal).</li>\r\n                <li>Este visszatérés a szállodába, vacsora.</li>\r\n            </ul></p><hr>\r\n\r\n\r\n            <p>5. nap: Szabadprogram vagy fakultatív programok<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után szabadprogram:<br>- Pihenés a tengerparton vagy wellness a szállodában.</li>\r\n                <li>Fakultatív programlehetőségek:<br>- Jeep szafari a Taurus-hegységben.<br>- Látogatás a Köprülü-kanyon Nemzeti Parkba.<br>- Vásárlás és piacnézés Antalyában.</li>\r\n                <li>Búcsúvacsora egy tradicionális török étteremben, élő zene mellett.</li>\r\n            </ul>\r\n\r\n            </p><hr>\r\n\r\n            <p>6. nap: Hazautazás<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli a szállodában.</li>\r\n                    <li>Transzfer Antalya repülőterére.</li>\r\n                    <li>Visszautazás Budapestre.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Részvételi díj tartalmazza:<br>\r\n                <ul>\r\n                \r\n                    <li>Repülőjegy Budapest–Antalya–Budapest útvonalon.</li>\r\n                    <li>Transzferek repülőtértől a szállodáig és vissza.</li>\r\n                    <li>5 éjszaka szállás 4 csillagos tengerparti szállodában, kétágyas szobákban.</li>\r\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n                    <li>Program szerinti kirándulások, városnézések és hajókirándulás busszal és hajóval, magyar nyelvű idegenvezetéssel.</li>\r\n                    <li>Belépők a programban szereplő helyszínekre.</li>\r\n                    <li>Utasbiztosítás.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Az ár nem tartalmazza:<br>\r\n            <ul>\r\n                <li>Egyéni fakultatív programok díjai.</li>\r\n                <li>Ebéd.</li>\r\n                <li>Személyes költségek.</li>\r\n            </ul>\r\n            </p><hr>\r\n            <p>Ár: 170.000 Ft / fő</p><hr>\r\n\r\n            <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n          </div>\r\n          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/töröko.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 12, 2, '/oldal/images/töröko2.jpg'),
(8, 'trip-prague', 'Prága', 75000, '2026-10-23', '2026-10-25', '/oldal/images/praga.jpg', '/trip-prague', 'Prága', NULL, NULL, 0, NULL, 75000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n            <p><b>Prágai csoportosutazás – 3 nap / 2 éjszaka</b><hr>\r\n\r\n            <p>1. nap: Indulás és érkezés Prágába<br>\r\n                <ul>\r\n                    <li>Kora reggeli indulás Budapestről kényelmes, légkondicionált busszal.</li>\r\n                    <li>Útközben rövid megállók pihenőre.</li>\r\n                    <li>Érkezés Prágába délután, transzfer a szállodába (3-4 csillagos, belvárosi elhelyezkedéssel).</li>\r\n                    <li>Szállás elfoglalása, pihenő.</li>\r\n                    <li>Este séta a Vencel téren, közös vacsora egy hangulatos cseh étteremben.</li>\r\n                </ul>\r\n\r\n            </p><hr>\r\n\r\n            <p>2. nap: Prága főbb nevezetességei<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli a szállodában.</li>\r\n                    <li>Egész napos városnézés gyalogosan és busszal:<br>- Károly-híd, Óvárosi tér az Orloj órával.<br>-Prágai vár és Szent Vitus-székesegyház.<br>-Kisoldal (Malá Strana) hangulatos utcái.<br>-Ebéd egy helyi étteremben (nem tartozik az árba).</li>\r\n                    <li>Délután szabadprogram vagy fakultatív programlehetőség:<br>-Vltava folyó hajókirándulás.<br>-Zsidó negyed látogatása.</li>\r\n                    <li>Este csoportos vacsora, hagyományos cseh specialitásokkal.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>3. nap: Szabadprogram és hazautazás<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli után szabadidő vásárlásra, kávézásra vagy múzeumlátogatásra.</li>\r\n                    <li>Kora délutáni indulás vissza Budapestre.</li>\r\n                    <li>Érkezés Budapestre az esti órákban.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Az ár tartalmazza:<br>\r\n\r\n                <ul>\r\n                    <li>Kényelmes, légkondicionált buszos utazást oda-vissza Budapestről Prágába.</li>\r\n                    <li>2 éjszaka szállás 3-4 csillagos szállodában, kétágyas szobákban.</li>\r\n                    <li>Reggeli a szállodában.</li>\r\n                    <li>Magyar nyelvű idegenvezetés a városnézés alatt.</li>\r\n                    <li>Transzferek Prágán belül.</li>\r\n                    <li>Csoportos vacsorák a program szerint.</li>\r\n                    <li>Utasbiztosítás.<li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Nem tartalmazza:<br>\r\n\r\n                <ul>\r\n                    <li>Ebéd.</li>\r\n                    <li>Egyéni fakultatív programok díjai.</li>\r\n                    <li>Személyes kiadások.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Ár: 75.000 Ft / fő</p><hr>\r\n\r\n            <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n          </div>\r\n          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/praga.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 8, 4, '/oldal/images/praga2.jpeg'),
(9, 'trip-lisbon', 'Lisszabon', 250000, '2026-09-01', '2026-09-06', '/oldal/images/Lisbon.jpg', '/trip-lisbon', 'Lisszabon', NULL, NULL, 0, NULL, 250000, '<div class=\"site-section\">\r\n\r\n      <div class=\"container\">\r\n        </div>\r\n\r\n\r\n        <div class=\"row mt-5 pt-5\">\r\n          <div class=\"col-md-6\">\r\n            <p><b>Csoportos utazás Lisszabonba – 5 nap / 4 éjszaka</b><hr>\r\n\r\n            <p>1. nap: Érkezés Lisszabonba és városnézés<br>\r\n                <ul>\r\n                    <li>Indulás Budapestről közvetlen vagy átszállásos járattal Lisszabonba.</li>\r\n                    <li>\r\n                    Transzfer a szállodába, szállás elfoglalása.</li>\r\n                    <li>Rövid pihenő után városnézés:<br>-\r\n                    Belém negyed felfedezése: Jeromos kolostor, Belémi torony, Felfedezők emlékműve.<br>- Kóstolja meg a híres Pastéis de Belém-t!</li>\r\n                    <li>Vacsora a szállodában vagy helyi étteremben.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>2. nap: Lisszabon történelmi belvárosa és Alfama<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli után egész napos városnézés:<br>- Szent György vár (Castelo de São Jorge) panorámás kilátóval.<br>- Alfama negyed hangulatos utcái és piacai.<br>- Praça do Comércio és a város főtere.</li>\r\n                    <li>Ebéd szabadprogram keretében.</li>\r\n                    <li>Este fakultatív programlehetőség: Fado est egy tradicionális étteremben.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>3. nap: Kirándulás Sintrába és Cascais-ba<br>\r\n\r\n                <ul>\r\n                    <li>Reggeli után egész napos kirándulás:<br>- Sintra: Pena Palota és a Quinta da Regaleira látogatása.<br>- Cascais: tengerparti séta és városnézés.</li>\r\n                    <li>Ebéd egy helyi étteremben.</li>\r\n                    <li>Visszatérés Lisszabonba, vacsora.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n\r\n            <p>4. nap: Modern Lisszabon és szabadprogram<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után látogatás a Parque das Nações modern negyedben:<br>- Oceanário de Lisboa (akvárium).<br>- Vasúti állomás és futurisztikus épületek.</li>\r\n                <li>Délután szabadprogram vásárlásra, múzeumlátogatásra vagy pihenésre.</li>\r\n                <li>Búcsúvacsora egy helyi étteremben, portugál specialitásokkal.</li>\r\n            </ul></p><hr>\r\n\r\n\r\n            <p>5. nap: Hazautazás<br>\r\n\r\n            <ul>\r\n                <li>Reggeli után transzfer a repülőtérre.</li>\r\n                <li>Visszautazás Budapestre.</li>\r\n            </ul>\r\n\r\n            </p><hr>\r\n            <p>Részvételi díj tartalmazza:<br>\r\n                <ul>\r\n                \r\n                    <li>Repülőjegy Budapest–Lisszabon–Budapest útvonalon.</li>\r\n                    <li>Transzferek repülőtértől a szállodáig és vissza.</li>\r\n                    <li>4 éjszaka szállás 3-4 csillagos szállodában, kétágyas szobákban.</li>\r\n                    <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n                    <li>Program szerinti városnézések és kirándulások busszal, magyar nyelvű idegenvezetéssel.</li>\r\n                    <li>Belépők a programban szereplő helyszínekre.</li>\r\n                    <li>Utasbiztosítás.</li>\r\n                </ul>\r\n            </p><hr>\r\n\r\n            <p>Az ár nem tartalmazza:<br>\r\n            <ul>\r\n                <li>Egyéni fakultatív programok díjai.</li>\r\n                <li>Ebéd.</li>\r\n                <li>Személyes költségek.</li>\r\n            </ul>\r\n            </p><hr>\r\n            <p>Ár: 250.000 Ft / fő</p><hr>\r\n            <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n          </div>\r\n          <div class=\"col-md-6\">\r\n            <img src=\"/oldal/images/lisbon.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n          </div>\r\n        </div>\r\n\r\n      </div>\r\n    </div>\r\n\r\n\r\n    \r\n    </div>', 5, 3, '/oldal/images/lisbon2.webp'),
(15, 'trip-japan-spring', 'Japán', 799000, '2026-03-28', '2026-04-05', '/oldal/images/japan_t.jpg', '/trip-japan-spring', 'Japán', NULL, NULL, 0, NULL, 779000, '<div class=\"site-section\">\r\n\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Japán csoportos utazás – 9 nap / 7 éjszaka</b><hr>\r\n\r\n        <p>1. nap: Elutazás Budapestről<br>\r\n          <ul>\r\n            <li>Indulás Budapestről menetrendszerinti járattal Tokióba (átszállással).</li>\r\n            <li>Éjszaka a repülőn.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>2. nap: Érkezés Tokióba<br>\r\n          <ul>\r\n            <li>Megérkezés Japán fővárosába, Tokióba.</li>\r\n            <li>Transzfer a szállodába (4 csillagos központi hotel).</li>\r\n            <li>Szállás elfoglalása, rövid pihenő.</li>\r\n            <li>Délután szabadprogram vagy könnyű séta a környéken.</li>\r\n            <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal és az idegenvezetővel.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>3. nap: Tokió városnézés<br>\r\n          <ul>\r\n            <li>Reggeli után egész napos városnézés Tokióban.</li>\r\n            <li>Asakusa negyed és a Senso-ji templom megtekintése.</li>\r\n            <li>Nakamise sétálóutca, hagyományos japán üzletekkel.</li>\r\n            <li>Ueno park és a Császári Palota kertjei.</li>\r\n            <li>Délután a modern Shibuya és Shinjuku negyedek felfedezése.</li>\r\n            <li>Este fakultatív vacsora egy sushi étteremben.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>4. nap: Nikko kirándulás – Világörökség nyomában<br>\r\n          <ul>\r\n            <li>Egész napos kirándulás Nikkóba, a Tokugawa-sógun mauzóleumának városába.</li>\r\n            <li>Toshogu-szentély, piros hidak és hegyvidéki tájak megtekintése.</li>\r\n            <li>Délután visszautazás Tokióba, vacsora a szállodában.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>5. nap: Tokió – Hakone – Fuji – Kiotó<br>\r\n          <ul>\r\n            <li>Reggeli után utazás Hakonéba, a Fuji-hegy lábához.</li>\r\n            <li>Hajókázás az Ashi-tavon, kilátással a Fuji-hegyre (időjárás függvényében).</li>\r\n            <li>Rövid túra az Owakudani-völgy geotermikus forrásaihoz.</li>\r\n            <li>Délután utazás a szupergyors Shinkansen vonattal Kiotóba.</li>\r\n            <li>Szállás Kiotóban, vacsora a szállodában.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>6. nap: Kiotó – a templomok városa<br>\r\n          <ul>\r\n            <li>Egész napos városnézés Kiotóban, Japán kulturális fővárosában.</li>\r\n            <li>Arany Pavilon (Kinkaku-ji), Nijo kastély és a Gion negyed.</li>\r\n            <li>Fushimi Inari szentély, híres narancsszínű torii-kapukkal.</li>\r\n            <li>Délután szabadprogram, séta a hagyományos teaházak utcáiban.</li>\r\n            <li>Esti fakultatív program: japán teaceremónia bemutató.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>7. nap: Kirándulás Narába<br>\r\n          <ul>\r\n            <li>Reggeli után félnapos kirándulás Narába, Japán első fővárosába.</li>\r\n            <li>Todaiji templom és a Nagy Buddha szobor megtekintése.</li>\r\n            <li>Séta a Nara Parkban, ahol a szelíd szarvasok szabadon sétálnak.</li>\r\n            <li>Délután visszautazás Kiotóba, vacsora a szállodában.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>8. nap: Kiotó – Oszaka – Hazautazás<br>\r\n          <ul>\r\n            <li>Reggeli után transzfer Oszakába.</li>\r\n            <li>Rövid városnézés: Oszaka vára, Dotonbori sétány és bevásárlónegyed.</li>\r\n            <li>Délután transzfer a repülőtérre.</li>\r\n            <li>Elutazás Európába, éjszaka a repülőn.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>9. nap: Érkezés Budapestre<br>\r\n          <ul>\r\n            <li>Megérkezés Budapestre a délelőtti órákban.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>Részvételi díj tartalmazza:<br>\r\n          <ul>\r\n            <li>Repülőjegy Budapest–Tokió / Oszaka–Budapest útvonalon.</li>\r\n            <li>Transzferek a repülőterek és szállodák között.</li>\r\n            <li>7 éjszaka szállás 4 csillagos hotelekben, kétágyas szobákban.</li>\r\n            <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n            <li>Programban szereplő kirándulások és városnézések, magyar nyelvű idegenvezetővel.</li>\r\n            <li>Belépők a programban szereplő látnivalókhoz.</li>\r\n            <li>Shinkansen gyorsvonat-jegy Tokió–Kiotó útvonalon.</li>\r\n            <li>Utasbiztosítás.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>Fakultatív programok (külön fizetendők):<br>\r\n          <ul>\r\n            <li>Tradicionális japán vacsora Kiotóban (kaiseki menü, helyi étteremben).</li>\r\n            <li>Teaceremónia részvétel.</li>\r\n            <li>Japán fürdő (onsen) látogatás.</li>\r\n            <li>Ebéd és egyéni kiadások.</li>\r\n          </ul>\r\n        </p><hr>\r\n\r\n        <p>Ár: 799.000 Ft / fő</p><hr>\r\n\r\n        <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n    </div>\r\n\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/japan_t.jpg\" alt=\"Japán utazás\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 14, 2, '/oldal/images/japan2.jpg'),
(16, 'trip-netherlands-spring', 'Hollandia', 240000, '2026-04-15', '2026-04-20', '/oldal/images/netherlands.jpg', '/trip-netherlands-spring', 'Hollandia', NULL, NULL, 0, NULL, 240000, '<div class=\"site-section\">\r\n\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Hollandiai csoportos utazás – 5 nap / 4 éjszaka</b><hr>\r\n\r\n      <p>1. nap: Érkezés Amszterdamba<br>\r\n        <ul>\r\n          <li>Indulás Budapestről közvetlen járattal Amszterdamba.</li>\r\n          <li>Érkezés után transzfer a 4 csillagos szállodába.</li>\r\n          <li>Szállás elfoglalása, rövid pihenő.</li>\r\n          <li>Délután séta a közeli csatornák mentén, első benyomások a városról.</li>\r\n          <li>Este közös vacsora egy hangulatos helyi étteremben, ismerkedés a csoporttal.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>2. nap: Amszterdam felfedezése<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos városnézés Amszterdamban.</li>\r\n          <li>Rijksmuseum és Van Gogh Múzeum megtekintése.</li>\r\n          <li>Séta a híres virágpiacon és a Dam téren.</li>\r\n          <li>Délután hajós városnézés az amszterdami csatornákon.</li>\r\n          <li>Szabadprogram a belvárosban: vásárlási lehetőség, kávézók, galériák.</li>\r\n          <li>Este fakultatív vacsora a csatornák mentén, hangulatos környezetben.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>3. nap: Kirándulás a szélmalmok és sajt hazájába<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos kirándulás Zaanse Schans és Volendam térségébe.</li>\r\n          <li>Szélmalmok, hagyományos holland falvak megtekintése.</li>\r\n          <li>Sajtkészítő műhely látogatása és kóstoló.</li>\r\n          <li>Délután séta a tengerparti Volendamban, ebéd egy halétteremben (opcionális).</li>\r\n          <li>Visszautazás Amszterdamba, vacsora a szállodában.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>4. nap: Szabadprogram és fakultatív programok<br>\r\n        <ul>\r\n          <li>Reggeli után szabadprogram.</li>\r\n          <li>Javasolt fakultatív programok:</li>\r\n          <li>Kirándulás Hágába és Delft városába.</li>\r\n          <li>Kerékpártúra Amszterdam környékén.</li>\r\n          <li>Heineken Experience látogatás és sörkóstoló.</li>\r\n          <li>Este búcsúvacsora egy tradicionális holland étteremben, helyi specialitásokkal.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>5. nap: Hazautazás<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Szabadidő a délelőtt folyamán, utolsó séták a városban.</li>\r\n          <li>Transzfer a repülőtérre.</li>\r\n          <li>Visszautazás Budapestre.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Részvételi díj tartalmazza:<br>\r\n        <ul>\r\n          <li>Repülőjegy Budapest–Amszterdam–Budapest útvonalon.</li>\r\n          <li>Transzferek a repülőtér és a szálloda között.</li>\r\n          <li>4 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li>\r\n          <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n          <li>Programban szereplő városnézések és kirándulások magyar nyelvű idegenvezetővel.</li>\r\n          <li>Belépők a megadott látnivalókhoz.</li>\r\n          <li>Utasbiztosítás.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br>\r\n        <ul>\r\n          <li>Ebéd és egyéni fakultatív programok díjai.</li>\r\n          <li>Belépők a nem szereplő látnivalókhoz.</li>\r\n          <li>Személyes költségek.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Ár: 240.000 Ft / fő</p><hr>\r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n    </div>\r\n\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/netherlands.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 8, 2, '/oldal/images/netherlands2.jpg'),
(18, 'trip-morocco-spring', 'Marokkó', 280000, '2026-03-18', '2026-03-24', '/oldal/images/morocco.jpg', '/trip-morocco-spring', 'Marokkó', NULL, NULL, 0, NULL, 280000, '<div class=\"site-section\">\r\n\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Marokkói csoportos utazás – 6 nap / 5 éjszaka</b><hr>\r\n\r\n      <p>1. nap: Érkezés Casablancába<br>\r\n        <ul>\r\n          <li>Indulás Budapestről közvetlen vagy átszállásos járattal Casablancába.</li>\r\n          <li>Érkezés után transzfer a szállodába (4 csillagos, központi elhelyezkedésű hotel).</li>\r\n          <li>Szobák elfoglalása, rövid pihenő.</li>\r\n          <li>Este csoportos vacsora, ismerkedés az idegenvezetővel és a csoporttal.</li>\r\n          <li>Rövid tájékoztató Marokkó történelméről és a következő napok programjáról.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>2. nap: Casablanca – Rabat<br>\r\n        <ul>\r\n          <li>Reggeli után városnézés Casablancában:</li>\r\n          <li>Hassan II. mecset megtekintése (Afrika legnagyobb mecsete).</li>\r\n          <li>Tengerparti sétány (Corniche) és a város modern negyedei.</li>\r\n          <li>Délután utazás Rabatba, Marokkó elegáns fővárosába.</li>\r\n          <li>Kirándulás a Királyi Palotához, a Hasszán-toronyhoz és a Mauzóleumhoz.</li>\r\n          <li>Szállás Rabatban, vacsora a szállodában.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>3. nap: Rabat – Meknès – Volubilis – Fès<br>\r\n        <ul>\r\n          <li>Reggeli után utazás Fès irányába, útközben két fontos megállóval:</li>\r\n          <li>Meknès városnézés – a marokkói királyi városok egyike, Bab Mansour kapu megtekintése.</li>\r\n          <li>Látogatás az ókori római romvárosban, Volubilisben (UNESCO Világörökség).</li>\r\n          <li>Délután érkezés Fèsbe, a kulturális fővárosba.</li>\r\n          <li>Szállás elfoglalása, vacsora a szállodában.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>4. nap: Fès – a tradíciók városa<br>\r\n        <ul>\r\n          <li>Egész napos városnézés Fèsben:</li>\r\n          <li>A medina (óváros) sikátorai, régi bőr- és textilműhelyek megtekintése.</li>\r\n          <li>Ne Bou Inania medresze és a Kairouyine mecset kívülről.</li>\r\n          <li>Kézművesek utcája és a híres cserzőműhelyek látogatása.</li>\r\n          <li>Ebéd egy helyi étteremben (opcionális).</li>\r\n          <li>Délután szabadidő, vásárlási lehetőség a bazárban.</li>\r\n          <li>Este vacsora és pihenés.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>5. nap: Fès – Marrakech<br>\r\n        <ul>\r\n          <li>Reggeli után utazás Marrakechbe, festői hegyvidéki tájakon keresztül.</li>\r\n          <li>Délután megérkezés, majd rövid városnézés:</li>\r\n          <li>Majorelle kert, Bahia palota és a híres Djemaa el-Fna tér meglátogatása.</li>\r\n          <li>Esti program: fakultatív vacsora egy tradicionális marokkói étteremben élő zenével és hastáncos műsorral.</li>\r\n          <li>Szállás Marrakechről közelében.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>6. nap: Hazautazás<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Szabadprogram, vásárlás vagy pihenés a medinában.</li>\r\n          <li>Transzfer a repülőtérre és visszautazás Budapestre.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Részvételi díj tartalmazza:<br>\r\n        <ul>\r\n          <li>Repülőjegy Budapest–Casablanca / Marrakech–Budapest útvonalon.</li>\r\n          <li>Transzferek a repülőtér és a szállodák között.</li>\r\n          <li>5 éjszaka szállás 4 csillagos hotelekben, kétágyas szobákban.</li>\r\n          <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n          <li>Programban szereplő városnézések és kirándulások, magyar nyelvű idegenvezetővel.</li>\r\n          <li>Belépők a megadott látnivalókhoz.</li>\r\n          <li>Utasbiztosítás.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br>\r\n        <ul>\r\n          <li>Esti folklórvacsora Marrakechről.</li>\r\n          <li>Szahara kirándulás (egynapos túra, teveháton, külön díj ellenében).</li>\r\n          <li>Ebéd és személyes kiadások.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Ár: 280.000 Ft / fő</p><hr>\r\n\r\n<p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> </div>\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/morocco.jpg\" alt=\"Marokkó\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 5, 2, '/oldal/images/morocco2.jpg'),
(19, 'trip-iceland-summer', 'Izland', 590000, '2026-06-18', '2026-06-25', '/oldal/images/iceland.jpg', '/trip-iceland-summer', 'Izland', NULL, NULL, 0, NULL, 590000, '<div class=\"site-section\">\r\n\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Izlandi csoportos utazás – 8 nap / 7 éjszaka</b><hr>\r\n\r\n      <p>1. nap: Érkezés Reykjavikba<br>\r\n        <ul>\r\n          <li>Indulás Budapestről menetrend szerinti járattal Reykjavikba.</li>\r\n          <li>Érkezés után transzfer a szállodába (3–4 csillagos kategória).</li>\r\n          <li>Szállás elfoglalása, rövid pihenő.</li>\r\n          <li>Este csoportos vacsora, tájékoztató az előttünk álló programokról.</li>\r\n          <li>Séta Reykjavik belvárosában: kikötő, Harpa koncertterem, Hallgrímskirkja templom.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>2. nap: Aranykör túra – Izland legikonikusabb látnivalói<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Egész napos buszos kirándulás az Aranykör mentén.</li>\r\n          <li>Thingvellir Nemzeti Park – az eurázsiai és észak-amerikai kőzetlemezek találkozása.</li>\r\n          <li>Geysir gejzírmező és a híres Strokkur kitörése.</li>\r\n          <li>Gullfoss, az „arany vízesés” megtekintése.</li>\r\n          <li>Visszatérés a szállodába, vacsora.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>3. nap: Dél-parti vízesések és fekete homokos tengerpart<br>\r\n        <ul>\r\n          <li>Reggeli után kirándulás Izland déli partvidékére.</li>\r\n          <li>Seljalandsfoss és Skógafoss vízesések megtekintése.</li>\r\n          <li>Séta a híres Reynisfjara fekete homokos tengerparton.</li>\r\n          <li>Vulkáni formák, bazaltoszlopok és drámai tengerparti sziklák.</li>\r\n          <li>Szállás és vacsora a környéken.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>4. nap: Skaftafell és Jökulsárlón gleccserlagúna<br>\r\n        <ul>\r\n          <li>Reggeli után utazás kelet felé a Vatnajökull Nemzeti Parkba.</li>\r\n          <li>Séta a Skaftafell nemzeti parkban, kilátás a gleccserekre.</li>\r\n          <li>Jökulsárlón gleccserlagúna – jéghegyek és fókák megfigyelése hajótúrán.</li>\r\n          <li>Diamond Beach látogatása, ahol a jégtáblák a fekete homokra sodródnak.</li>\r\n          <li>Visszautazás, vacsora és pihenés.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>5. nap: Reykjavik és a Kék Lagúna<br>\r\n        <ul>\r\n          <li>Reggeli után visszautazás Reykjavikba.</li>\r\n          <li>Útközben megálló a híres Kék Lagúnánál, fürdőzési lehetőség a geotermikus vízben.</li>\r\n          <li>Délután szabadprogram Reykjavikban: múzeumok, üzletek, éttermek.</li>\r\n          <li>Este fakultatív vacsora a kikötőben friss tengeri ételekkel.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>6. nap: Snæfellsnes-félsziget – „Mini Izland”<br>\r\n        <ul>\r\n          <li>Egész napos kirándulás a Snæfellsnes-félszigetre.</li>\r\n          <li>Látogatás a híres Kirkjufell hegy és vízesés környékén.</li>\r\n          <li>Arnarstapi halászfalu, lávamezők és óceáni sziklák.</li>\r\n          <li>Snæfellsjökull gleccser megtekintése (időjárás függvényében).</li>\r\n          <li>Visszatérés a szállodába, vacsora.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>7. nap: Szabadprogram, fakultatív kirándulások<br>\r\n        <ul>\r\n          <li>Reggeli után egész nap szabadidő.</li>\r\n          <li>Javasolt fakultatív programok:</li>\r\n          <li>Whale watching – bálnales hajóval a reykjaviki öbölben.</li>\r\n          <li>Lávabarlang túra vagy ATV kaland a lávamezőkön.</li>\r\n          <li>Este búcsúvacsora a csoporttal egy helyi étteremben.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>8. nap: Hazautazás<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Transzfer a repülőtérre.</li>\r\n          <li>Visszautazás Budapestre.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Részvételi díj tartalmazza:<br>\r\n        <ul>\r\n          <li>Repülőjegy Budapest–Reykjavik–Budapest útvonalon.</li>\r\n          <li>Transzferek a repülőtér és a szálloda között.</li>\r\n          <li>7 éjszaka szállás 3–4 csillagos szállodákban, kétágyas szobákban.</li>\r\n          <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n          <li>Programban szereplő kirándulások magyar nyelvű idegenvezetővel.</li>\r\n          <li>Belépők a programban szereplő helyszínekre.</li>\r\n          <li>Utasbiztosítás.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br>\r\n        <ul>\r\n          <li>Whale watching túra.</li>\r\n          <li>Kék Lagúna belépő és fürdőzés.</li>\r\n          <li>Ebéd és személyes kiadások.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Ár: 590.000 Ft / fő</p><hr>\r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n    </div>\r\n\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/iceland.jpg\" alt=\"Image\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 28, 3, '/oldal/images/iceland2.webp');
INSERT INTO `destination` (`id`, `slug`, `title`, `price_huf`, `start_date`, `end_date`, `image_path`, `detail_url`, `name`, `country`, `description`, `is_global`, `user_id`, `ar`, `leiras`, `foglallimit`, `evszak`, `image2_path`) VALUES
(20, 'trip-canada-summer', 'Kanada', 895000, '2026-07-10', '2026-07-20', '/oldal/images/canada.jpg', '/trip-canada-summer', 'Kanada', NULL, NULL, 0, NULL, 895000, '<div class=\"site-section\">\r\n\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Kanadai csoportos utazás – 11 nap / 9 éjszaka</b><hr>\r\n\r\n      <p>1. nap: Érkezés Torontóba<br>\r\n        <ul>\r\n          <li>Indulás Budapestről menetrend szerinti járattal Torontóba.</li>\r\n          <li>Érkezés után transzfer a belvárosi szállodába (4 csillagos).</li>\r\n          <li>Szállás elfoglalása, rövid pihenő.</li>\r\n          <li>Este csoportos vacsora és rövid tájékoztató a programról.</li>\r\n          <li>Könnyű esti séta a városközpontban, CN Tower kivilágítása.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>2. nap: Toronto városnézés és a CN Tower<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Egész napos városnézés Kanadának legnagyobb városában.</li>\r\n          <li>Belvárosi séta: Queen’s Park, városháza, Ontario-tó partja.</li>\r\n          <li>Felvonózás a híres CN Tower kilátóba.</li>\r\n          <li>Délután szabadprogram, fakultatív hajókázás a Toronto-szigetek körül.</li>\r\n          <li>Vacsora egy helyi étteremben, visszatérés a szállodába.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>3. nap: Niagara-vízesés<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos kirándulás a világ egyik leglátványosabb természeti csodájához, a Niagara-vízeséshez.</li>\r\n          <li>Hajókirándulás a vízesés lábához (Hornblower Cruise).</li>\r\n          <li>Látogatás a festői Niagara-on-the-Lake városkában.</li>\r\n          <li>Borkóstoló egy helyi pincészetben, híres jégborral.</li>\r\n          <li>Visszautazás Torontóba, vacsora.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>4. nap: Utazás Ottawába – Kanada fővárosa<br>\r\n        <ul>\r\n          <li>Reggeli után indulás buszunkkal Ottawába.</li>\r\n          <li>Útközben pihenők és fotómegállók a festői Ontario-tó mentén.</li>\r\n          <li>Érkezés után városnézés: Parlament-domb, Peace Tower, Rideau-csatorna.</li>\r\n          <li>Szállás elfoglalása, vacsora a belvárosban.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>5. nap: Montreal felfedezése<br>\r\n        <ul>\r\n          <li>Reggeli után továbbutazás Quebec tartományba, Montreal városába.</li>\r\n          <li>Városnézés: Notre-Dame Bazilika, Óváros, Mount Royal kilátó.</li>\r\n          <li>Délután szabadprogram, vásárlási lehetőség.</li>\r\n          <li>Este fakultatív vacsora egy francia stílusú bisztróban.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>6. nap: Quebec City – az európai hangulatú város<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos kirándulás Quebec Citybe.</li>\r\n          <li>Séta az UNESCO Világörökség részét képező óvárosban.</li>\r\n          <li>Château Frontenac, Citadella, Terrasse Dufferin sétány megtekintése.</li>\r\n          <li>Szabadidő, majd visszautazás Montrealba, vacsora és pihenés.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>7. nap: Utazás a Szent Lőrinc-folyó mentén – természet és kultúra<br>\r\n        <ul>\r\n          <li>Reggeli után indulás kelet felé a Szent Lőrinc-folyó mentén.</li>\r\n          <li>Megálló a Mauricie Nemzeti Parkban – séta a kanadai erdőkben.</li>\r\n          <li>Délután szállás elfoglalása a környéken, vacsora.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>8. nap: Utazás Calgaryba (repüléssel) – Nyugat-Kanada kapuja<br>\r\n        <ul>\r\n          <li>Reggeli után transzfer a repülőtérre, repülés Calgaryba.</li>\r\n          <li>Érkezés után városnézés: Calgary Tower, Stephen Avenue, Stampede Park.</li>\r\n          <li>Szállás elfoglalása, vacsora és pihenés.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>9. nap: Banff Nemzeti Park – a Sziklás-hegység csodái<br>\r\n        <ul>\r\n          <li>Egész napos kirándulás Banff Nemzeti Parkba.</li>\r\n          <li>Séta a Banff városkában, Banff-fürdők megtekintése.</li>\r\n          <li>Felvonóval a Sulphur Mountain csúcsára – lenyűgöző panoráma.</li>\r\n          <li>Látogatás a Bow Falls vízeséshez.</li>\r\n          <li>Vacsora, szállás Banff környékén.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>10. nap: Lake Louise és a Jasper Nemzeti Park<br>\r\n        <ul>\r\n          <li>Reggeli után utazás a híres Lake Louise tóhoz.</li>\r\n          <li>Rövid séta a türkizkék tó partján, fotózási lehetőség.</li>\r\n          <li>Továbbutazás a Columbia-jégmező felé, jégjáró buszos túra a gleccseren.</li>\r\n          <li>Délután visszautazás Calgaryba, búcsúvacsora a csoporttal.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>11. nap: Hazautazás<br>\r\n        <ul>\r\n          <li>Reggeli után transzfer a repülőtérre.</li>\r\n          <li>Visszautazás Budapestre.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Részvételi díj tartalmazza:<br>\r\n        <ul>\r\n          <li>Repülőjegy Budapest–Toronto, Calgary–Budapest útvonalon.</li>\r\n          <li>Belföldi repülőjárat Montreal–Calgary között.</li>\r\n          <li>Transzferek a repülőtér és a szállodák között.</li>\r\n          <li>9 éjszaka szállás 3–4 csillagos szállodákban, kétágyas elhelyezéssel.</li>\r\n          <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n          <li>Programban szereplő kirándulások magyar nyelvű idegenvezetővel.</li>\r\n          <li>Belépők a programban szereplő helyszínekre.</li>\r\n          <li>Utasbiztosítás.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br>\r\n        <ul>\r\n          <li>CN Tower belépő (ha nem szerepel a csomagban).</li>\r\n          <li>Hajótúra a Niagara-vízesésnél.</li>\r\n          <li>Borkóstoló Niagara-on-the-Lake borvidéken.</li>\r\n          <li>Whale watching a Szent Lőrinc-folyón.</li>\r\n          <li>Ebéd és egyéni kiadások.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Ár: 895.000 Ft / fő</p><hr>\r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n    </div>\r\n\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/canada.jpg\" alt=\"Kanada\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 25, 3, '/oldal/images/canada2.jpg'),
(21, 'trip-greece-summer', 'Görögország', 395000, '2026-08-05', '2026-08-12', '/oldal/images/greece.jpg', '/trip-greece-summer', 'Görögország', NULL, NULL, 0, NULL, 395000, '<div class=\"site-section\">\r\n  <div class=\"container\">\r\n  </div>\r\n\r\n  <div class=\"row mt-5 pt-5\">\r\n    <div class=\"col-md-6\">\r\n      <p><b>Görögországi csoportos utazás – 8 nap / 7 éjszaka</b><hr>\r\n\r\n      <p>1. nap: Érkezés Athénba<br>\r\n        <ul>\r\n          <li>Indulás Budapestről közvetlen járattal Athénba.</li>\r\n          <li>Érkezés után transzfer a tengerparti szállodába (4 csillagos, a Saronikos-öböl partján).</li>\r\n          <li>Szállás elfoglalása, rövid pihenő a tengerparton.</li>\r\n          <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li>\r\n          <li>Rövid tájékoztató a programról és Görögországról.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>2. nap: Athén – az ókori világ fővárosa<br>\r\n        <ul>\r\n          <li>Reggeli a szállodában.</li>\r\n          <li>Egész napos városnézés Athénban:</li>\r\n          <li>Akropolisz és a Parthenón meglátogatása.</li>\r\n          <li>Új Akropolisz Múzeum megtekintése.</li>\r\n          <li>Séta a Plaka negyedben, ebéd egy hangulatos tavernában (opcionális).</li>\r\n          <li>Délután szabadprogram, majd visszatérés a szállodába.</li>\r\n          <li>Esti fakultatív program: vacsora panorámás étteremben az Akropolisz kilátásával.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>3. nap: Korinthosz és a Peloponnészosz-félsziget<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos kirándulás a Peloponnészosz-félszigetre.</li>\r\n          <li>Megálló a híres Korinthoszi-csatornánál.</li>\r\n          <li>Látogatás az ókori Mykéné és Epidaurosz régészeti területén.</li>\r\n          <li>Délután rövid séta Nafplio hangulatos kikötővárosában.</li>\r\n          <li>Visszatérés a szállodába, vacsora.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>4. nap: Delfi – az istenek szentélye<br>\r\n        <ul>\r\n          <li>Reggeli után kirándulás a Parnasszosz-hegység lábánál fekvő Delfibe.</li>\r\n          <li>Az Apollón-szentély és a delfii jósda megtekintése.</li>\r\n          <li>Látogatás a Delfi Régészeti Múzeumban.</li>\r\n          <li>Ebéd egy helyi étteremben (opcionális).</li>\r\n          <li>Délután visszautazás Athénba, vacsora és pihenés.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>5. nap: Egina-sziget hajókirándulás<br>\r\n        <ul>\r\n          <li>Reggeli után egész napos fakultatív hajókirándulás az Égei-tengerre.</li>\r\n          <li>Látogatás Egina-szigetén, séta az óvárosban és az Aphaia-templomnál.</li>\r\n          <li>Fürdés, vásárlás és szabadprogram a kikötőben.</li>\r\n          <li>Délután visszahajózás Pireuszba, vacsora a szállodában.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>6. nap: Szabadprogram és pihenés a tengerparton<br>\r\n        <ul>\r\n          <li>Reggeli után egész nap szabadprogram.</li>\r\n          <li>Pihenés a tengerparton vagy a szálloda medencéjénél.</li>\r\n          <li>Javasolt fakultatív programok:</li>\r\n          <li>Egynapos kirándulás Hydrára vagy Poroszra.</li>\r\n          <li>Görög főzőtanfolyam helyi séffel.</li>\r\n          <li>Borászat-látogatás Attika környékén.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>7. nap: Sounion – Naplemente a Poszeidón-templomnál<br>\r\n        <ul>\r\n          <li>Délelőtt szabadidő a tengerparton.</li>\r\n          <li>Délután kirándulás Sounionba, Görögország egyik legszebb panorámájához.</li>\r\n          <li>A híres Poszeidón-templom megtekintése naplementében.</li>\r\n          <li>Búcsúvacsora a tengerparti tavernában, élő zenével.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>8. nap: Hazautazás<br>\r\n        <ul>\r\n          <li>Reggeli után kijelentkezés a szállodából.</li>\r\n          <li>Transzfer a repülőtérre.</li>\r\n          <li>Visszautazás Budapestre.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Részvételi díj tartalmazza:<br>\r\n        <ul>\r\n          <li>Repülőjegy Budapest–Athén–Budapest útvonalon.</li>\r\n          <li>Transzferek a repülőtér és a szálloda között.</li>\r\n          <li>7 éjszaka szállás 4 csillagos tengerparti szállodában, kétágyas szobákban.</li>\r\n          <li>Félpanziós ellátás (reggeli és vacsora).</li>\r\n          <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetővel.</li>\r\n          <li>Belépők a megadott látnivalókhoz.</li>\r\n          <li>Utasbiztosítás.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br>\r\n        <ul>\r\n          <li>Egina-sziget hajókirándulás.</li>\r\n          <li>Hydra–Poros hajótúra.</li>\r\n          <li>Főzőtanfolyam vagy borászat-látogatás.</li>\r\n          <li>Ebéd és egyéb személyes kiadások.</li>\r\n        </ul>\r\n      </p><hr>\r\n\r\n      <p>Ár: 395.000 Ft / fő</p><hr>\r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p>\r\n    </div>\r\n\r\n    <div class=\"col-md-6\">\r\n      <img src=\"/oldal/images/greece.jpg\" alt=\"Görögország\" class=\"img-fluid\">\r\n    </div>\r\n  </div>\r\n\r\n</div>\r\n', 24, 3, '/oldal/images/greece2.jpg'),
(25, 'trip-usa-newengland-autumn', 'USA', 780000, '2026-10-10', '2026-10-18', '/oldal/images/usa.jpg', '/trip-usa-newengland-autumn', 'USA', NULL, NULL, 0, NULL, 780000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>USA Keleti part – Csoportos utazás – 9 nap / 7 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Utazás Amerikába<br> \r\n      <ul> \r\n        <li>Indulás Budapestről átszállással New Yorkba.</li> \r\n        <li>Érkezés a John F. Kennedy nemzetközi repülőtérre.</li> \r\n        <li>Transzfer a szállodába Manhattanben (4 csillagos).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este közös vacsora, ismerkedés a csoporttal és az idegenvezetővel.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: New York – A város, ami sosem alszik<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés busszal és gyalogosan:</li> \r\n        <li>Times Square, Broadway, Central Park, Rockefeller Center, 5th Avenue.</li> \r\n        <li>Megálló a Grand Central Terminalnál és a Szent Patrik-székesegyház megtekintése.</li> \r\n        <li>Délután fakultatív program: Empire State Building kilátó (külön díj ellenében).</li> \r\n        <li>Este szabadprogram – vacsora egyéni szervezésben.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Szabadság-szobor és Alsó-Manhattan<br> \r\n      <ul> \r\n        <li>Reggeli után hajókirándulás a Liberty Islandre – a Szabadság-szobor megtekintése.</li> \r\n        <li>Ellátogatás az Ellis Island bevándorlási múzeumba.</li> \r\n        <li>Délután séta Wall Streeten és a 9/11 Emlékműnél.</li> \r\n        <li>Este fakultatív vacsora a Hudson folyó mentén, kilátással Manhattanre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Washington D.C.<br> \r\n      <ul> \r\n        <li>Korai reggeli után buszos kirándulás az Egyesült Államok fővárosába.</li> \r\n        <li>Fehér Ház, Capitolium, Lincoln Memorial és Smithsonian Múzeumok megtekintése.</li> \r\n        <li>Délután szabadidő, majd visszautazás New Yorkba.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Philadelphia és az amerikai függetlenség nyomában<br> \r\n      <ul> \r\n        <li>Reggeli után kirándulás Philadelphiába, az USA születésének városába.</li> \r\n        <li>Independence Hall, Liberty Bell, valamint az óváros megtekintése.</li> \r\n        <li>Délután visszautazás, szabadprogram New Yorkban.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Niagara-vízesés (fakultatív, repüléssel)<br> \r\n      <ul> \r\n        <li>Fakultatív egész napos program: repülés Buffalóba, a Niagara-vízesés meglátogatása.</li> \r\n        <li>Hajókirándulás a vízeséshez a „Maid of the Mist” fedélzetén.</li> \r\n        <li>Visszarepülés este New Yorkba.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>7. nap: Szabadnap New Yorkban<br> \r\n      <ul> \r\n        <li>Reggeli után szabadprogram: vásárlás, múzeumlátogatás, séta a Central Parkban.</li> \r\n        <li>Javasolt fakultatív programok:</li> \r\n        <li>Metropolitan Múzeum, Guggenheim, Brooklyn-híd séta, esti Broadway musical.</li> \r\n        <li>Este közös búcsúvacsora egy hangulatos amerikai étteremben.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>8. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli, kijelentkezés a szállodából.</li> \r\n        <li>Transzfer a repülőtérre, hazautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>9. nap: Érkezés Budapestre<br> \r\n      <ul> \r\n        <li>Érkezés Budapestre a délelőtti órákban.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–New York–Budapest útvonalon (átszállással).</li> \r\n        <li>Transzferek a repülőtér és a szállás között.</li> \r\n        <li>7 éjszaka szállás 4 csillagos szállodákban, kétágyas szobákban.</li> \r\n        <li>Reggeli mindennap, két közös vacsora.</li> \r\n        <li>Programban szereplő városnézések magyar nyelvű idegenvezetővel.</li> \r\n        <li>Busszal történő kirándulások Washingtonba és Philadelphiába.</li> \r\n        <li>Belépők a megadott látnivalókhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Niagara-vízesés kirándulás (repüléssel).</li> \r\n        <li>Empire State Building kilátó.</li> \r\n        <li>Broadway musical jegy.</li> \r\n        <li>Egyéni étkezések, személyes kiadások.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 780.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/usa.jpg\" alt=\"USA utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 16, 4, '/oldal/images/usa2.jpg'),
(26, 'trip-france-autumn', 'Franciaország', 390000, '2026-09-20', '2026-09-25', '/oldal/images/france.jpg', '/trip-france-autumn', 'Franciaország', NULL, NULL, 0, NULL, 390000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>Franciaországi csoportos utazás – 6 nap / 5 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Érkezés Párizsba<br> \r\n      <ul> \r\n        <li>Indulás Budapestről közvetlen járattal Párizsba.</li> \r\n        <li>Érkezés a Charles de Gaulle repülőtérre, transzfer a szállodába (4 csillagos, központi elhelyezkedésű).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este közös vacsora egy hangulatos párizsi étteremben, ismerkedés a csoporttal.</li> \r\n        <li>Tájékoztató a programról és a következő napokról.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: Párizs felfedezése – klasszikus látnivalók<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés Párizsban magyar nyelvű idegenvezetővel:</li> \r\n        <li>Eiffel-torony (2. szint), Diadalív, Champs-Élysées, Trocadéro tér.</li> \r\n        <li>Seine-parti séta, hajókirándulás a folyón (belépő benne a programban).</li> \r\n        <li>Délután Louvre Múzeum látogatás (opcionális belépővel).</li> \r\n        <li>Este szabadprogram vagy fakultatív vacsora a Montmartre negyedben.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Versailles és a francia királyok nyomában<br> \r\n      <ul> \r\n        <li>Reggeli után buszos kirándulás Versailles-ba.</li> \r\n        <li>A világhírű Versailles-i kastély és park megtekintése, belépővel és vezetett túrával.</li> \r\n        <li>Délután visszautazás Párizsba, szabadidő a belvárosban.</li> \r\n        <li>Este fakultatív program: kabaréest a híres Moulin Rouge-ban (külön díj ellenében).</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Giverny és Rouen – Normandia hangulatában<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában, majd kirándulás Normandiába.</li> \r\n        <li>Megálló Giverny-ben, Claude Monet házának és kertjének megtekintése.</li> \r\n        <li>Továbbutazás Rouenbe, a híres Notre-Dame székesegyház és a Jeanne d’Arc emlékhely meglátogatása.</li> \r\n        <li>Délután visszautazás Párizsba, vacsora a szállodában.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Szabadprogram Párizsban és búcsúvacsora<br> \r\n      <ul> \r\n        <li>Reggeli után egész napos szabadprogram:</li> \r\n        <li>Lehetőség egyéni felfedezésre – vásárlás, kávézók, múzeumok látogatása.</li> \r\n        <li>Javasolt fakultatív programok:</li> \r\n        <li>Orsay Múzeum, Latin negyed séta, Sainte-Chapelle megtekintése.</li> \r\n        <li>Este közös búcsúvacsora egy tradicionális francia bisztróban, élő zenével.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában, kijelentkezés.</li> \r\n        <li>Transzfer a repülőtérre.</li> \r\n        <li>Visszautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–Párizs–Budapest útvonalon.</li> \r\n        <li>Transzferek a repülőtér és a szállás között.</li> \r\n        <li>5 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li> \r\n        <li>Félpanziós ellátás (reggeli és vacsora).</li> \r\n        <li>Programban szereplő városnézések és kirándulások magyar nyelvű idegenvezetővel.</li> \r\n        <li>Belépők a programban feltüntetett látnivalókhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Moulin Rouge kabaréest.</li> \r\n        <li>Louvre belépő és vezetett túra.</li> \r\n        <li>Egyéni ebédek, személyes költségek.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 390.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/france.jpg\" alt=\"Franciaország utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 14, 4, '/oldal/images/france2.jpg'),
(27, 'trip-austria-winter', 'Ausztria', 220000, '2026-12-15', '2026-12-20', '/oldal/images/austria.jpg', '/trip-austria-winter', 'Ausztria', NULL, NULL, 0, NULL, 220000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>Ausztriai csoportos utazás – 6 nap / 5 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Érkezés Bécsbe<br> \r\n      <ul> \r\n        <li>Indulás Budapestről közvetlen járattal Bécsbe.</li> \r\n        <li>Transzfer a szállodába (4 csillagos, központi elhelyezkedésű).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este közös vacsora a szálloda éttermében, ismerkedés a csoporttal.</li> \r\n        <li>Tájékoztató a programról és az Ausztriában tervezett látnivalókról.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: Bécs városnézés<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés Bécsben magyar nyelvű idegenvezetéssel:</li> \r\n        <li>Hofburg-palota, Szent István-székesegyház, Ringstraße és Belvedere palota megtekintése.</li> \r\n        <li>Délután szabadprogram vagy látogatás a híres Práter vidámparkban.</li> \r\n        <li>Este fakultatív program: klasszikus bécsi koncert vagy opera (külön díj ellenében).</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Salzburg és a Salzkammergut régió<br> \r\n      <ul> \r\n        <li>Reggeli után buszos kirándulás Salzburgba.</li> \r\n        <li>Salzburg történelmi belvárosának felfedezése: Mozart szülőháza, Mirabell-kert, Salzburgi Dóm.</li> \r\n        <li>Délután rövid kirándulás a Salzkammergut tavakhoz és hegyekhez, fotószünetekkel.</li> \r\n        <li>Visszatérés a bécsi szállodába, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Innsbruck – Alpok varázsa<br> \r\n      <ul> \r\n        <li>Reggeli után buszos kirándulás Innsbruckba.</li> \r\n        <li>Városnézés: Aranytető, Hofkirche, városi séták a történelmi belvárosban.</li> \r\n        <li>Lehetőség felvonózásra a Nordkette hegyekbe a lenyűgöző panoráma megtekintéséhez.</li> \r\n        <li>Délután visszautazás Bécsbe, vacsora a szállodában.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Szabadprogram és fakultatív programok<br> \r\n      <ul> \r\n        <li>Reggeli után szabadprogram Bécsben:</li> \r\n        <li>Vásárlás a Mariahilferstraße-n, kávézás híres kávéházakban.</li> \r\n        <li>Javasolt fakultatív programok:</li> \r\n        <li>Belépés a Kunsthistorisches Museum vagy Schönbrunni kastély látogatása.</li> \r\n        <li>Este búcsúvacsora tradicionális osztrák éttermben, élő zenével.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában, kijelentkezés.</li> \r\n        <li>Transzfer a repülőtérre.</li> \r\n        <li>Visszautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–Bécs–Budapest útvonalon.</li> \r\n        <li>Transzferek a repülőtér és a szálloda között.</li> \r\n        <li>5 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li> \r\n        <li>Félpanziós ellátás (reggeli és vacsora).</li> \r\n        <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetéssel.</li> \r\n        <li>Belépők a megadott látványosságokhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Bécsi koncert vagy opera.</li> \r\n        <li>Belépők a Schönbrunni kastélyba vagy a Kunsthistorisches Museum-ba.</li> \r\n        <li>Egyéni ebédek és személyes költségek.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 220.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/austria.jpg\" alt=\"Ausztriai utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 25, 1, '/oldal/images/austria2.webp'),
(28, 'trip-finland-winter', 'Finnország', 360000, '2027-01-18', '2027-01-24', '/oldal/images/finland.jpg', '/trip-finland-winter', 'Finnország', NULL, NULL, 0, NULL, 360000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>Finnországi csoportos utazás – 7 nap / 6 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Érkezés Helsinkibe<br> \r\n      <ul> \r\n        <li>Indulás Budapestről közvetlen járattal Helsinkibe.</li> \r\n        <li>Transzfer a szállodába (4 csillagos, központi elhelyezkedésű).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li> \r\n        <li>Rövid tájékoztató a programról és Finnországról.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: Helsinki városnézés<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés Helsinki történelmi és modern látnivalóival:</li> \r\n        <li>Székesegyház, Temppeliaukio-templom, Szépművészeti Múzeum.</li> \r\n        <li>Szabadprogram és ebéd a városban (opcionális).</li> \r\n        <li>Este fakultatív program: sétahajózás a finn szigetek között (külön díj ellenében).</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Porvoo és Lappeenranta<br> \r\n      <ul> \r\n        <li>Reggeli után kirándulás a hangulatos Porvoo városába.</li> \r\n        <li>Séta a régi városrész macskaköves utcáin, helyi kézműves boltok látogatása.</li> \r\n        <li>Délután Lappeenrantába utazás, városnézés a Saimaa-tó környékén.</li> \r\n        <li>Visszatérés a helsinki szállodába, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Finnországi tavak és természet<br> \r\n      <ul> \r\n        <li>Reggeli után egész napos kirándulás a finn tavak vidékére.</li> \r\n        <li>Hajókirándulás a Saimaa-tavon, rövid túra a környező erdőkben.</li> \r\n        <li>Pihenés a természetben, fotószünetek.</li> \r\n        <li>Visszatérés Helsinkibe, vacsora a szállodában.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Rovaniemi és a Mikulás falva<br> \r\n      <ul> \r\n        <li>Reggeli után repülő vagy busz Rovaniemibe (opcionális fakultatív program).</li> \r\n        <li>Látogatás a híres Mikulás falvában, találkozás a Mikulással és szuvenírek vásárlása.</li> \r\n        <li>Lehetőség szánhúzó kutya vagy rénszarvas szafari kipróbálására.</li> \r\n        <li>Visszautazás Helsinkibe, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Szabadprogram és fakultatív programok<br> \r\n      <ul> \r\n        <li>Reggeli után szabadprogram Helsinkiben:</li> \r\n        <li>Vásárlás, kávézás híres kávéházakban, séták a tengerparton.</li> \r\n        <li>Javasolt fakultatív programok:</li> \r\n        <li>Helsinki akvárium vagy modern művészeti múzeum látogatása.</li> \r\n        <li>Este búcsúvacsora egy tradicionális finn étteremben, élő zenével.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>7. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Transzfer a repülőtérre.</li> \r\n        <li>Visszautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–Helsinki–Budapest útvonalon.</li> \r\n        <li>Transzferek a repülőtér és a szálloda között.</li> \r\n        <li>6 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li> \r\n        <li>Félpanziós ellátás (reggeli és vacsora).</li> \r\n        <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetéssel.</li> \r\n        <li>Belépők a megadott látnivalókhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Sétahajózás a finn szigetek között.</li> \r\n        <li>Szánhúzó kutya vagy rénszarvas szafari Rovaniemiben.</li> \r\n        <li>Egyéni ebéd és személyes költségek.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 360.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/finland.jpg\" alt=\"Finnországi utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 26, 1, '/oldal/images/finland2.jpg'),
(29, 'trip-thailand-winter', 'Thaiföld', 550000, '2027-02-04', '2027-02-12', '/oldal/images/thailand.jpg', '/trip-thailand-winter', 'Thaiföld', NULL, NULL, 0, NULL, 550000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>Thaiföldi csoportos utazás – 9 nap / 8 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Érkezés Bangkokba és ismerkedés<br> \r\n      <ul> \r\n        <li>Indulás Budapestről közvetlen vagy átszállásos járattal Bangkok repülőterére.</li> \r\n        <li>Transzfer a szállodába (4 csillagos, központi elhelyezkedésű).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li> \r\n        <li>Rövid tájékoztató a programról és Thaiföldről.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: Bangkok városnézés<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés Bangkok történelmi látnivalóival:</li> \r\n        <li>Grand Palace, Smaragd Buddha templom, Wat Pho (Fekvő Buddha templom).</li> \r\n        <li>Szabadprogram és ebéd a helyi éttermekben (opcionális).</li> \r\n        <li>Esti fakultatív program: hajózás a Chao Phraya folyón (külön díj ellenében).</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Ayutthaya kirándulás<br> \r\n      <ul> \r\n        <li>Reggeli után egész napos kirándulás Ayutthaya történelmi városába.</li> \r\n        <li>Ősi templomok, romok és múzeumok látogatása.</li> \r\n        <li>Délután visszatérés Bangkokba, szabadprogram, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Utazás Phuket szigetre<br> \r\n      <ul> \r\n        <li>Reggeli után transzfer a repülőtérre, majd rövid belföldi repülőút Phuket szigetére.</li> \r\n        <li>Szállás elfoglalása tengerparti 4 csillagos szállodában.</li> \r\n        <li>Pihenés a tengerparton, vacsora a szállodában.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Phuket és környéke<br> \r\n      <ul> \r\n        <li>Reggeli után egész napos kirándulás Phuket szigetének látnivalóira:</li> \r\n        <li>Big Buddha, Patong Beach, Old Phuket Town felfedezése.</li> \r\n        <li>Szabadprogram, lehetőség fakultatív programokra: snorkelling vagy hajókirándulás (külön díj ellenében).</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Phi Phi szigetek kirándulás<br> \r\n      <ul> \r\n        <li>Egész napos hajókirándulás a híres Phi Phi szigetekre.</li> \r\n        <li>Strandolás, úszás, fotózás a festői környezetben.</li> \r\n        <li>Délután visszatérés a szállodába, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>7. nap: Szabadprogram és fakultatív programok<br> \r\n      <ul> \r\n        <li>Reggeli után szabadprogram a tengerparton vagy a medencénél.</li> \r\n        <li>Javasolt fakultatív programok:</li> \r\n        <li>Thai főzőtanfolyam, elefántfarm látogatás vagy dzsungel túra.</li> \r\n        <li>Este búcsúvacsora egy helyi étteremben, élő zenével.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>8. nap: Phuket – Bangkok<br> \r\n      <ul> \r\n        <li>Reggeli után transzfer a repülőtérre, belföldi repülőút Bangkokba.</li> \r\n        <li>Szabadidő vásárlásra vagy utolsó városnézésre.</li> \r\n        <li>Vacsora a szállodában, pihenés.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>9. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Transzfer a repülőtérre, visszautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–Bangkok–Budapest útvonalon.</li> \r\n        <li>Belföldi repülőút Bangkok–Phuket–Bangkok.</li> \r\n        <li>Transzferek a repülőtértől a szállodáig és vissza.</li> \r\n        <li>8 éjszaka szállás 4 csillagos szállodában, kétágyas szobákban.</li> \r\n        <li>Félpanziós ellátás (reggeli és vacsora).</li> \r\n        <li>Programban szereplő városnézések és kirándulások busszal vagy hajóval, magyar nyelvű idegenvezetővel.</li> \r\n        <li>Belépők a megadott látnivalókhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Hajókirándulás Phi Phi szigetekre.</li> \r\n        <li>Snorkelling, dzsungel túra, elefántfarm látogatás.</li> \r\n        <li>Thai főzőtanfolyam.</li> \r\n        <li>Egyéni ebéd és személyes költségek.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 550.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/thailand.jpg\" alt=\"Thaiföldi utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 28, 1, '/oldal/images/thailand2.jpg'),
(30, 'trip-chile-winter', 'Chile', 790000, '2027-01-22', '2027-01-31', '/oldal/images/chile.jpg', '/trip-chile-winter', 'Chile', NULL, NULL, 0, NULL, 790000, '<div class=\"site-section\"> \r\n  <div class=\"container\"> \r\n  </div> \r\n  <div class=\"row mt-5 pt-5\"> \r\n    <div class=\"col-md-6\"> \r\n      <p><b>Chilei csoportos utazás – 10 nap / 9 éjszaka</b><hr> \r\n\r\n      <p>1. nap: Érkezés Santiago de Chilébe és ismerkedés<br> \r\n      <ul> \r\n        <li>Indulás Budapestről átszállással Santiago repülőterére.</li> \r\n        <li>Transzfer a szállodába (4 csillagos, városközponti elhelyezkedésű).</li> \r\n        <li>Szállás elfoglalása, rövid pihenő.</li> \r\n        <li>Este csoportos vacsora a szálloda éttermében, ismerkedés a csoporttal.</li> \r\n        <li>Rövid tájékoztató a programról és Chiléről.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>2. nap: Santiago városnézés<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Egész napos városnézés Santiago történelmi és kulturális nevezetességein:</li> \r\n        <li>Plaza de Armas, Santiago Katedrális, La Moneda palota.</li> \r\n        <li>Szabadprogram és ebéd a helyi éttermekben (opcionális).</li> \r\n        <li>Esti fakultatív program: kilátó látogatás a San Cristóbal dombon.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>3. nap: Valparaíso és Viña del Mar kirándulás<br> \r\n      <ul> \r\n        <li>Reggeli után egész napos kirándulás a tengerparti városokba.</li> \r\n        <li>Valparaíso színes házai és művészeti negyedeinek felfedezése.</li> \r\n        <li>Viña del Mar strandjai és parkjai.</li> \r\n        <li>Délután visszatérés Santiagóba, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>4. nap: Utazás San Pedro de Atacama felé<br> \r\n      <ul> \r\n        <li>Reggeli után transzfer a repülőtérre, rövid belföldi repülőút Calamába, majd transzfer San Pedro de Atacama-ba.</li> \r\n        <li>Szállás elfoglalása, pihenés a sivatagi hangulatban.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>5. nap: Atacama-sivatag felfedezése<br> \r\n      <ul> \r\n        <li>Egész napos kirándulás az Atacama-sivatag különleges látnivalóira:</li> \r\n        <li>Valle de la Luna, sómezők, lagúnák.</li> \r\n        <li>Naplemente megfigyelése a sivatagban.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>6. nap: Gejzírek és termálforrások<br> \r\n      <ul> \r\n        <li>Reggeli után kirándulás a Tatio gejzírekhez.</li> \r\n        <li>Fürdőzés természetes termálforrásokban.</li> \r\n        <li>Délután visszatérés San Pedro de Atacama-ba, szabadprogram.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>7. nap: Utazás Patagóniába – Punta Arenas<br> \r\n      <ul> \r\n        <li>Reggeli után transzfer a repülőtérre, belföldi repülőút Punta Arenas-ba.</li> \r\n        <li>Szállás elfoglalása, városnézés, vacsora.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>8. nap: Torres del Paine Nemzeti Park<br> \r\n      <ul> \r\n        <li>Egész napos kirándulás a lenyűgöző Torres del Paine Nemzeti Parkba.</li> \r\n        <li>Természetjárás, fotózás a gleccserek, tavak és hegycsúcsok között.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>9. nap: Szabadprogram vagy fakultatív túrák<br> \r\n      <ul> \r\n        <li>Szabadnap a nemzeti parkban vagy fakultatív programok:</li> \r\n        <li>Hajózás a Grey-gleccserhez, lovas túra, helyi fauna megfigyelése.</li> \r\n        <li>Este búcsúvacsora a szállodában.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>10. nap: Hazautazás<br> \r\n      <ul> \r\n        <li>Reggeli a szállodában.</li> \r\n        <li>Transzfer a repülőtérre, belföldi repülőút Santiago de Chilébe, majd visszautazás Budapestre.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Részvételi díj tartalmazza:<br> \r\n      <ul> \r\n        <li>Repülőjegy Budapest–Santiago–Budapest útvonalon.</li> \r\n        <li>Belföldi repülőutak: Santiago–Calama, Punta Arenas–Santiago.</li> \r\n        <li>Transzferek a repülőtértől a szállodáig és vissza.</li> \r\n        <li>9 éjszaka szállás 4 csillagos szállodákban, kétágyas szobákban.</li> \r\n        <li>Félpanziós ellátás (reggeli és vacsora).</li> \r\n        <li>Programban szereplő városnézések és kirándulások busszal, magyar nyelvű idegenvezetővel.</li> \r\n        <li>Belépők a megadott látnivalókhoz.</li> \r\n        <li>Utasbiztosítás.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Fakultatív programok (külön fizetendők):<br> \r\n      <ul> \r\n        <li>Hajózás Grey-gleccserhez.</li> \r\n        <li>Lovas túra, sivatagi túrák, fotózás.</li> \r\n        <li>Egyéni ebéd és személyes költségek.</li> \r\n      </ul> </p><hr> \r\n\r\n      <p>Ár: 790.000 Ft / fő</p><hr> \r\n\r\n      <p><a href=\"/contact\" class=\"btn btn-primary text-white py-3 px-4 my-4\">Kapcsolatfelvétel</a></p> \r\n    </div> \r\n\r\n    <div class=\"col-md-6\"> \r\n      <img src=\"/oldal/images/chile.jpg\" alt=\"Chilei utazás\" class=\"img-fluid\"> \r\n    </div> \r\n  </div> \r\n</div>\r\n', 14, 1, '/oldal/images/chile2.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
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
-- Tábla szerkezet ehhez a táblához `jobs`
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
-- Tábla szerkezet ehhez a táblához `job_batches`
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
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_25_100000_create_destination_table', 2),
(5, '2025_09_25_103300_alter_destination_add_missing_columns', 3),
(6, '2025_09_25_110000_create_reservations_table', 4),
(7, '2025_09_25_111000_alter_reservations_add_fields', 5),
(8, '2025_09_26_000000_add_evszak_to_destination', 6);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notification`
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
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pricewatch`
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
-- Tábla szerkezet ehhez a táblához `reservations`
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
-- Tábla szerkezet ehhez a táblához `route`
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
-- Tábla szerkezet ehhez a táblához `routedestinations`
--

CREATE TABLE `routedestinations` (
  `route_id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('s4z3rybzkWS8WyTYsXvkeVrgaKIS2A5GMvURSYxJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczJpY0FNSWVkeGdtRUpuRkVlaEVteXV1d3lpRXo4NElNMENiUUYzWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmlwL3RyaXAtYXVzdHJpYS13aW50ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1762938893);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
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
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `settings`) VALUES
(3, 'Teszt Felha', 'hkogites@gmail.com', '$2y$12$Owz3HZz1afLnKqAIvAaPlew7Aq3kboxnc6yMzzTbdRyixqlRbqbqC', 'user', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `conditions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A tábla indexei `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destination_slug_unique` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_index` (`user_id`),
  ADD KEY `reservations_destination_id_index` (`destination_id`);

--
-- A tábla indexei `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD PRIMARY KEY (`route_id`,`dest_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `pricewatch`
--
ALTER TABLE `pricewatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_3` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD CONSTRAINT `pricewatch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD CONSTRAINT `routedestinations_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routedestinations_ibfk_2` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `weather_ibfk_1` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
