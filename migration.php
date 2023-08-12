<?php
$con = new mysqli("localhost", "mphil", "", "mvctut");

$query = "CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
  ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
  
  INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
  (1, 'Phil', 'Mod', 'test1@test.com');
  INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
  (2, 'Tom', 'Sawyer', 'mark@twain.com');
  INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
  (3, 'Bob', 'Johnson', 'bob@johnson.com');
  INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
  (4, 'Phil', 'Mod', 'test@test.com'),
  (5, 'Maria', 'Gonzales', 'maria@gonz.com'),
  (10, 'Phil', 'Mod', 'philipmodino@gmail.com'),
  (11, 'Philip', 'Modinos', 'mphilippos@hotmail.com'),
  (13, 'Philip', 'Modinos', 'mphilippos@hotmail.com1'),
  (14, 'Test', 'Tested', 't@t.t');";

$con->multi_query($query);
