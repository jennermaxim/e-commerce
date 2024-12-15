# E-commerce System

query to run

    ALTER TABLE `order_items` ADD `status` INT(2) NOT NULL DEFAULT '0' AFTER `total_price`;

    ALTER TABLE `orders` ADD `payment_method` VARCHAR(100) NOT NULL AFTER `totalAmount`; 

    modified:   README.md
    modified:   admin/assets/css/admin.css
    modified:   admin/assets/css/main.css
    modified:   admin/index.php
    modified:   assets/css/index.css
    modified:   assets/css/main.css
    modified:   assets/javascript/carts.js
    modified:   assets/javascript/order.js
    modified:   cart.php
    modified:   order.php
    added:      admin/delivered.php