<?php

  function deleteUser($conn) {
    try {
      // Preparar la consulta para eliminar un usuario
      $sql = $conn->prepare("DELETE FROM users WHERE id = :id");
      
      // Asignar el valor del parámetro ':id' a la variable $_GET['id']
      $sql->bindValue(':id', $_GET['id']);
      
      // Ejecutar la consulta
      $sql->execute();
      
      // Establecer el modo de fetch para obtener los resultados en formato asociativo
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      
      // Enviar un código de respuesta HTTP 200 OK
      header("HTTP/1.1 200 OK");
      
      // Finalizar la ejecución del script
      exit();
    } catch (PDOException $e) {
      // Mostrar el mensaje de error en caso de que se produzca una excepción
      echo $e->getMessage();
    }
  }