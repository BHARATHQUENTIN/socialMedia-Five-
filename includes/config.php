<?php
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','five');
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
