<?php headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="py-2 mb-4 bg-gray-400 sticky-top">
      <div class="container-xl px-4">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <label for="" class="fw-500"><i class="fa-solid fa-house"></i>&nbsp <?= (isset($data['page_name'])) ? $data['page_name'] : 'Sin nombre de página.' ?></label>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <div class="row">
        <?php if (verificarPermiso($data, 3)) { ?>
          <div class="col-md-6 __box_usuario mb-4">
            <div class="card card-header-actions mx-auto">
              <div class="card-header fw-700 p-3">
                LISTA DE USUARIOS ADMINISTRATIVOS
                <div>
                  <a href="usuarios" class="btn btn-info btn-icon">
                    <i class="fa-solid fa-angles-right"></i>
                  </a>
                </div>
              </div>
              <div class="card-image text-center">
                <img class="card-img-top w-75 mt-4" src="<?= media() ?>/images/usuarios_biblioteca.jpg" alt="...">
              </div>
              <div class="card-body text-center">
                Lista de todos los usuarios admintrativos de la biblioteca con su respectivo rol, que pueden controlar el correcto funcionamiento del sistema.
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 4)) { ?>
        <div class="col-md-6 __box_usuario">
          <div class="card card-header-actions mx-auto">
            <div class="card-header fw-700 p-3">
              LISTA DE USUARIOS DE INTRANET
              <div>
                <a href="usuarios_intranet" class="btn btn-info btn-icon">
                  <i class="fa-solid fa-angles-right"></i>
                </a>
              </div>
            </div>
            <div class="card-image text-center">
              <img class="card-img-top w-75 mt-4" src="<?= media() ?>/images/usuarios_intranet.jpg" alt="...">
            </div>
            <div class="card-body text-center">
              Lista de todos los usuario de intranet con su respectivo rol, estudiantes, docentes y administrativos.
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <?php
  footerAdmin($data)
  ?>