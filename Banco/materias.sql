CREATE TABLE etec_materiais(
	id_material int NOT NULL AUTO_INCREMENT,	
	especificacao TEXT,
	acessorio TEXT,
	PRIMARY KEY(id_material)
);

INSERT INTO etec_materiais (id_material, especificacao, acessorio) VALUES
(1, 'Computador HP Elite All in one 800 G1 AiO NT B BR2', 'Cabo de força, teclado, mouse, mouse pad, CD.'),
(2, 'Desktop HP Compaq PRO 6305, 3.2 GHZ, 500 G de HD, 8 G de memória RAM', 'Teclado, mouse, mouse pad, CD’s de instalação, cabo de força.'),
(3, 'Estabilizador APC, 1000W, Bivolt, com 8 Entradas', 'Cabo de força.'),
(4, 'Estabilizador SOL 2000', 'Cabo de força.'),
(5, 'Mesa para computador', '-'),
(6, 'Monitor de LED HP backlit, 20 poledagas, HPV 206HZ', 'Cabo de força.'),
(7, 'Nobreak black, Ragtech, 600 VA', 'Cabo de força.');