-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2022 pada 03.54
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id_detail` int(11) NOT NULL,
  `id_hama_penyakit` varchar(4) NOT NULL,
  `id_gejala` varchar(4) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id_detail`, `id_hama_penyakit`, `id_gejala`, `bobot`) VALUES
(15, 'H1', 'G1', 0.7),
(16, 'H1', 'G2', 0.7),
(17, 'H1', 'G3', 0.5),
(18, 'H2', 'G4', 0.7),
(19, 'H2', 'G5', 0.5),
(20, 'H3', 'G4', 0.7),
(21, 'H3', 'G6', 0.9),
(22, 'H4', 'G7', 0.7),
(23, 'H4', 'G8', 0.5),
(24, 'H5', 'G9', 0.7),
(25, 'H5', 'G10', 0.4),
(26, 'H5', 'G11', 0.5),
(27, 'H6', 'G3', 0.7),
(28, 'H6', 'G12', 0.5),
(29, 'H7', 'G36', 0.7),
(30, 'H7', 'G37', 0.5),
(31, 'H8', 'G38', 0.8),
(32, 'H9', 'G39', 0.7),
(33, 'H10', 'G40', 0.7),
(34, 'H11', 'G41', 0.6),
(35, 'H12', 'G42', 0.5),
(36, 'P1', 'G13', 0.8),
(37, 'P1', 'G14', 0.8),
(38, 'P1', 'G15', 0.8),
(39, 'P1', 'G16', 0.5),
(40, 'P2', 'G17', 0.7),
(41, 'P2', 'G18', 0.7),
(42, 'P2', 'G19', 0.7),
(43, 'P3', 'G20', 0.8),
(44, 'P3', 'G21', 0.7),
(45, 'P3', 'G22', 0.6),
(46, 'P4', 'G23', 0.5),
(47, 'P4', 'G24', 0.5),
(48, 'P5', 'G25', 0.5),
(49, 'P5', 'G26', 0.5),
(50, 'P6', 'G27', 0.5),
(51, 'P7', 'G28', 0.7),
(52, 'P7', 'G13', 0.6),
(53, 'P7', 'G14', 0.5),
(54, 'P8', 'G29', 0.8),
(55, 'P8', 'G30', 0.7),
(56, 'P9', 'G31', 0.8),
(57, 'P9', 'G32', 0.6),
(58, 'P10', 'G33', 0.8),
(59, 'P10', 'G34', 0.6),
(60, 'P11', 'G35', 0.6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_riwayat`
--

CREATE TABLE `detail_riwayat` (
  `id_detail` int(11) NOT NULL,
  `id_riwayat` varchar(5) NOT NULL,
  `id_gejala` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_riwayat`
--

INSERT INTO `detail_riwayat` (`id_detail`, `id_riwayat`, `id_gejala`) VALUES
(1, '4OMWo', 'G1'),
(2, '4OMWo', 'G2'),
(3, 'A7FXP', 'G23'),
(4, 'A7FXP', 'G24'),
(5, 'A7FXP', 'G31'),
(6, 'A7FXP', 'G34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` varchar(4) NOT NULL,
  `no_gejala` int(11) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `no_gejala`, `nama_gejala`) VALUES
('G1', 1, 'Terdapat titik merah pada daun'),
('G10', 10, 'Terdapat bercak - bercak hitam di tengah daun'),
('G11', 11, 'Batang berlubang dan daun sobek'),
('G12', 12, 'Tanaman menjadi kerdil'),
('G13', 13, 'Tanaman tampak layu'),
('G14', 14, 'Daun berwarna kuning pucat, melepuh, lembab dan berair'),
('G15', 15, 'Keluar cairan kuning berbau busuk saat daun dipijit'),
('G16', 16, 'Daun atau batang semu terlihat besar, tetapi lembek'),
('G17', 17, 'Daun bercak, basah, dan berwarna cokelat kehitaman'),
('G18', 18, 'Disekitar perakaran dijumpai miselium cendawan berwarna putih'),
('G19', 19, 'Akar keriput, berubah menjadi cokelat dan akhirnya putus'),
('G2', 2, 'Terdapat luka nekrosis berupa titik merah pada daun'),
('G20', 20, 'Daun menjadi pucat kuning, kering dan melintir'),
('G21', 21, 'Bagian atas tanaman layu dan mati'),
('G22', 22, 'Akar membusuk'),
('G23', 23, 'Ada bercak bening di daun, batang dan akar'),
('G24', 24, 'Pangkal anggrek menjadi busuk dan tanaman pun rebah'),
('G25', 25, 'Daun berubah warna menjadi kuning kecoklatan / ada bercak kecoklatan'),
('G26', 26, 'Tanaman kerdil'),
('G27', 27, 'Biji tidak tumbuh dengan baik'),
('G28', 28, 'Pangkal batang ditekan mengeluarkan cairan'),
('G29', 29, 'Muncul bercak kuning tidak merata'),
('G3', 3, 'Daun keriput dan rontok'),
('G30', 30, 'Daun menghitam dengan pinggir kuning'),
('G31', 31, 'Bercak coklat/hitam di permukaan daun'),
('G32', 32, 'Bercak coklat di seluruh bagian tanaman'),
('G33', 33, 'Bercak berwarna coklat atau kemerahan pada bunga yang telah mekar'),
('G34', 34, 'Ukuran bercak sangat kecil dan membulat'),
('G35', 35, 'Terdapat bercak membulat pada daun'),
('G36', 36, 'Tanaman menguning, kemudian berubah menjadi coklat dan mati'),
('G37', 37, 'Tanaman kurus dan kering'),
('G38', 38, 'Bagian akar dalam tanah maupun luar rusak'),
('G39', 39, 'Bentuk daun muda menjadi tidak beraturan'),
('G4', 4, 'Terdapat bercak keperakan di permukaan daun'),
('G40', 40, 'Menyerang akar muda dan tunas pada tanaman, sehingga tanaman akar mudah cepat layu dan mati'),
('G41', 41, 'Terdapat telur pada kuntum bunga sehingga bunga menjadi cacat dan menguning'),
('G42', 42, 'Daun muda terluka'),
('G5', 5, 'Putik bunga tidak mekar sempurna, kering dan rontok'),
('G6', 6, 'Daun, akar dan bunga berlubang'),
('G7', 7, 'Tunas, pucuk, kuncup bunga terlihat kerdil, terhambat pertumbuhannya'),
('G8', 8, 'Terdapat banyak semut dan cendawan serta jelaga berwarna hitam'),
('G9', 9, 'Terdapat luka - luka kecil di permukaan daun, terutama pucuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hama_penyakit`
--

CREATE TABLE `hama_penyakit` (
  `id_hama_penyakit` varchar(4) NOT NULL,
  `no_hama_penyakit` int(11) NOT NULL,
  `nama_hama_penyakit` text NOT NULL,
  `solusi` text NOT NULL,
  `foto` text NOT NULL,
  `status` varchar(1) NOT NULL COMMENT '1 = hama, 2 = penyakit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hama_penyakit`
--

INSERT INTO `hama_penyakit` (`id_hama_penyakit`, `no_hama_penyakit`, `nama_hama_penyakit`, `solusi`, `foto`, `status`) VALUES
('H1', 1, 'Hama tungau merah', '<strong>Mengatasi</strong><br />\r\n1. Menyemprot air dengan tekanan tinggi, Pengendalian tungau dengan obat akarisida,&nbsp;<br />\r\n2. Daun dilap dengan sabun/alkohol, Membuat cairan semprot sabun + minyak goreng + bawang putih', '/uploads/hama/Screenshot_1.png', '1'),
('H10', 10, 'Hama kutu babi', '<strong>Mengatasi</strong><br />\r\n1. Meremdam pot tanaman yang terserang', '/uploads/hama/Screenshot_10.png', '1'),
('H11', 11, 'Hama liriomryza', '<strong>Mengatasi</strong><br />\r\n1. Menggunakan&nbsp;insektisida yang&nbsp;mengandung bahan aktif imidakloprid&nbsp;', '/uploads/hama/Screenshot_11.png', '1'),
('H12', 12, 'Hama tikus', '<strong>Mengatasi</strong><br />\r\n1. Secara mekanik dan rodentisida', '/uploads/hama/Screenshot_12.png', '1'),
('H2', 2, 'Hama thrips', '<strong>Mengatasi</strong><br />\r\n1. Bagian tanaman yang terserang dipangkas dan di buang agar thrips tidak berpindah ke tempat lain<br />\r\n2. Setelah dipangkas, disemprot insektisida bersifat sistemik', '/uploads/hama/Screenshot_2.png', '1'),
('H3', 3, 'Hama siput dan keong', '<strong>Mengatasi</strong><br />\r\n1. Pemberian larutan garam pada tanaman yang terserang hama<br />\r\n2. Tangkap secara manual jika hama tidak terlalu banyak<br />\r\n3. Menciptakan lingkungan yang tidak lembab dan kotor, seperti meletakkan daun atau tanah kering supaya tanah atau media tanam tidak terlalu lembab dan basah<br />\r\n4. Pemberian insektisida pada tanaman yang terserang hama<br />\r\n&nbsp;', '/uploads/hama/Screenshot_3.png', '1'),
('H4', 4, 'Hama aphids', '<strong>Mengatasi&nbsp;</strong><br />\r\n1. Menggunakan obat diazinon 600 cc', '/uploads/hama/Screenshot_4.png', '1'),
('H5', 5, 'Hama kumbang gajah', '<p><strong>Mengatasi &nbsp;</strong><br />\r\n1. Gunakan insektisida sistematik secara rutin</p>\r\n', '/uploads/hama/Screenshot_5.png', '1'),
('H6', 6, 'Hama kutu perisai', '<strong>Mengatasi</strong><br />\r\n1. Pada tahap awal masih bisa dibasmi secara mekanis yaitu digosok dengan kapas dan air sabun&nbsp;<br />\r\n2. Jika serangan sudah parah, disemprot dengan insektisida dengan konsentrasi larutan 2 cc / liter air<br />\r\n&nbsp;', '/uploads/hama/Screenshot_6.png', '1'),
('H7', 7, 'Hama kutu wol', '<strong>Mengatasi</strong><br />\r\n1. Menjaga sanitasi tanaman<br />\r\n2. Menyemprotkan insektisida yang bagus misal Decis 2,5 EC, Perfekthion 400 EC, atau demicron 50 SCW', '/uploads/hama/Screenshot_7.png', '1'),
('H8', 8, 'Hama semut', '<strong>Mengatasi&nbsp;</strong><br />\r\n1. Meredam pot tanaman dengan air<br />\r\n2. Melakukan penyiangan lingkungan dengan maksimal', '/uploads/hama/Screenshot_8.png', '1'),
('H9', 9, 'Hama belalang', '<strong>Mengatasi</strong><br />\r\n1. Membuang secara manual<br />\r\n2. Menyemprot&nbsp;insektisida&nbsp;sesuai&nbsp;petunjuk&nbsp;', '/uploads/hama/Screenshot_9.png', '1'),
('P1', 1, 'Penyakit busuk lunak', '<strong>Mengatasi&nbsp;</strong><br />\r\n1. Potong tanaman atau bakar yang terinfeksi penyakit<br />\r\n2. Pastikan tempat tanam dari tanaman anggrek tidak terlalu lembab dan basah<br />\r\n&nbsp;', '/uploads/penyakit/Screenshot_13.png', '2'),
('P10', 10, 'Penyakit botrytis sp', 'Mengatasi<br />\r\n1. Menyemprotkan fungisida<br />\r\n2. Membersihkan dan membuang bagian tanaman anggrek yang terserang penyakit<br />\r\n3. Perendaman tanaman dan media tanam dengan fungisida<br />\r\n4. Menjaga lingkungan tetap bersih, sirkulasi udara lancar dan cukup sinar matahari&nbsp;', '/uploads/penyakit/Screenshot_22.png', '2'),
('P11', 11, 'Penyakit bercak cincin', 'Mengatasi<br />\r\n1. Melakukan sanitasi lahan<br />\r\n2. Menyeterilkan alat potong dengan maksimal&nbsp;', '/uploads/penyakit/Screenshot_23.png', '2'),
('P2', 2, 'Penyakit busuk hitam', 'Mengatasi<br />\r\n1. Menyemprotkan fungisida<br />\r\n2. Membersihkan dan membuang bagian tanaman anggrek yang terserang penyakit<br />\r\n3. Perendaman tanaman dan media tanam dengan fungisida&nbsp;<br />\r\n4. Menjaga lingkungan tetap bersih, sirkulasi udara lancar dan cukup sinar matahari&nbsp;', '/uploads/penyakit/Screenshot_14.png', '2'),
('P3', 3, 'Penyakit layu fusarium', 'Mengatasi<br />\r\n1. Saat pindah tanam akar dapat direndam fungisida<br />\r\n2. Luka pada rimpang saat perbanyakan tanaman dapat diolesi antrocol atau M-45<br />\r\n3. Penyemprotan dengan benlate', '/uploads/penyakit/Screenshot_15.png', '2'),
('P4', 4, 'Penyakit rebah bibit', 'Mengatasi<br />\r\n1. Bibit yang terserang penyakit segera dibuang atau dimusnahkan, jika perlu dibakar<br />\r\n2. Pot dan kumpulan kecambah di keringkan dan di semprot fungisida', '/uploads/penyakit/Screenshot_16.png', '2'),
('P5', 5, 'Penyakit antraknosa', '<p>Mengatasi<br />\r\n1. Secara mekanis dengan memusnahkan tanaman yang terserang dan tidak memegang tanaman yang sehat setelah memegang tanaman yang terserang penyakit<br />\r\n2. Rotasi atau pergiliran tanaman<br />\r\n3. Sanitasi dan drainase yang benar<br />\r\n4. Penggunaan agens hayati yang berbahan aktif pseodomas flurescent dan thrichoderma sp, misalnya dengan agens hayati <strong>BIO-SPF</strong> dan <strong>MOSA GLIO</strong><br />\r\n5. Pemberian PGPR (Plant Growth Promoting Rizobacter) dapat membantu meningkatkan ketahanan tanaman anggrek dari serangan penyakit&nbsp;</p>\r\n', '/uploads/penyakit/Screenshot_17.png', '2'),
('P6', 6, 'Penyakit buluk', 'Mengatasi&nbsp;<br />\r\n1. Melakukan penyeterilan tanaman media persemaian<br />\r\n2. Menggunakan benih tanah penyakit dan melakukan perendaman biji terlebih dahulu dengan larutan fungsida&nbsp;', '/uploads/penyakit/Screenshot_18.png', '2'),
('P7', 7, 'Penyakit busuk akar', 'Mengatasi<br />\r\n1. Pengendalian dengan fungisida seperti benlate, diethane M-45, vondoszeb 80 WP, baycor atau truban', '/uploads/penyakit/Screenshot_19.png', '2'),
('P8', 8, 'Penyakit bercak daun', 'Mengatasi<br />\r\n1. Dapat diatasi dengan agrimycine atau cuprocide 54-J, asal tidak terlambat', '/uploads/penyakit/Screenshot_20.png', '2'),
('P9', 9, 'Penyakit bercak coklat', 'Mengatasi&nbsp;<br />\r\n1. Mengurangi kelembaban tanah<br />\r\n2. Memotong dan dibuang bagian yang terserang penyakit<br />\r\n3. Penggunaan agens hayati yang berbahan aktif pseodomas flurescent dan thrichoderma sp, misalnya dengan agens hayati <strong>BIO-SPF</strong> dan <strong>MOSA GLIO</strong><br />\r\n4.Pemberian PGPR (Plant Growth Promoting Rizobacter) dapat membantu meningkatkan ketahanan tanaman anggrek dari serangan penyakit&nbsp;', '/uploads/penyakit/Screenshot_21.png', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_user`, `created_at`, `status`) VALUES
('4OMWo', 4, '2022-01-17 19:15:33', 1),
('A7FXP', 4, '2022-01-17 19:29:30', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama`, `is_active`, `status`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '1'),
(4, 'Pdimas429@gmail.com', '202cb962ac59075b964b07152d234b70', 'Dimas', '1', '2'),
(5, 'pdimas1711@gmail.com', '202cb962ac59075b964b07152d234b70', 'Wahyu', '0', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `detail_riwayat`
--
ALTER TABLE `detail_riwayat`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indeks untuk tabel `hama_penyakit`
--
ALTER TABLE `hama_penyakit`
  ADD PRIMARY KEY (`id_hama_penyakit`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `detail_riwayat`
--
ALTER TABLE `detail_riwayat`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
