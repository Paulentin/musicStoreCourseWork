<?php 
// MYSQL
$dblogin = "root"; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
$dbpass = "root"; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ
$db = "musiclib"; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
$dbhost="localhost";
mysql_connect($dbhost, $dblogin, $dbpass)or die('cannot connect to the server'); 
mysql_select_db($db) or die('database selection problem');
?>