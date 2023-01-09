<?php

require_once PATH_CONTROLLERS . 'ApiAnalizadorSemantico.php';
class BusquedaInteligente extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function motorBusqueda()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(21, true);

    $data['page_id'] = 100;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Motor de busqueda";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "busqueda_avanzada/function_busqueda";
    $this->views->getView($this, "buscador", $data);
  }

  function reporte()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(24, true);

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET) || !isset($_GET['texto']) || empty($_GET['texto'])) {
      location('BusquedaInteligente/motorBusqueda');
    }

    $data['page_id'] = 101;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Reporte de conceptos";
    $data['lista_conceptos'] = $this->buscarconcepto($_GET['texto']);
    $this->views->getView($this, "reporte/logica", $data);
  }

  function verBook()
  {

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET)) {
      location('Inicio');
    }

    $view_contenido = false;
    if (isset($_GET['viewcontenido']) && isset($_GET['libro_id']) && intval($_GET['libro_id']) !== 0) {
      $view_contenido = true;
    }

    if (!$view_contenido && isset($_GET['viewcontenido'])) {
      location('Inicio');
    }


    if (!$view_contenido) {
      if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET) || !isset($_GET['ter_asociado']) || empty($_GET['ter_asociado']) || !isset($_GET['libro_id']) || intval($_GET['libro_id']) === 0 || !isset($_GET['concepto_id']) || intval($_GET['concepto_id']) === 0) {
        location('BusquedaInteligente/motorBusqueda');
      }
    }


    $datos_libro = $this->model->selectLibroById($_GET['libro_id']);
    if (!$datos_libro) {
      if ($view_contenido) {
        location('Inicio');
      } else {
        location('ConfiguracionLibros/libros');
      }
    }

    $editorial = null;
    if (!is_null($datos_libro[0]['editoriales_id'])) {
      $editorial = $this->model->selectEditorial($datos_libro[0]['editoriales_id']);
    }


    parent::verificarLogin(true);
    parent::verificarPermiso(21, true);
    $data['page_id'] = 100;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Libro";
    $data['page_css'] = "configuracionlibros/libros";
    $data['data-libro'] = $datos_libro;
    $data['data-editoriales'] = $editorial;
    $data['data-tablacontenidos'] = $this->tablaContenidos($_GET['libro_id'], false);
    $data['data-conceptostitulos'] = $this->selectConceptoTitulos($_GET['libro_id'], false);

    $data['data-terminologias'] = $this->SelectDataTerminologias($_GET['libro_id']);
    if (!$view_contenido) {
      $data['terminologia'] = array('id' => $_GET['concepto_id'], 'name' => $_GET['ter_asociado']);
    }

    $data['page_function_js'] = "busqueda_avanzada/function_verbook";

    // json($data['data-tablacontenidos']);

    $this->views->getView($this, "verLibro", $data);
  }

  public function buscarconcepto($cadena = null)
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(21, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de buscar conceptos.',
      'value' => 'error'
    ];

    if (is_null($cadena)) {
      if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['texto']) || empty($_POST['texto'])) {
        json($return);
      }

      // 1 etapa: Definición de la cadena de busqueda

      $str = strClean($_POST['texto']);
    } else {
      $str = strClean($cadena);
    }

    // 2 etapa: Aplicacion del analizador semantico

    $arraPrincipal = array(
      'entidades' => array(),
      'sintagmas' => array(),
    );

    // Paso 1 => Encontrar las entidades nominales de la cadena de texto
    $arrayOracionesEntidades = $this->apiSeleccionarEntidades($str);
    // Verificamos si existe resultados
    if (empty($arrayOracionesEntidades)) {
      $return['msg'] = 'La búsqueda no brinda resultados';
      $return['value'] = 'warning';

      if (is_null($cadena)) {
        json($return);
      } else {
        return $return;
      }
    }

    // Agregarmos las entidades a nuestro array principal
    $arraPrincipal['entidades'] = $arrayOracionesEntidades->entidades;

    // Paso 2 => Encontrar las oraciones de la cadena de texto
    // Paso 3 => Encontrar la sintagmas de las oraciones

    // Recorremos las oraciones
    $auxArraySM = array();
    foreach ($arrayOracionesEntidades->oraciones as $key => $value) {
      array_push($auxArraySM, $this->dividirOracionesSM($value)->sintagmas);
    }


    // Agregamos los sintagmas al array principal
    foreach ($auxArraySM as $key => $value) {
      foreach ($value as $llave => $valor) {
        array_push($arraPrincipal['sintagmas'], $valor);
      }
    }

    // Etapa 3: Eliminación de términos duplicados en comparacion con los sintagmas y las entidades.
    // Unimos en un solo arreglo las las terminologías
    $auxTerminologias = [];
    foreach ($arraPrincipal['entidades'] as $key => $value) {
      array_push($auxTerminologias, $value);
    }

    foreach ($arraPrincipal['sintagmas'] as $key => $value) {
      array_push($auxTerminologias, $value);
    }

    $termNoDuplicados = [];
    foreach ($auxTerminologias as $key => $value) {
      $termNoDuplicados[$value] = $value;
    }

    $arrayBusqueda = [];
    foreach ($termNoDuplicados as $key => $value) {
      array_push($arrayBusqueda, $value);
    }

    // Etapa 4: Eliminamos las palabras poco significativas menores que 4 caracteres y almacenamos en un array
    foreach ($arrayBusqueda as $key => $value) {
      if (strlen($value) < 4) {
        unset($arrayBusqueda[$key]);
      }
    }

    // Etapa 5: Especificación del algoritmo de Boyer Moore

    // Consultamos los libros
    $seleccionar_libro = $this->model->libroConceptos();
    $arrayLibros = [];
    foreach ($seleccionar_libro as $key => $value) {
      $arrayLibros[$value['conocimiento_id']] = [
        'libro_id' => $value['libro_id'],
        'libro_titulo' => $value['libro_titulo'],
        'libro_imagen' => $value['libro_imagen']
      ];
    }

    // Consultamos la lista de terminologías de la Base de conocimiento BD
    $base_conocimiento = $this->model->baseConocimiento();

    // json($base_conocimiento);
    // relacionamos terminologias con sus conceptos
    $arrayBaseConocimiento = [];
    $cont = 0;
    $contTer = 0;
    foreach ($base_conocimiento as $key => $value) {
      if (!isset($arrayBaseConocimiento[$cont]['concepto']) || $arrayBaseConocimiento[$cont]['concepto'] !== $value['conocimiento_descripcion']) {
        // json($value);
        $arrayBaseConocimiento[$cont]['concepto_id'] = $value['conocimiento_id'];
        $arrayBaseConocimiento[$cont]['concepto'] = $value['conocimiento_descripcion'];
        $arrayBaseConocimiento[$cont]['terminologias'][$contTer] = $value['terminologias_nombre'];
        $arrayBaseConocimiento[$cont]['libro'] = $arrayLibros[$value['conocimiento_id']];
      } else {
        $contTer = $contTer + 1;
        $arrayBaseConocimiento[$cont]['terminologias'][$contTer] = $value['terminologias_nombre'];

        if (isset($base_conocimiento[$key + 1]) && $value['conocimiento_descripcion'] !== $base_conocimiento[$key + 1]['conocimiento_descripcion']) {
          $cont = $cont + 1;
        }
      }
    }

    // $arrayBusqueda terminologías a buscar
    // $arrayBaseConocimiento con conceptos

    // Aplicamos el algoritmo de Boyer Moore
    // Recorremos la base de conocimiento

    $arrayResponse = [];
    $terminologias_relacionadas = [];
    foreach ($arrayBusqueda as $key => $patter) {
      foreach ($arrayBaseConocimiento as $sum => $value) {
        foreach ($value['terminologias'] as $llave => $texto) {
          // Comparamos con la base de conocimiento
          $concepto = $this->BoyerMoore(strtolower($texto), strtolower($patter));
          if ($concepto >= 0) {

            array_push($arrayResponse, [
              'concepto_id' => $value['concepto_id'],
              'concepto' => $value['concepto'],
              'libro' => $value['libro'],
              'ter_asociado' => $texto,
            ]);


            foreach ($value['terminologias'] as $con => $term) {
              array_push($terminologias_relacionadas, $term);
            }
            break;
          }
        }
      }
    }

    // Buscamos todos los conceptos relacionados a las terminologías
    // arrayRelacionados
    $arrayRelacionados = [];
    foreach ($base_conocimiento as $key => $value) {
      foreach ($terminologias_relacionadas as $llave => $valor) {
        if ($value['terminologias_nombre'] == $valor) {
          array_push($arrayRelacionados, [
            'concepto_id' => $value['conocimiento_id'],
            'concepto' => $value['conocimiento_descripcion'],
            'libro' => $arrayLibros[$value['conocimiento_id']],
            'ter_asociado' => $valor,
          ]);
        }
      }
    }

    // Verificamos que no se repitan
    $arrayExiste = [];
    $arrayCorrectoResponse = [];
    foreach ($arrayResponse as $key => $value) {
      if (!isset($arrayExiste[$value['concepto_id']])) {
        $arrayExiste[$value['concepto_id']] = 'Existe';
        array_push($arrayCorrectoResponse, $value);
      }
    }

    // Combinamos los array de resultados
    foreach ($arrayRelacionados as $key => $value) {
      if (!isset($arrayExiste[$value['concepto_id']])) {
        $arrayExiste[$value['concepto_id']] = 'Existe';
        array_push($arrayCorrectoResponse, $value);
      }
    }

    if (empty($arrayCorrectoResponse)) {
      $return['msg'] = 'La búsqueda no brinda resultados';
      $return['value'] = 'warning';

      if (is_null($cadena)) {
        json($return);
      } else {
        return $return;
      }
    }


    $return = array(
      'status' => true,
      'msg' => 'Lista de conceptos',
      'value' => 'success',
      'data' => $arrayCorrectoResponse
    );

    if (is_null($cadena)) {
      json($return);
    } else {
      return $return;
    }
  }

  public function apiSeleccionarEntidades($cadenaTexto = '')
  {
    // Verificamos que la cadena de texto no este vacia
    if (empty($cadenaTexto)) {
      return array();
    }

    // el texto lo envaluamos en la Api Externa ********** API PLN NIL ************
    $apiSemantico = new ApiAnalizadorSemantico(false);

    $arrayResult = $apiSemantico->OracionesEntidades($cadenaTexto);

    if ($arrayResult == null || isset($arrayResult->error)) {
      return array();
    }

    return $arrayResult;
  }

  public function dividirOracionesSM($oracion)
  {
    // Verificamos que la cadena de texto no este vacia
    if (empty($oracion)) {
      return array();
    }
    // el texto lo envaluamos en la Api Externa ********** API PLN NIL ************
    $apiSemantico = new ApiAnalizadorSemantico(false);

    $arrayResult = $apiSemantico->sintagmaMorfologico($oracion);

    if ($arrayResult == null || isset($arrayResult->error)) {
      return array();
    }

    foreach ($arrayResult->morfologico as $key => $value) {
      array_push($arrayResult->sintagmas, $value->palabra);
    }

    return $arrayResult;
  }

  function BoyerMoore($text, $pattern)
  {
    $patlen = strlen($pattern);
    $textlen = strlen($text);
    $table = $this->makeCharTable($pattern);

    for ($i = $patlen - 1; $i < $textlen;) {
      $t = $i;
      for ($j = $patlen - 1; $pattern[$j] == $text[$i]; $j--, $i--) {
        if ($j == 0) return $i;
      }
      $i = $t;
      if (array_key_exists($text[$i], $table))
        $i = $i + max($table[$text[$i]], 1);
      else
        $i += $patlen;
    }
    return -1;
  }

  function makeCharTable($string)
  {
    $len = strlen($string);
    $table = array();
    for ($i = 0; $i < $len; $i++) {
      $table[$string[$i]] = $len - $i - 1;
    }
    return $table;
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
          'paginas_id' => $value_1['paginas_id'],
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
                'paginas_id' => $value_1['paginas_id'],
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
                      'paginas_id' => $value_1['paginas_id'],
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
                            'paginas_id' => $value_1['paginas_id'],
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
                                  'paginas_id' => $value_1['paginas_id'],
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
          'conocimiento_descripcion' => $value['conocimiento_descripcion'],
          'conocimiento_id' => $value['conocimiento_id']
        );
      } else {
        array_push($auxConocimientoOrdenado[$value['detalle_niveles_id']], array(
          'detalle_conocimiento_id' => $value['detalle_conocimiento_id'],
          'parrafos_orden' => $value['parrafos_orden'],
          'detalle_conocimiento_orden' => $value['detalle_conocimiento_orden'],
          'conocimiento_descripcion' => $value['conocimiento_descripcion'],
          'conocimiento_id' => $value['conocimiento_id']
        ));
      }
    }

    return $auxConocimientoOrdenado;
  }

  public function SelectDataTerminologias(int $libro_id)
  {
    $dataTerminologias = $this->model->getDataTerminologias($libro_id);
    $auxDataTerminologias = array();
    foreach ($dataTerminologias as $key => $value) {
      array_push($auxDataTerminologias, array(
        'conocimiento_id' => $value['conocimiento_id'],
        'terminologias_id' => $value['terminologias_id'],
        'terminologias_nombre' => $value['terminologias_nombre'],
        'paginas_id' => $value['paginas_id']
      ));
    }

    return $auxDataTerminologias;
  }
}
