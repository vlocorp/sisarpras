-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 10. Agustus 2012 jam 03:38
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisarpras`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absent`
--

CREATE TABLE IF NOT EXISTS `absent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_absent_user` (`user_id`),
  KEY `FK_absent_schedule` (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `absent`
--

INSERT INTO `absent` (`id`, `user_id`, `start_time`, `end_time`, `schedule_id`, `date`) VALUES
(3, 1, '12:01:13', '12:03:31', 3, '2012-08-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` int(11) DEFAULT NULL,
  `complaint` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `complaint`
--

INSERT INTO `complaint` (`id`, `ip_address`, `complaint`) VALUES
(1, 2130706433, '<p>\r\n	complaint saya bundar</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `group`
--

INSERT INTO `group` (`id`, `group`) VALUES
(1, 'Admin'),
(2, 'Laboran Kepala'),
(3, 'Laboran Staff'),
(4, 'Laboran Siswa'),
(5, 'Dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `lab`
--

INSERT INTO `lab` (`id`, `lab`) VALUES
(4, 'gx301'),
(5, 'abx201');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(256) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `day` tinyint(4) DEFAULT NULL,
  `information` text,
  `lab_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_schedule_lab` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id`, `course`, `start_time`, `end_time`, `day`, `information`, `lab_id`) VALUES
(3, 'PBO', '11:20:00', '14:00:00', 4, '<p>\r\n	- need netbeans editor</p>\r\n<p>\r\n	- need fck editor</p>\r\n', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `address` text,
  `phone` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_group` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `create_time`, `update_time`, `name`, `address`, `phone`, `email`, `last_login_time`, `group_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-08-07 13:07:00', NULL, '', '', '', 'admin@admin.com', '2012-08-09 12:13:29', 1),
(2, 'bambang', 'a9711cbb2e3c2d5fc97a63e45bbe5076', '2012-08-07 13:29:40', NULL, '', '', '', 'bambang@yahoo.com', '2012-08-09 12:12:07', 3),
(3, 'admin2', 'c84258e9c39059a89ab77d846ddab909', '2012-08-07 13:54:40', NULL, '', '', '', 'admin2@admin.com', NULL, 1),
(4, 'siti', 'db04eb4b07e0aaf8d1d477ae342bdff9', '2012-08-09 10:29:03', NULL, 'siti', '', '', 'siti@yahoo.com', NULL, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_schedule`
--

CREATE TABLE IF NOT EXISTS `user_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_schedule_schedule` (`schedule_id`),
  KEY `FK_user_schedule_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `user_schedule`
--

INSERT INTO `user_schedule` (`id`, `user_id`, `schedule_id`) VALUES
(6, 1, 3),
(7, 3, 3);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absent`
--
ALTER TABLE `absent`
  ADD CONSTRAINT `FK_absent_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_absent_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_schedule_lab` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_schedule`
--
ALTER TABLE `user_schedule`
  ADD CONSTRAINT `FK_user_schedule_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_user_schedule_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
