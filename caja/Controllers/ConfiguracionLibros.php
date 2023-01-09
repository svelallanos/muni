<?php
class ConfiguracionLibros extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function libros()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    $data['page_id'] = 13;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Libros digitales";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "configuracionlibros/functions_libros";
    $this->views->getView($this, "libros", $data);
  }

  public function viewAgregarLibros()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    $data['page_id'] = 25;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Agregar nuevo libro";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "configuracionlibros/functions_libros";
    $data['data-tipolibro'] = $this->model->TipoLibros();
    $data['data-categorias'] = $this->model->selectCategorias();
    $this->views->getView($this, "agregarlibro", $data);
  }

  public function viewEditarLibros()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET) || !isset($_GET['libro_id']) || intval($_GET['libro_id']) === 0) {
      location('ConfiguracionLibros/libros');
    }

    $datos_libro = $this->model->selectLibroById($_GET['libro_id']);
    if (!$datos_libro) {
      location('ConfiguracionLibros/libros');
    }

    $auxTipoLibro = array();
    $seleccionar_tipodetalle = $this->model->selectDetalleTipoLibroById($datos_libro['libro_id']);
    foreach ($seleccionar_tipodetalle as $key => $value) {
      $auxTipoLibro[$value['tipo_libro_id']] = 'existe';
    }

    $data['page_id'] = 26;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Editar libro";
    $data['page_css'] = "configuracionlibros/libros";
    $data['page_function_js'] = "configuracionlibros/functions_libros";
    $data['data-tipolibro'] = $this->model->TipoLibros();
    $data['data-categorias'] = $this->model->selectCategorias();
    $data['data-libro'] = $datos_libro;
    $data['data-tipo'] = $auxTipoLibro;
    $this->views->getView($this, "editarlibro", $data);
  }

  public function autores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    $data['page_id'] = 12;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de autores";
    $data['page_css'] = "configuracionlibros/autores";
    $data['page_function_js'] = "configuracionlibros/functions_autores";
    $this->views->getView($this, "autores", $data);
  }

  public function editoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(10, true);

    $data['page_id'] = 28;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Lista de editoriales";
    // $data['page_css'] = "configuracionlibros/autores";
    $data['page_function_js'] = "configuracionlibros/functions_editoriales";
    $this->views->getView($this, "editoriales", $data);
  }

  public function selectAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    $seleccionar_autores = $this->model->selectAutores();
    foreach ($seleccionar_autores as $key => $value) {
      $seleccionar_autores[$key]['numero'] = ($key + 1);
      $seleccionar_autores[$key]['autores_imagen'] = '<img class="autor_imagen_tb" src="' . media() . '/images/autores/' . $value['autores_imagen'] . '" alt="imagen">';
      $seleccionar_autores[$key]['autores_estado'] = '<span class="badge bg-danger-soft rounded-pill text-danger">Inactivo</span>';
      if ($value['autores_estado'] == 1) {
        $seleccionar_autores[$key]['autores_estado'] = '<span class="badge bg-success-soft rounded-pill text-success">Activo</span>';
      }

      $seleccionar_autores[$key]['options'] = '
      <button 
      title="Editar autor" 
      data-autores_id = "' . $value['autores_id'] . '" 
      data-autores_nombre = "' . $value['autores_nombre'] . '" 
      data-autores_descripcion = "' . $value['autores_descripcion'] . '" 
      data-autores_imagen = "' . $value['autores_imagen'] . '" 
      data-autores_estado = "' . $value['autores_estado'] . '" 
      data-url="' . media() . '/images/autores"
      class="btn_editar_autores btn btn-icon btn-sm btn-cyan"><i class="feather-edit"></i></button>
      <button title="Eliminar autor" 
      data-autores_id = "' . $value['autores_id'] . '" 
      class="btn_eliminar_autores btn btn-icon btn-sm btn-danger ml-2"><i class="fa-regular fa-trash-can"></i></button>
      <button 
      title="Ver detalle del autor" 
      data-autores_nombre = "' . $value['autores_nombre'] . '" 
      data-autores_descripcion = "' . $value['autores_descripcion'] . '" 
      data-autores_imagen = "' . $value['autores_imagen'] . '" 
      data-autores_estado = "' . $value['autores_estado'] . '" 
      class="btn_ver_autores btn btn-icon btn-sm btn-primary"><i class="fa-regular fa-eye"></i></button>
      ';
    }

    json($seleccionar_autores);
  }

  public function selectEditoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(10, true);

    $seleccionar_editoriales = $this->model->selectEditoriales();
    foreach ($seleccionar_editoriales as $key => $value) {
      $seleccionar_editoriales[$key]['numero'] = ($key + 1);
      $seleccionar_editoriales[$key]['editoriales_nombre'] = recortar_cadena($value['editoriales_nombre'], 20);
      $seleccionar_editoriales[$key]['editoriales_descripcion'] = recortar_cadena($value['editoriales_descripcion'], 40);
      $seleccionar_editoriales[$key]['editoriales_estado'] = '<span class="badge bg-danger-soft rounded-pill text-danger">Inactivo</span>';
      if ($value['editoriales_estado'] == 1) {
        $seleccionar_editoriales[$key]['editoriales_estado'] = '<span class="badge bg-success-soft rounded-pill text-success">Activo</span>';
      }

      $seleccionar_editoriales[$key]['options'] = '
      <button 
      title="Editar editorial" 
      data-editoriales_id = "' . $value['editoriales_id'] . '" 
      data-editoriales_nombre = "' . $value['editoriales_nombre'] . '" 
      data-editoriales_descripcion = "' . $value['editoriales_descripcion'] . '" 
      data-editoriales_estado = "' . $value['editoriales_estado'] . '" 
      class="btn_editar_editoriales btn btn-icon btn-sm btn-cyan"><i class="feather-edit"></i></button>
      <button title="Eliminar autor" 
      data-editoriales_id = "' . $value['editoriales_id'] . '" 
      class="btn_eliminar_editoriales btn btn-icon btn-sm btn-danger ml-2"><i class="fa-regular fa-trash-can"></i></button>
      <button 
      title="Ver detalle del editorial" 
      data-editoriales_nombre = "' . $value['editoriales_nombre'] . '" 
      data-editoriales_descripcion = "' . $value['editoriales_descripcion'] . '" 
      data-editoriales_estado = "' . $value['editoriales_estado'] . '" 
      class="btn_ver_editoriales btn btn-icon btn-sm btn-primary"><i class="fa-regular fa-eye"></i></button>
      ';
    }

    json($seleccionar_editoriales);
  }

  public function selectLibros()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    $auxTipoLibros = array();
    $seleccionar_tipolibros = $this->model->selectTipoLibros();
    foreach ($seleccionar_tipolibros as $key => $value) {
      if (!isset($auxTipoLibros[$value['libro_id']])) {
        $auxTipoLibros[$value['libro_id']] = '<span class="badge bg-light border border-blue text-blue">' . $value['tipo_libro_nombre'] . '</span>';
      } else {
        $auxTipoLibros[$value['libro_id']] .= '<span class="ml-2i badge bg-light border border-blue text-blue">' . $value['tipo_libro_nombre'] . '</span>';
      }
    }

    $seleccionar_libros = $this->model->selectLibros();
    foreach ($seleccionar_libros as $key => $value) {
      if (isset($auxTipoLibros[$value['libro_id']])) {
        $seleccionar_libros[$key]['tipo_libro'] = $auxTipoLibros[$value['libro_id']];
      } else {
        $seleccionar_libros[$key]['tipo_libro'] = '<p style="font-style: italic;" class="m-0 small">Ningún tipo</p>';
      }

      $seleccionar_libros[$key]['numero'] = ($key + 1);
      $seleccionar_libros[$key]['libro_titulo'] = recortar_cadena($value['libro_titulo'], 35);
      $seleccionar_libros[$key]['libro_imagen'] = '<img class="libro_imagen_tb" src="' . media() . '/images/libros/' . $value['libro_imagen'] . '" alt="imagen">';
      $seleccionar_libros[$key]['libro_estado'] = '<span class="badge bg-danger-soft rounded-pill text-danger">Inactivo</span>';
      if ($value['libro_estado'] == 1) {
        $seleccionar_libros[$key]['libro_estado'] = '<span class="badge bg-success-soft rounded-pill text-success">Activo</span>';
      }

      $seleccionar_libros[$key]['options'] = '
      <a 
      title="Editar libro" 
      href="' . base_url() . 'ConfiguracionLibros/viewEditarLibros?libro_id=' . $value['libro_id'] . '" 
      class="btn btn-icon btn-sm btn-warning"><i class="feather-edit"></i></a>
      <button title="Eliminar libro" 
      data-libro_id = "' . $value['libro_id'] . '" 
      class="btn_eliminar_libro btn btn-icon btn-sm btn-danger ml-2"><i class="fa-regular fa-trash-can"></i></button>
      <a 
      title="Ver libro"
      href="#" 
      class="btn btn-icon btn-sm btn-cyan"><i class="fa-regular fa-eye"></i></a>
      <a 
      title="Agregar contenindo libro"
      href="' . base_url() . 'ContenidoLibro/contenido?libro_id=' . $value['libro_id'] . '" 
      class="btn btn-icon btn-sm btn-primary"><i class="feather-file-text"></i></a>
      ';
    }

    json($seleccionar_libros);
  }

  public function agregarAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar un autor.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['autores_descripcion']) || empty($_POST['autores_descripcion']) || !isset($_POST['autores_nombre']) || empty($_POST['autores_nombre'])) {
      json($return);
    }

    // Verificamos que no exista un autor con este nombre
    $_POST['autores_nombre'] = strClean($_POST['autores_nombre']);
    $seleccionar_autor = $this->model->selectAutorByNombre($_POST['autores_nombre']);
    if ($seleccionar_autor) {
      $return['msg'] = 'Ya existe un autor con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Verificamos si existe un file para subir
    $onlyName = 'sin_foto.png';
    if (isset($_FILES['autores_imagen']) && $_FILES['autores_imagen']['name'] != '' && $_FILES['autores_imagen']['error'] == 0) {

      if ($_FILES['autores_imagen']['type'] !== 'image/jpeg' && $_FILES['autores_imagen']['type'] !== 'image/png') {
        $return['msg'] = 'Formato de imagen no válida.';
        $return['value'] = 'warning';

        json($return);
      }

      $file = $_FILES['autores_imagen'];

      $file['name'] = getExtension($file['name']);
      $noValido = true;

      foreach (getExtFotos() as $key => $value) {
        if ($value == $file['name']) {
          $noValido = false;
          break;
        }
      }

      if ($file['name'] == false || $noValido) {
        $return['msg'] = 'Tipo de imagen no válida, seleccione otra';
        $return['value'] = 'warning';

        json($return);
      }

      $file['name'] = 'autor_profile_' . date('Ymd_His') . '.' . $file['name'];
      $onlyName = $file['name'];
      $file['name'] = getPathFotoAutor() . $file['name'];

      $uploaded = move_uploaded_file($file['tmp_name'], $file['name']);

      if (!$uploaded) {
        json($return);
      }
    }

    // Insertamos un nuevo autor
    $_POST['autores_descripcion'] = strClean($_POST['autores_descripcion']);
    $insertar_autor = $this->model->insertNewAutor(
      $_POST['autores_nombre'],
      $_POST['autores_descripcion'],
      $onlyName
    );

    if ($insertar_autor > 0) {
      $return = [
        'status' => true,
        'msg' => 'Autor registrado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarEditoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(10, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar una editorial.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['editoriales_nombre']) || empty($_POST['editoriales_nombre']) || !isset($_POST['editoriales_descripcion']) || empty($_POST['editoriales_descripcion'])) {
      json($return);
    }

    // Verificamos que no exista una editorial con este nombre
    $_POST['editoriales_nombre'] = strClean($_POST['editoriales_nombre']);
    $seleccionar_editorial = $this->model->selectEditorialByNombre($_POST['editoriales_nombre']);
    if ($seleccionar_editorial) {
      $return['msg'] = 'Ya existe una editorial con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Insertamos un nueva editorial
    $_POST['editoriales_descripcion'] = strClean($_POST['editoriales_descripcion']);
    $insertar_editorial = $this->model->insertNewEditorial(
      $_POST['editoriales_nombre'],
      $_POST['editoriales_descripcion']
    );

    if ($insertar_editorial > 0) {
      $return = [
        'status' => true,
        'msg' => 'Editorial registrado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function agregarLibro()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de agregar un libro.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['categorias_id']) || intval($_POST['categorias_id']) === 0 ||  !isset($_POST['libro_paginas']) || intval($_POST['libro_paginas']) === 0 || !isset($_POST['libro_titulo']) || empty($_POST['libro_titulo'])) {
      json($return);
    }

    // Verificamos que no exista un libro con este nombre
    $_POST['libro_titulo'] = strClean($_POST['libro_titulo']);
    $seleccionar_libro = $this->model->selectLibroByTitulo($_POST['libro_titulo']);
    if ($seleccionar_libro) {
      $return['msg'] = 'Ya existe un libro con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // verificamos que exista la categoria
    $seleccionar_categoria = $this->model->selectCategoriaById($_POST['categorias_id']);
    if (!$seleccionar_categoria) {
      json($return);
    }

    // Validamos datos secundarios 
    // Validamos el resumen

    $resumen = null;
    if (isset($_POST['libro_resumen']) && !empty($_POST['libro_resumen'])) {
      $resumen = strClean($_POST['libro_resumen']);
    }
    // Validamos el isbn
    $isbn = null;
    if (isset($_POST['libro_isbn']) && !empty($_POST['libro_isbn'])) {
      $isbn = strClean($_POST['libro_isbn']);
    }

    // Validamos la edision 
    $edision = null;
    if (isset($_POST['libro_edision']) && !empty($_POST['libro_edision'])) {
      $edision = strClean($_POST['libro_edision']);
    }

    // Validamos el volumen
    $volumen = 0;
    if (isset($_POST['libro_volumen']) && $_POST['libro_volumen'] != '') {
      $volumen = intval($_POST['libro_volumen']);
    }

    // validamos el peso
    $peso = null;
    if (isset($_POST['libro_peso']) && intval($_POST['libro_peso']) !== 0) {
      $peso = intval($_POST['libro_peso']);
    }

    // Verificamos si existe un file para subir
    $onlyName = 'libro_sinfoto.png';
    if (isset($_FILES['libro_imagen_add']) && $_FILES['libro_imagen_add']['name'] != '' && $_FILES['libro_imagen_add']['error'] == 0) {

      if ($_FILES['libro_imagen_add']['type'] !== 'image/jpeg' && $_FILES['libro_imagen_add']['type'] !== 'image/png') {
        $return['msg'] = 'Formato de imagen no válida.';
        $return['value'] = 'warning';

        json($return);
      }

      $file = $_FILES['libro_imagen_add'];

      $file['name'] = getExtension($file['name']);
      $noValido = true;

      foreach (getExtFotos() as $key => $value) {
        if ($value == $file['name']) {
          $noValido = false;
          break;
        }
      }

      if ($file['name'] == false || $noValido) {
        $return['msg'] = 'Tipo de imagen no válida, seleccione otra';
        $return['value'] = 'warning';

        json($return);
      }

      $file['name'] = 'libro_profile_' . date('Ymd_His') . '.' . $file['name'];
      $onlyName = $file['name'];
      $file['name'] = getPathFotoLibro() . $file['name'];

      $uploaded = move_uploaded_file($file['tmp_name'], $file['name']);

      if (!$uploaded) {
        json($return);
      }
    }

    // Insertamos un nuevo libro
    $insertar_libro = $this->model->insertNewLibro(
      $_POST['libro_titulo'],
      $resumen,
      $_POST['libro_paginas'],
      $isbn,
      $edision,
      $volumen,
      $peso,
      $onlyName,
      $_POST['categorias_id']
    );

    $correcto = true;

    if ($insertar_libro > 0) {
      $seleccionar_tipo = $this->model->TipoLibros();
      foreach ($seleccionar_tipo as $key => $value) {
        if (isset($_POST['tipo_' . $value['tipo_libro_id']])) {
          $insertar_tipo = $this->model->insertTipoByLibro($insertar_libro, $value['tipo_libro_id']);
          if ($insertar_tipo <= 0) {
            $correcto = false;
          }
        }
      }
    }

    if (!$correcto) {
      $return = [
        'status' => true,
        'msg' => 'Libro registrado, pero algunos tipos no se añadieron correctamente al libro.',
        'value' => 'success'
      ];
    } else {
      $return = [
        'status' => true,
        'msg' => 'Libro registrado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar el autor.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['autores_nombre_edit']) || empty($_POST['autores_nombre_edit']) || !isset($_POST['autores_descripcion_edit']) || empty($_POST['autores_descripcion_edit']) || !isset($_POST['autores_estado_edit']) || intval($_POST['autores_estado_edit']) === 0 || !isset($_POST['autores_id']) || intval($_POST['autores_id']) === 0) {
      json($return);
    }

    // verificamos que exista este autor
    $autor = $this->model->selectAutoresById($_POST['autores_id']);
    if (!$autor) {
      json($return);
    }

    // Verificamos si existe este nombre del autor
    $_POST['autores_nombre_edit'] = strClean($_POST['autores_nombre_edit']);
    $seleccionar_autor = $this->model->selectAutorByNombre($_POST['autores_nombre_edit']);

    if ($seleccionar_autor && $autor['autores_nombre'] != $seleccionar_autor['autores_nombre']) {
      $return['msg'] = 'Ya existe un autor con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos el autor
    $_POST['autores_descripcion_edit'] = strClean($_POST['autores_descripcion_edit']);
    $actualizar_autor = $this->model->updateAutores($_POST['autores_nombre_edit'], $_POST['autores_descripcion_edit'], $_POST['autores_estado_edit'], $_POST['autores_id']);
    if ($actualizar_autor) {
      $return = [
        'status' => true,
        'msg' => 'Datos de autor actualizado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarEditoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(10, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de actualizar la editorial.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['editoriales_nombre_edit']) || empty($_POST['editoriales_nombre_edit']) || !isset($_POST['editoriales_descripcion_edit']) || empty($_POST['editoriales_descripcion_edit']) || !isset($_POST['editoriales_estado_edit']) || intval($_POST['editoriales_estado_edit']) === 0 || !isset($_POST['editoriales_id']) || intval($_POST['editoriales_id']) === 0) {
      json($return);
    }

    // verificamos que exista al editorial
    $editorial = $this->model->selectEditorialesById($_POST['editoriales_id']);
    if (!$editorial) {
      json($return);
    }

    // Verificamos si existe este nombre del editorial
    $_POST['editoriales_nombre_edit'] = strClean($_POST['editoriales_nombre_edit']);
    $seleccionar_editorial = $this->model->selectEditorialByNombre($_POST['editoriales_nombre_edit']);

    if ($seleccionar_editorial && $editorial['editoriales_nombre'] != $seleccionar_editorial['editoriales_nombre']) {
      $return['msg'] = 'Ya existe una editorial con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // Actualizamos la editorial
    $_POST['editoriales_descripcion_edit'] = strClean($_POST['editoriales_descripcion_edit']);
    $actualizar_editorial = $this->model->updateEditoriales($_POST['editoriales_nombre_edit'], $_POST['editoriales_descripcion_edit'], $_POST['editoriales_estado_edit'], $_POST['editoriales_id']);
    if ($actualizar_editorial) {
      $return = [
        'status' => true,
        'msg' => 'Datos de la editorial actualizado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function editarLibro()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de editar el libro.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['categorias_id']) || intval($_POST['categorias_id']) === 0 ||  !isset($_POST['libro_paginas']) || intval($_POST['libro_paginas']) === 0 || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0 || !isset($_POST['libro_estado']) || intval($_POST['libro_estado']) === 0 || !isset($_POST['libro_titulo']) || empty($_POST['libro_titulo'])) {
      json($return);
    }

    // Verificamos que exista el libro
    $libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$libro) {
      json($return);
    }

    if ($_POST['libro_estado'] != 1 && $_POST['libro_estado'] != 2) {
      json($return);
    }

    // Verificamos que no exista un libro con este nombre
    $_POST['libro_titulo'] = strClean($_POST['libro_titulo']);
    $seleccionar_libro = $this->model->selectLibroByTitulo($_POST['libro_titulo']);
    if ($seleccionar_libro && $libro['libro_titulo'] !== $seleccionar_libro['libro_titulo']) {
      $return['msg'] = 'Ya existe un libro con este nombre.';
      $return['value'] = 'warning';

      json($return);
    }

    // verificamos que exista la categoria
    $seleccionar_categoria = $this->model->selectCategoriaById($_POST['categorias_id']);
    if (!$seleccionar_categoria) {
      json($return);
    }

    // Validamos datos secundarios 
    // validamos el resumen
    $resumen = null;
    if (isset($_POST['libro_resumen']) && !empty($_POST['libro_resumen'])) {
      $resumen = strClean($_POST['libro_resumen']);
    }

    // Validamos el isbn
    $isbn = null;
    if (isset($_POST['libro_isbn']) && !empty($_POST['libro_isbn'])) {
      $isbn = strClean($_POST['libro_isbn']);
    }

    // Validamos la edision 
    $edision = null;
    if (isset($_POST['libro_edision']) && !empty($_POST['libro_edision'])) {
      $edision = strClean($_POST['libro_edision']);
    }

    // Validamos el volumen
    $volumen = 0;
    if (isset($_POST['libro_volumen']) && $_POST['libro_volumen'] != '') {
      $volumen = intval($_POST['libro_volumen']);
    }

    // validamos el peso
    $peso = null;
    if (isset($_POST['libro_peso']) && intval($_POST['libro_peso']) !== 0) {
      $peso = intval($_POST['libro_peso']);
    }

    // Insertamos un nuevo libro
    $update_libro = $this->model->updateLibro(
      $_POST['libro_titulo'],
      $resumen,
      $_POST['libro_paginas'],
      $isbn,
      $edision,
      $volumen,
      $peso,
      $_POST['categorias_id'],
      $_POST['libro_estado'],
      $_POST['libro_id']
    );

    $correcto = true;

    if ($update_libro > 0) {
      // Eliminamos los tipos
      $delete_tipolibro = $this->model->deleteDetalleTipoLibroById($_POST['libro_id']);
      if ($delete_tipolibro) {
        // Actualizamos el tipo de libro
        $seleccionar_tipo = $this->model->TipoLibros();
        foreach ($seleccionar_tipo as $key => $value) {
          if (isset($_POST['tipo_' . $value['tipo_libro_id']])) {
            $insertar_tipo = $this->model->insertTipoByLibro($_POST['libro_id'], $value['tipo_libro_id']);
            if ($insertar_tipo <= 0) {
              $correcto = false;
            }
          }
        }
      }
    }

    if (!$correcto) {
      $return = [
        'status' => true,
        'msg' => 'Libro actualizado, pero algunos tipos no se añadieron correctamente al libro.',
        'value' => 'success'
      ];
    } else {
      $return = [
        'status' => true,
        'msg' => 'Libro actualizado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function updateFotoPefilAutor()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      location('ConfiguracionLibros/autores');
    }

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de intentar subir la foto de perfil del autor',
      'value' => 'error',
      'name_foto' => null
    );

    if (!isset($_POST) || !isset($_POST['autores_id']) || intval($_POST['autores_id']) === 0) {
      json($return);
    }

    $file = $_FILES['fileprofile'];

    if (!isset($_FILES['fileprofile']) || $_FILES['fileprofile']['error'] !== 0) {
      $return = array(
        'status' => false,
        'msg' => 'Esta imagen es inválida o no existe.',
        'value' => 'warning'
      );

      json($return);
    }

    if ($_FILES['fileprofile']['type'] !== 'image/jpeg' && $_FILES['fileprofile']['type'] !== 'image/png') {
      $return['msg'] = 'Formato de imagen no válida.';
      $return['value'] = 'warning';

      json($return);
    }

    $file['name'] = getExtension($file['name']);
    $noValido = true;

    foreach (getExtFotos() as $key => $value) {
      if ($value == $file['name']) {
        $noValido = false;
        break;
      }
    }

    if ($file['name'] == false || $noValido) {
      $return['msg'] = 'Tipo de imagen no válida, seleccione otra';
      $return['value'] = 'warning';

      json($return);
    }

    // Varificamos que exista este autor
    $seleccionar_autor = $this->model->selectAutoresById($_POST['autores_id']);
    if (!$seleccionar_autor) {
      json($return);
    }

    $file['name'] = 'autor_profile_' . date('Ymd_His') . '.' . $file['name'];
    $onlyName = $file['name'];
    $file['name'] = getPathFotoAutor() . $file['name'];

    $uploaded = move_uploaded_file($file['tmp_name'], $file['name']);

    if (!$uploaded) {
      json($return);
    }

    $update = $this->model->updateFoto($onlyName, $_POST['autores_id']);
    if (!$update) {
      $return['msg'] = 'Foto de perfil cambiado correctamente, pero no fue asigando al autor';
      $return['value'] = 'warning';
      $return['name_foto'] = $onlyName;
      json($return);
    }

    $return = array(
      'status' => true,
      'msg' => 'Foto de perfil cambiado correctamente.',
      'value' => 'success',
      'name_foto' => $onlyName
    );

    json($return);
  }

  public function updateFotoPefilLibro()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(6, true);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      location('ConfiguracionLibros/libros');
    }

    $return = array(
      'status' => false,
      'msg' => 'Error al momento de intentar subir la foto del libro',
      'value' => 'error',
      'name_foto' => null
    );

    if (!isset($_POST) || !isset($_POST['libro_id']) || intval($_POST['libro_id']) === 0) {
      json($return);
    }

    $file = $_FILES['fileprofile'];

    if (!isset($_FILES['fileprofile']) || $_FILES['fileprofile']['error'] !== 0) {
      $return = array(
        'status' => false,
        'msg' => 'Esta imagen es inválida o no existe.',
        'value' => 'warning'
      );

      json($return);
    }

    if ($_FILES['fileprofile']['type'] !== 'image/jpeg' && $_FILES['fileprofile']['type'] !== 'image/png') {
      $return['msg'] = 'Formato de imagen no válida.';
      $return['value'] = 'warning';

      json($return);
    }

    $file['name'] = getExtension($file['name']);
    $noValido = true;

    foreach (getExtFotos() as $key => $value) {
      if ($value == $file['name']) {
        $noValido = false;
        break;
      }
    }

    if ($file['name'] == false || $noValido) {
      $return['msg'] = 'Tipo de imagen no válida, seleccione otra';
      $return['value'] = 'warning';

      json($return);
    }

    // Varificamos que exista este autor
    $seleccionar_libro = $this->model->selectLibroById($_POST['libro_id']);
    if (!$seleccionar_libro) {
      json($return);
    }

    $file['name'] = 'libro_profile_' . date('Ymd_His') . '.' . $file['name'];
    $onlyName = $file['name'];
    $file['name'] = getPathFotoLibro() . $file['name'];

    $uploaded = move_uploaded_file($file['tmp_name'], $file['name']);

    if (!$uploaded) {
      json($return);
    }

    $update = $this->model->updateFotoLibro($onlyName, $_POST['libro_id']);
    if (!$update) {
      $return['msg'] = 'Foto cambiado correctamente, pero no fue asigando al libro';
      $return['value'] = 'warning';
      $return['name_foto'] = $onlyName;
      json($return);
    }

    $return = array(
      'status' => true,
      'msg' => 'Foto cambiado correctamente.',
      'value' => 'success',
      'name_foto' => $onlyName
    );

    json($return);
  }

  public function eliminarAutores()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(7, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar el autor.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['autores_id']) || intval($_POST['autores_id']) === 0) {
      json($return);
    }

    // verificamos que exista este auror
    $autor = $this->model->selectAutoresById($_POST['autores_id']);
    if (!$autor) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_autores = $this->model->selectsAutoresLibros($_POST['autores_id']);
    if ($registros_autores) {
      $return['msg'] = 'Este autor ya esta vinculado con algunos libros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos el autor
    $eliminar_autores = $this->model->deleteAutores($_POST['autores_id']);
    if ($eliminar_autores) {
      $return = [
        'status' => true,
        'msg' => 'Autor eliminado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }

  public function eliminarEditoriales()
  {
    parent::verificarLogin(true);
    parent::verificarPermiso(10, true);

    $return = [
      'status' => false,
      'msg' => 'Error al momento de eliminar la editorial.',
      'value' => 'error'
    ];

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['editoriales_id']) || intval($_POST['editoriales_id']) === 0) {
      json($return);
    }

    // verificamos que exista la editorial
    $editorial = $this->model->selectEditorialesById($_POST['editoriales_id']);
    if (!$editorial) {
      json($return);
    }

    // verificamos que no tenga registros
    $registros_editoriales = $this->model->selectsEditorialesLibro($_POST['editoriales_id']);
    if ($registros_editoriales) {
      $return['msg'] = 'Esta editorial ya está vinculado con algunos libros, por lo cual no se puede eliminar.';
      $return['value'] = 'warning';

      json($return);
    }

    // Eliminamos el autor
    $eliminar_editorial = $this->model->deleteEditoriales($_POST['editoriales_id']);
    if ($eliminar_editorial) {
      $return = [
        'status' => true,
        'msg' => 'Editorial eliminado correctamente.',
        'value' => 'success'
      ];
    }

    json($return);
  }
}
