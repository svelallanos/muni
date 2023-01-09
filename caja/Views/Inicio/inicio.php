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
        <section class="p-5 mb-4 bg-white rounded rounded-3" id="inicio">
          <h3 class="fw-600">Hola, Bienvenido a la Biblioteca y Repositorio Virtual</h3>
          <h1 class="fw-700">Instituto <span class="text-pink">San Lucas</span></h1>
          <p>Brinda una formación profesional de calidad, con base científica, tecnológica y humanística; con valores cristianos y orientada hacia el mercado laboral competitivo, respetando el medio ambiente y la identidad cultural local, regional y nacional. Educando para esta vida y la eternidad.</p>
          <a class="btn btn-pink text-white fw-600" target="_blank" href="https://instituto.aesanlucas.edu.pe/"><i class="fa-brands fa-edge"></i>&nbsp Web Instituto</a>
        </section>
        <!-- <section class="p-0 pt-4 mb-2 rounded rounded-3" id="categorias">
          <h1 class="fw-700">LISTA <span class="text-pink">CATEGORÍAS</span></h1>
          <div class="row">
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Transversales</button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Administración de Empresas</button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Contabilidad</button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Enfermería Técnica</button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Construcción Civil</button>
            </div>
            <div class="col-md-4 mb-2">
              <button class="btn btn-dark w-100"><i class="fa-sharp fa-solid fa-building-columns"></i>&nbsp Farmacia Técnica</button>
            </div>
          </div>
        </section> -->
        <section class="p-0" id="libros">
          <header class="mb-2 text-center">
            <h1 class="fw-700">LISTA DE LIBROS<span class="text-pink">MAS POPULARES</span></h1>
          </header>
          <div class="gallery">
            <?php foreach ($data['libros'] as $key => $value) { ?>
              <img src="<?= media() ?>/images/libros/<?= $value['libro_imagen'] ?>">
            <?php } ?>
          </div>
        </section>

        <!-- <div class="col-md-4 pt-0">
              <h1 class="fw-700">LISTA <span class="text-pink">AUTORES</span></h1>
              <div class="d-flex justify-content-around flex-wrap">
              <?php foreach ($data['autores'] as $key => $value) { ?>
                  <div class="box-autor mb-2">
                    <img style="width: 90px; height: 90px; border-radius: 50%;" src="<?= media() ?>/images/autores/<?= $value['autores_imagen'] ?>" alt="">
                    <div class="autor-nombre p-1 small fw-600 text-center" style="width: 90px;">
                      <?= $value['autores_nombre'] ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div> -->


        <!-- <div class="row">
<?php foreach ($data['libros'] as $key => $value) { ?>
                  <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 mb-2 dis-image">
                    <div class="box-image">
                      <img class="w-100 rounded-top" src="<?= media() ?>/images/libros/<?= $value['libro_imagen'] ?>" alt="">
                    </div>
                    <div class="box-informacion bg-white">
                      <h3 class="text-center m-0 p-1 fw-600"><?= $value['libro_titulo'] ?></h3>
                      <h5 class="small text-center m-0"><?= $value['libro_edision'] ?></h5>
                      <h6 class="small text-center m-0 text-body">ISBN: <?= $value['libro_isbn'] ?></h6>
                    </div>
                    <div class="box-buton bg-white p-2 d-flex <?= ($value['digital']) ? 'justify-content-between' : 'justify-content-center' ?> flex-wrap">
                      <a href="#" class="btn btn-sm btn-pink rounded-pill "><i class="feather-list"></i>&nbsp Detalle</a>
                      <?php if ($value['digital']) { ?>
                        <a target="_blank" href="<?= base_url() ?>BusquedaInteligente/verBook?libro_id=<?= $value['libro_id'] ?>&viewcontenido" title="Ver contenido" class="btn btn-sm btn-blue rounded-pill "><i class="feather-eye"></i>&nbsp Ver</a>
                      <?php } ?>
                    </div>
                    <div class="box-estado rounded-bottom bg-white pb-2 text-center">
                      <?php if ($value['digital']) { ?>
                        <span class="badge bg-primary-soft text-primary">Libro digital</span>
                      <?php } else { ?>
                        <span class="badge bg-primary-soft text-primary">Libro físico</span>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
              </div> -->


      </div>
    </div>
  </main>
  <?php footerAdmin($data) ?>