-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: mysql1404b.xserver.jp
-- Generation Time: Nov 09, 2023 at 09:54 AM
-- Server version: 5.7.27
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foosoo_kyoshin`
--
CREATE DATABASE IF NOT EXISTS `foosoo_kyoshin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `foosoo_kyoshin`;

-- --------------------------------------------------------

--
-- Table structure for table `configrations`
--

DROP TABLE IF EXISTS `configrations`;
CREATE TABLE IF NOT EXISTS `configrations` (
  `id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '項目 ID',
  `value1` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Value-1',
  `value2` text COLLATE utf8mb4_unicode_ci COMMENT 'Value-2',
  `setumei` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '説明'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configrations`
--

INSERT INTO `configrations` (`id`, `created_at`, `updated_at`, `subject`, `value1`, `value2`, `setumei`) VALUES
(1, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'JyukuName', '教進セミナー', NULL, '塾名'),
(2, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'DdisplayLineNumStudentsList', '15', NULL, '生徒リストの表示行数'),
(3, '2023-10-24 02:34:09', '2023-10-24 02:34:09', 'DdisplayLineNumDeliveryStudentsList', '20', NULL, 'メール配信用生徒リストの表示行数'),
(4, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'Grade', '小1,小2,小3,小4,小5,小6,中1,中2,中3,高1,高2,高3', NULL, '学年'),
(5, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'Course', '学習塾,英会話', NULL, 'コース'),
(6, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'Interval', '5', NULL, '退出時間までの最短時間（分、以上）'),
(7, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'sbjIn', '[name-student]様が入室されました。---[name-jyuku]---', NULL, '入出メッセージの件名'),
(8, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'MsgIn', '[name-protector]様\r\n				[name-student]さんが入室されました。\r\n				入出時間：[time]\r\n[footer]', NULL, '入室時メッセージ'),
(9, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'sbjOut', '[name-student]様が退出されました。---[name-jyuku]---', NULL, '退出メッセージの件名'),
(10, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'MsgOut', '[name-protector]様\r\n				[name-student]さんが退出されました。\r\n				退室時間：[time]', NULL, '入室時メッセージ'),
(11, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'MsgTest', '[name-protector]様\r\n				このメールは送信テストです。受け取られましたら、そのまま返信ください。\r\n				生徒お名前：[name-student]様\r\n				受け取られる方のお名前：[name-protector]様\r\n				送信時間：[time]', NULL, '送信テストメッセージ'),
(12, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'MsgFooter', '教進セミナー', NULL, '送信メールフッター'),
(13, '2023-10-24 02:34:09', '2023-10-25 03:59:37', 'sbjTest', 'テストメール --[name-jyuku]--', NULL, 'テストメールの件名');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_out_histories`
--

DROP TABLE IF EXISTS `in_out_histories`;
CREATE TABLE IF NOT EXISTS `in_out_histories` (
  `id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `student_serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '生徒番号',
  `target_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日付',
  `time_in` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '時間',
  `time_out` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '時間',
  `student_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '生徒氏名',
  `student_name_kana` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'セイトシメイ',
  `to_mail_address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '送り先メールアドレス',
  `from_mail_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '送り元メールアドレス'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `in_out_histories`
--

INSERT INTO `in_out_histories` (`id`, `created_at`, `updated_at`, `deleted_at`, `student_serial`, `target_date`, `time_in`, `time_out`, `student_name`, `student_name_kana`, `to_mail_address`, `from_mail_address`) VALUES
(1, '2023-10-26 00:52:51', '2023-10-26 02:39:07', NULL, '0000000000000', '2023-10-26', '2023-10-26 09:52:51', '2023-10-26 11:39:07', '鈴木 文彦', 'すずき ふみひこ', 'foosoo200@gmail.com', 'kyoushin.fb@gmail.com'),
(2, '2023-10-26 02:39:24', '2023-10-26 02:39:24', NULL, '0000000000000', '2023-10-26', '2023-10-26 11:39:24', NULL, '鈴木 文彦', 'すずき ふみひこ', 'foosoo200@gmail.com', 'kyoushin.fb@gmail.com'),
(3, '2023-11-07 07:24:09', '2023-11-07 09:47:48', NULL, '2000009867237', '2023-11-07', '2023-11-07 16:24:09', '2023-11-07 18:47:48', '中尾 真帆', 'なかお まほ', 'atsu_due_quattoro@i.softbank.jp', 'kyoushin.fb@gmail.com'),
(4, '2023-11-07 07:26:50', '2023-11-07 09:47:42', NULL, '2000009585742', '2023-11-07', '2023-11-07 16:26:50', '2023-11-07 18:47:42', '川端 直紘', 'かわばた なおひろ', 'ottimo-mattina@docomo.ne.jp', 'kyoushin.fb@gmail.com'),
(5, '2023-11-07 07:26:58', '2023-11-07 09:47:58', NULL, '2000009585735', '2023-11-07', '2023-11-07 16:26:58', '2023-11-07 18:47:58', '斎藤 健倍', 'さいとう けんばい', 'namie_weining@yahoo.co.jp', 'kyoushin.fb@gmail.com'),
(6, '2023-11-07 07:28:33', '2023-11-07 09:48:18', NULL, '2000010016808', '2023-11-07', '2023-11-07 16:28:33', '2023-11-07 18:48:18', '樋口 琴美', 'ひぐち ことみ', 'aki_take0227@yahoo.co.jp', 'kyoushin.fb@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mail_deliveries`
--

DROP TABLE IF EXISTS `mail_deliveries`;
CREATE TABLE IF NOT EXISTS `mail_deliveries` (
  `id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `student_serial` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '送り先生徒番号',
  `date_delivered` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日付',
  `student_name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配信者',
  `to_mail_address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '送り先メールアドレス',
  `from_mail_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '送り元メールアドレス',
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '件名',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '本文'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_deliveries`
--

INSERT INTO `mail_deliveries` (`id`, `created_at`, `updated_at`, `deleted_at`, `student_serial`, `date_delivered`, `student_name`, `to_mail_address`, `from_mail_address`, `subject`, `body`) VALUES
(1, NULL, NULL, NULL, '2000009867183,2000009585742', '2023-10-25 14:15:00', '内田奈那,川端直紘', '', 'awa@szemi-gp.com', 'test', 'test<br/>村田&nbsp;誠様');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_26_084330_create_students_table', 1),
(6, '2023_07_27_082149_create_configrations_table', 1),
(7, '2023_08_15_080049_create_in_out_histories_table', 1),
(8, '2023_09_25_090816_create_mail_deliveries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `serial_student` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '生徒番号',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'メールアドレス（複数の場合はカンマでつなげる）',
  `name_sei` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓',
  `name_mei` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名',
  `name_sei_kana` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'セイ',
  `name_mei_kana` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'メイ',
  `protector` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '保護者',
  `pass_for_protector` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '保護者閲覧用パスワード',
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_month` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_banti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学年',
  `elementary` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学校名',
  `junior_high` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中学校',
  `high_school` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '高校',
  `course` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '受講コース',
  `note` text COLLATE utf8mb4_unicode_ci COMMENT '備考'
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `created_at`, `updated_at`, `deleted_at`, `serial_student`, `email`, `name_sei`, `name_mei`, `name_sei_kana`, `name_mei_kana`, `protector`, `pass_for_protector`, `gender`, `birth_year`, `birth_month`, `birth_day`, `postal`, `address_region`, `address_locality`, `address_banti`, `phone`, `grade`, `elementary`, `junior_high`, `high_school`, `course`, `note`) VALUES
(1, '2023-10-24 02:34:09', '2023-11-01 04:45:38', NULL, '986718', 'akimaru0601@gmail.com,uchida1123@gmail.com', '内田', '奈那', 'うちだ', 'なな', '内田,内田', '0123', '女', NULL, NULL, NULL, '', '', '', '', NULL, '小5', NULL, NULL, NULL, '学習塾,英会話', NULL),
(7, '2023-10-24 02:34:09', '2023-11-01 04:44:50', NULL, '986708', 'arashixhare@gmail.com,kenken19801231@gmail.com', '平尾', '麻畝', 'ひらお', 'まほ', '平尾,平尾', '0123', '女', NULL, NULL, NULL, '', '', '', '', NULL, '小5', NULL, NULL, NULL, '学習塾,英会話', NULL),
(8, '2023-10-24 02:34:09', '2023-10-24 02:34:09', NULL, '986723', 'atsu_due_quattoro@i.softbank.jp', '中尾', '真帆', 'なかお', 'まほ', '中尾', '0123', '女', NULL, NULL, NULL, '', '', '', '', '', '小6', NULL, NULL, NULL, '英会話', NULL),
(11, NULL, '2023-10-26 07:36:27', NULL, '0000000', 'foosoo200@gmail.com', '鈴木', '文彦', 'すずき', 'ふみひこ', '鈴木敦', '1234', '男', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-0000', '中3', NULL, NULL, NULL, '学習塾,英会話', 'test'),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958502', 'koushin0655@gmail.com', '山内', '慎之介', 'やまうち', 'しんのすけ', '山内', '', '1', '', '', '', '', '', '', '', '043-377-1549', '中学1年生', '', '', '', '', ''),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958561', 'kumikumikumico@ymobile.ne.jp', '木山', '梓', 'きやま', 'あずさ', '木山', '', '2', '', '', '', '', '', '', '', '043-309-9813', '中学1年生', '', '', '', '', ''),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958562', 'elena3018@icloud.com', '羽富', '世翔', 'はとみ', 'つぐと', '羽富', '', '1', '', '', '', '', '', '', '', '043-375-2783', '中学1年生', '', '', '', '', ''),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958563', 'g7yczd3a@i.softbank.jp', '藤井', '琉聖', 'ふじい', 'りゅうせい', '藤井', '', '1', '', '', '', '', '', '', '', '090-1779-9931', '中学1年生', '', '', '', '', ''),
(17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958564', 'aco11n15@i.softbank.jp', '庄司', '笙甫', 'しょうじ', '', '庄司', '', '1', '', '', '', '', '', '', '', '090-1793-6468', '中学1年生', '', '', '', '', ''),
(18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958565', 'toitoiwan777@docomo.ne.jp', '穴吹', '仁衣菜', 'あなぶき', 'にいな', '穴吹', '', '2', '', '', '', '', '', '', '', '0902234-6045', '中学1年生', '', '', '', '', ''),
(19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958566', 'aki_take0227@yahoo.co.jp', '樋口', '愛実', 'ひぐち', 'まなみ', '樋口', '', '2', '', '', '', '', '', '', '', '090-9394-9029', '中学1年生', '', '', '', '', ''),
(20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958567', 'chiebailo@gmail.com', '辻村', '和香', 'つじむら', 'わか', '辻村', '', '2', '', '', '', '', '', '', '', '043-441-4164', '中学1年生', '', '', '', '', ''),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958568', 'hitomisnk@icloud.com', '遠藤', '渉', 'えんどう', 'しょう', '遠藤', '', '1', '', '', '', '', '', '', '', '090-6924-7993', '中学1年生', '', '', '', '', ''),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958569', 'yuu.19891005.yuu@gmail.com', '木原', '姫奈', 'きはら', 'ひな', '木原', '', '2', '', '', '', '', '', '', '', '080-2333-0084', '中学1年生', '', '', '', '', ''),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958570', 'usui-ms.add.mail@ezweb.ne.jp', '臼井', '美貴', 'うすい', 'みき', '臼井', '', '2', '', '', '', '', '', '', '', '043-278-5608', '小学6年生', '', '', '', '', ''),
(24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958571', 'n_sayuri24@yahoo.co.jp', '佐々木', '優菜', 'ささき', 'ゆな', '佐々木', '', '2', '', '', '', '', '', '', '', '043-307-8551', '小学6年生', '', '', '', '', ''),
(25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958572', 'o.jun-jun.o.jun-jun@docomo.ne.jp', '山下', '拓海', 'やました', 'たくみ', '山下', '', '1', '', '', '', '', '', '', '', '090-9016-4559', '小学6年生', '', '', '', '', ''),
(26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958573', 'namie_weining@yahoo.co.jp', '斉藤', '健倍', 'さいとう', 'けんばい', '斉藤', '0123', '1', '', '', '', '', '', '', '', '080-4159-9792', '小5', '', '', '', '', ''),
(27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958574', 'ottimo-mattina@docomo.ne.jp', '川端', '直紘', 'かわばた', 'なおひろ', '川端', '0123', '1', '', '', '', '', '', '', '', '043-277-0737', '小5', '', '', '', '', ''),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958575', 'akipoin@gmail.com,gotoaki2000@gmail.com', '後藤', '杏寿', 'ごとう', 'あんじゅ', '後藤,後藤', '0123', '2', '', '', '', '', '', '', '', '080-3019-0137', '小4', '', '', '', '', ''),
(29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958576', 'kanakura.lalala@gmail.com', '神長倉', '怜', 'かみなかくら', 'れん', '神長倉', '0123', '1', '', '', '', '', '', '', '', '090-2743-5569', '小4', '', '', '', '', ''),
(30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958577', '', '大川', '薫', 'おおかわ', 'すみれ', '大川', '', '2', '', '', '', '', '', '', '', '043-277-2459', '中学3年生', '', '', '', '', ''),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958578', '228msht@gmail.com', '梅本', '晴喜', 'うめもと', 'はるき', '梅本', '', '1', '', '', '', '', '', '', '', '043-278-9781', '中学3年生', '', '', '', '', ''),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958579', 'tocon.tocon@yahoo.ne.jp', '伊藤', '碧夏', 'いとう', 'みなつ', '伊藤', '', '2', '', '', '', '', '', '', '', '043-371-5818', '中学3年生', '', '', '', '', ''),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958580', 'meg.200-304ys@docomo.ne.jp', '大岩', '優', 'おおいわ', 'ゆう', '大岩', '', '1', '', '', '', '', '', '', '', '043-277-3958', '中学3年生', '', '', '', '', ''),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958581', 'meg.200-304ys@docomo.ne.jp', '大岩', '春', 'おおいわ', 'しゅん', '大岩', '', '1', '', '', '', '', '', '', '', '043-277-3958', '中学3年生', '', '', '', '', ''),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958582', 'y.harada-techno@softbank.jp', '原田', '音香', 'はらだ', 'おとか', '原田', '', '2', '', '', '', '', '', '', '', '043-278-2818', '中学3年生', '', '', '', '', ''),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958583', 'michelan-f.m.a@i.softbank.jp', '宇佐美', '佳祐', 'うさみ', 'けいすけ', '宇佐美', '', '1', '', '', '', '', '', '', '', '043-356-4940', '中学2年生', '', '', '', '', ''),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958584', 'kaorisuzuki0809@gmail.com', '鈴木', '諒成', 'すずき', 'りょうだい', '鈴木', '', '1', '', '', '', '', '', '', '', '080-6689-6123', '中学2年生', '', '', '', '', ''),
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958585', 'minmio2000@yahoo.ne.jp', '遠藤', '和喜', 'えんどう', 'かずき', '遠藤', '', '1', '', '', '', '', '', '', '', '043-277-1156', '中学2年生', '', '', '', '', ''),
(39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958586', 'nyuchi@ezweb.ne.jp', '佐々木', '結葉', 'ささき', 'ゆいは', '佐々木', '', '2', '', '', '', '', '', '', '', '090-6130-0740', '中学2年生', '', '', '', '', ''),
(40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-10-26 15:00:00', '958587', 'yukax2.mail@gmail.com', '伊藤', '将', 'いとう', 'しょう', '伊藤', '', '1', '', '', '', '', '', '', '', '043-376-7425', '中学2年生', '', '', '', '', ''),
(41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958588', '', '中北', '美海', 'なかきた', 'みう', '中北', '', '2', '', '', '', '', '', '', '', '043-307-3642', '中学2年生', '', '', '', '', ''),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958589', 'ranx2.tya.1105@gmail.com', '布施', '明日香', 'ふせ', 'あすか', '布施', '', '2', '', '', '', '', '', '', '', '043-279-7885', '中学2年生', '', '', '', '', ''),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958590', 'daishimatsunaga@gmail.com', '野元', '葵巴', 'のもと', 'あおい', '野元', '', '1', '', '', '', '', '', '', '', '070-5024-4266', '中学2年生', '', '', '', '', ''),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958591', 'hailan.li@gmail.com', '金城', '恵里紗', 'かねしろ', 'えりさ', '金城', '', '2', '', '', '', '', '', '', '', '090-9857-4280', '中学2年生', '', '', '', '', ''),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958592', 'es.sw.ucd.5.factory@gmail.com', '内田', '和花', 'うちだ', 'わか', '内田', '', '2', '', '', '', '', '', '', '', '043-278-8845', '中学2年生', '', '', '', '', ''),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958593', 'ottimo-mattina@docomo.ne.jp', '川端', '理寛', 'かわばた', '', '川端', '', '1', '', '', '', '', '', '', '', '043-277-0737', '中学2年生', '', '', '', '', ''),
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958594', 'denali6194-335@docomo.ne.jp', '井口', '玲央', 'いぐち', 'れお', '井口', '', '1', '', '', '', '', '', '', '', '043-307-3642', '高校1年生', '', '', '', '', ''),
(48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958595', '', '高橋', '奏太', 'たかはし', 'そうた', '高橋', '', '1', '', '', '', '', '', '', '', '090-4315-4293', '年中', '', '', '', '', ''),
(49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958596', '', '黒崎', '凛', 'くろさき', 'りん', '黒崎', '', '2', '', '', '', '', '', '', '', '043-377-2518', '年長', '', '', '', '', ''),
(50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958597', '', '中嶋', '咲良', 'なかじま', 'さくら', '中嶋', '', '2', '', '', '', '', '', '', '', '090-1685-5530', '年長', '', '', '', '', ''),
(51, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958598', 'newhouse@cb3.so-net.ne.jp', '兵頭', '加奈子', 'ひょうどう', 'かなこ', '兵頭', '', '2', '', '', '', '', '', '', '', '043-400-8369', '小学1年生', '', '', '', '', ''),
(52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958599', 'kao1982jp@gmail.com', '高橋', '凛', 'たかはし', 'りん', '高橋', '', '1', '', '', '', '', '', '', '', '090-4315-4293', '年中', '', '', '', '', ''),
(53, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958600', 'sasagawa.makico@gmail.com', '笹川', '夏愛', 'ささがわ', 'なつめ', '笹川', '', '2', '', '', '', '', '', '', '', '090-9159-8349', '小学1年生', '', '', '', '', ''),
(54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958601', 'vvvai1133vvv@gmail.com', '渡邊', '花衣', 'わたなべ', 'かえ', '渡邊', '', '2', '', '', '', '', '', '', '', '080-4717-1133', '小学2年生', '', '', '', '', ''),
(55, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958602', 'daisy-cleo-you@hotmail.com', '遠藤', '悠真', 'えんどう', 'ゆうま', '遠藤', '', '1', '', '', '', '', '', '', '', '080-1036-7671', '小学2年生', '', '', '', '', ''),
(56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958603', 'exile71424@gmail.com', '小林', '蓮', 'こばやし', 'れん', '小林', '', '1', '', '', '', '', '', '', '', '090-4825-4509', '小学3年生', '', '', '', '', ''),
(57, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958604', 'sakinee_x@i.softbank', '寺本', '颯', 'てらもと', 'そうた', '寺本', '', '1', '', '', '', '', '', '', '', '090-6010-0729', '小学3年生', '', '', '', '', ''),
(58, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958605', 'take0424tomo-cha@kme.biglobe.ne.jo', '塚本', '貴子', 'つかもと', 'きこ', '塚本', '', '2', '', '', '', '', '', '', '', '090-6953-0851', '小学3年生', '', '', '', '', ''),
(59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958606', 'machako.11.11.11@gmail.com', '松本', '莉央', 'まつもと', 'りお', '松本', '', '2', '', '', '', '', '', '', '', '090-2324-1534', '小学3年生', '', '', '', '', ''),
(60, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958607', 'kumaseasummer@gmail.com', '森', '夏葵', 'もり', 'なつき', '森', '', '2', '', '', '', '', '', '', '', '043-279-3840', '小学3年生', '', '', '', '', ''),
(61, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958608', '', '川端', '元博', 'かわばた', 'もとひろ', '川端', '', '1', '', '', '', '', '', '', '', '043-277-0737', '年長', '', '', '', '', ''),
(62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958609', 'masa-anjo@docomo.ne.jp', '安生', '陽音', 'あんじょう', '', '安生', '', '1', '', '', '', '', '', '', '', '043-279-4234', '小学5年生', '', '', '', '', ''),
(63, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958610', 'mai09054262717@gmail.com', '山口', '煌雅', 'やまぐち', 'こうが', '山口', '', '1', '', '', '', '', '', '', '', '090-5426-2717', '小学5年生', '', '', '', '', ''),
(64, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958611', 'hitomisnk@icloud.com', '遠藤', 'ななみ', 'えんどう', 'ななみ', '遠藤', '', '2', '', '', '', '', '', '', '', '090-6924-7993', '小学4年生', '', '', '', '', ''),
(65, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958612', 'sasagawa.makico@gmail.com', '笹川', '穂乃果', 'ささがわ', 'ほのか', '笹川', '', '2', '', '', '', '', '', '', '', '090-9159-8349', '小学4年生', '', '', '', '', ''),
(66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '958613', 'yamatin-010328@docomo.ne.jp', '篠原', '碧人', 'しのはら', 'あおと', '篠原', '', '1', '', '', '', '', '', '', '', '043-277-8719', '小学6年生', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `serial_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_sei` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓',
  `name_mei` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名',
  `name_sei_kana` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'セイ',
  `name_mei_kana` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'メイ',
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_month` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_banti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rank` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '管理者ランク',
  `note` text COLLATE utf8mb4_unicode_ci COMMENT 'メモ',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `serial_user`, `deleted_at`, `email`, `email_verified_at`, `password`, `name_sei`, `name_mei`, `name_sei_kana`, `name_mei_kana`, `gender`, `phone`, `birth_year`, `birth_month`, `birth_day`, `postal`, `address_region`, `address_locality`, `address_banti`, `rank`, `note`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'T_0000', NULL, 'awa@szemi-gp.com', NULL, '$2y$10$DMtAS0BgABqVfZRxEAUu4.xdhhIXvWnvT0/37FyX7ayjidXrnpgEO', '鈴木', '文彦', 'スズキ', 'フミヒコ', NULL, '123-4567-8901', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '学習塾,英会話', NULL, NULL, '2023-10-24 02:34:09', '2023-10-24 02:34:09'),
(2, 'T_0001', NULL, 'kyoushin.fb@gmail.com', NULL, '$2y$10$zEoNu./loiBWb8l1TfpGAenNZpPc3gbm5aP821JZckFFG9BmKyi92', '松浦', '重雅', 'マツウラ', 'シゲマサ', NULL, '123-4567-8901', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '学習塾,英会話', NULL, 't0RxfJkLRHNyLRwiZvQz00v0YUQO630zo3h3cKEG54IzyVxzggL5UAtKXZda', '2023-10-24 02:34:09', '2023-10-24 02:34:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configrations`
--
ALTER TABLE `configrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `in_out_histories`
--
ALTER TABLE `in_out_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_deliveries`
--
ALTER TABLE `mail_deliveries`
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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_serial_student_unique` (`serial_student`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_serial_user_unique` (`serial_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configrations`
--
ALTER TABLE `configrations`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `in_out_histories`
--
ALTER TABLE `in_out_histories`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mail_deliveries`
--
ALTER TABLE `mail_deliveries`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
