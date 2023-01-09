<?php

class Inicio extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function inicio()
  {
    parent::verificarLogin(true);

    $dataAutores = $this->model->getDataAutores();
    $auxDataAutores = array();
    foreach ($dataAutores as $key => $value) {
      $auxDataAutores[$value['autores_id']] = array(
        'autores_id' => $value['autores_id'],
        'autores_nombre' => $value['autores_nombre'],
        'autores_descripcion' => $value['autores_descripcion'],
        'autores_imagen' => $value['autores_imagen']
      );
    }

    $dataEditoriales = $this->model->getDataEditoriales();
    $auxDataEditoriales = array();
    foreach ($dataEditoriales as $key => $value) {
      $auxDataEditoriales[$value['editoriales_id']] = array(
        'editoriales_id' => $value['editoriales_id'],
        'editoriales_nombre' => $value['editoriales_nombre'],
        'editoriales_descripcion' => $value['editoriales_descripcion']
      );
    }

    $dataTipoLibro = $this->model->getDataTipoLibro();
    $auxDataTipoLibro = array();
    foreach ($dataTipoLibro as $key => $value) {
      if (!isset($auxDataTipoLibro[$value['libro_id']])) {
        if ($value['tipo_libro_id'] == 2) {
          $auxDataTipoLibro[$value['libro_id']] = array(
            'digital' => true
          );
        } else {
          $auxDataTipoLibro[$value['libro_id']] = array(
            'digital' => false
          );
        }
      } else {
        if (!$auxDataTipoLibro[$value['libro_id']]['digital']) {
          if ($value['tipo_libro_id'] == 2) {
            $auxDataTipoLibro[$value['libro_id']]['digital'] = true;
          }
        }
      }
    }

    $dataLibros = $this->model->getDataLibros();
    $auxDataLibro = array();
    foreach ($dataLibros as $key => $value) {
      array_push($auxDataLibro, array(
        'libro_id' => $value['libro_id'],
        'libro_titulo' => $value['libro_titulo'],
        'libro_isbn' => $value['libro_isbn'],
        'libro_edision' => $value['libro_edision'],
        'libro_paginas' => $value['libro_paginas'],
        'libro_imagen' => $value['libro_imagen'],
        'digital' => (isset($auxDataTipoLibro[$value['libro_id']])) ? $auxDataTipoLibro[$value['libro_id']]['digital'] : false
      ));
    }

    $data['page_id'] = 2;
    $data['page_tag'] = "Biblioteca - IESP San Lucas";
    $data['page_title'] = "Biblioteca San Lucas";
    $data['page_name'] = "Biblioteca San Lucas";
    $data['page_css'] = "inicio/inicio";
    $data['libros'] = $auxDataLibro;
    $data['autores'] = $auxDataAutores;

    $this->views->getView($this, "inicio", $data);
  }
}
