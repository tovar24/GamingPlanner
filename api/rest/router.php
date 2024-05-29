<?php

  class Router {

    // Propiedad para almacenar la URI de la solicitud
    private $requestUri;

    public function __construct($requestUri) {
      $this->requestUri = $requestUri;
    }

    // Método para manejar solicitudes POST
    public function handlePost($conn, $data) {
      // Incluir archivo con las funciones de inserción
      require_once "inserts.php";

      // Verifica la solicitud URI y llama a la función correspondiente
      if($this->requestUri === '/api/rest/posts.php/register') {
        register($conn, $data);
      } else if ($this->requestUri === '/api/rest/posts.php/login') {
        login($conn, $data);
      } else if ($this->requestUri === '/api/rest/posts.php/checkEmail') {
        checkEmail($conn, $data);
      }
    }

    // Método para manejar solicitudes DELETE 
    public function handleDelete($conn) {
      // Verificar si se ha enviado el parámetro 'id' en la URL
      if (isset($_GET['id'])) {
        // Incluir archivo con las funciones de eliminación 
        require_once "deletes.php";
        deleteUser($conn);
      }
    }
  }
?>