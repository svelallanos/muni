<?php
class ConfiguracionLibrosModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }

  // Funciones select_all

  public function selectTipoLibros()
  {
    $sql = 'SELECT * FROM detalle_tipolibro
    INNER JOIN tipo_libro ON detalle_tipolibro.tipo_libro_id = tipo_libro.tipo_libro_id';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function TipoLibros()
  {
    $sql = 'SELECT * FROM tipo_libro';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectAutores(int $autores_estado = 0)
  {
    $where = '';
    $array = array();
    if ($autores_estado != 0) {
      $where = 'WHERE autores_estado = :autores_estado';
      $array = array(
        'autores_estado' => $autores_estado
      );
    }

    $sql = 'SELECT * FROM autores' . $where;
    $result = $this->select_all($sql, $array, DB_BIB);
    return $result;
  }

  public function selectEditoriales(int $editoriales_estado = 0)
  {
    $where = '';
    $array = array();
    if ($editoriales_estado != 0) {
      $where = 'WHERE editoriales_estado = :editoriales_estado';
      $array = array(
        'editoriales_estado' => $editoriales_estado
      );
    }

    $sql = 'SELECT * FROM editoriales' . $where;
    $result = $this->select_all($sql, $array, DB_BIB);
    return $result;
  }

  public function selectLibros(int $libro_estado = 0)
  {
    $where = '';
    $array = array();
    if ($libro_estado != 0) {
      $where = 'WHERE libro_estado = :libro_estado';
      $array = array(
        'libro_estado' => $libro_estado
      );
    }

    $sql = 'SELECT * FROM libro' . $where;
    $result = $this->select_all($sql, $array, DB_BIB);
    return $result;
  }

  public function selectCategorias()
  {
    $sql = 'SELECT * FROM categorias';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectDetalleTipoLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_tipolibro
    WHERE libro_id = :libro_id';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  // Funciones select

  public function selectsAutoresLibros(string $autores_id)
  {
    $sql = 'SELECT * FROM detalle_autor
    WHERE autores_id = :autores_id';
    $result = $this->select($sql, array('autores_id' => $autores_id), DB_BIB);
    return $result;
  }

  public function selectsEditorialesLibro(string $editoriales_id)
  {
    $sql = 'SELECT * FROM libro
    WHERE editoriales_id = :editoriales_id';
    $result = $this->select($sql, array('editoriales_id' => $editoriales_id), DB_BIB);
    return $result;
  }

  public function selectAutorByNombre(string $autores_nombre)
  {
    $sql = 'SELECT * FROM autores
    WHERE autores_nombre = :autores_nombre';
    $result = $this->select($sql, array('autores_nombre' => $autores_nombre), DB_BIB);
    return $result;
  }

  public function selectEditorialByNombre(string $editoriales_nombre)
  {
    $sql = 'SELECT * FROM editoriales
    WHERE editoriales_nombre = :editoriales_nombre';
    $result = $this->select($sql, array('editoriales_nombre' => $editoriales_nombre), DB_BIB);
    return $result;
  }

  public function selectLibroByTitulo(string $libro_titulo)
  {
    $sql = 'SELECT * FROM libro
    WHERE libro_titulo = :libro_titulo';
    $result = $this->select($sql, array('libro_titulo' => $libro_titulo), DB_BIB);
    return $result;
  }

  public function selectAutoresById(int $autores_id)
  {
    $sql = 'SELECT * FROM autores
    WHERE autores_id = :autores_id';
    $result = $this->select($sql, array('autores_id' => $autores_id), DB_BIB);
    return $result;
  }

  public function selectEditorialesById(int $editoriales_id)
  {
    $sql = 'SELECT * FROM editoriales
    WHERE editoriales_id = :editoriales_id';
    $result = $this->select($sql, array('editoriales_id' => $editoriales_id), DB_BIB);
    return $result;
  }

  public function selectCategoriaById(int $categorias_id)
  {
    $sql = 'SELECT * FROM categorias
    WHERE categorias_id = :categorias_id';
    $result = $this->select($sql, array('categorias_id' => $categorias_id), DB_BIB);
    return $result;
  }

  public function selectLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM libro
    INNER JOIN categorias ON libro.categorias_id = categorias.categorias_id
    WHERE libro_id = :libro_id';
    $result = $this->select($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  // Funciones insert

  public function insertNewAutor(string $autores_nombre, string $autores_descripcion, string $autores_imagen)
  {
    $sql = 'INSERT INTO autores (autores_nombre, autores_descripcion, autores_imagen) VALUES (:autores_nombre, :autores_descripcion, :autores_imagen)';
    $request = $this->insert($sql, array('autores_nombre' => $autores_nombre, 'autores_descripcion' => $autores_descripcion, 'autores_imagen' => $autores_imagen), DB_BIB);
    return $request;
  }

  public function insertNewEditorial(string $editoriales_nombre, string $editoriales_descripcion)
  {
    $sql = 'INSERT INTO editoriales (editoriales_nombre, editoriales_descripcion) VALUES (:editoriales_nombre, :editoriales_descripcion)';
    $request = $this->insert($sql, array('editoriales_nombre' => $editoriales_nombre, 'editoriales_descripcion' => $editoriales_descripcion), DB_BIB);
    return $request;
  }

  public function insertNewLibro(string $libro_titulo, $libro_resumen, int $libro_paginas, $libro_isbn, $libro_edision, int $libro_volumen, $libro_peso, string $libro_imagen, int $categorias_id)
  {
    $sql = 'INSERT INTO libro (libro_titulo, libro_resumen, libro_paginas, libro_isbn, libro_edision, libro_volumen, libro_peso, libro_imagen, categorias_id) VALUES (:libro_titulo, :libro_resumen, :libro_paginas, :libro_isbn, :libro_edision, :libro_volumen, :libro_peso, :libro_imagen, :categorias_id)';
    $arrData = array(
      'libro_titulo' => $libro_titulo,
      'libro_resumen' => $libro_resumen,
      'libro_paginas' => $libro_paginas,
      'libro_isbn' => $libro_isbn,
      'libro_edision' => $libro_edision,
      'libro_volumen' => $libro_volumen,
      'libro_peso' => $libro_peso,
      'libro_imagen' => $libro_imagen,
      'categorias_id' => $categorias_id
    );
    $request = $this->insert($sql, $arrData, DB_BIB);
    return $request;
  }

  public function insertTipoByLibro(int $libro_id, int $tipo_libro_id)
  {
    $sql = 'INSERT INTO detalle_tipolibro (libro_id, tipo_libro_id) VALUES (:libro_id, :tipo_libro_id)';
    $request = $this->insert($sql, array('libro_id' => $libro_id, 'tipo_libro_id' => $tipo_libro_id), DB_BIB);
    return $request;
  }

  // Funciones update

  public function updateFoto(string $autores_imagen, int $autores_id)
  {
    $sql = 'UPDATE autores SET autores_imagen = :autores_imagen
    WHERE autores_id = :autores_id';
    $request = $this->update($sql, array('autores_imagen' => $autores_imagen, 'autores_id' => $autores_id), DB_BIB);
    return $request;
  }

  public function updateFotoLibro(string $libro_imagen, int $libro_id)
  {
    $sql = 'UPDATE libro SET libro_imagen = :libro_imagen
    WHERE libro_id = :libro_id';
    $request = $this->update($sql, array('libro_imagen' => $libro_imagen, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function updateAutores(string $autores_nombre, string $autores_descripcion, int $autores_estado, int $autores_id)
  {
    $sql = 'UPDATE autores SET autores_nombre = :autores_nombre, autores_descripcion = :autores_descripcion, autores_estado = :autores_estado
    WHERE autores_id = :autores_id';
    $arrData = array(
      'autores_nombre' => $autores_nombre,
      'autores_descripcion' => $autores_descripcion,
      'autores_estado' => $autores_estado,
      'autores_id' => $autores_id
    );
    $request = $this->update($sql, $arrData, DB_BIB);
    return $request;
  }

  public function updateEditoriales(string $editoriales_nombre, string $editoriales_descripcion, int $editoriales_estado, int $editoriales_id)
  {
    $sql = 'UPDATE editoriales SET editoriales_nombre = :editoriales_nombre, editoriales_descripcion = :editoriales_descripcion, editoriales_estado = :editoriales_estado
    WHERE editoriales_id = :editoriales_id';
    $arrData = array(
      'editoriales_nombre' => $editoriales_nombre,
      'editoriales_descripcion' => $editoriales_descripcion,
      'editoriales_estado' => $editoriales_estado,
      'editoriales_id' => $editoriales_id
    );
    $request = $this->update($sql, $arrData, DB_BIB);
    return $request;
  }

  public function updateLibro(string $libro_titulo, $libro_resumen, int $libro_paginas, $libro_isbn, $libro_edision, int $libro_volumen, $libro_peso, int $categorias_id, int $libro_estado, int $libro_id)
  {
    $sql = 'UPDATE libro SET libro_titulo = :libro_titulo, libro_resumen = :libro_resumen, libro_paginas = :libro_paginas, libro_isbn = :libro_isbn, libro_edision = :libro_edision, libro_volumen = :libro_volumen, libro_peso = :libro_peso, categorias_id = :categorias_id, libro_estado = :libro_estado
    WHERE libro_id = :libro_id';
    $arrData = array(
      'libro_titulo' => $libro_titulo,
      'libro_resumen' => $libro_resumen,
      'libro_paginas' => $libro_paginas,
      'libro_isbn' => $libro_isbn,
      'libro_edision' => $libro_edision,
      'libro_volumen' => $libro_volumen,
      'libro_peso' => $libro_peso,
      'categorias_id' => $categorias_id,
      'libro_estado' => $libro_estado,
      'libro_id' => $libro_id
    );
    $request = $this->update($sql, $arrData, DB_BIB);
    return $request;
  }

  // Funciones delete

  public function deleteAutores(int $autores_id)
  {
    $sql = 'DELETE FROM autores WHERE autores_id = :autores_id';
    $request = $this->delete($sql, array('autores_id' => $autores_id), DB_BIB);
    return $request;
  }

  public function deleteEditoriales(int $editoriales_id)
  {
    $sql = 'DELETE FROM editoriales WHERE editoriales_id = :editoriales_id';
    $request = $this->delete($sql, array('editoriales_id' => $editoriales_id), DB_BIB);
    return $request;
  }

  public function deleteDetalleTipoLibroById(int $libro_id)
  {
    $sql = 'DELETE FROM detalle_tipolibro WHERE libro_id = :libro_id';
    $request = $this->delete($sql, array('libro_id' => $libro_id), DB_BIB);
    return $request;
  }
}
