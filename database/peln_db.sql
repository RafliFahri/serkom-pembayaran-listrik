DROP TABLE IF EXISTS `tagihan`;
DROP TABLE IF EXISTS `penggunaan`;
DROP TABLE IF EXISTS `pembayaran`;
DROP TABLE IF EXISTS `pelanggan`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `tarif`;
DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tarif` (
  `id_tarif` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `daya` float(20) NOT NULL,
  `tarifperkwh` float(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
  `id_user` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `id_level` int(3) NULL,
  KEY `FK_Level` (`id_level`),
  CONSTRAINT `FK_Level` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_kwh` int(20) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_tarif` int(3) NULL,
  KEY `FK_Tarif` (`id_tarif`),
  CONSTRAINT `FK_Tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_pelanggan` int(6) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(2) NOT NULL,
  `meter_awal` float(20) NOT NULL,
  `meter_akhir` float(20) NOT NULL,
  KEY `FK_PelangganGuna` (`id_pelanggan`),
  CONSTRAINT `FK_PelangganGuna` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tagihan` (
  `id_tagihan` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_penggunaan` int(6) NOT NULL,
  `id_pelanggan` int(6) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_meter` int(10) NOT NULL,
  `status` bool NOT NULL,
  KEY `FK_Penggunaan` (`id_penggunaan`),
  KEY `FK_PelangganTagih` (`id_pelanggan`),
  CONSTRAINT `FK_Penggunaan` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PelangganTagih` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_tagihan` int(6) NOT NULL,
  `id_pelanggan` int(6) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bulan_bayar` int(2) NOT NULL,
  `biaya_admin` float(20) NOT NULL,
  `total_bayar` float(20) NOT NULL,
  `id_user` int(6) NULL,
  KEY `FK_TagihanBayar` (`id_tagihan`),
  KEY `FK_PelangganBayar` (`id_pelanggan`),
  KEY `FK_User` (`id_user`),
  CONSTRAINT `FK_TagihanBayar` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PelangganBayar` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_User` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP VIEW IF EXISTS `penggunaan_listrik`;
DROP FUNCTION IF EXISTS `get_biaya_penggunaan`;

CREATE VIEW v_bayaran_by_lunas AS
SELECT p.*
FROM pembayaran p
JOIN tagihan t ON p.id_tagihan = t.id_tagihan
WHERE t.status = 1;

CREATE VIEW v_bayaran_by_belum_lunas_proses AS
SELECT p.*, t.status
FROM pembayaran p
JOIN tagihan t ON p.id_tagihan = t.id_tagihan
WHERE t.status = 0 OR t.status IS null;

CREATE VIEW v_bayaran_by_lunas AS
SELECT p.*, t.status
FROM pembayaran p
JOIN tagihan t ON p.id_tagihan = t.id_tagihan
WHERE t.status = 1;

CREATE VIEW penggunaan_listrik AS
SELECT 
  p.id_pelanggan,
  p.bulan,
  p.tahun,
  p.meter_awal,
  p.meter_akhir,
  (p.meter_akhir - p.meter_awal) AS kwh_penggunaan,
  t.tarifperkwh,
  (p.meter_akhir - p.meter_awal) * t.tarifperkwh AS biaya_penggunaan
FROM 
  penggunaan p
  JOIN tarif t ON p.id_pelanggan = t.id_tarif
ORDER BY 
  p.id_pelanggan, p.tahun, p.bulan;


DELIMITER $$
CREATE FUNCTION get_biaya_penggunaan(id_pelanggan INT, bulan INT, tahun INT)
RETURNS FLOAT
BEGIN
  DECLARE biaya_penggunaan FLOAT;
  SELECT (p.meter_akhir - p.meter_awal) * t.tarifperkwh INTO biaya_penggunaan
  FROM penggunaan p
  JOIN tarif t ON p.id_pelanggan = t.id_tarif
  WHERE p.id_pelanggan = id_pelanggan AND p.bulan = bulan AND p.tahun = tahun;
  RETURN biaya_penggunaan;
END;
$$
DELIMITER ;

CALL sp_insert_tagihan(1, 1, 2022, 100);

DELIMITER $$
CREATE PROCEDURE update_status_tagihan(id_tagihan INT, status_new BOOL)
BEGIN
  UPDATE tagihan
  SET status = status_new
  WHERE id_tagihan = id_tagihan;
END;
$$
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_after_insert_penggunaan
AFTER INSERT ON penggunaan
FOR EACH ROW
BEGIN
    DECLARE jumlah_meter INT;

    SET jumlah_meter = NEW.meter_akhir - NEW.meter_awal;

    INSERT INTO tagihan (id_penggunaan, id_pelanggan, bulan, tahun, jumlah_meter, status)
    VALUES (NEW.id_penggunaan, NEW.id_pelanggan, NEW.bulan, NEW.tahun, jumlah_meter, FALSE);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_after_insert_tagihan
AFTER INSERT ON tagihan
FOR EACH ROW
BEGIN
    DECLARE tarifperkwh DOUBLE(10,2);
    DECLARE subtotal_bayar DOUBLE(10,2);
    DECLARE biaya_admin DOUBLE(10,2);
    DECLARE total_bayar DOUBLE(10,2);

    SELECT t.tarifperkwh INTO tarifperkwh
    FROM tarif t
    JOIN pelanggan p ON p.id_tarif = t.id_tarif
    WHERE p.id_pelanggan = NEW.id_pelanggan;

    SET subtotal_bayar = tarifperkwh * NEW.jumlah_meter;
    SET biaya_admin = subtotal_bayar * 0.01;
    SET total_bayar = subtotal_bayar + biaya_admin;

    INSERT INTO pembayaran (tanggal_pembayaran, bulan_bayar, biaya_admin, total_bayar, id_tagihan, id_pelanggan)
    VALUES (CURDATE(), NEW.bulan, biaya_admin, total_bayar, NEW.id_tagihan, NEW.id_pelanggan);
END //
DELIMITER ;