CREATE DATABASE etec_adm;

/*TABELA POLO*/
CREATE TABLE adm_mand_polo (
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
	FOREIGN KEY(idpolo) REFERENCES adm_mand_polo(idpolo)
);

/*TABELAs MATERIAIS*/
CREATE TABLE etec_materiais_permanentes(
    id_permanente int NOT NULL AUTO_INCREMENT,
    especificacao TEXT,
    acessorio TEXT
    PRIMARY KEY(id_permanente)
);

CREATE TABLE etec_materiais_consumo(
    id_consumo int NOT NULL AUTO_INCREMENT,
    especificacao TEXT,
    quantidade int,
	unidade VARCHAR(10),
    id_departamento int
    PRIMARY KEY(id_consumo),
    FOREIGN KEY(id_departamento) REFERENCES etec_departamento(id_departamento)
);

/*TABELA TOMBO*/
CREATE TABLE etec_tombo(
	numero_tombo varchar (20) NOT NULL,
	numero_serie varchar (20) NOT NULL,	
	id_departamento int,
    id_material int,
	PRIMARY KEY(numero_tombo),
    FOREIGN KEY(id_material) REFERENCES etec_materiais_permanentes(id_permanente),
	FOREIGN KEY(id_departamento) REFERENCES etec_departamento(id_departamento)
);

/*GUIA DE TRANSITO*/

CREATE TABLE numero_tombos(
	id_tombos int not null AUTO_INCREMENT,
	t1 VARCHAR(20),
	t2 VARCHAR(20),
	t3 VARCHAR(20),
	t4 VARCHAR(20),
	t5 VARCHAR(20),
	t6 VARCHAR(20),
	t7 VARCHAR(20),
	t8 VARCHAR(20),
	t9 VARCHAR(20),
	t10 VARCHAR(20),
	t11 VARCHAR(20),
	t12 VARCHAR(20),
	t13 VARCHAR(20),
	t14 VARCHAR(20),
	t15 VARCHAR(20),
	t16 VARCHAR(20),
	t17 VARCHAR(20),
	t18 VARCHAR(20),
	t19 VARCHAR(20),
	t20 VARCHAR(20),
	PRIMARY KEY(id_tombos),
	FOREIGN KEY(t1) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t2) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t3) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t4) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t5) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t6) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t7) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t8) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t9) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t10) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t11) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t12) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t13) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t14) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t15) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t16) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t17) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t18) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t19) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(t20) REFERENCES etec_tombo(numero_tombo)
);

CREATE TABLE etec_guias_lab (
	id_guia int not null AUTO_INCREMENT,
	id_tombos int,
	id_origem int,
	id_destino int,
	responsavel VARCHAR(50),
	justificativa TEXT,
	entregador VARCHAR(50),
	destinatario VARCHAR(50),
	autorizador VARCHAR(50),
	dia int,
	mes int,
	ano int,
	stats VARCHAR(12),
	PRIMARY KEY(id_guia),
	FOREIGN KEY(id_origem) REFERENCES etec_departamento(id_departamento),
	FOREIGN KEY(id_destino) REFERENCES etec_departamento(id_departamento),
	FOREIGN KEY(id_tombos) REFERENCES numero_tombos(id_tombos)
);

CREATE TABLE tabela_consumos(
	id_consumos int not null AUTO_INCREMENT,
	c1 int,
	qtd1 int,
	c2 int,
	qtd2 int,
	c3 int,
	qtd3 int,
	c4 int,
	qtd4 int,
	c5 int,
	qtd5 int,
	c6 int,
	qtd6 int,
	c7 int,
	qtd7 int,
	c8 int,
	qtd8 int,
	c9 int,
	qtd9 int,
	c10 int,
	qtd10 int,
	c11 int,
	qtd11 int,
	c12 int,
	qtd12 int,
	c13 int,
	qtd13 int,
	c14 int,
	qtd14 int,
	c15 int,
	qtd15 int,
	c16 int,
	qtd16 int,
	c17 int,
	qtd17 int,
	c18 int,
	qtd18 int,
	c19 int,
	qtd19 int,
	c20 int,
	qtd20 int,
	PRIMARY KEY(id_consumos),
	FOREIGN KEY(c1) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c2) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c3) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c4) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c5) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c6) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c7) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c8) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c9) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c10) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c11) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c12) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c13) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c14) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c15) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c16) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c17) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c18) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c19) REFERENCES etec_materiais_consumo(id_consumo),
	FOREIGN KEY(c20) REFERENCES etec_materiais_consumo(id_consumo)
);

CREATE TABLE etec_requisicao_consumo(
	id_requisicao int not null AUTO_INCREMENT,
	id_consumos int,
	id_destino int,
	solicitante VARCHAR(50),
	autorizado VARCHAR(50),
	receptor VARCHAR(50),
	dia int,
	mes int,
	ano int,
	stats VARCHAR(12),
	PRIMARY KEY(id_requisicao),
	FOREIGN KEY(id_consumos) REFERENCES tabela_consumos(id_consumos),
	FOREIGN KEY(id_destino) REFERENCES etec_departamento(id_departamento)
);

 INSERT INTO adm_mand_polo (idpolo, municipio, cidade, bairro, logradouro, numero, cep, telefone, shortname, ativo) VALUES
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

INSERT INTO etec_materiais_permanentes (id_permanente, especificacao, acessorio) VALUES
(1, 'Computador HP Elite All in one 800 G1 AiO NT B BR2', 'Cabo de força, teclado, mouse, mouse pad, CD.'),
(2, 'Desktop HP Compaq PRO 6305, 3.2 GHZ, 500 G de HD, 8 G de memória RAM', 'Teclado, mouse, mouse pad, CD’s de instalação, cabo de força.'),
(3, 'Estabilizador APC, 1000W, Bivolt, com 8 Entradas', 'Cabo de força.'),
(4, 'Estabilizador SOL 2000', 'Cabo de força.'),
(5, 'Mesa para computador', '-'),
(6, 'Monitor de LED HP backlit, 20 poledagas, HPV 206HZ', 'Cabo de força.'),
(7, 'Nobreak black, Ragtech, 600 VA', 'Cabo de força.');

INSERT INTO etec_materiais_consumo (id_consumo, quantidade, especificacao ,id_departamento) VALUES
(1, 10,'Resma de papel oficiao A4', 6),
(2, 20,'Garrafão de Água mineral', 7);

INSERT INTO etec_tombo VALUES
("2015007494", "BRJ446BZMS", 1, 1),
("2015007499", "BRJ446BZN4", 1, 1),
("2015007500", "BRJ446BZMX", 1, 1),
("2015007516", "BRJ446BZMT", 1, 1),
("2015007525", "BRJ451GTH6", 1, 1),
("2015007527", "BRJ446BZNP", 1, 1),
("2015007541", "BRJ451GTGT", 1, 1);