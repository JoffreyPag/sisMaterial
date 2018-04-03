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