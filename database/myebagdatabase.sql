CREATE DATABASE myebag;
USE myebag;

CREATE TABLE `user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`username` VARCHAR(50),
	`email` VARCHAR(40),
	`password` VARCHAR(25),
	`telephone` varchar(15),
	`user_jwt` VARCHAR(100),
	`user_type` INT,
	`last_login` DATETIME,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	`deleted_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_type` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_type` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_adress` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`adress_line1` TEXT(50),
	`adress_line2` TEXT(50),
	`city` varchar(50),
	`postal_code` varchar(50),
	`country` varchar(50),
	`telephone` varchar(15),
	`mobile` varchar(15),
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_payment` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`payment_type` varchar(50),
	`provider` varchar(50),
	`account_no` INT,
	`expiry` DATE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product_category` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(55),
	`desc` TEXT(300),
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	`deleted_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product_invetory` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`quantity` INT,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	`deleted_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50),
	`desc` TEXT(300),
	`SKU` varchar(100),
	`category_id` INT,
	`invetory_id` INT,
	`price` DECIMAL,
	`discount_id` INT DEFAULT NULL,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	`deleted_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `discount` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(55),
	`desc` TEXT(300),
	`discount_percent` DECIMAL,
	`active` BOOLEAN DEFAULT FALSE,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	`deleted_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cart_items` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`product_id` INT,
	`quantity` INT,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `payment_details` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`order_id` INT,
	`amount` INT,
	`provider` varchar(55),
	`status` varchar(55),
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_details` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`total` DECIMAL,
	`payment_id` INT,
	`created_at` DATETIME,
	`modified_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_items` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`order_id` INT,
	`product_id` INT,
	`quantity` INT,
	`created_at` DATETIME ,
	`modified_at` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `user` ADD CONSTRAINT `user_fk0` FOREIGN KEY (`user_type`) REFERENCES `user_type`(`id`);

ALTER TABLE `user_adress` ADD CONSTRAINT `user_adress_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `user_payment` ADD CONSTRAINT `user_payment_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `product` ADD CONSTRAINT `product_fk0` FOREIGN KEY (`category_id`) REFERENCES `product_category`(`id`);

ALTER TABLE `product` ADD CONSTRAINT `product_fk1` FOREIGN KEY (`invetory_id`) REFERENCES `product_invetory`(`id`);

ALTER TABLE `product` ADD CONSTRAINT `product_fk2` FOREIGN KEY (`discount_id`) REFERENCES `discount`(`id`);

ALTER TABLE `cart_items` ADD CONSTRAINT `cart_items_fk0` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

ALTER TABLE `order_details` ADD CONSTRAINT `order_details_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `order_details` ADD CONSTRAINT `order_details_fk1` FOREIGN KEY (`payment_id`) REFERENCES `payment_details`(`id`);

ALTER TABLE `order_items` ADD CONSTRAINT `order_items_fk0` FOREIGN KEY (`order_id`) REFERENCES `order_details`(`id`);

ALTER TABLE `order_items` ADD CONSTRAINT `order_items_fk1` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);













