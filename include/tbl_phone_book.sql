CREATE TABLE `tbl_phone_book`(
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `number` VARCHAR(255) NOT NULL,
  `created` DATE NOT NULL,
  `updated` DATETIME NOT NULL,
  PRIMARY KEY(`id`, `number`)
) ENGINE = InnoDB;

ALTER TABLE `tbl_phone_book` ADD `id` INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_phone_book` ADD `number` VARCHAR(100) NOT NULL AFTER `lastname`, ADD UNIQUE `Unique` (`number`);