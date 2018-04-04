/*CREATE TABLE etec_solicitacoes(
	id_solicitacao int NOT NULL AUTO_INCREMENT,
    numero_tombo VARCHAR(20) NOT NULL,	
	estava int,
	foi int NOT NULL,
    quando DATETIME,
	transportador VARCHAR(50),
	cpf VARCHAR(12),
	stats VARCHAR(12),
	PRIMARY KEY(id_solicitacao),
    FOREIGN KEY(numero_tombo) REFERENCES etec_tombo(numero_tombo),
	FOREIGN KEY(estava) REFERENCES etec_departamento(id_departamento),
	FOREIGN KEY(foi) REFERENCES etec_departamento(id_departamento)
);


INSERT INTO etec_solicitacoes (id_solicitacao, numero_tombo, estava, foi, quando, transportador, cpf, stats) VALUES
(1, '2015007494', null, 1, CURTIME(),"fulanino", "11111111111", "Aguardando");*/

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



INSERT INTO etec_guias (id_guia, id_origem, id_destino, id_material,responsavel, justificativa, numero_tombo, quantidade, entregador, destinatario, dia, mes, ano, stats) VALUES
(1, 7, 5, 2,"MAX", "Precisa muito", null, 1, "Juvanderson", "Arthur", day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), "ENTREGUE");