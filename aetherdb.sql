/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : aetherdb

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-02-02 04:32:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for c_productos
-- ----------------------------
DROP TABLE IF EXISTS `c_productos`;
CREATE TABLE `c_productos` (
  `id_datos_productos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clave_producto` varchar(255) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `precio_producto` double(11,5) NOT NULL,
  `datos_producto` varchar(255) NOT NULL,
  `imagen_producto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_datos_productos`),
  KEY `clave_producto` (`clave_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_productos
-- ----------------------------
INSERT INTO `c_productos` VALUES ('1', '4564', 'Pioner HD200', '6000.00000', 'Audifonos Dj de Alta Fidelidad', null);
INSERT INTO `c_productos` VALUES ('2', '9999', 'Shure 353', '9000.00000', 'Los mejores audifonos de gama bja', null);
INSERT INTO `c_productos` VALUES ('3', '9999', 'Tracktor Pro', '5000.00000', 'Tu Estudio virtual', null);
INSERT INTO `c_productos` VALUES ('4', '2344', 'Reason', '8000.00000', 'LA mejor herramienta del dj', null);
INSERT INTO `c_productos` VALUES ('5', '2344', 'praxis', '9000.00000', 'Lo mejor en audio', null);
INSERT INTO `c_productos` VALUES ('6', '345', 'Senheiser 456', '8000.00000', 'Un producto altamente eficiente', null);
INSERT INTO `c_productos` VALUES ('7', '2222', 'shure', '9000.00000', 'Un buen producto', null);

-- ----------------------------
-- Table structure for m_productos
-- ----------------------------
DROP TABLE IF EXISTS `m_productos`;
CREATE TABLE `m_productos` (
  `id_producto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clave_producto` varchar(255) NOT NULL,
  `id_tienda` int(11) unsigned NOT NULL,
  `existencias` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_tienda` (`id_tienda`),
  KEY `clave_producto` (`clave_producto`),
  CONSTRAINT `clave_producto` FOREIGN KEY (`clave_producto`) REFERENCES `c_productos` (`clave_producto`),
  CONSTRAINT `id_tienda` FOREIGN KEY (`id_tienda`) REFERENCES `m_tiendas` (`id_tienda`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_productos
-- ----------------------------
INSERT INTO `m_productos` VALUES ('3', '4564', '2', '10');
INSERT INTO `m_productos` VALUES ('4', '4564', '3', '90');
INSERT INTO `m_productos` VALUES ('5', '4564', '1', '80');
INSERT INTO `m_productos` VALUES ('6', '2344', '3', '90');
INSERT INTO `m_productos` VALUES ('7', '2344', '3', '90');
INSERT INTO `m_productos` VALUES ('8', '345', '2', '84');
INSERT INTO `m_productos` VALUES ('9', '2222', '2', '50000');

-- ----------------------------
-- Table structure for m_tiendas
-- ----------------------------
DROP TABLE IF EXISTS `m_tiendas`;
CREATE TABLE `m_tiendas` (
  `id_tienda` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tienda` varchar(255) NOT NULL,
  `ubicacion_tienda` varchar(255) DEFAULT NULL,
  `telefono_tienda` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `numero_de _empleados` int(11) NOT NULL,
  `matriz` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tienda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_tiendas
-- ----------------------------
INSERT INTO `m_tiendas` VALUES ('1', 'Kilo Store San Angel', 'Direccion San angel, 46, col dada', '5540747228', '5', 'NO');
INSERT INTO `m_tiendas` VALUES ('2', 'Kilo Store Polanco', 'Polanco #56 col. la polanquita', '57327331', '5', 'SI');
INSERT INTO `m_tiendas` VALUES ('3', 'Kilo Store Condesa', 'Condesa #67 col. Hipodromo', '5540744228', '19', 'NO');

-- ----------------------------
-- Table structure for m_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `m_usuarios`;
CREATE TABLE `m_usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `a_paterno` varchar(45) DEFAULT NULL,
  `a_materno` varchar(45) DEFAULT NULL,
  `e_mail` varchar(45) DEFAULT NULL,
  `id_tienda` int(11) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_tienda` (`id_tienda`),
  CONSTRAINT `usuario_tienda` FOREIGN KEY (`id_tienda`) REFERENCES `m_tiendas` (`id_tienda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_usuarios
-- ----------------------------
INSERT INTO `m_usuarios` VALUES ('1', 'josue', 'martinez', 'torres', 'josamato@outlook.com', '3', 'password');
INSERT INTO `m_usuarios` VALUES ('2', 'Alvaro', 'Mortadela', 'Rigoris', 'alava@al.com', '2', 'password');

-- ----------------------------
-- Table structure for m_ventas
-- ----------------------------
DROP TABLE IF EXISTS `m_ventas`;
CREATE TABLE `m_ventas` (
  `id_venta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) unsigned NOT NULL,
  `id_producto` int(11) unsigned NOT NULL,
  `cantidad` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `vendedores` (`id_usuario`),
  KEY `producto_venta` (`id_producto`),
  CONSTRAINT `producto_venta` FOREIGN KEY (`id_producto`) REFERENCES `m_productos` (`id_producto`),
  CONSTRAINT `vendedores` FOREIGN KEY (`id_usuario`) REFERENCES `m_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_ventas
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
