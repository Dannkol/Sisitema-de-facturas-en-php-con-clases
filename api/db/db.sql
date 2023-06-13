-- Active: 1686655915858@@172.16.48.210@3306@DanielManosalvaUSE;

CREATE DATABASE db_hunter_facture_DanielManosalva;
DROP DATABASE db_hunter_DanielManosalva;
USE db_hunter_facture_DanielManosalva;
CREATE TABLE tb_bills(
    n_bill INT(11) NOT NULL UNIQUE COMMENT 'Este el el campo donde se almacena el numero de la factura de o',
    bill_data DATETIME NOT NULL DEFAULT NOW() UNIQUE COMMENT 'Campo apara almacenar la fecha actual de la factura',

    PRIMARY KEY (n_bill) 
);

CREATE TABLE tb_clients(
    cc BIGINT(20) NOT NULL PRIMARY KEY COMMENT 'Identificador del cliente',
    fullname VARCHAR(255) NOT NULL COMMENT 'nombre del cliente',
    email VARCHAR(255) NOT NULL COMMENT 'email del cliente',
    address VARCHAR(255) NOT NULL COMMENT 'address del cliente',
    phone VARCHAR(255) NOT NULL COMMENT 'numero tel del cliente'
);

CREATE TABLE tb_products(
    id_product INT(11) NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'Identificador del product',
    name VARCHAR(50) NOT NULL COMMENT 'nombre del product',
    amount INT NOT NULL COMMENT 'amount del product',
    price NUMERIC(6,2) NOT NULL COMMENT 'Value del product',

    PRIMARY KEY (id_product)
);

DROP TABLE tb_products;
ALTER TABLE tb_personas MODIFY COLUMN nom_com VARCHAR(60);

TRUNCATE TABLE tb_personas;