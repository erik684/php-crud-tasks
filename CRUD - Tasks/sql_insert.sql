CREATE DATABASE tasks_bd;
USE tasks_bd;

CREATE TABLE tasks (
	codigo_task INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome_task VARCHAR(15) NOT NULL,
    desc_task VARCHAR(45),
    arq_task VARCHAR(200)    
);

CREATE TABLE login_task (
	id_login INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	email VARCHAR(30) NOT NULL,
	senha VARCHAR(16) NOT NULL
);

INSERT INTO login_task (email, senha) VALUES ('admin', 'admin');
