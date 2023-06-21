
CREATE DATABASE JuanJData;
DROP DATABASE JuanJData;
USE JuanJData;
CREATE TABLE tb_personas(
    cc INT(11) NOT NULL COMMENT 'campo para almacenar la cedula de los usuario',
    nom_com VARCHAR(57) DEFAULT 'No hay nombre' COMMENT 'campo para almacenar el nombre completo de los usuario',
    edad INTEGER(3) NOT NULL COMMENT 'campo para almacenar la edad de los usuario',
    PRIMARY KEY(cc)
);
DROP TABLE tb_personas;
ALTER TABLE tb_personas MODIFY COLUMN nom_com VARCHAR(65);
SELECT CURRENT_DATE; /*toma la fecha al momento */
SELECT CURRENT_TIME; /*toma la hora al momento */
SELECT NOW(); /*toma la fecha y la hora al momento */

/* ejercicio */
CREATE DATABASE db_hunter_facture_JuanJoseD;
DROP DATABASE db_hunter_facture_JuanJoseD;

USE db_hunter_facture_JuanJoseD;
CREATE TABLE tb_invoice(
    n_invoice VARCHAR(25) NOT NULL PRIMARY KEY COMMENT 'numero unico de la factura con las combinaciones respectivas',
    invoice_date DATETIME NOT NULL DEFAULT NOW() UNIQUE COMMENT 'Fecha de generacion de la factura'
);
CREATE TABLE tb_seller(
    id_seller INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'numero del vendedor',
    seller VARCHAR(57) DEFAULT 'No hay nombre' COMMENT 'campo para almacenar el nombre completo de los vendedores'
);
CREATE TABLE tb_client(
    identification INT(25) PRIMARY KEY NOT NULL COMMENT 'campo para almacenar la cedula de los clientes',
    client_name VARCHAR(57) DEFAULT 'No hay nombre' COMMENT 'campo para almacenar el nombre completo de los clientes',
    client_email VARCHAR(256) DEFAULT 'No hay email' COMMENT 'campo para almacenar el email de los clientes',
    client_address VARCHAR(200) DEFAULT 'No hay dirrecion' COMMENT 'campo para almacenar la dirrecion de los clientes',
    client_phone VARCHAR(20) DEFAULT 'no hay numero' COMMENT 'campo para almacenar el telefono de los clientes'
);
CREATE TABLE tb_product(
    product_code INT(11) PRIMARY KEY NOT NULL  COMMENT 'campo para almacenar el codigo de los productos',
    product_name VARCHAR(57) DEFAULT 'No hay nombre del producto' COMMENT 'campo para almacenar el nombre de los productos',
    product_quantity INT(4) DEFAULT '1' COMMENT 'campo para almacenar la cantidad de los productos',
    product_Unit_value INT(11) NOT NULL COMMENT 'campo para almacenar el precio unitario de los productos'
);
ALTER TABLE tb_client MODIFY client_phone VARCHAR(11)  COMMENT 'campo para almacenar el telefono de los clientes';

/*creamos los campos de las llaves foraneas*/

ALTER TABLE tb_invoice ADD fk_identification INT(25) NOT NULL COMMENT 'relacion de la tabla tb_client';
ALTER TABLE tb_invoice ADD fk_id_seller INTEGER(11) NOT NULL COMMENT 'relacion de la tabla tb_seller';
ALTER TABLE tb_invoice ADD fk_product_code INT(11) NOT NULL COMMENT 'relacion de la tabla tb_product';

/*creamos las relaciones entre las tablas*/
ALTER TABLE tb_invoice ADD CONSTRAINT  tb_invoice_tb_client_fk FOREIGN KEY(fk_identification) REFERENCES tb_client(identification);
ALTER TABLE tb_invoice ADD CONSTRAINT  tb_invoice_tb_seller_fk FOREIGN KEY(fk_id_seller) REFERENCES tb_seller(id_seller);
ALTER TABLE tb_invoice ADD CONSTRAINT  tb_invoice_tb_product_fk FOREIGN KEY(fk_product_code) REFERENCES tb_product(product_code);

/*introducimos data en las tablas*/

INSERT INTO tb_client(identification,client_name,client_email,client_address,client_phone) VALUES("13214","Juan Duran","juanj@gmail.com","carrera 24 c43-13","312342345");
INSERT INTO tb_invoice(n_invoice,fk_identification, fk_id_seller,fk_product_code) VALUES(1,123,1,1);



/* pruebas y aprendizajes de tablas*/
INSERT INTO tb_invoice (n_invoice) VALUES ("1987");
SELECT * FROM tb_client;
SELECT client_name AS "client's_names" FROM tb_client;
SELECT full_name FROM tb_client WHERE identificacion = 1097782901; /*saca el dato que cumpla con dicha caracteristica*/
SELECT * FROM tb_client ORDER BY (full_name); /*ordenar alfabeticamente la data*/
SELECT * FROM tb_client ORDER BY (full_name) DESC; /*ordenar inversamente alfabeticamente la data*/
SELECT * FROM tb_client ORDER BY full_name, email; /*ordenar alfabeticamente la data teniendo en cuenta el nombre y el email*/
SELECT * FROM tb_client LIMIT 0,14; /*pone un limite a la data mostrada*/
SELECT * FROM tb_client LIMIT 9 OFFSET 5; /*muestra los 9 datos quevan despues del dato numero 5*/
UPDATE tb_client SET full_name = "Juan Jose Duran Rincon" WHERE identificacion = 1097782901; /*cambiar la data de un espacio expecifico*/
DELETE FROM tb_client WHERE identification = 21134213; /*borra la data de un espacio expecifico*/

TRUNCATE TABLE tb_product;
DROP TABLE tb_client;

/*crear una variable y asignarle un dato*/
SELECT count(*) INTO @AAA FROM tb_client;
SELECT @camper;
/*entrando a la base de datos del trainer*/

USE db_hunter_facture;
INSERT INTO tb_client(identificacion,full_name,email,address,phone) VALUES("1097782901","Juan Jose Duran Rincon","juanjoseduranrincon404@gmail.com","carrera 11c 11-03","3152353383");

INSERT INTO tb_product(product_code,product_name,product_quantity,product_Unit_value) VALUES(:code,:name,:quantity,:value);

INSERT INTO tb_invoice(n_invoice,invoice_date) VALUES(:code,:datenow);

INSERT INTO tb_seller(seller) VALUES("Pedro vendedor");

SELECT id_seller AS "identification", seller AS "salesman" FROM tb_seller;
SELECT product_code AS "code", product_name AS "name", product_quantity AS "quantity", product_Unit_value AS "value" FROM tb_product;

SELECT n_invoice AS "code", invoice_date AS "date", fk_identification AS "cc", fk_id_seller AS "code_seller", fk_product_code AS "product_code" FROM tb_invoice;

SELECT * FROM tb_seller;
SELECT * FROM tb_client;
SELECT * FROM tb_product;



SELECT id_seller AS "identification" FROM tb_seller ORDER BY id_seller DESC LIMIT 1;

SELECT identification AS "id" FROM tb_client ORDER BY identification DESC LIMIT 1;
SELECT product_code AS "codeP" FROM tb_product ORDER BY product_code DESC LIMIT 1;
