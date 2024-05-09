<?php

require_once "connection/conexion.php";
require_once "answers.class.php";

class user extends conexion {

  private $table    = "users";
  private $userId   = "";
  private $name     = "";
  private $email    = "";
  private $password = "";
  private $idRol    = "";
  private $idTeam   = null;

  public function listUsers() {

    $query = "SELECT * FROM " . $this->table;
    $data = parent::getData($query);
    return ($data);
  }

  public function getUser($id) {
    $query = "SELECT * FROM " .$this->table. " WHERE id='$id'";
    return parent::getData($query);
  }

  public function post($json) {
    // Instanciamos la clase de respuestas
    $_answers = new answers;
    // Decodificamos el JSON y pasarlo a un array asociativo
    $data = json_decode($json, true);

    // Valición utilizando el token
    // if (!isset($data['token'])) {
    //   return $_answers->error_401();
    // } else {
    //   $this->token = $data['token'];
    //   $arrToken = $this->searchToken();
    //   if ($arrToken) {
    //     // Aquí va toda la lógica del post, put y delete
    //   } else {
    //     return $_answers->error_401("El token que envio es invalido");
    //   }
    // }

    if (!isset($data['email']) || !isset($data['idRol'])) {
      return $_answers->error_400();
    } else {
      $this->name     = $data['name'];
      $this->email    = $data['email'];
      $this->password = $data['password'];
      $this->idRol    = $data['idRol'];
      if (isset($data['isTeam'])) { $this->idTeam = $data['idTeam']; }

      $resp = $this->insertUser();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "userId" => $resp
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function insertUser() {
    // Verificar si el idTeam es nulo
    if (is_null($this->idTeam)){
      $query = "INSERT INTO " .$this->table. " (name, email, password, idRol)
      VALUES
      ('" .$this->name. "', '" .$this->email. "', '" .$this->password. "', '" .$this->idRol. "')";
    } else {
      $query = "INSERT INTO " .$this->table. " (name, email, password, idRol, idTeam)
      VALUES
      ('" .$this->name. "', '" .$this->email. "', '" .$this->password. "', '" .$this->idRol. "', '".$this->idTeam."')";
    }
    $resp = parent::nonQueryId($query);
    if ($resp) {
      return $resp;
    } else {
      return 0;
    }
  }
}

?>