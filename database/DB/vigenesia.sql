CREATE DATABASE IF NOT EXISTS `vigenesia` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `vigenesia`;

CREATE TABLE IF NOT EXISTS `user` (
    `iduser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(100) NOT NULL,
    `profesi` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`iduser`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `motivasi` (
    `idmotivasi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `iduser` INT UNSIGNED NOT NULL,
    `isi_motivasi` TEXT NOT NULL,
    `tanggal_input` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`idmotivasi`),
    CONSTRAINT `fk_motivasi_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO `user` (`nama`, `profesi`, `email`, `password`)
SELECT 'Demo User', 'Mahasiswa', 'demo@vigenesia.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC8K9y3M9l5N7Z4q7X6K'
WHERE NOT EXISTS (SELECT 1 FROM `user` WHERE `email` = 'demo@vigenesia.test');

INSERT INTO `motivasi` (`iduser`, `isi_motivasi`)
SELECT `iduser`, 'Tetap semangat belajar teknologi web service.'
FROM `user` WHERE `email` = 'demo@vigenesia.test'
AND NOT EXISTS (SELECT 1 FROM `motivasi` WHERE `isi_motivasi` = 'Tetap semangat belajar teknologi web service.');
