CREATE TABLE etec_tombo(
	numero_tombo varchar (20) NOT NULL,
	numero_serie varchar (20) NOT NULL,	
	id_departamento int,
    id_material int,
	PRIMARY KEY(numero_tombo),
    FOREIGN KEY(id_material) REFERENCES etec_materiais(id_material),
	FOREIGN KEY(id_departamento) REFERENCES etec_departamento(id_departamento)
);

INSERT INTO etec_tombo VALUES
("2015007494", "BRJ446BZMS", 1, 1),
("2015007499", "BRJ446BZN4", 1, 1),
("2015007500", "BRJ446BZMX", 1, 1),
("2015007516", "BRJ446BZMT", 1, 1),
("2015007525", "BRJ451GTH6", 1, 1),
("2015007527", "BRJ446BZNP", 1, 1),
("2015007541", "BRJ451GTGT", 1, 1);

/*
UPDATE etec_tombo SET id_departamento=null WHERE numero_tombo = '2015007499'
*/