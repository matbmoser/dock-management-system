drop database sgm;
create database sgm;

use sgm;

CREATE TABLE `Periodo` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `horario` varchar(12) UNIQUE,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE `TipoCamion` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` text,
  `tcarga` int,
  `tdescarga` int,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE `Vehiculo` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `matricula` varchar(12),
  `created` datetime,
  `modified` datetime,
  `idTipoCamion` int,
  `idUsuario` int
);

CREATE TABLE `Pedido` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pedidoid` varchar(6) UNIQUE,
  `actividad` text,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE `PedidoUsuario` (
  `idPedido` varchar(6) PRIMARY KEY,
  `idUsuario` int
);

CREATE TABLE `Muelle` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `idTipoCamion` int,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE `Reserva` (
  `idMuelle` int,
  `idPeriodo` int,
  `actividad` ENUM ('CARGA', 'DESCARGA', 'NO DISPONIBLE'),
  `idUsuario` int,
  `matricula` text,
  `created` datetime,
  `modified` datetime,
  PRIMARY KEY (`idPeriodo`, `idMuelle`)
);

CREATE TABLE `Rol` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` text,
  `backoffice_dashboard` bool,
  `backoffice_muelles` bool,
  `backoffice_pedidos` bool,
  `portal_incidencias` bool,
  `ticket_virtual` bool,
  `created` datetime,
  `modified` datetime
);

CREATE TABLE `Usuario` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` text,
  `apellidos` text,
  `documento` text,
  `empresa` text,
  `email` text,
  `token` varchar(64) unique,
  `password` text COMMENT 'Encriptado con SHA256',
  `fechaNacimiento` date,
  `created` datetime,
  `modified` datetime,
  `idRol` int
);

CREATE TABLE `Incidencia` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(25),
  `descripcion` varchar(255),
  `gravedad` int,
  `estado` ENUM ('Resuelta', 'Pendiente', 'Denegada'),
  `created` datetime,
  `modified` datetime,
  `idUsuario` int
);

ALTER TABLE `Vehiculo` ADD FOREIGN KEY (`idTipoCamion`) REFERENCES `TipoCamion` (`id`);

ALTER TABLE `Vehiculo` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`);

ALTER TABLE `PedidoUsuario` ADD FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`pedidoid`);

ALTER TABLE `PedidoUsuario` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`);

ALTER TABLE `Muelle` ADD FOREIGN KEY (`idTipoCamion`) REFERENCES `TipoCamion` (`id`);

ALTER TABLE `Reserva` ADD FOREIGN KEY (`idMuelle`) REFERENCES `Muelle` (`id`);

ALTER TABLE `Reserva` ADD FOREIGN KEY (`idPeriodo`) REFERENCES `Periodo` (`id`);

ALTER TABLE `Reserva` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`);

ALTER TABLE `Usuario` ADD FOREIGN KEY (`idRol`) REFERENCES `Rol` (`id`);

ALTER TABLE `Incidencia` ADD FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`);


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
0,
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
0,
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
        '35520dbb8d09f7cce04be8e1c7cf502f856b0452cd1cea93bfaf9ecdf0488ad8'
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
        '04ce4e0df68bd9eb3396db368aeaf811d254a15423069617ab72650d098d3260'
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

## Insertamos muelles
INSERT INTO `sgm`.`muelle`
(`idTipoCamion`,
`created`,
`modified`)
VALUES (
(SELECT id FROM sgm.TipoCamion WHERE nombre="Lona"),
now(),
now());

INSERT INTO `sgm`.`muelle`
(`idTipoCamion`,
`created`,
`modified`)
VALUES (
(SELECT id FROM sgm.TipoCamion WHERE nombre="Furgoneta"),
now(),
now());

INSERT INTO `sgm`.`muelle`
(`idTipoCamion`,
`created`,
`modified`)
VALUES (
(SELECT id FROM sgm.TipoCamion WHERE nombre="Trailer"),
now(),
now());

INSERT INTO `sgm`.`muelle`
(`idTipoCamion`,
`created`,
`modified`)
VALUES (
(SELECT id FROM sgm.TipoCamion WHERE nombre="Lona"),
now(),
now());

INSERT INTO `sgm`.`muelle`
(`idTipoCamion`,
`created`,
`modified`)
VALUES (
(SELECT id FROM sgm.TipoCamion WHERE nombre="Trailer"),
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('6:00-7:00',
now(),
now());
INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('7:00-8:00',
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('8:00-9:00',
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('9:00-10:00',
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('10:00-11:00',
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('11:00-12:00',
now(),
now());

INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('12:00-13:00',
now(),
now());
INSERT INTO `sgm`.`periodo`
(`horario`,
`created`,
`modified`)
VALUES
('13:00-14:00',
now(),
now());

INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
1,
'DESCARGA',
now(),
now());

INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
2,
'DESCARGA',
now(),
now());

INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
3,
'DESCARGA',
now(),
now());
INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
4,
'DESCARGA',
now(),
now());

INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
5,
'DESCARGA',
now(),
now());

INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
6,
'DESCARGA',
now(),
now());
INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
7,
'DESCARGA',
now(),
now());
INSERT INTO `sgm`.`reserva`
(`idMuelle`,
`idPeriodo`,
`idUsuario`,
`matricula`,
`actividad`,
`created`,
`modified`)
VALUES
(1,
8,
3, 
'LDGS-123',
'DESCARGA',
now(),
now());

INSERT INTO sgm.pedido ( id, pedidoid, actividad, created, modified )VALUES( '50', '412416', 'CARGA ', '2022-04-26 19:22:31', '2022-04-26 19:22:31');
