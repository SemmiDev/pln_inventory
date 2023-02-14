DROP DATABASE IF EXISTS `pln_inventory`;
CREATE DATABASE `pln_inventory` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pln_inventory`;

CREATE TABLE material (
    material_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_code VARCHAR(50) NOT NULL UNIQUE,
    material_name VARCHAR(50) DEFAULT NULL,
    material_description VARCHAR(255) DEFAULT NULL,
    material_group VARCHAR(255) DEFAULT NULL,
    base_unit_of_measure VARCHAR(50) DEFAULT NULL,
    valuation_type VARCHAR(50) DEFAULT NULL,
    stock_sap INT DEFAULT NULL
);

CREATE TABLE transactions (
    transaction_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_id VARCHAR(50) NOT NULL,
    created_at DATE NOT NULL,
    material_description VARCHAR(50) NOT NULL,
    terima INT DEFAULT NULL,
    keluar INT DEFAULT NULL,
    keterangan VARCHAR(255) DEFAULT NULL,
    jumlah_saldo INT DEFAULT NULL,

    FOREIGN KEY (material_id) REFERENCES material(material_id) ON DELETE CASCADE ON UPDATE CASCADE
)
