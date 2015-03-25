-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 25 mars 2015 kl 17:29
-- Serverversion: 5.6.22
-- PHP-version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `codelane-cms`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `assignment` enum('owner','member','reviewer','author') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `assignments`
--

INSERT INTO `assignments` (`id`, `user`, `pm`, `assignment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 26, 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 1, 26, 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 4, 26, 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 2, 26, 'owner', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `parent_comment` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `last_read`
--

CREATE TABLE IF NOT EXISTS `last_read` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `original_files`
--

CREATE TABLE IF NOT EXISTS `original_files` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `filename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pms`
--

CREATE TABLE IF NOT EXISTS `pms` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `expiration_date` date NOT NULL,
  `first_published_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `pms`
--

INSERT INTO `pms` (`id`, `title`, `content`, `token`, `verified`, `created_by`, `expiration_date`, `first_published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Skyddad identitet', '<p>Riktlinje g&auml;llande s&ouml;kande patienter med Skyddad identitet <br /> Med skyddad identitet menas att Skatteverket i s&auml;rskilt beslut givit en person som har hotas till livet <br /> skyddad adress i befolkningsregistret (s&aring; kallad sp&auml;rrmarkering) eller att personen kvarskrivits p&aring; sin <br /> gamla bostadsadress <br /> F&ouml;ljande rutiner &auml;r framtagna f&ouml;r att f&ouml;rhindra att sekretessbelagda personuppgifter i register och journaler <br /> l&auml;mnas ut till obeh&ouml;rig person, vilket kan inneb&auml;ra risk f&ouml;r liv och h&auml;lsa. <br /> <br /> <br /> N&auml;r p ersoner med skyddad identitet skrivs in p&aring; akutmottagningen f&ouml;ljs nedanst&aring;ende rutiner: <br /> <br /> Patienter med Skyddad identitet har ett s&auml;rskilt personnummer som de har f&aring;tt fr&aring;n folkbokf&ouml;ringen. <br /> Namnet &auml;r d&aring; automatiskt bytt till PERSONUPPGIFTEN SKYDDAD <br /> <br /> Dessa personer skall ha Upplysningsskydd i TC <br /> <br /> Fr&aring;ga var patienten vill sitta och v&auml;nta. Vill patienten sitta p&aring; rum ska detta tillgodoses i den m&aring;n det <br /> &auml;r m&ouml;jligt <br /> <br /> Fr&aring;ga hur hon/han vill bli uppropad. Anteckna namn i Kommentarsf&auml;ltet i akutliggaren <br /> <br /> Om patient en ej samtycker till sammanh&aring;llen journal skall journalen sp&auml;rras via <br /> patientv&auml;gledaren enligt DSAB&acute;s riktlinjer <br /> <br /> N&auml;r vi har en patient med skyddad ident itet som inte kan betala med kontokort och inte kan f&aring; <br /> fakturan i handen s&aring; g&auml;ller f&ouml;ljande med postg&aring;ngen: <br /> 1. Faktura skrivs <br /> 2. L&auml;ggs i ett litet kuvert som klistras igen <br /> 3. Skriv personnumret p&aring; det lilla kuvertet <br /> 4. L&auml;gg det lilla kuvertet i ett st&ouml;rre kuvert och klistra igen <br /> 5. Skriv adressen: F&ouml;rmedlingsuppdrag <br /> 106 61 Stockholm <br /> 6. St&auml;mpla med Akutmottagningens st&auml;mpel p&aring; baksidan av kuvertet (ifall kuvertet m&aring;ste returneras)</p>', 'skyddad-identitet', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:12:56', '2015-03-24 20:12:56', NULL),
(2, 'Skapa reservnummer till DSAB', '<p>Akutmot tagningens reception &auml;r enda enheten p&aring; Danderyds sjukhus AB som kan skapa nya <br /> reservnummer jourtid i PU</p>\r\n<ul>\r\n<li>webben.</li>\r\n</ul>\r\n<p>N&auml;r &ouml;vriga verksamheter p&aring; sjukhuset beh&ouml;ver v&aring;r assistans kring detta g&ouml;r vi enligt f&ouml;ljande: <br /> Skapa ett r eservnummer enligt instruktion i Hur g&ouml;r man p&auml;rmen, Att ta ut reservnummer <br /> Skriv ut en kopia p&aring; uttaget reservnummer <br /> Uppge datum och aktuell avdelning/klinik som ska debiteras samt din signatur p&aring; kopian <br /> Spara kopian i p&auml;rmen; Reservnummer till andra kliniker som finns i akutens receptio n <br /> Underlaget (kopior ) samlas ihop och skickas till v&aring;r ekonomicontroller <br /> Matilda M&aring;lqvist, hus 50 plan 7 ekonomiavdelningen 2</p>\r\n<ul>\r\n<li>3 ggr/&aring;r</li>\r\n</ul>\r\n<p>Arbetsinsatsen interndebiteras</p>', 'skapa-reservnummer-till-dsab', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:02', '2015-03-24 20:13:02', NULL),
(3, 'Sjuksköterska med ledningsansvar (SLA) bemanningsrutin', '<p>Jourtid <br /> N&auml;r bemanningsansvarig chefsjuksk&ouml;terska inte &auml;r p&aring; plats; kv&auml;llar, n&auml;tter och helger s&aring; &ouml;vertar <br /> sjuksk&ouml;terska med ledningsansvar arbetsgivaransvaret <br /> <br /> Som st&ouml;d f&ouml;r ledningsansva rig sjuksk&ouml;terska finns alltid bemanningsansvarig chefsjuksk&ouml;terska <br /> tillg&auml;nglig per telefon. Svarar bemanningsansvarig chefsjuksk&ouml;terska inte direkt s&aring; ringer hon tillbaka <br /> senast inom en timme. Rollen som ledningsansvarig sjuksk&ouml;terska kan vara utsatt d&auml;rf &ouml;r ser vi det <br /> som oerh&ouml;rt v&auml;sentligt med chefst&ouml;d . <br /> I chefsuppdraget ing&aring;r inte att &aring;ka in till arbetsplatsen jourtid f&ouml;rutom vid h&auml;ndelse av katastrof <br /> <br /> <br /> <br /> Vid fr&aring;nvaro sjukdom, VAB etc. <br /> Se &ouml;ver situationen p&aring; akuten, beh&ouml;ver passet ers&auml;ttas eller klarar vi oss &auml;nd&aring; <br /> <br /> G&aring;r det att omf&ouml;rdela personal, t.ex. n&aring;gon som &auml;r disponibel, fr&aring;n v&aring;rdlag till triage eller tv&auml;rtom <br /> eller finns det ngn som har ansvarstid eller annan uppgift som g&aring;r att skjuta till ett senare tillf&auml;lle. <br /> Kanske r&auml;cker det med en punktinsat s vid ett &ouml;verbelastat tillf&auml;lle. <br /> <br /> <br /> Om personen beh&ouml;ver ers&auml;ttas <br /> V&auml;rdera hur m&aring;nga timmar av passet som beh&ouml;ver ers&auml;ttas <br /> <br /> 1) Ring eller sms:a timanst&auml;llda <br /> <br /> 2) Tillfr&aring;ga kollegor som redan &auml;r i tj&auml;nst, i f&ouml;rsta hand deltidare <br /> <br /> 3) Tillfr&aring;ga kollegor som inte &auml;r i tj &auml;nst <br /> <br /> 4) Beordring kan ev. bli aktuell t efter dialog med bemanningsansvarig chef <br /> <br /> Extern bemanning tillfr&aring;gas inte vid akuta luckor jourtid utan planeras in med framf&ouml;rh&aring;llning <br /> <br /> <br /> <br /> <br /> Dokumentation &ouml;ver fr&aring;nvaro och vidtagna &aring;tg&auml;rder skrivs ner p&aring; f&ouml;r h&auml;r avset t dokument och <br /> rapporteras/l&auml;mnas till ansvarig chef n&auml;stkommande vardag.</p>', 'sjukskoterska-med-ledningsansvar-%28sla%29-bemanningsrutin', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:05', '2015-03-24 20:13:05', NULL),
(4, 'Sjukresor', '<p>Sjukresor <br /> <br /> Patienter kan ers&auml;ttas ekonomiskt</p>\r\n<ul>\r\n<li>helt elle r delvis - f&ouml;r kostnader med t ex taxi.</li>\r\n</ul>\r\n<p>D&auml;rvid g&auml;ller f&ouml;ljande <br /> 1. Patienten har kommit med taxi (och &auml;r ber&auml;ttigad till reseers&auml;ttning). Bed&ouml;mning kan <br /> g&ouml;ras av sjuksk&ouml;terska e ller l&auml;kare. Blanketten Sjukresa Hem/ers&auml;ttning fylls i komplett <br /> och l&auml;mnas till patienten som g&aring;r till receptionen, d&auml;r skrivs blankett f&ouml;r reseers&auml;ttning <br /> ut, patienten skriver under och skickar blankett + taxikvitto till Sjukreseenheten <br /> 2. Patienten skall &aring;terv&auml;nda hem med taxi (och &auml;r ber&auml;ttigad till reseers&auml;ttning) <br /> blanketten Sjukresa Hem/Ers&auml;ttning ifylls i till&auml;mpliga delar och l&auml;mnas till patienten <br /> som sedan g&aring;r till receptionen och f&aring;r sjukresekortet laddat <br /> 3. Patienten kommer med taxi men kan/vill inte betala. Dessa &auml;renden ska <br /> taxichauff&ouml;ren sj&auml;lv hantera efter taxibolagets rutiner fr.o.m. 2014</p>\r\n<ul>\r\n<li>04-21</li>\r\n</ul>\r\n<p>4. Patient fr&aring;n annat l&auml;n i Sverige (ULP), EU</p>\r\n<ul>\r\n<li>land och Norden som &auml;r ber&auml;ttigad till</li>\r\n</ul>\r\n<p>sjukresa kan f&aring; detta beviljat av l&auml;kare eller sjuksk&ouml;terska hem till anh&ouml;rig/v&auml;n i <br /> Stockholms l&auml;n samt sjukresor mellan v&aring;r dgivare i SLL. Dagtid vardagar faxas <br /> blanketten Tillst&aring;nd f&ouml;r sjukresa eller specialfordon<br /> till f&auml;rdtj&auml;nsten och d&auml;refter ringer <br /> man f&auml;rdtj&auml;nst/sjukresor och de laddar sjukresekortet, s&aring; ha kortet till hands n&auml;r du <br /> ringer. Jourtid anv&auml;nds sjukresebiljett tillsammans med ifylld blankett <br /> Tillst&aring;nd f&ouml;r sjukresor <br /> <br /> 5. Asyls&ouml;kande och tillst&aring;ndsl&ouml;sa som &auml;r ber&auml;ttigad till sjukresa f&aring;r sjukresan beviljad <br /> om s&aring; &auml;r befogat av l&auml;kare eller sjuksk&ouml;terska. Dagtid vardagar faxas blanketten <br /> Tillst&aring;nd f&ouml;r sjukresa eller specialfordon<br /> till f&auml;rdtj&auml;nst/sjukresor. Kryssa i rutan f&ouml;r <br /> asyls&ouml;kande och fyll i LMA</p>\r\n<ul>\r\n<li>kortnummer. &Auml;r det ett ogiltigt LMA-kort anses patienten</li>\r\n</ul>\r\n<p>som tillst&aring;ndsl&ouml;s och d&aring; skrivs Tillst&aring;ndsl&ouml;s ist&auml;llet f&ouml;r LMA</p>\r\n<ul>\r\n<li>kortnumret. D&auml;refter</li>\r\n</ul>\r\n<p>ringer man f&auml;rdtj&auml;nst/sjukresor och de laddar sjukresekortet s&aring; ha kortet till hands n&auml;r <br /> du ringer. Jourtid anv&auml;nds sjukresebiljet t tillsammans med ifylld blankett <br /> Tillst&aring;nd f&ouml;r sjukresor <br /> <br /> Sjukresor ska anv&auml;ndas mycket restriktivt! <br /> <br /> F&auml;rdtj&auml;nsten <br /> Box 30103 <br /> 104 25 Stockholm</p>', 'sjukresor', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:06', '2015-03-24 20:13:06', NULL),
(5, 'Sjuk- och friskanmälan', '<p>Lokala rutiner vid sjukfr&aring;nvaro <br /> <br /> <br /> Korttidsfr&aring;nvaro, 1</p>\r\n<ul>\r\n<li>7 dagar</li>\r\n</ul>\r\n<p>Om du blir sjuk under arbetspasset och m&aring;ste g&aring; hem f&ouml;re arbetstidens slut s&aring; m&aring;s te <br /> bemanningsassistent, sjuksk&ouml;terska med ledningsansvar eller chefsjuksk&ouml;terska <br /> meddelas. Annars kan du inte tillgodog&ouml;ra dig denna som karensdag. <br /> <br /> Arbetsgivaren p&aring;b&ouml;rjar en rehabiliteringsutredning vid upprepad korttidsfr&aring;nvaro p&aring; <br /> grund av sjukdom (6 sjukfa ll under en 12</p>\r\n<ul>\r\n<li>m&aring;naders period)</li>\r\n</ul>\r\n<p><br /> L&aring;ngtidsfr&aring;nvaro, 8 dagar och til lsvidare, styrks med l&auml;karintyg <br /> Kontakta chefsjuksk&ouml;terska vid l&aring;ngtidssjukskrivning <br /> <br /> Arbets givaren skall p&aring;b&ouml;rja en rehabiliteringsutredning n&auml;r den anst&auml;llde har varit helt <br /> eller de lvis fr&aring;nvarande till f&ouml;ljd av sjukdom i fyra veckor. <br /> Se &auml;ven Danderyds Sjukhus AB Rehabiliteringspolic y. <br /> <br /> Sjukanm&auml;lan <br /> G&ouml;rs snarast enligt nedan: <br /> 1. Kontorstid</p>\r\n<ul>\r\n<li>bemanningsassistenterna p&aring; telefon 08- 123 582 15</li>\r\n</ul>\r\n<p>2. &Ouml;vrig tid sjuksk&ouml;terska med ledningsansvar p&aring; telefon 08</p>\r\n<ul>\r\n<li>123 556 71</li>\r\n</ul>\r\n<p><br /> Friskanm&auml;lan <br /> Friskanm&auml;lan g&ouml;rs till bemanningsassistenterna dagen f&ouml;re f&ouml;rv&auml;ntad &aring;terg&aring;ng till <br /> arbetet , dock senast klockan 12.00, eller tidigare om t ex ledig dag ligger mellan <br /> sju ksk rivningen och f&ouml;rsta friskdagen</p>', 'sjuk--och-friskanmalan', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:07', '2015-03-24 20:13:07', NULL),
(6, 'Schemaläggning på akutkliniken', '<p>Bakgrund: <br /> Akutmottagningen &auml;r en stor arbe tsplats med m&aring;nga medarbetare. S om medarbetare &auml;r det viktigt att i <br /> m&ouml;jligaste m&aring;n kunna p&aring;verka sitt schema och ocks&aring; att i tid f&aring; ett fastslaget schema. F&ouml;r verksamhetens skull <br /> &auml;r det p&aring; samma s&auml;tt v&auml;sentligt att g&auml;llande rutiner f&ouml;ljs och att planeringen blir s&aring; optimal som m&ouml;jligt. <br /> <br /> Akuten har sex veckors schema (undantag finns) <br /> Du har alltid minst tv&aring; veckor p&aring; dig att l &auml;gga ditt schema <br /> N&auml;r schemat &auml;r lagt p&aring;g&aring;r diffning i tv&aring; veckor. Att diffa &auml;r ett gemensamt ansvar och &aring;ligger <br /> samtliga medarbetare anst&auml;llda p&aring; akutkliniken <br /> Fem helgpass ska l&auml;ggas under schemaperioden (fredagar r&auml;knas inte) <br /> Tj&auml;nstg&ouml;ring 13</p>\r\n<ul>\r\n<li>14 kv&auml;lla r/6 v (inkluderat 11-20.10 &amp; 10-2130)</li>\r\n</ul>\r\n<p>Planeringssaldot ska ligga inom intervallet +/</p>\r\n<ul>\r\n<li>20 timmar</li>\r\n</ul>\r\n<p>Veto l&auml;ggs n&auml;r du vill p&aring;visa f&ouml;r dina kollegor att det &auml;r viktigt f&ouml;r dig att vara ledig <br /> 1. Veto kan inte l&auml;ggas under storhelger eller under sommarperioden <br /> 2. Det maximala antalet vetotimmar per vecka &auml;r 24 (vill du vara ledig p&aring; fm l&auml;gg d&aring; veto <br /> 08.00 12.00, vill du vara ledig hela dagen l&auml;gg 10.00 18.00) <br /> 3. Turordning f&ouml;r ledigheter &auml;r enligt f&ouml;ljande: <br /> F&ouml;r&auml;ldraledighet <br /> Semester <br /> Komp ledighet <br /> Flex (n&auml;r arbetet s&aring; till&aring;ter) <br /> Veto <br /> Schemaansvariga har ansvar f&ouml;r att bemanningskraven f&ouml;ljs. Det inneb&auml;r att schemaansvariga ser &ouml;ver <br /> det f&auml;rdig diffade schemat och g&ouml;r de f&ouml;r&auml;ndringar som beh&ouml;vs f&ouml;r att verksamheten ska ha r&auml;tt <br /> antal personer med r&auml;tt kompetens i tj&auml;nst. <br /> N&auml;r schemaansvariga &auml;r klara ska schemat godk&auml;nnas och fastst&auml;llas av chef, d&auml;refter &auml;r det klart <br /> (schemat ska vara klart tv&aring; veckor innan det b&ouml;rjar g&auml;lla) <br /> Byten av pass g&ouml;rs f&ouml;retr&auml;desvis med kollega men kan ocks&aring; diskuteras med bemanningsansvariga <br /> Ledi gheter som &auml;r en vecka eller l&auml;ngre ska alltid vara godk&auml;nd av chefen. T&auml;nk p&aring; det innan ev. resa <br /> bokas. Ledighet enstaka dagar kan bemmaningen godk&auml;nna. <br /> Fr&aring;gor kring arbetstider och schema diskuteras med n&auml;rmaste chef <br /> <br /> Arbetspass 6 veckor, (kan &auml;ndras eft er verksamhetens behov) <br /> M&aring;ndag fredag <br /> ssk usk <br /> 07.00 15.00 alt 15.3 0 fritt 07.00 15.00 alt 15.3 0 fritt <br /> 09.00 17.00 1 pass 09.00 17.00 1 pass <br /> 11.00 20.1 0 3 pass 11.00 20.1 0 2 pass <br /> 10.00 21.30 2 pass 10.00 21.30 1 pass <br /> 13.45 21.30 min st 10 pass 13.45 21.30 minst 11 pass <br /> <br /> L&ouml;rdag s&ouml;ndag <br /> ssk usk <br /> 07.00 15.00 alt 15.3 0 07.00 15.00 alt 15.3 0 <br /> 12.30 21.30 12.30 15.00</p>', 'schemalaggning-pa-akutkliniken', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:09', '2015-03-24 20:13:09', NULL),
(7, 'Sammankoppling av journal TC', '<p>Sammankoppling av journal i TakeCare <br /> <br /> I de fall d&aring; patienten erh&aring;ller ett reservnummer ska ll dokumentation, i samtliga <br /> system, ske p&aring; detta reservn ummer under hela v&aring;rdtillf&auml;llet <br /> <br /> Om patientens id entitet styrks p&aring; akuten, g&ouml;r en S ammankoppling. Skriv ut, fyll i och skicka <br /> f&ouml;ljande blankett: <br /> <br /> Beg&auml;ran om att koppla ihop identiteter i v&aring;rdsystem <br /> <br /> N&auml;r en identitet p&aring; ok&auml;nd man/kvinna framkommit skall uppdatering av namn i TC ske <br /> enligt f&ouml;ljande: 1. G&ouml;r f&ouml;rst en RNRK i PU</p>\r\n<ul>\r\n<li>systemet</li>\r\n</ul>\r\n<p>2. Dubbelkl icka p&aring; personen i akutliggaren <br /> 3. Klicka p&aring; Personuppgifter <br /> 4. Klicka p&aring; Folkbokf&ouml;rings fliken (i ovankant) <br /> 5. Klicka p&aring; Uppdatera nu (nere i h&ouml; h&ouml;rnet) <br /> 6. Klart. OBS! Det kan ta en stund innan namnet &auml;ndras! <br /> <br /> G&ouml;r nya etiketter (fortfarande reserv numme r, men med patientens namn) <br /> <br /> N&auml;r identitet &auml;r styrkt komplettera med ytterligare ett ID</p>\r\n<ul>\r\n<li>band med patientens</li>\r\n</ul>\r\n<p>personnummer och namn <br /> <br /> N&auml;r identitet &auml;r styrkt ska r&ouml;ntgenavdelningen upplysas om patientens identitet vid <br /> best&auml;llning av r&ouml;ntgenunders&ouml;kning. Personnumret skrivs in i f&auml;ltet Allm&auml;nna <br /> upplysningar i remissformul &auml;ret</p>', 'sammankoppling-av-journal-tc', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:10', '2015-03-24 20:13:10', NULL),
(8, 'Reservrutiner sjukresor                                                                   Version 7', '<p>Nedanst&aring;ende rutiner g&auml;ller vid f&ouml;ljande scenario <br /> Systemhaveri sjukresesystemet <br /> Sjukresa beviljad till: <br /> ULP</p>\r\n<ul>\r\n<li>patienter (Utom L&auml;ns Patienter)</li>\r\n</ul>\r\n<p>Nordiska medborgare <br /> EU</p>\r\n<ul>\r\n<li>medborgare</li>\r\n</ul>\r\n<p>Asyls&ouml;kande <br /> Tillst&aring;ndsl&ouml;sa <br /> <br /> <br /> Systemhaveri sjukresesystemet <br /> N&auml;r systemhaveri p&aring; sjukreseenhetens hemsida leder till att ett sjukresekort inte kan laddas <br /> m&aring;ste en sjukresebiljett skrivas till patienten (se instruktion nedan). Om patienten &auml;r <br /> rullstolsbunden kontrollera om patienten har f&auml;rdtj&auml;nstkort och kan ta sig hem med detta <br /> ist&auml;llet. <br /> Felanm&auml;l systemhaveriet: <br /> Vardag (m&aring;n</p>\r\n<ul>\r\n<li>fre kl:8-16) Helpdesk tfn: 08-686 31 70</li>\r\n</ul>\r\n<p>Jourtid (&ouml;vrig tid) finns ingen support ring vid kvarst&aring;ende problem n&auml;stkommande vardag <br /> Observera att sjukresa med specialfordon s&aring;som rullstol samt pirra inte<br /> kan best&auml;llas vid <br /> systemhaveri i sjukresesystemet. Vid dessa tillf&auml;llen f&aring;r en bed&ouml;mning g&ouml;ras ifall patienten <br /> kan passar in f&ouml;r tillst&aring;nd till liggande b&aring;rtransport. Om inte f&aring;r patienten sj&auml;lv betala resan <br /> f&ouml;r att i efterhand kr&auml;va ers&auml;ttning av sjukreseenheten. Resekvitto samt intyg fr&aring;n oss som <br /> medger ber&auml;ttigande till sjukresan skickar patienten sj&auml;lv in till: <br /> Sjukreseenheten <br /> F&auml;rdtj&auml;nsten <br /> Box 30 103 <br /> 104 25 Stockholm <br /> <br /> Sjukresa beviljad till ovanst&aring;ende n&auml;mnda medborgare <br /> N&auml;r ULP</p>\r\n<ul>\r\n<li>patienter, nordiska medborgare, EU-medborgare, asyls&ouml;kande samt tillst&aring;ndsl&ouml;sa</li>\r\n</ul>\r\n<p>som &aring;ker mellan v&aring;rdgivare i SLL eller till anh&ouml;rig/v&auml;n inom SLL, m&aring;ste en sjukresebiljett <br /> skrivas till patienten (se nedan) <br /> <br /> Instruktion reservrutin <br /> Biljetter samt blanketter finns i p&auml;rmen Sjukresebiljetter vid driftstopp i receptionen <br /> Fyll noggrant i allt p&aring; blanketten Tillst&aring;nd f&ouml;r sjukresor och ta tillh&ouml;rande biljett. <br /> OBS! Gl&ouml;m inte p&aring;skriften av resen&auml;ren <br /> Vid telefonbest&auml;llningen av sjukresan uppges numret i fet stil p&aring; biljetten <br /> S&auml;tt ifylld blankett l&auml;ngst bak i p&auml;rmen <br /> Om blankett</p>\r\n<ul>\r\n<li>eller och biljettbest&auml;llning beh&ouml;ver g&ouml;ras, informera receptionsansvarig Sophia</li>\r\n</ul>\r\n<p>Stenvall</p>', 'reservrutiner-sjukresor-------------------------------------------------------------------version-7', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:12', '2015-03-24 20:13:12', NULL),
(9, 'Remisshantering Akutkliniken DS', '<p>Remisshantering Akutkliniken DS <br /> <br /> <br /> <br /> RECEPTION <br /> D&aring; patientens bes&ouml;k registreras i kassan kontrolleras om e</p>\r\n<ul>\r\n<li>remiss finns. Om s&aring;dan remiss finns skrivs</li>\r\n</ul>\r\n<p>E</p>\r\n<ul>\r\n<li>REMISS i kommentarsrutan akutliggaren f&ouml;r att inga remisser skall missas under akutbes&ouml;ket.</li>\r\n</ul>\r\n<p>Dessa remisser beh&ouml;ver inte ankomstregistreras i Konsultations&auml;renden TC <br /> Har patienten pappersremiss skall denna ankomstregistreras i Konsultations&auml;renden TC p&aring; aktuell <br /> klinik samt skriv P</p>\r\n<ul>\r\n<li>REMISS i kommentarsrutan akutliggaren</li>\r\n</ul>\r\n<p>Kommer patienten p&aring; &aring;terbes&ouml;k skrivs &Aring;B i kommentarsrutan akutliggaren <br /> <br /> <br /> <br /> L&Auml;KARE <br /> Vid hemg&aring;ng (inklusive extern enhet) dikteras en mottagningsanteckning/remissvar av ansvarig <br /> l&auml;kare. Om patienten &ouml;vertagits av annan klinik p&aring; akutmottagningen ansvarar hems kickande klinik <br /> f&ouml;r remissvar om inget annat avtalas mellan kollegorna p&aring; akuten <br /> Vid inl&auml;ggning dikterar ansvarig l&auml;kare inl&auml;ggningsanteckning som vanligt. Remissvar skickas vid <br /> utskrivning fr&aring;n avdelning till remittenten <br /> Vid intern konsultation p&aring; akuten tas kontakt med jourhavande l&auml;kare p&aring; konsulterad sektion. Svar <br /> p&aring; konsultation dokumenteras som en daganteckning (alt. remissvar) i patientens journal. <br /> Vid &aring;terbes&ouml;k till samma klinik skrivs en daganteckning i TC. Denna ers&auml;tter en intern <br /> &aring;terbes&ouml;ksremiss <br /> <br /> <br /> <br /> SEKRETERARE AKUTKLINIKEN <br /> Vid hemg&aring;ng (inklusive extern enhet) skickar sekreteraren p&aring; akuten efter diktat externt remissvar <br /> samt avslutar remiss <br /> I samband med inl&auml;ggning vidarebefordrar sekreteraren p&aring; akuten e</p>\r\n<ul>\r\n<li>remissen till aktuell avdelning</li>\r\n</ul>\r\n<p>som senar e besvarar och avslutar remissen <br /> Konsultationer/felregistrering : Om patientens ankomstremiss &auml;r st&auml;lld till annan sektion &auml;n d&auml;r <br /> patienten tillh&ouml;r eller patienten flyttas mellan kliniker under akutbes&ouml;ket, &auml;ndrar sekreterarna remissen <br /> i efterhand, skickar remissvar fr&aring;n hemskrivande/inl&auml;ggande klinik samt avslutar e</p>\r\n<ul>\r\n<li>remissen</li>\r\n</ul>\r\n<p>Inkorgen av ej l&auml;karbed&ouml;mda e</p>\r\n<ul>\r\n<li>remisser till Akutkliniken DS rensas veckovis av sekreterare p&aring;</li>\r\n</ul>\r\n<p>akuten. Efter 24 timmar returneras e</p>\r\n<ul>\r\n<li>remissen till remittenten med remissvar att vederb&ouml;ran de inte</li>\r\n</ul>\r\n<p>upps&ouml;kt Danderyds akutmottagning</p>', 'remisshantering-akutkliniken-ds', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:13', '2015-03-24 20:13:13', NULL),
(10, 'Presskontakter', '<p>Rutiner vid f&ouml;rfr&aring;gan fr&aring;n press/media, t ex efter olyckor <br /> <br /> <br /> Media f&ouml;ljer p&aring; olika s&auml;tt ambulanslarm och &ouml;nskar ibland snabbt f&aring; besked om h&auml;ndelsen <br /> <br /> Det &auml;r ett legitimt allm&auml;nintresse och skall tillgodoses under kontrollerade former med <br /> beaktande av patien tens integritet och anh&ouml;rigas behov <br /> <br /> Pressf &ouml;rfr&aring;gningar som inkommer till akuten DS h&auml;nvisas till Sjuksk&ouml;terska med <br /> Ledningsansvar (SLA) p&aring; 08</p>\r\n<ul>\r\n<li>123 556 71</li>\r\n</ul>\r\n<p><br /> SLA g&ouml;r enligt f&ouml;ljande: <br /> 1. Utan att bekr&auml;fta att p atienten inkommit dokumentera f&ouml;rfr&aring;gan samt namn</p>\r\n<ul>\r\n<li>och</li>\r\n</ul>\r\n<p>kontaktuppgifter till journalisten och meddela att vi ringer upp inom kort <br /> <br /> 2. SLA kontaktar Pressansvarig alternativt Enheten f&ouml;r kommunikation. <br /> Pressansvarig finns p&aring; tfn 08</p>\r\n<ul>\r\n<li>123 56 388 vardagar 08.00 17.00</li>\r\n</ul>\r\n<p>Enheten f&ouml;r Kommunikation finns p&aring; 08</p>\r\n<ul>\r\n<li>123 562 51 (Annakarin Svenningsson)</li>\r\n</ul>\r\n<p>vardagar 08.00</p>\r\n<ul>\r\n<li>17.00</li>\r\n</ul>\r\n<p>Det finns &auml;ven ett pressjoursnummer tfn 08</p>\r\n<ul>\r\n<li>123 562 77.</li>\r\n</ul>\r\n<p><br /> 3. Jourtid h&auml;nvisas pressen till n&auml;stkommande vardag om det inte finns risk f&ouml;r en <br /> massmedial kris. Vid risk f&ouml;r en massmedial kris ska chefl&auml;kare i beredskap <br /> kontaktas . <br /> <br /> 4. Vid st&ouml;rre olycka/katastrof blir Enheten f&ouml;r kommunikation jour genom <br /> Katastrofledningen p&aring; sjukhuset. Dessa pressamtal h&auml;nvisas d&aring; till v&auml;xeln. <br /> <br /> <br /> <br /> L&auml;s mer i riktlinjen <br /> Massmediapolicy allm&auml;n</p>', 'presskontakter', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:15', '2015-03-24 20:13:15', NULL),
(11, 'Postöppning fullmakt, klinikövergripande', '<p>Post&ouml;ppning fullmakt , klinik&ouml;vergripande <br /> Denna fullmakt avser endast f&ouml;rs&auml;ndelser som kan antas r&ouml;ra tj&auml;nsteangel&auml;genheter. Detta inneb&auml;r <br /> att <br /> brev m&auml;rkt med privat, konfidentiellt eller dylikt eller som av annan anled ning sannolikt kan <br /> antas inneh&aring;lla rent privata angel&auml;genheter, skall l&auml;mnas o&ouml;ppnad av registrator. <br /> <br /> H&auml;rmed ger jag mitt tillst&aring;nd till att sekreterare/kontorsassistent eller dennes ers&auml;ttare , <br /> <br /> �� alltid <br /> �� vid l&auml;ngre tids fr&aring;nvaro fr&aring;n arbetsplatsen s&aring;som semester, tj&auml;nstledighet, <br /> sjukfr&aring;nvaro eller annan l&auml;ngre fr&aring;nvaro (det &aring;ligger d&aring; vederb&ouml;rande att sj&auml;lv <br /> kontakta sekr/kont ass vid varje enskilt tillf&auml;lle) <br /> <br /> f&aring;r &ouml;ppna post som &auml;r direktadresserad till mig och som kan antas r&ouml;ra tj&auml;nsteangel&auml;genhet. <br /> Fullmakten g&auml;ller tills vidare eller s&aring; l&auml;nge jag inte skriftligen meddelar annat. <br /> <br /> <br /> Namn p&aring; sekreterare/klinikassistent/ers&auml;ttare . <br /> <br /> Danderyd den <br /> <br /> Underskrift \\<br /> . <br /> <br /> Namnf&ouml;rtydligande \\<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> F&ouml;r praktisk till&auml;mpning av offentlighetsprincipen &auml;r det viktigt att allm&auml;nna handlingar <br /> diarief&ouml;rs utan on&ouml;digt dr&ouml;jsm&aring;l. F&ouml;rs&auml;ndelser so m r&ouml;r tj&auml;nsten skall inte bli liggande <br /> o&ouml;ppnade d&auml;rf&ouml;r att de &auml;r personligt adresserade till en tj&auml;nsteman som av n&aring;gon anledn ing <br /> under en l&auml;ngre tid inte &auml;r n&auml;rvarande p&aring; arbetsplatsen. Man kan dock inte helt bortse fr&aring;n att <br /> ett inkommet brev inte r&ouml;r tj&auml;nsten, utan enbart adressatens privata angel&auml;genheter. Den s k <br /> brevhemligheten &auml;r dessutom skyddad enl brottsbalken (BrB 4:9). <br /> <br /> F&ouml;r att tillgodose kravet p&aring; allm&auml;nhetens tillg&aring;ng till allm&auml;nna handl ingar utan att komma i <br /> konflikt med brottsbalken, rekomm enderas att post&ouml;ppnare genom fullmakt ges till&aring;telse att <br /> &ouml;ppna personligt adresserad f&ouml;rs&auml;ndelse som kan antas inneh&aring;lla uppgifter r&ouml;rande tj&auml;nsten. <br /> <br /> F&ouml;rs&auml;ndelser adresserade till akutkliniken utan specifik mottagare datumst&auml;mplas utanp&aring; <br /> kuvertet och l&auml;ggs i klinikassistentens postfack och f&aring;r endast &ouml;ppnas av <br /> klinikassistent/verksamhetschef. Personal i receptionen p&aring; akutkliniken hanterar inkommen <br /> post och vidarebefordrar post till patienter/personal i o&ouml;ppnat skick. Om f&ouml;rs&auml;ndelse <br /> inkommer som ej &auml;r adresserad till n&aring;gon av kliniken s sektioner och adressaten &auml;r ok&auml;nd skall <br /> klinikassistenten se till att f&ouml;rs&auml;ndelsen skickas tillbaka till Posten.</p>', 'postoppning-fullmakt%2C-klinikovergripande', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:16', '2015-03-24 20:13:16', NULL),
(12, 'Polisprov vid misstanke rattfylleri – drogpåverkan', '<p>Lokal riktlinje A kutkliniken d&aring; polis beg&auml;r hj&auml;lp med provtagning vid <br /> misstanke om rattfylleri/drogp&aring;verkan <br /> <br /> Om endast blodprovtagning skall ske skrivs patienten in som ett <br /> Sjuksk&ouml;terskebes&ouml;k,<br /> taxa 15, 0kr i kassan samt i akutliggaren tillh&ouml;rande den sektion <br /> som provtagande sjuksk&ouml;terska tj&auml;nstg&ouml;r vid. Sjuksk&ouml;terskan dokumenterar en <br /> sjuksk&ouml;terskeanteckning i TC efter bes&ouml;ket <br /> <br /> Om en l&auml;karunders&ouml;kning skall ske ut&ouml;ver provtagninge n, t.ex. efter olyckor, skrivs <br /> patienten in som ordin&auml;rt p&aring; aktuell sektion i akutliggaren <br /> <br /> 1) Ankomsts&auml;tt Polis <br /> 2) Bes&ouml;ksorsak Ospecificerad kontaktorsak <br /> 3) Utkod Annan v&aring;rdenhet skriv Polis <br /> <br /> Blodprovet f&aring;r endast tas av l&auml;kare eller leg. sj uksk&ouml;terska<br /> enligt R&auml;tteg&aring;ngsbalken <br /> 28 kap 13 &sect;. Kan <br /> ej delegeras <br /> <br /> Polisen har med sig ett provtagnings</p>\r\n<ul>\r\n<li>kit att anv&auml;nda vid blodprovtagningen samt</li>\r\n</ul>\r\n<p>blanketter att fylla i <br /> <br /> P&aring; baksidan av polisens blankett skall det intygas att alkoholbaserad <br /> desinfektion sl&ouml;sning <br /> ej anv&auml;nts vid provtagningstillf&auml;llet. P&aring; blanketten skall framg&aring; <br /> vilken desinfektionsl&ouml;s ning som anv&auml;nts, vanligtvis NaC l <br /> <br /> En av polisens kopior beh&aring;ller vi efter bes&ouml;ket som fakturerings</p>\r\n<ul>\r\n<li>underlag till</li>\r\n</ul>\r\n<p>kassan. Dessa uppgifter skall framg&aring;: <br /> 1. Pers onuppgifter p&aring; vederb&ouml;rande patient <br /> 2. Kombikakoden till ansvarig kliniken <br /> 3. Bes&ouml;ksdatum <br /> 4. Vilket polism&auml;stardistrikt som skall faktureras <br /> <br /> Kopian/faktureringsunderlaget skickas till <br /> Kassan &amp; Patientadminist rationen <br /> Hus 50, plan 4</p>', 'polisprov-vid-misstanke-rattfylleri-%E2%80%93-drogpaverkan', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:17', '2015-03-24 20:13:17', NULL),
(13, 'Parkeringstillstånd', '<p>Parkeringstillst&aring;nd till s v&aring;rt sjuka patienter samt transporter fr&aring;n <br /> kriminalv&aring;rdsanstalter <br /> <br /> <br /> </p>\r\n<ul>\r\n<li>Parkeringsplatserna utanf&ouml;r akutmottagninge ns ambulansgarage &auml;r avsedda f&ouml;r akut</li>\r\n</ul>\r\n<p>insjuknade patienter (g&auml;ller &auml;ven medf&ouml;ljande personlig assistent) vars tillst&aring;nd inte medger <br /> att de upps&ouml;ker ordinarie parkeringsplats <br /> <br /> </p>\r\n<ul>\r\n<li>Om patienten har medf&ouml;ljande anh&ouml;rig eller bekant som ha r k&ouml;rkort skall bilen k&ouml;ras till</li>\r\n</ul>\r\n<p>bes&ouml;ksparkering <br /> <br /> </p>\r\n<ul>\r\n<li>Parkeringstillst&aring;ndet skall registreras p&aring; blankett Tillf&auml;lliga P-tillst&aring;nd med nummer</li>\r\n</ul>\r\n<p>markerat med rosa <br /> <br /> </p>\r\n<ul>\r\n<li>Datum, patientens namn, bilens registrerings nummer samt utl&auml;mnarens namnteckning skall</li>\r\n</ul>\r\n<p>vara ifylld <br /> <br /> </p>\r\n<ul>\r\n<li>Parkeringstillst&aring;nd kan utf&auml;rdas vid akut sjuk patient fr&aring;n kriminalv&aring;rdsanstalter.</li>\r\n</ul>\r\n<p>Om inl&auml;ggning p&aring; en avdelning blir aktuell och byte av kriminalv&aring;rdspersonal sker s&aring; <br /> utf&auml;rdas vidare parkeringstillst&aring;nd av avdelningen <br /> <br /> <br /> <br /> Observera! <br /> Parkeringstillst&aring;nd f&aring;r ej utl&auml;mnas till entrepren&ouml;rer eller personal <br /> Tillf&auml;lliga parkeringstillst&aring;nd kostar den egna kliniken 2000 kr f&ouml;r 50st</p>', 'parkeringstillstand', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:18', '2015-03-24 20:13:18', NULL),
(14, 'Parkeringsböter – begäran om befrielse från parkeringsavgift', '<p>INTYG <br /> <br /> <br /> <br /> \\<br /> .................. <br /> Namn <br /> <br /> <br /> <br /> Ovanst&aring;ende person var under tiden</p>\r\n<ul>\r\n<li>.-.kl --.-.-kl.</li>\r\n</ul>\r\n<p><br /> patient vid Akutmottagningen, Dande ryds Sjukhus AB, under vilken tid patienten, enligt uppgift, <br /> erh&aring;llit parkeringsavgift pga. felp arkering inom sjukhusomr&aring;det. <br /> <br /> <br /> <br /> Stockholm .</p>\r\n<ul>\r\n<li>..-..</li>\r\n</ul>\r\n<p><br /> <br /> <br /> <br /> <br /> Leg. Sjuksk&ouml;terska <br /> VO akutkliniken <br /> Danderyds Sjukhus AB <br /> 182 88 Stockholm <br /> <br /> <br /> </p>\r\n<ul>\r\n<li>Ovanst&aring;ende intyg fylls i av leg. sjuksk&ouml;ter ska p&aring; akuten och l&auml;mnas till patienten</li>\r\n</ul>\r\n<p><br /> </p>\r\n<ul>\r\n<li>F&ouml;lj l&auml;nken www.bevakningstjanst.com</li>\r\n</ul>\r\n<p>och skriv ut Beg&auml;ran avskrivning av kontrollavgift <br /> Danderyds sjukhus. Denna blankett l&auml;mnas till patienten att fylla i <br /> <br /> </p>\r\n<ul>\r\n<li>Patienten skickar ans&ouml;kan, v&aring;rt intyg samt kopia av parkeringsbot till Bevakningstj&auml;nst</li>\r\n</ul>\r\n<p>enligt anvisningar p&aring; blankett <br /> <br /> </p>\r\n<ul>\r\n<li>Vid f&ouml;rfr&aring;gan om avskrivning fr&aring;n parkerings b&ouml;ter under v&aring;rdtiden p&aring; annan klinik</li>\r\n</ul>\r\n<p>&auml;n Akuten, h&auml;nvisas patienten dit</p>', 'parkeringsboter-%E2%80%93-begaran-om-befrielse-fran-parkeringsavgift', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:20', '2015-03-24 20:13:20', NULL),
(15, 'Miljöavvikelser', '<p>Loka l rutin f&ouml;r milj&ouml;avvikelser Akutkliniken <br /> <br /> Avvikelser rapporteras i H&auml;ndelsevis snarast efter intr&auml;ffad h&auml;ndelse <br /> Viktigt att rapportera det som en Milj&ouml;avvikelse <br /> Chefssjuksk&ouml;terska (dagtid) alt SLA (jourtid) skall muntligen informeras om det intr&auml;ffade f&ouml;r att <br /> m&ouml;j ligg&ouml;ra omedelbar &aring;tg&auml;rd <br /> Chef ssjuksk&ouml;terskorna &auml;r ansvariga f&ouml;r inkomna milj&ouml;avvikelser samt att vidarebefordra dessa till <br /> lokala milj&ouml;handl&auml;ggaren <br /> Milj&ouml;handl&auml;ggaren ansvarar f&ouml;r insamling, registrering och rapportering av milj&ouml;avvikelser inom <br /> ve rksamheten <br /> Verksamhetschefen har det &ouml;vergripande milj&ouml;ansvaret <br /> <br /> <br /> Exempel p&aring; milj&ouml;relaterade avvikelser &auml;r bl.a. <br /> <br /> Felaktig hantering, packning och m&auml;rkning av farligt gods <br /> Felaktig k&auml;llsortering av avfall <br /> Lustgasl&auml;ckage <br /> D&aring;liga/felaktiga rutiner <br /> <br /> <br /> Analys oc h uppf&ouml;ljning <br /> <br /> Chefsjuksk&ouml;terskor och lokal milj&ouml;handl&auml;ggare analyserar in tr&auml;ffade avvikelser regelbundet <br /> Vid genomg&aring;ng identifi eras de rapporter som skall utredas tillsammans med verksam hetschef <br /> Chefsjuksk&ouml;terska ansvarar f&ouml;r att utredni ng startar i identifierade fall <br /> Utredningen kan genomf&ouml;ras av lokal milj&ouml;handl&auml;ggare, milj&ouml;ombud eller av annan delegerad person <br /> <br /> <br /> &Aring;terf&ouml;ring <br /> <br /> &Aring;terf&ouml;ring sker i f&ouml;rsta hand via APT (arbetsplatstr&auml;ff) av lokal milj&ouml;handl&auml;ggare, milj &ouml;ombud eller <br /> chefsjuksk&ouml;terska <br /> Chefsjuks k&ouml;terska ansvarar f&ouml;r att &aring;terf&ouml;ra milj&ouml;avvikelser i samverkansgruppen <br /> Patients&auml;kerhetscontroller redovisar s tatistik &ouml;ver milj&ouml;avvikelserna i &aring;rsbok slutet <br /> <br /> <br /> Se DSAB:s &ouml;vergripande milj&ouml;rutiner p&aring; hemsidan</p>', 'miljoavvikelser', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:21', '2015-03-24 20:13:21', NULL),
(16, 'Beslut om rätten att rekvirera läkemedel från apoteket DSAB', '<p>R&auml;tten att rekvirera l&auml;ke medel fr&aring;n apoteket p&aring; Danderyds Sjukhus AB <br /> <br /> <br /> </p>\r\n<ul>\r\n<li>Beslutet g&auml;ller f&ouml;r legitimerad sjuksk&ouml;terska vid A kutkliniken som h&auml;rmed f&aring;r r&auml;tten att rekvirera</li>\r\n</ul>\r\n<p>l&auml;kemedel fr&aring;n apoteket Danderyds Sjukhus AB <br /> </p>\r\n<ul>\r\n<li>Rekvisition och kontroll av l&auml;kemedel skall f&ouml;lja soci alstyrelsens f&ouml;reskrifter och allm&auml;nna r&aring;d om</li>\r\n</ul>\r\n<p>l&auml;kemedelshantering SOSFS 2001:17, 5 kap. <br /> </p>\r\n<ul>\r\n<li>F&ouml;rbrukningsjournal skall f&ouml;ras p&aring; samtliga narkotikaklassificerade l&auml;kemedel</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Ansvaret f&ouml;r inventering och kontroll av rekvirerade l&auml;kemedel skall &aring;l&auml;ggas annan sjuksk&ouml;terska &auml;n</li>\r\n</ul>\r\n<p>den som har ansvaret f&ouml;r rekvisition och f&ouml;rvaring <br /> <br /> <br /> <br /> <br /> Leg. Sjuksk&ouml;terska__________________________________________________________________ <br /> Personnummer F&ouml;rnamn/Efternamn <br /> <br /> <br /> <br /> Beslutet g&auml;ller fr.o.m.__________________________t.o.m._________________________________ <br /> <br /> <br /> <br /> <br /> Uppdragsgivare_____________________________________________________________________ <br /> Chefsjuksk&ouml;terska <br /> <br /> <br /> <br /> Uppdragstagare_____________________________________________________________________ <br /> Legitimerad Sjuksk&ouml;terska <br /> <br /> <br /> <br /> Beslutsfattare_______________________________________________________________________ <br /> Anna F&auml;rg-Hagansbo Verksamhetschef</p>', 'beslut-om-ratten-att-rekvirera-lakemedel-fran-apoteket-dsab', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:22', '2015-03-24 20:13:22', NULL),
(17, 'Konsultinsats av akutens personal', '<p>Konsultinsats av akutens personal hos patient inskriven p&aring; annan klinik <br /> <br /> <br /> Av s&auml;kerhetsm&auml;ssiga sk&auml;l ska a lla patienter som vistas p&aring; akutmottagni ngen f&ouml;r en <br /> konsultinsats av akutens personal registreras i akutliggaren p&aring; aktuell klinik. En orange l app <br /> l&auml;mnas ut till receptionen med ikryssad ruta Endast konsult ssk/usk. Denna konsultation <br /> registreras med kombikakod 11010 046 M30 i kassan . <br /> <br /> Genomf&ouml;rd konsult&aring;tg&auml;rd dokumenteras i patientens journal av ansvarig personal <br /> <br /> Vid utskrivning fr&aring;n akutliggaren v&auml;lj DRG nej och godk&auml;nn <br /> <br /> Konsultinsatser kan best&aring; av t.ex. EKG</p>\r\n<ul>\r\n<li>tagning, KAD -s&auml;ttning, ins&auml;ttande av PVK, gipsning</li>\r\n</ul>\r\n<p>eller provtagning <br /> som ing&aring;r i ett p&aring;g&aring;ende bes&ouml;k eller ett v&aring;rdtillf&auml;lle p&aring; annan klinik inkl. <br /> psykiatri och geriatrisk klinik<br /> <br /> <br /> D&aring; &ouml;vriga kliniker faktureras f&ouml;r ovanst&aring;ende tj&auml;nster skall ett underlag f&ouml;r fakturering i form <br /> av blankett Konsultation sjuksk&ouml;terska/undersk&ouml;terska l&auml;mnas till valfri <br /> chefssjuksk&ouml;terska i postfack <br /> <br /> Vid f&ouml;rfr&aring;gan om vi kan utf&ouml;ra insatsen p&aring; annan plats &auml;n akutmottagningen g&auml;ller f&ouml;ljande: <br /> <br /> 1. Sjuksk&ouml;terska med ledningsansvar &auml;ger fr&aring;gan. Det inneb&auml;r, att han/hon avg&ouml;r om <br /> det &auml;r m&ouml;jligt/l&auml;mpligt med h&auml;nsyn till den medicinska s&auml;kerheten p&aring; <br /> akutmottagningen att l&aring;ta n&aring;gon g&aring; ifr&aring;n. Om detta inte &auml;r m&ouml;jligt, ombes&ouml;rjer <br /> avdelningen patienttransport till och fr&aring;n till akutmottagningen f&ouml;r konsultinsatsen. <br /> Diskussion kan f &ouml;ras med jour p&aring; ber&ouml;rd klinik. <br /> 2. Anses detta om&ouml;j ligt/ol&auml;mpligt/farligt f&aring;r den ber&ouml;rda klinikens jour ta st&auml;llning till <br /> alternativa l&ouml;snin gar. Skulle d&auml;refter akutmot tagningens bemanning likafullt minskas <br /> f&aring;r den ber&ouml;rda klinikens jour samr&aring;da med medicinjour p&aring; akutkliniken som d&auml;refter <br /> f&aring;r ta det fulla medicinska ansvaret f&ouml;r att s&aring; sker.</p>', 'konsultinsats-av-akutens-personal', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:24', '2015-03-24 20:13:24', NULL),
(18, 'IT Säkerhetsrutin', '<p>IT s&auml;kerhetsrutin <br /> <br /> </p>\r\n<ul>\r\n<li>Logga ut korrekt n&auml;r du l&auml;mnar din arbetsstation f&ouml;r rast eller avslutat arbetspass. Detta g&ouml;rs</li>\r\n</ul>\r\n<p>genom att klicka p&aring; Ctrl+Alt+Delete och logga ut om kortet bara dras ut s&aring; tar det <br /> l&auml;ngre tid f&ouml;r n&auml;sta person att logga in <br /> </p>\r\n<ul>\r\n<li>Ta med kortet n&auml;r du l&auml;mnar din arbetsstation. Detta b&aring;de ur s&auml;kerhetssynpunkt, d&aring; ditt kort</li>\r\n</ul>\r\n<p>&auml;r en v&auml;rdehandling, samt ur sekretessynpunkt d&aring; TakeCare inneh&aring;ller patientinformation <br /> </p>\r\n<ul>\r\n<li>T&auml;nk p&aring; att det som h&auml;nder n&auml;r ditt kor t &auml;r i kortstationen &auml;r ditt ansvar</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Se till att dokumentera allt du utf&ouml;r i patientar betet p&aring; ditt kort. I och med din inloggning i</li>\r\n</ul>\r\n<p>TakeCare loggas dokumentationen med en elek tronisk signatur i patientens journal <br /> </p>\r\n<ul>\r\n<li>Det &auml;r inte till&aring;tet att surfa vid diskarna elle r i receptionen. Absolut f&ouml;rbjudet att g&aring; in p&aring;</li>\r\n</ul>\r\n<p>Face</p>\r\n<ul>\r\n<li>Book, bettingsidor etc. under betald arbetstid</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Det &auml;r inte till&aring;tet att ladda ner externa program eller bilder fr&aring;n Internet. Detta g&auml;ller alla</li>\r\n</ul>\r\n<p>datorer p&aring; VO Akutkliniken <br /> </p>\r\n<ul>\r\n<li>Efter 3 misslyckade f&ouml;rs&ouml;k att logga in l&aring;ses kortet och uppl&aring;sning sker p&aring;</li>\r\n</ul>\r\n<p>Kom och g&aring;</p>\r\n<ul>\r\n<li>datorn utanf&ouml;r receptionen (se l&auml;nk neda n). Du m&aring;ste ha tillg&aring;ng till din</li>\r\n</ul>\r\n<p>PIN</p>\r\n<ul>\r\n<li>kod som finns i kodkuvertet du fick tillsammans med ditt e-tj&auml;nstekort</li>\r\n</ul>\r\n<p>L&aring;sa upp kort p&aring; "Kom och g&aring;"<br /> <br /> P&aring; nedanst&aring;ende l&auml;nk finns mer information om IT</p>\r\n<ul>\r\n<li>s&auml;kerhet:</li>\r\n</ul>\r\n<p>Informations- och ITs&auml;kerhet</p>', 'it-sakerhetsrutin', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:25', '2015-03-24 20:13:25', NULL),
(19, 'Hospitering', '<p>Hospitering/erfarenhetsutbyte p&aring; andra enheter <br /> <br /> <br /> Hospitering g&auml;ller p&aring; enheter som har anknytning till akutmottagningens verk samhet som t ex <br /> akutmottagningar i Stockholm, ambulans, v&aring;rdcentraler eller verksamheter inom DSAB <br /> <br /> Hospitering kan beviljas en dag per person och &aring;r <br /> <br /> Hospitering f&aring;r endast f&ouml;rl&auml;ggas till tisdag, onsdag eller torsdag <br /> <br /> &Ouml;nskem&aring;l om hospitering l&auml;mnas till medarbetarens n&auml;rmaste chef. Detta skall ske senast d&aring; <br /> &ouml;nskem&aring;l till n&auml;sta schemaperi od l&auml;ggs in i Heroma. N&auml;r man g&aring;r p&aring; fast schema b&ouml;r en <br /> ans&ouml;kan vara inne senast 4 veckor innan &ouml;nskad hospitering. D&auml;refter beslutar Chefssk om <br /> hospiteringen kan anses relevant <br /> <br /> Blankett finns att hitta p&aring; intran&auml;tet under Akutmottagningen/Medarbetarinformation nere till <br /> h&ouml;ger <br /> <br /> Dagen skall l&auml;ggas in i Heroma som utbildning. Om situation med &ouml;verbemanning uppst&aring;r <br /> kan hospitering beviljas i fastst&auml;llt schema <br /> <br /> Hospita nten ordnar sitt bes&ouml;k sj&auml;lv men kan f&aring; tips fr&aring;n Chef och utbildningsledare <br /> <br /> <br /> En &aring;terkoppli ng till verksamheten efter en hospitering skall ske genom en kort muntlig <br /> redovisning (5</p>\r\n<ul>\r\n<li>10 min) vid ett personalm&ouml;te s&aring; att arbets kamrater och arbetsledning f&aring;r ta del</li>\r\n</ul>\r\n<p>av erfarenheterna fr&aring;n hospiteringen</p>', 'hospitering', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:26', '2015-03-24 20:13:26', NULL),
(20, 'Examensarbeten, studier och projekt vid Akutkliniken', '<p>&Ouml;nskade examensarbeten, studier och projekt vid Akutkliniken <br /> <br /> </p>\r\n<ul>\r\n<li>Studenter och andra personer som &ouml;nskar utf&ouml;ra examensarbeten, studier eller projekt p&aring;</li>\r\n</ul>\r\n<p>akutkliniken, Danderyds sjukhus AB, m&aring;ste skriftligen inkomma med ans&ouml;kan <br /> </p>\r\n<ul>\r\n<li>P&aring; ans&ouml;kan skall det framg&aring;:</li>\r\n</ul>\r\n<p>1. Titel, syfte, ev. fr&aring;g est&auml;llning samt metod <br /> 2. Om intervjustudie planeras, ska &ouml;nskat antal informanter framg&aring; samt hur urvalet <br /> sker. Uppgifter om hur texten skall analyseras ska finnas med. <br /> 3. Tidsplan f&ouml;r arbetet <br /> 4. L&auml;ros&auml;tets handledare samt kontaktuppgifter till denne <br /> </p>\r\n<ul>\r\n<li>Ans&ouml;kan skickas till patients&auml;kerhetskontroller p&aring; Akutkliniken som initierar samt diarief&ouml;r</li>\r\n</ul>\r\n<p>&auml;rendet f&ouml;r sjukhuset <br /> </p>\r\n<ul>\r\n<li>Beslut om godk&auml;nnande till examensarbete, stud ie eller projekt vid Akutkliniken tas av</li>\r\n</ul>\r\n<p>verksamhetschef, och meddela s den ans&ouml;kande skriftligen <br /> </p>\r\n<ul>\r\n<li>Arbeten f&aring;r ej p&aring;b&ouml;rjas innan godk&auml;nnande inh&auml;mtats</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Om godk&auml;nnande ges kr&auml;vs en motprest ation av den ans&ouml;kande i form av:</li>\r\n</ul>\r\n<p>1. Presentation av arbetet vid ett personalm&ouml;te p&aring; Akutkliniken <br /> 2. Arbetet publiceras p&aring; Akutklin ikens intran&auml;t. Detta sker i anslutningen till avslutad <br /> studie/examinerat arbete. <br /> </p>\r\n<ul>\r\n<li>All kontakt mellan l&auml;ros&auml;tet och kliniken sk&ouml;ts av patients&auml;kerhetscontroller</li>\r\n</ul>\r\n<p><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> Ans&ouml;kan godk&auml;nd: Ja: Nej: <br /> <br /> <br /> <br /> Beslutsfattare_________________________________________________Datum:______________ <br /> Anna F&auml;rg Hagansbo Verksamhetschef <br /> <br /> <br /> <br /> <br /> Jag godk&auml;nner ovanst&aring;ende motprestation: <br /> <br /> S&ouml;kande_____________________________________________________ Datum:_____________</p>', 'examensarbeten%2C-studier-och-projekt-vid-akutkliniken', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:27', '2015-03-24 20:13:27', NULL),
(21, 'Dokumenthantering Akuten', '<p>Redovisande dokument <br /> Samordnare: Klinikassistent Stefan Olsson <br /> Dokumenttyper: <br /> Beslut</p>\r\n<ul>\r\n<li>lokala beslut</li>\r\n</ul>\r\n<p>M&ouml;tesprotokoll/minnesanteckningar APT, personalm&ouml;te, SAMS etc. <br /> Avtal &amp; anbudsf&ouml;rfr&aring;gningar lokala avtal och anbudsf&ouml;rfr&aring;gningar <br /> Informationsmaterial lokal patienti nformation /broschyrer <br /> Rapporter VUF, m&aring;nadsr apporter, rapporter till extern enhet t.ex. socialstyrelsen <br /> <br /> Styrande dokument <br /> Samordnare: Kvalitetsutvecklare Cecilia Dejus <br /> Dokumenttyper: <br /> Riktlinjer beskriver &ouml;vergripande vad/varf&ouml;r ett moment/uppgift som ska utf&ouml;ras <br /> Instruktioner beskriver mer detaljerat hur momentet/uppgiften ska utf&ouml;ras <br /> Checklista lista med uppgifter som checkas/bockas av <br /> Rollbeskrivningar beskriver arbetsinneh&aring;ll , roller och ansvarsomr&aring;de <br /> Blanketter &ouml;vrigt framtagna blanketter <br /> <br /> Dokumenttyp Uppr&auml;ttare Fastst&auml;lls av <br /> Riktlinje VC, MAL, 1:a linjeschef, SAL, PSC <br /> Kvalitetsutvecklare, Utbildningsledare <br /> MAL (medicinskt relaterade) <br /> 1:a linjeschef (arbetsfl&ouml;den samt riktlinjer kopplade till <br /> utn&auml;mnda ansvarsomr&aring;den) <br /> VC (&ouml;vergripande riktlinjer) <br /> Instruktion VC, MAL, 1:a linjeschef, SAL, PSC <br /> Kvalitetsutvecklare, Utbildningsledare, <br /> SAS , medarbetare med ansvarsomr&aring;de <br /> MAL (medicinskt relaterade instruktioner) <br /> 1: a linjes chef (instruktioner kopplade till arbetsfl&ouml;den <br /> samt utn&auml;mnda ansvarsomr&aring;de n) <br /> VC (&ouml;vergripande instruktioner) <br /> Checklista MAL, 1:a linjeschef, SAL, PSC, <br /> Kvalitetsutvecklare, Utbildningsledare , <br /> SAS , medarbetare med ansvarsomr&aring;de <br /> 1:a linjeschef (utifr&aring;n sektion alt. ansvarsomr&aring;de g&auml;llande <br /> arbetss&auml;tt och fl&ouml;den) <br /> MAL alt SAL (sektionsbundna medicinskt relaterade) <br /> SAS (sektionsbundna g&auml;llande arbetss&auml;tt och fl&ouml;den) <br /> Rollbeskrivning VC, MAL, 1:a linjeschef, SAL, PSC, <br /> Kvalitetsutvecklare, Utbildningsledare <br /> VC (administration och stab) <br /> MAL (l&auml;kare) <br /> 1:a linjeschef (utn&auml;mnda ansvarsomr&aring;den) <br /> Blanketter 1:a linjeschef, SAL, PSC, <br /> Kvalitetsutvecklare , Utbildningsledare , <br /> SAS, medarbetare med ansvarsomr&aring;de <br /> 1:a linjeschef (utn&auml;mnda ansvarsomr&aring;den) <br /> SAS (sektionsbunden information) <br /> <br /> <br /> <br /> Granskare v&auml;ljs f&ouml;r att granska dokumentet samt dess sakinneh&aring;ll <br /> F&ouml;r att VO Akutverksamhet ska ha en gemensam struktur och kontroll &ouml;ver styrande dokument ska <br /> Kvalitetsutvecklaren per default v&auml;ljas som Slutgranskare <br /> <br /> <br /> <br /> <br /> VC Verksamhetschef <br /> MAL Medicinskt ansvarig l&auml;kare <br /> SAL Sektions ansvarig l&auml;kare <br /> PSC Patients&auml;kerhetscontroller <br /> SAS Sektionsansvarig sjuksk&ouml;terska</p>', 'dokumenthantering-akuten', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:28', '2015-03-24 20:13:28', NULL);
INSERT INTO `pms` (`id`, `title`, `content`, `token`, `verified`, `created_by`, `expiration_date`, `first_published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 'DRG-registrering av besök på Akutkliniken', '<p>Kassapersonalens ansvar</p>\r\n<ul>\r\n<li>ser till att v&aring;rdkontakt finns registrera t p&aring; korrekt sektioner d&auml;r patienten v&aring;rdats</li>\r\n</ul>\r\n<p>u nder bes&ouml;ket p&aring; AKM , hos den h&auml;lso</p>\r\n<ul>\r\n<li>och sjukv&aring;rdspersonal so m ansvarat f&ouml;r patientens v&aring;rd. Kassan</li>\r\n</ul>\r\n<p>m akulerar ankomstregistrerade v&aring;r dkontakter i kassasystemet om patienten avvikit utan att f&aring; v&aring;rd hos <br /> registrerad v&aring;rdpersonal <br /> <br /> Patientansvarig sjuksk&ouml;terska (PAS) ansvar</p>\r\n<ul>\r\n<li>meddelar receptionen om avvikande patienter, eventuella</li>\r\n</ul>\r\n<p>sektionsbyten , felsortering samt tidpunkt f&ouml;r dessa . PAS DRG</p>\r\n<ul>\r\n<li>grupperar alla l&auml;karbes&ouml;k med prelimin&auml;r kod</li>\r\n</ul>\r\n<p>samt avslutar alla v&aring;rdkontakter p&aring; Akutmottagningen via akutliggaren <br /> <br /> L&auml;karens ansvar</p>\r\n<ul>\r\n<li>ser till att sjuksk&ouml;terskor, receptionen samt med icinska sekreterare som &auml;r involverade i</li>\r\n</ul>\r\n<p>dokumenteringen av patientens bes&ouml;k p&aring; AKM f&aring;r all den information de beh&ouml;ver f&ouml;r korrekt kontakt</p>\r\n<p>registrering och DRG</p>\r\n<ul>\r\n<li>gruppering. Vid diktering av journalanteckning ska l&auml;karen tydligt ange om patienten</li>\r\n</ul>\r\n<p>skrivs in i sluten v&aring;rd (&auml;ven utplacerade satellitpatienter p&aring; annat sjukhus) , &ouml;verf&ouml;rs till annan sektion inom <br /> AKM, g&aring;r till annan v&aring;rdgivare eller l&auml;mnar AKM f&auml;rdigbehandlad. L&auml;karen ska ange relevanta diagnoser , <br /> utredningar och beha ndlingar i journalanteckningen s amt klassificera dem enligt ICD</p>\r\n<ul>\r\n<li>10 respektive KV&Aring;.</li>\r\n</ul>\r\n<p><br /> Medicinsk administrations ansvar</p>\r\n<ul>\r\n<li>skriver in de av l&auml;karen dikterade diagnos - och &aring;tg&auml;rdskoderna i</li>\r\n</ul>\r\n<p>journalen. Om v&aring;rdkontakten p&aring; Akutmottagningen inte leder till inl&auml;ggning i sluten v&aring;rd, ska sekreterar en se <br /> till att diagnoskoder och &aring;tg&auml;rdskoder f&ouml;r relevanta &aring;tg&auml;rder som gjorts under bes&ouml;ket p&aring; varje sektion p&aring; <br /> AKM rapporteras via DRG <br /> <br /> DRG</p>\r\n<ul>\r\n<li>ansvarig medicinsk sekreterare</li>\r\n</ul>\r\n<p>DRG</p>\r\n<ul>\r\n<li>ansvarig personal ser till att alla v&aring;rdkontakter p&aring; Akutmottagningen &auml;r DRG-gr upperade och godk&auml;nda</li>\r\n</ul>\r\n<p>med korrekta diagnos</p>\r\n<ul>\r\n<li>och &aring;tg&auml;rdskoder inom en vecka och har g&aring;tt &ouml;ver till GVR , samt att v&aring;rdkontakter d&auml;r</li>\r\n</ul>\r\n<p>patient avvek utan att f&aring; v&aring;rd &auml;r makulerade. <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> Rutin vid olika v &aring;rdkontakter p&aring; AKM: <br /> 1. Patienten h&auml;nvisas av pretriage alt. avviker innan triagering <br /> PAS journaldokumenterar samt D RG</p>\r\n<ul>\r\n<li>grupperar bes&ouml;ket med huvuddiagnos Z53.2 och godk&auml;nn. En</li>\r\n</ul>\r\n<p>orange lapp (&auml;ndring av klinik) l&auml;mnas ut till receptionen f&ouml;r makulering av bes&ouml;ket . I akutliggaren <br /> v&auml;lj Ta b ort patienten fr&aring;n ak utliggaren. <br /> Kassapersonal makulerar bes&ouml;ket samt ev. faktura. <br /> <br /> Aktuella diagnoskoder f&ouml;r akutens sjuksk&ouml;terskor: <br /> <br /> Z53 .2 &Aring;tg&auml;rd ej genomf&ouml;rd pga patientens besl ut av andra och icke specificerade sk&auml;l <br /> anv&auml;nds n&auml;r aktuella bes&ouml;ket ska makuleras fr&aring;n kassan <br /> Z00.0 Allm&auml;n medicinsk unders&ouml;kning <br /> anv&auml;nds f&ouml;r l&auml;karbes&ouml;k som ska DRG</p>\r\n<ul>\r\n<li>grupperas vidare av sekreterare efter diktat</li>\r\n</ul>\r\n<p>DRG</p>\r\n<ul>\r\n<li>registrering av bes&ouml;k p&aring; A kutkliniken 2 (2 )</li>\r\n</ul>\r\n<p><br /> <br /> <br /> 2. Patienten genomg&aring;r triage men avviker innan l&auml;karkontakt dvs. genomg&aring;r ett <br /> sjuksk&ouml;terskebes&ouml;k <br /> PAS journaldokumenterar bes&ouml;ket. En orange lapp (&auml;ndring av klinik) l&auml;mnas ut till receptionen f&ouml;r <br /> omregistrering till sjuksk&ouml;terskebes&ouml;k i kassasystemet . Sjuksk&ouml;terskeb es&ouml;ket journaldokumenteras . <br /> N&auml;r kassapersonalen makulerat l&auml;karbes&ouml;ket samt registrerat ett sjuksk&ouml;terskebes&ouml;k skrivs SSK <br /> f&ouml;rst i kommentarsf&auml;ltet. Bes&ouml;ket kan nu DRG</p>\r\n<ul>\r\n<li>grupperas med ja och godk&auml;nn. I akutliggaren v&auml;lj</li>\r\n</ul>\r\n<p>Ta bort patienten fr&aring;n akutliggaren. <br /> Kassapersonal makulerar l&auml;karbes&ouml;ket samt registrerar ett sjuksk&ouml;terskebes&ouml;k. Skriver SSK f&ouml;rst i <br /> kommentarsf&auml;ltet som en signal att bes&ouml;ket kan DRG</p>\r\n<ul>\r\n<li>grupperas av PAS.</li>\r\n</ul>\r\n<p>3. Patienten har tr&auml;ffat l&auml;kare <br /> Hemg&aring;ng av f&auml;rdigbehandlad patient alt. avviker innan slutligt l&auml;karbeslut <br /> (hit r&auml;knas patienter till geriatriken och psykiatrin) <br /> PAS DRG</p>\r\n<ul>\r\n<li>grupperar bes&ouml;ket under V&aring;rdkontakter med huvuddiagnos Z00.0 , gruppera och</li>\r\n</ul>\r\n<p>godk&auml;nn. I akutliggaren v&auml;lj Ta bort patienten fr&aring;n akutliggaren. <br /> Medicinsk s ekreterare ser DRG</p>\r\n<ul>\r\n<li>bilden f&ouml;r den v&aring;rdkontakt p&aring; AKM d&auml;r patienten blev</li>\r\n</ul>\r\n<p>f&auml;rdigbehandlad; ta r bort huvuddiagnos Z00.0 och ers&auml;tt er den med korrekta diagnos</p>\r\n<ul>\r\n<li>och</li>\r\n</ul>\r\n<p>&aring;tg&auml;rdskoder fr&aring;n hela bes&ouml;ket. Grupper a och godk&auml;nn. Om patient bytt sektion under <br /> bes&ouml;ket, l&auml;gg till relevanta diagnos</p>\r\n<ul>\r\n<li>och &aring;tg&auml;rdskoder fr&aring;n respektive journalanteckning.</li>\r\n</ul>\r\n<p>Inl&auml;ggning p&aring; slutenv&aring;rdsavdelning <br /> (inkl patienter till infektionskliniken eller utplacerade satellitpatienter p&aring; annat sjukhus) <br /> PAS tar upp DRG</p>\r\n<ul>\r\n<li>bilden och markera r V&aring;rdplaneringskod 1 (Akut intagning i sluten v&aring;rd)</li>\r\n</ul>\r\n<p>v&auml;lj DRG nej, markera rutan Inl&auml;ggning, gruppera och godk&auml;nn. I akutliggaren v&auml;lj Ta <br /> bort patienten fr&aring;n akutliggaren <br /> <br /> 4. Vid sektionsbyte /&ouml;vertagning <br /> L&auml;karen ska meddela tidpunkt f&ouml;r sektionsbyte till sjuksk&ouml;terska. <br /> PAS l &auml;mna r orange lapp (&auml;ndr ing av klinik) till receptionen samt f&ouml;rflyttar patienten i akutliggaren. <br /> K assapersonal registrerar nytt v&aring;rdtillf&auml;lle p&aring; nya kliniken vid den tidpunkt d&aring; patienten f&ouml;rflyttades <br /> Medicinsk sekreterare ser till att d e av l&auml;karen dikterade, f&ouml;r v&aring;rdkontakten relevanta diagnos</p>\r\n<ul>\r\n<li>och</li>\r\n</ul>\r\n<p>&aring;tg&auml;rdskoder skrivs in i respektive journal . Om anteckningen fr&aring;n den sektion d&auml;r akutbes&ouml;ket <br /> avslutas redan &auml;r skriven och v&aring;rd kontakten &auml;r DRG</p>\r\n<ul>\r\n<li>grupperad, l&auml;gg till koder som fattas, gruppera</li>\r\n</ul>\r\n<p>om och godk&auml;nn. <br /> 5. Vid felsortering <br /> PAS l &auml;mna r orange lapp (&auml;ndr ing av klinik) till receptionen samt f&ouml;rfl yttar patienten i akutliggaren <br /> Kassapersonal makulerar f&ouml;rsta l&auml;karbes&ouml;ket samt nyregistrerar ett bes&ouml;k p&aring; nya sektionen <br /> <br /> <br /> Om n&aring;got har registrerats fel ska den personalkategori som gjort den fela ktiga registreringen r&auml;tta <br /> den !</p>', 'drg-registrering-av-besok-pa-akutkliniken', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:30', '2015-03-24 20:13:30', NULL),
(23, 'Artärblodgasprov och punktion av arteria radialis –', '<p>Underlag f&ouml;r delegeringsbeslut f&ouml;r art&auml;rb lodgas och punktion av arteria radialis</p>\r\n<p>sjuksk&ouml;terska anst&auml;lld p&aring; Akutkliniken DSAB<br /> <br /> <br /> </p>\r\n<ul>\r\n<li>Den som utf&ouml;r punktionen skall ha kunskap om vilk a risker som punktionsst&auml;llet har (spasm, skada</li>\r\n</ul>\r\n<p>k&auml;rlet, hematom) <br /> </p>\r\n<ul>\r\n<li>Alltid l&auml;karordination</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>V&auml;lj v&auml;nster p&aring; h&ouml;gerh&auml;nta - h&ouml; p&aring; v&auml;nsterh&auml;nta</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Stick i h&ouml;jd med processus styloideus radi (den lilla kn&ouml;len p&aring; handledens tumsida) eller n&aring;gra cm</li>\r\n</ul>\r\n<p>proximalt d&auml;rom d&auml;r pulsationer k&auml;nns tydligast <br /> </p>\r\n<ul>\r\n<li>Vinkeln mot huden 45-90 grader</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Unders&ouml;kningshandskar</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Tv&auml;tta med klorhexidinsprit</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Komprimera 5 minuter, l&auml;ngre om patient en st&aring;r p&aring; blodf&ouml;rtunnande l&auml;kemedel</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Innan delegering av punktion av radialis f&ouml;r blodg as skall sjuksk&ouml;terskan utf&ouml;ra detta 5 g&aring;nger inf&ouml;r</li>\r\n</ul>\r\n<p>en l&auml;kare <br /> <br /> <br /> <br /> Punktion av A radialis vid 5 tillf&auml;llen inf&ouml;r l&auml;kare: <br /> <br /> Tillf&auml;lle: Datum: Signatur l&auml;kare: <br /> 1. <br /> 2. <br /> 3. <br /> 4. <br /> 5.</p>', 'artarblodgasprov-och-punktion-av-arteria-radialis-%E2%80%93', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:31', '2015-03-24 20:13:31', NULL),
(24, 'Artärblodgasprov och punktion av arteria radialis –', '<p>Delegeringsbeslut f&ouml;r sjuksk&ouml;terska <br /> <br /> Namn <br /> <br /> Personnummer <br /> <br /> Yrkestitel <br /> Sjuksk&ouml;terska <br /> Avdelning/enhet <br /> <br /> <br /> Att p&aring; l&auml;kares ordination utf&ouml; ra nedanst&aring;ende arbetsuppgift <br /> <br /> Blodgaser punktion av A radiales f&ouml;r blodgas Enligt bilaga: Art&auml;rblodgasprov och <br /> punktion av arteria radialis utbildning <br /> sjuksk&ouml;terska <br /> <br /> <br /> <br /> <br /> <br /> Enligt Lag (1998:531) 2 kap &sect; 5 och 6 om yrkesverksamhet p&aring; h&auml; lso</p>\r\n<ul>\r\n<li>och sjukv&aring;rdens omr&aring;de (LYSH) ska</li>\r\n</ul>\r\n<p>varje v&aring;rdgivare inom h&auml;lso</p>\r\n<ul>\r\n<li>och sj ukv&aring;rden sj&auml;lv b&auml;ra ansvaret f&ouml;r hur han/hon fullg&ouml;r sina arbetsuppgifter</li>\r\n</ul>\r\n<p>och ge en god v&aring;rd. &Auml;ven i Socialstyr elsens f&ouml;reskrifter och allm&auml;nna r&aring;d, SOSFS 1997:14 (M) st&aring;r det bl.a. <br /> Den arbetsuppgift som skall delegeras skall vara klart definierad. Ett beslut om delegering &auml;r personligt. Ett <br /> delegeringsbeslut skall utf&auml;rdas att g&auml;lla f&ouml;r vi ss tid h&ouml;gst ett &aring;r eller f&ouml;r ett best&auml;mt tillf&auml;ll<br /> e. <br /> Jag &auml;r medveten om mitt fulla ansvar f&ouml;r den delegerade arbetsuppgiften oc h &auml;r v&auml;l f&ouml;rtrogen med inneh&aring;llet i <br /> Socialstyrelsens f&ouml;reskrifter och allm&auml;nna r&aring;d (SOSFS 1997:14 (M)) om delegering av arbetsuppgifter inom <br /> h&auml;lso</p>\r\n<ul>\r\n<li>och sjukv&aring;rd.</li>\r\n</ul>\r\n<p><br /> G&auml;ller f&ouml;r tiden fr.o.m. T.o.m. <br /> <br /> Danderyds Sjukhus AB den <br /> Namnteckning av den som erh&aring;llit delegering <br /> <br /> Undertecknad har f&ouml;rvissat sig om att ovanst&aring;ende n&auml;mnda person har reell kompetens f&ouml;r att utf&ouml;ra <br /> ovanst&aring;ende arbetsuppgifter. <br /> <br /> Danderyds Sjukhus AB den <br /> <br /> Namn <br /> <br /> Namn <br /> Befattning <br /> Befattning</p>', 'artarblodgasprov-och-punktion-av-arteria-radialis-%E2%80%93', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:32', '2015-03-24 20:13:32', NULL),
(25, 'Ansvarsfördelning chefer kassan - receptionen', '<p>Ansvarsf&ouml;rdelning chefer kassan receptionen p&aring; Akutkliniken <br /> <br /> <br /> Sekreterarchef ansvarar &ouml;ver akutens kassa enligt f&ouml;ljande: <br /> <br /> Avgifter asyl, asyls&ouml;kande, utoml&auml;nspatienter, inoml&auml;nspatienter, utomlandspatie nter <br /> Taxakoder</p>\r\n<ul>\r\n<li>enligt lista SLL avgiftshandboken, turisthandboken</li>\r\n</ul>\r\n<p>Makuleringar av fakturor/bes&ouml;k <br /> DRG <br /> Remisshantering <br /> Nyanst&auml;llda beh&ouml;righet till PU</p>\r\n<ul>\r\n<li>web, kassan samt boka sjukreseutbildning</li>\r\n</ul>\r\n<p>Tj&auml;nsteresor <br /> Parkeringstillst&aring;nd f&ouml;r patienter och kriminalv&aring;rd <br /> RES system som visar om fakturan &auml;r betald eller inte <br /> Frikort, h&ouml;gkostnadskort <br /> Sammankoppling av identitet och reservnummer p&aring; ok&auml;nda pat. Samverka med &ouml;vriga kliniker i <br /> denna fr&aring;ga <br /> Felregistrerade patienter <br /> K&auml;nnedom om registrering av patienter i h&auml;nd else av katastrof <br /> Reception/kassa m&ouml;ten <br /> <br /> <br /> Chefsjuksk&ouml;terska f&ouml;r akutens reception ansvarar enligt f&ouml;ljande: <br /> <br /> Arbetss&auml;tt <br /> Fl&ouml;de <br /> Pretriage och samverkan med SLSO <br /> SLA <br /> Arbetss&auml;tt receptionen i h&auml;ndelse av katastrof i samr&aring;d med katastrofansvarig chefsjuksk&ouml;terska <br /> Reception/kassa m&ouml;ten</p>', 'ansvarsfordelning-chefer-kassan---receptionen', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:33', '2015-03-24 20:13:33', NULL),
(26, 'Ansvarsarbete', '<p>Ansvarsarbete - riktlinjer</p>\r\n<p><br /> <br /> x Tiden ska l&auml;ggas in i Heroma som ansvarstid <br /> <br /> x Ansvarstidens omfattning diskuteras med n&auml;rmaste chef <br /> <br /> x Ans&ouml;kan om ansvarsarbete sker i dialog med n&auml;rmaste chef som till</p>\r\n<ul>\r\n<li>eller</li>\r\n</ul>\r\n<p>avstyrker i samr&aring;d med bemanningsassistent <br /> x Om ansvarstid inte lagts in i Heroma f&aring;r ansvarstid endast tas ut om <br /> personalbemanning bed&ouml;ms vara h&ouml;g <br /> x Ansvarsarbete utf&ouml;rs p&aring; arbetsplatsen. Man byter om och st&auml;mplar in/ut som vanligt <br /> x Den som utf&ouml;r ansvarsarbete ska kunna rycka in i v&aring;rden p&aring; beg&auml;ran av <br /> arbetsledningen <br /> x Om ansvarsarbete ska utf&ouml;ras utanf&ouml;r sjukhuset, t ex f&ouml;r studiebes&ouml;k eller <br /> benchmarking, ska detta godk&auml;nnas i f&ouml;rv&auml;g</p>', 'ansvarsarbete', 0, 1, '0000-00-00', '0000-00-00', '2015-03-24 20:13:35', '2015-03-25 07:37:53', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_categories`
--

CREATE TABLE IF NOT EXISTS `pm_categories` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_roles`
--

CREATE TABLE IF NOT EXISTS `pm_roles` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_tags`
--

CREATE TABLE IF NOT EXISTS `pm_tags` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `tag` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `comment` int(10) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_type` enum('department','profession','clinic','hospital') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kirurg på Hjärkliniken', 'department', '2015-03-24 20:16:16', '2015-03-24 20:16:16', NULL),
(2, 'receptionist', 'department', '2015-03-24 20:16:26', '2015-03-24 20:16:26', NULL),
(3, 'akutmottagningen', 'department', '2015-03-24 20:16:41', '2015-03-24 20:16:41', NULL),
(4, 'undersköterska', 'department', '2015-03-24 20:16:54', '2015-03-24 20:16:54', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `tags`
--

INSERT INTO `tags` (`id`, `name`, `token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ansvar', 'ansvar', '2015-03-24 20:13:53', '2015-03-24 20:13:53', NULL),
(2, 'ansvarsarbete', 'ansvarsarbete', '2015-03-24 20:13:59', '2015-03-24 20:13:59', NULL),
(3, 'blodprov', 'blodprov', '2015-03-24 20:14:17', '2015-03-24 20:14:17', NULL),
(4, 'it', 'it', '2015-03-24 20:14:50', '2015-03-24 20:14:50', NULL),
(5, 'press', 'press', '2015-03-24 20:14:55', '2015-03-24 20:14:55', NULL),
(6, 'sjukresor', 'sjukresor', '2015-03-24 20:15:02', '2015-03-24 20:15:02', NULL),
(7, 'sjukanmälan', 'sjukanmalan', '2015-03-24 20:15:12', '2015-03-24 20:15:12', NULL),
(8, 'friskanmälan', 'friskanmalan', '2015-03-24 20:15:16', '2015-03-24 20:15:16', NULL),
(9, 'skyddad identitet', 'skyddad-identitet', '2015-03-24 20:15:24', '2015-03-24 20:15:24', NULL),
(10, 'reservnummer', 'reservnummer', '2015-03-24 20:15:32', '2015-03-24 20:15:32', NULL),
(11, 'Danderyds sjukhus', 'danderyds-sjukhus', '2015-03-24 20:15:39', '2015-03-24 20:15:39', NULL),
(12, 'post', 'post', '2015-03-24 20:15:44', '2015-03-24 20:15:44', NULL),
(13, 'miljö', 'miljo', '2015-03-24 20:15:48', '2015-03-24 20:15:48', NULL),
(14, 'dokumenthantering', 'dokumenthantering', '2015-03-24 20:15:59', '2015-03-24 20:15:59', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `real_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `privileges` enum('unverified','verified','pm-admin','admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `real_name`, `privileges`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'jonadahl@kth.se', '$2y$10$PDBRucv8ts/AM.1gG5noO.qvPV6uoVAxJOaV0wiFJQDJg4gl3lE6G', 'Jonas Dahl (Systemadmin)', 'admin', '2015-03-24 21:11:26', '2015-03-25 08:10:08', NULL, 'epEL404Sg69KulZT8xyW83XAWJYVw9kTNw6twSZz14s8m6J0HcUQGw32q0ka'),
(2, 'fredrika@jdahl.se', '$2y$10$Wa3q./2RaxcIs/K90VDqieuzGhu8FSxI.E2eosbuaCZVqG8Njtku6', 'Fredrika Svensson (PM-ansvarig)', 'pm-admin', '2015-03-24 20:18:09', '2015-03-24 20:30:57', NULL, 'e7UTlAIgbCFND4EaNnL4gKAit9lp3O2TOtVzLezKe5VARnvoQYKdbCfCLs2q'),
(3, 'maria@jdahl.se', '$2y$10$U6BKuQr75hAJ3F6gsEQNQ.KPw4fVf710I1awDi1IVkRukLuBJ0.zK', 'Maria Mogren (Verifierad)', 'verified', '2015-03-24 20:20:59', '2015-03-25 08:13:03', NULL, 'peU6ixO6ymNF8pcXjHi3e07q6jrxdtqDqsfIrjFykrkl0LBwln2m4PCac4i1'),
(4, 'pontus@jdahl.se', '$2y$10$AvjMkP7cE5QGqMva2xYbzu/MR9/ucFVQyXpsBk3gAkCgC8kspf3bK', 'Pontus Stenbäck (Overifierad)', 'unverified', '2015-03-24 20:21:24', '2015-03-24 20:28:10', NULL, 'WoQMyeWYStApvj7ovx8wKxpZA6Gebow7l8DIKFj7NCmzmMxfmYwPhId5whOy'),
(5, 'andy@jdahl.se', '$2y$10$lQdFSYk.n0B0hGIHrPnTCOICL7EepD0hbv8rsY1ruMIuMHGs2Oqgu', 'Andy Yousef', 'verified', '2015-03-25 07:38:56', '2015-03-25 07:40:06', NULL, 'xUV4ais2bKjESGD3InjxgptflEYOqmtgquSzrHFsMraXSucESNOjOizg81XZ'),

(6, 'testo@jdahl.se', '$2y$10$jfnGX/GfNuDMyrS5Fj6qTOgZRhZrsFpVDTyLeRrhhefS4R.vekNH.', 'Overifierad Lantz', 'verified', '2015-03-06 12:54:52', '2015-03-20 09:00:20', '2015-03-20 09:00:20', 'yIGkSnfroJGwCSs9QS5EXHxpnwTmoSeMQzC1eNcpGjvk3uFa29vddA9NqCQR'),
(7, 'testv@jdahl.se', '$2y$10$3hvjkf/cQoBgigcjYP48N.HIRvdmZJW15BHkKxDFODAaVG6mW4L..', 'Verifierad Dahl', 'verified', '2015-03-06 12:54:53', '2015-03-25 15:57:18', NULL, 'I4SK4LLE5ctzXD4T5ufoNCRjZv19Xd349PHgo4j5G0xZNakOS84IzEcjMxdV'),
(8, 'testa@jdahl.se', '$2y$10$jlHY20HMZENpbJoEucSFvuBLB/uwNazIk8zN8e1.KRQRT9TZ9WPhi', 'Admin Jonasson', 'admin', '2015-03-06 12:54:53', '2015-03-24 11:09:03', NULL, 'OOo3SNDgPSAOo1LmaEyGT0dWAQbdgp1fCYFzlA0GysJuKLxJlaWu2gxYw7Ja');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`), ADD KEY `assignments_user_foreign` (`user`), ADD KEY `assignments_pm_foreign` (`pm`);

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `comments_user_foreign` (`user`);

--
-- Index för tabell `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`), ADD KEY `favourites_user_foreign` (`user`), ADD KEY `favourites_pm_foreign` (`pm`);

--
-- Index för tabell `last_read`
--
ALTER TABLE `last_read`
  ADD PRIMARY KEY (`id`), ADD KEY `last_read_user_foreign` (`user`), ADD KEY `last_read_pm_foreign` (`pm`);

--
-- Index för tabell `original_files`
--
ALTER TABLE `original_files`
  ADD PRIMARY KEY (`id`), ADD KEY `original_files_pm_foreign` (`pm`);

--
-- Index för tabell `password_reminders`
--
ALTER TABLE `password_reminders`
  ADD KEY `password_reminders_email_index` (`email`), ADD KEY `password_reminders_token_index` (`token`);

--
-- Index för tabell `pms`
--
ALTER TABLE `pms`
  ADD PRIMARY KEY (`id`), ADD KEY `pms_created_by_foreign` (`created_by`), ADD FULLTEXT KEY `search` (`title`,`content`);

--
-- Index för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_categories_pm_foreign` (`pm`), ADD KEY `pm_categories_category_foreign` (`category`), ADD KEY `pm_categories_added_by_foreign` (`added_by`);

--
-- Index för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_roles_pm_foreign` (`pm`), ADD KEY `pm_roles_role_foreign` (`role`), ADD KEY `pm_roles_added_by_foreign` (`added_by`);

--
-- Index för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_tags_pm_foreign` (`pm`), ADD KEY `pm_tags_tag_foreign` (`tag`), ADD KEY `pm_tags_added_by_foreign` (`added_by`);

--
-- Index för tabell `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`), ADD KEY `reviews_pm_foreign` (`pm`), ADD KEY `reviews_user_foreign` (`user`), ADD KEY `reviews_comment_foreign` (`comment`);

--
-- Index för tabell `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`), ADD KEY `user_roles_user_foreign` (`user`), ADD KEY `user_roles_role_foreign` (`role`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `last_read`
--
ALTER TABLE `last_read`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `original_files`
--
ALTER TABLE `original_files`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT för tabell `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT för tabell `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `assignments`
--
ALTER TABLE `assignments`
ADD CONSTRAINT `assignments_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `assignments_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `favourites`
--
ALTER TABLE `favourites`
ADD CONSTRAINT `favourites_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `favourites_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `last_read`
--
ALTER TABLE `last_read`
ADD CONSTRAINT `last_read_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `last_read_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `original_files`
--
ALTER TABLE `original_files`
ADD CONSTRAINT `original_files_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`);

--
-- Restriktioner för tabell `pms`
--
ALTER TABLE `pms`
ADD CONSTRAINT `pms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
ADD CONSTRAINT `pm_categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_categories_category_foreign` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
ADD CONSTRAINT `pm_categories_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`);

--
-- Restriktioner för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
ADD CONSTRAINT `pm_roles_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_roles_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `pm_roles_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

--
-- Restriktioner för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
ADD CONSTRAINT `pm_tags_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_tags_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `pm_tags_tag_foreign` FOREIGN KEY (`tag`) REFERENCES `tags` (`id`);

--
-- Restriktioner för tabell `reviews`
--
ALTER TABLE `reviews`
ADD CONSTRAINT `reviews_comment_foreign` FOREIGN KEY (`comment`) REFERENCES `comments` (`id`),
ADD CONSTRAINT `reviews_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `reviews_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `user_roles`
--
ALTER TABLE `user_roles`
ADD CONSTRAINT `user_roles_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`),
ADD CONSTRAINT `user_roles_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
