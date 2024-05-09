<?php

require_once "classes/answers.class.php";
require_once "classes/tournament.class.php";


$_answers = new answers;
$_tournament = new tournament;

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {

      $tournamentId = $_GET['id'];
      $dataTournament = $_tournament->getTournament($tournamentId);
      header("Content-Type: application/json");
      echo json_encode($dataTournament);
      http_response_code(200);

    } elseif (isset($_GET["page"])) {
      
      $page = $_GET["page"];
      $listTournaments = $_tournament->listTournaments($page);
      header("Content-Type: application/json");
      echo json_encode($listTournaments);
      http_response_code(200);

    } elseif (isset($_GET)) {
      
      $getAll = $_tournament->listTournaments();
      header("Content-Type: application/json");
      echo json_encode($getAll);
      http_response_code(200);
    }
// end get

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Recibimos los datos enviados
  $postBody = file_get_contents("php://input");

  // Enviamos los datos al manejador
  $resp = $_tournament->post($postBody);
  
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
  $resp = $_tournament->put($postBody);

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
  $resp = $_tournament->delete($postBody);

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