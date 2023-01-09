<?= headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="py-2 mb-4 bg-gray-400 sticky-top">
      <div class="container-xl px-4">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <label for="" class="fw-500"><i class="fa-solid fa-house"></i>&nbsp <?= (isset($data['page_name'])) ? $data['page_name'] : 'Sin nombre de página.' ?></label>
          </div>
          <div class="col-md-6 text-end">
            <button title="Agregamos un nuevo párrafo" class="btn btn-green btn_agregar_parrafos"><i class="feather-plus"></i> &nbsp Agregar</button>
            <a href="<?= base_url() ?>indexacionLibros/elementos" class="btn btn-purple"><i class="fa-solid fa-reply-all"></i>&nbsp Regresar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <div class="row">
        <div class="col-md-8">
          <div class="mensaje"></div>
          <div class="card">
            <div class="card-header">
              Configuración de párrafos
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="col-1 text-center">N°</th>
                      <th class="col-6">NOMBRE</th>
                      <th class="col-3 text-center">ORDEN</th>
                      <th class="col-1">ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody id="tb_parrafos">
                    <?php if (isset($data['data-parrafos']) && !empty($data['data-parrafos'])) {
                      foreach ($data['data-parrafos'] as $key => $value) { ?>
                        <tr>
                          <td class="text-center"><?= ($key + 1) ?></td>
                          <td><?= $value['parrafos_descripcion'] ?></td>
                          <td class="text-center"><?= $value['parrafos_orden'] ?></td>
                          <td class="text-center">
                            <button title="Eliminar párrafo" data-parrafos_id="<?= $value['parrafos_id'] ?>" class="btn_eliminar_parrafo btn btn-sm btn-icon btn-danger-soft border border-danger text-danger">
                              <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <button title="Editar párrafo" data-parrafos_orden="<?= $value['parrafos_orden'] ?>" data-parrafos_descripcion="<?= $value['parrafos_descripcion'] ?>" data-parrafos_id="<?= $value['parrafos_id'] ?>" class="btn_editar_parrafo ml-2 btn btn-sm btn-icon btn-warning-soft border border-warning text-warning">
                              <i class="feather-edit-2"></i>
                            </button>
                          </td>
                        </tr>
                    <?php }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        <div class="d-none d-md-block text-center col-md-4">
          <img class="img-fluid w-75" src="<?= media() ?>/images/parrafo.png" alt="">
        </div>
        <div id="close_page" class="actualizar_page hide">
          <div class="card lift card-collapsable w-100">
            <a class="card-header p-2 fw-700 text-center" href="#collapseCardExample" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">ACTUALIZAR PÁGINA
              <div class="card-collapsable-arrow">
                <i class="fas fa-chevron-down"></i>
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
    </div>
  </main>
  <?php footerAdmin($data);
  getModal('modal_parrafos', $data);
  ?>