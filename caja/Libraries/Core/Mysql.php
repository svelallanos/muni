<?php

class Mysql extends Conexion
{
  private $strquery;
  private $arrvalues;

  function __construct()
  {
    $auxConexion = new Conexion();
    $this->conexionBiblioteca = $auxConexion->conectBiblioteca();
    $this->conexionIntranet = $auxConexion->conectIntranet();
  }

  public function insert(string $query, array $arrvalues = array(), string $base = '')
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;

    if ($base == 'aesanluc_biblioteca') {
      $insert = $this->conexionBiblioteca->prepare($this->strquery);
    } elseif ($base == 'intranet') {
      $insert = $this->conexionIntranet->prepare($this->strquery);
    } else {
      echo 'Base de datos no especificada.';
      die;
    }

    $lastInsert = $insert->execute($this->arrvalues);

    if ($lastInsert) {
      if ($base == 'aesanluc_biblioteca') {
        $lastInsert = $this->conexionBiblioteca->lastInsertId();
      } elseif ($base == 'intranet') {
        $lastInsert = $this->conexionIntranet->lastInsertId();
      }
    } else {
      $lastInsert = 0;
    }

    $insert->closeCursor();
    return intval($lastInsert);
  }

  public function update(string $query, array $arrvalues = array(), string $base = '')
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;

    if ($base == 'aesanluc_biblioteca') {
      $update = $this->conexionBiblioteca->prepare($this->strquery);
    } elseif ($base == 'intranet') {
      $update = $this->conexionIntranet->prepare($this->strquery);
    } else {
      echo 'Base de datos no especificada.';
      die;
    }

    $res = $update->execute($this->arrvalues);
    $update->closeCursor();
    return $res;
  }

  public function select(string $query, array $arrvalues = array(), string $base = '')
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;

    if ($base == 'aesanluc_biblioteca') {
      $result = $this->conexionBiblioteca->prepare($this->strquery);
    } elseif ($base == 'intranet') {
      $result = $this->conexionIntranet->prepare($this->strquery);
    } else {
      echo 'Base de datos no especificada.';
      die;
    }

    $result->execute($this->arrvalues);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();
    return $data;
  }

  public function select_all(string $query, array $arrvalues = array(), string $base = '')
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;

    if ($base == 'aesanluc_biblioteca') {
      $result = $this->conexionBiblioteca->prepare($this->strquery);
    } elseif ($base == 'intranet') {
      $result = $this->conexionIntranet->prepare($this->strquery);
    } else {
      echo 'Base de datos no especificada.';
      die;
    }

    $result->execute($this->arrvalues);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    $result->closeCursor();
    return $data;
  }

  public function delete(string $query, array $arrvalues = array(), string $base = '')
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;

    if ($base == 'aesanluc_biblioteca') {
      $result = $this->conexionBiblioteca->prepare($this->strquery);
    } elseif ($base == 'intranet') {
      $result = $this->conexionIntranet->prepare($this->strquery);
    } else {
      echo 'Base de datos no especificada.';
      die;
    }

    $res = $result->execute($this->arrvalues);
    $result->closeCursor();
    return $res;
  }
}
