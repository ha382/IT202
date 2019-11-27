<?php
#turn error reporting on
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//pull in config.php so we can access the variables from it
require('config.php');
echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$db = new PDO($conn_string, $username, $password);
echo "Connected";
//create table
        $query = "create table if not exists `Customer accounts`(
                `Id` int auto_increment not null,
                `Username` varchar(30) not null unique,
                `Password` varchar(60) default 0,
                PRIMARY KEY (`Id`)
                ) CHARACTER SET utf8 COLLATE utf8_general_ci";


