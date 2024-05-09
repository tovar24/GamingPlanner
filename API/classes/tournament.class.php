<?php

require_once "connection/conexion.php";
require_once "answers.class.php";


class tournament extends conexion {

  private $table1       = "tournament";
  private $table2       = "tournament_team";
  private $tournamentId = "";
  private $name         = "";
  private $url          = "";
  private $token        = "";

  public function listTournaments($page = 1) {
    $start = 0;
    $pageSize = 25;
    if ($page > 1) {
      $start = ($pageSize * ($page - 1)) + 1;
      $pageSize *=  $page;
    }

    $query = "SELECT * FROM " . $this->table1 . " LIMIT $start, $pageSize";
    $data = parent::getData($query);
    return ($data);
  }

  public function getTournament($id) {
    $query = "SELECT * FROM " .$this->table1. " WHERE id='$id'";
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
      if (isset($data['url'])) { $this->url = $data['url']; }

      $resp = $this->insertTournament();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "tournamentId" => $resp
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function insertTournament() {
    // Verificar si el url del torneo es nulo
    if (is_null($this->url)){
      $query = "INSERT INTO " .$this->table1. " (name)
      VALUES
      ('" .$this->name. "')";
    } else {
      $query = "INSERT INTO " .$this->table1. " (name, url)
      VALUES
      ('" .$this->name. "', '".$this->url."')";
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
      $this->tournamentId = $data['id'];
      if (isset($data['name'])) { $this->name = $data['name']; }
      if (isset($data['url'])) { $this->url = $data['url']; }

      $resp = $this->updateTournament();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "tournamentId" => $this->tournamentId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function updateTournament() {
    // Verificar si el url del torneo es nulo
    if (is_null($this->url)){
      $query = "UPDATE " .$this->table1. " SET name='" .$this->name. "' 
      WHERE id='" .$this->tournamentId. "'";
    } else {
      $query = "UPDATE " .$this->table1. " SET name='" .$this->name. "', 
      url='".$this->url."' WHERE id='".$this->tournamentId."'";
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
      $this->tournamentId = $data['id'];
      $resp = $this->deleteTournament();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "tournamentId" => $this->tournamentId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }
  }

  private function deleteTournament() {
    $query = "DELETE FROM ".$this->table1. " WHERE id='" .$this->tournamentId. "'";
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