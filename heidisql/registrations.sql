CREATE TABLE `registrations` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`salon_id` INT(10) NOT NULL,
	`first_name` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	`last_name` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	`animal_name` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	`email` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	`date` DATE NOT NULL,
	`time` TIME NOT NULL,
	`service` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `Registration_salon` (`salon_id`) USING BTREE,
	CONSTRAINT `Registration_salon` FOREIGN KEY (`salon_id`) REFERENCES `paws_and_pals`.`salon_data` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=32
;
