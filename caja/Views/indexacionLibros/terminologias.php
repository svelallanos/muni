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
            <button title="Agregamos una nueva terminología" class="btn btn-green btn_agregar_terminologia"><i class="feather-plus"></i> &nbsp Agregar</button>
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
          <div class="card card-header-actions mx-auto">
            <div class="card-header">
              Configuración de la lista de conceptos y terminologías
              <div>
                <div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather-filter"></i> &nbsp Filtrar</button>
                  <div class="dropdown-menu text-center">
                    <button class="mb-2 btn fw-700 btn-transparent-dark btn_filtrar_terminologias" class="dropdown-item">Mostrar todo</button>
                    <button class="btn fw-700 btn-transparent-dark btn_filtrar_terminologias_nenos" class="dropdown-item">Mostrar menos</button>
                  </div>
                </div>
                <!-- <button class="btn_filtrar_terminologias btn btn-warning mr-2">
                  <i class="feather-filter"></i> &nbsp Filtrar
                </button> -->
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="tb_terminologias" class="display compact w-100">
                  <thead>
                    <tr>
                      <th class="text-center">N°</th>
                      <th class="">TERMINOLOGÍA</th>
                      <th class="">DESCRIPCION</th>
                      <th class="">DEPENDENCIA</th>
                      <th class="">ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="d-none d-md-block text-center col-md-4">
          <img class="img-fluid w-75" src="<?= media() ?>/images/terminologias.png" alt="">
        </div>
      </div>
    </div>
  </main>
  <?php footerAdmin($data);
  getModal('modal_terminologias', $data);
  ?>