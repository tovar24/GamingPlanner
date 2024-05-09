<?php

require_once "classes/answers.class.php";
require_once "classes/team.class.php";


$_answers = new answers;
$_team = new team;

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {

      $teamId = $_GET['id'];
      $dataTeam = $_team->getTeam($teamId);
      header("Content-Type: application/json");
      echo json_encode($dataTeam);
      http_response_code(200);

    } elseif (isset($_GET["page"])) {
      
      $page = $_GET["page"];
      $listTeams = $_team->listTeams($page);
      header("Content-Type: application/json");
      echo json_encode($listTeams);
      http_response_code(200);

    } elseif (isset($_GET)) {
      
      $getAll = $_team->listTeams();
      header("Content-Type: application/json");
      echo json_encode($getAll);
      http_response_code(200);

    }
// end get

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Recibimos los datos enviados
  $postBody = file_get_contents("php://input");

  // Enviamos los datos al manejador
  $resp = $_team->post($postBody);
  
  // Devolvemos una respuesta
  header("Content-Type: application/json");
  if (isset($resp["result"]["error_id"])) {
    $responseCode = $resp["result"]["error_id"];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }

  echo json_encode($resp);
// en post

} elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {
  
  // Recibimos los datos enviados
  $postBody = file_get_contents("php://input");

  // Enviamos los datos al manejador
  $resp = $_team->put($postBody);

  // Devolvemos una respuesta
  header("Content-Type: application/json");
  if (isset($resp["result"]["error_id"])) {
    $responseCode = $resp["result"]["error_id"];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }

  echo json_encode($resp);
// end put

} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
  
  // $headers = getallheaders();
  // print_r($headers);

  // Recibimos los datos enviados
  $postBody = file_get_contents("php://input");

  // Enviamos los datos al manejador
  $resp = $_team->delete($postBody);

  // Devolvemos una respuesta
  header("Content-Type: application/json");
  if (isset($resp["result"]["error_id"])) {
    $responseCode = $resp["result"]["error_id"];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }

  echo json_encode($resp);
// end delete

} else {
  header("Content-Type: application/json");
  $dataArray = $_answers->error_405();
  echo json_encode($dataArray);
}

?>