CREATE DATABASE etec_adm;

/*TABELA POLO*/
CREATE TABLE etec_polo (
  idpolo INT NOT NULL AUTO_INCREMENT,
  municipio VARCHAR(45) NOT NULL,
  cidade VARCHAR(45) NOT NULL,
  bairro VARCHAR(45) NOT NULL,
  logradouro VARCHAR(255) NOT NULL,
  numero VARCHAR(5) NULL,
  cep VARCHAR(8) NULL,
  telefone VARCHAR(11) NULL,
  shortname VARCHAR(4) NOT NULL,
  ativo TINYINT NOT NULL,
  PRIMARY KEY (idpolo)
 );

/*TABELA DEPARTAMENTO*/
 CREATE TABLE etec_departamento(
	id_departamento int NOT NULL AUTO_INCREMENT,
	nome TEXT NOT NULL,	
    idpolo int,
	isestoque BOOLEAN,
	PRIMARY KEY(id_departamento),
	FOREIGN KEY(idpolo) REFERENCES etec_polo(idpolo)
);

/*TABELA MATERIAIS*/
CREATE TABLE etec_materiais(
	id_material int NOT NULL AUTO_INCREMENT,	
	especificacao TEXT,
	acessorio TEXT,
	isConsumo BOOLEAN,
	quantidade int,
	PRIMARY KEY(id_material)
);

/*TABELA TOMBO*/
CREATE TABLE etec_tombo(
	numero_tombo varchar (20) NOT NULL,
	numero_serie varchar (20) NOT NULL,	
	id_departamento int,
    id_material int,
	PRIMARY KEY(numero_tombo),
    FOREIGN KEY(id_material) REFERENCES etec_materiais(id_material),
	FOREIGN KEY(id_departamento) REFERENCES etec_departamento(id_departamento)
);

/*GUIA DE TRANSITO*/
CREATE TABLE etec_guias(
	id_guia int not null AUTO_INCREMENT,
	id_origem int,
	id_destino int,
	id_material int,
	responsavel VARCHAR(50),
	justificativa TEXT,
	numero_tombo VARCHAR(20),
	quantidade int,
	entregador VARCHAR(50),
	destinatario VARCHAR(50),
	dia int,
	mes int,
	ano int,
	stats VARCHAR(12),
	PRIMARY KEY(id_guia),
	FOREIGN KEY(id_origem) REFERENCES etec_departamento(id_departamento),
	FOREIGN KEY(id_destino) REFERENCES etec_departamento(id_departamento),
	FOREIGN KEY(numero_tombo) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(id_material) REFERENCES etec_materiais(id_material)
);

 INSERT INTO etec_polo (idpolo, municipio, cidade, bairro, logradouro, numero, cep, telefone, shortname, ativo) VALUES
(1, 'Macaíba', 'Macaíba', '', '1', '', '', '', 'MACA', 1),
(2, 'Natal', 'Natal', '', '2', '', '', '', 'NATL', 1),
(3, 'São Paulo do Potengi', 'São Paulo do Potengi', '', '3', '', '', '', 'SAPP', 1),
(4, 'Touros', 'Touros', '', '4', '', '', '', 'TOUR', 1),
(5, 'Vera Cruz', 'Vera Cruz', '', '5', '', '', '', 'VECZ', 1),
(6, 'Assu', 'Assu', '', '6', '', '', '', 'ASSU', 1),
(7, 'Apodi', 'Apodi', '', '7', '', '', '', 'APOD', 1),
(8, 'Ceará-Mirim', 'Ceará-Mirim', '', '8', '', '', '', 'CEMI', 1),
(9, 'Monte Alegre', 'Monte Alegre', '', '9', '', '', '', 'MONT', 1),
(10, 'Acari', 'Acari', '', '10', '', '', '', 'ACRI', 1),
(11, 'Areia Branca', 'Areia Branca', '', '11', '', '', '', 'ARBR', 1),
(12, 'Caicó', 'Caicó', '', '12', '', '', '', 'CAIC', 1),
(13, 'Ceará-Mirim', 'Assentamento', '', '13', '', '', '', 'CMAS', 1),
(14, 'Currais Novos', 'Currais Novos', '', '14', '', '', '', 'CNOV', 1),
(15, 'Goianinha', 'Goianinha', '', '15', '', '', '', 'GOIA', 1),
(16, 'Caraúbas', 'Caraúbas', '', '16', '', '', '', 'CRBS', 1),
(17, 'Ipanguaçu', 'Ipanguaçu', '', '17', '', '', '', 'IPCU', 1),
(18, 'Itajá', 'Itajá', '', '18', '', '', '', 'ITJA', 1),
(19, 'Jaçanã', 'Jaçanã', '', '19', '', '', '', 'JACN', 1),
(20, 'João Câmara', 'João Câmara', '', '20', '', '', '', 'JOCA', 1),
(21, 'Lajes', 'Lajes', '', '21', '', '', '', 'LAJS', 1),
(22, 'Macau', 'Macau', '', '22', '', '', '', 'MCAU', 1),
(23, 'Martins', 'Martins', '', '23', '', '', '', 'MART', 1),
(24, 'Mossoró', 'Mossoró', '', '24', '', '', '', 'MOSS', 1),
(25, 'Nova Cruz', 'Nova Cruz', '', '25', '', '', '', 'NOCZ', 1),
(26, 'Parelhas', 'Parelhas', '', '26', '', '', '', 'PRLH', 1),
(27, 'Parnamirim', 'Parnamirim', '', '27', '', '', '', 'PARN', 1),
(28, 'Santa Cruz', 'Santa Cruz', '', '28', '', '', '', 'STCZ', 1),
(29, 'São Gonçalo do Amarante', 'São Gonçalo do Amarante', '', '29', '', '', '', 'SGDA', 1),
(30, 'São João do Sabugi', 'São João do Sabugi', '', '30', '', '', '', 'SJDS', 1),
(31, 'São José de Mipibú', 'São José de Mipibú', '', '31', '', '', '', 'SJDM', 1);

INSERT INTO etec_departamento VALUES
(1, 'Coordenação de informática', 1, 0),
(2, 'Setor de Informática lab 1', 1, 0),
(3, 'Setor de Informática lab 2', 1, 0),
(4, 'Setor de Informática lab 3', 1, 0),
(5, 'CVT', 1, 0),
(6, 'Estoque Container', 1, 1),
(7, 'Estoque sobrado', 1, 1);

INSERT INTO etec_materiais (id_material, especificacao, acessorio, isConsumo) VALUES
(1, 'Computador HP Elite All in one 800 G1 AiO NT B BR2', 'Cabo de força, teclado, mouse, mouse pad, CD.', 0),
(2, 'Desktop HP Compaq PRO 6305, 3.2 GHZ, 500 G de HD, 8 G de memória RAM', 'Teclado, mouse, mouse pad, CD’s de instalação, cabo de força.', 0),
(3, 'Estabilizador APC, 1000W, Bivolt, com 8 Entradas', 'Cabo de força.', 0),
(4, 'Estabilizador SOL 2000', 'Cabo de força.', 0),
(5, 'Mesa para computador', '-', 0),
(6, 'Monitor de LED HP backlit, 20 poledagas, HPV 206HZ', 'Cabo de força.', 0),
(7, 'Nobreak black, Ragtech, 600 VA', 'Cabo de força.', 0),
(8, 'Resma de papel oficiao A4', '-', 1),
(9, 'Garrafão de Água mineral' '-', 1);

INSERT INTO etec_tombo VALUES
("2015007494", "BRJ446BZMS", 1, 1),
("2015007499", "BRJ446BZN4", 1, 1),
("2015007500", "BRJ446BZMX", 1, 1),
("2015007516", "BRJ446BZMT", 1, 1),
("2015007525", "BRJ451GTH6", 1, 1),
("2015007527", "BRJ446BZNP", 1, 1),
("2015007541", "BRJ451GTGT", 1, 1);

