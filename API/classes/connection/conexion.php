<?php

class conexion {

  private $server;
  private $user;
  private $password;
  private $database;
  private $port;
  private $conn;

  public function __construct() {
    $listData = $this->dataConexion();
    // Recorrer los datos que devuelve la función dataConexion
    // y guardarlos en $value
    foreach ($listData as $key => $value) {
      $this->server = $value['server'];
      $this->user = $value['user'];
      $this->password = $value['password'];
      $this->database = $value['database'];
      $this->port = $value['port'];
    }
    $this->conn = new mysqli( $this->server, $this->user, $this->password, $this->database, $this->port );
    if( $this->conn->connect_errno ) {
      echo "Algo va mal con la conexión";
      die();
    }

  }

  private function dataConexion() {
    // Almacenar la dirección del archivo config
    $address = dirname(__FILE__);
    // Abrir el archivo, guardar el contenido del archivo y devolverlo
    $jsondata = file_get_contents( $address . "/" . "config" );
    // Obterner los datos del archivo config y convertirlo en un array
    return json_decode( $jsondata, true );
  }

  /*private function convertToUTF8($array) {
    array_walk_recursive( $array, function(&$item, $key) {
      if( !mb_detect_encoding($item, 'utf-8', true) ) {
        $item = utf8_encode($item);
      }
    });
    return $array;
  }
  */

  /**
   * Obtener datos de la consulta
   */
  public function getData($query) {

    $results = $this->conn->query($query);
    $resultArray = [];
    foreach ( $results as $key ) {
      $resultArray[] = $key;
    }
    return $resultArray;
  }

  /**
   * Devuelve el número de filas afectadas
   */
  public function nonQuery($query) {
    
    $results = $this->conn->query($query);
    return $this->conn->affected_rows;
  }

  /**
   * INSERT
   * Devuelve el último id de la fila insertada
   */
  public function nonQueryId($query) {
    
    $results = $this->conn->query($query);
    $rows = $this->conn->affected_rows;
    if( $rows >= 1 ) {
      // Devuelve el id que insertamos
      return $this->conn->insert_id;
    } else {
      return 0;
    }
  }

  // Encriptar
  protected function encrypt($string) {
    return md5($string);
  }

}

?>