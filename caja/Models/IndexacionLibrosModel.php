<?php
class IndexacionLibrosModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }

  // Funciones select_all
  public function selectsParrafos()
  {
    $sql = 'SELECT * FROM parrafos';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsKeywords()
  {
    $sql = 'SELECT * FROM keywords';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsMaterias()
  {
    $sql = 'SELECT * FROM materias';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsCategorias()
  {
    $sql = 'SELECT * FROM categorias';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsNiveles()
  {
    $sql = 'SELECT * FROM niveles';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsTerminologias(int $terminologias_orden = 1)
  {
    $restriccion = '';
    if ($terminologias_orden == 1) {
      $restriccion = 'WHERE terminologias_orden = :terminologias_orden';
    }

    $sql = 'SELECT * FROM terminologias ' . $restriccion;

    if ($terminologias_orden == 1) {
      $arrData = array('terminologias_orden' => $terminologias_orden);
    } else {
      $arrData = array();
    }

    $result = $this->select_all($sql, $arrData, DB_BIB);
    return $result;
  }

  public function selectTerminologiasByOrder()
  {
    $sql = 'SELECT * FROM terminologias
    ORDER BY terminologias_orden ASC, terminologias_nombre ASC';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectsTerminologiasByDependencia(int $terminologias_dependencia)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_dependencia = :terminologias_dependencia';
    $result = $this->select_all($sql, array('terminologias_dependencia' => $terminologias_dependencia), DB_BIB);
    return $result;
  }

  // Funciones select

  public function selectsDependenciaTermminologiaById(int $terminologias_dependencia)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_dependencia = :terminologias_dependencia';
    $result = $this->select($sql, array('terminologias_dependencia' => $terminologias_dependencia), DB_BIB);
    return $result;
  }

  public function existeDependencia(int $terminologias_dependencia, int $terminologias_id)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_id = :terminologias_id AND terminologias_dependencia = :terminologias_dependencia';
    $result = $this->select($sql, array('terminologias_id' => $terminologias_id, 'terminologias_dependencia' => $terminologias_dependencia), DB_BIB);
    return $result;
  }

  public function selectsParrafoConocimiento(int $parrafos_id)
  {
    $sql = 'SELECT * FROM detalle_conocimiento
    WHERE parrafos_id = :parrafos_id';
    $result = $this->select($sql, array('parrafos_id' => $parrafos_id), DB_BIB);
    return $result;
  }

  public function selectsDetalleKeywords(int $keywords_id)
  {
    $sql = 'SELECT * FROM detalle_keywords
    WHERE keywords_id = :keywords_id';
    $result = $this->select($sql, array('keywords_id' => $keywords_id), DB_BIB);
    return $result;
  }

  public function selectsDetalleMateria(int $materias_id)
  {
    $sql = 'SELECT * FROM detalle_materias
    WHERE materias_id = :materias_id';
    $result = $this->select($sql, array('materias_id' => $materias_id), DB_BIB);
    return $result;
  }

  public function selectCategoriaLibro(int $categorias_id)
  {
    $sql = 'SELECT * FROM libro
    WHERE categorias_id = :categorias_id';
    $result = $this->select($sql, array('categorias_id' => $categorias_id), DB_BIB);
    return $result;
  }

  public function selectNivelesLibro(int $niveles_id)
  {
    $sql = 'SELECT * FROM detalle_niveles
    WHERE niveles_id = :niveles_id';
    $result = $this->select($sql, array('niveles_id' => $niveles_id), DB_BIB);
    return $result;
  }

  public function selectTerminologiaConocimiento(int $terminologias_id)
  {
    $sql = 'SELECT * FROM detalle_terminologia_conocimiento
    WHERE terminologias_id = :terminologias_id';
    $result = $this->select($sql, array('terminologias_id' => $terminologias_id), DB_BIB);
    return $result;
  }

  public function selectParrafoByNombre(string $parrafos_descripcion)
  {
    $sql = 'SELECT * FROM parrafos
    WHERE parrafos_descripcion = :parrafos_descripcion';
    $result = $this->select($sql, array('parrafos_descripcion' => $parrafos_descripcion), DB_BIB);
    return $result;
  }

  public function selectKeywordsByNombre(string $keywords_nombre)
  {
    $sql = 'SELECT * FROM keywords
    WHERE keywords_nombre = :keywords_nombre';
    $result = $this->select($sql, array('keywords_nombre' => $keywords_nombre), DB_BIB);
    return $result;
  }

  public function selectMateriaByNombre(string $materias_nombre)
  {
    $sql = 'SELECT * FROM materias
    WHERE materias_nombre = :materias_nombre';
    $result = $this->select($sql, array('materias_nombre' => $materias_nombre), DB_BIB);
    return $result;
  }

  public function selectCategoriaByNombre(string $categorias_nombre)
  {
    $sql = 'SELECT * FROM categorias
    WHERE categorias_nombre = :categorias_nombre';
    $result = $this->select($sql, array('categorias_nombre' => $categorias_nombre), DB_BIB);
    return $result;
  }

  public function selectNivelesByNombre(string $niveles_descripcion)
  {
    $sql = 'SELECT * FROM niveles
    WHERE niveles_descripcion = :niveles_descripcion';
    $result = $this->select($sql, array('niveles_descripcion' => $niveles_descripcion), DB_BIB);
    return $result;
  }

  public function selectTerminologiaByNombre(string $terminologias_nombre)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_nombre = :terminologias_nombre';
    $result = $this->select($sql, array('terminologias_nombre' => $terminologias_nombre), DB_BIB);
    return $result;
  }

  public function selectParrafoByOrden(int $parrafos_orden)
  {
    $sql = 'SELECT * FROM parrafos
    WHERE parrafos_orden = :parrafos_orden';
    $result = $this->select($sql, array('parrafos_orden' => $parrafos_orden), DB_BIB);
    return $result;
  }

  public function selectNivelesByOrden(int $niveles_orden)
  {
    $sql = 'SELECT * FROM niveles
    WHERE niveles_orden = :niveles_orden';
    $result = $this->select($sql, array('niveles_orden' => $niveles_orden), DB_BIB);
    return $result;
  }

  public function selectParrafoById(int $parrafos_id)
  {
    $sql = 'SELECT * FROM parrafos
    WHERE parrafos_id = :parrafos_id';
    $result = $this->select($sql, array('parrafos_id' => $parrafos_id), DB_BIB);
    return $result;
  }

  public function selectKeywordsById(int $keywords_id)
  {
    $sql = 'SELECT * FROM keywords
    WHERE keywords_id = :keywords_id';
    $result = $this->select($sql, array('keywords_id' => $keywords_id), DB_BIB);
    return $result;
  }

  public function selectMateriaById(int $materias_id)
  {
    $sql = 'SELECT * FROM materias
    WHERE materias_id = :materias_id';
    $result = $this->select($sql, array('materias_id' => $materias_id), DB_BIB);
    return $result;
  }

  public function selectCategoriaById(int $categorias_id)
  {
    $sql = 'SELECT * FROM categorias
    WHERE categorias_id = :categorias_id';
    $result = $this->select($sql, array('categorias_id' => $categorias_id), DB_BIB);
    return $result;
  }

  public function selectNivelesById(int $niveles_id)
  {
    $sql = 'SELECT * FROM niveles
    WHERE niveles_id = :niveles_id';
    $result = $this->select($sql, array('niveles_id' => $niveles_id), DB_BIB);
    return $result;
  }

  public function selectTerminologiaById(int $terminologias_id)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_id = :terminologias_id';
    $result = $this->select($sql, array('terminologias_id' => $terminologias_id), DB_BIB);
    return $result;
  }

  // Funciones insert
  public function insertParrafo(string $parrafos_descripcion, int $parrafos_orden)
  {
    $sql = 'INSERT INTO parrafos (parrafos_descripcion, parrafos_orden) VALUES (:parrafos_descripcion, :parrafos_orden)';
    $request = $this->insert($sql, array('parrafos_descripcion' => $parrafos_descripcion, 'parrafos_orden' => $parrafos_orden), DB_BIB);
    return $request;
  }

  public function insertKeywords(string $keywords_nombre, string $keywords_descripcion)
  {
    $sql = 'INSERT INTO keywords (keywords_nombre, keywords_descripcion) VALUES (:keywords_nombre, :keywords_descripcion)';
    $request = $this->insert($sql, array('keywords_nombre' => $keywords_nombre, 'keywords_descripcion' => $keywords_descripcion), DB_BIB);
    return $request;
  }

  public function insertMateria(string $materias_nombre)
  {
    $sql = 'INSERT INTO materias (materias_nombre) VALUES (:materias_nombre)';
    $request = $this->insert($sql, array('materias_nombre' => $materias_nombre), DB_BIB);
    return $request;
  }

  public function insertCategoria(string $categorias_nombre, string $categorias_descripcion)
  {
    $sql = 'INSERT INTO categorias (categorias_nombre, categorias_descripcion) VALUES (:categorias_nombre, :categorias_descripcion)';
    $request = $this->insert($sql, array('categorias_nombre' => $categorias_nombre, 'categorias_descripcion' => $categorias_descripcion), DB_BIB);
    return $request;
  }

  public function insertNiveles(string $niveles_descripcion, int $niveles_orden)
  {
    $sql = 'INSERT INTO niveles (niveles_descripcion, niveles_orden) VALUES (:niveles_descripcion, :niveles_orden)';
    $request = $this->insert($sql, array('niveles_descripcion' => $niveles_descripcion, 'niveles_orden' => $niveles_orden), DB_BIB);
    return $request;
  }

  public function insertTerminologia(string $terminologias_nombre, string $terminologias_descripcion, int $terminologias_orden, $terminologias_dependencia)
  {
    $sql = 'INSERT INTO terminologias (terminologias_nombre, terminologias_descripcion, terminologias_orden, terminologias_dependencia) VALUES (:terminologias_nombre, :terminologias_descripcion, :terminologias_orden, :terminologias_dependencia)';
    $arrData = array(
      'terminologias_nombre' => $terminologias_nombre,
      'terminologias_descripcion' => $terminologias_descripcion,
      'terminologias_orden' => $terminologias_orden,
      'terminologias_dependencia' => $terminologias_dependencia
    );
    $request = $this->insert($sql, $arrData, DB_BIB);
    return $request;
  }

  // Funciones update
  public function updateParrafo(string $parrafos_descripcion, int $parrafos_orden, int $parrafos_id)
  {
    $sql = 'UPDATE parrafos SET parrafos_descripcion = :parrafos_descripcion,parrafos_orden = :parrafos_orden  WHERE  parrafos_id = :parrafos_id';
    $request = $this->update($sql, array('parrafos_descripcion' => $parrafos_descripcion, 'parrafos_orden' => $parrafos_orden, 'parrafos_id' => $parrafos_id), DB_BIB);
    return $request;
  }

  public function updateKeywords(string $keywords_nombre, string $keywords_descripcion, int $keywords_id)
  {
    $sql = 'UPDATE keywords SET keywords_nombre = :keywords_nombre,keywords_descripcion = :keywords_descripcion  WHERE  keywords_id = :keywords_id';
    $request = $this->update($sql, array('keywords_nombre' => $keywords_nombre, 'keywords_descripcion' => $keywords_descripcion, 'keywords_id' => $keywords_id), DB_BIB);
    return $request;
  }

  public function updateMateria(string $materias_nombre, int $materias_id)
  {
    $sql = 'UPDATE materias SET materias_nombre = :materias_nombre
    WHERE  materias_id = :materias_id';
    $request = $this->update($sql, array('materias_nombre' => $materias_nombre, 'materias_id' => $materias_id), DB_BIB);
    return $request;
  }

  public function updateCategoria(string $categorias_nombre, string $categorias_descripcion, int $categorias_estado,  int $categorias_id)
  {
    $sql = 'UPDATE categorias SET categorias_nombre = :categorias_nombre, categorias_descripcion = :categorias_descripcion, categorias_estado = :categorias_estado
    WHERE  categorias_id = :categorias_id';

    $arrData = array(
      'categorias_nombre' => $categorias_nombre,
      'categorias_descripcion' => $categorias_descripcion,
      'categorias_estado' => $categorias_estado,
      'categorias_id' => $categorias_id
    );
    $request = $this->update($sql, $arrData, DB_BIB);
    return $request;
  }

  public function updateNivel(string $niveles_descripcion, int $niveles_orden, int $niveles_id)
  {
    $sql = 'UPDATE niveles SET niveles_descripcion = :niveles_descripcion,niveles_orden = :niveles_orden  WHERE  niveles_id = :niveles_id';
    $request = $this->update($sql, array('niveles_descripcion' => $niveles_descripcion, 'niveles_orden' => $niveles_orden, 'niveles_id' => $niveles_id), DB_BIB);
    return $request;
  }

  public function updateTerminologia(string $terminologias_nombre, string $terminologias_descripcion, int $terminologias_orden, $terminologias_dependencia, int $terminologias_id)
  {
    $sql = 'UPDATE terminologias SET terminologias_nombre = :terminologias_nombre, terminologias_descripcion = :terminologias_descripcion, terminologias_orden = :terminologias_orden, terminologias_dependencia = :terminologias_dependencia WHERE  terminologias_id = :terminologias_id';
    $request = $this->update($sql, array('terminologias_nombre' => $terminologias_nombre, 'terminologias_descripcion' => $terminologias_descripcion, 'terminologias_orden' => $terminologias_orden, 'terminologias_dependencia' => $terminologias_dependencia, 'terminologias_id' => $terminologias_id), DB_BIB);
    return $request;
  }

  public function updateDependencia($terminologias_dependencia, int $terminologias_orden, int $terminologias_id)
  {
    $sql = 'UPDATE terminologias SET terminologias_dependencia = :terminologias_dependencia, terminologias_orden = :terminologias_orden  WHERE  terminologias_id = :terminologias_id';
    $request = $this->update($sql, array('terminologias_dependencia' => $terminologias_dependencia, 'terminologias_orden' => $terminologias_orden, 'terminologias_id' => $terminologias_id), DB_BIB);
    return $request;
  }

  // Funciones delete
  public function deleteParrafo(int $parrafos_id)
  {
    $sql = 'DELETE FROM parrafos WHERE parrafos_id = :parrafos_id';
    $request = $this->delete($sql, array('parrafos_id' => $parrafos_id), DB_BIB);
    return $request;
  }

  public function deleteKeywords(int $keywords_id)
  {
    $sql = 'DELETE FROM keywords WHERE keywords_id = :keywords_id';
    $request = $this->delete($sql, array('keywords_id' => $keywords_id), DB_BIB);
    return $request;
  }

  public function deleteMateria(int $materias_id)
  {
    $sql = 'DELETE FROM materias WHERE materias_id = :materias_id';
    $request = $this->delete($sql, array('materias_id' => $materias_id), DB_BIB);
    return $request;
  }

  public function deleteCategoria(int $categorias_id)
  {
    $sql = 'DELETE FROM categorias WHERE categorias_id = :categorias_id';
    $request = $this->delete($sql, array('categorias_id' => $categorias_id), DB_BIB);
    return $request;
  }

  public function deleteNiveles(int $niveles_id)
  {
    $sql = 'DELETE FROM niveles WHERE niveles_id = :niveles_id';
    $request = $this->delete($sql, array('niveles_id' => $niveles_id), DB_BIB);
    return $request;
  }

  public function deleteTerminologia(int $terminologias_id)
  {
    $sql = 'DELETE FROM terminologias WHERE terminologias_id = :terminologias_id';
    $request = $this->delete($sql, array('terminologias_id' => $terminologias_id), DB_BIB);
    return $request;
  }
}
