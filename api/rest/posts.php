<?php

  // Incluir los archivos de configuración y funciones necesarios
  include "config.php";
  include "utils.php";
  include "inserts.php";
  include "deletes.php";
  include "router.php";

  // Establecer los encabezados CORS para permitir el acceso desde el origen especificado
  header('Access-Control-Allow-Origin: http://localhost:4200');
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

  // Manejar las solicitudes de tipo OPTIONS
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Las solicitudes OPTIONS se utilizan para verificar si el servidor permite la solicitud CORS
    header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('HTTP/1.1 200 OK');
    exit;
  }

  try {
    // Conectar a la base de datos
    $conn = connect($db);

    // Crear un nuevo post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $requestUri = $_SERVER['REQUEST_URI'];
      $jsonData = file_get_contents('php://input');
      $data = json_decode($jsonData); 
      
      $_router = new Router($requestUri);
      $_router->handlePost($conn, $data);
    }

    // Borrar
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      $requestUri = $_SERVER['REQUEST_URI'];
      $_router = new Router($requestUri);
      $_router->handleDelete($conn);
    }

    // En caso de que no se haya ejecutado ninguna opción
    header("HTTP/1.1 400 Bad Request");
    
  } catch (PDOException $e) {
    // Manejar cualquier excepción PDO que pueda ocurrir
    http_response_code(500);
    echo "Error de conexión a la base de datos: " . $e->getMessage();
  }
?>