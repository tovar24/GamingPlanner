<?php

  // Establecer conexión con la BBDD
  function connect($db) {
    try {
      $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);

      //  Establecer el modo de error de PDO en excepción
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $conn;
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

  // Asociar los parámetros a un sql
  function bindAllValues($stmt, $params) {
    try {
      array_map(function($param, $value) use ($stmt) {
          $stmt->bindValue(':'.$param, $value);
      }, array_keys($params), array_values($params));
    } catch (PDOException $e) {
      // Manejo de la excepción
      echo "Error al enlazar valores: ". $e->getMessage();
    }

    return $stmt;
  }

   //Obtener parametros para updates
  function getParams($input) {
    $filterParams = [];
    foreach($input as $param => $value) {
      $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
	}

?>