<?php

require_once "classes/auth.class.php";
require_once "classes/answers.class.php";


$_auth = new auth;
$_answers = new answers;

if($_SERVER['REQUEST_METHOD'] == "POST") {

  // Recibir datos
  $postBody = file_get_contents( "php://input" );

  // Enviamos los datos al manejador
  $dataArray = $_auth->login($postBody);

  // Devovemos una respuesta
  header("Content-Type: application/json");
  if (isset($dataArray["result"]["error_id"])) {
    $responseCode = $dataArray["result"]["error_id"];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }

  echo json_encode($dataArray);

} else {
  header("Content-Type: application/json");
  $dataArray = $_answers->error_405();
  echo json_encode($dataArray);
}

?>