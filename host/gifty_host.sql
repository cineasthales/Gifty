USE u877047164_gifty;

-- -----------------------------------------------------
-- Table `u877047164_gifty`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`enderecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(20) NOT NULL,
  `logradouro` VARCHAR(100) NOT NULL,
  `numero` INT NOT NULL,
  `complemento` VARCHAR(100) NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomeUsuario` VARCHAR(20) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `sobrenome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `notificaEmail` TINYINT NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `dataNasc` DATE NOT NULL,
  `genero` VARCHAR(30) NOT NULL,
  `imagem` VARCHAR(100) NOT NULL,
  `nivel` INT(1) NOT NULL,
  `ativo` TINYINT NOT NULL,
  `tentaLogin` INT(1) NOT NULL,
  `idEndereco` INT NOT NULL,
  PRIMARY KEY (`id`, `idEndereco`),
  INDEX `fk_usuarios_enderecos1_idx` (`idEndereco` ASC),
  CONSTRAINT `fk_usuarios_enderecos1`
    FOREIGN KEY (`idEndereco`)
    REFERENCES `u877047164_gifty`.`enderecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`telefones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`telefones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ddd` VARCHAR(3) NOT NULL,
  `numero` VARCHAR(20) NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`id`, `idUsuario`),
  INDEX `fk_telefones_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_telefones_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`tiposEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`tiposEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`eventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `descricao` MEDIUMTEXT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `local` VARCHAR(100) NOT NULL,
  `ativo` TINYINT NOT NULL,
  `maxItens` INT(2) NOT NULL,
  `dataLimite` DATE NOT NULL,
  `idUsuario` INT NOT NULL,
  `idEndereco` INT NOT NULL,
  `idTipoEvento` INT NOT NULL,
  PRIMARY KEY (`id`, `idUsuario`, `idEndereco`, `idTipoEvento`),
  INDEX `fk_eventos_usuarios1_idx` (`idUsuario` ASC),
  INDEX `fk_eventos_enderecos1_idx` (`idEndereco` ASC),
  INDEX `fk_eventos_tiposEventos1_idx` (`idTipoEvento` ASC),
  CONSTRAINT `fk_eventos_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_enderecos1`
    FOREIGN KEY (`idEndereco`)
    REFERENCES `u877047164_gifty`.`enderecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_tiposEventos1`
    FOREIGN KEY (`idTipoEvento`)
    REFERENCES `u877047164_gifty`.`tiposEventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`categorias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `idML` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`itens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(240) NOT NULL,
  `descricao` MEDIUMTEXT NOT NULL,
  `preco` DOUBLE NOT NULL,
  `url` VARCHAR(240) NOT NULL,
  `imagem` VARCHAR(4094) NOT NULL,
  `idCategoria` INT NOT NULL,
  PRIMARY KEY (`id`, `idCategoria`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_itens_categorias1_idx` (`idCategoria` ASC),
  CONSTRAINT `fk_itens_categorias1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `u877047164_gifty`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`amizades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`amizades` (
  `idUsuario1` INT NOT NULL,
  `idUsuario2` INT NOT NULL,
  `ativa` TINYINT NOT NULL,
  `bloqueado1` TINYINT NOT NULL,
  `bloqueado2` TINYINT NOT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`idUsuario1`, `idUsuario2`),
  INDEX `fk_usuarios_has_usuarios_usuarios1_idx` (`idUsuario1` ASC),
  INDEX `fk_usuarios_has_usuarios_usuarios_idx` (`idUsuario2` ASC),
  CONSTRAINT `fk_usuarios_has_usuarios_usuarios`
    FOREIGN KEY (`idUsuario2`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_usuarios_usuarios1`
    FOREIGN KEY (`idUsuario1`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`convidados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`convidados` (
  `idUsuario` INT NOT NULL,
  `idEvento` INT NOT NULL,
  `comparecera` TINYINT NOT NULL,
  `compareceu` TINYINT NOT NULL,
  `bloqueado` TINYINT NOT NULL,
  PRIMARY KEY (`idUsuario`, `idEvento`),
  INDEX `fk_usuarios_has_eventos_eventos1_idx` (`idEvento` ASC),
  INDEX `fk_usuarios_has_eventos_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_usuarios_has_eventos_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_eventos_eventos1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `u877047164_gifty`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`listas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`listas` (
  `idEvento` INT NOT NULL,
  `idItem` INT NOT NULL,
  `prioridade` INT(3) NOT NULL,
  `dataAdicao` DATE NOT NULL,
  `idComprador` INT NULL,
  PRIMARY KEY (`idEvento`, `idItem`),
  INDEX `fk_eventos_has_itens_itens1_idx` (`idItem` ASC),
  INDEX `fk_eventos_has_itens_eventos1_idx` (`idEvento` ASC),
  CONSTRAINT `fk_eventos_has_itens_eventos1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `u877047164_gifty`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_has_itens_itens1`
    FOREIGN KEY (`idItem`)
    REFERENCES `u877047164_gifty`.`itens` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `razaoSocial` VARCHAR(100) NOT NULL,
  `nomeFantasia` VARCHAR(50) NOT NULL,
  `cnpj` VARCHAR(30) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `logomarca` VARCHAR(100) NOT NULL,
  `site` VARCHAR(100) NOT NULL,
  `ativa` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`anuncios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imagem` VARCHAR(100) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `ativo` TINYINT NOT NULL,
  `idEmpresa` INT NOT NULL,
  `idCategoria` INT NOT NULL,
  PRIMARY KEY (`id`, `idEmpresa`, `idCategoria`),
  INDEX `fk_banners_empresas1_idx` (`idEmpresa` ASC),
  INDEX `fk_anuncios_categorias1_idx` (`idCategoria` ASC),
  CONSTRAINT `fk_banners_empresas1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `u877047164_gifty`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_categorias1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `u877047164_gifty`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`interesses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`interesses` (
  `idUsuario` INT NOT NULL,
  `idCategoria` INT NOT NULL,
  `peso` INT NOT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`idUsuario`, `idCategoria`),
  INDEX `fk_usuarios_has_interesses_interesses1_idx` (`idCategoria` ASC),
  INDEX `fk_usuarios_has_interesses_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_usuarios_has_interesses_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_interesses_interesses1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `u877047164_gifty`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`cliquesAnuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`cliquesAnuncios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `idAnuncio` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`id`, `idAnuncio`, `idUsuario`),
  INDEX `fk_logCliques_banners1_idx` (`idAnuncio` ASC),
  INDEX `fk_cliquesAnuncios_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_logCliques_banners1`
    FOREIGN KEY (`idAnuncio`)
    REFERENCES `u877047164_gifty`.`anuncios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliquesAnuncios_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`cliquesEmpresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`cliquesEmpresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `idEmpresa` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`id`, `idEmpresa`, `idUsuario`),
  INDEX `fk_cliquesEmpresas_empresas1_idx` (`idEmpresa` ASC),
  INDEX `fk_cliquesItens_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_cliquesEmpresas_empresas1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `u877047164_gifty`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliquesItens_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`acoesUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`acoesUsuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`logUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`logUsuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idAcaoUsuario` INT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  PRIMARY KEY (`id`, `idUsuario`, `idAcaoUsuario`),
  INDEX `fk_usuarios_has_acoes_acoes1_idx` (`idAcaoUsuario` ASC),
  INDEX `fk_usuarios_has_acoes_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_usuarios_has_acoes_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `u877047164_gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_acoes_acoes1`
    FOREIGN KEY (`idAcaoUsuario`)
    REFERENCES `u877047164_gifty`.`acoesUsuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`acoesEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`acoesEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u877047164_gifty`.`logEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u877047164_gifty`.`logEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idEvento` INT NOT NULL,
  `idAcaoEvento` INT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  PRIMARY KEY (`id`, `idEvento`, `idAcaoEvento`),
  INDEX `fk_eventos_has_acoesEventos_acoesEventos1_idx` (`idAcaoEvento` ASC),
  INDEX `fk_eventos_has_acoesEventos_eventos1_idx` (`idEvento` ASC),
  CONSTRAINT `fk_eventos_has_acoesEventos_eventos1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `u877047164_gifty`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_has_acoesEventos_acoesEventos1`
    FOREIGN KEY (`idAcaoEvento`)
    REFERENCES `u877047164_gifty`.`acoesEventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- SET SQL_MODE=@OLD_SQL_MODE;
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
-- SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO tiposEventos
(descricao)
VALUES
('Aniversário'),
('Aniversário de Casamento'),
('Casamento'),
('Formatura'),
('Natal'),
('Páscoa'),
('Dia das Mães'),
('Dia dos Pais'),
('Dia das Crianças'),
('Dia dos Namorados'),
('Chá de Bebê'),
('Chá de Casa Nova'),
('Despedida de Solteiro(a)'),
('Festa de Despedida'),
('Religioso'),
('Data Comemorativa Diversa');

INSERT INTO categorias
(descricao, idML)
VALUES
('Acessórios para Veículos > Acessórios de Carros', 'MLB1747'),
('Acessórios para Veículos > Acessórios de Motos', 'MLB1771'),
('Acessórios para Veículos > Acessórios Náutica', 'MLB6005'),
('Acessórios para Veículos > Ferramentas', 'MLB2227'),
('Acessórios para Veículos > GPS', 'MLB8531'),
('Acessórios para Veículos > Limpeza Automotiva', 'MLB188063'),
('Acessórios para Veículos > Peças Automotivas', 'MLB22693'),
('Acessórios para Veículos > Peças de Moto', 'MLB243551'),
('Acessórios para Veículos > Pneus', 'MLB2238'),
('Acessórios para Veículos > Rodas', 'MLB255788'),
('Acessórios para Veículos > Som Automotivo', 'MLB3381'),
('Acessórios para Veículos > Tuning e Performance', 'MLB1776'),
('Acessórios para Veículos > Outros', 'MLB5802'),
('Agro, Indústria e Comércio > Comércio', 'MLB5452'),
('Agro, Indústria e Comércio > Equipamento para Escritórios', 'MLB2102'),
('Agro, Indústria e Comércio > Indústria Agropecuária', 'MLB271599'),
('Agro, Indústria e Comércio > Indústria Automotiva', 'MLB1508'),
('Agro, Indústria e Comércio > Indústria Gastronômica', 'MLB268412'),
('Agro, Indústria e Comércio > Indústria Gráfica e Impressão', 'MLB5446'),
('Agro, Indústria e Comércio > Indústria Pesada', 'MLB5456'),
('Agro, Indústria e Comércio > Indústria Plástica e Química', 'MLB1504'),
('Agro, Indústria e Comércio > Indústria Têxtil e Confecção', 'MLB5454'),
('Agro, Indústria e Comércio > Medições e Instrumentação', 'MLB5550'),
('Agro, Indústria e Comércio > Reciclagem', 'MLB6416'),
('Agro, Indústria e Comércio > Outros', 'MLB1893'),
('Alimentos e Bebidas > Absinto', 'MLB270406'),
('Alimentos e Bebidas > Água de Coco', 'MLB270410'),
('Alimentos e Bebidas > Água Mineral', 'MLB269718'),
('Alimentos e Bebidas > Alimentos para Bebês', 'MLB264034'),
('Alimentos e Bebidas > Bebidas Alcoólicas Mistas', 'MLB277634'),
('Alimentos e Bebidas > Bebidas Energéticas', 'MLB270414'),
('Alimentos e Bebidas > Brandy', 'MLB269585'),
('Alimentos e Bebidas > Cachaça', 'MLB194826'),
('Alimentos e Bebidas > Café', 'MLB247520'),
('Alimentos e Bebidas > Catuabas', 'MLB270329'),
('Alimentos e Bebidas > Cerveja', 'MLB194799'),
('Alimentos e Bebidas > Champagnes', 'MLB194827'),
('Alimentos e Bebidas > Cognacs', 'MLB269584'),
('Alimentos e Bebidas > Comestíveis', 'MLB1423'),
('Alimentos e Bebidas > Fernet', 'MLB270407'),
('Alimentos e Bebidas > Gin', 'MLB269510'),
('Alimentos e Bebidas > Infusão', 'MLB194831'),
('Alimentos e Bebidas > Licor', 'MLB1416'),
('Alimentos e Bebidas > Livros de culinária', 'MLB3649'),
('Alimentos e Bebidas > Piscos', 'MLB270438'),
('Alimentos e Bebidas > Refrigerantes', 'MLB277419'),
('Alimentos e Bebidas > Rum', 'MLB270404'),
('Alimentos e Bebidas > Saquê', 'MLB270411'),
('Alimentos e Bebidas > Suco', 'MLB263767'),
('Alimentos e Bebidas > Tequila', 'MLB194811'),
('Alimentos e Bebidas > Vermouth', 'MLB270413'),
('Alimentos e Bebidas > Vinhos', 'MLB1404'),
('Alimentos e Bebidas > Vodka', 'MLB194810'),
('Alimentos e Bebidas > Whisky', 'MLB194809'),
('Alimentos e Bebidas > Outros', 'MLB1417'),
('Animais > Anfíbios e Répteis', 'MLB270897'),
('Animais > Aves e Acessórios', 'MLB1100'),
('Animais > Cachorros', 'MLB1072'),
('Animais > Cavalos', 'MLB1117'),
('Animais > Coelhos', 'MLB85880'),
('Animais > Gatos', 'MLB1081'),
('Animais > Insetos', 'MLB270868'),
('Animais > Livros e Revistas de Animais', 'MLB3615'),
('Animais > Peixes', 'MLB1091'),
('Animais > Roedores', 'MLB1105'),
('Animais > Outros', 'MLB1126'),
('Antiguidades > Acessórios de Cozinha Antigos', 'MLB9172'),
('Antiguidades > Balanças Antigas', 'MLB30205'),
('Antiguidades > Bicicletas Antigas', 'MLB9197'),
('Antiguidades > Brinquedos Antigos', 'MLB39568'),
('Antiguidades > Câmeras Antigas e Coleção', 'MLB1044'),
('Antiguidades > Decoração Antiga', 'MLB5467'),
('Antiguidades > Eletrodomésticos Antigos', 'MLB40278'),
('Antiguidades > Facas Antigas', 'MLB40288'),
('Antiguidades > Ferramentas Antigas', 'MLB40184'),
('Antiguidades > Iluminação Antiga', 'MLB5466'),
('Antiguidades > Latas Antigas', 'MLB5561'),
('Antiguidades > Máquinas de Escrever Antigas', 'MLB5476'),
('Antiguidades > Moedores Antigos', 'MLB5518'),
('Antiguidades > Móveis Antigos', 'MLB5462'),
('Antiguidades > Portas e Janelas Antigas', 'MLB34367'),
('Antiguidades > Relógios Antigos', 'MLB5519'),
('Antiguidades > Roupas e Acessórios Antigos', 'MLB40211'),
('Antiguidades > Som Antigo', 'MLB5474'),
('Antiguidades > Telefones Antigos', 'MLB5461'),
('Antiguidades > Outras Antiguidades', 'MLB5457'),
('Arte e Artesanato > Artesanato', 'MLB5460'),
('Arte e Artesanato > Equipamento para Tatuagens', 'MLB270192'),
('Arte e Artesanato > Esculturas', 'MLB2662'),
('Arte e Artesanato > Ferramentas e Materiais', 'MLB40285'),
('Arte e Artesanato > Gravuras', 'MLB1370'),
('Arte e Artesanato > Livros', 'MLB5464'),
('Arte e Artesanato > Pinturas', 'MLB1369'),
('Arte e Artesanato > Outros', 'MLB1371'),
('Bebês > Alimentação para Bebê', 'MLB5360'),
('Bebês > Banho, Saúde e Higiene do Bebê', 'MLB5373'),
('Bebês > Berços e Móveis para Bebês', 'MLB5362'),
('Bebês > Brinquedos para Bebês', 'MLB1392'),
('Bebês > Cadeiras de Alimentação', 'MLB40554'),
('Bebês > Cadeiras de Bebê para Carro', 'MLB1387'),
('Bebês > Carrinhos para Bebê', 'MLB1386'),
('Bebês > Decoração e Lembranças de Bebê', 'MLB1889'),
('Bebês > Fraldas e Bolsas de Bebê', 'MLB74368'),
('Bebês > Roupas de Bebê', 'MLB1396'),
('Bebês > Segurança para Bebê', 'MLB5358'),
('Bebês > Outros', 'MLB6156'),
('Beleza e Cuidado Pessoal > Artigos para Cabeleireiros', 'MLB264751'),
('Beleza e Cuidado Pessoal > Banho e Higiene', 'MLB198312'),
('Beleza e Cuidado Pessoal > Barbearia', 'MLB264787'),
('Beleza e Cuidado Pessoal > Cuidados com a Pele', 'MLB199407'),
('Beleza e Cuidado Pessoal > Cuidados de Mãos', 'MLB29884'),
('Beleza e Cuidado Pessoal > Depilação', 'MLB5383'),
('Beleza e Cuidado Pessoal > Eletrodomésticos de Beleza', 'MLB264721'),
('Beleza e Cuidado Pessoal > Maquiagem', 'MLB1248'),
('Beleza e Cuidado Pessoal > Perfumes', 'MLB6284'),
('Beleza e Cuidado Pessoal > Perucas e Apliques', 'MLB5398'),
('Beleza e Cuidado Pessoal > Produtos de Cabelo', 'MLB1263'),
('Beleza e Cuidado Pessoal > Outros', 'MLB1275'),
('Brinquedos e Hobbies > Ar Livre, Malabares e Festas', 'MLB6911'),
('Brinquedos e Hobbies > Bonecas e Acessórios', 'MLB264337'),
('Brinquedos e Hobbies > Bonecos e Figuras de Ação', 'MLB1839'),
('Brinquedos e Hobbies > Brinquedos', 'MLB2533'),
('Brinquedos e Hobbies > Brinquedos de Controle Remoto', 'MLB2963'),
('Brinquedos e Hobbies > Brinquedos para Bebês', 'MLB3655'),
('Brinquedos e Hobbies > Cards e Card Games', 'MLB1133'),
('Brinquedos e Hobbies > Filmes Infantis', 'MLB6881'),
('Brinquedos e Hobbies > Jogos', 'MLB2960'),
('Brinquedos e Hobbies > Lego e Blocos de Montar', 'MLB1157'),
('Brinquedos e Hobbies > Mini Veículos e Bicicletas', 'MLB6905'),
('Brinquedos e Hobbies > Modelismo Profissional', 'MLB1841'),
('Brinquedos e Hobbies > Música Infantil', 'MLB51397'),
('Brinquedos e Hobbies > Pelúcias', 'MLB1166'),
('Brinquedos e Hobbies > Veículos em Miniatura', 'MLB2097'),
('Brinquedos e Hobbies > Outros', 'MLB1910'),
('Calçados, Roupas e Bolsas > Acessórios da Moda', 'MLB1451'),
('Calçados, Roupas e Bolsas > Bermudas', 'MLB188064'),
('Calçados, Roupas e Bolsas > Bolsas', 'MLB7022'),
('Calçados, Roupas e Bolsas > Calças', 'MLB188065'),
('Calçados, Roupas e Bolsas > Camisas', 'MLB107292'),
('Calçados, Roupas e Bolsas > Camisetas e Blusas', 'MLB3122'),
('Calçados, Roupas e Bolsas > Casacos', 'MLB108803'),
('Calçados, Roupas e Bolsas > "Conjuntos Infantis', 'MLB28162'),
('Calçados, Roupas e Bolsas > Lotes de Roupa', 'MLB271219'),
('Calçados, Roupas e Bolsas > Macacão', 'MLB27250'),
('Calçados, Roupas e Bolsas > Malas e Carteiras', 'MLB1457'),
('Calçados, Roupas e Bolsas > Mochilas', 'MLB3127'),
('Calçados, Roupas e Bolsas > Moda Fitness', 'MLB270215'),
('Calçados, Roupas e Bolsas > Moda Íntima e Lingerie', 'MLB108786'),
('Calçados, Roupas e Bolsas > Moda Praia', 'MLB108838'),
('Calçados, Roupas e Bolsas > Óculos', 'MLB1456'),
('Calçados, Roupas e Bolsas > Roupas para Bebês', 'MLB5366'),
('Calçados, Roupas e Bolsas > Saias', 'MLB185489'),
('Calçados, Roupas e Bolsas > Sapatos', 'MLB23262'),
('Calçados, Roupas e Bolsas > Shorts', 'MLB188060'),
('Calçados, Roupas e Bolsas > Tênis', 'MLB23332'),
('Calçados, Roupas e Bolsas > Ternos', 'MLB108831'),
('Calçados, Roupas e Bolsas > Uniformes', 'MLB271862'),
('Calçados, Roupas e Bolsas > Vestidos', 'MLB108704'),
('Calçados, Roupas e Bolsas > Outros', 'MLB1911'),
('Câmeras e Acessórios > Acessórios para Câmeras', 'MLB1049'),
('Câmeras e Acessórios > Câmeras', 'MLB191839'),
('Câmeras e Acessórios > Cartões de Memória', 'MLB4893'),
('Câmeras e Acessórios > Equipamento de Revelação', 'MLB1048'),
('Câmeras e Acessórios > Filmadoras', 'MLB6989'),
('Câmeras e Acessórios > Instrumentos Ópticos', 'MLB4062'),
('Câmeras e Acessórios > Pilhas, Carregadores e Bateria', 'MLB4239'),
('Câmeras e Acessórios > Outros', 'MLB1914'),
('Carros, Motos e Outros > Caminhões', 'MLB5839'),
('Carros, Motos e Outros > Carros Antigos', 'MLB1745'),
('Carros, Motos e Outros > Carros e Caminhonetes', 'MLB1744'),
('Carros, Motos e Outros > Consórcios', 'MLB10965'),
('Carros, Motos e Outros > Motorhomes', 'MLB7370'),
('Carros, Motos e Outros > Motos', 'MLB1763'),
('Carros, Motos e Outros > Náutica', 'MLB1785'),
('Carros, Motos e Outros > Ônibus', 'MLB47400'),
('Carros, Motos e Outros > Veículos Pesados', 'MLB76421'),
('Carros, Motos e Outros > Outros Veículos', 'MLB1907'),
('Casa, Móveis e Decoração > Banheiros', 'MLB1613'),
('Casa, Móveis e Decoração > Cozinha', 'MLB1618'),
('Casa, Móveis e Decoração > Decoração', 'MLB1631'),
('Casa, Móveis e Decoração > Iluminação Residencial', 'MLB1582'),
('Casa, Móveis e Decoração > Jardim', 'MLB1621'),
('Casa, Móveis e Decoração > Lavanderia', 'MLB264051'),
('Casa, Móveis e Decoração > Materiais de Limpeza', 'MLB264050'),
('Casa, Móveis e Decoração > Móveis para Escritório', 'MLB3240'),
('Casa, Móveis e Decoração > Quarto', 'MLB1608'),
('Casa, Móveis e Decoração > Sala de Estar', 'MLB186012'),
('Casa, Móveis e Decoração > Sala de Jantar', 'MLB186013'),
('Casa, Móveis e Decoração > Segurança para Casa', 'MLB7069'),
('Casa, Móveis e Decoração > Outros', 'MLB1902'),
('Celulares e Telefones > Acessórios para Celulares', 'MLB3813'),
('Celulares e Telefones > Cartões de Memória', 'MLB7475'),
('Celulares e Telefones > Celulares e Smartphones', 'MLB1055'),
('Celulares e Telefones > Nextel', 'MLB5427'),
('Celulares e Telefones > Peças para Celular', 'MLB7462'),
('Celulares e Telefones > Telefones', 'MLB46195'),
('Celulares e Telefones > VoIP', 'MLB7502'),
('Celulares e Telefones > Walkie Talkies', 'MLB2908'),
('Celulares e Telefones > Outros', 'MLB1915'),
('Coleções e Comics > Álbuns e Figurinhas', 'MLB1831'),
('Coleções e Comics > Bonecas', 'MLB3415'),
('Coleções e Comics > Bonecos e Figuras de Ação', 'MLB3422'),
('Coleções e Comics > Canetas, Lápis e Afins', 'MLB2098'),
('Coleções e Comics > Cards e Card Games', 'MLB3390'),
('Coleções e Comics > Cartões Postais', 'MLB1807'),
('Coleções e Comics > Cartões Telefônicos', 'MLB1830'),
('Coleções e Comics > Cédulas e Moedas', 'MLB1806'),
('Coleções e Comics > Chaveiros', 'MLB2356'),
('Coleções e Comics > Coleções Diversas', 'MLB2356'),
('Coleções e Comics > Espadas e Artigos Militares', 'MLB1805'),
('Coleções e Comics > Filatelia', 'MLB1861'),
('Coleções e Comics > HQs e Mangás', 'MLB1861'),
('Coleções e Comics > Latas, Garrafas e Afins', 'MLB2314'),
('Coleções e Comics > Pôsteres e Fotografias', 'MLB1834'),
('Coleções e Comics > Publicações e Afins', 'MLB2456'),
('Coleções e Comics > Revistas de Coleção', 'MLB4489'),
('Coleções e Comics > Veículos em Miniatura', 'MLB3398'),
('Coleções e Comics > Outros', 'MLB2458'),
('Eletrodomésticos > Ar e Ventilação', 'MLB252358'),
('Eletrodomésticos > Bebedouros e Purificadores', 'MLB21171'),
('Eletrodomésticos > Coifas e Depuradores', 'MLB50495'),
('Eletrodomésticos > Eletroportáteis', 'MLB1581'),
('Eletrodomésticos > Forno e Fogões', 'MLB1580'),
('Eletrodomésticos > Geladeiras e Freezers', 'MLB1576'),
('Eletrodomésticos > Lava Louças e Acessórios', 'MLB252554'),
('Eletrodomésticos > Máquinas de Lavar', 'MLB21168'),
('Eletrodomésticos > Peças e Acessórios', 'MLB257284'),
('Eletrodomésticos > Outros', 'MLB1899'),
('Eletrônicos, Áudio e Vídeo > Acessórios para Áudio e Vídeo', 'MLB4887'),
('Eletrônicos, Áudio e Vídeo > Aparelhos DVD e Bluray', 'MLB1001'),
('Eletrônicos, Áudio e Vídeo > Áudio para Casa', 'MLB3835'),
('Eletrônicos, Áudio e Vídeo > Áudio Portátil', 'MLB3836'),
('Eletrônicos, Áudio e Vídeo > Áudio Profissional e DJs', 'MLB3837'),
('Eletrônicos, Áudio e Vídeo > Bateria, Pilhas e Carregadores', 'MLB4900'),
('Eletrônicos, Áudio e Vídeo > Calculadoras e Agendas', 'MLB1060'),
('Eletrônicos, Áudio e Vídeo > Copiadoras e  Acessórios', 'MLB31420'),
('Eletrônicos, Áudio e Vídeo > Drones e Acessórios', 'MLB264065'),
('Eletrônicos, Áudio e Vídeo > E-Readers', 'MLB82068'),
('Eletrônicos, Áudio e Vídeo > Fones de Ouvido', 'MLB196208'),
('Eletrônicos, Áudio e Vídeo > GPS', 'MLB3571'),
('Eletrônicos, Áudio e Vídeo > Home Theaters', 'MLB6800'),
('Eletrônicos, Áudio e Vídeo > iPod', 'MLB9622'),
('Eletrônicos, Áudio e Vídeo > MP3, MP4 e MP5 Players', 'MLB3846'),
('Eletrônicos, Áudio e Vídeo > Peças e Componentes Elétricos', 'MLB6999'),
('Eletrônicos, Áudio e Vídeo > Porta-Retratos Digitais', 'MLB11830'),
('Eletrônicos, Áudio e Vídeo > Projetores e Telas', 'MLB2830'),
('Eletrônicos, Áudio e Vídeo > Segurança para Casa', 'MLB2912'),
('Eletrônicos, Áudio e Vídeo > Suportes', 'MLB3690'),
('Eletrônicos, Áudio e Vídeo > Tablets e Acessórios', 'MLB82048'),
('Eletrônicos, Áudio e Vídeo > TV', 'MLB1002'),
('Eletrônicos, Áudio e Vídeo > TV a Cabo', 'MLB1007'),
('Eletrônicos, Áudio e Vídeo > Outros Eletrônicos', 'MLB4901'),
('Esportes e Fitness > Artes Marciais e Boxe', 'MLB2480'),
('Esportes e Fitness > Badminton', 'MLB223366'),
('Esportes e Fitness > Baseball', 'MLB10539'),
('Esportes e Fitness > Basquete', 'MLB1309'),
('Esportes e Fitness > Camping', 'MLB1362'),
('Esportes e Fitness > Ciclismo', 'MLB1292'),
('Esportes e Fitness > Equitação', 'MLB223498'),
('Esportes e Fitness > Esportes Aquáticos', 'MLB1277'),
('Esportes e Fitness > Esportes de Aventura e Ação', 'MLB1355'),
('Esportes e Fitness > Fitness e Musculação', 'MLB1338'),
('Esportes e Fitness > Futebol', 'MLB1286'),
('Esportes e Fitness > Futebol Americano', 'MLB1302'),
('Esportes e Fitness > Golfe', 'MLB9900'),
('Esportes e Fitness > Hockey', 'MLB251434'),
('Esportes e Fitness > Patins e Skates', 'MLB1293'),
('Esportes e Fitness > Pesca', 'MLB6796'),
('Esportes e Fitness > Protetores Esportivos', 'MLB80357'),
('Esportes e Fitness > Rugby', 'MLB270338'),
('Esportes e Fitness > Suplementos', 'MLB122102'),
('Esportes e Fitness > Tênis', 'MLB3900'),
('Esportes e Fitness > Tênis de Mesa', 'MLB10536'),
('Esportes e Fitness > Tênis e Squash', 'MLB1322'),
('Esportes e Fitness > Vôlei', 'MLB1333'),
('Esportes e Fitness > Outros', 'MLB1358'),
('Ferramentas e Construção > Construção', 'MLB1500'),
('Ferramentas e Construção > Energia Elétrica', 'MLB2467'),
('Ferramentas e Construção > Ferramentas', 'MLB5226'),
('Ferramentas e Construção > Mobiliário para Banheiros', 'MLB269773'),
('Ferramentas e Construção > Mobiliário para Cozinhas"', 'MLB269958'),
('Ferramentas e Construção > Painéis Solares', 'MLB269707'),
('Ferramentas e Construção > Pisos, Paredes e Esquadrias', 'MLB14548'),
('Ferramentas e Construção > Outros', 'MLB263533'),
('Filmes e Seriados > Camisetas de Cinema e TV', 'MLB40440'),
('Filmes e Seriados > Filmes', 'MLB1169'),
('Filmes e Seriados > Memorabilia de Cinema e TV', 'MLB40435'),
('Filmes e Seriados > Porta DVDs, Caixas e Envelopes', 'MLB40452'),
('Filmes e Seriados > Seriados', 'MLB6217'),
('Filmes e Seriados > Outros', 'MLB40412'),
('Games > Cartões Pré-Pagos para Jogos', 'MLB269348'),
('Games > Figuras Interativas', 'MLB270487'),
('Games > Fliperama', 'MLB51149'),
('Games > Nintendo', 'MLB186318'),
('Games > PlayStation', 'MLB186317'),
('Games > SEGA', 'MLB186319'),
('Games > Video Games', 'MLB186456'),
('Games > Xbox', 'MLB186320'),
('Games > Outros Consoles', 'MLB1152'),
('Informática > Acessórios de PC', 'MLB5940'),
('Informática > Acessórios para Notebook', 'MLB3377'),
('Informática > Alimentação para PCs', 'MLB1718'),
('Informática > All In One', 'MLB121405'),
('Informática > Apple', 'MLB1870'),
('Informática > Componentes para PC', 'MLB1712'),
('Informática > Computadores', 'MLB1649'),
('Informática > Copiadoras e  Acessórios', 'MLB1655'),
('Informática > Impressoras e Acessórios', 'MLB5875'),
('Informática > Memórias RAM', 'MLB1694'),
('Informática > Mídias Virgens', 'MLB3379'),
('Informática > Mini PCs', 'MLB269606'),
('Informática > Monitores e Acessórios', 'MLB14370'),
('Informática > Palms e Handhelds', 'MLB1651'),
('Informática > Pen Drives', 'MLB4980'),
('Informática > Porta CDs, Caixas e Envelopes', 'MLB3632'),
('Informática > Portáteis', 'MLB124090'),
('Informática > Processadores', 'MLB1693'),
('Informática > "Programas e Software', 'MLB1723'),
('Informática > Projetores e Telas', 'MLB1657'),
('Informática > Redes e Wi-Fi', 'MLB1700'),
('Informática > Tablets e Acessórios', 'MLB91757'),
('Informática > Outros', 'MLB1912'),
('Instrumentos Musicais > Acessórios Musicais', 'MLB7822'),
('Instrumentos Musicais > Acordeons', 'MLB8055'),
('Instrumentos Musicais > Amplificadores', 'MLB3011'),
('Instrumentos Musicais > Áudio Profissional', 'MLB4467'),
('Instrumentos Musicais > Baixos', 'MLB3018'),
('Instrumentos Musicais > Baterias e Percussão', 'MLB3004'),
('Instrumentos Musicais > Cavaquinhos', 'MLB5347'),
('Instrumentos Musicais > Equipamento para DJ', 'MLB4474'),
('Instrumentos Musicais > Guitarras', 'MLB2987'),
('Instrumentos Musicais > Metrônomos e Afinadores', 'MLB4479'),
('Instrumentos Musicais > Pedais e Efeitos de Som', 'MLB3007'),
('Instrumentos Musicais > Pianos, Órgãos e Teclados', 'MLB3022'),
('Instrumentos Musicais > Saxofones', 'MLB3771'),
('Instrumentos Musicais > Violinos', 'MLB5356'),
('Instrumentos Musicais > Violões', 'MLB3015'),
('Instrumentos Musicais > Outros', 'MLB3014'),
('Instrumentos Musicais > Outros Instrumentos de Corda', 'MLB4464'),
('Instrumentos Musicais > Outros Instrumentos de Sopro', 'MLB3005'),
('Joias e Relógios > Ferramentas para Joias', 'MLB118035'),
('Joias e Relógios > Joias e Bijuterias', 'MLB1431'),
('Joias e Relógios > Monitores Cardíacos', 'MLB5141'),
('Joias e Relógios > Pedras Preciosas', 'MLB1441'),
('Joias e Relógios > Piercings', 'MLB5122'),
('Joias e Relógios > Porta Joias', 'MLB40282'),
('Joias e Relógios > Relógios', 'MLB118017'),
('Joias e Relógios > Outros', 'MLB3938'),
('Livros > Catálogos', 'MLB11466'),
('Livros > Literatura Estrangeira', 'MLB4014'),
('Livros > Literatura Nacional', 'MLB4505'),
('Livros > Livros de Áreas de Interesse', 'MLB11444'),
('Livros > Livros Didáticos e de Educação', 'MLB11464'),
('Livros > Livros Infantis e Juvenis', 'MLB11440'),
('Livros > Livros Raros e Antigos', 'MLB1226'),
('Livros > Livros Universitários', 'MLB3029'),
('Livros > Revistas', 'MLB1222'),
('Livros > Outros', 'MLB1227'),
('Música > Camisetas de Música', 'MLB4488'),
('Música > "Memorabilia de Música', 'MLB6241'),
('Música > Música', 'MLB1174'),
('Música > Música Infantil', 'MLB2142'),
('Música > Porta CDs, Caixas e Envelopes', 'MLB3362'),
('Música > Outros', 'MLB1228'),
('Saúde > Acessibilidade e Mobilidade', 'MLB264180'),
('Saúde > Aparelhos para Fisioterapia', 'MLB264179'),
('Saúde > Aromaterapia', 'MLB268500'),
('Saúde > Cuidado da Saúde', 'MLB264192'),
('Saúde > Lentes de Contato', 'MLB180291'),
('Saúde > Massagem', 'MLB10217'),
('Saúde > Ortopedia', 'MLB264200'),
('Saúde > Saúde Dental', 'MLB6182'),
('Saúde > Suplementos Alimentares', 'MLB264201'),
('Saúde > Outros', 'MLB264678'),
('Mais Categorias > Adultos', 'MLB2818'),
('Mais Categorias > Artigos de Armarinho', 'MLB270263'),
('Mais Categorias > Esoterismo e Ocultismo', 'MLB1740'),
('Mais Categorias > Materiais Escolares', 'MLB44011'),
('Mais Categorias > Tabacaria', 'MLB263855'),
('Outras Categorias', 'NULO');
/* Nao estao incluidos: imoveis, ingressos, servicos, moedas virtuais, outros */

INSERT INTO acoesEventos
(descricao)
VALUES
('foi criado'),
('teve a data atualizada'),
('teve a hora atualizada'),
('teve o local atualizado'),
('teve o endereço atualizado'),
('teve a data limite de confirmação atualizada'),
('teve o limite de itens por convidado atualizado'),
('teve a lista de presentes atualizada'),
('teve os convidados atualizados'),
('foi cancelado'),
('teve o título atualizado'),
('teve o tipo atualizado'),
('teve a descrição atualizada');

INSERT INTO acoesUsuarios
(descricao)
VALUES
('fez login no sistema'),
('fez logout do sistema'),
('atualizou a senha'),
('teve conta bloqueada por falha de login'),
('desativou a conta'),
('atualizou a imagem'),
('atualizou o e-mail'),
('ativou as notificações por e-mail'),
('desativou as notificações por e-mail'),
('atualizou o endereço'),
('atualizou os telefones');

INSERT INTO empresas
(razaoSocial, nomeFantasia, cnpj, email, logomarca, site, ativa)
VALUES
('B2W - Companhia Digital', 'Americanas', '00776574000660', 'atendimento.acom@americanas.com', '1.jpg', 'http://www.americanas.com.br', 1),
('B2W - Companhia Digital', 'Submarino', '00776574000660', 'atendimento.sub@americanas.com', '2.jpg', 'http://www.submarino.com.br', 0),
('B2W - Companhia Digital', 'Shoptime', '00776574000660', 'atendimento.shop@americanas.com', '3.jpg', 'http://www.shoptime.com.br', 0),
('Via Varejo', 'Casas Bahia', '33041260065290', 'email@casasbahia.com.br', '4.jpg', 'http://www.casasbahia.com.br', 0),
('Saraiva e Siciliano S/A', 'Livraria Saraiva', '61365284000104', 'email@saraiva.com.br', '5.jpg', 'http://www.saraiva.com.br', 0),
('F. Brasil LTDA', 'Fnac', '02634926000164', 'email@fnac.com.br', '6.jpg', 'http://www.fnac.com.br', 0),
('Livraria Cultura S/A', 'Livraria Cultura', '62410352000172', 'email@livrariacultura.com.br', '7.jpg', 'http://www.livrariacultura.com.br', 0),
('CNOVA Comércio Eletrônico S/A', 'Ponto Frio', '07170938000107', 'email@pontofrio.com.br', '8.jpg', 'http://www.pontofrio.com.br', 0),
('CNOVA Comércio Eletrônico S/A', 'Extra', '07170938000107', 'email@extra.com.br', '9.jpg', 'http://www.extra.com.br', 0),
('Magazine Luiza S/A', 'Magazine Luiza', '47960950044927', 'atendimento.site@magazineluiza.com.br', '10.jpg', 'http://www.magazineluiza.com.br', 0),
('Fast Shop S/A', 'Fast Shop', '43708379000100', 'email@fastshop.com.br', '11.jpg', 'https://www.fastshop.com.br', 0),
('RN Comércio Varejista S/A', 'Ricardo Eletro', '13481309010155', 'email@ricardoeletro.com.br', '12.jpg', 'http://www.ricardoeletro.com.br', 0);

INSERT INTO enderecos
(cep, logradouro, numero, complemento, bairro, cidade, estado)
VALUES
('96077010', 'Rua Alberto Pimentel', 100, 'Apto 100', 'Areal', 'Pelotas', 'RS'),
('88512375', 'Rua Antônio Marini Neto', 200, '', 'Bela Vista', 'Lages', 'SC'),
('87047429', 'Rua Pioneiro Geraldo Portela', 300, 'Apto 100', 'Conjunto Habitacional Requião', 'Maringá', 'PR'),
('18116713', 'Rua Projetada', 400, '', 'Jardim Clarice I', 'Votorantim', 'SP'),
('25965013', 'Rua Haroldo Guilherme Rebelo', 500, 'Apto 100', 'Barra do Imbuí', 'Teresópolis', 'RJ'),
('97545020', 'Rua Agapito Lara Rodrigues', 600, '', 'Lara', 'Alegrete', 'RS'),
('66843171', 'Alameda Atlântica', 700, 'Apto 100', 'Água Boa (Outeiro)', 'Belém', 'PA'),
('59157210', 'Rua Rosa Massud Costa', 800, '', 'Cajupiranga', 'Parnamirim', 'RN'),
('91140130', 'Rua da Cidadania', 900, 'Apto 100', 'Sarandi', 'Porto Alegre', 'RS'),
('88804190', 'Rua Afrânio Peixoto', 1000, '', 'Santa Bárbara', 'Criciúma', 'SC'),
('81930610', 'Rua Pedro Picussa', 1100, 'Apto 100', 'Umbará', 'Curitiba', 'PR'),
('13056489', 'Rua Cairu', 1200, '', 'Parque Universitário de Viracopo', 'Campinas', 'SP'),
('13506842', 'Rua P 1A', 1300, 'Apto 100', 'Vila Paulista', 'Rio Claro', 'SP'),
('95090400', 'Estrada Municipal Ezidoro Comerlato', 1400, '', 'Galópolis', 'Caxias do Sul', 'RS'),
('54350341', '1ª Travessa da Rua Um', 1500, 'Apto 100', 'Muribeca', 'Jaboatão dos Guararapes', 'PE'),
('72316089', 'Quadra QR 204 Conjunto 9', 1600, '', 'Samambaia Norte (Samambaia)', 'Brasília', 'DF'),
('91340060', 'Rua Ivescio Pacheco', 1700, 'Apto 100', 'Passo D Areia', 'Porto Alegre', 'RS'),
('88104559', 'Rua Manoel José dos Santos', 1800, '', 'Fazenda Santo Antônio', 'São José', 'SC'),
('68905300', 'Rua Sétima da Baixada do Japonês', 1900, 'Apto 100', 'Cidade Nova', 'Macapá', 'AM'),
('67133480', 'Passagem São Roque', 2000, '', 'Cidade Nova', 'Ananindeua', 'PA');

INSERT INTO usuarios
(nomeUsuario, senha, nome, sobrenome, email, notificaEmail,
   cpf, dataNasc, genero, imagem, nivel, ativo, tentaLogin, idEndereco)
VALUES
('cineasthales', '10a9c136d796bab18d3e144092a4f20a', 'Thales', 'Castro', 'thalesccastro@gmail.com', 0, '80606784004', '1989-01-01', 'Masculino', '47a3061adc82e0bae5b3beae9ec0515e.jpg', 1, 1, 0, 1),
('alicem', '10a9c136d796bab18d3e144092a4f20a', 'Alice', 'Moreira', 'tccastro@inf.ufpel.edu.br', 1, '99999999999', '1991-01-01', 'Feminino', '608255509c8c6bd0d65c5e0c0f47ba91.jpg', 0, 1, 0, 2),
('joaos', '10a9c136d796bab18d3e144092a4f20a', 'João', 'Santos', 'petcomputacaoufpel@gmail.com', 1, '77777777777', '1993-01-01', 'Masculino', 'ff333516eac1345425e9d83ffc68ab34.jpg', 0, 1, 0, 3),
('marias', '10a9c136d796bab18d3e144092a4f20a', 'Maria', 'Silva', 'marias@gmail.com', 0, '88888888888', '1992-01-01', 'Feminino', '2c175141d8ddef0471451234fb25f19b.jpg', 0, 1, 0, 4),
('pedrof', '10a9c136d796bab18d3e144092a4f20a', 'Pedro', 'Francisco', 'pedrof@gmail.com', 0, '66666666666', '1994-01-01', 'Masculino', 'f0f8b7ac703d7255be45c89b0edf8ab2.jpg', 0, 0, 0, 5),
('guilhermes', '10a9c136d796bab18d3e144092a4f20a', 'Guilherme', 'Souza', 'guilhermes@gmail.com', 0, '55555555555', '1995-01-01', 'Masculino', '1e6aed455f586675511b3812e31b09c5.jpg', 0, 1, 0, 6),
('juang', '10a9c136d796bab18d3e144092a4f20a', 'Juan', 'Gonzales', 'juang@gmail.com', 0, '44444444444', '1996-01-01', 'Masculino', '7d68546cb3a899bddf494fdfdfd13232.jpg', 0, 1, 0, 7),
('nataliaa', '10a9c136d796bab18d3e144092a4f20a', 'Natalia', 'Albuquerque', 'nataliaag@gmail.com', 0, '33333333333', '1997-01-01', 'Feminino', '0a07174d6384f701271497bece575c7f.jpg', 0, 1, 0, 8),
('barbaral', '10a9c136d796bab18d3e144092a4f20a', 'Barbara', 'Lacerda', 'barbaral@gmail.com', 0, '22222222222', '1998-01-01', 'Feminino', 'fb8638f246d111bda7480b0dcca4296e.jpg', 0, 1, 0, 9),
('patriciag', '10a9c136d796bab18d3e144092a4f20a', 'Patricia', 'Guimarães', 'patriciag@gmail.com', 0, '11111111111', '1999-01-01', 'Feminino', '340a5ec5d48b25fad384ee349be416f3.jpg', 0, 1, 0, 10),
('remonas', '10a9c136d796bab18d3e144092a4f20a', 'Remona', 'Scott', 'remonas@gmail.com', 0, '00000000000', '1988-01-01', 'Feminino', '37f324b4ed00b90c02f49afafd59ccf8.jpg', 0, 1, 0, 11),
('sandrag', '10a9c136d796bab18d3e144092a4f20a', 'Sandra', 'Guerra', 'sandrag@gmail.com', 0, '11111111112', '1987-01-01', 'Feminino', 'd8d8f13416fb9827a76eec1043b4e956.jpg', 0, 1, 0, 12),
('irmaw', '10a9c136d796bab18d3e144092a4f20a', 'Irma', 'Weeks', 'irmaw@gmail.com', 0, '11111111113', '1986-01-01', 'Feminino', 'dd9654bfdb84456a591deba17bef91fc.jpg', 0, 1, 0, 13),
('erikac', '10a9c136d796bab18d3e144092a4f20a', 'Erika', 'Clarcs', 'erikac@gmail.com', 0, '11111111114', '1985-01-01', 'Feminino', '29bc5533c994296861fdeefd06bacfaa.jpg', 0, 1, 0, 14),
('paulj', '10a9c136d796bab18d3e144092a4f20a', 'Paul', 'James', 'paulj@gmail.com', 0, '11111111115', '1984-01-01', 'Masculino', '19f32ef64de3f48833254032bd3caa03.jpg', 0, 1, 0, 15),
('larrya', '10a9c136d796bab18d3e144092a4f20a', 'Larry', 'Adams', 'larrya@gmail.com', 0, '11111111116', '1983-01-01', 'Masculino', 'c2a1691e6edc8e7a76fe7b55403491c0.jpg', 0, 1, 0, 16),
('maryw', '10a9c136d796bab18d3e144092a4f20a', 'Mary', 'White', 'maryw@gmail.com', 0, '11111111117', '1982-01-01', 'Travesti', '35954157d7f7f81fd24ec98fa575db39.jpg', 0, 1, 0, 17),
('cristinar', '10a9c136d796bab18d3e144092a4f20a', 'Cristina', 'Rivera', 'cristinar@gmail.com', 0, '11111111118', '1981-01-01', 'Não-Binário', '88d8f697438d9dbf7f84eb6a4a71dcd5.jpg', 0, 1, 0, 18),
('francesl', '10a9c136d796bab18d3e144092a4f20a', 'Frances', 'Lough', 'francesl@gmail.com', 0, '11111111119', '1980-01-01', 'Travesti', '20f45a2bc7cfe25d43e62d8e3c5dd876.jpg', 0, 1, 0, 19),
('jenniferl', '10a9c136d796bab18d3e144092a4f20a', 'Jennifer', 'Lim', 'jenniferl@gmail.com', 0, '11111111110', '1990-01-01', 'Transexual', '05ec04013d4f3e58a90d37ff9c7d73d0.jpg', 0, 1, 0, 20);

INSERT INTO telefones
(ddd, numero, idUsuario)
VALUES
('53', '939212332', 1),
('11', '981222222', 2),
('21', '992133114', 3),
('31', '993223352', 4),
('41', '995325521', 5),
('51', '978379135', 6),
('61', '902340195', 7),
('71', '984452906', 8),
('81', '943080933', 9),
('91', '964919625', 10);

INSERT INTO amizades
(idUsuario1, idUsuario2, ativa, bloqueado1, bloqueado2, data)
VALUES
(2, 3, 1, 0, 0, '2018-01-05'),
(2, 4, 1, 0, 0, '2018-02-05'),
(2, 6, 1, 0, 0, '2018-03-05'),
(2, 7, 1, 0, 0, '2018-04-05'),
(2, 9, 1, 0, 0, '2018-05-05'),
(2, 13, 1, 0, 0, '2018-06-05'),
(3, 4, 1, 0, 0, '2018-07-05'),
(3, 5, 1, 0, 0, '2018-08-05'),
(3, 10, 1, 0, 0, '2018-09-05'),
(3, 11, 1, 0, 0, '2018-10-05'),
(3, 17, 1, 0, 0, '2018-11-05'),
(3, 19, 1, 0, 0, '2017-01-05'),
(4, 6, 1, 0, 0, '2017-02-05'),
(4, 7, 1, 0, 0, '2017-03-05'),
(4, 8, 1, 0, 0, '2017-04-05'),
(4, 14, 1, 0, 0, '2017-05-05'),
(4, 18, 1, 0, 0, '2017-06-05'),
(4, 20, 1, 0, 0, '2017-07-05');

INSERT INTO anuncios
(imagem, url, ativo, idEmpresa, idCategoria)
VALUES
('ad1.jpg', 'http://www.americanas.com.br', 1, 1, 1),
('ad1.jpg', 'http://www.shoptime.com.br', 1, 2, 50),
('ad1.jpg', 'http://www.casasbahia.com.br', 1, 3, 100),
('ad1.jpg', 'http://www.saraiva.com.br', 1, 4, 150),
('ad1.jpg', 'http://www.fnac.com.br', 1, 5, 200),
('ad1.jpg', 'http://www.livrariacultura.com.br', 1, 6, 170),
('ad1.jpg', 'http://www.pontofrio.com.br', 1, 7, 140),
('ad1.jpg', 'http://www.extra.com.br', 1, 8, 110),
('ad1.jpg', 'http://www.magazineluiza.com.br', 1, 9, 90),
('ad1.jpg', 'https://www.fastshop.com.br', 1, 10, 60);

INSERT INTO cliquesAnuncios
(data, hora, idAnuncio, idUsuario)
VALUES
('2018-07-01', '01:00:00', 1, 1),
('2018-07-02', '02:00:00', 2, 2),
('2018-07-03', '03:00:00', 3, 3),
('2018-07-04', '04:00:00', 3, 4),
('2018-07-05', '05:00:00', 5, 5),
('2018-07-06', '06:00:00', 1, 6),
('2018-07-07', '07:00:00', 7, 7),
('2018-07-08', '08:00:00', 5, 8),
('2018-07-09', '09:00:00', 1, 9),
('2018-07-10', '10:00:00', 2, 10),
('2018-07-11', '11:00:00', 2, 11),
('2018-07-12', '12:00:00', 2, 12),
('2018-07-13', '13:00:00', 4, 13),
('2018-07-14', '14:00:00', 1, 14),
('2018-07-15', '15:00:00', 7, 15),
('2018-07-16', '16:00:00', 10, 16),
('2018-07-17', '17:00:00', 9, 17),
('2018-07-18', '18:00:00', 1, 18),
('2018-07-19', '19:00:00', 2, 19),
('2018-07-20', '20:00:00', 10, 20);

INSERT INTO interesses
(idUsuario, idCategoria, peso, data)
VALUES
(2, 27, 0, '2018-09-26'),
(2, 149, 0, '2018-11-27'),
(2, 150, 0, '2018-11-27'),
(2, 185, 0, '2018-11-27'),
(2, 190, 0, '2018-09-26'),
(2, 254, 0, '2018-09-26'),
(2, 300, 0, '2018-11-27'),
(2, 380, 0, '2018-11-27'),
(3, 125, 0, '2018-09-26'),
(3, 127, 0, '2018-11-27'),
(3, 212, 0, '2018-09-26'),
(3, 264, 0, '2018-09-26'),
(3, 298, 0, '2018-11-27'),
(3, 380, 0, '2018-11-27'),
(4, 223, 0, '2018-11-27'),
(4, 224, 0, '2018-11-27'),
(4, 250, 0, '2018-11-27');
