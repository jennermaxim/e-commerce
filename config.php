<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'automend_food');
define('DB_PASSWORD', 'Food@Ney@Cuu');
define('DB_NAME', 'automend_food');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>