USE gifty;

INSERT INTO tiposEventos
(descricao)
VALUES
('Aniversário'),
('Aniversário de 15 Anos'),
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
('Despedida de Solteiro(a)');

INSERT INTO tiposInteresses
(descricao)
VALUES
('Bebidas Alcoólicas'),
('Doces'),
('Chás'),
('Artesanato'),
('Artes'),
('Artigos Religiosos'),
('Carros'),
('Motocicletas'),
('Artigos para Bebês'),
('Brinquedos'),
('Games'),
('Jogos de Tabuleiro / Cartas'),
('Cama / Mesa / Banho'),
('Esotéricos'),
('Móveis'),
('Decoração'),
('Utensílios de Cozinha'),
('CDs'),
('DVDs / Bluray'),
('Construção e Ferramentas'),
('Jardinagem'),
('Discos de Vinil'),
('Eletrodomésticos'),
('Eletrônicos'),
('Artigos Esportivos'),
('Camping e Pesca'),
('Bicicletas'),
('Fotografia e Video'),
('Joias e Relógios'),
('Itens para Indústria, Comércio e Serviços'),
('Informática'),
('Animais Domésticos'),
('Perfumaria, Beleza e Higiene Pessoal'),
('Sex Shop'),
('Tabacaria'),
('Telefonia');

INSERT INTO acoesEventos
(descricao)
VALUES
('criou o evento'),
('atualizou a data'),
('atualizou a hora'),
('atualizou o local'),
('atualizou o endereço'),
('atualizou a data limite de confirmação'),
('atualizou o máximo de itens por convidado'),
('atualizou a lista de presentes'),
('atualizou os convidados'),
('cancelou o evento');

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
('atualizou os telefones'),
('atualizou os interesses');

/*
INSERT INTO empresas
(razaoSocial, nomeFantasia, cnpj, email, logomarca, site, ativa)
VALUES
('', '', '', '', '', '',),
('', '', '', '', '', '',),
('', '', '', '', '', '',),
('', '', '', '', '', '',),
('', '', '', '', '', '',);
*/

INSERT INTO enderecos
(cep, logradouro, numero, complemento, bairro, cidade, estado)
VALUES
('96077010', 'Rua Alberto Pimentel', 317,'', 'Areal', 'Pelotas', 'RS');
/*
('', '',,'','','',''),
('', '',,'','','',''),
('', '',,'','','',''),
('', '',,'','','','');

INSERT INTO itens
(nome, descricao, categoria, preco, imagem)
VALUES
('', '', '',,''),
('', '', '',,''),
('', '', '',,''),
('', '', '',,''),
('', '', '',,'');
*/

INSERT INTO usuarios
(nomeUsuario, senha, nome, sobrenome, email, notificaEmail,
   cpf, dataNasc, sexo, imagem, nivel, ativo, tentaLogin, idEndereco)
VALUES
('cineasthales', 'bd04eafe31c7fd703cc87b51962b4969', 'Thales', 'Castro', 'thalesccastro@gmail.com', 1, '80606784004', '1989-06-24', 'Masculino', '1', 2, 1, 0, 1);

/*
('', '', '', '', '',, '', '', '', '',,,,),
('', '', '', '', '',, '', '', '', '',,,,),
('', '', '', '', '',, '', '', '', '',,,,),
('', '', '', '', '',, '', '', '', '',,,,);

INSERT INTO telefones
(ddd, numero, idUsuario)
VALUES
('', '',),
('', '',),
('', '',),
('', '',),
('', '',);

INSERT INTO amizades
(idUsuario1, idUsuario2, ativa, bloqueado1, bloqueado2, dataAmizade)
VALUES
(,,,,,''),
(,,,,,''),
(,,,,,''),
(,,,,,''),
(,,,,,'');

INSERT INTO logUsuarios
(idUsuario, idAcaoUsuario, data, hora)
VALUES
(,,'',''),
(,,'',''),
(,,'',''),
(,,'',''),
(,,'','');

INSERT INTO interesses
(idUsuario, idTipoInteresse)
VALUES
(,),
(,),
(,),
(,),
(,);

INSERT INTO eventos
(titulo, descricao, data, hora, local, ativo, maxItens, dataLimite,
   idUsuario, idEndereco, idTipoEvento)
VALUES
('', '', '', '', '',,,'',,,),
('', '', '', '', '',,,'',,,),
('', '', '', '', '',,,'',,,),
('', '', '', '', '',,,'',,,),
('', '', '', '', '',,,'',,,);

INSERT INTO convidados
(idUsuario, idEvento, comparecera, compareceu, bloqueado)
VALUES
(,,,,),
(,,,,),
(,,,,),
(,,,,),
(,,,,);

INSERT INTO listas
(idEvento, idItem, prioridade, dataAdicao, idComprador)
VALUES
(,,,'',),
(,,,'',),
(,,,'',),
(,,,'',),
(,,,'',);

INSERT INTO logEventos
(idEvento, idUsuario, idAcaoEvento, data, hora)
VALUES
(,,,'',''),
(,,,'',''),
(,,,'',''),
(,,,'',''),
(,,,'','');

INSERT INTO anuncios
(imagem, url, ativo, idEmpresa)
VALUES
('','',,),
('','',,),
('','',,),
('','',,),
('','',,);

INSERT INTO cliquesAnuncios
(data, hora, idAnuncio, idUsuario)
VALUES
('','',,),
('','',,),
('','',,),
('','',,),
('','',,);

INSERT INTO cliquesEmpresas
(data, hora, idEmpresa, idUsuario)
VALUES
('','',,),
('','',,),
('','',,),
('','',,),
('','',,);
*/
