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
('Festa de Despedida'),
('Religioso');

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
('Indústria, Comércio e Serviços'),
('Informática'),
('Animais Domésticos'),
('Perfumaria, Beleza e Higiene Pessoal'),
('Sex Shop'),
('Tabacaria'),
('Telefonia');

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
('foi cancelado');

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
('B2W - Companhia Digital', 'Americanas', '00.776.574/0006-60', 'atendimento.acom@americanas.com', '1.jpg', 'http://www.americanas.com.br', 0),
('B2W - Companhia Digital', 'Submarino', '00.776.574/0006-60', 'atendimento.sub@americanas.com', '2.jpg', 'http://www.submarino.com.br', 0),
('B2W - Companhia Digital', 'Shoptime', '00.776.574/0006-60', 'atendimento.shop@americanas.com', '3.jpg', 'http://www.shoptime.com.br', 0),
('Via Varejo', 'Casas Bahia', '33.041.260/0652-90', 'email@casasbahia.com.br', '4.jpg', 'http://www.casasbahia.com.br', 0),
('Saraiva e Siciliano S/A', 'Livraria Saraiva', '61.365.284/0001-04', 'email@saraiva.com.br', '5.jpg', 'http://www.saraiva.com.br', 0),
('F. Brasil LTDA', 'Fnac', '02.634.926/0001-64', 'email@fnac.com.br', '6.jpg', 'http://www.fnac.com.br', 0),
('Livraria Cultura S/A', 'Livraria Cultura', '62.410.352/0001-72', 'email@livrariacultura.com.br', '7.jpg', 'http://www.livrariacultura.com.br', 0),
('CNOVA Comércio Eletrônico S/A', 'Ponto Frio', '07.170.938/0001-07', 'email@pontofrio.com.br', '8.jpg', 'http://www.pontofrio.com.br', 0),
('CNOVA Comércio Eletrônico S/A', 'Extra', '07.170.938/0001-07', 'email@extra.com.br', '9.jpg', 'http://www.extra.com.br', 0),
('Magazine Luiza S/A', 'Magazine Luiza', '47.960.950/0449-27', 'atendimento.site@magazineluiza.com.br', '10.jpg', 'http://www.magazineluiza.com.br', 0),
('Fast Shop S/A', 'Fast Shop', '43.708.379/0001-00', 'email@fastshop.com.br', '11.jpg', 'https://www.fastshop.com.br', 0),
('RN Comércio Varejista S/A', 'Ricardo Eletro', '13.481.309/0101-55', 'email@ricardoeletro.com.br', '12.jpg', 'http://www.ricardoeletro.com.br', 0);

INSERT INTO enderecos
(cep, logradouro, numero, complemento, bairro, cidade, estado)
VALUES
('96077010', 'Rua Alberto Pimentel', 317, '', 'Areal', 'Pelotas', 'RS'),
('96020000', 'Rua General Osório', 1125, '', 'Centro', 'Pelotas','RS'),
('96015560', 'Rua Gonçalves Chaves', 2250, '', 'Centro', 'Pelotas','RS'),
('96015140', 'Avenida Bento Gonçalves', 3500, '', 'Centro', 'Pelotas','RS'),
('96085000', 'Avenida Ferreira Viana', 4750, '', 'Areal', 'Pelotas','RS'),
('96015590', 'Rua Princesa Isabel', 531, '', 'Centro', 'Pelotas', 'RS'),
('96085470', 'Avenida Domingos de Almeida', 3511, '', 'Areal', 'Pelotas', 'RS'),
('96010496', 'Avenida Presidente Juscelino Kubitschek de Oliveira', 241, '', 'Centro', 'Pelotas', 'RS'),
('96015440', 'Rua Marechal Floriano', 653, '', 'Centro', 'Pelotas', 'RS'),
('96020360', 'Rua Professor Doutor Araújo', 918,'', 'Centro', 'Pelotas', 'RS');

INSERT INTO itens
(nome, descricao, categoria, preco, imagem)
VALUES
('Smartphone Apple iPhone X 32Gb', 'O melhor iPhone já feito', 'Telefonia', 3999.99, '1.jpg'),
('Smartphone Samsung Galaxy S9', 'O melhor Samsung Galaxy já feito', 'Telefonia', 3299.99, '2.jpg'),
('Refrigerador Electrolux DC51X 475 Litros Inox', 'O melhor refrigerador já feito', 'Eletrodomésticos', 2229.99, '3.jpg'),
('Brastemp BWJ11AB Superior 11 Kg Branco', 'A melhor lavadora já feita', 'Eletrodomésticos', 1329.99, '4.jpg'),
('Impressora HP Office Jet 7110 Wide Format Eprinter 6914024', 'A melhor impressora já feita', 'Informática', 939.99, '5.jpg'),
('Smart TV LED 70” LG 4K/Ultra HD 70UJ6585 WebOS - Conversor Digital Wi-Fi 4 HDMI 2 USB Bluetooth HDR', 'A melhor TV já feita', 'Eletrônicos', 6839.99, '6.jpg'),
('Sofá 3 Lugares Aruba - American Comfort', 'O melhor sofá já feito', 'Móveis', 569.99, '7.jpg'),
('Notebook Dell Inspiron i14-7472-A30S Intel Core i7 - 16GB 1TB LCD 14” Placa de Vídeo 4GB Windows 10', 'O melhor notebook já feito', 'Informática', 4274.05, '8.jpg'),
('Microsoft Xbox One S 500 Gb', 'O melhor Xbox já feito', 'Games', 1199.00, '9.jpg'),
('Sony PS4 Playstation 4 Slim 500 Gb', 'O melhor Playstation já feito', 'Games', 1430.90, '10.jpg');

INSERT INTO usuarios
(nomeUsuario, senha, nome, sobrenome, email, notificaEmail,
   cpf, dataNasc, genero, imagem, nivel, ativo, tentaLogin, idEndereco)
VALUES
('cineasthales', '8c6cd3b74652e166638f9a672ca12171', 'Thales', 'Castro', 'thalesccastro@gmail.com', 0, '80606784004', '1989-06-24', 'Masculino', '1.jpg', 1, 1, 0, 1),
('alicem', '8c6cd3b74652e166638f9a672ca12171', 'Alice', 'Moreira', 'alicem@gmail.com', 1, '99999999999', '1991-01-01', 'Feminino', '2.jpg', 0, 1, 0, 2),
('marias', '8c6cd3b74652e166638f9a672ca12171', 'Maria', 'Silva', 'marias@gmail.com', 1, '88888888888', '1992-01-01', 'Feminino', '3.jpg', 0, 1, 0, 3),
('joaos', '8c6cd3b74652e166638f9a672ca12171', 'João', 'Santos', 'joaos@gmail.com', 1, '77777777777', '1993-01-01', 'Masculino', '4.jpg', 0, 1, 0, 4),
('pedrof', '8c6cd3b74652e166638f9a672ca12171', 'Pedro', 'Francisco', 'pedrof@gmail.com', 1, '66666666666', '1994-01-01', 'Masculino', '5.jpg', 0, 0, 0, 5),
('guilhermes', '8c6cd3b74652e166638f9a672ca12171', 'Guilherme', 'Souza', 'guilhermes@gmail.com', 1, '55555555555', '1995-01-01', 'Masculino', '6.jpg', 0, 1, 0, 6),
('juang', '8c6cd3b74652e166638f9a672ca12171', 'Juan', 'Gonzales', 'juang@gmail.com', 1, '44444444444', '1996-01-01', 'Masculino', '7.jpg', 0, 1, 0, 7),
('nataliaa', '8c6cd3b74652e166638f9a672ca12171', 'Natalia', 'Albuquerque', 'nataliaag@gmail.com', 1, '33333333333', '1997-01-01', 'Feminino', '8.jpg', 0, 1, 0, 8),
('barbaral', '8c6cd3b74652e166638f9a672ca12171', 'Barbara', 'Lacerda', 'barbaral@gmail.com', 1, '22222222222', '1998-01-01', 'Feminino', '9.jpg', 0, 1, 0, 9),
('patriciag', '8c6cd3b74652e166638f9a672ca12171', 'Patricia', 'Guimarães', 'patriciag@gmail.com', 1, '11111111111', '1999-01-01', 'Feminino', '10.jpg', 0, 1, 0, 10);

INSERT INTO telefones
(ddd, numero, idUsuario)
VALUES
('53', '32281156', 1),
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
(2, 1, 0, 0, 0, '2018-01-05'),
(2, 3, 1, 0, 0, '2018-02-05'),
(2, 4, 1, 0, 0, '2018-03-05'),
(2, 5, 1, 1, 0, '2018-04-05'),
(2, 6, 1, 0, 1, '2018-05-05'),
(2, 7, 1, 1, 1, '2018-06-05'),
(2, 8, 1, 0, 0, '2018-07-05');

INSERT INTO logUsuarios
(idUsuario, idAcaoUsuario, data, hora)
VALUES
(2, 1, '2018-01-05', '14:00'),
(2, 2, '2018-01-05', '15:00'),
(2, 1, '2018-01-05', '16:00'),
(2, 2, '2018-01-05', '17:00'),
(2, 1, '2018-01-05', '18:00'),
(2, 2, '2018-01-05', '19:00');

INSERT INTO interesses
(idUsuario, idTipoInteresse)
VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10);

INSERT INTO eventos
(titulo, descricao, data, hora, local, ativo, maxItens, dataLimite,
   idUsuario, idEndereco, idTipoEvento)
VALUES
('Aniversário de 25 anos', 'Muitas gostosuras e bebidas geladas!', '2018-06-06', '20:00', 'Casa da Alice', 1, 2, '2018-06-01', 2, 2, 1),
('Festa de Natal Família Moreira', 'Vai ser uma festa muito divertida! Venham!', '2018-12-25', '21:00', 'Casa da Alice', 1, 3, '2018-11-25', 2, 2, 6),
('Casamento da Alice com Paulo', 'Um evento marcante em nossas vidas e contamos com a presença de vocês.', '2018-11-30', '16:00', 'Igreja do Porto', 1, 4, '2018-10-30', 2, 10, 4),
('Chá de Casa Nova da Alice', 'Querem ajudar a mobiliar minha casa?', '2018-04-17', '18:00', 'Casa da Alice', 1, 2,'2018-04-10', 2, 2, 13),
('Formatura da Alice', 'Minha formatura está chegando e quero comemorar essa vitória!', '2019-01-10', '19:00', 'Theatro Guarany', 0, 3, '2019-01-10', 2, 9, 5);

INSERT INTO convidados
(idUsuario, idEvento, comparecera, compareceu, bloqueado)
VALUES
(3, 1, 0, 0, 0),
(4, 1, 1, 0, 0),
(5, 2, 1, 0, 0),
(6, 3, 1, 0, 1),
(7, 3, 0, 0, 0),
(8, 3, 1, 0, 0),
(9, 4, 1, 1, 0),
(3, 4, 1, 0, 0),
(4, 5, 1, 0, 0);

INSERT INTO listas
(idEvento, idItem, prioridade, dataAdicao, idComprador)
VALUES
(1, 1, 1, '2018-04-01', 3),
(1, 2, 2, '2018-04-02', 0),
(2, 3, 1, '2018-04-03', 0),
(3, 4, 3, '2018-04-04', 5),
(3, 5, 1, '2018-04-05', 6),
(3, 6, 2, '2018-04-06', 0),
(4, 7, 1, '2018-04-07', 9),
(5, 8, 2, '2018-04-08', 0),
(5, 9, 1, '2018-04-09', 0);

INSERT INTO logEventos
(idEvento, idUsuario, idAcaoEvento, data, hora)
VALUES
(1, 2, 1, '2018-04-01', '14:10'),
(1, 2, 2, '2018-04-02', '14:15'),
(1, 2, 3, '2018-04-03', '14:16'),
(1, 2, 4, '2018-04-04', '14:17'),
(1, 2, 5, '2018-04-05', '14:18');

INSERT INTO anuncios
(imagem, url, ativo, idEmpresa)
VALUES
('1.jpg', 'http://www.americanas.com.br/produto/1', 1, 1),
('2.jpg', 'http://www.submarino.com.br/produto/2', 0, 2),
('3.jpg', 'http://www.shoptime.com.br/produto/3', 0, 3),
('4.jpg', 'http://www.casasbahia.com.br/produto/4', 0, 4),
('5.jpg', 'http://www.saraiva.com.br/produto/5', 0, 5);

INSERT INTO cliquesAnuncios
(data, hora, idAnuncio, idUsuario)
VALUES
('2018-04-01', '14:00', 1, 2),
('2018-04-01', '14:01', 1, 2),
('2018-04-01', '14:02', 1, 2),
('2018-04-01', '14:03', 1, 2),
('2018-04-01', '14:04', 1, 2);

INSERT INTO cliquesEmpresas
(data, hora, idEmpresa, idUsuario)
VALUES
('2018-04-01', '14:11',1,2),
('2018-04-01', '14:12',1,2),
('2018-04-01', '14:13',1,2),
('2018-04-01', '14:15',1,2),
('2018-04-01', '14:15',1,2);
