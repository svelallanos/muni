<?php

class InicioModel extends Mysql
{
  function __construct()
  {
    parent::__construct();
  }

  // Funciones select_all

  public function getDataLibros()
  {
    $sql = 'SELECT * FROM libro';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function getDataAutores()
  {
    $sql = 'SELECT * FROM autores';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function getDataEditoriales()
  {
    $sql = 'SELECT * FROM editoriales';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  // funcion select

  public function getDataTipoLibro()
  {
    $sql = 'SELECT * FROM detalle_tipolibro
    INNER JOIN tipo_libro ON detalle_tipolibro.tipo_libro_id = tipo_libro.tipo_libro_id';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }
}
