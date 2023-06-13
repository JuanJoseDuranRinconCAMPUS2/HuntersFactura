
CREATE DATABASE JuanJData;
USE JuanJData;
CREATE TABLE tb_personas(
    cc INT(11) NOT NULL COMMENT 'campo para almacenar la cedula de los usuario',
    nom_com VARCHAR(57) NOT NULL COMMENT 'campo para almacenar el nombre completo de los usuario',
    edad INTEGER(3) NOT NULL COMMENT 'campo para almacenar la edad de los usuario',
    PRIMARY KEY(cc)
);
