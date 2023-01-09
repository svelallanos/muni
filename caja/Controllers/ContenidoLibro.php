<?php

class ContenidoLibro extends Controllers
{
  public function __construct($session = true)
  {
    if ($session) {
      parent::__construct();
    }
  }

  public function contenido()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET) || !isset($_GET['libro_id']) || intval($_GET['libro_id']) === 0) {
      location('ConfiguracionLibros/libros');
    }

    $datos_libro = $this->model->selectLibroById($_GET['libro_id']);
    if (!$datos_libro) {
      location('ConfiguracionLibros/libros');
    }

    $auxTipoLibro = null;
    $seleccionar_tipodetalle = $this->model->selectDetalleTipoLibroById($datos_libro['libro_id']);
    // json($seleccionar_tipodetalle);
    foreach ($seleccionar_tipodetalle as $key => $value) {
      $auxTipoLibro .= '<span class="fw-bold badge bg-light text-blue border mr-2i border-blue">' . $value['tipo_libro_nombre'] . '</span>';
    }

    $editorial = 'Vacío';
    if (intval($datos_libro['editoriales_id']) !== 0) {
      $select_editorial = $this->model->selectEditorialesById($datos_libro['editoriales_id']);
      if ($select_editorial) {
        $editorial = $select_editorial['editoriales_nombre'];
      }
    }

    $data['page_id'] = 22;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Agregar contenido al libro";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "contenidolibros/functions_contenido";
    $data['data-libro'] = $datos_libro;
    $data['data-tipo'] = $auxTipoLibro;
    $data['data-keywords'] = $this->model->selectKeywordLibroById($datos_libro['libro_id']);
    $data['data-materias'] = $this->model->selectMateriaLibroById($datos_libro['libro_id']);
    $data['data-autores'] = $this->model->selectAutoresLibroById($datos_libro['libro_id']);
    $data['data-niveles'] = $this->model->selectNiveles();
    $data['data-editorial'] = $editorial;
    $data['data-paginas'] = $this->model->getDataPaginas();
    $data['data-tablacontenidos'] = $this->tablaContenidos($datos_libro['libro_id']);
    $this->views->getView($this, "contenido", $data);
  }

  public function agregarConceptos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(20, true);

    $datos_libro = $this->model->selectLibroById($_GET['libro_id']);
    if (!$datos_libro) {
      location('ConfiguracionLibros/libros');
    }

    $data['page_id'] = 23;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Agregar concepto a los títulos";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "contenidolibros/functions_conceptos";
    $data['data-libro'] = $datos_libro;
    $data['data-parrafos'] = $this->model->selectParrafos();
    $data['data-tablacontenidos'] = $this->tablaContenidos($datos_libro['libro_id']);
    $data['data-conceptostitulos'] = $this->selectConceptoTitulos($datos_libro['libro_id']);

    $this->views->getView($this, "agregar_concepto", $data);
  }

  public function tablaContenidos(int $libro_id = 0, $verificarLogin = true)
  {
    if ($verificarLogin) {
      parent::verificarLogin(true);
    }


    $seleccionar_tabla = $this->model->selectTitulosLibroById($libro_id);

    $tablaContenidos = array();
    $cont1 = -1;
    $cont2 = -1;
    $cont3 = -1;
    $cont4 = -1;
    $cont5 = -1;

    foreach ($seleccionar_tabla as $key_1 => $value_1) {
      if ($value_1['niveles_orden'] == 1) {
        $cont1 = $cont1 + 1;
        $tablaContenidos[$cont1] = array(
          'detalle_niveles_id' => $value_1['detalle_niveles_id'],
          'niveles_id' => $value_1['niveles_id'],
          'libro_id' => $value_1['libro_id'],
          'detalle_niveles_orden' => $value_1['detalle_niveles_orden'],
          'detalle_niveles_dependencia' => $value_1['detalle_niveles_dependencia'],
          'detalle_niveles_titulo' => $value_1['detalle_niveles_titulo'],
          'niveles_orden' => $value_1['niveles_orden'],
          'sub_nivel' => array()
        );

        foreach ($seleccionar_tabla as $key_2 => $value_2) {
          if ($value_2['niveles_orden'] == 2) {
            if ($value_2['detalle_niveles_dependencia'] == $value_1['detalle_niveles_id']) {
              $cont2 = $cont2 + 1;
              $tablaContenidos[$cont1]['sub_nivel'][$cont2] = array(
                'detalle_niveles_id' => $value_2['detalle_niveles_id'],
                'niveles_id' => $value_2['niveles_id'],
                'libro_id' => $value_2['libro_id'],
                'detalle_niveles_orden' => $value_2['detalle_niveles_orden'],
                'detalle_niveles_dependencia' => $value_2['detalle_niveles_dependencia'],
                'detalle_niveles_titulo' => $value_2['detalle_niveles_titulo'],
                'niveles_orden' => $value_2['niveles_orden'],
                'sub_nivel' => array()
              );

              foreach ($seleccionar_tabla as $key_3 => $value_3) {
                if ($value_3['niveles_orden'] == 3) {
                  if ($value_3['detalle_niveles_dependencia'] == $value_2['detalle_niveles_id']) {
                    $cont3 = $cont3 + 1;
                    $tablaContenidos[$cont1]['sub_nivel'][$cont2]['sub_nivel'][$cont3] = array(
                      'detalle_niveles_id' => $value_3['detalle_niveles_id'],
                      'niveles_id' => $value_3['niveles_id'],
                      'libro_id' => $value_3['libro_id'],
                      'detalle_niveles_orden' => $value_3['detalle_niveles_orden'],
                      'detalle_niveles_dependencia' => $value_3['detalle_niveles_dependencia'],
                      'detalle_niveles_titulo' => $value_3['detalle_niveles_titulo'],
                      'niveles_orden' => $value_3['niveles_orden'],
                      'sub_nivel' => array()
                    );

                    foreach ($seleccionar_tabla as $key_4 => $value_4) {
                      if ($value_4['niveles_orden'] == 4) {
                        if ($value_4['detalle_niveles_dependencia'] == $value_3['detalle_niveles_id']) {
                          $cont4 = $cont4 + 1;
                          $tablaContenidos[$cont1]['sub_nivel'][$cont2]['sub_nivel'][$cont3]['sub_nivel'][$cont4] = array(
                            'detalle_niveles_id' => $value_4['detalle_niveles_id'],
                            'niveles_id' => $value_4['niveles_id'],
                            'libro_id' => $value_4['libro_id'],
                            'detalle_niveles_orden' => $value_4['detalle_niveles_orden'],
                            'detalle_niveles_dependencia' => $value_4['detalle_niveles_dependencia'],
                            'detalle_niveles_titulo' => $value_4['detalle_niveles_titulo'],
                            'niveles_orden' => $value_4['niveles_orden'],
                            'sub_nivel' => array()
                          );

                          foreach ($seleccionar_tabla as $key_5 => $value_5) {
                            if ($value_5['niveles_orden'] == 5) {
                              if ($value_5['detalle_niveles_dependencia'] == $value_4['detalle_niveles_id']) {
                                $cont5 = $cont5 + 1;
                                $tablaContenidos[$cont1]['sub_nivel'][$cont2]['sub_nivel'][$cont3]['sub_nivel'][$cont4]['sub_nivel'][$cont5] = array(
                                  'detalle_niveles_id' => $value_5['detalle_niveles_id'],
                                  'niveles_id' => $value_5['niveles_id'],
                                  'libro_id' => $value_5['libro_id'],
                                  'detalle_niveles_orden' => $value_5['detalle_niveles_orden'],
                                  'detalle_niveles_dependencia' => $value_5['detalle_niveles_dependencia'],
                                  'detalle_niveles_titulo' => $value_5['detalle_niveles_titulo'],
                                  'niveles_orden' => $value_5['niveles_orden'],
                                  'sub_nivel' => array()
                                );
                              }
                            }
                          }
                          $cont5 = -1;
                        }
                      }
                    }
                    $cont4 = -1;
                  }
                }
              }
              $cont3 = -1;
            }
          }
        }
        $cont2 = -1;
      }
    }

    return $tablaContenidos;
  }

  // Cargar de tablas
  public function selectTitulos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_titulos = $this->model->selectTitulos($_POST['libro_id']);
    foreach ($seleccionar_titulos as $key => $value) {
      $seleccionar_titulos[$key]['numero'] = ($key + 1);
      $seleccionar_titulos[$key]['detalle_niveles_titulo'] = recortar_cadena($value['detalle_niveles_titulo'], 50);
      $seleccionar_titulos[$key]['niveles_orden'] = '<span class="fw-bold badge bg-light text-primary border border-primary">' . $value['niveles_orden'] . '</span>';
      $seleccionar_titulos[$key]['options'] = '<button data-detalle_niveles_id="' . $value['detalle_niveles_id'] . '" data-detalle_niveles_titulo="' . $value['detalle_niveles_titulo'] . '" title="Seleccionar título" class="__btn_seleccionar_dependencia_titulo btn btn-icon btn-sm btn-success"><i class="fa-regular fa-hand-point-up"></i></button>';
    }
    json($seleccionar_titulos);
  }

  public function selectTitulosControl()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_titulos = $this->model->selectTitulos($_POST['libro_id']);
    foreach ($seleccionar_titulos as $key => $value) {
      $seleccionar_titulos[$key]['numero'] = ($key + 1);
      $seleccionar_titulos[$key]['detalle_niveles_titulo'] = recortar_cadena($value['detalle_niveles_titulo'], 50);
      $seleccionar_titulos[$key]['niveles_orden'] = '<span class="fw-bold badge bg-light text-primary border border-primary">' . $value['niveles_orden'] . '</span>';
      $seleccionar_titulos[$key]['options'] = '
      <button 
      data-detalle_niveles_id="' . $value['detalle_niveles_id'] . '" 
      data-detalle_niveles_titulo="' . $value['detalle_niveles_titulo'] . '" 
      title="Editar título" 
      class="__btn_editar_titulo btn btn-icon btn-sm btn-cyan">
      <i class="fa-solid fa-square-pen"></i>
      </button>
      <button 
      data-detalle_niveles_id="' . $value['detalle_niveles_id'] . '" 
      title="Eliminar título" 
      class="__btn_eliminar_titulo btn btn-icon btn-sm btn-danger">
      <i class="fa-solid fa-eraser"></i>
      </button>';
    }

    json($seleccionar_titulos);
  }

  public function selectTitulosConcepto()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(20, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_titulos = $this->model->selectTitulos($_POST['libro_id']);
    foreach ($seleccionar_titulos as $key => $value) {
      $seleccionar_titulos[$key]['numero'] = ($key + 1);
      $seleccionar_titulos[$key]['detalle_niveles_titulo'] = recortar_cadena($value['detalle_niveles_titulo'], 40);
      $seleccionar_titulos[$key]['niveles_orden'] = '<span class="fw-bold badge bg-light text-primary border border-primary">' . $value['niveles_orden'] . '</span>';
      $seleccionar_titulos[$key]['options'] =
        '<div class="select_titulo">
        <input required title="Seleccione título" style="cursor: pointer;" class="form-check-input" id="detalle_niveles_id_' . $value['detalle_niveles_id'] . '" value="' . $value['detalle_niveles_id'] . '" type="radio" name="detalle_niveles_id">
      </div>
      ';
    }

    json($seleccionar_titulos);
  }

  public function selectConceptoTitulos(int $libro_id, $verificarLogin = true)
  {
    if ($verificarLogin) {
      parent::verificarLogin(true);
    }

    $conocimientos = $this->model->selectConocimientosTitulos($libro_id);
    $auxConocimientoOrdenado = array();
    foreach ($conocimientos as $key => $value) {
      if (!isset($auxConocimientoOrdenado[$value['detalle_niveles_id']])) {
        $auxConocimientoOrdenado[$value['detalle_niveles_id']][0] = array(
          'detalle_conocimiento_id' => $value['detalle_conocimiento_id'],
          'parrafos_orden' => $value['parrafos_orden'],
          'detalle_conocimiento_orden' => $value['detalle_conocimiento_orden'],
          'conocimiento_descripcion' => $value['conocimiento_descripcion']
        );
      } else {
        array_push($auxConocimientoOrdenado[$value['detalle_niveles_id']], array(
          'detalle_conocimiento_id' => $value['detalle_conocimiento_id'],
          'parrafos_orden' => $value['parrafos_orden'],
          'detalle_conocimiento_orden' => $value['detalle_conocimiento_orden'],
          'conocimiento_descripcion' => $value['conocimiento_descripcion']
        ));
      }
    }

    return $auxConocimientoOrdenado;
  }

  public function selectTerminologiasConcepto()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(20, true);

    $seleccionar_terminologias = $this->model->selectTerminologiasConcepto();
    foreach ($seleccionar_terminologias as $key => $value) {
      $seleccionar_terminologias[$key]['numero'] = ($key + 1);
      $seleccionar_terminologias[$key]['terminologias_nombre'] = recortar_cadena($value['terminologias_nombre'], 50);
      $seleccionar_terminologias[$key]['options'] = '
      <div class="form-check">
        <input class="form-check-input check_val" style="cursor: pointer;" value="' . $value['terminologias_id'] . '" name="check_' . $value['terminologias_id'] . '" id="check_' . $value['terminologias_id'] . '" type="checkbox" value="">
      </div>
      ';
    }

    json($seleccionar_terminologias);
  }

  public function selectEditoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $seleccionar_editoriales = $this->model->selectEditoriales(1);
    foreach ($seleccionar_editoriales as $key => $value) {
      $seleccionar_editoriales[$key]['numero'] = ($key + 1);
      $seleccionar_editoriales[$key]['options'] = '<button data-editoriales_id="' . $value['editoriales_id'] . '" title="Agregar" class="__btn_agregar_editoriales btn btn-sm btn-success"><i class="feather-chevrons-right"></i></button>';
    }
    json($seleccionar_editoriales);
  }

  public function selectAutoresDisponibles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_autores = $this->model->selectAutores(1);
    $auxAutoresVinculados = array();
    $seleccionar_libros_autores = $this->model->selectAutoresLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_autores as $key => $value) {
      if (!isset($auxAutoresVinculados[$value['autores_id']])) {
        $auxAutoresVinculados[$value['autores_id']] = 'existe';
      }
    }

    $auxAutoresDisponibles = array();
    $cont = 0;
    foreach ($seleccionar_autores as $key => $value) {
      if (!isset($auxAutoresVinculados[$value['autores_id']])) {
        $auxAutoresDisponibles[$cont++] = $value;
      }
    }

    foreach ($auxAutoresDisponibles as $key => $value) {
      $auxAutoresDisponibles[$key]['numero'] = ($key + 1);
      $auxAutoresDisponibles[$key]['options'] = '<button data-autores_id="' . $value['autores_id'] . '" title="Agregar" class="__btn_agregar_autores btn btn-sm btn-success"><i class="feather-chevrons-right"></i></button>';
    }
    json($auxAutoresDisponibles);
  }

  public function selectAutoresVinculados()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_libros_autores = $this->model->selectAutoresLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_autores as $key => $value) {
      $seleccionar_libros_autores[$key]['numero'] = ($key + 1);
      $seleccionar_libros_autores[$key]['options'] = '<button data-detalle_autor_id="' . $value['detalle_autor_id'] . '" title="Eliminar" class="__btn_eliminar_autores btn btn-sm btn-danger"><i class="feather-trash"></i></button>';
    }
    json($seleccionar_libros_autores);
  }

  public function selectKeyowrdsDisponibles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_keyowrds = $this->model->selectKeywords();
    $auxLibroKeywordsVinculados = array();
    $seleccionar_libros_keywords = $this->model->selectKeywordLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_keywords as $key => $value) {
      if (!isset($auxLibroKeywordsVinculados[$value['keywords_id']])) {
        $auxLibroKeywordsVinculados[$value['keywords_id']] = 'existe';
      }
    }

    $auxKeywordsDisponibles = array();
    $cont = 0;
    foreach ($seleccionar_keyowrds as $key => $value) {
      if (!isset($auxLibroKeywordsVinculados[$value['keywords_id']])) {
        $auxKeywordsDisponibles[$cont++] = $value;
      }
    }

    foreach ($auxKeywordsDisponibles as $key => $value) {
      $auxKeywordsDisponibles[$key]['numero'] = ($key + 1);
      $auxKeywordsDisponibles[$key]['options'] = '<button data-keywords_id="' . $value['keywords_id'] . '" title="Agregar" class="__btn_agregar_keywords btn btn-sm btn-success"><i class="feather-chevrons-right"></i></button>';
    }
    json($auxKeywordsDisponibles);
  }

  public function selectKeywordsVinculados()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_libros_keywords = $this->model->selectKeywordLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_keywords as $key => $value) {
      $seleccionar_libros_keywords[$key]['numero'] = ($key + 1);
      $seleccionar_libros_keywords[$key]['options'] = '<button data-detalle_keywords_id="' . $value['detalle_keywords_id'] . '" title="Eliminar" class="__btn_eliminar_keywords btn btn-sm btn-danger"><i class="feather-trash"></i></button>';
    }

    json($seleccionar_libros_keywords);
  }

  public function selectMateriasDisponibles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_materias = $this->model->selectMaterias();
    $auxLibroMateriasVinculados = array();
    $seleccionar_libros_materias = $this->model->selectMateriaLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_materias as $key => $value) {
      if (!isset($auxLibroMateriasVinculados[$value['materias_id']])) {
        $auxLibroMateriasVinculados[$value['materias_id']] = 'existe';
      }
    }

    $auxMateriasDisponibles = array();
    $cont = 0;
    foreach ($seleccionar_materias as $key => $value) {
      if (!isset($auxLibroMateriasVinculados[$value['materias_id']])) {
        $auxMateriasDisponibles[$cont++] = $value;
      }
    }

    foreach ($auxMateriasDisponibles as $key => $value) {
      $auxMateriasDisponibles[$key]['numero'] = ($key + 1);
      $auxMateriasDisponibles[$key]['options'] = '<button data-materias_id="' . $value['materias_id'] . '" title="Agregar" class="__btn_agregar_materias btn btn-sm btn-success"><i class="feather-chevrons-right"></i></button>';
    }
    json($auxMateriasDisponibles);
  }

  public function selectMateriasVinculados()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    if (!isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json(array());
    }

    $seleccionar_libros_materias = $this->model->selectMateriaLibroById($_POST['libro_id']);
    foreach ($seleccionar_libros_materias as $key => $value) {
      $seleccionar_libros_materias[$key]['numero'] = ($key + 1);
      $seleccionar_libros_materias[$key]['options'] = '<button data-detalle_materias_id="' . $value['detalle_materias_id'] . '" title="Eliminar" class="__btn_eliminar_materias btn btn-sm btn-danger"><i class="feather-trash"></i></button>';
    }

    json($seleccionar_libros_materias);
  }

  public function agregarEditorial()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de vincular la editorial al libro.',
      'value' => 'error',
      'data' => null
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['editoriales_id']) || intval($_POST['editoriales_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verifamos que exista la editorial
    $seleccionar_editoriales = $this->model->selectEditorialesById($_POST['editoriales_id']);
    if (!$seleccionar_editoriales) {
      json($return);
    }

    // Actualizamos la editorial
    $actualizar_editorial = $this->model->updateLibroEditorialById($_POST['libro_id'], $_POST['editoriales_id']);

    if ($actualizar_editorial) {
      $return = array(
        'status' => true,
        'msg' => 'Editorial vinculada al libro correctamente.',
        'value' => 'success',
        'data' => $seleccionar_editoriales['editoriales_nombre']
      );
    }

    json($return);
  }

  public function agregarAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de vincular el autor al libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['autores_id']) || intval($_POST['autores_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verifamos que exista el autor
    $seleccionar_autor = $this->model->selectAutoresById($_POST['autores_id']);
    if (!$seleccionar_autor) {
      json($return);
    }

    // Verificamos que este autor no este vinculado con este libro
    $seleccionar_autorlibro = $this->model->selectDetalleAutoresById($_POST['autores_id'], $_POST['libro_id']);

    if ($seleccionar_autorlibro) {
      $return['msg'] = 'Este autor ya esta vinculado a este libro.';
      $return['value'] = 'warning';

      json($return);
    }

    // Vinculamos el autor
    $vincular_autor = $this->model->insertDetalleAutor($_POST['autores_id'], $_POST['libro_id']);

    if ($vincular_autor) {
      $return = array(
        'status' => true,
        'msg' => 'Autor vinculado al libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function agregarKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de vincular la palabra clave al libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['keywords_id']) || intval($_POST['keywords_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verifamos que exista la palabra clave
    $seleccionar_keywords = $this->model->selectKeywordsById($_POST['keywords_id']);
    if (!$seleccionar_keywords) {
      json($return);
    }

    // Verificamos que este autor no este vinculado con este libro
    $seleccionar_keywordslibro = $this->model->selectDetalleKeywordsById($_POST['keywords_id'], $_POST['libro_id']);

    if ($seleccionar_keywordslibro) {
      $return['msg'] = 'La palabra clave ya esta vinculada a este libro.';
      $return['value'] = 'warning';

      json($return);
    }

    // Vinculamos la palabra clave
    $vincular_keywords = $this->model->insertDetalleKeywords($_POST['keywords_id'], $_POST['libro_id']);

    if ($vincular_keywords) {
      $return = array(
        'status' => true,
        'msg' => 'Palabra clave vinculado al libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function agregarMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de vincular la materia al libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['materias_id']) || intval($_POST['materias_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verifamos que exista la materia
    $seleccionar_materias = $this->model->selectMateriasById($_POST['materias_id']);
    if (!$seleccionar_materias) {
      json($return);
    }

    // Verificamos que este autor no este vinculado con este libro
    $seleccionar_materiaslibro = $this->model->selectDetalleMateriasById($_POST['materias_id'], $_POST['libro_id']);

    if ($seleccionar_materiaslibro) {
      $return['msg'] = 'La materia ya esta vinculada a este libro.';
      $return['value'] = 'warning';

      json($return);
    }

    // Vinculamos la materia
    $vincular_materias = $this->model->insertDetalleMaterias($_POST['materias_id'], $_POST['libro_id']);

    if ($vincular_materias) {
      $return = array(
        'status' => true,
        'msg' => 'Materia vinculada al libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function agregarTitulos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de agregar títulos al libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['detalle_niveles_titulo']) || empty($_POST['detalle_niveles_titulo']) || !isset($_POST['niveles_id']) || intval($_POST['niveles_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0 || !isset($_POST['paginas_id']) || intval($_POST['paginas_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificanmos que exista la pagina
    $pagina = $this->model->getPagina($_POST['paginas_id']);
    if(!$pagina){
      json($return);
    }

    $_POST['detalle_niveles_titulo'] = strClean($_POST['detalle_niveles_titulo']);
    // Verificamos que no haya ningún titulo con este nombre
    $seleccionar_titulo = $this->model->selectDetalleByTitulo($_POST['detalle_niveles_titulo']);
    if ($seleccionar_titulo) {
      $return['msg'] = 'Ya existe un título con este nombre.';
      $return['value'] = 'warning';
      json($return);
    }

    // Verifamos que exista el nivel
    $seleccionar_niveles = $this->model->selectNivelesById($_POST['niveles_id']);
    if (!$seleccionar_niveles) {
      json($return);
    }

    // Verificamos si tiene dependencia el libro
    $tiene_dependencia = null;
    if ($_POST['niveles_id'] != 1) {
      if (!isset($_POST['dependencia_id']) || intval($_POST['dependencia_id']) === 0) {
        $return['msg'] = 'Seleccionar la dependencia del título del libro';
        $return['value'] = 'warning';
        json($return);
      }

      $seleccionar_dependencia = $this->model->selectDetalleNivelesById($_POST['dependencia_id'], $_POST['libro_id']);
      if (!$seleccionar_dependencia) {
        $return['msg'] = 'Seleccionar la dependencia del título del libro válida.';
        $return['value'] = 'warning';
        json($return);
      }

      // Verificamos que su nivel sea menor
      if (intval($seleccionar_dependencia['niveles_orden']) >= intval($seleccionar_niveles['niveles_orden'])) {
        $return['msg'] = 'Seleccionar un nivel inferior para el título.';
        $return['value'] = 'warning';
        json($return);
      }

      $tiene_dependencia = $seleccionar_dependencia['detalle_niveles_id'];
    }

    // Ver orden del titulo
    $orden = 1;
    if (is_null($tiene_dependencia)) {
      $seleccionar_orden = $this->model->selectMaxOrdenTituloById($_POST['libro_id'], $_POST['niveles_id']);
      $orden = intval($seleccionar_orden['orden']) + 1;
    } else {
      $seleccionar_orden = $this->model->selectMaxOrdenTituloDependenciaById($_POST['dependencia_id'], $_POST['niveles_id']);
      if (!is_null($seleccionar_orden)) {
        $orden = intval($seleccionar_orden['orden']) + 1;
      }
    }

    // Insertamos un nuevo registro del libro
    $insertar_titulo = $this->model->insertTituloLibro($_POST['libro_id'], $_POST['paginas_id'], $_POST['niveles_id'], $orden, $tiene_dependencia, $_POST['detalle_niveles_titulo']);

    if ($insertar_titulo) {
      $return = array(
        'status' => true,
        'msg' => 'Título registrado correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function agregarConceptoTitulo()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(20, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de agregar conceptos al título.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['conocimiento_descripcion']) || empty($_POST['conocimiento_descripcion']) || !isset($_POST['detalle_niveles_id']) || intval($_POST['detalle_niveles_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0 || !isset($_POST['parrafos_id']) || intval($_POST['parrafos_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificamos que exista el nivel con el titulo
    $titulo = $this->model->selectDetalleTituloById($_POST['detalle_niveles_id'], $_POST['libro_id']);
    if (!$titulo) {
      json($return);
    }

    // Verificamos que exista el parrafo
    $seleccionar_parrafo = $this->model->selectParrafoById($_POST['parrafos_id']);
    if (!$seleccionar_parrafo) {
      json($return);
    }

    if ($seleccionar_parrafo['parrafos_orden'] != 1) {
      // Verificamos que exista un parrafo anterior
      $seleccionar_parrafo['parrafos_orden'] = intval($seleccionar_parrafo['parrafos_orden']);

      $parrafo = $this->model->selectParrafoByOrden($_POST['detalle_niveles_id'], $seleccionar_parrafo['parrafos_orden'] - 1);

      if (!$parrafo) {
        $return['msg'] = 'Error, por favor seleccione parrafos sucesivos.';
        $return['value'] = 'warning';

        json($return);
      }
    }

    // Verificamos si existe la terminologia seleccionado
    $lista_terminologias = $this->model->selectTerminologiasConcepto();
    $auxTerminologiasInsertar = [];
    foreach ($lista_terminologias as $key => $value) {
      if (isset($_POST['check_' . $value['terminologias_id']])) {
        array_push($auxTerminologiasInsertar, ['id' => $value['terminologias_id']]);
      }
    }

    $detalle_conocimiento = $this->model->selectDetalleConocimiento($_POST['detalle_niveles_id'], $_POST['parrafos_id']);
    $orden = 1;
    if (!is_null($detalle_conocimiento['max_orden'])) {
      $orden = intval($detalle_conocimiento['max_orden']) + 1;
    }

    // Registramos el concepto
    $_POST['conocimiento_descripcion'] = strClean($_POST['conocimiento_descripcion']);
    $insertar_concepto = $this->model->insertConcepto($_POST['conocimiento_descripcion']);

    if ($insertar_concepto <= 0) {
      $return['msg'] = 'Error, no se puede registrar el concepto.';
      $return['value'] = 'warning';
      json($return);
    }

    // Vinculamos las terminologías
    // Falta validar si se insertan
    if (!empty($auxTerminologiasInsertar)) {
      foreach ($auxTerminologiasInsertar as $key => $value) {
        $this->model->insertDetalleTerminologiaCon($value['id'], $insertar_concepto);
      }
    } else {
      $this->model->insertDetalleTerminologiaCon(null, $insertar_concepto);
    }

    // Vinculamos al titulo
    $insert_concepto_titulo = $this->model->insertConceptoTitulo(
      $_POST['detalle_niveles_id'],
      $orden,
      $_POST['parrafos_id'],
      $insertar_concepto
    );

    if ($insert_concepto_titulo <= 0) {
      json($return);
    }

    $return = array(
      'status' => true,
      'msg' => 'Concepto registrado correctamente.',
      'value' => 'success'
    );

    json($return);
  }

  public function editarTitulos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de editar el título del libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['detalle_niveles_titulo_edit']) || empty($_POST['detalle_niveles_titulo_edit']) || !isset($_POST['detalle_niveles_id']) || intval($_POST['detalle_niveles_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificamos que exista el detalle
    $titulo = $this->model->selectDetalleTituloById($_POST['detalle_niveles_id'], $_POST['libro_id']);
    if (!$titulo) {
      json($return);
    }

    // Verificamos que no exista un titulo con el mismo nombre
    $_POST['detalle_niveles_titulo_edit'] = strClean($_POST['detalle_niveles_titulo_edit']);
    $seleccionar_libro  = $this->model->selectTituloByNombre($_POST['libro_id'], $_POST['detalle_niveles_titulo_edit']);

    if ($seleccionar_libro && $seleccionar_libro['detalle_niveles_titulo'] !== $titulo['detalle_niveles_titulo']) {
      $return['msg'] = 'Ya existe un titulo con este mismo nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos el titulo
    $actualizarTitulo = $this->model->updateLibroTitulo($_POST['detalle_niveles_id'], $_POST['detalle_niveles_titulo_edit']);
    if ($actualizarTitulo) {
      $return = array(
        'status' => true,
        'msg' => 'Título del libro actualizado correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function eliminarEditorial()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de desvicular la editorial del libro.',
      'value' => 'error',
      'data' => null
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Actualizamos la editorial
    $editorial = null;
    $actualizar_editorial = $this->model->updateLibroEditorialById($_POST['libro_id'], $editorial);

    if ($actualizar_editorial) {
      $return = array(
        'status' => true,
        'msg' => 'Editorial devinculada de libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function eliminarAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de desvincular el del libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['detalle_autor_id']) || intval($_POST['detalle_autor_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificamos que este autor no este vinculado con este libro
    $seleccionar_autorlibro = $this->model->selectAutorLibroVinculadoById($_POST['detalle_autor_id'], $_POST['libro_id']);

    if (!$seleccionar_autorlibro) {
      json($return);
    }

    // desvinculamos el autor
    $desvincular_autor = $this->model->deleteDetalleAutorVinculado($_POST['detalle_autor_id'], $_POST['libro_id']);

    if ($desvincular_autor) {
      $return = array(
        'status' => true,
        'msg' => 'Autor desvinculado del libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function eliminarKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de desvincular el del libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['detalle_keywords_id']) || intval($_POST['detalle_keywords_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificamos que la palabra clave no este vinculado con este libro
    $seleccionar_keywordslibro = $this->model->selectKeywordsLibroVinculadoById($_POST['detalle_keywords_id'], $_POST['libro_id']);

    if (!$seleccionar_keywordslibro) {
      json($return);
    }

    // desvinculamos la palabra clave
    $desvincular_keywords = $this->model->deleteDetalleKeywordsVinculado($_POST['detalle_keywords_id'], $_POST['libro_id']);

    if ($desvincular_keywords) {
      $return = array(
        'status' => true,
        'msg' => 'Palabra clave desvinculado del libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function eliminarMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(19, true);

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de desvincular el del libro.',
      'value' => 'error'
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['detalle_materias_id']) || intval($_POST['detalle_materias_id']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    // Verifimos que exista el libro
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    // Verificamos que la materia no este vinculado con este libro
    $seleccionar_materiaslibro = $this->model->selectMateriasLibroVinculadoById($_POST['detalle_materias_id'], $_POST['libro_id']);

    if (!$seleccionar_materiaslibro) {
      json($return);
    }

    // desvinculamos la materia
    $desvincular_materias = $this->model->deleteDetalleMateriasVinculado($_POST['detalle_materias_id'], $_POST['libro_id']);

    if ($desvincular_materias) {
      $return = array(
        'status' => true,
        'msg' => 'Materia desvinculada del libro correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }
}
