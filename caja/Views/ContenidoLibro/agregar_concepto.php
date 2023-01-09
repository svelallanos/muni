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
            <a href="<?= base_url() ?>ContenidoLibro/contenido?libro_id=<?= $data['data-libro']['libro_id'] ?>" class="btn btn-purple"><i class="fa-solid fa-reply-all"></i>&nbsp Regresar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <form id="form_add_concepto" data-libro_id="<?= $data['data-libro']['libro_id'] ?>">
        <div class="row gx-4">
          <div class="mensaje_concepto"></div>
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header text-center fw-700 p-2">LIBRO</div>
              <div class="card-body p-2">
                <h1 class="text-center text-green fw-700"><?= $data['data-libro']['libro_titulo'] ?></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-xl-6">
            <div class="card card-header-actions mb-4">
              <div class="card-header fw-700">
                LISTA DE TITULOS
                <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Detalle de los títulos a agregar conceptos."></i>
              </div>
              <div class="card-body">
                <div class="row">
                  <table id="tb_titulos_conceptos" class="display compact w-100">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th>TITULO</th>
                        <th>NIVEL</th>
                        <th>ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-xl-6">
            <div class="card card-header-actions mb-4">
              <div class="card-header fw-700">
                LISTA DE TERMINOLOGIAS
              </div>
              <div class="card-body">
                <div class="row">
                  <table id="tb_terminologias" class="display compact w-100">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th>TERMINOLOGIA</th>
                        <th>ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-header-actions mb-4">
              <div class="card-header fw-700">
                LISTA DE PÁRRAFOS
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label fw-bold">
                      Párrafos
                    </label>
                    <select required name="parrafos_id" id="parrafos_id" class="form-select" aria-label="Default select example">
                      <option value="" selected>seleccione</option>
                      <?php foreach ($data['data-parrafos'] as $key => $value) { ?>
                        <option value="<?= $value['parrafos_id'] ?>"><?= $value['parrafos_descripcion'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-header-actions mb-4">
              <div class="card-header fw-700">
                AGREGAR CONCEPTOS
                <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Aquí se agrega los conceptos a los título del libro."></i>
              </div>
              <div class="card-body">
                <textarea required class="lh-base form-control" name="conocimiento_descripcion" id="conocimiento_descripcion" type="text" placeholder="Ingrese el concepto del libro" rows="8"></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-12 text-end mb-4">
            <button title="Boton para registrar los conceptos a los titulos" type="submit" class="fw-500 btn btn-success"><i class="fa-solid fa-file-circle-plus"></i>&nbsp Guardar Cambios</button>
          </div>
        </div>
      </form>
      <div class="row gx-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header fw-700 text-white bg-teal">VISTA DEL LIBRO</div>
            <div class="card-body p-3">
              <div class="row">
                <div class="col-md-4 border-end border-2">
                  <ul class="nav nav-pills flex-column" role="tablist">
                    <?php
                    $activo = true;

                    foreach ($data['data-tablacontenidos'] as $n1 => $valor_1) { ?>
                      <li class="nav-item">
                        <a class="dis_tabla_contenido nav-link <?= ($activo) ? 'active' : '' ?>" href="#titulo_concepto_<?= $valor_1['detalle_niveles_id'] ?>" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">
                          <?= (!empty($valor_1['sub_nivel'])) ? '<i class="fa-solid fa-caret-down"></i>' : '&nbsp&nbsp' ?> <?= $valor_1['detalle_niveles_titulo'] ?>
                        </a>
                      </li>
                      <?php
                      foreach ($valor_1['sub_nivel'] as $n2 => $valor_2) { ?>
                        <li class="nav-item">
                          <a class="dis_tabla_contenido nav-link" href="#titulo_<?= $valor_2['detalle_niveles_id'] ?>" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">
                            <?= (!empty($valor_2['sub_nivel'])) ? '&nbsp&nbsp <i class="fa-solid fa-caret-down"></i>' : '&nbsp&nbsp&nbsp&nbsp' ?> <?= $valor_2['detalle_niveles_titulo'] ?>
                          </a>
                        </li>
                        <?php
                        foreach ($valor_2['sub_nivel'] as $n3 => $valor_3) { ?>
                          <li class="nav-item">
                            <a class="dis_tabla_contenido nav-link" href="#titulo_<?= $valor_3['detalle_niveles_id'] ?>" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">
                              <?= '&nbsp&nbsp&nbsp&nbsp&nbsp ' . $valor_3['detalle_niveles_titulo'] ?>
                            </a>
                          </li>
                    <?php
                        }
                      }
                      $activo = false;
                    } ?>
                  </ul>
                </div>
                <div class="col-md-8">
                  <div class="tab-content" id="cardPillContentVertical">
                    <?php
                    $ver_contenido = true;
                    foreach ($data['data-tablacontenidos'] as $m1 => $item_1) { ?>
                      <div class="tab-pane fade <?= ($ver_contenido) ? 'show active' : '' ?>" id="titulo_concepto_<?= $item_1['detalle_niveles_id'] ?>" role="tabpanel" aria-labelledby="overview-pill-vertical">
                        <h1 class="card-title text-center fw-700 text-body"><?= $item_1['detalle_niveles_titulo'] ?></h1>
                        <?php if (isset($data['data-conceptostitulos'][$item_1['detalle_niveles_id']])) {
                          $auxparrafo = 'UGDUWGDGD';
                          $auxConceptos = $data['data-conceptostitulos'][$item_1['detalle_niveles_id']];
                          foreach ($auxConceptos as $key => $valor) {
                            if ($valor['parrafos_orden'] !== $auxparrafo) {
                              $auxparrafo = $valor['parrafos_orden'];
                        ?>
                              <p style="text-align: justify;" class="card-text">
                                <?= $valor['conocimiento_descripcion'] ?>
                              <?php } else { ?>
                                <?= $valor['conocimiento_descripcion'] ?>
                            <?php
                              if (!isset($auxConceptos[$key + 1]['parrafos_orden']) || $auxConceptos[$key + 1]['parrafos_orden'] !== $valor['parrafos_orden']) {
                                echo '</p>';
                              }
                            }
                          }
                        } else { ?>
                              <p style="text-align: justify;" class="card-text">
                                Sin contenido.
                              </p>
                            <?php } ?>
                      </div>
                    <?php $ver_contenido = false;
                    } ?>
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
    </div>
  </main>
  <?php footerAdmin($data) ?>