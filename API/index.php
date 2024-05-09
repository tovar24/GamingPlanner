<?php

require_once "classes/connection/conexion.php";

$conn = new conexion;

// $query = "select * from users";

// print_r($conn->getData($query));

header("HTTP/1.1 200");

echo "Index";

?>