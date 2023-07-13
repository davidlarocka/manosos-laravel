CREATE TABLE `tasks` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`nombre` TEXT,
	`id_usuario` INT,
	`descripcion` TEXT,
	`status` INT,
	`updated_at` DATE,
	`created_at` DATE,
	PRIMARY KEY (`id`)
);


CREATE TABLE `users` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`nombre` TEXT,
	`correo` TEXT,
	`perfil` INT(11),
	`password` TEXT,
	`updated_at` DATE,
	`created_at` DATE,
	PRIMARY KEY (`id`)
);