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

CREATE TABLE material_out (
    material_out_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_code VARCHAR(50) NOT NULL,
    total INT NOT NULL,

    created_at DATE DEFAULT NULL,
    letter_number VARCHAR(50) DEFAULT NULL,
    letter_to VARCHAR(255) DEFAULT NULL,
    letter_for VARCHAR(255) DEFAULT NULL,
    based_on VARCHAR(255) DEFAULT NULL,
    contract_spk_factur VARCHAR(255) DEFAULT NULL,
    tug8_tug9 VARCHAR(255) DEFAULT NULL,
    delivery_with VARCHAR(255) DEFAULT NULL,

    FOREIGN KEY (material_code) REFERENCES material(material_code) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE transactions (
    transaction_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_code VARCHAR(50) NOT NULL,
    created_at DATE NOT NULL,
    material_description VARCHAR(50) NOT NULL,
    terima INT DEFAULT NULL,
    keluar INT DEFAULT NULL,
    keterangan VARCHAR(255) DEFAULT NULL,
    jumlah_saldo INT DEFAULT NULL,

    FOREIGN KEY (material_code) REFERENCES material(material_code) ON DELETE CASCADE ON UPDATE CASCADE
)
