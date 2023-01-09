<?= headerAdmin($data) ?>
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
      <!-- Illustration dashboard card example-->
      <div class="card card-waves mb-4">
        <div class="card-body p-5">
          <div class="row align-items-center justify-content-between">
            <div class="col">
              <h2 class="text-primary">Lista de configuraciones de los elementos de los libros</h2>
              <p class="text-gray-700">En este sub-módulo se configura todas las partes principales de los libros, como los niveles, sub niveles, palabras claves, diccionario de palabras, materias y categorias de los programas de estudio.
              </p>
            </div>
            <div class="col d-none d-lg-flex justify-content-end"><img class="img-fluid px-xl-4 w-50" src="<?= media() ?>/images/indexacion_libros.png" /></div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if (verificarPermiso($data, 16)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-primary h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-primary mb-1">Niveles del documento
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/niveles" title="Redirigir a la configuración de los niveles de los libros." class="btn btn-outline-primary btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2">
                    <i class="feather-file-text fa-2x text-gray-200"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 12)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-pink h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-pink mb-1">Parrafos del documento
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/parrafos" title="Redirigir a la configuración de los parrados de cada nivel." class="btn btn-outline-pink btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2"><i class="fa-2x text-gray-200 fa-solid fa-paragraph"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 17)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-cyan h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-cyan mb-1">Conceptos y terminologías
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/terminologias" title="Redirigir a la configuración de los niveles de los libros." class="btn btn-outline-cyan btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2"><i class="fa-2x text-gray-200 fa-solid fa-book-journal-whills"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 13)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-indigo h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-indigo mb-1">Palabras claves
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/keywords" title="Redirigir a la configuración de los niveles de los libros." class="btn btn-outline-indigo btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2"><i class="fa-regular fa-rectangle-list fa-2x text-gray-200"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 14)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-warning h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-warning mb-1">Materias (Libros)
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/materias" title="Redirigir a la configuración de los niveles de los libros." class="btn btn-outline-warning btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2"><i class="fa-2x text-gray-200 feather-book"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (verificarPermiso($data, 15)) { ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-teal h-100 lift">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <div class="small fw-bold text-teal mb-1">Lista de categorías
                    </div>
                    <div>
                      <a href="<?= base_url() ?>indexacionLibros/categorias" title="Redirigir a la configuración de los niveles de los libros." class="btn btn-outline-teal btn-icon">Ir</a>
                    </div>
                  </div>
                  <div class="ms-2"><i class="fa-2x text-gray-200 fa-solid fa-receipt"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <?= footerAdmin($data) ?>