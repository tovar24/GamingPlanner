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

function deleteActivityById($conn) {
  try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
      echo json_encode([
        "status" => "error",
        "message" => "Falta el id"
      ]);
      exit();
    }

    $sql = $conn->prepare("DELETE FROM activities WHERE id = :id");
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();

    echo json_encode([
      "status" => "success",
      "message" => "Actividad eliminada correctamente",
      "id" => $id,
      "deletedRows" => $sql->rowCount()
    ]);

    exit();
  } catch (PDOException $e) {
    echo json_encode([
      "status" => "error",
      "message" => "No se pudo eliminar la actividad",
      "error" => $e->getMessage()
    ]);

    exit();
  }

}
