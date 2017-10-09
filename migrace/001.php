<?php

$sql = <<<SQL

CREATE TABLE `uzivatel` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `mail` varchar(200) NOT NULL,
  `pohlavi` char(1) NOT NULL COMMENT 'm/f',
  `prihlaska` text NOT NULL COMMENT 'json'
);

ALTER TABLE `uzivatel`
ADD UNIQUE `mail` (`mail`);

CREATE TABLE `aktivita` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nazev` varchar(200) NOT NULL,
  `zacatek` timestamp NOT NULL DEFAULT 0,
  `konec` timestamp NOT NULL DEFAULT 0,
  `kapacita_m` int NOT NULL,
  `kapacita_f` int NOT NULL,
  `kapacita_u` int NOT NULL,
  `cena` int NOT NULL,
  `autor` varchar(200) NOT NULL,
  `doplnek` varchar(400) NOT NULL,
  `larpdb` varchar(400),
  `popis` text NOT NULL
);

CREATE TABLE `prihlasen` (
  `aktivita_id` int(11) NOT NULL,
  `uzivatel_id` int(11) NOT NULL,
  FOREIGN KEY (`aktivita_id`) REFERENCES `aktivita` (`id`),
  FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`)
);

ALTER TABLE `prihlasen`
ADD PRIMARY KEY `aktivita_id_uzivatel_id` (`aktivita_id`, `uzivatel_id`),
DROP INDEX `aktivita_id`;

CREATE TABLE `prihlasen_log` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) NOT NULL,
  `aktivita_id` int(11) NOT NULL,
  `uzivatel_id` int(11) NOT NULL,
  `operace` char(1) NOT NULL COMMENT 'p - přihlášení, o - odhlášení',
  FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`),
  FOREIGN KEY (`aktivita_id`) REFERENCES `aktivita` (`id`)
);

CREATE TABLE `organizuje` (
  `aktivita_id` int(11) NOT NULL,
  `uzivatel_id` int(11) NOT NULL,
  FOREIGN KEY (`aktivita_id`) REFERENCES `aktivita` (`id`),
  FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`)
);

SQL;
