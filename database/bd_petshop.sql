create database bd_petshop;

use bd_petshop;

CREATE TABLE usuarios (
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
    nome_cliente varchar(50),
    status_agendamento int default 1,
    foreign key (id_funcionario) references funcionario(id_funcionario),
    foreign key(id_animal) references ficha_animal(id_animal)
);

INSERT INTO funcionario (nome_funcionario, cpf) VALUES
('Dr. Carlos Mendes', '123.456.789-01'),
('Dra. Ana Beatriz', '234.567.890-12'),
('Dr. Pedro Henrique', '345.678.901-23'),
('Dra. Juliana Costa', '456.789.012-34'),
('Dr. Marcos Oliveira', '567.890.123-45');

INSERT INTO ficha_animal (nome, idade, raca, porte, tutor) VALUES
('Rex', 5, 'Pastor Alemão', 'Grande', 'João Silva'),
('Luna', 3, 'Golden Retriever', 'Médio', 'Maria Oliveira'),
('Thor', 2, 'Bulldog Francês', 'Pequeno', 'Carlos Santos'),
('Mel', 7, 'Poodle', 'Pequeno', 'Ana Costa'),
('Max', 4, 'Labrador', 'Grande', 'Pedro Almeida'),
('Bella', 1, 'Siamês', 'Pequeno', 'Fernanda Lima'),
('Buddy', 6, 'Beagle', 'Médio', 'Ricardo Pereira'),
('Molly', 2, 'Pug', 'Pequeno', 'Juliana Rocha'),
('Rocky', 5, 'Rottweiler', 'Grande', 'Marcos Souza'),
('Lola', 4, 'Shih Tzu', 'Pequeno', 'Patrícia Nunes');

INSERT INTO agendamento (id_funcionario, id_animal, data_agendamento, hora_agendamento, nome_cliente, status_agendamento) VALUES
(1, 1, '2023-11-15', '09:00:00', 'João Silva', 1),
(2, 2, '2023-11-15', '10:30:00', 'Maria Oliveira',1),
(3, 3, '2023-11-16', '14:00:00', 'Carlos Santos', 1),
(1, 4, '2023-11-16', '16:30:00', 'Ana Costa',2),
(4, 5, '2023-11-17', '11:00:00', 'Pedro Almeida', 1),
(5, 6, '2023-11-17', '13:30:00', 'Fernanda Lima', 3),
(2, 7, '2023-11-18', '09:30:00', 'Ricardo Pereira',1),
(3, 8, '2023-11-18', '15:00:00', 'Juliana Rocha', 1),
(4, 9, '2023-11-19', '10:00:00', 'Marcos Souza', 2),
(5, 10, '2023-11-19', '17:00:00', 'Patrícia Nunes', 1);

