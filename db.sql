-- php_ecommerce database

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--------------------------------------------------------

CREATE TABLE IF NOT EXITS 'TEAM' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'name' varchar(255) NOT NULL,
  'description' text NOT NULL,
  'parent_id' int(11) NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `access_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `products`
    ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `orders`
    ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_items`
    ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `carts`
    ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `cart_items`
    ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------
-- Add timestamp to all tables

ALTER TABLE `categories` ADD `created_at` DATETIME NOT NULL AFTER `parent_id`;

ALTER TABLE `products` ADD `created_at` DATETIME NOT NULL AFTER `category_id`;

ALTER TABLE `users` ADD `created_at` DATETIME NOT NULL AFTER `last_name`;

ALTER TABLE `orders` ADD `updated_at` DATETIME NOT NULL AFTER `created_at`;

ALTER TABLE `order_items` ADD `updated_at` DATETIME NOT NULL AFTER `price`;

ALTER TABLE `carts` ADD `updated_at` DATETIME NOT NULL AFTER `created_at`;

ALTER TABLE `cart_items` ADD `updated_at` DATETIME NOT NULL AFTER `price`;

-- --------------------------------------------------------

ALTER TABLE `users` ADD `access_level` INT NOT NULL AFTER `last_name`;

ALTER TABLE `users`
      ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`access_level`) REFERENCES `access_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

ALTER TABLE `products` ADD `image` VARCHAR(255) NOT NULL AFTER `category_id`;

-- --------------------------------------------------------------

INSERT INTO `access_levels` (`id`, `name`) VALUES
(1, 'Customer'),
(2, 'Admin');

ALTER TABLE `users` CHANGE `access_level` `access_level` INT(11) NOT NULL DEFAULT '1';

-- --------------------------------------------------------

ALTER TABLE `products` ADD `status` VARCHAR(20) NOT NULL AFTER `category_id`;
ALTER TABLE `products` ADD `quantity` INT NOT NULL AFTER `category_id`;

-- --------------------------------------------------------
-- insert default categories

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`) VALUES
(1, 'Electronics', 1, '2015-01-01 00:00:00'),
(2, 'Cameras', 1, '2015-01-01 00:00:00'),
(3, 'Laptops', 1, '2015-01-01 00:00:00'),
(4, 'Mobile Phones', 1, '2015-01-01 00:00:00'),
(5, 'Tablets', 1, '2015-01-01 00:00:00'),
(6, 'TV', 1, '2015-01-01 00:00:00'),
(7, 'Video Games', 1, '2015-01-01 00:00:00'),
(8, 'Home', 1, '2015-01-01 00:00:00'),
(9, 'Kitchen', 8, '2015-01-01 00:00:00'),
(10, 'Furniture', 8, '2015-01-01 00:00:00'),
(11, 'Bedroom', 10, '2015-01-01 00:00:00'),
(12, 'Living Room', 10, '2015-01-01 00:00:00'),
(13, 'Dining Room', 10, '2015-01-01 00:00:00'),
(14, 'Clothing', 1, '2015-01-01 00:00:00');

-- --------------------------------------------------------
-- add featured column to products table

ALTER TABLE `products` ADD `featured` TINYINT(1) NOT NULL AFTER `category_id`;

-- --------------------------------------------------------
-- add team members table
INSERT INTO `team` (`id`, `name`, `description`, `parent_id`) VALUES
(1, 'John Doe', 'CEO', 1),
(2, 'Jane Doe', 'CTO', 1),
(3, 'John Smith', 'CFO', 1),
(4, 'Jane Smith', 'CMO', 1);