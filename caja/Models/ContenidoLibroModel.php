<?php
class ContenidoLibroModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }

  // Funciones select_all

  public function selectTerminologiasConcepto()
  {
    $sql = 'SELECT * FROM terminologias
    ORDER BY terminologias_nombre ASC';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function getDataPaginas()
  {
    $sql = 'SELECT * FROM paginas
    ORDER BY paginas_numero ASC';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectParrafos()
  {
    $sql = 'SELECT * FROM parrafos
    ORDER BY parrafos_orden ASC';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectTitulos(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_niveles
    INNER JOIN libro ON detalle_niveles.libro_id = libro.libro_id
    INNER JOIN niveles ON detalle_niveles.niveles_id = niveles.niveles_id
    WHERE detalle_niveles.libro_id = :libro_id
    ORDER BY niveles.niveles_orden ASC, detalle_niveles.detalle_niveles_orden ASC';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectConocimientosTitulos(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_conocimiento
    INNER JOIN detalle_niveles ON detalle_conocimiento.detalle_niveles_id = detalle_niveles.detalle_niveles_id
    INNER JOIN parrafos ON detalle_conocimiento.parrafos_id = parrafos.parrafos_id
    INNER JOIN conocimiento ON detalle_conocimiento.conocimiento_id = conocimiento.conocimiento_id
    -- LEFT JOIN terminologias ON detalle_conocimiento.terminologias_id = terminologias.terminologias_id
    WHERE detalle_niveles.libro_id = :libro_id
    ORDER BY detalle_niveles.niveles_id ASC, parrafos.parrafos_orden ASC, detalle_conocimiento.detalle_conocimiento_orden ASC';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectTitulosLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_niveles
    INNER JOIN niveles ON detalle_niveles.niveles_id = niveles.niveles_id
    WHERE detalle_niveles.libro_id = :libro_id
    ORDER BY niveles.niveles_orden ASC, detalle_niveles.detalle_niveles_orden ASC';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
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

    $sql = 'SELECT * FROM autores ' . $where;
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

    $sql = 'SELECT * FROM editoriales ' . $where;
    $result = $this->select_all($sql, $array, DB_BIB);
    return $result;
  }

  public function selectKeywords()
  {
    $sql = 'SELECT * FROM keywords';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectMaterias()
  {
    $sql = 'SELECT * FROM materias';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectNiveles()
  {
    $sql = 'SELECT * FROM niveles';
    $result = $this->select_all($sql, array(), DB_BIB);
    return $result;
  }

  public function selectDetalleTipoLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_tipolibro
    INNER JOIN tipo_libro ON detalle_tipolibro.tipo_libro_id = tipo_libro.tipo_libro_id
    WHERE libro_id = :libro_id';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectKeywordLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_keywords
    INNER JOIN keywords ON detalle_keywords.keywords_id = keywords.keywords_id
    WHERE libro_id = :libro_id';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectMateriaLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_materias
    INNER JOIN materias ON detalle_materias.materias_id = materias.materias_id
    WHERE libro_id = :libro_id';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectAutoresLibroById(int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_autor
    INNER JOIN autores ON detalle_autor.autores_id = autores.autores_id
    WHERE libro_id = :libro_id';
    $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  // Funciones select

  public function getPagina(int $paginas_id)
  {
    $sql = 'SELECT * FROM paginas
    WHERE paginas_id = :paginas_id';
    $result = $this->select($sql, array('paginas_id' => $paginas_id), DB_BIB);
    return $result;
  }

  public function selectDetalleAutoresById(int $autores_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_autor
    WHERE autores_id = :autores_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('autores_id' => $autores_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectDetalleKeywordsById(int $keywords_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_keywords
    WHERE keywords_id = :keywords_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('keywords_id' => $keywords_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectDetalleMateriasById(int $materias_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_materias
    WHERE materias_id = :materias_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('materias_id' => $materias_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectAutorLibroVinculadoById(int $detalle_autor_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_autor
    WHERE detalle_autor_id = :detalle_autor_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('detalle_autor_id' => $detalle_autor_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectKeywordsLibroVinculadoById(int $detalle_keywords_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_keywords
    WHERE detalle_keywords_id = :detalle_keywords_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('detalle_keywords_id' => $detalle_keywords_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectMateriasLibroVinculadoById(int $detalle_materias_id, $libro_id)
  {
    $sql = 'SELECT * FROM detalle_materias
    WHERE detalle_materias_id = :detalle_materias_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('detalle_materias_id' => $detalle_materias_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectDetalleConocimiento(int $detalle_niveles_id, int $parrafos_id)
  {
    $sql = 'SELECT MAX(detalle_conocimiento_orden) AS max_orden FROM detalle_conocimiento
    WHERE detalle_niveles_id = :detalle_niveles_id AND parrafos_id = :parrafos_id';
    $result = $this->select($sql, array('detalle_niveles_id' => $detalle_niveles_id, 'parrafos_id' => $parrafos_id), DB_BIB);
    return $result;
  }

  public function selectTituloByNombre(int $libro_id,  string $detalle_niveles_titulo)
  {
    $sql = 'SELECT * FROM detalle_niveles
    WHERE libro_id = :libro_id AND detalle_niveles_titulo = :detalle_niveles_titulo';
    $result = $this->select($sql, array('libro_id' => $libro_id, 'detalle_niveles_titulo' => $detalle_niveles_titulo), DB_BIB);
    return $result;
  }

  public function selectDetalleByTitulo(string $detalle_niveles_titulo)
  {
    $sql = 'SELECT * FROM detalle_niveles
    WHERE detalle_niveles_titulo = :detalle_niveles_titulo';
    $result = $this->select($sql, array('detalle_niveles_titulo' => $detalle_niveles_titulo), DB_BIB);
    return $result;
  }

  public function selectAutoresById(int $autores_id)
  {
    $sql = 'SELECT * FROM autores
    WHERE autores_id = :autores_id';
    $result = $this->select($sql, array('autores_id' => $autores_id), DB_BIB);
    return $result;
  }

  public function selectKeywordsById(int $keywords_id)
  {
    $sql = 'SELECT * FROM keywords
    WHERE keywords_id = :keywords_id';
    $result = $this->select($sql, array('keywords_id' => $keywords_id), DB_BIB);
    return $result;
  }

  public function selectMateriasById(int $materias_id)
  {
    $sql = 'SELECT * FROM materias
    WHERE materias_id = :materias_id';
    $result = $this->select($sql, array('materias_id' => $materias_id), DB_BIB);
    return $result;
  }

  public function selectEditorialesById(int $editoriales_id)
  {
    $sql = 'SELECT * FROM editoriales
    WHERE editoriales_id = :editoriales_id';
    $result = $this->select($sql, array('editoriales_id' => $editoriales_id), DB_BIB);
    return $result;
  }

  public function selectNivelesById(int $niveles_id)
  {
    $sql = 'SELECT * FROM niveles
    WHERE niveles_id = :niveles_id';
    $result = $this->select($sql, array('niveles_id' => $niveles_id), DB_BIB);
    return $result;
  }

  public function selectParrafoById(int $parrafos_id)
  {
    $sql = 'SELECT * FROM parrafos
    WHERE parrafos_id = :parrafos_id';
    $result = $this->select($sql, array('parrafos_id' => $parrafos_id), DB_BIB);
    return $result;
  }

  public function selectParrafoByOrden(int $detalle_niveles_id, int $parrafos_orden)
  {
    $sql = 'SELECT * FROM detalle_conocimiento
    INNER JOIN parrafos ON detalle_conocimiento.parrafos_id = parrafos.parrafos_id
    WHERE detalle_conocimiento.detalle_niveles_id = :detalle_niveles_id AND parrafos.parrafos_orden = :parrafos_orden';
    $result = $this->select($sql, array('detalle_niveles_id' => $detalle_niveles_id, 'parrafos_orden' => $parrafos_orden), DB_BIB);
    return $result;
  }

  public function selectTerminologiasById(int $terminologias_id)
  {
    $sql = 'SELECT * FROM terminologias
    WHERE terminologias_id = :terminologias_id';
    $result = $this->select($sql, array('terminologias_id' => $terminologias_id), DB_BIB);
    return $result;
  }

  public function selectMaxOrdenTituloById(int $libro_id, int $niveles_id)
  {
    $sql = 'SELECT MAX(detalle_niveles_orden) as orden FROM detalle_niveles
    WHERE libro_id = :libro_id AND niveles_id = :niveles_id';
    $result = $this->select($sql, array('libro_id' => $libro_id, 'niveles_id' => $niveles_id), DB_BIB);
    return $result;
  }

  public function selectMaxOrdenTituloDependenciaById(int $detalle_niveles_dependencia, int $niveles_id)
  {
    $sql = 'SELECT MAX(detalle_niveles_orden) as orden FROM detalle_niveles
    WHERE detalle_niveles_dependencia = :detalle_niveles_dependencia AND niveles_id = :niveles_id';
    $result = $this->select($sql, array('detalle_niveles_dependencia' => $detalle_niveles_dependencia, 'niveles_id' => $niveles_id), DB_BIB);
    return $result;
  }

  public function selectDetalleNivelesById(int $detalle_niveles_id, int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_niveles
    INNER JOIN niveles ON detalle_niveles.niveles_id = niveles.niveles_id
    WHERE detalle_niveles_id = :detalle_niveles_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('detalle_niveles_id' => $detalle_niveles_id, 'libro_id' => $libro_id), DB_BIB);
    return $result;
  }

  public function selectDetalleTituloById(int $detalle_niveles_id, int $libro_id)
  {
    $sql = 'SELECT * FROM detalle_niveles
    WHERE detalle_niveles_id = :detalle_niveles_id AND libro_id = :libro_id';
    $result = $this->select($sql, array('detalle_niveles_id' => $detalle_niveles_id, 'libro_id' => $libro_id), DB_BIB);
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

  public function insertTituloLibro(int $libro_id, int $paginas_id, int $niveles_id, int $detalle_niveles_orden, $detalle_niveles_dependencia, string $detalle_niveles_titulo)
  {
    $sql = 'INSERT INTO detalle_niveles (libro_id, paginas_id, niveles_id, detalle_niveles_orden, detalle_niveles_dependencia, detalle_niveles_titulo) VALUES (:libro_id, :paginas_id, :niveles_id, :detalle_niveles_orden, :detalle_niveles_dependencia, :detalle_niveles_titulo)';
    $parameter = array(
      'libro_id' => $libro_id,
      'paginas_id' => $paginas_id,
      'niveles_id' => $niveles_id,
      'detalle_niveles_orden' => $detalle_niveles_orden,
      'detalle_niveles_dependencia' => $detalle_niveles_dependencia,
      'detalle_niveles_titulo' => $detalle_niveles_titulo
    );
    $request = $this->insert($sql, $parameter, DB_BIB);
    return $request;
  }

  public function insertDetalleAutor(int $autores_id, int $libro_id)
  {
    $sql = 'INSERT INTO detalle_autor (autores_id, libro_id) VALUES (:autores_id, :libro_id)';
    $request = $this->insert($sql, array('autores_id' => $autores_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function insertDetalleKeywords(int $keywords_id, int $libro_id)
  {
    $sql = 'INSERT INTO detalle_keywords (keywords_id, libro_id) VALUES (:keywords_id, :libro_id)';
    $request = $this->insert($sql, array('keywords_id' => $keywords_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function insertDetalleMaterias(int $materias_id, int $libro_id)
  {
    $sql = 'INSERT INTO detalle_materias (materias_id, libro_id) VALUES (:materias_id, :libro_id)';
    $request = $this->insert($sql, array('materias_id' => $materias_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function insertConcepto(string $conocimiento_descripcion)
  {
    $sql = 'INSERT INTO conocimiento (conocimiento_descripcion) VALUES (:conocimiento_descripcion)';
    $request = $this->insert($sql, array('conocimiento_descripcion' => $conocimiento_descripcion), DB_BIB);
    return $request;
  }
  public function insertDetalleTerminologiaCon($terminologias_id, string $conocimiento_id)
  {
    $sql = 'INSERT INTO detalle_terminologia_conocimiento (terminologias_id,conocimiento_id) VALUES (:terminologias_id, :conocimiento_id)';
    $request = $this->insert($sql, array('terminologias_id' => $terminologias_id, 'conocimiento_id' => $conocimiento_id), DB_BIB);
    return $request;
  }

  public function insertConceptoTitulo(int $detalle_niveles_id, int $detalle_conocimiento_orden, int $parrafos_id, int $conocimiento_id)
  {
    $sql = 'INSERT INTO detalle_conocimiento (detalle_niveles_id, detalle_conocimiento_orden, parrafos_id, conocimiento_id) VALUES (:detalle_niveles_id, :detalle_conocimiento_orden, :parrafos_id, :conocimiento_id)';
    $request = $this->insert($sql, array(
      'detalle_niveles_id' => $detalle_niveles_id,
      'detalle_conocimiento_orden' => $detalle_conocimiento_orden,
      'parrafos_id' => $parrafos_id,
      'conocimiento_id' => $conocimiento_id
    ), DB_BIB);
    return $request;
  }

  // Funciones update

  public function updateLibroEditorialById(int $libro_id, $editoriales_id)
  {
    $sql = 'UPDATE libro SET editoriales_id = :editoriales_id WHERE libro_id = :libro_id';
    $request = $this->delete($sql, array('libro_id' => $libro_id, 'editoriales_id' => $editoriales_id), DB_BIB);
    return $request;
  }

  public function updateLibroTitulo(int $detalle_niveles_id, string $detalle_niveles_titulo)
  {
    $sql = 'UPDATE detalle_niveles SET detalle_niveles_titulo = :detalle_niveles_titulo WHERE detalle_niveles_id = :detalle_niveles_id';
    $request = $this->delete($sql, array('detalle_niveles_titulo' => $detalle_niveles_titulo, 'detalle_niveles_id' => $detalle_niveles_id), DB_BIB);
    return $request;
  }

  // Funciones delete

  public function deleteDetalleAutorVinculado(int $detalle_autor_id, int $libro_id)
  {
    $sql = 'DELETE FROM detalle_autor WHERE detalle_autor_id = :detalle_autor_id AND libro_id = :libro_id';
    $request = $this->delete($sql, array('detalle_autor_id' => $detalle_autor_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function deleteDetalleKeywordsVinculado(int $detalle_keywords_id, int $libro_id)
  {
    $sql = 'DELETE FROM detalle_keywords WHERE detalle_keywords_id = :detalle_keywords_id AND libro_id = :libro_id';
    $request = $this->delete($sql, array('detalle_keywords_id' => $detalle_keywords_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }

  public function deleteDetalleMateriasVinculado(int $detalle_materias_id, int $libro_id)
  {
    $sql = 'DELETE FROM detalle_materias WHERE detalle_materias_id = :detalle_materias_id AND libro_id = :libro_id';
    $request = $this->delete($sql, array('detalle_materias_id' => $detalle_materias_id, 'libro_id' => $libro_id), DB_BIB);
    return $request;
  }
}
