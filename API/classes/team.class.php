<?php

require_once "connection/conexion.php";
require_once "answers.class.php";


class team extends conexion {

  private $table      = "team";
  private $teamId     = "";
  private $name       = "";
  private $idPlanner  = null;
  private $token      = "";

  public function listTeams($page = 1) {
    $start = 0;
    $pageSize = 25;
    if ($page > 1) {
      $start = ($pageSize * ($page - 1)) + 1;
      $pageSize *=  $page;
    }

    $query = "SELECT * FROM " . $this->table . " LIMIT $start, $pageSize";
    $data = parent::getData($query);
    return ($data);
  }

  public function getTeam($id) {
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

    if (!isset($data['name'])) {
      return $_answers->error_400();
    } else {
      $this->name = $data['name'];
      if (isset($data['idPlanner'])) { $this->idPlanner = $data['idPlanner']; }

      $resp = $this->insertTeam();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "teamId" => $resp
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function insertTeam() {
    // Verificar si el idPlanner es nulo
    if (is_null($this->idPlanner)){
      $query = "INSERT INTO " .$this->table. " (name)
      VALUES
      ('" .$this->name. "')";
    } else {
      $query = "INSERT INTO " .$this->table. " (name, idPlanner)
      VALUES
      ('" .$this->name. "', '".$this->idPlanner."')";
    }
    $resp = parent::nonQueryId($query);
    if ($resp) {
      return $resp;
    } else {
      return 0;
    }
  }

  public function put($json) {
    // Instanciamos la clase de respuestas
    $_answers = new answers;
    // Decodificamos el JSON y pasarlo a un array asociativo
    $data = json_decode($json, true);

    if (!isset($data['id'])) {
      return $_answers->error_400();
    } else {
      $this->teamId = $data['id'];
      if (isset($data['name'])) { $this->name = $data['name']; }
      if (isset($data['idPlanner'])) { $this->idPlanner = $data['idPlanner']; }

      $resp = $this->updateTeam();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "teamId" => $this->teamId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function updateTeam() {
    // Verificar si el idPlanner es nulo
    if (is_null($this->idPlanner)){
      $query = "UPDATE " .$this->table. " SET name='" .$this->name. "' 
      WHERE id='" .$this->teamId. "'";
    } else {
      $query = "UPDATE " .$this->table. " SET name='" .$this->name. "', 
      idPlanner='".$this->idPlanner."' WHERE id='".$this->teamId."'";
    }

    $resp = parent::nonQuery($query);
    if ($resp >= 1) {
      return $resp;
    } else {
      return 0;
    }
  }

  public function delete($json) {
    // Instanciamos la clase de respuestas
    $_answers = new answers;
    // Decodificamos el JSON y pasarlo a un array asociativo
    $data = json_decode($json, true);

    if (!isset($data['id'])) {
      return $_answers->error_400();
    } else {
      $this->teamId = $data['id'];
      $resp = $this->deleteTeam();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "teamId" => $this->teamId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }
  }

  private function deleteTeam() {
    $query = "DELETE FROM ".$this->table. " WHERE id='" .$this->teamId. "'";
    $resp = parent::nonQuery($query);
    if ($resp >= 1) {
      return $resp;
    } else {
      return 0;
    }
  }

  private function searchToken() {
    $query = "SELECT id, idUser FROM users_token";
    $resp = parent::getData($query);
    if ($resp) {
      return $resp;
    } else {
      return 0;
    }
  }

  private function updateToken($tokenId) {
    $date = date("Y-m-d H:i");
    $query = "UPDATE users_token SET fecha='$date' WHERE id='$tokenId'";
    $resp = parent::nonQuery($query);
    if ($resp >= 1) {
      return $resp;
    } else {
      return 0;
    }
  }

}

?>