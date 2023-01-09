<?php

class Conexion
{
  private $biblioteca;
  private $intranet;

  public function __construct()
  {
    // Conexion a la base de datos de biblioteca
    $conecctionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_BIB;

    try {
      $this->biblioteca = new PDO($conecctionString, DB_USER, DB_PASSWORD);
      $this->biblioteca->setAttribute(PDO::ATTR_ERRMODE,    PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $this->biblioteca = 'Error de conexión';
      echo "ERROR: " . $e->getMessage();
      die;
    }

    // Conexion a la base de datos de intranet
    $conecctionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_INT;

    try {
      $this->intranet = new PDO($conecctionString, DB_USER, DB_PASSWORD);
      $this->intranet->setAttribute(PDO::ATTR_ERRMODE,    PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $this->intranet = 'Error de conexión';
      echo "ERROR: " . $e->getMessage();
      die;
    }
  }

  public function conectBiblioteca()
  {
    return $this->biblioteca;
  }

  public function conectIntranet()
  {
    return $this->intranet;
  }
}
?>