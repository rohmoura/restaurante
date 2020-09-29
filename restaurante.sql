-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 23-Out-2017 às 18:49
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `idade` int(3) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `cep` varchar(50) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `idade`, `telefone`, `cidade`, `cep`) VALUES
(1, 'Pai Azsdf', 35, '99999999', 'Alvorada', '91503401');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregador`
--

DROP TABLE IF EXISTS `entregador`;
CREATE TABLE IF NOT EXISTS `entregador` (
  `idEntregador` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `idade` int(3) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `moto` varchar(50) NOT NULL,
  PRIMARY KEY (`idEntregador`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `entregador`
--

INSERT INTO `entregador` (`idEntregador`, `nome`, `idade`, `telefone`, `cidade`, `moto`) VALUES
(1, 'Ny', 40, '999999999', 'Alvorada', 'Hornet');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `tipo`) VALUES
(1, 'administrador', '675a05bb50c01f3d7e1b5e1cd969af81', ''),
(2, 'administrador', '675a05bb50c01f3d7e1b5e1cd969af81', ''),
(3, 'administrador', '675a05bb50c01f3d7e1b5e1cd969af81', ''),
(4, 'administrador', '675a05bb50c01f3d7e1b5e1cd969af81', ''),
(5, 'administrador', '675a05bb50c01f3d7e1b5e1cd969af81', ''),
(6, 'rod', '81dc9bdb52d04dc20036dbd8313ed055', 'adm'),
(7, 'rod', '81dc9bdb52d04dc20036dbd8313ed055', 'adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xis`
--

DROP TABLE IF EXISTS `xis`;
CREATE TABLE IF NOT EXISTS `xis` (
  `idXis` bigint(20) NOT NULL AUTO_INCREMENT,
  `sabor` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `adicional` varchar(50) NOT NULL,
  `salada` varchar(50) NOT NULL,
  PRIMARY KEY (`idXis`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `xis`
--

INSERT INTO `xis` (`idXis`, `sabor`, `valor`, `tamanho`, `adicional`, `salada`) VALUES
(1, 'Hamburguer', 40, 'MÃ©dio', 'Batata frita', 'Tomate');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
