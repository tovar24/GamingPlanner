<?php

require_once "connection/conexion.php";
require_once "answers.class.php";


class planner extends conexion {

  private $table      = "planner";
  private $plannerId  = "";
  private $monthId    = "";
  private $weekDayId  = "";
  private $dailyActId = "";
  private $token      = "";

  public function listPlanner($page = 1) {
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

  public function getPlanner($id) {
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

    if ( !isset($data['idMonth'])
      && !isset($data['idWeekDay'])
      && !isset($data['idDailyAct'])
    ) {
      return $_answers->error_400();
    } else {
      $this->monthId = $data['idMonth'];
      $this->weekDayId = $data['idWeekDay'];
      $this->dailyActId = $data['idDailyAct'];

      $resp = $this->insertPlanner();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "plannerId" => $resp
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function insertPlanner() {
    // TODO: Verificar que el mes este entre 1 y 12, que exista el idWeekDay
    // TODO: y el idDailyAct en sus respectivas tablas 
    $query = "INSERT INTO " .$this->table. " (idMonth, idWeekDay, idDailyAct)
    VALUES
    ('" .$this->monthId. "', '".$this->weekDayId."', '".$this->dailyActId."')";

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
      $this->plannerId = $data['id'];
      if (isset($data['idMonth'])) { $this->monthId = $data['idMonth']; }
      if (isset($data['idWeekDay'])) { $this->weekDayId = $data['idWeekDay']; }
      if (isset($data['idDailyAct'])) { $this->dailyActId = $data['idDailyAct']; }

      $resp = $this->updatePlanner();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "plannerId" => $this->plannerId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }

  }

  private function updatePlanner() {
    // TODO: Condicional para que solo haga el update al campo que modificó
    $query = "UPDATE " .$this->table. " SET idMonth='" .$this->monthId. "', 
    idWeekDay='".$this->weekDayId."', idDailyAct='".$this->dailyActId."' 
    WHERE id='".$this->plannerId."'";

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
      $this->plannerId = $data['id'];
      $resp = $this->deletePlanner();
      if ($resp) {
        $answer = $_answers->response;
        $answer["result"] = [
          "plannerId" => $this->plannerId
        ];
        return $answer;
      } else {
        return $_answers->error_500();
      }
    }
  }

  private function deletePlanner() {
    $query = "DELETE FROM ".$this->table. " WHERE id='" .$this->plannerId. "'";
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