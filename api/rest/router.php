<?php

  class Router {

    // Propiedad para almacenar la URI de la solicitud
    private $requestUri;

    public function __construct($requestUri) {
      $this->requestUri = $requestUri;
    }

    // Método para manejar solicitudes GET
    public function handleGet($conn) {
      // Incluir archivo con las funciones de obtención de datos
      require_once "gets.php";

      // Verifica la solicitud URI y llama a la función correspondiente
      if (strpos($this->requestUri, '/api/rest/posts.php/getAllRoles') !== false) {
        getAllRoles($conn);
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getUserById') !== false) {
        getUserById($conn);
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getMembersTeam') !== false) {
        getMembersTeam($conn);
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getActivitiesById') !== false) {
        getActivitiesById($conn);
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getTeamById') !== false) {
        getTeamById($conn);
      }
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
      } else if ($this->requestUri === '/api/rest/posts.php/insertActivities') {
        insertActivities($conn, $data);
      } else if ($this->requestUri === '/api/rest/posts.php/insertGame') {
        insertGame($conn, $data);
      } else if ($this->requestUri === '/api/rest/posts.php/insertGameTeam') {
        insertGameTeam($conn, $data);
      }
    }

    public function handlePut($conn, $data) {
      // Incluir archivo con las funciones de actualización
      require_once "puts.php";

      // Verifica la solicitud URI y llama a la función correspondiente
      if ($this->requestUri === '/api/rest/posts.php/updateTeam') {
        updateTeam($conn, $data);
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