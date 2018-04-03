CREATE TABLE etec_departamento(
	id_departamento int NOT NULL AUTO_INCREMENT,
	nome TEXT NOT NULL,	
    idpolo int,
	isestoque BOOLEAN,
	PRIMARY KEY(id_departamento),
	FOREIGN KEY(idpolo) REFERENCES etec_polo(idpolo)
);

INSERT INTO etec_departamento VALUES
(1, 'Coordenação de informática', 1, 0),
(2, 'Setor de Informática lab 1', 1, 0),
(3, 'Setor de Informática lab 2', 1, 0),
(4, 'Setor de Informática lab 3', 1, 0),
(5, 'CVT', 1, 0),
(6, 'Estoque Container', 1, 1),
(7, 'Estoque sobrado', 1, 1);