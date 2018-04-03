CREATE TABLE etec_movimento(
	id_movimento int NOT NULL AUTO_INCREMENT,
    numero_tombo VARCHAR(20) NOT NULL,	
	estava TEXT,
	foi TEXT NOT NULL,
    quando DATETIME,
	PRIMARY KEY(id_movimento),
    FOREIGN KEY(numero_tombo) REFERENCES etec_tombo(numero_tombo)
);

INSERT INTO etec_movimento (id_movimento, numero_tombo, estava, foi, quando) VALUES
(1, '2015007494', "", "macaiba", CURTIME()),
;