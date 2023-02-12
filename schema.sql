-- scheme: mysql

CREATE DATABASE IF NOT EXISTS `pln_inventory` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pln_inventory`;

DROP TABLE IF EXISTS material_out;
DROP TABLE IF EXISTS material;

CREATE TABLE material (
    material_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_code VARCHAR(50) NOT NULL UNIQUE,
    material_name VARCHAR(50) NOT NULL,
    material_description VARCHAR(255) NOT NULL,
    material_group VARCHAR(255) NOT NULL,
    base_unit_of_measure VARCHAR(50) NOT NULL,
    valuation_type VARCHAR(50) NOT NULL,
    stock_sap INT NOT NULL
);


CREATE TABLE material_out (
    material_out_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    material_code VARCHAR(50) NOT NULL,
    total INT NOT NULL,

    created_at DATE NOT NULL,
    letter_number VARCHAR(50) NOT NULL,
    letter_to VARCHAR(255) NOT NULL,
    letter_for VARCHAR(255) NOT NULL,
    based_on VARCHAR(255) NOT NULL,
    contract_spk_factur VARCHAR(255) NOT NULL,
    tug8_tug9 VARCHAR(255) NOT NULL,
    delivery_with VARCHAR(255) NOT NULL,

    FOREIGN KEY (material_code) REFERENCES material(material_code)
)
