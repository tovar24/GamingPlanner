<?php

  function updateTeam($conn, $data) {
    try {
      // Preparar la consulta SQL para actualizar el idTeam de un usuario
      $sql = $conn->prepare("UPDATE users SET idTeam = :idTeam WHERE users.name = :name");

      // Enlazar los valores de los parámetros a la consulta preparada
      $sql->bindValue(':idTeam', $data->idTeam);
      $sql->bindValue(':name', $data->name);

      // Ejecutar la consulta preparada
      $sql->execute();

      // Preparar una nueva consulta para obtener el registro actualizado
      $sql = $conn->prepare("SELECT name, email, idRol, idTeam FROM users WHERE name = :name");
      $sql->bindValue(':name', $data->name);
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $result = $sql->fetch(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      header('Content-Type: application/json');
      http_response_code(200);
      echo json_encode($result);
      exit();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function updateUserRol($conn, $data) {
    try {
      // Preparar la consulta SQL para actualizar el idRol de un usuario
      $sql = $conn->prepare("UPDATE users SET idRol = :idRol WHERE users.id = :idUser");

      // Enlazar los valores de los parámetros a la consulta preparada
      $sql->bindValue(':idRol', $data->idRol);
      $sql->bindValue(':idUser', $data->idUser);

      // Ejecutar la consulta preparada
      $sql->execute();

      // Preparar una nueva consulta para obtener el registro actualizado
      $sql = $conn->prepare("SELECT * FROM users WHERE id = :idUser");
      $sql->bindValue(':idUser', $data->idUser);
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      $result = $sql->fetch(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
      header('Content-Type: application/json');
      http_response_code(200);
      echo json_encode($result);
      exit();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
