<?php
$con = new mysqli("localhost", "mphil", "", "mvctut");

$query = "DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL CHECK (email <> ''),
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO users (first_name, last_name, email) VALUES 
('Bob','Dylon','test@test.com'),
('Philip', 'Modinos', 'test@test.com2'),
('Connection', 'Test', 'connect@test.com'),
('Connection2', 'Test', 'con@test.com'),
('Model', 'Test', 'model1@test.com'),
('Controller', 'Test', 'controller1@test.com'),
('Views1', 'Test', 'views1@test.com'),
('global', 'server', 'global@server.com'),
('controller', 'v2', 'controller@v2.com'),
('mvc', 'v1', 'mvc@v1.com'),
('mvc2', 'v1', 'mvc2@v1.com'),
('router', 'V2', 'router@v2.com'),
('Error', 'Test', 'error@test.com'),
('Phil', 'Mod', 'autoloader@test.com'),
('Philip', 'Modinos', 'autoloader2@test.com'),
('Phil', 'Mod', 'autoloader3@test.com'),
('Phil', 'Mod', 'autoloader4@test.com'),
('Philip', 'Modinos', 'autoloader5@test.com'),
('Phil', 'Mod', 'scope@error.com'),
('Phil', 'Mod', 'switch@first.com'),
('Phil', 'Mod', 'switch@second.com'),
('Phil', 'Mod', 'test@nobool.com'),
('Phil', 'Mod', 'bool@case.com'),
('Phil', 'Mod', 'bool2@case.com'),
('Phil', 'Mod', 'try@catch.com'),
('Phil', 'Mod', 'try2@catch.com'),
('Phil', 'Mod', 'try3@catch.com'),
('Phil', 'Mod', 'try4@catch.com'),
('Phil', 'Mod', 'router@trycatch.com'),
('Phil', 'Mod', 'router@v4.com'),
('Phil', 'Mod', 'new@entry.com'),
('Phil', 'Mod', 'router@v5.com'),
('Phil', 'Mod', 'trait@setup.com'),
('Phil', 'Mod', 'trait2@setup.com');
";

$con->multi_query($query);
