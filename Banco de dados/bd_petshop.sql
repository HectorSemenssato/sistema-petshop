drop database bd_petshop;
create database bd_petshop;

use bd_petshop;

create table login(
	id_usuario int auto_increment primary key,
	login varchar(100),
    senha varchar(100)
);

create table funcionario(
	id_funcionario int auto_increment primary key,
    nome_funcionario varchar(30),
    cpf varchar(13)
);

create table ficha_animal(
	nome varchar(30),
    idade int,
    raca varchar(50),
    porte varchar(15),
    tutor varchar(70)
);

create table agendamento(
    id_agendamento int auto_increment primary key,
    id_funcionario int,
    data_agendamento date,
    hora_agendamento time,
    nome_animal varchar(20),
    raca varchar(30),
    idade varchar(2),
    status_agendamento int default 1,
    foreign key (id_funcionario) references funcionario(id_funcionario),
    foreign key(nome_animal) references ficha_animal(nome_animal)
);

INSERT INTO funcionario (nome_funcionario, cpf) VALUES
('João Silva', '12345678901'),
('Maria Oliveira', '98765432109'),
('Carlos Souza', '45678912345'),
('Ana Pereira', '32165498732'),
('Pedro Costa', '78912345678');

INSERT INTO agendamento (id_funcionario, data_agendamento, hora_agendamento, tipo_animal, raca, idade, status_agendamento) VALUES
(1, '2023-11-15', '09:00:00', 'Cachorro', 'Labrador', '5', 1),
(2, '2023-11-15', '10:30:00', 'Gato', 'Siamês', '3', 1),
(1, '2023-11-16', '14:00:00', 'Cachorro', 'Poodle', '2', 0),
(3, '2023-11-17', '11:00:00', 'Cachorro', 'Bulldog', '4', 1),
(4, '2023-11-18', '16:30:00', 'Gato', 'Persa', '1', 0),
(5, '2023-11-19', '08:45:00', 'Cachorro', 'Golden Retriever', '6', 1),
(2, '2023-11-20', '13:15:00', 'Gato', 'Maine Coon', '2', 1);

select * from agendamento;

    