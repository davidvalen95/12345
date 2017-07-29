-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2017 at 12:46 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musik`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pelajar', NULL, NULL),
(2, 'kap', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_29_085421_alter_table', 1),
(4, '2017_06_29_094524_alter_user', 1),
(5, '2017_06_30_063951_alter_user_musik', 1),
(6, '2017_07_01_083120_create_song', 1),
(9, '2017_07_01_100324_song_url', 2),
(15, '2017_07_02_115641_song_detail', 3),
(16, '2017_07_02_160654_song_user', 3),
(51, '2017_07_03_105149_pivot_song_schedule', 1),
(65, '2017_07_02_161759_song_url_alter', 4),
(66, '2017_07_02_161820_song_url_alterr', 4),
(67, '2017_07_03_040728_song_url_nullable', 4),
(68, '2017_07_03_061924_song_indexing', 4),
(69, '2017_07_03_093748_schedule', 4),
(70, '2017_07_03_094455_schedule_song', 4),
(73, '2017_07_07_150411_pivot_schedile_detail', 5),
(74, '2017_07_11_123630_user_permission', 6),
(83, '2017_07_11_123655_user_permission2', 7),
(84, '2017_07_11_135506_create_category', 7),
(85, '2017_07_11_135946_user_foreign_cateogyr', 8),
(87, '2017_07_12_093416_schedule_song_detail_order', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `due` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `due`, `created_at`, `updated_at`) VALUES
(3, '2017-07-01 00:00:00', '2017-07-07 07:13:19', '2017-07-07 07:13:19'),
(5, '2017-06-24 00:00:00', '2017-07-07 07:51:52', '2017-07-07 07:51:52'),
(7, '2017-03-04 00:00:00', '2017-07-07 07:57:47', '2017-07-07 07:57:47'),
(8, '2017-07-07 00:00:00', '2017-07-07 08:51:40', '2017-07-07 08:51:40'),
(9, '2017-07-07 00:00:00', '2017-07-07 08:51:56', '2017-07-07 08:51:56'),
(11, '2017-07-08 00:00:00', '2017-07-07 09:26:46', '2017-07-07 09:26:46'),
(13, '2017-06-03 00:00:00', '2017-07-07 21:24:16', '2017-07-07 21:24:16'),
(14, '2017-07-15 00:00:00', '2017-07-07 21:24:25', '2017-07-07 21:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_song`
--

CREATE TABLE `schedule_song` (
  `id` int(10) UNSIGNED NOT NULL,
  `song_id` int(10) UNSIGNED DEFAULT NULL,
  `schedule_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_song`
--

INSERT INTO `schedule_song` (`id`, `song_id`, `schedule_id`, `created_at`, `updated_at`) VALUES
(1, 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_song_detail`
--

CREATE TABLE `schedule_song_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `song_detail_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_song_detail`
--

INSERT INTO `schedule_song_detail` (`id`, `schedule_id`, `song_detail_id`, `created_at`, `updated_at`, `order`) VALUES
(1, 11, 9, NULL, NULL, 1),
(2, 11, 9, NULL, NULL, 1),
(6, 14, 9, NULL, NULL, 1),
(7, 14, 16, NULL, NULL, 4),
(8, 14, 17, NULL, NULL, 0),
(9, 14, 18, NULL, NULL, 2),
(10, 14, 19, NULL, NULL, 5),
(11, 14, 21, NULL, NULL, 3),
(12, 14, 20, NULL, NULL, 6),
(13, 3, 9, NULL, NULL, 1),
(14, 7, 9, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lyric` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageUrl` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT 'https://pbs.twimg.com/profile_images/710468502457442304/f-8UB2T1.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `user_id`, `title`, `lyric`, `imageUrl`, `created_at`, `updated_at`) VALUES
(1, NULL, 'dia raja', '<p></p><div>\r\n<b>Lirik Dia Raja oleh True Worshippers</b></div>\r\n<div>\r\n<br></div>\r\n<div>\r\nBersyukurlah kepada-Nya<br>Bawalah pujian bagi-Nya<br>Kar\'na Dia Raja<br>Dia yang perkasa<br><br>Tuhanlah kekuatanku<br>Mazmur dan kes\'lamatanku<br>Dia penolongku<br>Yang b\'ri hidupku<br><br>Kau yang berjaya<br>S\'luruh semesta<br>Sujud menyembah<br><br>Chorus:<br>Agunglah kebangkitan-Mu<br>Mujizat telah terjadi<br>Junjung kasih anug\'rah-Mu<br>Kekal, teguh dan mulia<br><br>Masyurlah perbuatan-Mu<br>Kau penyelamat hidupku<br>Kasih-Mu tiada tara<br>Bertahta Kau Tuhan Rajaku \r\n</div><br><p></p>', 'https://pbs.twimg.com/profile_images/710468502457442304/f-8UB2T1.jpg', '2017-07-01 04:03:33', '2017-07-01 04:03:33'),
(3, 1, 'king of majesty', '<p></p><div>You know that,<br>\r\nI love You,<br>\r\nYou know that,<br>\r\nI want to know You so much more,<br>\r\nMore than I have before<br>\r\n<br>\r\nThese words are,<br>\r\nFrom my heart,<br>\r\nThese words are,<br>\r\nNot made up,<br>\r\nI will live for You,<br>\r\nI am devoted to You,<br>\r\n<br>\r\n<i>[Pre-Chorus:]</i><br>\r\nKing of Majesty<br>\r\nI have one desire<br>\r\nJust to be with You my Lord,<br>\r\nJust to be with You my Lord,<br>\r\n<br>\r\n<i>[Chorus:]</i><br>\r\nJesus You are the Saviour of my soul<br>\r\nAnd forever and ever I\'ll give my praises to You,<br>\r\nJesus You are the Saviour of my soul<br>\r\nAnd forever and ever I\'ll give my praises to You,<br>\r\n<br>\r\n<i>[Bridge:]</i><br>\r\nJesus You are the Saviour of my soul <i>[echo]</i><br>\r\nAnd forever and ever I\'ll give my praises to You <i>[echo]</i>\r\n</div>\r\n\r\n<br><p></p>', 'https://images.genius.com/4cdf08f7cd7258614bc6b141d9ab372c.640x640x1.jpg', '2017-07-02 09:21:05', '2017-07-02 09:21:05'),
(4, 1, 'Terpujilah namamu tuhan', '<p></p><div><strong>Verse 1</strong><br>Terpujilah namaMu Tuhan<br>Kuat dan penuh kemuliaan<br>Satu suara kami nyatakan<br>KebesaranMu tetap selamanya<br><br><strong>Verse 2</strong><br>Terpujilah namaMu Tuhan<br>Ajaib dan penuh keagungan<br>Satu hati kami nyatakan<br>KerajaanMu kekal selamanya<br><br><strong>Chorus</strong><br>Engkaulah Raja atas dunia<br>Yang menghancurkan kutuk<br>Dan membebaskan jiwa<br>Kami bersorak bertepuk tangan<br>Engkau Tuhan berjaya<br>Dan mem’rintah untuk s’lamanya</div><br><p></p>', 'http://3.bp.blogspot.com/-RfgCe3Bh_90/T5OxVt1UvhI/AAAAAAAAAOU/GHpyZRIR0jM/s1600/favor_hljcc.jpg', '2017-07-03 06:04:20', '2017-07-03 06:04:20'),
(5, 1, 'dengan mu tuhan', '<p>TAK PERNAH ‘KU RAGU AKAN KESETIAAN-MU<br>\r\nKAU PEGANG HIDUPKU<br>\r\nSEPENUH JIWAKU ‘KU YAKIN DAN PERCAYA<br>\r\nKAU TUNTUN LANGKAHKU</p>\r\n<p>YESUS KAULAH RAJA DALAM HIDUPKU<br>\r\nBERKUASA BERJAYA UNTUK S’LAMANYA</p>\r\n<p>HANYA KAU TUHAN SUMBER KEKUATAN<br>\r\nKUASA-MU TERCURAH BAGIKU S’NANTIASA<br>\r\nDENGAN-MU TUHAN ’KU ‘KAN BERJALAN<br>\r\nDARI KEMULIAAN SAMPAI KEMULIAAN<br>\r\nS’LAMANYA</p>', 'https://4.bp.blogspot.com/-Awk9w_fJ35I/VGTQLeM2wSI/AAAAAAAABOM/5TGTy318as0/s1600/True%2BWorshippers%2B-%2BGlory%2BTo%2BGlory.jpg', '2017-07-03 06:21:18', '2017-07-03 06:21:18'),
(20, 1, 'Seharusnya Ku Datang', '<p></p><p>Seringkali kudatang Tuhan</p>\r\n<p>Hanya karna sejuta keluhan</p>\r\n<p>Seringkali kulupa Tuhan</p>\r\n<p>Seharusnya kudatang</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Chorus:</strong></p>\r\n<p>Dengan segenap rindu dari lubuk hatiku</p>\r\n<p>Dengan hasrat yang tulus</p>\r\n<p>Karna kucinta padaMu</p>\r\n<p>Tak hanya memikirkan</p>\r\n<p>berkat yang Kau berikan</p>\r\n<p>Sungguh hanya karnaku mengasihiMu Yesus</p>\r\n<p>&nbsp;</p>\r\n<p>Seringkali aku berdoa</p>\r\n<p>hanya karna tak ingin dicela</p>\r\n<p>Namun kini kusadar Tuhan</p>\r\n<p>seharusnya kudatang</p><br><p></p>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2EsGsAgUMf5hSxT8Dpsmxo7tf9jbxlxHs3OdWfz7ZKAb4-Mvj', '2017-07-07 21:56:39', '2017-07-07 21:56:39'),
(21, 1, 'AMAN DI DALAM-MU', '<p></p><p>ENGKAULAH PERISAIKU<br>\r\nMENARA KEKUATANKU\r\nTUHAN<br>\r\nGUNUNG BATUKU</p>\r\n<p>KAULAH PENGHARAPANKU<br>\r\nTEMPAT PERLINDUNGANKU TUHAN<br>\r\nKOTA BENTENGKU<br>\r\nYESUS KESELAMATANKU</p>\r\n<p>REFF :<br>\r\nKU S\'LALU AMAN DI DALAM TANGAN-MU<br>\r\nTERPUJILAH TUHAN S\'BAB KASIH SETIA-MU<br>\r\nKU S\'LALU BERSANDAR HANYA PADA-MU<br>\r\nTERPUJILAH TUHAN<br>\r\nTERPUJILAH TUHAN<br>\r\n</p><br><p></p>', 'https://i.ytimg.com/vi/j9davuqKHJM/hqdefault.jpg', '2017-07-07 21:59:19', '2017-07-07 21:59:19'),
(22, 1, 'Sungguh Kau', '<p></p><div>Syukur kuucapkan atas semua perbuatanMu</div><div>Hidupku diubahkan sejak Kau tinggal di dalam hatiku</div><div>Betapa kubersandar pada diriMu</div><div>TanpaMu Ku Takkan kuat</div><div>chorus</div><div><br>\r\n</div><div>Sungguh Kaulah yang terindah</div><div>Sungguh Kaulah yang kucinta</div><div>KehadiranMu ubahkan seluruh duniaku</div><div><br>\r\n</div><div>Hanya Kaulah Yang Kupandang</div><div>Hanya Kaulah Yang Kupegang</div><div>Kasih dan kebaikanMu di dalam duniaku</div><div>bridge</div><div><br>\r\n</div><div>S\'bab hanya Kau yang ubahkan duniaku, duniaku</div><div>S\'bab hanya Kau yang ubahkan duniaku, duniaku</div><div>(repeat)</div><br><p></p>', 'https://i.ytimg.com/vi/Z8jr5fcBL4A/hqdefault.jpg', '2017-07-07 22:01:34', '2017-07-07 22:01:34'),
(23, 1, 'Dengan Apa Kan Ku Balas', '<p></p><p>Kau Allah Yang Setia,<br>\r\nBapa Yang Mulia.<br>\r\nKasihMu besar Tuhan,<br>\r\nKau pulihkan hidupku.<br>\r\n<br>\r\nKaulah Harapanku,<br>\r\nhidupku dalamMu,<br>\r\nterima kasih Tuhan,<br>\r\nKau s’lamatkan hidupku.</p>\r\n<p>Dengan apa ‘kan ‘ku balas segala kebaikanMu?<br>\r\nSegenap hatiku menyembahMu Yesus,<br>\r\n‘ku bersyukur padaMu, s’lamanya,<br>\r\ns’lamanya.</p>\r\n<p>Kaulah Harapanku,<br>\r\nhidupku dalamMu,<br>\r\nterima kasih Tuhan,<br>\r\nKau s’lamatkan hidupku.</p>\r\n<p>Dengan apa ‘kan ‘ku balas segala kebaikanMu?<br>\r\nSegenap hatiku menyembahMu Yesus,<br>\r\n‘ku bersyukur padaMu. </p><br><p></p>', 'https://i.ytimg.com/vi/FViAQQlZpjs/maxresdefault.jpg', '2017-07-07 22:04:28', '2017-07-07 22:04:28'),
(24, 1, 'Kubri Yang Terbaik', '<p><strong>Verse 1</strong><br>T\'lah kutemukan kasih<br>Yang sejati tiada pernah berubah<br>Hanya di dalamMu Yesus Tuhanku<br><br><strong>Verse 2</strong><br>Kasih yang t\'lah Kau beri<br>Lebihi sgala yang terbaik dalamku<br>Tak berkesudahan, kekal selamanya<br><br><strong>Pre Chorus</strong><br>Kini kubawa kepadaMu<br>Hidupku s\'bagai persembahan<br>T\'rimalah pujian dari hatiku<br>Hanyalah untukMu<br><br><strong>Chorus</strong><br>Kub\'ri yang terbaik<br>Hanyalah bagiMu, hanya untukMu<br>Yang termulia, berkenan bagiMu<br>Biar hidupku bersinar bagi<br>Kemuliaan dan keagunganMu Tuhan<br>KebesaranMu, kub\'ri sgalanya<br>Ku b\'ri yang terbaik<br></p>', 'https://i.ytimg.com/vi/9z-Z43sLcEg/maxresdefault.jpg', '2017-07-07 22:05:32', '2017-07-07 22:05:32'),
(25, 1, 'more than enough', '<p>[Verse]<br>When the mountains fall<br>And the sea turns rough<br>“But My Word stands strong”, says the Lord<br>When the world gets tough<br>Filled with broken hearts<br>“But My Love won’t fail”, says the Lord<br><br>[Chorus]<br>Your love is powerful<br>Knees shall bow<br>Your love is mighty<br>The earth will shake<br>Your grace abounds in us<br>You’re more than enough for me<br><br>Jesus You’re able<br>To break every chain<br>Our lives in Your hands<br>You’re in control<br>Grace overflows in us<br>You’re more than enough for me<br><br>[Bridge]<br>Power, mercy, never failing<br>Stronger, deeper, never changing<br>Glorious, faithful, never ending<br>Great is our God<br></p>', 'https://i.ytimg.com/vi/4iZ6CQxXTFk/hqdefault.jpg', '2017-07-07 22:07:32', '2017-07-07 22:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `song_detail`
--

CREATE TABLE `song_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `song_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `embedUrl` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song_detail`
--

INSERT INTO `song_detail` (`id`, `song_id`, `user_id`, `title`, `embedUrl`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Hillsong United - King Of Majesty (lyrics)', 'https://www.youtube.com/embed/rcIcxXM7Wv8', 'agak funk', '2017-07-02 09:27:39', '2017-07-02 09:27:39'),
(3, 3, 1, 'King Of Majesty (Hillsongs) - CityWorship Youth', 'https://www.youtube.com/embed/0FSLwP9KmXI', 'agak nge rock', '2017-07-02 10:26:50', '2017-07-02 10:26:50'),
(4, 3, 1, 'King Of Majesty (Hillsongs) - CityWorship Youth', 'https://www.youtube.com/embed/0FSLwP9KmXI', 'asdf', '2017-07-02 10:31:23', '2017-07-02 10:31:23'),
(5, 4, 1, 'TERPUJILAH NAMAMU TUHAN-JPCC Worship', 'AL80dxIL1oE', 'basic', '2017-07-03 06:04:40', '2017-07-03 06:04:40'),
(6, 4, 1, 'JPCC Worship - Terpujilah Nama-Mu - ONE Acoustic (Official Music Video)', 'sxVPH1AiYmo', 'Accoustic. good for worship', '2017-07-03 06:10:19', '2017-07-03 06:10:19'),
(7, 4, 1, 'Terpujilah NamaMu Tuhan Guitar cover+tutorial by Aga Heraldika', 'i86jiZgs2jI', 'gitar tutorial bro..', '2017-07-03 06:13:45', '2017-07-03 06:13:45'),
(8, 4, 1, 'Terpujilah NamaMu Tuhan (Bass Cover)', '-AmRsrLScg8', 'Ada bass cover nya broo', '2017-07-03 06:15:00', '2017-07-03 06:15:00'),
(9, 1, 1, '\'DIA RAJA\' JPCC Worship/True Worshippers | HD', '0uIeJPQRmG0', 'basic', '2017-07-03 06:18:07', '2017-07-03 06:18:07'),
(10, 5, 1, '2. DENGANMU TUHAN - Glory to Glory - True Worshippers live recording (HD)', 'bMZ2vISOtoQ', 'basic', '2017-07-03 06:23:23', '2017-07-03 06:23:23'),
(12, 5, 1, 'DenganMu Tuhan - Guitar and Bass Instrumental Cover - True Worshipper - by Gary Wiryawan', 'MuHk06rLy2I', 'Cover gitar nya keren bro', '2017-07-03 06:24:29', '2017-07-03 06:24:29'),
(16, 20, 1, 'Seharusnya Kudatang - Bethany Nginden Church Indonesia', 'tuZW6V7dED4', 'bethany punya', '2017-07-07 21:57:05', '2017-07-07 21:57:05'),
(17, 21, 1, 'Aman DidalamMu - Yan Ivan Christian', 'j9davuqKHJM', 'basic', '2017-07-07 21:59:34', '2017-07-07 21:59:34'),
(18, 22, 1, 'Sungguh Kau - Sidney Mohede (Louder Than Life Sidney Mohede Live Concert).', 'doUuHodiXmA', 'basic', '2017-07-07 22:01:51', '2017-07-07 22:01:51'),
(19, 23, 1, 'Dengan Apa Kan Kubalas - OFFICIAL MUSIC VIDEO', 'FViAQQlZpjs', 'basic', '2017-07-07 22:04:43', '2017-07-07 22:04:43'),
(20, 24, 1, 'GMS I Declare - Kubri Yang Terbaik Edwin Tan', '9z-Z43sLcEg', 'basic', '2017-07-07 22:05:57', '2017-07-07 22:05:57'),
(21, 25, 1, 'JPCC Worship - More Than Enough (Official Music Video)', 'blA2JTewEqA', 'basic, very touchful', '2017-07-07 22:08:01', '2017-07-07 22:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instrument` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `instrument`, `password`, `remember_token`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'David Valentino', 'davidvalen95@gmail.com', 'Gitar', '$2y$10$7f2j50hzugEmtjqTQreKdO9h6JtlMFui1N3TPOZHytu1/45OK9SrC', 'mEV5BPB4qOS8USWYqWPkll5eymgASaiBXAhKUNlrMx2PQAFfD9OzTMk8nS6c', '2017-07-01 04:02:06', '2017-07-01 04:02:06', 1),
(2, 'Kezia Grace', 'kezia@gmail.com', 'Keyboard', '$2y$10$LyLT53E0PVnmCQtSJOjgkOQxJQCS1texLeLbounjtOv9Hq2Y.Y3Ma', NULL, '2017-07-02 07:37:14', '2017-07-02 07:37:14', 1),
(4, 'Kezia Grace', 'kezia@gmilc.c', 'Gitar', '$2y$10$Tsv1DEiX6A.T/wp9bLxhle0oloYsykN1bxD4OzvWTHeh.vrDKV6qG', NULL, '2017-07-02 07:47:34', '2017-07-02 07:47:34', 1),
(11, 'I Am Kap', 'kap@kap.com', 'Drum', '$2y$10$M./JRHDDWSX0dosEo.4Ch.QMwTEMfDZ2LmBOtwhi7YYa6.w8vVWmG', NULL, '2017-07-11 06:40:02', '2017-07-11 06:40:02', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_song`
--
ALTER TABLE `schedule_song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_song_song_id_foreign` (`song_id`),
  ADD KEY `schedule_song_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `schedule_song_detail`
--
ALTER TABLE `schedule_song_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_song_detail_schedule_id_foreign` (`schedule_id`),
  ADD KEY `schedule_song_detail_song_detail_id_foreign` (`song_detail_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_user_id_foreign` (`user_id`),
  ADD KEY `song_title_index` (`title`);

--
-- Indexes for table `song_detail`
--
ALTER TABLE `song_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_detail_song_id_foreign` (`song_id`),
  ADD KEY `song_detail_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `schedule_song`
--
ALTER TABLE `schedule_song`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schedule_song_detail`
--
ALTER TABLE `schedule_song_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `song_detail`
--
ALTER TABLE `song_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule_song`
--
ALTER TABLE `schedule_song`
  ADD CONSTRAINT `schedule_song_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_song_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_song_detail`
--
ALTER TABLE `schedule_song_detail`
  ADD CONSTRAINT `schedule_song_detail_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_song_detail_song_detail_id_foreign` FOREIGN KEY (`song_detail_id`) REFERENCES `song_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song_detail`
--
ALTER TABLE `song_detail`
  ADD CONSTRAINT `song_detail_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_detail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
