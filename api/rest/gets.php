<?php

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
      $result = $sql->fetch(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      http_response_code(200);
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
      while($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
        http_response_code(200);
        echo json_encode($result);   
      }

      exit();
    } catch (PDOException $e) {
      // Manejar cualquier excepción PDO que pueda ocurrir
      http_response_code(404);
      echo $e->getMessage();
    }
  }

  function getMembersTeam($conn, $data) {
    try {
      // Preparar la consulta SQL para buscar el equipo por medio del id
      $sql = $conn->prepare("SELECT * FROM users WHERE idTeam = :idTeam");

      // Enlazar el valor del idTeam a la consulta preparada
      $sql->bindValue(':idTeam', $data->idTeam);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      while($result = $sql->fetch(PDO::FETCH_ASSOC)) {
          // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
          http_response_code(200);
          echo json_encode($result);
      }
      exit();

    } catch (PDOException $e) {
      // Manejar cualquier excepción PDO que pueda ocurrir
      http_response_code(500);
      echo $e->getMessage();
    }
  }

  function getActivitiesByIdTeam($conn, $data) {
    try {
      // Preparar la consulta SQL para buscar las actividades por medio del idTeam
      $sql = $conn->prepare("SELECT * FROM activities WHERE idTeam = :idTeam");

      // Enlazar el valor del idTeam a la consulta preparada
      $sql->bindValue(':idTeam', $data->idTeam);
  
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      while($result = $sql->fetch(PDO::FETCH_ASSOC)) {
          // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
          http_response_code(200);
          echo json_encode($result);
      }
      exit();
    } catch (PDOException $e) {
      http_response_code(404);
      echo $e->getMessage();
    }
  }
