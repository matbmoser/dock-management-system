drop database sgm;
create database sgm;

use sgm;

CREATE TABLE sgm.`TipoCamion` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` text,
  `tcarga` int,
  `tdescarga` int,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE sgm.`Vehiculo` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `matricula` varchar(12),
  `created` datetime,
  `modified` datetime,
  `idTipoCamion` int
);

CREATE TABLE sgm.`Pedido` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pedidoid` int(6) UNIQUE,
  `inicio` datetime,
  `fin` datetime,
  `estadoPedido` ENUM ('Confirmado', 'Finalizado', 'Nuevo', 'Error', 'Cancelado'),
  `created` datetime,
  `modified` datetime,
  `idVehiculo` int
);

CREATE TABLE sgm.`Muelle` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `descripcion` text,
  `fechaCreacion` datetime
);

CREATE TABLE sgm.`Disponibilidad` (
  `idMuelle` int,
  `inicio` int COMMENT 'min 6, máx 14',
  `fin` int COMMENT 'min 6, máx 14',
  `actividad` ENUM ('CARGA', 'DESCARGA'),
  `estadosMuelle` ENUM ('DISPONIBLE', 'NODISPONIBLE'),
  `pedidoid` int(6),
  PRIMARY KEY (`inicio`, `fin`)
);

CREATE TABLE sgm.`Rol` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(50) UNIQUE,
  `backoffice_dashboard` bool,
  `backoffice_muelles` bool,
  `backoffice_pedidos` bool,
  `portal_incidencias` bool,
  `ticket_virtual` bool,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE sgm.`Usuario` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` text,
  `apellidos` text,
  `documento` text,
  `empresa` text,
  `email` varchar(320) UNIQUE,
  `password` text COMMENT 'Encriptado con SHA256',
  `fechaNacimiento` date,
  `token` text,
  `created` datetime,
  `modified` datetime,
  `idRol` int
);

CREATE TABLE sgm.`Incidencia` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(25),
  `descripcion` varchar(255),
  `gravedad` int,
  `estado` ENUM ('Resuelta', 'Pendiente', 'Denegada'),
  `created` datetime,
  `modified` datetime,
  `idUsuario` int
);

ALTER TABLE sgm.`Vehiculo` ADD FOREIGN KEY (`idTipoCamion`) REFERENCES `TipoCamion` (`id`);

ALTER TABLE sgm.`Pedido` ADD FOREIGN KEY (`idVehiculo`) REFERENCES `Usuario` (`id`);

ALTER TABLE sgm.`Disponibilidad` ADD FOREIGN KEY (`idMuelle`) REFERENCES `Muelle` (`id`);

ALTER TABLE sgm.`Disponibilidad` ADD FOREIGN KEY (`pedidoid`) REFERENCES `Pedido` (`id`);

ALTER TABLE sgm.`Usuario` ADD FOREIGN KEY (`idRol`) REFERENCES `Rol` (`id`);

ALTER TABLE sgm.`Incidencia` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`);

## Añadimos roles
INSERT INTO `sgm`.`rol`
(
`nombre`,
`backoffice_dashboard`,
`backoffice_muelles`,
`backoffice_pedidos`,
`portal_incidencias`,
`ticket_virtual`,
`created`,
`modified`)
VALUES(
'Administrador',
1,
1,
1,
1,
1,
now(),
now());

INSERT INTO `sgm`.`rol`
(
`nombre`,
`backoffice_dashboard`,
`backoffice_muelles`,
`backoffice_pedidos`,
`portal_incidencias`,
`ticket_virtual`,
`created`,
`modified`)
VALUES(
'Transportista',
0,
0,
0,
0,
1,
now(),
now());

INSERT INTO `sgm`.`rol`
(
`nombre`,
`backoffice_dashboard`,
`backoffice_muelles`,
`backoffice_pedidos`,
`portal_incidencias`,
`ticket_virtual`,
`created`,
`modified`)
VALUES(
'Personal de Gestión',
1,
1,
1,
1,
1,
now(),
now());

## Añadimos usuario Administrador
INSERT INTO `sgm`.`usuario`
        (
        `nombre`,
        `apellidos`,
        `documento`,
        `empresa`,
        `email`,
        `password`,
        `fechaNacimiento`,
        `created`,
        `modified`,
        `idRol`,
        `token`)
        VALUES (
        'Admin',
        'Manager FeedEx',
        '1212121',
        'FeedEx',
        'admin@feedex.com',
        '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225',
        '2000-09-26',
        '2022-04-26 01:41:33',
        '2022-04-26 01:41:33',
        (SELECT id FROM sgm.`rol` WHERE nombre='Administrador'),
        '12bb741d670fae614685ab152884b52d8840169d242d3be7f3d5a9f53c9a515a'
        );


## Añadimos usuario Gestor
INSERT INTO `sgm`.`usuario`
        (
        `nombre`,
        `apellidos`,
        `documento`,
        `empresa`,
        `email`,
        `password`,
        `fechaNacimiento`,
        `created`,
        `modified`,
        `idRol`,
        `token`)
        VALUES (
        'Gestor',
        'FeedEx',
        '156165154',
        'FeedEx',
        'gestor@feedex.com',
        '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225',
        '2000-09-26',
        '2022-04-26 01:41:33',
        '2022-04-26 01:41:33',
        (SELECT id FROM sgm.`rol` WHERE nombre='Personal de Gestión'),
        '12bb741d670fae614685ab152884b52d8840169d242d3be7f3d5a9f53c9a515a'
        );
        
## Añadimos usuario Transportista
INSERT INTO `sgm`.`usuario`
        (
        `nombre`,
        `apellidos`,
        `documento`,
        `empresa`,
        `email`,
        `password`,
        `fechaNacimiento`,
        `created`,
        `modified`,
        `idRol`,
        `token`)
        VALUES (
        'Transportista',
        'FeedEx',
        '451651566',
        'FeedEx',
        'transportista@feedex.com',
        '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225',
        '2000-09-26',
        '2022-04-26 01:41:33',
        '2022-04-26 01:41:33',
        (SELECT id FROM sgm.`rol` WHERE nombre='Transportista'),
        '12bb741d670fae614685ab152884b52d8840169d242d3be7f3d5a9f53c9a515a'
        );

## Añadimos los tipos de caminón

INSERT INTO `sgm`.`tipocamion`
(`nombre`,
`tcarga`,
`tdescarga`,
`created`,
`modified`)
VALUES(
'Furgoneta',
20,
15,
now(),
now());

INSERT INTO `sgm`.`tipocamion`
(`nombre`,
`tcarga`,
`tdescarga`,
`created`,
`modified`)
VALUES(
'Lona',
40,
30,
now(),
now());

INSERT INTO `sgm`.`tipocamion`
(`nombre`,
`tcarga`,
`tdescarga`,
`created`,
`modified`)
VALUES(
'Trailer',
60,
45,
now(),
now());

