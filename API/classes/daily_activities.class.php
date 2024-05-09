<?php

require_once "connection/conexion.php";
require_once "answers.class.php";


class daily_activities extends conexion {

  private $table      = "daily_activities";
  private $dailyActId = "";
  private $dayId      = "";
  private $activityId = "";
  private $token      = "";

  public function listDailyActivities($page = 1) {
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

  public function getDailyActivities($id) {
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

    if (!isset($data['idDay']) && !isset($data['idActivity'])) {
      return $_answers->error_400();
    } else {
      if (isset($data['idDay'])) {$this->dayId = $data['idDay'];}
      if (isset($data['idActivity'])) {$this->activityId = $data['idActivity'];}

      $resp = $this->insertDailyAct();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "dailyActId" => $resp
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function insertDailyAct() {
    // TODO: Hacer verificación que el idDay este entre el 1 y 5.
    // TODO: Y que el idActivity este entre el 1 y 3.
    $query = "INSERT INTO " .$this->table. " (idDay, idActivity)
    VALUES
    ('" .$this->dayId. "', '".$this->activityId."')";

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
      $this->dailyActId = $data['id'];
      if (isset($data['idDay'])) { $this->dayId = $data['idDay']; }
      if (isset($data['idActivity'])) { $this->activityId = $data['idActivity']; }

      $resp = $this->updateDailyAct();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "dailyActId" => $this->dailyActId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function updateDailyAct() {
    // TODO: Condicional para que solo haga el update al campo que modificó
    $query = "UPDATE " .$this->table. " SET idDay='" .$this->dayId. "', 
    idActivity='".$this->activityId."' WHERE id='".$this->dailyActId."'";

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
      $this->dailyActId = $data['id'];
      $resp = $this->deleteDailyAct();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "dailyActId" => $this->dailyActId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }
  }

  private function deleteDailyAct() {
    $query = "DELETE FROM ".$this->table. " WHERE id='" .$this->dailyActId. "'";
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