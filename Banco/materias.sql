CREATE TABLE etec_materiais(
	id_tombo int NOT NULL AUTO_INCREMENT,
	numero_tombo varchar (20) NOT NULL,
	numero_serie varchar (20) NOT NULL,	
	especificacao TEXT,
	acessorio TEXT,
	id_polo int,
	PRIMARY KEY(id_tombo),
	FOREIGN KEY(id_polo) REFERENCES etec_polo(idpolo)
);

INSERT INTO etec_materiais (id_tombo, numero_tombo, numero_serie, especificacao, acessorio, id_polo) VALUES
(1, '1111111', 'BRJ446BZN4', 'espec 1', 'Cabo de força, teclado, mouse, mouse pad, CD.', 1),
(2, '2222222', 'BRJ426BZN2', 'espec 2', 'Cabo de força, teclado, mouse, mouse pad, CD.', 2),
(3, '3333333', 'BRJ436BZN5', 'espec 3', 'Cabo de força, teclado, mouse, mouse pad, CD.', 3),
(4, '4444444', 'BRJ436BZN6', 'espec 4', 'Cabo de força, teclado, mouse, mouse pad, CD.', 4),
(5, '5555555', 'BRJ246BZN4', 'espec 5', 'Cabo de força, teclado, mouse, mouse pad, CD.', 5),
(6, '6666666', 'BRJ426BZN1', 'espec 6', 'Cabo de força, teclado, mouse, mouse pad, CD.', 6),
(7, '7777777', 'BRJ416BZN2', 'espec 7', 'Cabo de força, teclado, mouse, mouse pad, CD.', 7);