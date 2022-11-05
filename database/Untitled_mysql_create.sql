CREATE DATABASE myebag;




CREATE TABLE `user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`user_name` VARCHAR(50) NOT NULL,
	`email` VARCHAR(40) NOT NULL,
	`password` VARCHAR(25) NOT NULL,
	`telephone` varchar(15),
	`user_jwt` VARCHAR(100) NOT NULL,
	`user_type` INT NOT NULL,
	`last_login` DATETIME NOT NULL,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME,
	`deleted_at` DATETIME,
	PRIMARY KEY (`id`)
	
);

CREATE TABLE `user_type` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_type` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`id`),
	check user_type='admin'OR user_type='user'
);

CREATE TABLE `user_adress` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`adress_line1` TEXT(50) NOT NULL,
	`adress_line2` TEXT(50) NOT NULL,
	`city` varchar(50) NOT NULL,
	`postal_code` varchar(50) NOT NULL,
	`country` varchar(50) NOT NULL,
	`telephone` varchar(15) NOT NULL,
	`mobile` varchar(15) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_payment` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`payment_type` varchar(50) NOT NULL,
	`provider` varchar(50) NOT NULL,
	`account_no` INT NOT NULL AUTO_INCREMENT,
	`expiry` DATE NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product_category` (
	`id` VARCHAR(255) NOT NULL AUTO_INCREMENT,
	`name` varchar(55) NOT NULL,
	`desc` TEXT(300) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	`deleted_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product_invetory` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`quantity` INT NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	`deleted_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`desc` TEXT(300) NOT NULL,
	`SKU` varchar(100) NOT NULL,
	`category_id` INT NOT NULL AUTO_INCREMENT,
	`invetory_id` INT NOT NULL AUTO_INCREMENT,
	`price` DECIMAL NOT NULL,
	`discount_id` INT NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	`deleted_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `discount` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(55) NOT NULL,
	`desc` TEXT(300) NOT NULL,
	`discount_percent` DECIMAL NOT NULL,
	`active` BOOLEAN NOT NULL,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	`deleted_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cart_items` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`product_id` INT NOT NULL AUTO_INCREMENT,
	`quantity` INT NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `payment_details` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`order_id` INT NOT NULL AUTO_INCREMENT,
	`amount` INT NOT NULL AUTO_INCREMENT,
	`provider` varchar(55) NOT NULL,
	`status` varchar(55) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_details` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`total` DECIMAL NOT NULL,
	`payment_id` INT NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_items` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`order_id` INT NOT NULL AUTO_INCREMENT,
	`product_id` INT NOT NULL AUTO_INCREMENT,
	`quantity` INT NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME NOT NULL,
	`modified_at` DATETIME NOT NULL,
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

ALTER TABLE `order_items` ADD CONSTRAINT `order_items_fk1` FOREIGN KEY (`product_id`) REFERENCES 