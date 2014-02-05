-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2014 at 08:59 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
(1, 'Plantas', 'Plantas sao do reina plantatis, servem pra comer'),
(2, 'Comida', 'serve pra matar fome'),
(3, 'Mato', 'Do tipo gramideo ruim, verde serve pra boi comer'),
(4, 'Info', 'gasta energia e tem partes eletronicas mano'),
(6, 'Frutas', 'comida natural mano');

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
(2, 'carnivora', 'que come carne, esse sabe o que eh bom'),
(3, 'herbivora', 'come tudo que eh verde, ruim demais'),
(4, 'onivoro', 'come a porra toda'),
(5, 'verde', 'produto que eh da cor verde');

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

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `qntComprada` int(11) NOT NULL,
  `valor` float NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`idCompra`),
  KEY `idPedido_idx` (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `valorTotal` float NOT NULL,
  `validacao` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`idProduto`, `nome`, `preco`, `validade`, `unidade`, `disponibilidade`, `descricao`, `idCategoria`, `foto`) VALUES
(6, 'Hamburguer', 11, 'nao tem', 'nao tem', 1, 'burgao gostoso demais da conta so', 2, 'ico-lanches1.jpg'),
(7, 'Computador', 2000, 'nao tem', 'nao tem', 1, 'Pc Dell Mano', 4, 'pcdell2.jpg'),
(8, 'Caixas', 200, 'nao tem', '1kg cada', 1, 'serve rpa estocar altas parafenais', 3, 'caixas1.png'),
(9, 'Carrinho', 23, '5 anos', 'nao tem', 1, 'carrinho de compra', 4, 'produtos-icon1.png'),
(10, 'Alface', 0.75, '7 dias', 'treco', 1, 'treco verde de comer com azeite e sal.', 3, 'produtos-icon2.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `propriedade`
--

INSERT INTO `propriedade` (`idPropriedade`, `nome`, `endereco`, `tamanho`, `idProsumidor`) VALUES
(1, 'Chacra do Zan', 'Arataquinha da Serra', '2200km', 2),
(3, 'Tibia', 'Ank', '20000cubinhos', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `prosumidor`
--

INSERT INTO `prosumidor` (`idProsumidor`, `email`, `senha`, `nome`, `cpf`, `telefone`, `endereco`, `sexo`, `status`, `tipo`, `saldoConsumidor`) VALUES
(1, 'guilherme.raminho@gmail.com', 'f79358f48201e819d483c111a21c8d0d', 'Guilherme Raminho', '099.845.046-46', '(31)9999-9999', 'Rua: 2 n:3 B:Norte', 'Masculino', 1, 2, 0),
(2, 'zangetsu@bleach.com', 'f79358f48201e819d483c111a21c8d0d', 'Zangetsu', '09984504646', '(31)8888-8888', 'Rua: 7 n:7 B:Seven', 'Masculino', 1, 2, 0),
(3, 'teste@teste.com', 'f5d1278e8109edd94e1e4197e04873b9', 'Teste', '567.567.567-89', '(31)9090-9090', 'R:4, n:8, B;bis', 'Masculino', 1, 1, -23.23),
(4, 'leo@leo.com', 'fe764ea41443c5f9d56627de190d2273', 'Leo Coelho', '123.000.789-77', '(31)8888-7777', 'Rua: 6 n:6 B:Six', 'Masculino', 1, 2, 0),
(5, 'luan.noe@gmail.com', 'f79358f48201e819d483c111a21c8d0d', 'Luan Noe', '09876543211', '(31)9999-3434', 'Aquela rua ali', 'Masculino', 1, 2, 0);

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
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `propriedade`
--
ALTER TABLE `propriedade`
  ADD CONSTRAINT `idProsumidor` FOREIGN KEY (`idProsumidor`) REFERENCES `prosumidor` (`idProsumidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
