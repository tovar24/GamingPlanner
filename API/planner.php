<?php

require_once "classes/answers.class.php";
require_once "classes/planner.class.php";


$_answers = new answers;
$_planner = new planner;

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {

      $plannerId = $_GET['id'];
      $dataPlanner = $_planner->getPlanner($plannerId);
      header("Content-Type: application/json");
      echo json_encode($dataPlanner);
      http_response_code(200);

    } elseif (isset($_GET["page"])) {
      
      $page = $_GET["page"];
      $listPlanners = $_planner->listPlanner($page);
      header("Content-Type: application/json");
      echo json_encode($listPlanners);
      http_response_code(200);

    } elseif (isset($_GET)) {
      
      $getAll = $_planner->listPlanner();
      header("Content-Type: application/json");
      echo json_encode($getAll);
      http_response_code(200);
    }
// end get

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Recibimos los datos enviados
  $postBody = file_get_contents("php://input");

  // Enviamos los datos al manejador
  $resp = $_planner->post($postBody);
  
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
  $resp = $_planner->put($postBody);

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
  $resp = $_planner->delete($postBody);

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