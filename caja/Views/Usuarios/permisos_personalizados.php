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
            <button class="btn btn-green open_modal_usuarios"><i class="fa-solid fa-square-plus"></i> &nbsp Agregar</button>
            <button class="btn btn-danger"><i class="fa-solid fa-file-contract"></i> &nbsp Reporte</button>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <div class="row">
        <div class="mensaje_eliminarpermisos"></div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <table id="tb_permisosPersonalizados" class="display compact w-100">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>DNI</th>
                    <th>CANTIDAD</th>
                    <th class="text-center">FECHA PERMISO</th>
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
    </div>
  </main>
  <?php
  footerAdmin($data);
  getModal('modal_detalle_permisos', $data);
  ?>