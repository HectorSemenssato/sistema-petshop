drop database bd_petshop;
create database bd_petshop;

use bd_petshop;

create table clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

create table usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(50) NOT NULL UNIQUE,
    senha_usuario VARCHAR(255) NOT NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

create table funcionario(
	id_funcionario int auto_increment primary key,
    nome_funcionario varchar(30),
    cpf varchar(15)
);

create table ficha_animal(
	id_animal int auto_increment primary key,
    id_cliente int,
	nome varchar(30),
    tipo_animal varchar(30),
    idade int,
    raca varchar(50),
    porte varchar(15),
    tutor varchar(70)
);

create table agendamento(
    id_agendamento int auto_increment primary key,
    id_funcionario int,
	id_animal int,
    data_agendamento date,
    hora_agendamento time,
    id_cliente int,
    status_agendamento int default 1,
    foreign key (id_cliente) references clientes(id_cliente),
    foreign key (id_funcionario) references funcionario(id_funcionario),
    foreign key (id_animal) references ficha_animal(id_animal)
);




