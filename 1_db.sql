
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET @database = 'Sample_blog';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Sample_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--


CREATE TABLE IF NOT EXISTS `Author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`id`, `name`, `phone`) VALUES
(1, 'Билгүүн', '99887766'),
(2, 'Батбаяр', '88776655');

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `title`, `content`, `date`, `author`) VALUES
(1, '"МИНИЙ САЙХАН ААВ" НОМОНД ТА ААВЫГАА БАГТААХ БОЛОМЖТОЙ', 'Хүний орчлонгийн дээд, амраг ханийнхаа тулах тулгуур, өмөг түшиг, үр хүүхдийнхээ\r\nамьд бурхан нь болсон аав нарынхаа хөрөг нийтлэл, гэрэл зургийг түүхэн номонд багтаан\r\nмөнжхүүлэх боломжийг бид танд олгож байна. “МИНИЙ САЙХАН ААВ  2012” номын хуудсанд\r\nаавыгаа хөрөг зурагтай нь мөнхлөхөд тань ,\r\n“Миний сайхан ээж ” “Миний сайхан аав “  цуврал    номуудыг хэвлэн гаргасан\r\n       туршлагатай хамт олон та бүхэнд    туслах болно.\r\nЭглийн эгэл хэрнээ дотроосоо үргэлж “булгилж” явдаг хүмүүс бол бидний аав нар\r\nбилээ. Улс нийгэмдээ хийсэн бүтээсэн зүйлтэй, үр хүүхэд, ач зээ, амраг ханьдаа хайр\r\nхаламжтай, бидний амьдран буй энэхэн дэлхийд хүмүүний сор нь болж ирсэн ч урлаг соёлын\r\nодод, улс төрийн зүтгэлтнүүд, уран гоолиг загвар өмсөгч охид шиг сонин бүрийн нүүрэн дээр\r\nзураг нь гараад байдаггүй, телевиз радиогоор тэдний тухай огт дурсдаггүй. Өөрийгөө\r\nрекламдаж, өндөр нэр хүндийн төлөө хөөцөлддөггүй, өөрт оноогдсон тавиландаа л эзэн нь\r\nболж, хөвгүүд, охидынхоо ирээдүйн төлөө энэ биеэ зориулсаар байдаг аавууд олон. Тэднийхээ\r\nтухай үр хүүхэд бид л дуурсгаж, олонд таниулах учиртай. Энэ бол зүгээр л нэр төр хөөцөлдсөн\r\nхэрэг биш юм. Учир нь, та аавдаа төрийн одон медаль, энд тэндэхийн лангуун дээр өрөөтэй\r\nбайдаг эрээн мяраан цом мөнгөөр худалдаж авч өгөөгүй. Хэтэрхий чамин үгээр худлаа\r\nмагтаагүй. Олонд таниулж од болгох гээгүй.\r\n“Миний аав ийм хүн байсан юм аа” гэж үр хүүхэд, ач зээ нартаа үзүүлэх бичигдсэн\r\nнамтар, хэвлэсэн зурагтай үлдэх боломж юм. Хэрвээ та энэхүү номонд аавыгаа багтаахыг\r\n            хүсвэл 89825582  95001875                  дугаарын утсаар холбогдоорой.', '2014-05-19 00:00:00', 1),
(4, 'title22', 'content content', '2014-05-19 03:30:00', 2),
(5, 'What is blog?', 'A blog (a truncation of the expression web log)[1] is a discussion or informational site published on the World Wide Web and consisting of discrete entries ("posts") typically displayed in reverse chronological order (the most recent post appears first). Until 2009 blogs were usually the work of a single individual[citation needed], occasionally of a small group, and often covered a single subject. More recently "multi-author blogs" (MABs) have developed, with posts written by large numbers of authors and professionally edited. MABs from newspapers, other media outlets, universities, think tanks, advocacy groups and similar institutions account for an increasing quantity of blog traffic. The rise of Twitter and other "microblogging" systems helps integrate MABs and single-author blogs into societal newstreams. Blog can also be used as a verb, meaning to maintain or add content to a blog.\r\n\r\nThe emergence and growth of blogs in the late 1990s coincided with the advent of web publishing tools that facilitated the posting of content by non-technical users. (Previously, a knowledge of such technologies as HTML and FTP had been required to publish content on the Web.)', '2014-05-19 18:00:00', 2),
(6, '"Эх орон" шүлэг', 'Гэрээс гараад сум орлоо<br>\r\nГэрээ би саналаа<br>\r\nСумаасаа аймаг орлоо<br>\r\nСумаа би саналаа<br>\r\nАймгаасаа хот орлоо<br>\r\nАймгаа би саналаа<br>\r\nТэндээс хэд хоноод <br>\r\nЭх орноо тэр чигээр нь саналаа', '2014-05-19 22:22:00', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
