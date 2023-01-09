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
            <a href="nuevo" class="btn btn-green"><i class="fa-solid fa-square-plus"></i> &nbsp Agregar Usuario</a>
            <button class="btn btn-danger"><i class="fa-solid fa-file-contract"></i> &nbsp Reporte</button>
            <a href="lista_usuario" class="btn btn-primary"><i class="fa-solid fa-arrow-right-arrow-left"></i> &nbsp Regresar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <table id="lista_usuarios" class="display compact w-100">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>NOMBRES</th>
                    <th>DNI</th>
                    <th>CREACIÓN</th>
                    <th>ROLES</th>
                    <th>ESTADO</th>
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
  ?>