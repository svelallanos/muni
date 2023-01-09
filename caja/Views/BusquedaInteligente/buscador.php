<?php headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="page-header page-header-dark bg-white pb-10">
      <div class="container-xl px-4">
        <div class="page-header-content pt-4 text-center">
          <div class="row align-items-center justify-content-center">
            <div class="col-auto mt-4">
              <h1 class="page-header-title text-body w-100">
                <div class=""><i class="fa-sharp fa-solid fa-magnifying-glass"></i>&nbsp</div>
                BÚSQUEDA INTELIGENTE
              </h1>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
      <div class="row">
        <div class="mensaje_buscador pb-3"></div>
        <form id="form_busqueda_avanzada" class="d-flex justify-content-center contenedor_buscador">
          <div class="col-md-6">
            <div class="box d-flex flex-column">
              <div class="form-floating">
                <textarea class="form-control text-wrap" name="texto" id="texto"></textarea>
                <label style="padding-left: 5px;" id="texto_alert"><i class="feather-search"></i></label>
              </div>
              <div class="button-buscar pt-2 mb-4 text-center">
                <button type="submit" title="Buscar conocimiento" class="btn btn-light text-blue fw-bold">Buscar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-header-actions">
                <div class="card-header bg-gray-400 fw-700 text-body">
                  LISTA DE RESULTADOS
                  <a target="_blank" href="<?= base_url() ?>BusquedaInteligente/reporte" data-bs-toggle="tooltip" data-bs-placement="left" title="Generar reporte de los conceptos." class="btn btn-pink btn-sm rounded-0 __generar_reporte d-none"><i class="fa-sharp fa-solid fa-file-pdf"></i> &nbsp Reporte</a>
                </div>
                <div class="card-body">
                  <div class="row box_resultado">
                    <label>Lista de resultados.</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="text-center text-muted font-italic small">
        Scroll down to see example...
        <div class="mt-2"><i class="far fa-arrow-alt-circle-down fa-3x text-gray-400"></i></div>
      </div>
      <div style="height: 100vh"></div> -->
    </div>
  </main>
  <?php footerAdmin($data) ?>