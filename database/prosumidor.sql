-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2014 at 03:21 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prosumidor`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `email`, `senha`, `nome`) VALUES
(1, 'zangetsu@bleach.com', 'f79358f48201e819d483c111a21c8d0d', 'Zangetsu Mustang'),
(6, 'guilherme.raminho@gmail.com', 'f79358f48201e819d483c111a21c8d0d', 'Guilherme O Raminho'),
(10, 'teste@teste.com', 'f5d1278e8109edd94e1e4197e04873b9', 'Teste');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`, `descricao`) VALUES
(1, 'Sem  Glútem', 'Forevis aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Copo furadis é disculpa de babadis, arcu quam euismod magna, bibendum egestas augue arcu ut est. Etiam ultricies tincidunt ligula, sed accumsan sapien mollis et.'),
(2, 'Hortifruti', 'Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
(3, 'Congelados', 'Paisis, filhis, espiritis santis. Mé faiz elementum girarzis. Pellentesque viverra accumsan ipsum elementum gravidis.'),
(4, 'Diversos', 'Cevadis im ampola pa arma uma pindureta. Nam varius eleifend orci, sed viverra nisl condimentum ut. Donec eget justis enim. Atirei o pau no gatis. Viva Forevis aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(6, 'Padaria', 'Copo furadis é disculpa de babadis, arcu quam euismod magna, bibendum egestas augue arcu ut est. Delegadis gente finis. In sit amet mattis porris, paradis.');

-- --------------------------------------------------------

--
-- Table structure for table `classificacao`
--

CREATE TABLE IF NOT EXISTS `classificacao` (
  `idClassificacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  PRIMARY KEY (`idClassificacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `classificacao`
--

INSERT INTO `classificacao` (`idClassificacao`, `nome`, `descricao`) VALUES
(2, 'Agroecológico', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.'),
(3, 'Solidário', 'Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi.'),
(4, 'Orgânico', 'Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.'),
(5, 'Familiar', 'Casamentiss faiz malandris se pirulitá, Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer Ispecialista im mé intende tudis nuam golada, vinho, uiski, carirí, rum da jamaikis, só num pode ser mijis.');

-- --------------------------------------------------------

--
-- Table structure for table `classproduto`
--

CREATE TABLE IF NOT EXISTS `classproduto` (
  `idProduto` int(11) NOT NULL,
  `idClassificacao` int(11) NOT NULL,
  KEY `idProduto_idx` (`idProduto`),
  KEY `idClassificacao_idx` (`idClassificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classproduto`
--

INSERT INTO `classproduto` (`idProduto`, `idClassificacao`) VALUES
(10, 5),
(10, 4),
(11, 2),
(11, 4),
(12, 2),
(12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `qtdComprada` int(11) NOT NULL,
  `valor` float NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`idCompra`),
  KEY `idPedido_idx` (`idPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`idCompra`, `qtdComprada`, `valor`, `idProduto`, `idPedido`) VALUES
(1, 2, 4000, 7, 1),
(2, 7, 161, 9, 1),
(3, 20, 15, 10, 2),
(4, 2, 22, 6, 2),
(11, 2, 46, 9, 4),
(12, 3, 6000, 7, 5),
(13, 20, 4000, 8, 5),
(14, 2, 400, 8, 4),
(15, 1, 2000, 7, 6),
(16, 3, 33, 6, 6),
(17, 10, 110, 6, 8),
(18, 3, 69, 9, 8),
(19, 6, 4.5, 10, 10),
(20, 1, 2000, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `valorTotal` float NOT NULL,
  `validacao` int(11) NOT NULL,
  `data` date NOT NULL,
  `idProsumidor` int(10) NOT NULL,
  `nomeVoluntario` varchar(100) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `idProsumidor_idx` (`idProsumidor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`idPedido`, `valorTotal`, `validacao`, `data`, `idProsumidor`, `nomeVoluntario`) VALUES
(1, 4161, 2, '2014-02-08', 2, 'Guilherme'),
(2, 37, 2, '2014-02-09', 2, 'Guilherme'),
(4, 446, 2, '2014-02-08', 3, 'Guilherme'),
(5, 10000, 2, '2014-01-15', 2, 'Guilherme'),
(6, 2033, 2, '2013-12-15', 3, 'Guilherme'),
(8, 179, 2, '2014-02-10', 2, 'Guilherme'),
(9, 0, 0, '2014-02-11', 2, '0'),
(10, 4.5, 1, '2014-02-11', 3, '0'),
(11, 2000, 2, '2014-02-11', 6, 'Guilherme');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `preco` float NOT NULL,
  `validade` varchar(45) NOT NULL,
  `unidade` varchar(45) NOT NULL,
  `disponibilidade` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `idCategoria_idx` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`idProduto`, `nome`, `preco`, `validade`, `unidade`, `disponibilidade`, `descricao`, `idCategoria`, `foto`) VALUES
(6, 'Hamburguer', 11, 'nao tem', 'nao tem', 1, 'burgao gostoso demais da conta so', 6, 'ico-lanches1.jpg'),
(7, 'Computador', 2000, 'nao tem', 'nao tem', 1, 'Pc Dell Mano', 4, 'pcdell2.jpg'),
(8, 'Caixas', 200, 'nao tem', '1kg cada', 1, 'serve rpa estocar altas parafernalhias', 4, 'caixas1.png'),
(9, 'Carrinho', 23, '5 anos', 'nao tem', 1, 'carrinho de compra', 4, 'produtos-icon1.png'),
(10, 'Alface', 0.75, '7 dias', 'Pé', 1, 'treco verde de comer com azeite e sal.', 2, 'vg_alface-50x50.png'),
(11, 'Banana', 10, '7 dias', 'Cacho', 1, 'O Jugurta vende!', 2, 'banana.png'),
(12, 'Zangetsu', 23, 'nao tem', 'isso ai', 1, 'asdasdasdasd', 1, 'produtos-icon3.png');

-- --------------------------------------------------------

--
-- Table structure for table `propriedade`
--

CREATE TABLE IF NOT EXISTS `propriedade` (
  `idPropriedade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `tamanho` varchar(45) DEFAULT NULL,
  `idProsumidor` int(11) NOT NULL,
  PRIMARY KEY (`idPropriedade`),
  KEY `idProsumidor_idx` (`idProsumidor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `propriedade`
--

INSERT INTO `propriedade` (`idPropriedade`, `nome`, `endereco`, `tamanho`, `idProsumidor`) VALUES
(1, 'Chacra do Zan', 'Arataquinha da Serra', '2200km', 2),
(3, 'Tibia', 'Ank', '20000cubinhos', 1),
(4, 'Fazenda Sul', 'Lá Longe', '10000Hectar', 6);

-- --------------------------------------------------------

--
-- Table structure for table `prosumidor`
--

CREATE TABLE IF NOT EXISTS `prosumidor` (
  `idProsumidor` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `saldoConsumidor` float NOT NULL,
  PRIMARY KEY (`idProsumidor`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `prosumidor`
--

INSERT INTO `prosumidor` (`idProsumidor`, `email`, `senha`, `nome`, `cpf`, `telefone`, `endereco`, `sexo`, `status`, `tipo`, `saldoConsumidor`) VALUES
(1, 'guilherme.raminho@gmail.com', 'f79358f48201e819d483c111a21c8d0d', 'Guilherme Raminho', '099.845.046-46', '(31)9999-9999', 'Rua: 2 n:3 B:Norte', 'Masculino', 2, 2, 0),
(2, 'zangetsu@bleach.com', 'f79358f48201e819d483c111a21c8d0d', 'Zangetsu', '09984504646', '(31)8888-8888', 'Rua: 7 n:7 B:Seven', 'Masculino', 1, 2, 0),
(3, 'teste@teste.com', 'f5d1278e8109edd94e1e4197e04873b9', 'Teste', '567.567.567-89', '(31)9090-9090', 'R:4, n:8, B;bis', 'Masculino', 2, 1, 4.5),
(4, 'leo@leo.com', 'fe764ea41443c5f9d56627de190d2273', 'Leo Coelho', '123.000.789-77', '(31)8888-7777', 'Rua: 6 n:6 B:Six', 'Masculino', 1, 2, 0),
(5, 'luan.noe@gmail.com', 'f79358f48201e819d483c111a21c8d0d', 'Luan Noe', '09876543211', '(31)9999-3434', 'Aquela rua ali', 'Masculino', 1, 2, 0),
(6, 'jugurta@ufv.br', 'f79358f48201e819d483c111a21c8d0d', 'Jugurta', '123.123.123-90', '(31)8888-8888', 'Rua: PH rol', 'Masculino', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transacao`
--

CREATE TABLE IF NOT EXISTS `transacao` (
  `idTransacao` int(11) NOT NULL AUTO_INCREMENT,
  `valorTotalRecebido` float NOT NULL,
  `validacao` int(11) NOT NULL,
  `data` date NOT NULL,
  `idProsumidor` int(11) NOT NULL,
  `nomeVoluntario` varchar(100) NOT NULL,
  PRIMARY KEY (`idTransacao`),
  KEY `idProsumidor_idx` (`idProsumidor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transacao`
--

INSERT INTO `transacao` (`idTransacao`, `valorTotalRecebido`, `validacao`, `data`, `idProsumidor`, `nomeVoluntario`) VALUES
(1, 29.5, 2, '2014-02-08', 2, 'Guilherme'),
(2, 1600, 2, '2014-02-09', 2, 'Teste'),
(3, 230, 2, '2014-02-11', 2, 'João'),
(4, 100, 2, '2014-02-11', 6, 'Computador');

-- --------------------------------------------------------

--
-- Table structure for table `venda`
--

CREATE TABLE IF NOT EXISTS `venda` (
  `idVenda` int(11) NOT NULL AUTO_INCREMENT,
  `qtdDisponivel` int(11) NOT NULL,
  `qtdVendida` int(11) NOT NULL,
  `valorRecebido` float NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idTransacao` int(11) NOT NULL,
  PRIMARY KEY (`idVenda`),
  KEY `idProdut_idx` (`idProduto`),
  KEY `idTransacao_idx` (`idTransacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `venda`
--

INSERT INTO `venda` (`idVenda`, `qtdDisponivel`, `qtdVendida`, `valorRecebido`, `idProduto`, `idTransacao`) VALUES
(7, 19, 10, 7.5, 10, 1),
(8, 2, 2, 22, 6, 1),
(9, 15, 8, 1600, 8, 2),
(10, 2, 1, 200, 8, 3),
(11, 3, 3, 30, 11, 3),
(12, 10, 10, 100, 11, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classproduto`
--
ALTER TABLE `classproduto`
  ADD CONSTRAINT `idClassificacao` FOREIGN KEY (`idClassificacao`) REFERENCES `classificacao` (`idClassificacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProduto` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `idPedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `idProsumido` FOREIGN KEY (`idProsumidor`) REFERENCES `prosumidor` (`idProsumidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `propriedade`
--
ALTER TABLE `propriedade`
  ADD CONSTRAINT `idProsumidor` FOREIGN KEY (`idProsumidor`) REFERENCES `prosumidor` (`idProsumidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `idProsumid` FOREIGN KEY (`idProsumidor`) REFERENCES `prosumidor` (`idProsumidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `idProdut` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTransacao` FOREIGN KEY (`idTransacao`) REFERENCES `transacao` (`idTransacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
