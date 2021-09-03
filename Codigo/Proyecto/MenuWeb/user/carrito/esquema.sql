CREATE TABLE `propiedades` (
  `idpropiedades` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `categoriaId` int DEFAULT NULL,
  `clienteId` int DEFAULT NULL,
  PRIMARY KEY (`idpropiedades`),
  KEY `categoriaId_idx` (`categoriaId`),
  KEY `clienteId_idx` (`clienteId`),
  CONSTRAINT `categoriaId` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`idcategoria`),
  CONSTRAINT `clienteId` FOREIGN KEY (`clienteId`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `carritoc` (
  `idsesion` varchar(255) NOT NULL,
  `idPropiedades` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  KEY `idPropiedades_idx` (`idPropiedades`),
  CONSTRAINT `idPropiedades` FOREIGN KEY (`idPropiedades`) REFERENCES `propiedades` (`idpropiedades`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;