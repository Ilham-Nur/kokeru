-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2020 pada 13.51
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kokeru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti`
--

CREATE TABLE `bukti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_ruang` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_user`, `id_ruang`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-09', '2020-12-09 10:34:28', '2020-12-09 10:34:31'),
(2, 1, 2, '2020-12-09', '2020-12-09 10:34:50', '2020-12-09 10:34:52'),
(3, 1, 3, '2020-12-09', '2020-12-09 10:35:20', '2020-12-09 10:35:24'),
(4, 1, 4, '2020-12-09', '2020-12-09 10:35:40', '2020-12-09 10:35:43'),
(5, 2, 5, '2020-12-09', '2020-12-09 10:36:29', '2020-12-09 10:36:34'),
(6, 2, 6, '2020-12-09', '2020-12-09 10:36:26', NULL),
(7, 2, 7, '2020-12-09', '2020-12-09 10:36:38', NULL),
(8, 2, 8, '2020-12-09', '2020-12-09 10:36:57', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `id_jadwal`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2020-12-09 10:42:44', NULL),
(2, 2, 0, '2020-12-09 10:42:50', NULL),
(3, 3, 0, '2020-12-09 10:42:53', NULL),
(4, 4, 0, '2020-12-09 10:42:56', NULL),
(5, 5, 0, '2020-12-09 10:42:59', NULL),
(6, 6, 0, '2020-12-09 10:43:01', NULL),
(7, 7, 0, '2020-12-09 10:43:29', NULL),
(8, 8, 0, '2020-12-09 10:43:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_06_074541_create_ruang_table', 1),
(5, '2020_12_06_074733_create_jadwal_table', 1),
(6, '2020_12_06_074931_create_laporan_table', 1),
(7, '2020_12_06_075458_create_bukti_table', 1),
(8, '2020_12_06_093552_update_iduser_to_users_table', 1),
(9, '2020_12_07_202858_update_idruang_to_id', 2),
(10, '2020_12_07_203958_update_idjadwal_to_id', 3),
(11, '2020_12_07_204410_update_idlaporan_to_id', 3),
(12, '2020_12_07_204632_update_idbukti_to_id', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id`, `nama_ruang`, `created_at`, `updated_at`) VALUES
(1, 'R1', NULL, NULL),
(2, 'R2', NULL, NULL),
(3, 'R3', NULL, NULL),
(4, 'R4', NULL, NULL),
(5, 'R5', NULL, NULL),
(6, 'R6', NULL, NULL),
(7, 'R7', NULL, NULL),
(8, 'R8', NULL, '2020-12-07 14:24:22'),
(9, 'R9', NULL, NULL),
(10, 'R10', NULL, NULL),
(11, 'R11', NULL, NULL),
(12, 'R12', NULL, NULL),
(13, 'R13', NULL, NULL),
(14, 'R14', NULL, NULL),
(15, 'R15', NULL, NULL),
(16, 'R16', NULL, NULL),
(17, 'R17', NULL, NULL),
(18, 'R18', NULL, NULL),
(19, 'R19', NULL, NULL),
(20, 'R20', NULL, NULL),
(21, 'R21', NULL, NULL),
(22, 'R22', NULL, NULL),
(23, 'R23', NULL, NULL),
(24, 'R24', NULL, NULL),
(25, 'R25', NULL, NULL),
(26, 'R26', NULL, NULL),
(27, 'R27', NULL, NULL),
(28, 'R28', NULL, NULL),
(29, 'R29', NULL, NULL),
(30, 'R30', NULL, NULL),
(31, 'R31', NULL, NULL),
(32, 'R32', NULL, NULL),
(33, 'R33', NULL, NULL),
(34, 'R34', NULL, NULL),
(35, 'R35', NULL, NULL),
(36, 'R36', NULL, NULL),
(37, 'R37', NULL, NULL),
(38, 'R38', NULL, NULL),
(39, 'R39', NULL, NULL),
(40, 'R40', NULL, NULL),
(41, 'R41', NULL, NULL),
(42, 'R42', NULL, NULL),
(43, 'R43', NULL, NULL),
(44, 'R44', NULL, NULL),
(45, 'R45', NULL, NULL),
(46, 'R46', NULL, NULL),
(47, 'R47', NULL, NULL),
(48, 'R48', NULL, NULL),
(49, 'R49', NULL, NULL),
(50, 'R50', NULL, NULL),
(51, 'R51', NULL, NULL),
(52, 'R52', NULL, NULL),
(53, 'R53', NULL, NULL),
(54, 'R54', NULL, NULL),
(55, 'R55', NULL, NULL),
(56, 'R56', NULL, NULL),
(57, 'R57', NULL, NULL),
(58, 'R58', NULL, NULL),
(59, 'R59', NULL, NULL),
(60, 'R60', NULL, NULL),
(61, 'R61', NULL, NULL),
(62, 'R62', NULL, NULL),
(63, 'R63', NULL, NULL),
(64, 'R64', NULL, NULL),
(65, 'R65', NULL, NULL),
(66, 'R66', NULL, NULL),
(67, 'R67', NULL, NULL),
(68, 'R68', NULL, NULL),
(69, 'R69', NULL, NULL),
(70, 'R70', NULL, NULL),
(71, 'R71', NULL, NULL),
(72, 'R72', NULL, NULL),
(73, 'R73', NULL, NULL),
(74, 'R74', NULL, NULL),
(75, 'R75', NULL, NULL),
(76, 'R76', NULL, NULL),
(77, 'R77', NULL, NULL),
(78, 'R78', NULL, NULL),
(79, 'R79', NULL, NULL),
(80, 'R80', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manajer` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_user`, `email`, `password`, `manajer`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hadi Dartono Uwais S.Kom', 'yuniar.zizi@rahayu.desa.id', '=:dhGPMGRP=?sy\"A]II', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(2, 'Estiawan Jaiman Sitompul M.Kom.', 'uyainah.ana@dabukke.desa.id', '~m5t=b\\XW!bT}W', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(3, 'Harjasa Haryanto S.I.Kom', 'loktaviani@halimah.biz', 'tob_;L|5%', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(4, 'Julia Astuti', 'gabriella.fujiati@saefullah.my.id', 'cs\'\\GRiy`y', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(5, 'Enteng Firgantoro', 'handayani.samiah@gmail.com', '8bh.\"+l%Jwpozw(_\"', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(6, 'Shania Andriani', 'mwibowo@gmail.com', '|+-S\"5yKn', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(7, 'Wisnu Tarihoran', 'talia.nugroho@gmail.com', 'USoL\\/', 0, NULL, '2020-12-07 02:35:39', '2020-12-07 02:35:39'),
(8, 'Hafshah Safitri', 'raisa.iswahyudi@gmail.co.id', '\"j}b\"A7S&', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(9, 'Natalia Andriani', 'gawati.mulyani@yahoo.co.id', '(tG&H>adFXw}flS', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(10, 'Vino Zulkarnain', 'sirait.mursita@gmail.com', 'k/)uX@~)S36[bYoH*', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(11, 'Yuni Hasanah', 'manah.suwarno@riyanti.in', '$$HY\\s72E\"n+sOrB%P', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(12, 'Vega Anggriawan', 'novitasari.narji@rahmawati.or.id', '$_o&|-~kTOw', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(13, 'Siti Pudjiastuti', 'rini44@gmail.co.id', 'HJ#YhYk6t2{H%', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(14, 'Malika Hassanah', 'thakim@fujiati.or.id', 'BGx2r\'Q3*6XZ;+y+0A', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(15, 'Latif Latupono', 'namaga.dwi@gunarto.com', 'U11^6[a(-=', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(16, 'Ilsa Padmasari', 'jhardiansyah@gmail.co.id', ']y?Pm?G}ZDNIS}oR>m!', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(17, 'Zelaya Pertiwi S.T.', 'kairav.puspasari@kuswandari.web.id', 'r/cw)D#7\"g=K\'#\\$', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(18, 'Anom Narpati', 'aswani.utama@rahayu.name', 'UA6&K|', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(19, 'Galang Hasta Prayoga', 'wpradana@wibisono.or.id', 'i*rqxe]5', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(20, 'Marsito Sitompul', 'padma14@yahoo.com', 'sPzlN=&-u9PteAUIH', 0, NULL, '2020-12-07 02:35:40', '2020-12-07 02:35:40'),
(21, 'Manajer', 'manajer@gmail.com', '$2y$10$yX84VstGuMNQaIpCKwSlGungExpMYXM9os0PSSK3OgYRHsGFWj4r.', 1, NULL, '2020-12-07 02:35:41', '2020-12-07 02:35:41'),
(22, 'cs', 'cs@gmail.com', '$2y$10$UPh.PcbzielPUYc80kVgKurzWUDIgUzq9dLeBwa26ZPI144Z.Q8.i', 0, NULL, '2020-12-07 02:35:41', '2020-12-07 02:35:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukti`
--
ALTER TABLE `bukti`
  ADD CONSTRAINT `bukti_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
