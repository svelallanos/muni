<?php headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="py-2 mb-2 mb-sm-4 bg-gray-400 sticky-top">
      <div class="container-xl px-4">
        <div class="row">
          <div class="col-6 align-self-center">
            <label for="" class="fw-500"><i class="fa-solid fa-house"></i>&nbsp <?= (isset($data['page_name'])) ? $data['page_name'] : 'Sin nombre de página.' ?></label>
          </div>
          <div class="col-6 text-end">
            <a href="<?= base_url() ?>Roles/nuevo" class="btn btn-green"><i class="fa-solid fa-clipboard-check"></i> &nbsp Agregar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-2 px-sm-4">
      <div class="row">
        <div class="col-xs-12 col-lg-12 col-xl-8">
          <div class="card">
            <div class="card-body p-2 p-md-4">
              <table class="table table-striped table-hover w-100">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>NOMBRE</th>
                    <th class="text-center">ESTADO</th>
                    <th class="text-center">ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($data['lista_roles'] !== []) {
                    foreach ($data['lista_roles'] as $key => $value) { ?>
                      <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value['roles_nombre'] ?></td>
                        <td class="text-center">
                          <?= ($value['roles_estado'] == '1') ? '<span class="badge border rounded-pill bg-success-soft text-success">Activo</span>' : '<span class="badge border rounded-pill bg-danger-soft text-danger">Inactivo</span>' ?>
                        </td>
                        <td class="text-center"><a href="Roles/editar?roles_id=<?=$value['roles_id'] ?>" class="btn btn-info btn-sm btn-icon"><i class="fa-solid fa-pencil"></i></a>
                          <?php
                          if ($value['roles_id'] != '1' && $value['roles_id'] != '2' && $value['roles_id'] != '3' && $value['roles_id'] != '4') { ?>
                            <a data-roles_id="<?= $value['roles_id'] ?>" class="btn btn-danger eliminar_rol btn-sm btn-icon"><i class="fa-solid fa-trash-can"></i></a>
                          <?php
                          }
                          ?>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="d-none d-xl-block col-lg-3 p-3 border border-3 border-info rounded bg-white m-auto">
          <div class="row">
            <div class="col-md-12">
              <img class="shadow" src="<?= media() ?>/images/roles_1.png" alt="">
            </div>
            <div class="col-md-12">
              <h3 class="text-center p-3 pb-2 m-0 text-primary"><strong>Roles</strong></h3>
              <p class="text-center m-0">Recuerda que el nombre de los roles no deben ser iguales, ni similares, para evitar confundirlos.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php footerAdmin($data) ?>