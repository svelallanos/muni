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
            <a href="<?= base_url() ?>ConfiguracionLibros/viewAgregarLibros" title="Agregamos una nuevo libro" class="btn btn-green"><i class="feather-plus"></i> &nbsp Agregar</a href="<?= base_url() ?>">
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
              Lista de todos los libros
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="tb_libros" class="display compact w-100">
                  <thead>
                    <tr>
                      <th class="">N°</th>
                      <th class="">IMAGEN</th>
                      <th class="">TITUTO</th>
                      <th class="">TIPO</th>
                      <th class="">ESTADO</th>
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
          <img class="img-fluid w-75" src="<?= media() ?>/images/libros.png" alt="">
        </div>
      </div>
    </div>
  </main>
  <?php footerAdmin($data);
  getModal('modal_autores', $data);
  ?>