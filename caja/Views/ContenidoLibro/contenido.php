<?php headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="py-2 mb-4 bg-gray-400 sticky-top">
      <div class="container-xl px-4">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <label for="" class="fw-500"><i class="fa-solid fa-house"></i>&nbsp <?= (isset($data['page_name'])) ? $data['page_name'] : 'Sin nombre de página.' ?></label>
          </div>
          <div class="col-md-6 text-end">
            <a href="<?= base_url() ?>ConfiguracionLibros/libros" class="btn btn-purple"><i class="fa-solid fa-reply-all"></i>&nbsp Regresar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div id="data_libro_id" data-libro_id="<?= $data['data-libro']['libro_id'] ?>" class="container-xl px-4">
      <div class="row">
        <div class="col-md-8 mb-4">
          <div class="card">
            <div class="card-body p-4 px-md-5">
              <div class="row align-items-center justify-content-between">
                <div class="d-none d-sm-block col-sm-4 text-center">
                  <img class="__imagen_libro" src="<?= media() ?>/images/libros/<?= $data['data-libro']['libro_imagen'] ?>" />
                </div>
                <div class="col-sm-8">
                  <h1 class="text-primary text-center"><?= $data['data-libro']['libro_titulo'] ?></h1>
                  <p style="text-align: justify; text-indent: 30px;" class="mb-2"><?= (is_null($data['data-libro']['libro_resumen']) || empty($data['data-libro']['libro_resumen']) ? 'Sin resumen ...' : $data['data-libro']['libro_resumen']) ?></p>
                  <p class="mb-0"><span class="fw-700">ISBN : </span><?= $data['data-libro']['libro_isbn'] ?></p>
                  <p class="mb-0"><span class="fw-700">Páginas : </span><?= $data['data-libro']['libro_paginas'] ?></p>
                  <p class="mb-0"><span class="fw-700">Edisión : </span><?= $data['data-libro']['libro_edision'] ?></p>
                  <p class="mb-0"><span class="fw-700">Valúmen : </span><?= $data['data-libro']['libro_volumen'] ?></p>
                  <p class="mb-0"><span class="fw-700">Peso : </span><?= $data['data-libro']['libro_peso'] ?> gramos</p>
                  <p class="mb-0"><span class="fw-700">Valoración : </span><?= $data['data-libro']['libro_valoracion'] ?></p>
                  <p class="mb-0"><span class="fw-700">Categoría : </span><span class="badge fw-bold bg-liht text-indigo border"><?= $data['data-libro']['categorias_nombre'] ?></span></p>
                  <p class="mb-0"><span class="fw-700">Tipo libro : </span><?= $data['data-tipo'] ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="text-blue fw-bold mb-2 border-2 border-bottom pb-2">Información Bibliográfica</h4>
              <p class="mb-1"><span class="fw-bold">Editorial : </span><?= $data['data-editorial'] ?></p>
              <p class="mb-1"><span class="fw-bold">Autores : </span>
                <?php if (empty($data['data-autores'])) {
                  echo 'vacío.';
                } else {
                  foreach ($data['data-autores'] as $key => $value) {
                    echo '<span class="text-teal fw-bold">' . $value['autores_nombre'] . '</span>';
                    if (isset($data['data-autores'][$key + 1])) {
                      echo ', ';
                    } else {
                      echo '.';
                    }
                  }
                } ?>
              </p>
              <p class="mb-1"><span class="fw-bold">Palabras claves : </span>
                <?php if (empty($data['data-keywords'])) {
                  echo 'vacío.';
                } else {
                  foreach ($data['data-keywords'] as $key => $value) {
                    echo $value['keywords_nombre'];
                    if (isset($data['data-keywords'][$key + 1])) {
                      echo ', ';
                    } else {
                      echo '.';
                    }
                  }
                } ?>
              </p>
              <p class="mb-1"><span class="fw-bold">Materias : </span>
                <?php if (empty($data['data-materias'])) {
                  echo 'vacío.';
                } else {
                  foreach ($data['data-materias'] as $key => $value) {
                    echo $value['materias_nombre'];
                    if (isset($data['data-materias'][$key + 1])) {
                      echo ', ';
                    } else {
                      echo '.';
                    }
                  }
                } ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <h4 class="mb-2 text-center fw-700">Botones para agregar contenido (<span class="text-danger">mantenimiento</span>)</h4>
      <hr class="fw-bold">
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <button title="Agregar la editorial" data-bs-toggle="tooltip" data-bs-placement="top" class="btn_add_editorial btn mb-2 mb-xl-0 bg-green  text-white"><i class="feather-file-plus"></i>&nbsp Editorial</button>
                  <button title="Agregar los autores" data-bs-toggle="tooltip" data-bs-placement="top" class="btn_add_autores btn mb-2 mb-xl-0 bg-indigo text-white"><i class="feather-file-plus"></i>&nbsp Autores</button>
                  <button title="Agregar las palabras claves" data-bs-toggle="tooltip" data-bs-placement="top" class="btn_add_keywords btn mb-2 mb-xl-0 bg-orange text-white"><i class="feather-file-plus"></i>&nbsp P. Claves</button>
                  <button title="Agregar las materias" data-bs-toggle="tooltip" data-bs-placement="top" class="btn_add_materias btn mb-2 mb-xl-0 bg-pink text-white"><i class="feather-file-plus"></i>&nbsp Materias</button>
                  <button title="Agregar los titulos" data-bs-toggle="tooltip" data-bs-placement="top" class="btn_add_titulos btn mb-2 mb-xl-0 bg-primary text-white"><i class="feather-file-plus"></i>&nbsp Títulos</button>
                  <?php if (verificarPermiso($data, 20)) { ?>
                    <a href="<?= base_url() ?>ContenidoLibro/agregarConceptos?libro_id=<?= $data['data-libro']['libro_id'] ?>" title="Agregar conceptos a los titulos" data-bs-toggle="tooltip" data-bs-placement="top" class="btn mb-2 mb-xl-0 bg-info text-white"><i class="feather-file-plus"></i>&nbsp Concepto</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <h4 class="mb-2 text-center fw-700">Tabla de contenidos</h4>
      <hr class="fw-bold">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-collapsable">
            <a class="card-header" href="#collapseCardExample" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
              <div class="indice">
                <i class="fa-solid fa-indent"></i> INDICE
              </div>
              <div class="card-collapsable-arrow">
                <i class="fas fa-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="collapseCardExample">
              <div class="card-body">
                <div class="tabla-contenidos">
                  <?php

                  $cont1 = 0;
                  $cont2 = 0;
                  $cont3 = 0;
                  $cont4 = 0;
                  $cont5 = 0;

                  foreach ($data['data-tablacontenidos'] as $key_1 => $value_1) {
                    $cont1 = $cont1 + 1;
                  ?>
                    <details>
                      <summary><span class="text-primary fw-bold"><?= $value_1['detalle_niveles_titulo'] ?></span></summary>
                      <?php
                      foreach ($value_1['sub_nivel'] as $key_2 => $value_2) {
                        $cont2 = $cont2 + 1;
                      ?>
                        <details>
                          <summary><?= $cont2 ?>. <span class="text-green fw-bold"><?= $value_2['detalle_niveles_titulo'] ?></span></summary>
                          <?php
                          foreach ($value_2['sub_nivel'] as $key_3 => $value_3) {
                            $cont3 = $cont3 + 1;
                          ?>
                            <details>
                              <summary><?= $cont2 . '.' . $cont3 ?>. <span class="text-cyan fw-bold"><?= $value_3['detalle_niveles_titulo'] ?></span></summary>
                              <?php
                              foreach ($value_3['sub_nivel'] as $key_4 => $value_4) {
                                $cont4 = $cont4 + 1;
                              ?>
                                <details>
                                  <summary><?= $cont2 . '.' . $cont3 . '.' . $cont4 ?>. <span class="text-teal fw-bold"><?= $value_4['detalle_niveles_titulo'] ?></span></summary>
                                  <?php
                                  foreach ($value_4['sub_nivel'] as $key_5 => $value_5) {
                                    $cont5 = $cont5 + 1;
                                  ?>
                                    <details>
                                      <summary><?= $cont2 . '.' . $cont3 . '.' . $cont4 . '.' . $cont5 ?>. <span class="text-teal fw-bold"><?= $value_5['detalle_niveles_titulo'] ?></span></summary>
                                    </details>
                                  <?php }
                                  $cont5 = 0;
                                  ?>
                                </details>
                              <?php }
                              $cont4 = 0;
                              ?>
                            </details>
                          <?php }
                          $cont3 = 0;
                          ?>
                        </details>
                      <?php }
                      $cont2 = 0;
                      ?>
                    </details>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="close_page" class="actualizar_page hide">
      <div class="card lift card-collapsable w-100">
        <a class="card-header p-2 fw-700 text-center" href="#collapseCardExample" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">ACTUALIZAR PÁGINA
          <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down" aria-hidden="true"></i>
          </div>
        </a>
        <div class="collapse show" id="collapseCardExample">
          <div class="card-body p-2 small">
            Para visualizar los cambios actualiza la página <span class="fw-bold text-blue">Click en el botón</span>. <button onclick="location.reload()" title="Actualizar página" class="btn btn-sm btn-icon btn-primary"><i class="feather-loader"></i></button>
          </div>
          <div class="text-center">
            <button title="cerrar" class="btn_close_page btn btn-sm m-2 mt-0 btn-icon btn-danger"><i class="feather-x-circle"></i></button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php footerAdmin($data);
  getModal('modal_contenidos', $data);
  ?>