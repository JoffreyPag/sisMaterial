CREATE TABLE etec_setor(
	id_setor int NOT NULL AUTO_INCREMENT,
	nome TEXT NOT NULL,	
    id_polo int,
	PRIMARY KEY(id_setor),
	FOREIGN KEY(id_polo) REFERENCES etec_polo(idpolo)
);

INSERT INTO etec_setor VALUES
(1, 'Coordenação de informática', 1),
(2, 'Setor de Informática lab 1', 1),
(3, 'Setor de Informática lab 2', 1),
(4, 'Setor de Informática lab 3', 1),
(5, 'CVT', 1),
(6, 'Laboratorio de Analise e Desenvolvimento de Sistemas', 1),
(7, 'Laboratorio TAPIOCA', 1);