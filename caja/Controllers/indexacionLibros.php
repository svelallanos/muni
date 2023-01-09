<?php
class IndexacionLibros extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function elementos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(11, true);
    $data['page_id'] = 3;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Configuración de los elementos del libro";

    $this->views->getView($this, "elementos", $data);
  }

  public function parrafos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(12, true);

    $data['page_id'] = 15;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Párrafos";
    $data['page_function_js'] = "indexacion/functions_parrafos";
    $data['data-parrafos'] = $this->model->selectsParrafos();

    $this->views->getView($this, "parrafos", $data);
  }

  public function keywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(13, true);

    $data['page_id'] = 15;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Palabras Claves";
    $data['page_function_js'] = "indexacion/functions_keywords";

    $this->views->getView($this, "keywords", $data);
  }

  public function materias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(14, true);

    $data['page_id'] = 16;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de Materias";
    $data['page_function_js'] = "indexacion/functions_materias";

    $this->views->getView($this, "materias", $data);
  }

  public function categorias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(15, true);

    $data['page_id'] = 16;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de categorias";
    $data['page_function_js'] = "indexacion/functions_categorias";

    $this->views->getView($this, "categorias", $data);
  }

  public function niveles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(16, true);

    $data['page_id'] = 17;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de los niveles del documento.";
    $data['page_function_js'] = "indexacion/functions_niveles";

    $this->views->getView($this, "niveles", $data);
  }

  public function terminologias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $data['page_id'] = 18;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de conceptos y terminologías.";
    $data['page_function_js'] = "indexacion/functions_terminologias";

    $this->views->getView($this, "terminologias", $data);
  }

  public function terminologiasVinculadas()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(18, true);

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET) || !isset($_GET['terminologias_id']) || intval($_GET['terminologias_id']) === 0) {
      location('indexacionLibros/terminologias');
    }

    // Verificamos que exista esta terminología
    $terminologia = $this->model->selectTerminologiaById($_GET['terminologias_id']);
    if (!$terminologia) {
      location('indexacionLibros/terminologias');
    }

    // Validamos que sea de primer nivel
    $primer_nivel = true;
    if (is_null($terminologia['terminologias_dependencia']) || $terminologia['terminologias_dependencia'] === '' || intval($terminologia['terminologias_dependencia']) === 0) {
      if (intval($terminologia['terminologias_orden']) !== 1) {
        $primer_nivel = false;
      }
    } else {
      $primer_nivel = false;
    }

    if (!$primer_nivel) {
      location('indexacionLibros/terminologias');
    }

    // Traemos todas las terminologías
    $listaTerminologias = $this->model->selectTerminologiasByOrder();

    $grupoOrden = array();
    foreach ($listaTerminologias as $key => $value) {
      if (!isset($grupoOrden[$value['terminologias_orden']])) {
        $grupoOrden[$value['terminologias_orden']] = [$value];
      } else {
        array_push($grupoOrden[$value['terminologias_orden']], $value);
      }
    }

    $verificador[$terminologia['terminologias_id']] = 'Principal';

    $tesauro[1] = [[
      'terminologias_id' => $terminologia['terminologias_id'],
      'terminologias_nombre' => $terminologia['terminologias_nombre'],
      'terminologias_descripcion' => $terminologia['terminologias_descripcion'],
      'terminologias_orden' => $terminologia['terminologias_orden'],
      'terminologias_dependencia' => 0
    ]];

    unset($grupoOrden[1]);

    foreach ($grupoOrden as $key => $value) {
      foreach ($value as $cont => $valor) {
        if (isset($verificador[$valor['terminologias_dependencia']])) {
          if (!isset($tesauro[$valor['terminologias_orden']])) {
            $tesauro[$valor['terminologias_orden']] = [$valor];
            $verificador[$valor['terminologias_id']] = 'secundarios';
          } else {
            array_push($tesauro[$valor['terminologias_orden']], $valor);
            $verificador[$valor['terminologias_id']] = 'secundarios';
          }
        }
      }
    }

    // json($tesauro);

    // $arbol = array();
    // array_push(
    //   $arbol,
    //   array(
    //     'terminologias_id' => $terminologia['terminologias_id'],
    //     'terminologias_nombre' => $terminologia['terminologias_nombre'],
    //     'terminologias_descripcion' => $terminologia['terminologias_descripcion'],
    //     'terminologias_orden' => $terminologia['terminologias_orden'],
    //     'terminologias_dependencia' => 0,
    //     'sub_terminologias' => array()
    //   )
    // );

    $auxTesauro = array();
    foreach ($tesauro as $key => $value) {
      foreach ($value as $cont => $dato) {
        array_push($auxTesauro, array(
          "terminologias_id" => $dato['terminologias_id'],
          "terminologias_nombre" => $dato['terminologias_nombre'],
          "terminologias_descripcion" => $dato['terminologias_descripcion'],
          "terminologias_orden" => $dato['terminologias_orden'],
          "terminologias_dependencia" => $dato['terminologias_dependencia']
        ));
      }
    }

    $arrayIndexado = array(
      'terminologias_id' => $auxTesauro[0]['terminologias_id'],
      'terminologias_nombre' => $auxTesauro[0]['terminologias_nombre'],
      'terminologias_descripcion' => $auxTesauro[0]['terminologias_descripcion'],
      'terminologias_orden' => $auxTesauro[0]['terminologias_orden'],
      'terminologias_dependencia' => $auxTesauro[0]['terminologias_dependencia'],
      'hijos' => array()
    );

    // json($arrayIndexado);

    unset($auxTesauro[0]);
    $nuevoTesauro = array();
    foreach ($auxTesauro as $key => $value) {
      array_push($nuevoTesauro, $value);
    }

    // Limitado a 5 conceptos
    $cont1 = -1;
    $cont2 = -1;
    $cont3 = -1;
    $cont4 = -1;
    $cont5 = -1;

    foreach ($nuevoTesauro as $key_1 => $value_1) {
      if ($arrayIndexado['terminologias_id'] == $value_1['terminologias_dependencia']) {
        $cont1 = $cont1 + 1;
        $arrayIndexado['hijos'][$cont1] = array(
          'terminologias_id' => $value_1['terminologias_id'],
          'terminologias_nombre' => $value_1['terminologias_nombre'],
          'terminologias_descripcion' => $value_1['terminologias_descripcion'],
          'terminologias_orden' => $value_1['terminologias_orden'],
          'terminologias_dependencia' => $value_1['terminologias_dependencia'],
          'hijos' => array()
        );

        $padre1 = $value_1['terminologias_id'];

        foreach ($nuevoTesauro as $key_2 => $value_2) {
          if ($padre1 == $value_2['terminologias_dependencia']) {
            $cont2 = $cont2 + 1;
            $arrayIndexado['hijos'][$cont1]['hijos'][$cont2] = array(
              'terminologias_id' => $value_2['terminologias_id'],
              'terminologias_nombre' => $value_2['terminologias_nombre'],
              'terminologias_descripcion' => $value_2['terminologias_descripcion'],
              'terminologias_orden' => $value_2['terminologias_orden'],
              'terminologias_dependencia' => $value_2['terminologias_dependencia'],
              'hijos' => array()
            );

            $padre2 = $value_2['terminologias_id'];

            foreach ($nuevoTesauro as $key_3 => $value_3) {
              if ($padre2 == $value_3['terminologias_dependencia']) {
                $cont3 = $cont3 + 1;
                $arrayIndexado['hijos'][$cont1]['hijos'][$cont2]['hijos'][$cont3] = array(
                  'terminologias_id' => $value_3['terminologias_id'],
                  'terminologias_nombre' => $value_3['terminologias_nombre'],
                  'terminologias_descripcion' => $value_3['terminologias_descripcion'],
                  'terminologias_orden' => $value_3['terminologias_orden'],
                  'terminologias_dependencia' => $value_3['terminologias_dependencia'],
                  'hijos' => array()
                );

                $padre3 = $value_3['terminologias_id'];
                foreach ($nuevoTesauro as $key_4 => $value_4) {
                  if ($padre3 == $value_4['terminologias_dependencia']) {
                    $cont4 = $cont4 + 1;
                    $arrayIndexado['hijos'][$cont1]['hijos'][$cont2]['hijos'][$cont3]['hijos'][$cont4] = array(
                      'terminologias_id' => $value_4['terminologias_id'],
                      'terminologias_nombre' => $value_4['terminologias_nombre'],
                      'terminologias_descripcion' => $value_4['terminologias_descripcion'],
                      'terminologias_orden' => $value_4['terminologias_orden'],
                      'terminologias_dependencia' => $value_4['terminologias_dependencia'],
                      'hijos' => array()
                    );

                    $padre4 = $value_4['terminologias_id'];
                    foreach ($nuevoTesauro as $key_5 => $value_5) {
                      if ($padre4 == $value_5['terminologias_dependencia']) {
                        $cont5 = $cont5 + 1;
                        $arrayIndexado['hijos'][$cont1]['hijos'][$cont2]['hijos'][$cont3]['hijos'][$cont4]['hijos'][$cont5] = array(
                          'terminologias_id' => $value_5['terminologias_id'],
                          'terminologias_nombre' => $value_5['terminologias_nombre'],
                          'terminologias_descripcion' => $value_5['terminologias_descripcion'],
                          'terminologias_orden' => $value_5['terminologias_orden'],
                          'terminologias_dependencia' => $value_5['terminologias_dependencia'],
                          'hijos' => array()
                        );
                      }
                    }

                    $cont5 = -1;
                  }
                }
                $cont4 = -1;
              }
            }
            $cont3 = -1;
          }
        }
        $cont2 = -1;
      }
    }

    // $agregar = '';
    // foreach ($arrayIndexado['hijos'] as $key => $value) {
    //   $agregar .= $value['terminologias_id'].',';
    //   // json($value['terminologias_id']);
    // }

    // json($agregar);
    // json($arrayIndexado);

    $data['page_id'] = 19;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de terminologías y conceptos vinculados.";
    $data['page_css'] = "indexacion/indexacion";
    $data['conocimiento'] = $arrayIndexado;
    // $data['page_function_js'] = "indexacion/functions_tvinculadas";

    $this->views->getView($this, "tvinculados", $data);
  }

  public function selectKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(13, true);

    $selecionar_keywords = $this->model->selectsKeywords();

    foreach ($selecionar_keywords as $key => $value) {
      $selecionar_keywords[$key]['numero'] = $key + 1;
      $selecionar_keywords[$key]['keywords_descripcion'] = recortar_cadena($value['keywords_descripcion'], 50);
      $selecionar_keywords[$key]['options'] = '
      <button 
      title="Editar palabra clave."
      data-keywords_id="' . $value['keywords_id'] . '" 
      data-keywords_nombre="' . $value['keywords_nombre'] . '" 
      data-keywords_descripcion="' . $value['keywords_descripcion'] . '" 
      class="btn_editar_keyword btn btn-icon btn-sm btn-outline-warning">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar palabra clave."
      data-keywords_id="' . $value['keywords_id'] . '" 
      class="btn_eliminar_keyword btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>
      <button
      title="Ver detalle de la palabra clave."
      data-keywords_nombre="' . $value['keywords_nombre'] . '" 
      data-keywords_descripcion="' . $value['keywords_descripcion'] . '" 
      class="btn_ver_keyword btn btn-icon btn-sm btn-outline-primary ml-2">
      <i class="feather-eye"></i>
      </button>';
    }

    json($selecionar_keywords);
  }

  public function selectMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(14, true);

    $selecionar_materias = $this->model->selectsMaterias();

    foreach ($selecionar_materias as $key => $value) {
      $selecionar_materias[$key]['numero'] = $key + 1;
      $selecionar_materias[$key]['options'] = '
      <button 
      title="Editar materia vinculada."
      data-materias_id="' . $value['materias_id'] . '" 
      data-materias_nombre="' . $value['materias_nombre'] . '" 
      class="btn_editar_materia btn btn-icon btn-sm btn-outline-warning">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar materia vinculada."
      data-materias_id="' . $value['materias_id'] . '" 
      class="btn_eliminar_materia btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>';
    }

    json($selecionar_materias);
  }

  public function selectCategorias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(15, true);

    $seleccionar_categorias = $this->model->selectsCategorias();

    foreach ($seleccionar_categorias as $key => $value) {
      $seleccionar_categorias[$key]['numero'] = $key + 1;
      $seleccionar_categorias[$key]['options'] = '
      <button 
      title="Editar categoría vinculada."
      data-categorias_id="' . $value['categorias_id'] . '" 
      data-categorias_nombre="' . $value['categorias_nombre'] . '" 
      data-categorias_descripcion="' . $value['categorias_descripcion'] . '" 
      data-categorias_estado="' . $value['categorias_estado'] . '" 
      class="btn_editar_categoria btn btn-icon btn-sm btn-outline-warning">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar categoría vinculada."
      data-categorias_id="' . $value['categorias_id'] . '" 
      class="btn_eliminar_categoria btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>
      <button 
      title="Detalle categoría vinculada."
      data-categorias_nombre="' . $value['categorias_nombre'] . '" 
      data-categorias_descripcion="' . $value['categorias_descripcion'] . '" 
      data-categorias_estado="' . $value['categorias_estado'] . '" 
      class="btn_ver_categoria btn btn-icon btn-sm btn-outline-primary ml-2">
      <i class="feather-eye"></i>
      </button>';

      $seleccionar_categorias[$key]['categorias_descripcion'] = recortar_cadena($value['categorias_descripcion'], 35);

      $seleccionar_categorias[$key]['estado'] = '<span class="badge rounded-pill bg-danger-soft text-danger">Desactivado</span>';
      if ($value['categorias_estado'] == 1) {
        $seleccionar_categorias[$key]['estado'] = '<span class="badge rounded-pill bg-success-soft text-success">Activo</span>';
      }
    }

    json($seleccionar_categorias);
  }

  public function selectNiveles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(16, true);

    $seleccionar_niveles = $this->model->selectsNiveles();

    foreach ($seleccionar_niveles as $key => $value) {
      $seleccionar_niveles[$key]['numero'] = $key + 1;
      $seleccionar_niveles[$key]['options'] = '
      <button 
      title="Editar niveles vinculadas."
      data-niveles_id="' . $value['niveles_id'] . '" 
      data-niveles_orden="' . $value['niveles_orden'] . '" 
      data-niveles_descripcion="' . $value['niveles_descripcion'] . '" 
      class="btn_editar_niveles btn btn-icon btn-sm btn-outline-warning">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar niveles vinculadas."
      data-niveles_id="' . $value['niveles_id'] . '" 
      class="btn_eliminar_niveles btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>';
      $seleccionar_niveles[$key]['niveles_orden'] = '<span class="fw-700 text-primary badge bg-primary-soft">' . $value['niveles_orden'] . '</span>';
    }

    json($seleccionar_niveles);
  }

  public function selectTerminologias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $seleccionar_terminologias = $this->model->selectsTerminologias();

    foreach ($seleccionar_terminologias as $key => $value) {
      $seleccionar_terminologias[$key]['numero'] = $key + 1;
      $seleccionar_terminologias[$key]['options'] = '
      <button 
      title="Editar terminologías vinculadas."
      data-terminologias_id="' . $value['terminologias_id'] . '" 
      class="btn_editar_terminologias btn btn-icon btn-sm btn-outline-info">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar terminologías vinculadas."
      data-terminologias_id="' . $value['terminologias_id'] . '" 
      class="btn_eliminar_terminologias btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>
      <a 
      href="' . base_url() . 'indexacionLibros/terminologiasVinculadas?terminologias_id=' . $value['terminologias_id'] . '" 
      title="Detalle de las terminologías vinculadas."
      class="btn_ver_terminologias btn btn-icon btn-sm btn-outline-primary ml-2">
      <i class="feather-list"></i>
      </a>';

      $seleccionar_terminologias[$key]['terminologias_descripcion'] = recortar_cadena($value['terminologias_descripcion'], 35);

      if (is_null($value['terminologias_dependencia']) || empty($value['terminologias_dependencia']) || intval($value['terminologias_dependencia']) === 0) {
        $seleccionar_terminologias[$key]['terminologias_dependencia'] = '<span class="fw-700 text-indigo badge bg-indigo-soft">P</span>';
      } else {
        $seleccionar_terminologias[$key]['terminologias_dependencia'] = '<span class="fw-700 text-primary badge bg-primary-soft">D</span>';
      }
    }

    json($seleccionar_terminologias);
  }

  public function selectTerminologia()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de seleccionar una terminología.',
      'value' => 'error',
      'data' => null
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['terminologias_id']) || intval($_POST['terminologias_id']) === 0) {
      json($return);
    }

    // $seleccionamos una terminología
    $terminologia = $this->model->selectTerminologiaById($_POST['terminologias_id']);
    if (!$terminologia) {
      json($return);
    }

    $terminologia['terminologias_dependencia'] = (is_null($terminologia['terminologias_dependencia']) || intval($terminologia['terminologias_dependencia']) === 0) ? 0 : $terminologia['terminologias_dependencia'] = intval($terminologia['terminologias_dependencia']);

    $terminologia_dos['terminologias_id'] = 0;
    $terminologia_dos['terminologias_nombre'] = 'Ninguno';
    if ($terminologia['terminologias_dependencia'] !== 0) {
      $terminologia_dos = $this->model->selectTerminologiaById($terminologia['terminologias_dependencia']);
      if (!$terminologia_dos) {
        $terminologia_dos['terminologias_id'] = 0;
        $terminologia_dos['terminologias_nombre'] = 'Ninguno';
      }
    }

    $terminologia['terminologias_nombre_dos'] = $terminologia_dos['terminologias_nombre'];
    $terminologia['terminologias_id_dos'] = $terminologia_dos['terminologias_id'];

    $return = [
      'status' => true,
      'msg' => 'Detalle terminología.',
      'value' => 'success',
      'data' => $terminologia
    ];

    json($return);
  }

  public function selectDependencias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $seleccionar_terminologias = $this->model->selectsTerminologias(0);

    foreach ($seleccionar_terminologias as $key => $value) {
      $seleccionar_terminologias[$key]['numero'] = $key + 1;
      $seleccionar_terminologias[$key]['options'] = '
      <button 
      title="Agregar terminología."
      data-terminologias_id="' . $value['terminologias_id'] . '" 
      data-terminologias_nombre="' . $value['terminologias_nombre'] . '" 
      class="__agregar_terminologia btn btn-icon btn-sm btn-outline-success ml-2">
      <i class="feather-chevrons-right"></i>
      </button>';
    }

    json($seleccionar_terminologias);
  }

  public function selectFilterTerminologias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $seleccionar_terminologias = $this->model->selectsTerminologias(0);

    foreach ($seleccionar_terminologias as $key => $value) {
      $seleccionar_terminologias[$key]['numero'] = $key + 1;
      $seleccionar_terminologias[$key]['options'] = '
      <button 
      title="Editar terminologías vinculadas."
      data-terminologias_id="' . $value['terminologias_id'] . '" 
      class="btn_editar_terminologias btn btn-icon btn-sm btn-outline-info">
      <i class="feather-edit-3"></i>
      </button>
      <button 
      title="Eliminar terminologías vinculadas."
      data-terminologias_id="' . $value['terminologias_id'] . '" 
      class="btn_eliminar_terminologias btn btn-icon btn-sm btn-outline-danger ml-2">
      <i class="fa-regular fa-trash-can"></i>
      </button>';

      $seleccionar_terminologias[$key]['terminologias_descripcion'] = recortar_cadena($value['terminologias_descripcion'], 35);

      if (is_null($value['terminologias_dependencia']) || empty($value['terminologias_dependencia']) || intval($value['terminologias_dependencia']) === 0) {
        $seleccionar_terminologias[$key]['terminologias_dependencia'] = '<span class="fw-700 text-indigo badge bg-indigo-soft">P</span>';
        $seleccionar_terminologias[$key]['options'] .= '
        <a 
        href="' . base_url() . 'indexacionLibros/terminologiasVinculadas?terminologias_id=' . $value['terminologias_id'] . '" 
        title="Detalle de las terminologías vinculadas."
        data-terminologias_id="' . $value['terminologias_id'] . '" 
        class="btn_ver_terminologias btn btn-icon btn-sm btn-outline-primary ml-2">
        <i class="feather-list"></i>
        </a>';
      } else {
        $seleccionar_terminologias[$key]['terminologias_dependencia'] = '<span class="fw-700 text-primary badge bg-primary-soft">D</span>';
        $seleccionar_terminologias[$key]['options'] .= '
        <button 
        title="Anular dependencia."
        data-terminologias_id="' . $value['terminologias_id'] . '" 
        class="btn_eliminar_dependencia btn btn-icon btn-sm btn-outline-warning ml-2">
        <i class="fa-solid fa-eraser"></i>
        </button>';
      }
    }

    json($seleccionar_terminologias);
  }

  public function agregarParrafos()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(12, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar un párrafo.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['parrafo_nombre']) || empty($_POST['parrafo_nombre']) || !isset($_POST['parrafo_orden']) || intval($_POST['parrafo_orden']) === 0) {
      json($return);
    }

    // Verificamos si existe este nombre del parrafo
    $_POST['parrafo_nombre'] = strClean($_POST['parrafo_nombre']);
    $seleccionar_parrafo = $this->model->selectParrafoByNombre($_POST['parrafo_nombre']);

    if ($seleccionar_parrafo) {
      $return['msg'] = 'Ya existe un párrafo con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Verificamos si existe este orden en la lista de los parrafos
    $_POST['parrafo_orden'] = strClean($_POST['parrafo_orden']);
    $seleccionar_parrafo = $this->model->selectParrafoByOrden($_POST['parrafo_orden']);

    if ($seleccionar_parrafo) {
      $return['msg'] = 'Ya existe un párrafo con este orden.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos el nuevo párrafo
    $insertar_parrafo = $this->model->insertParrafo($_POST['parrafo_nombre'], $_POST['parrafo_orden']);

    if ($insertar_parrafo > 0) {
      $return = [
        'status' => true,
        'msg' => 'Párrafo insertado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(13, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar una palabra clave.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['keywords_palabra']) || empty($_POST['keywords_palabra']) || !isset($_POST['keywords_descripcion']) || empty($_POST['keywords_descripcion'])) {
      json($return);
    }

    // Verificamos si existe este nombre del keyword
    $_POST['keywords_palabra'] = strClean($_POST['keywords_palabra']);
    $seleccionar_keyword = $this->model->selectKeywordsByNombre($_POST['keywords_palabra']);

    if ($seleccionar_keyword) {
      $return['msg'] = 'Ya existe una palabra clave con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos una nueva palabra clave
    $insertar_keywords = $this->model->insertKeywords($_POST['keywords_palabra'], $_POST['keywords_descripcion']);

    if ($insertar_keywords > 0) {
      $return = [
        'status' => true,
        'msg' => 'Palabra clave registrada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(14, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar una nueva materia.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['materia']) || empty($_POST['materia'])) {
      json($return);
    }

    // Verificamos si existe este nombre de la materia
    $_POST['materia'] = strClean($_POST['materia']);
    $seleccionar_materia = $this->model->selectMateriaByNombre($_POST['materia']);

    if ($seleccionar_materia) {
      $return['msg'] = 'Ya existe una materia con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos una nueva materia
    $insertar_materia = $this->model->insertMateria($_POST['materia']);

    if ($insertar_materia > 0) {
      $return = [
        'status' => true,
        'msg' => 'Materia registrada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarCategorias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(15, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar una categoría.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['categorias_nombre']) || empty($_POST['categorias_nombre']) || !isset($_POST['categorias_descripcion']) || empty($_POST['categorias_descripcion'])) {
      json($return);
    }

    // Verificamos si existe este nombre de la categoria
    $_POST['categorias_nombre'] = strClean($_POST['categorias_nombre']);
    $seleccionar_categoria = $this->model->selectCategoriaByNombre($_POST['categorias_nombre']);

    if ($seleccionar_categoria) {
      $return['msg'] = 'Ya existe una categoria con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos una nueva categoria
    $_POST['categorias_descripcion'] = strClean($_POST['categorias_descripcion']);
    $insertar_categoria = $this->model->insertCategoria($_POST['categorias_nombre'], $_POST['categorias_descripcion']);

    if ($insertar_categoria > 0) {
      $return = [
        'status' => true,
        'msg' => 'Categoría registrada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarNiveles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(16, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar un nivel.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['niveles_nombre']) || empty($_POST['niveles_nombre']) || !isset($_POST['niveles_orden']) || intval($_POST['niveles_orden']) === 0) {
      json($return);
    }

    // Verificamos si existe este nombre de nivel
    $_POST['niveles_nombre'] = strClean($_POST['niveles_nombre']);
    $seleccionar_niveles = $this->model->selectNivelesByNombre($_POST['niveles_nombre']);

    if ($seleccionar_niveles) {
      $return['msg'] = 'Ya existe un nivel con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Verificamos si existe este orden en la lista de los niveles
    $_POST['niveles_orden'] = strClean($_POST['niveles_orden']);
    $seleccionar_niveles = $this->model->selectNivelesByOrden($_POST['niveles_orden']);

    if ($seleccionar_niveles) {
      $return['msg'] = 'Ya existe un nivel con este orden.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos el nuevo nivel
    $insertar_nivel = $this->model->insertNiveles($_POST['niveles_nombre'], $_POST['niveles_orden']);

    if ($insertar_nivel > 0) {
      $return = [
        'status' => true,
        'msg' => 'Nivel insertado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarTerminologias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar una terminología.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['terminologias_nombre']) || empty($_POST['terminologias_nombre']) || !isset($_POST['terminologias_descripcion']) || empty($_POST['terminologias_descripcion']) || !isset($_POST['dependencia_id'])) {
      json($return);
    }

    // Verificamos si existe este nombre de terminología
    $_POST['terminologias_nombre'] = strClean($_POST['terminologias_nombre']);
    $seleccionar_terminologia = $this->model->selectTerminologiaByNombre($_POST['terminologias_nombre']);

    if ($seleccionar_terminologia) {
      $return['msg'] = 'Ya existe una terminología con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    $_POST['dependencia_id'] = intval($_POST['dependencia_id']);
    $term_id = null;
    $orden = 1;
    if ($_POST['dependencia_id'] !== 0) {
      // Verificamos que exista esta terminología
      $seleccionar_terminologia = $this->model->selectTerminologiaById($_POST['dependencia_id']);
      if (!$seleccionar_terminologia) {
        json($return);
      }
      $orden = intval($seleccionar_terminologia['terminologias_orden']) + 1;
      $term_id = $seleccionar_terminologia['terminologias_id'];
    }

    if ($orden > 6) {
      $return['msg'] = 'Sobrepasa los 6 indexaciones de conceptos permitidas.';
      $return['value'] = 'warning';

      json($return);
    }

    $_POST['terminologias_descripcion'] = strClean($_POST['terminologias_descripcion']);
    // Insertamos una nueva terminología
    $insertar_terminologia = $this->model->insertTerminologia(
      $_POST['terminologias_nombre'],
      $_POST['terminologias_descripcion'],
      $orden,
      $term_id,
    );

    if ($insertar_terminologia > 0) {
      $return = [
        'status' => true,
        'msg' => 'Terminología registrado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarParrafo()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(12, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar el párrafo.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['parrafo_nombre_edit']) || empty($_POST['parrafo_nombre_edit']) || !isset($_POST['parrafos_id']) || intval($_POST['parrafos_id']) === 0 || !isset($_POST['parrafo_orden_edit']) || intval($_POST['parrafo_orden_edit']) === 0) {
      json($return);
    }

    // verificamos que exista este párrafo
    $parrafo = $this->model->selectParrafoById($_POST['parrafos_id']);
    if (!$parrafo) {
      json($return);
    }

    // Verificamos si existe este nombre del parrafo
    $_POST['parrafo_nombre_edit'] = strClean($_POST['parrafo_nombre_edit']);
    $seleccionar_parrafo = $this->model->selectParrafoByNombre($_POST['parrafo_nombre_edit']);

    if ($seleccionar_parrafo && $parrafo['parrafos_descripcion'] != $seleccionar_parrafo['parrafos_descripcion']) {
      $return['msg'] = 'Ya existe un párrafo con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Verificamos si existe este orden en la lista de los parrafos
    $_POST['parrafo_orden_edit'] = strClean($_POST['parrafo_orden_edit']);
    $seleccionar_parrafo = $this->model->selectParrafoByOrden($_POST['parrafo_orden_edit']);

    if ($seleccionar_parrafo && $parrafo['parrafos_orden'] != $seleccionar_parrafo['parrafos_orden']) {
      $return['msg'] = 'Ya existe un párrafo con este orden.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos el párrafo
    $actualizar_parrafo = $this->model->updateParrafo($_POST['parrafo_nombre_edit'], $_POST['parrafo_orden_edit'], $_POST['parrafos_id']);
    if ($actualizar_parrafo) {
      $return = [
        'status' => true,
        'msg' => 'Párrafo actualizado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(13, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar la palabra clave.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['keywords_palabra_edit']) || empty($_POST['keywords_palabra_edit']) || !isset($_POST['keywords_descripcion_edit']) || empty($_POST['keywords_descripcion_edit']) || !isset($_POST['keywords_id']) || intval($_POST['keywords_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta palabra clave
    $keywords = $this->model->selectKeywordsById($_POST['keywords_id']);
    if (!$keywords) {
      json($return);
    }

    // Verificamos si existe este nombre de la palabra clave
    $_POST['keywords_palabra_edit'] = strClean($_POST['keywords_palabra_edit']);
    $seleccionar_keywords = $this->model->selectKeywordsByNombre($_POST['keywords_palabra_edit']);
    if ($seleccionar_keywords && $keywords['keywords_nombre'] != $seleccionar_keywords['keywords_nombre']) {
      $return['msg'] = 'Ya existe una palabra clave con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    $_POST['keywords_descripcion_edit'] = strClean($_POST['keywords_descripcion_edit']);
    // Actualizamos la palabra clave
    $actualizar_keywords = $this->model->updateKeywords($_POST['keywords_palabra_edit'], $_POST['keywords_descripcion_edit'], $_POST['keywords_id']);
    if ($actualizar_keywords) {
      $return = [
        'status' => true,
        'msg' => 'Palabra clave actualizada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(14, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar la materia.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['materia_edit']) || empty($_POST['materia_edit']) || !isset($_POST['materias_id']) || intval($_POST['materias_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta materia
    $materia = $this->model->selectMateriaById($_POST['materias_id']);
    if (!$materia) {
      json($return);
    }

    // Verificamos si existe este nombre de la materia
    $_POST['materia_edit'] = strClean($_POST['materia_edit']);
    $seleccionar_materia = $this->model->selectMateriaByNombre($_POST['materia_edit']);
    if ($seleccionar_materia && $materia['materias_nombre'] != $seleccionar_materia['materias_nombre']) {
      $return['msg'] = 'Ya existe una materia con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos la materia
    $actualizar_materia = $this->model->updateMateria($_POST['materia_edit'], $_POST['materias_id']);
    if ($actualizar_materia) {
      $return = [
        'status' => true,
        'msg' => 'Materia actualizada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarCategorias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(15, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de editar la categoría.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['categorias_nombre_edit']) || empty($_POST['categorias_nombre_edit']) || !isset($_POST['categorias_descripcion_edit']) || empty($_POST['categorias_descripcion_edit']) || !isset($_POST['categorias_estado_edit']) || intval($_POST['categorias_estado_edit']) === 0 || !isset($_POST['categorias_id']) || intval($_POST['categorias_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta categoria
    $categoria = $this->model->selectCategoriaById($_POST['categorias_id']);
    if (!$categoria) {
      json($return);
    }

    // Verificamos si existe este nombre de la categoria
    $_POST['categorias_nombre_edit'] = strClean($_POST['categorias_nombre_edit']);
    $seleccionar_categoria = $this->model->selectCategoriaByNombre($_POST['categorias_nombre_edit']);
    if ($seleccionar_categoria && $categoria['categorias_nombre'] != $seleccionar_categoria['categorias_nombre']) {
      $return['msg'] = 'Ya existe una categoria con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos la categoria
    $actualizar_categoria = $this->model->updateCategoria($_POST['categorias_nombre_edit'], $_POST['categorias_descripcion_edit'], $_POST['categorias_estado_edit'], $_POST['categorias_id']);
    if ($actualizar_categoria) {
      $return = [
        'status' => true,
        'msg' => 'Categoría actualizada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarNiveles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(16, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar el nivel.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['niveles_nombre_edit']) || empty($_POST['niveles_nombre_edit']) || !isset($_POST['niveles_id']) || intval($_POST['niveles_id']) === 0 || !isset($_POST['niveles_orden_edit']) || intval($_POST['niveles_orden_edit']) === 0) {
      json($return);
    }

    // verificamos que exista este párrafo
    $niveles = $this->model->selectNivelesById($_POST['niveles_id']);
    if (!$niveles) {
      json($return);
    }

    // Verificamos si existe este nombre del nivel
    $_POST['niveles_nombre_edit'] = strClean($_POST['niveles_nombre_edit']);
    $seleccionar_niveles = $this->model->selectNivelesByNombre($_POST['niveles_nombre_edit']);

    if ($seleccionar_niveles && $niveles['niveles_descripcion'] != $seleccionar_niveles['niveles_descripcion']) {
      $return['msg'] = 'Ya existe un nivel con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Verificamos si existe este orden en la lista de los niveles
    $_POST['niveles_orden_edit'] = strClean($_POST['niveles_orden_edit']);
    $seleccionar_niveles = $this->model->selectNivelesByOrden($_POST['niveles_orden_edit']);

    if ($seleccionar_niveles && $niveles['niveles_orden'] != $seleccionar_niveles['niveles_orden']) {
      $return['msg'] = 'Ya existe un nivel con este orden.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos el nivel
    $actualizar_niveles = $this->model->updateNivel($_POST['niveles_nombre_edit'], $_POST['niveles_orden_edit'], $_POST['niveles_id']);
    if ($actualizar_niveles) {
      $return = [
        'status' => true,
        'msg' => 'Nivel actualizado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarTerminologias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de editar una terminología.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['terminologias_nombre']) || empty($_POST['terminologias_nombre']) || !isset($_POST['terminologias_descripcion']) || empty($_POST['terminologias_descripcion']) || !isset($_POST['dependencia_id']) || !isset($_POST['terminologias_id']) || intval($_POST['terminologias_id']) === 0) {
      json($return);
    }

    // Verificamos que exista esta terminología
    $terminologia = $this->model->selectTerminologiaById($_POST['terminologias_id']);
    if (!$terminologia) {
      json($return);
    }

    // Verificamos si la terminología depende de si misma
    if (intval($terminologia['terminologias_id']) == intval($_POST['dependencia_id'])) {
      $return['msg'] = 'Esta terminología no puede depender de si misma.';
      $return['value'] = 'warning';

      json($return);
    }

    if (intval($_POST['dependencia_id']) !== 0) {
      $existeDependencia = $this->model->existeDependencia($_POST['terminologias_id'], $_POST['dependencia_id']);
      if ($existeDependencia) {
        $return['msg'] = 'Esta terminología ya tiene una dependencia.';
        $return['value'] = 'warning';

        json($return);
      }
    }

    // Verificamos si existe este nombre del nivel
    $_POST['terminologias_nombre'] = strClean($_POST['terminologias_nombre']);
    $seleccionar_terminologias = $this->model->selectTerminologiaByNombre($_POST['terminologias_nombre']);

    if ($seleccionar_terminologias && $terminologia['terminologias_nombre'] != $seleccionar_terminologias['terminologias_nombre']) {
      $return['msg'] = 'Ya existe una terminología con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    $_POST['dependencia_id'] = intval($_POST['dependencia_id']);
    $terminologia_new['terminologias_id'] = null;
    $orden = 1;
    if ($_POST['dependencia_id'] !== 0) {
      // Verificamos que exista esta terminología
      $terminologia_new = $this->model->selectTerminologiaById($_POST['dependencia_id']);
      if (!$terminologia_new) {
        json($return);
      }

      $orden = (intval($terminologia_new['terminologias_orden']) + 1);
    }

    if ($orden > 6) {
      $return['msg'] = 'Sobrepasa los 6 indexaciones de conceptos permitidas.';
      $return['value'] = 'warning';

      json($return);
    }

    $_POST['terminologias_descripcion'] = strClean($_POST['terminologias_descripcion']);
    // Insertamos una nueva terminología
    $actualizar_terminologia = $this->model->updateTerminologia(
      $_POST['terminologias_nombre'],
      $_POST['terminologias_descripcion'],
      $orden,
      $terminologia_new['terminologias_id'],
      $_POST['terminologias_id']
    );

    if ($actualizar_terminologia > 0) {
      $return = [
        'status' => true,
        'msg' => 'Terminología actualizada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarParrafo()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(12, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar el párrafo.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['parrafos_id']) || intval($_POST['parrafos_id']) === 0) {
      json($return);
    }

    // verificamos que exista este párrafo
    $parrafo = $this->model->selectParrafoById($_POST['parrafos_id']);
    if (!$parrafo) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_parrafo = $this->model->selectsParrafoConocimiento($_POST['parrafos_id']);
    if ($registros_parrafo) {
      $return['msg'] = 'Este párrafo se está utilizando en algunos registros, por lo cual no se piede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos el párrafo
    $eliminar_parrafo = $this->model->deleteParrafo($_POST['parrafos_id']);
    if ($eliminar_parrafo) {
      $return = [
        'status' => true,
        'msg' => 'Párrafo eliminado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarKeywords()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(13, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la palabra clave.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['keywords_id']) || intval($_POST['keywords_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta palabra clave
    $keywords = $this->model->selectKeywordsById($_POST['keywords_id']);
    if (!$keywords) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_keywords = $this->model->selectsDetalleKeywords($_POST['keywords_id']);
    if ($registros_keywords) {
      $return['msg'] = 'Esta palabra se encuentra vinculada en algunos registros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos la palabra clave
    $eliminar_keyword = $this->model->deleteKeywords($_POST['keywords_id']);
    if ($eliminar_keyword) {
      $return = [
        'status' => true,
        'msg' => 'Palabra clave eliminada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarMaterias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(14, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la materia.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['materias_id']) || intval($_POST['materias_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta materia
    $materia = $this->model->selectMateriaById($_POST['materias_id']);
    if (!$materia) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_materias = $this->model->selectsDetalleMateria($_POST['materias_id']);
    if ($registros_materias) {
      $return['msg'] = 'Esta materia se encuentra vinculada en algunos registros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos la materia
    $eliminar_materia = $this->model->deleteMateria($_POST['materias_id']);
    if ($eliminar_materia) {
      $return = [
        'status' => true,
        'msg' => 'Materia eliminada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarCategorias()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(15, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la categoría.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['categorias_id']) || intval($_POST['categorias_id']) === 0) {
      json($return);
    }

    // verificamos que exista esta categoria
    $categoria = $this->model->selectCategoriaById($_POST['categorias_id']);
    if (!$categoria) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_categorias = $this->model->selectCategoriaLibro($_POST['categorias_id']);
    if ($registros_categorias) {
      $return['msg'] = 'Esta categoría se encuentra vinculada con algunos libros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos la categoria
    $eliminar_categoria = $this->model->deleteCategoria($_POST['categorias_id']);
    if ($eliminar_categoria) {
      $return = [
        'status' => true,
        'msg' => 'Categoría eliminada correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarNiveles()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(16, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar el nivel.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['niveles_id']) || intval($_POST['niveles_id']) === 0) {
      json($return);
    }

    // verificamos que exista este nivel
    $niveles = $this->model->selectnivelesById($_POST['niveles_id']);
    if (!$niveles) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_niveles = $this->model->selectNivelesLibro($_POST['niveles_id']);
    if ($registros_niveles) {
      $return['msg'] = 'Este nivel se encuentra vinculado con algunos libros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos el nivel
    $eliminar_nivel = $this->model->deleteNiveles($_POST['niveles_id']);
    if ($eliminar_nivel) {
      $return = [
        'status' => true,
        'msg' => 'Nivel eliminado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarDependencia()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la dependencia.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['terminologias_id']) || intval($_POST['terminologias_id']) === 0) {
      json($return);
    }

    // Verificamos que exista esta terminología
    $terminologia = $this->model->selectTerminologiaById($_POST['terminologias_id']);
    if (!$terminologia) {
      json($return);
    }

    // Verificamos que no tenga dependenciones
    $dependencia = $this->model->selectsDependenciaTermminologiaById($_POST['terminologias_id']);
    if ($dependencia) {
      $return['msg'] = 'Esta terminología ya tiene dependencias.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos la dependencia a null
    $dependencia = $this->model->updateDependencia(null, 1, $_POST['terminologias_id']);
    if ($dependencia) {
      $return = array(
        'status' => true,
        'msg' => 'Dependencia eliminada correctamente.',
        'value' => 'success'
      );
    }

    json($return);
  }

  public function eliminarTerminologia()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(17, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la terminología.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['terminologias_id']) || intval($_POST['terminologias_id']) === 0) {
      json($return);
    }

    // verificamos que exista la terminologia
    $terminologia = $this->model->selectTerminologiaById($_POST['terminologias_id']);
    if (!$terminologia) {
      json($return);
    }
    // verificamos que no tenga registros
    $registros_terminologia = $this->model->selectTerminologiaConocimiento($_POST['terminologias_id']);
    if ($registros_terminologia) {
      $return['msg'] = 'Este terminología se encuentra vinculado con algunos conocimientos, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos la terminología
    $eliminar_terminologia = $this->model->deleteTerminologia($_POST['terminologias_id']);
    if ($eliminar_terminologia) {
      $return = [
        'status' => true,
        'msg' => 'Terminología eliminado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }
}
