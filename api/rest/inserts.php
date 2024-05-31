<?php

  function register($conn, $data) {
    try {
      // Generar el hash de la contraseña utilizando la función password_hash()
      $passwdEncrypt = password_hash($data->password, PASSWORD_DEFAULT);

      // Preparar la consulta SQL para insertar un nuevo usuario
      $sql = $conn->prepare("INSERT INTO users (name, email, password, idRol) VALUES (:name, :email, :password, :idRol);");

      // Enlazar los valores de los parámetros a la consulta preparada
      $sql->bindValue(':name', $data->name);
      $sql->bindValue(':email', $data->email);
      $sql->bindValue(':password', $passwdEncrypt);
      $sql->bindValue(':idRol', $data->idRol);

      // Ejecutar la consulta preparada
      $sql->execute();

      // Obtener el ID del último registro insertado
      $lastID = $conn->lastInsertId();

      // Crear un array con el ID del usuario recién registrado
      $input['id'] = $lastID;

      // Establecer el modo de extracción de resultados a un array asociativo
      $sql->setFetchMode(PDO::FETCH_ASSOC);

      // Enviar una respuesta HTTP 200 OK y el JSON con el ID del usuario
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
    } catch (PDOException $e) {
        // Manejar cualquier excepción PDO que pueda ocurrir
        http_response_code(500);
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
  }

  function login($conn, $data) {
    try {
      // Preparar la consulta SQL para buscar un usuario por email
      $sql = $conn->prepare("SELECT id as id, password, idRol FROM users WHERE email = :email;");

      // Enlazar el valor del email a la consulta preparada
      $sql->bindValue(':email', $data->email);
      // Ejecutar la consulta preparada
      $sql->execute();

      // Establecer el modo de extracción de resultados a un array asociativo
      // y obtener los resultados de la consulta
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Verificar si el usuario existe y si la contraseña es válida
        if ($result['id'] && password_verify($data->password, $result['password'])) {
          // Enviar una respuesta HTTP 200 OK y el JSON con los datos del usuario
          http_response_code(200);
          echo json_encode($result);
          exit();
        } else {
          // Enviar una respuesta HTTP 401 Unauthorized si las credenciales son inválidas
          http_response_code(401);
          echo "Credenciales inválidas";
          exit();
        }
      }

      // Si no se encuentra ningún usuario, enviar una respuesta HTTP 404 Not Found
      http_response_code(404);
      echo "Usuario no encontrado";
      exit();
    } catch (PDOException $e) {
        // Manejar cualquier excepción PDO que pueda ocurrir
        http_response_code(500);
        echo "Error al iniciar sesión: " . $e->getMessage();
    }
  }

  function checkSession($data) {
    try {
        // Iniciar o reanudar la sesión PHP
        session_start();

        // Verificar si el usuario ha iniciado sesión
        if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == $data->email) {
            // El usuario ha iniciado sesión
            $response = array('autenticado' => true, 'usuario' => $_SESSION['usuario']);
        } else {
            // El usuario no ha iniciado sesión
            $response = array('autenticado' => false);
        }

        // Establecer el tipo de contenido de la respuesta a JSON
        header('Content-Type: application/json');

        // Enviar la respuesta en formato JSON
        echo json_encode($response);
    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda ocurrir
        http_response_code(500);
        echo "Error al verificar la sesión: " . $e->getMessage();
    }
  }

  function checkEmail($conn, $data) {
    try {
        // Preparar la consulta SQL para verificar si el email existe en la tabla de usuarios
        $sql = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email");

        // Enlazar el valor del email a la consulta preparada
        $sql->bindValue(':email', $data->email);

        // Ejecutar la consulta preparada
        $sql->execute();

        // Establecer el modo de extracción de resultados a un array asociativo
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        // Obtener todos los resultados de la consulta
        $result = $sql->fetchAll();

        // Enviar una respuesta HTTP 200 OK y el JSON con el resultado
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    } catch (PDOException $e) {
        // Manejar cualquier excepción PDO que pueda ocurrir
        http_response_code(500);
        echo "Error al verificar el email: " . $e->getMessage();
    }
  }
