

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "u186675676_login_db";

$dsn = "mysql:host=$host;dbname=$dbName";

$conn = new PDO($dsn, $user, $password);

$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
