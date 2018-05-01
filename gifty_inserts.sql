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
('Despedida de Solteiro(a)'),
('Festa de Despedida');

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

INSERT INTO empresas
(razaoSocial, nomeFantasia, cnpj, email, logomarca, site, ativa)
VALUES
('B2W - Companhia Digital', 'Americanas.com', '00.776.574/0006-60', 'atendimento.acom@americanas.com', 'logo_americanas.png', 'http://www.americanas.com.br', 0),
('Via Varejo', 'Casas Bahia', '33.041.260/0652-90', 'sac@casasbahia.com.br', 'logo_casasbahia.png', 'http://www.casasbahia.com.br', 0),
('Saraiva e Siciliano S/A', 'Livraria Saraiva', '61.365.284/0001-04', '', 'logo_saraiva.png', 'http://www.saraiva.com.br', 0);

INSERT INTO enderecos
(cep, logradouro, numero, complemento, bairro, cidade, estado)
VALUES
('96077010', 'Rua Alberto Pimentel', 317,'', 'Areal', 'Pelotas', 'RS'),
('96020000', 'Rua General Osório', 1125, '', 'Centro', 'Pelotas','RS'),
('96015560', 'Rua Gonçalves Chaves', 2250, '', 'Centro', 'Pelotas','RS'),
('96015140', 'Avenida Bento Gonçalves', 3500, '', 'Centro', 'Pelotas','RS'),
('96085000', 'Avenida Ferreira Viana', 4750, '', 'Areal', 'Pelotas','RS');

INSERT INTO itens
(nome, descricao, categoria, preco, imagem)
VALUES
('Apple iPhone X', 'O melhor IPhone já feito', 'Telefonia', 4000, 'iphonex.jpg'),
('Samsung Galaxy S8', 'O melhor Samsung já feito', 'Telefonia', 3300, 'sgs8.jpg'),
('Dell Inspiron 1111', 'O melhor Dell já feito', 'Informática', 2200, 'delli1111.jpg');

INSERT INTO usuarios
(nomeUsuario, senha, nome, sobrenome, email, notificaEmail,
   cpf, dataNasc, genero, imagem, nivel, ativo, tentaLogin, idEndereco)
VALUES
('cineasthales', '8c6cd3b74652e166638f9a672ca12171', 'Thales', 'Castro', 'thalesccastro@gmail.com', 0, '80606784004', '1989-06-24', 'Masculino', '1.jpg', 1, 1, 0, 1),
('alicem', '8c6cd3b74652e166638f9a672ca12171', 'Alice', 'Moreira', 'alicem@gmail.com', 1, '99999999999', '1995-01-01', 'Feminino', '2.jpg', 0, 1, 0, 2),
('marias', '8c6cd3b74652e166638f9a672ca12171', 'Maria', 'Silva', 'marias@gmail.com', 1, '88888888888', '1999-01-01', 'Feminino', '3.jpg', 0, 1, 0, 3),
('joaos', '8c6cd3b74652e166638f9a672ca12171', 'João', 'Santos', 'joaos@gmail.com', 1, '77777777777', '1997-01-01', 'Masculino', '4.jpg', 0, 1, 0, 4),
('pedrof', '8c6cd3b74652e166638f9a672ca12171', 'Pedro', 'Francisco', 'pedrof@gmail.com', 1, '66666666666', '1994-01-01', 'Masculino', '5.jpg', 0, 0, 0, 5);

INSERT INTO telefones
(ddd, numero, idUsuario)
VALUES
('53', '32281156', 1),
('11', '981222222', 2),
('21', '992133114', 3),
('51', '993223352', 4),
('31', '995325521', 5);

INSERT INTO amizades
(idUsuario1, idUsuario2, ativa, bloqueado1, bloqueado2, dataAmizade)
VALUES
(2,1,0,0,0,'2018-01-05'),
(2,3,1,0,0,'2018-04-05'),
(2,4,1,0,0,'2018-02-05'),
(2,5,1,1,0,'2018-03-05');

INSERT INTO logUsuarios
(idUsuario, idAcaoUsuario, data, hora)
VALUES
(2,1,'2018-01-05','14:00'),
(2,2,'2018-01-05','15:00');

INSERT INTO interesses
(idUsuario, idTipoInteresse)
VALUES
(2,1),
(2,2),
(2,3),
(2,4),
(2,5);

/*
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
