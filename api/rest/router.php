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
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getUserById') !== false) {
        getUserById($conn);
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getMembersTeam') !== false) {
        getMembersTeam($conn);
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getActivitiesById') !== false) {
        getActivitiesById($conn);
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getTeamById') !== false) {
        getTeamById($conn);
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getAllUsers') !== false) {
        getAllUsers($conn);
        return;
      } else if (strpos($this->requestUri, '/api/rest/posts.php/getTournamentTeam') !== false) {
        getTournamentTeam($conn);
        return;
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
        return;
      } else if ($this->requestUri === '/api/rest/posts.php/updateUserRol') {
        updateUserRol($conn, $data);
        return;
      }
    }

    // Método para manejar solicitudes DELETE
    public function handleDelete($conn) {

      require_once __DIR__ . "/deletes.php";

      $requestUri = $_SERVER['REQUEST_URI'];

      if (strpos($requestUri, 'deleteActivityById') !== false) {
        deleteActivityById($conn);
        return;
      }

      if (strpos($requestUri, 'deleteUser') !== false) {
        deleteUser($conn);
        return;
      }
    }
  }
?>
