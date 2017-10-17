use app_natal_solidario;

CREATE TABLE usuario_perfil
(
id SMALLINT NOT NULL,
nome VARCHAR(100) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE usuario
(
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(300) NOT NULL,
email VARCHAR(300) NOT NULL,
senha VARCHAR(300) NOT NULL,
perfil SMALLINT NOT NULL,
removido BIT NOT NULL DEFAULT 0,
area_abrangencia VARCHAR(150) NULL,
referencia VARCHAR(150) NULL,
telefone VARCHAR(11) NULL,
PRIMARY KEY (id)
);

ALTER TABLE usuario ADD CONSTRAINT fk_usuario_usuario_perfil FOREIGN KEY (perfil) REFERENCES usuario_perfil(id);

CREATE TABLE registro_log_acao
(
id SMALLINT NOT NULL,
nome VARCHAR(100) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE registro_log
(
id BIGINT NOT NULL AUTO_INCREMENT,
data_cadastro DATETIME NOT NULL,
usuario INT NOT NULL,
acao SMALLINT NOT NULL,
titulo VARCHAR(150) NOT NULL,
conteudo_anterior MEDIUMTEXT NULL,
conteudo_posterior MEDIUMTEXT NULL,
PRIMARY KEY (id)
);

ALTER TABLE registro_log ADD CONSTRAINT fk_registro_log_registro_log_acao FOREIGN KEY (acao) REFERENCES registro_log_acao(id);

CREATE TABLE responsavel
(
id INT NOT NULL AUTO_INCREMENT,
data_cadastro DATETIME NOT NULL,
nome VARCHAR(300) NOT NULL, 
data_nascimento DATE NOT NULL, 
endereco VARCHAR(300) NULL, 
cidade VARCHAR(100) NOT NULL, 
uf CHAR(2) NOT NULL, 
cep CHAR(8) NULL, 
documento_numero VARCHAR(30) NOT NULL, 
documento_tipo VARCHAR(100) NOT NULL, 
removido BIT NOT NULL DEFAULT 0,
PRIMARY KEY (id)
);

CREATE TABLE beneficiado 
(
id INT NOT NULL AUTO_INCREMENT, 
responsavel INT NOT NULL, 
data_cadastro DATETIME NOT NULL,
nome VARCHAR(300) NOT NULL, 
data_nascimento DATE NOT NULL,
removido BIT NOT NULL DEFAULT 0,
PRIMARY KEY (id)
);

ALTER TABLE beneficiado ADD CONSTRAINT fk_beneficiado_responsavel FOREIGN KEY (responsavel) REFERENCES responsavel(id);

CREATE TABLE carta(
id INT NOT NULL AUTO_INCREMENT, 
data_cadastro DATETIME NOT NULL, 
beneficiado INT NOT NULL, 
numero CHAR(11) NOT NULL,
removida BIT NOT NULL DEFAULT 0,
representante_comunidade INT NOT NULL,
carteiro_associado INT NULL,
regiao_administrativa CHAR(5) NULL,
PRIMARY KEY (id)
);

ALTER TABLE carta ADD CONSTRAINT fk_carta_beneficiado FOREIGN KEY (beneficiado) REFERENCES beneficiado(id);
ALTER TABLE carta ADD CONSTRAINT fk_carta_usuario_representante_comunidade FOREIGN KEY (representante_comunidade) REFERENCES usuario(id);
ALTER TABLE carta ADD CONSTRAINT fk_carta_usuario_carteiro_associado FOREIGN KEY (carteiro_associado) REFERENCES usuario(id);


/*RG, CPF, CNH, OUTRO*/

INSERT INTO usuario_perfil (id, nome) VALUES (1, 'Representante da comunidade');
INSERT INTO usuario_perfil (id, nome) VALUES (2, 'Responsável na ONG');
INSERT INTO usuario_perfil (id, nome) VALUES (3, 'Carteiro');

INSERT INTO registro_log_acao (id, nome) VALUES (1, 'AUTENTICAÇÃO');
INSERT INTO registro_log_acao (id, nome) VALUES (2, 'INCLUSÃO');
INSERT INTO registro_log_acao (id, nome) VALUES (3, 'ALTERAÇÃO');
INSERT INTO registro_log_acao (id, nome) VALUES (4, 'EXCLUSÃO');

INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Railda Costa dos Santos','raildatrino@gmail.com','natalsolidario',1,'307/829');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Gilbran Trajano','giltrajano8@gmail.com','natalsolidario',1,'Samambaia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('André Souza Santos', 'contato@providadf.com.br','natalsolidario',1,'Recanto das Emas');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Gislane Rodrigues', 'gislanerodrigues85@gmail.com','natalsolidario',1,'Samambaia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Renata Rodrigues da Silva',	'renatarodrigues.silva93@gmail.com','natalsolidario',1,'Samambaia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Izaete Elias','portela_franca@hotmail.com','natalsolidario',1,'Samambaia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Priscila Santos','priscila.jl.santos@gmail.com','natalsolidario',1,'Brazlândia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Cleide Rodrigues','franciscacleidert150679@gmail.com','natalsolidario',1,'São Sebastião');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Fernanda Gilvana','fernandagilvana@gmail.com','natalsolidario',1,'São Sebastião');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Roseane Santos','roseanelidia@hotmail.com','natalsolidario',1,'Samambaia Sul');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Patrícia','patriciaob2017@gmail.com','natalsolidario',1,'Brazlândia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Fabiano Simões','institutoipv@gmail.com','natalsolidario',1,'Ceilândia');
INSERT INTO usuario (nome, email, senha, perfil, area_abrangencia) VALUES ('Elizangela','elizangela.aviso@gmail.com','natalsolidario',1,'São Sebastião');

INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Ana Paula S de S Bastos','ap_silvas@hotmail.com','natalsolidario',3,'61981459067','CECAC');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Larissa Matos dos Santos','larissadossantos@hotmail.com','natalsolidario',3,'61981206370','GEPEC');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Dunia Salazar','mail4dunia@gmail.com','natalsolidario',3, '61998255774',NULL);
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Fernanda Colombo Lôbo','fcolombo@gmail.com','natalsolidario',3, '61981492789','SUSAN');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Sirley Ferreira de Oliveira','sirley.deoliveira@hotmail.com','natalsolidario',3, '65984031981','GEMPJ');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Luana Bassani Evaristo','luanabassani@yahoo.com.br','natalsolidario',3, '61991576445','PEDEP');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Juliana Daldegan Lima','julianadaldeganlima@gmail.com','natalsolidario',3, '61992862626','GERFU');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Hercules Capibaribe Junior','hercules.capibaribe@terra.com.br','natalsolidario',3, '61993331063','GESEC');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Maria de Jesus Demétrio Gaia','mjgaia@yahoo.com.br','natalsolidario',3, '61996791126','GEGOP');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Patrícia Lopes do Nascimento','patriciaunb@gmail.com','natalsolidario',3, '61981535049','VIHAB');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Fábio Popinigis','popinigis@gmail.com','natalsolidario',3, '61984015190','GERFU');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Ana Luísa Gaia','luisagaiadf@gmail.com','natalsolidario',3, '61991027464','Estudante (UnB Ceilândia)');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Adriana Soares Neves','adriana_soares_neves@hotmail.com','natalsolidario',3, '61981422082','CEDES');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Sandro Von R. S. Tillmann','stillmann@gmail.com','natalsolidario',3, '61981349353','GEASP08');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Grazyelle Bessa','grazyelle.bessa@gmail.com','natalsolidario',3, '61992192511','GEGES');
INSERT INTO usuario (nome, email, senha, perfil, telefone, referencia) VALUES ('Ana Letícia Gaia Cunha','leticiagaiac@gmail.com','natalsolidario',3, '61982541435','Estudante ALUB ensino médio');


