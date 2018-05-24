-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gifty
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gifty
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gifty` DEFAULT CHARACTER SET utf8 ;
USE `gifty` ;

-- -----------------------------------------------------
-- Table `gifty`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`enderecos` (
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
-- Table `gifty`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`usuarios` (
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
    REFERENCES `gifty`.`enderecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`telefones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`telefones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ddd` VARCHAR(3) NOT NULL,
  `numero` VARCHAR(20) NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`id`, `idUsuario`),
  INDEX `fk_telefones_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_telefones_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`tiposEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`tiposEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`eventos` (
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
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_enderecos1`
    FOREIGN KEY (`idEndereco`)
    REFERENCES `gifty`.`enderecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_tiposEventos1`
    FOREIGN KEY (`idTipoEvento`)
    REFERENCES `gifty`.`tiposEventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`itens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(240) NOT NULL,
  `descricao` MEDIUMTEXT NOT NULL,
  `categoria` VARCHAR(255) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `imagem` VARCHAR(4094) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`amizades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`amizades` (
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
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_usuarios_usuarios1`
    FOREIGN KEY (`idUsuario1`)
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`convidados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`convidados` (
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
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_eventos_eventos1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `gifty`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`listas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`listas` (
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
    REFERENCES `gifty`.`eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_has_itens_itens1`
    FOREIGN KEY (`idItem`)
    REFERENCES `gifty`.`itens` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`empresas` (
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
-- Table `gifty`.`anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`anuncios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imagem` VARCHAR(100) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `ativo` TINYINT NOT NULL,
  `idEmpresa` INT NOT NULL,
  PRIMARY KEY (`id`, `idEmpresa`),
  INDEX `fk_banners_empresas1_idx` (`idEmpresa` ASC),
  CONSTRAINT `fk_banners_empresas1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `gifty`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`tiposInteresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`tiposInteresses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`interesses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`interesses` (
  `idUsuario` INT NOT NULL,
  `idTipoInteresse` INT NOT NULL,
  PRIMARY KEY (`idUsuario`, `idTipoInteresse`),
  INDEX `fk_usuarios_has_interesses_interesses1_idx` (`idTipoInteresse` ASC),
  INDEX `fk_usuarios_has_interesses_usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_usuarios_has_interesses_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_interesses_interesses1`
    FOREIGN KEY (`idTipoInteresse`)
    REFERENCES `gifty`.`tiposInteresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`cliquesAnuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`cliquesAnuncios` (
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
    REFERENCES `gifty`.`anuncios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliquesAnuncios_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`cliquesEmpresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`cliquesEmpresas` (
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
    REFERENCES `gifty`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliquesItens_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`acoesUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`acoesUsuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`logUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`logUsuarios` (
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
    REFERENCES `gifty`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_acoes_acoes1`
    FOREIGN KEY (`idAcaoUsuario`)
    REFERENCES `gifty`.`acoesUsuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`acoesEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`acoesEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gifty`.`logEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gifty`.`logEventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idEvento` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  `idAcaoEvento` INT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  PRIMARY KEY (`id`, `idEvento`, `idUsuario`, `idAcaoEvento`),
  INDEX `fk_eventos_has_acoesEventos_acoesEventos1_idx` (`idAcaoEvento` ASC),
  INDEX `fk_eventos_has_acoesEventos_eventos1_idx` (`idEvento` ASC, `idUsuario` ASC),
  CONSTRAINT `fk_eventos_has_acoesEventos_eventos1`
    FOREIGN KEY (`idEvento` , `idUsuario`)
    REFERENCES `gifty`.`eventos` (`id` , `idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_has_acoesEventos_acoesEventos1`
    FOREIGN KEY (`idAcaoEvento`)
    REFERENCES `gifty`.`acoesEventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
