-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-11-2012 a las 10:38:11
-- Versión del servidor: 5.1.50
-- Versión de PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `idcity` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcity`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coders`
--

CREATE TABLE IF NOT EXISTS `coders` (
  `idcoder` int(11) NOT NULL AUTO_INCREMENT,
  `coder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcoder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `idlanguage` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idlanguage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `idpet` int(11) NOT NULL AUTO_INCREMENT,
  `pet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idpet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coders` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cities_idcity` int(11) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_cities_idx` (`cities_idcity`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_has_languages`
--

CREATE TABLE IF NOT EXISTS `users_has_languages` (
  `users_iduser` int(11) NOT NULL,
  `languages_idlanguage` int(11) NOT NULL,
  PRIMARY KEY (`users_iduser`,`languages_idlanguage`),
  KEY `fk_users_has_languages_languages1_idx` (`languages_idlanguage`),
  KEY `fk_users_has_languages_users1_idx` (`users_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_has_pets`
--

CREATE TABLE IF NOT EXISTS `users_has_pets` (
  `users_iduser` int(11) NOT NULL,
  `pets_idpet` int(11) NOT NULL,
  PRIMARY KEY (`users_iduser`,`pets_idpet`),
  KEY `fk_users_has_pets_pets1_idx` (`pets_idpet`),
  KEY `fk_users_has_pets_users1_idx` (`users_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_cities` FOREIGN KEY (`cities_idcity`) REFERENCES `cities` (`idcity`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users_has_languages`
--
ALTER TABLE `users_has_languages`
  ADD CONSTRAINT `fk_users_has_languages_users1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_languages_languages1` FOREIGN KEY (`languages_idlanguage`) REFERENCES `languages` (`idlanguage`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users_has_pets`
--
ALTER TABLE `users_has_pets`
  ADD CONSTRAINT `fk_users_has_pets_users1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_pets_pets1` FOREIGN KEY (`pets_idpet`) REFERENCES `pets` (`idpet`) ON DELETE NO ACTION ON UPDATE NO ACTION;
