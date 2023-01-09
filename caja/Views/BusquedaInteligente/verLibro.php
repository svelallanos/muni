<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= (isset($data['page_title']) ? $data['page_title'] : 'Sin nombre de página') ?></title>
  <link rel="icon" type="image/x-icon" href="<?= media() ?>/images/perfil_book3.png" />
  <link href="<?= media() ?>/css/general/styles.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <link href="<?= media() ?>/css/general/feather.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= media() ?>/images/perfil_book3.png" />

  <link href="<?= media() ?>/css/general/style_customized.css?version=<?= getVerion() ?>" rel="stylesheet" />

  <?php if (isset($data['page_css']) && !empty($data['page_css'])) { ?>
    <link href="<?= media() ?>/css/<?= $data['page_css'] ?>.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <?php } ?>
  <title>Este es el Login</title>
</head>

<body class="view_body_book">
  <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand ps-2 text-body fs-2" href="#">Biblioteca San Lucas</a>
    <!-- Navbar Search Input-->

    <div class="input-group d-flex justify-content-end px-3">
      <button type="button" onclick="cerrarse()" class="btn btn-primary-soft text-blue btn-sm"><i class="feather-x-circle"></i>&nbsp Cerrar</button>
    </div>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sidenav shadow-right sidenav-dark">
        <div class="sidenav-menu box_terminologias">
          <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Bibliografía</div>
            <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseBibliografia" aria-expanded="true" aria-controls="collapseBibliografia">
              <div class="nav-link-icon">
                <i class="fa-sharp fa-solid fa-book"></i>
              </div>
              Ficha Bibliográfica
              <div class="sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="collapseBibliografia" data-bs-parent="#accordionSidenav">
              <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <div class="img-reducido mb-2">
                  <img src="<?= media() ?>/images/libros/<?= $data['data-libro'][0]['libro_imagen'] ?>" alt="image" class="w-75">
                </div>
                <label><span class="fw-700">Título: </span><?= $data['data-libro'][0]['libro_titulo'] ?></label>
                <label><span class="fw-700">Isbn: </span><?= (is_null($data['data-libro'][0]['libro_isbn'])) ? '0' : $data['data-libro'][0]['libro_isbn'] ?></label>
                <label><span class="fw-700">Autores: </span>
                  <?php foreach ($data['data-libro'] as $key => $value) {
                    echo $value['autores_nombre'] . ' - ';
                  } ?>
                </label>
                <label><span class="fw-700">Editorial: </span><?= (is_null($data['data-editoriales']) ? 'Sin editorial' : $data['data-editoriales']['editoriales_nombre']) ?></label>
                <label><span class="fw-700">Edisión: </span><?= (is_null($data['data-libro'][0]['libro_edision'])) ? '0' : $data['data-libro'][0]['libro_edision'] ?></label>
                <label><span class="fw-700">Volumen: </span><?= (is_null($data['data-libro'][0]['libro_volumen'])) ? '0' : $data['data-libro'][0]['libro_volumen'] ?></label>
                <label><span class="fw-700">Resúmen: </span></label>
                <label class="small" style="margin-right: 5px;"><?= $data['data-libro'][0]['libro_resumen'] ?></label>
              </nav>
            </div>

            <div class="sidenav-menu-heading">Terminología</div>
            <?php

            $isExisteTer = false;
            if (isset($data['terminologia']['id'])) {
              $isExisteTer = true;
            ?>
              <a class="nav-link btnConcepto text-blue" data-id="<?= $data['terminologia']['id'] ?>" href="#concepto_<?= $data['terminologia']['id'] ?>">
                <div class="nav-link-icon text-danger"><i class="feather-chevron-right"></i></div>
                <?= $data['terminologia']['name'] ?>
              </a>
            <?php } ?>

            <?php if (isset($data['data-terminologias'])) {
              foreach ($data['data-terminologias'] as $key => $value) {
                if (!$isExisteTer || $data['terminologia']['id'] !== $value['conocimiento_id']) { ?>
                  <a class="nav-link py-1 btnConcepto" data-id="<?= $value['conocimiento_id'] ?>" href="#concepto_<?= $value['conocimiento_id'] ?>">
                    <div class="nav-link-icon text-danger"><i class="feather-chevron-right"></i></div>
                    <?= $value['terminologias_nombre'] ?>
                  </a>
            <?php }
              }
            } ?>

            <div class="sidenav-menu-heading">Índice</div>
            <?php foreach ($data['data-tablacontenidos'] as $key => $value) { ?>
              <a class="nav-link" href="#indice_<?= $value['detalle_niveles_id'] ?>">
                <div class="nav-link-icon text-success"><i class="feather-chevron-right"></i></div>
                <?= $value['detalle_niveles_titulo'] ?>
              </a>
            <?php } ?>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <header class="page-header bg-gray-800 p-2">
          <div class="container-xl px-3">
            <div class="row">
              <div class="mb-2 mb-md-0 col-md-6 d-flex" style="align-self: center;">
                <button class="btn btn-icon btn-white-10 mr-3i" id="sidebarToggle">
                  <i class="feather-align-justify"></i>
                </button>
                <div style="align-self: center;">
                  <h3 class="text-light m-0 text-uppercase fw-700"><?= $data['data-libro'][0]['libro_titulo'] ?></h3>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-joined">
                  <input class="form-control pe-0" type="text" placeholder="Buscar" aria-label="Search">
                  <span class="input-group-text text-gray">
                    <i data-feather="search"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 pt-3 bg-light">
          <div class="contenido">
            <section>
              <img src="<?= media() ?>/images/libros/<?= $data['data-libro'][0]['libro_imagen'] ?>" alt="imagen" class="w-100">
            </section>
            <section class="p-5">
              <h1 class="fw-700 text-center">INDICE</h1>
              <div class="box-pagina w-100 d-flex flex-row-reverse">
                <button class="btn btn-dark fw-600 rounded-0">2</button>
              </div>
            </section>

            <?php foreach ($data['data-tablacontenidos'] as $key => $value) { ?>
              <section class="p-5" id="indice_<?= $value['detalle_niveles_id'] ?>">
                <h1 class="fw-700 text-center text-uppercase"><?= $value['detalle_niveles_titulo'] ?></h1>
                <?php if (isset($data['data-conceptostitulos'][$value['detalle_niveles_id']])) {
                  $auxparrafo = 'UGDUWGDGD';
                  $auxConceptos = $data['data-conceptostitulos'][$value['detalle_niveles_id']];

                  foreach ($auxConceptos as $llave => $valor) {
                    if ($valor['parrafos_orden'] !== $auxparrafo) {
                      $auxparrafo = $valor['parrafos_orden'];
                ?>
                      <p style="text-align: justify;" class="card-text">
                  <?php
                      echo '<span class="concepto_seleccionado" id="concepto_' . $valor['conocimiento_id'] . '">' . $valor['conocimiento_descripcion'] . '</span>';
                    } else {
                      echo ' <span class="concepto_seleccionado" id="concepto_' . $valor['conocimiento_id'] . '">' . $valor['conocimiento_descripcion'] . '</span>';
                      if (!isset($auxConceptos[$llave + 1]['parrafos_orden']) || $auxConceptos[$llave + 1]['parrafos_orden'] !== $valor['parrafos_orden']) {
                        echo '</p>';
                      }
                    }
                  }
                } ?>
                      <div class="box-pagina w-100 d-flex flex-row-reverse">
                        <button class="btn btn-dark fw-600 rounded-0"><?= $value['paginas_id'] ?></button>
                      </div>
              </section>
            <?php } ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <?php printHTMLRequired() ?>

  <script type="text/javascript">
    var base_url = '<?= base_url() ?>';
  </script>

  <script src="<?= media() ?>/js/general/sweetalert2@11.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/all.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/jquery-3.6.0.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/feather.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/bootstrap.bundle.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/scripts.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/axios.min.js?version=<?= getVerion() ?>"></script>

  <script src="<?= media() ?>/js/general/filerequired.js?version=<?= getVerion() ?>"></script>

  <?php if (isset($data['page_function_js']) && !empty($data['page_function_js'])) { ?>
    <script src="<?= media() ?>/js/<?= $data['page_function_js'] ?>.js?version=<?= getVerion() ?>"></script>
  <?php } ?>
  <script>
    function cerrarse() {
      window.close()
    }
  </script>
</body>

</html>