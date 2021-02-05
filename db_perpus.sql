-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2020 pada 08.10
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` varchar(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `id_penerbit` int(10) NOT NULL,
  `id_pengarang` int(10) NOT NULL,
  `nama_buku` varchar(30) NOT NULL,
  `jumlah_buku` int(20) NOT NULL,
  `cover_buku` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `id_penerbit`, `id_pengarang`, `nama_buku`, `jumlah_buku`, `cover_buku`) VALUES
('BK01', 1, 1, 2, 'Modern Web Design', 10, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(10) NOT NULL,
  `nama_denda` varchar(20) NOT NULL,
  `harga_denda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Web Programming'),
(2, 'Android Programming');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama_mhs` varchar(35) NOT NULL,
  `prodi_mhs` varchar(20) NOT NULL,
  `alamat_mhs` varchar(50) NOT NULL,
  `notelp_mhs` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `prodi_mhs`, `alamat_mhs`, `notelp_mhs`) VALUES
('41518010023', 'Aldi Muhammad Rahim', 'Teknik Informatika', 'Jl. Pulo Harapan Indah', '087767898777');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `batas_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `foto_ktm` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(10) NOT NULL,
  `nama_penerbit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'Erlangga'),
(2, 'Kompas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(10) NOT NULL,
  `nama_pengarang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`) VALUES
(1, 'Smit Dev Community'),
(2, 'Zaenal A Rozi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(10) NOT NULL,
  `id_peminjaman` int(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `id_denda` int(10) NOT NULL,
  `total_denda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `nip` varchar(20) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `alamat_petugas` varchar(50) NOT NULL,
  `notelp_petugas` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`nip`, `nama_petugas`, `alamat_petugas`, `notelp_petugas`) VALUES
('10001', 'Sulistiyo', 'Jl. Prima Utama', '087676578921');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_pengarang` (`id_pengarang`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `nim` (`nim`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `nim` (`nim`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_denda` (`id_denda`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  ADD CONSTRAINT `pengembalian_ibfk_4` FOREIGN KEY (`id_denda`) REFERENCES `denda` (`id_denda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
