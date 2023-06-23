

CREATE DATABASE db_hunter_facture_DanielManosalva;
DROP DATABASE db_hunter_facture_DanielManosalva;
USE db_hunter_facture_DanielManosalva;
CREATE TABLE tb_bills(
    n_bill INT(11) NOT NULL AUTO_INCREMENT ,
    bill_date DATETIME NOT NULL DEFAULT NOW() UNIQUE ,

    PRIMARY KEY (n_bill) 
);

ALTER TABLE tb_bills AUTO_INCREMENT = 1;

CREATE TABLE tb_clients(
    cc BIGINT(20) NOT NULL PRIMARY KEY ,
    fullname VARCHAR(255) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    address VARCHAR(255) NOT NULL ,
    phone VARCHAR(255) NOT NULL 
);

CREATE TABLE tb_products(
    id_product INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    amount INT NOT NULL,
    price NUMERIC(6,2) NOT NULL,

    PRIMARY KEY (id_product)
);


ALTER TABLE tb_bills
    ADD COLUMN client_cc BIGINT(20) NOT NULL,
    ADD CONSTRAINT fk_client_cc
    FOREIGN KEY (client_cc)
    REFERENCES tb_clients (cc)
;

CREATE TABLE tb_sellers(
    id_seller INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    n_bill INT(11) NOT NULL,
    nameseller VARCHAR(100) UNIQUE,
    CONSTRAINT fk_n_bill
    FOREIGN KEY (n_bill) REFERENCES tb_bills (n_bill)
);

CREATE Table tb_bills_products(
    n_bill INT(11) NOT NULL,
    id_product INT(11) NOT NULL,
    PRIMARY KEY (n_bill, id_product),
    FOREIGN KEY (n_bill) REFERENCES tb_bills (n_bill),
    FOREIGN KEY (id_product) REFERENCES tb_products (id_product)
);

ALTER TABLE tb_bills 
    ADD COLUMN client_cc BIGINT(20) NOT NULL,
    ADD CONSTRAINT fk_client_cc
        FOREIGN KEY (client_cc) 
        REFERENCES tb_clients(cc)
;


INSERT INTO tb_clients(cc, fullname, email, address, phone) VALUES
    (123456789, 'John Doe', 'johndoe@example.com', '123 Main St', '555-123-4567'),
    (987654321, 'Jane Smith', 'janesmith@example.com', '456 Elm St', '555-987-6543'),
    (654321987, 'David Wong', 'davidwong@example.com', '789 Oak St', '555-456-7890')
;

INSERT INTO tb_products(name, amount, price) VALUES
    ('Product A', 10, 5.99),
    ('Product B', 5, 9.99),
    ('Product C', 8, 2.99)
;

INSERT INTO tb_bills(bill_date, client_cc) VALUES
    ('2023-06-14 10:30', 123456789),
    ('2023-06-14 11:45', 987654321),
    ('2023-06-14 14:20', 654321987)
;

INSERT INTO tb_bills_products(n_bill, id_product) VALUES
    (1, 1),  -- Factura 1, Producto A
    (1, 2),  -- Factura 1, Producto B
    (2, 2),  -- Factura 2, Producto B
    (2, 3),  -- Factura 2, Producto C
    (3, 1);  -- Factura 3, Producto A
;

INSERT INTO tb_sellers(nameseller, n_bill) VALUES ('Juan Smith', 1),('Juan Scot', 3),('Lucas Jams' , 3);

ALTER TABLE tb_sellers AUTO_INCREMENT = 1;

INSERT INTO tb_sellers_bills(id_seller, n_bill) VALUES(1,2),(2,1),(3,3);

SELECT * FROM tb_sellers_bills;

SELECT 
  tb_bills.bill_date AS fecha_factura,
  tb_clients.fullname AS nombre_cliente,
  tb_clients.email AS email_cliente,
  tb_products.name AS nombre_producto,
  tb_products.amount AS cantidad,
  tb_products.price AS precio_unitario,
  (tb_products.amount * tb_products.price) AS total_pagar,
  tb_sellers.nameseller AS vendedor
    FROM tb_bills 
    INNER JOIN tb_clients ON tb_bills.client_cc = tb_clients.cc
    INNER JOIN tb_bills_products ON tb_bills.n_bill = tb_bills_products.n_bill
    INNER JOIN tb_products ON tb_bills_products.id_product = tb_products.id_product
    INNER JOIN tb_sellers ON tb_sellers.n_bill = tb_bills.n_bill 
    
    WHERE tb_bills_products.n_bill = 3;


SELECT COUNT(*) INTO @CAMPER FROM tb_client;

SELECT n_bill AS "id", bill_date AS "fecha", fullname AS "cliente" FROM tb_bills INNER JOIN tb_clients ON tb_bills.client_cc = tb_clients.cc