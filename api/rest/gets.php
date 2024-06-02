<?php

function getAllRoles($conn) {
  try {
    // Verificar si la conexión es válida
    if (!$conn) {
      throw new Exception("Error de conexión a la base de datos");
    }

    // Preparar la consulta SQL para obtener todos los registros de la tabla rol
    $sql = $conn->prepare("SELECT * FROM rol");

    // Ejecutar la consulta preparada
    $sql->execute();

    // Obtener todos los resultados en un array
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Enviar una respuesta HTTP 200 OK y el JSON con los resultados
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($result);
  } catch (PDOException $e) {
    // Manejar cualquier excepción PDO que pueda ocurrir
    http_response_code(500);
    error_log("Error en getAllRol: " . $e->getMessage());
    echo "Error al obtener los roles";
  } catch (Exception $e) {
    // Manejar cualquier otra excepción que pueda ocurrir
    http_response_code(500);
    error_log("Error en getAllRol: " . $e->getMessage());
    echo "Error al obtener los roles";
  }
}

  function getUserById($conn) {
    try {
      // Preparar la consulta SQL para buscar el usuario por medio del id
      $sql = $conn->prepare("SELECT * FROM users WHERE id = :id");
  
      // Enlazar el valor del id a la consulta preparada
      $sql->bindValue(':id', $_GET['id']);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit();
    } catch (PDOException $e) {
      // Manejar cualquier excepción PDO que pueda ocurrir
      http_response_code(404);
      echo $e->getMessage();
    }
  }

  function getTeamById($conn) {
    try {
      // Preparar la consulta SQL para buscar el equipo por medio del id
      $sql = $conn->prepare("SELECT t.*, u.name as user FROM team t INNER JOIN users u ON u.idTeam = t.id WHERE u.idTeam = :id");

      // Enlazar el valor del id a la consulta preparada
      $sql->bindValue(':id', $_GET['id']);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $results = $sql->fetchAll(PDO::FETCH_ASSOC);

      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($results);
      exit();
    } catch (PDOException $e) {
      // Manejar cualquier excepción PDO que pueda ocurrir
      http_response_code(404);
      echo $e->getMessage();
    }
  }

  function getMembersTeam($conn) {
    try {
      // Preparar la consulta SQL para buscar el equipo por medio del id
      $sql = $conn->prepare("SELECT u.name, u.email, r.rol, u.idTeam FROM users u INNER JOIN rol r ON r.id = u.idRol WHERE idTeam = :idTeam");

      // Enlazar el valor del idTeam a la consulta preparada
      $sql->bindValue(':idTeam', $_GET['idTeam']);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit();

    } catch (PDOException $e) {
      // Manejar cualquier excepción PDO que pueda ocurrir
      http_response_code(500);
      echo $e->getMessage();
    }
  }

  function getActivitiesByIdTeam($conn) {
    try {
      // Preparar la consulta SQL para buscar las actividades por medio del idTeam
      $sql = $conn->prepare("SELECT * FROM activities WHERE idTeam = :idTeam");

      // Enlazar el valor del idTeam a la consulta preparada
      $sql->bindValue(':idTeam', $_GET['idTeam']);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit();
    } catch (PDOException $e) {
      http_response_code(404);
      echo $e->getMessage();
    }
  }
