<?php

require_once "connection/conexion.php";
require_once "answers.class.php";


class auth extends conexion {

  public function login($json) {
    
    $_answers = new answers;
    $data = json_decode($json, true);
    if(!isset($data['email']) || !isset($data['password'])) {
      // Error con los campos
      return $_answers->error_400();
    } else {
      // Esta bien
      $email    = $data['email'];
      $password = $data['password'];
      $password = parent::encrypt($password);
      $data     = $this->getDataUsers($email);
      if($data) {
        // Verificar si la contraseña es igual a la de la BBDD
        if( $password == $data[0]['password'] ){
          if($data[0]['idRol']) {
            // Crear token
            $verify = $this->insertToken($data[0]['id']);
            if($verify) {
              // Si se guardo
              $result = $_answers->response;
              $result["result"] = array(
                "token" => $verify
              );
              return $result;
            } else {
              // Error al guardar
              return $_answers->error_500("Error interno, no hemos podido guardar");
            }
          } else {
            // El usuario no tiene un rol asociado
            return $_answers->error_200("El usuario no tiene un rol asociado");
          }
        } else {
          return $_answers->error_200("El password es invalido");
        }

      } else {
        // No existe el usuario
        return $_answers->error_200("El usuario con correo: $email no existe");
      }
    }
  }

  private function getDataUsers($email) {

    $query = "SELECT * FROM users WHERE email = '$email'";
    $data = parent::getData($query);
    if( isset($data[0]["id"]) ) {
      return $data;
    } else {
      return 0;
    }
  }

  private function insertToken($idUser) {
    
    $val = true;
    // bin2hex, devuelve un string en hexadecimal
    // openssl_random..., genera una cadena de bytes pseudo-aleatoria
    $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
    $date = date("Y-m-d H:i");
    $query = "INSERT INTO users_token (idUser, token, fecha) VALUES ('$idUser', '$token', '$date')";
    $verify = parent::nonQuery($query);
    if( $verify ) {
      return $token;
    } else {
      return false;
    }
  }

}

?>