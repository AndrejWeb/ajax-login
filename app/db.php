<?php
/*
 * Database settings
 */
define("DB_SERVER", "");
define("DB_NAME", "");
define("DB_USERNAME", "");
define("DB_PASSWORD", "");

try {
    $db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
}
catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    exit();
}
