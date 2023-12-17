
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `data_karyawan` (`id`, `foto`, `nama`, `nip`, `email`, `alamat`) VALUES
(1, '657f31774b0fe.gif', 'Tiara Putri Elisa', '121140049', 'tiaraelisa78@gmail.com', 'jl. Al-barokah, Sukarame, Bandar Lampung'),
(2, '657f399f75c57.gif', 'Heni Elisa', '121981016', 'henielisa6181@gmail.com', 'Desa Rusaba, Punduh Pidada, Pesawaran'),
(3, '657f39b0160c6.gif', 'Harmila', '121985058', 'harmilamila@gmail.com', 'jl. km7 , Cibadak, Tanggerang'),
(4, '657f3ab28e296.gif', 'Novita Dwi', '	2214301064', 'nvtakhairanih@gmail.com', 'jl. P. Pisang, Waykandis, Bandar Lampung'),
(5, '657f3a716dab6.gif', 'Irwan Ferdi Kuswendi', '121140008', 'irwanferdi1502@gmail.com', 'Dusun II, Ratu Pelindung, Lampung Timur'),
(6, '657f3a8c946ba.gif', 'Andre Ferdiansah', '222009269', 'ferdiansah69@gmail.com', 'jl. Sedulur, Sukabumi, Bandar Lampung'),
(7, '657f3aece531e.gif', 'M.Ridwan', '121979055', 'wawan1979.com', 'jl. Ilir II ,Muara Enim, Palembang'),
(8, '657f3b0b875fc.gif', 'Hazoroni', '121988123', 'ronihazor@gmail.com', 'jl. Iskandarsyah, Jakarta Selatan'),
(9, '657f3855e7667.gif', 'Anis Baswedan', '123456789', 'anisbaswedan@gmail.com', 'jl. Lebakbulus II, Jakarta Selatan');

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `email`) VALUES
(1, 'Tiara Putri Elisa', 'admin', '$2y$10$vbkH4QHXMF7WDg7etlGiuOkJymyf7aZ0qxGA6CHqrkI9i7vpXOQUq', 'tiaraelisa78@gmail.com');

ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `data_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
