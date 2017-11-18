<?php
include('lib/DatabaseHelper.class.php');


define('DBCONNECTION', "mysql:localhost=3306;dbname=book;charset=utf8;");
define('DBUSER', 'root');
define('DBPASS', '');

// auto load all classes so we don't have to explicitly include them
spl_autoload_register(function ($class) {
 $file = 'lib/' . $class . '.class.php';
 if (file_exists($file))
 include $file;
});

// connect to the database
$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION,DBUSER, DBPASS));
 

function getConnection(){
define('DBCONNECTION', "mysql:localhost=3306;dbname=book;charset=utf8;");
define('DBUSER', 'root');
define('DBPASS', '');

// connect to the database
$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION,
 DBUSER, DBPASS));
 
 return $connection;
}

 ?>
