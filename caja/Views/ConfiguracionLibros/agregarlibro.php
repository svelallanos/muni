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
      <div class="row">
        <div class="col-md-12">
          <!-- Account details card-->
          <div class="mensaje"></div>
          <div class="card mb-4">
            <div class="card-header">Datos generales</div>
            <div class="card-body">
              <form id="form_agregar_libro" autocomplete="off">
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                  <!-- Form Group (first name)-->
                  <label class="fw-700 mb-2">DETALLE DE DATOS DEL LIBRO</label>
                  <div class="mb-2">
                    <label class="small"><i class="feather-chevron-right"></i>&nbsp; Un <span class="fw-700 text-indigo m-o">libro</span> es una obra impresa, manuscrita o pintada en una serie de hojas de papel, pergamino, vitela u otro material, unidas por un lado y protegidas con tapas, también llamadas cubiertas. Un libro puede tratar sobre cualquier tema.</label>
                    <p class="m-0 mt-2 small text-warning"><span class="fw-bold text-body">Nota: </span>Los campos que tienen asteriscos (<span class="text-danger">*</span>) son obligatorios.</p>
                  </div>
                  <div class="col-sm-12 col-md-8 col-xl-6 mb-2">
                    <label class="small mb-1 fw-bold">Título (<span class="text-danger">*</span>)</label>
                    <input required class="form-control" id="libro_titulo" type="text" name="libro_titulo" placeholder="Ingresar título del libro">
                  </div>
                  <div class="col-sm-6 col-md-4 col-xl-2 mb-2">
                    <label class="small mb-1 fw-bold">ISBN</label>
                    <input class="form-control" id="libro_isbn" name="libro_isbn" type="text" placeholder="Ingrese isbn">
                  </div>
                  <div class="col-sm-6 col-md-4 col-xl-2 mb-2">
                    <label class="small mb-1 fw-bold">Edision</label>
                    <input class="form-control" name="libro_edision" id="libro_edision" type="text" placeholder="Ingrese número de edision">
                  </div>
                  <!-- Form Group (last name)-->
                  <div class="col-sm-6 col-md-4 col-xl-2 mb-2">
                    <label class="small mb-1 fw-bold">Volúmen</label>
                    <input class="form-control" min="0" name="libro_volumen" id="libro_volumen" type="number" placeholder="Ingrese el volúmen">
                  </div>
                  <div class="col-sm-6 col-md-4 col-xl-2">
                    <label class="small mb-1 fw-bold">Páginas (<span class="text-danger">*</span>)</label>
                    <input required class="form-control" min="0" name="libro_paginas" id="libro_paginas" type="number" placeholder="Ingrese número de páginas">
                  </div>
                  <div class="col-sm-6 col-md-4 col-xl-2">
                    <label class="small mb-1 fw-bold">Peso</label>
                    <div class="input-group">
                      <input class="form-control" name="libro_peso" id="libro_peso" type="text" placeholder="Ingrese el peso del libro">
                      <span class="input-group-text">g</span>
                    </div>

                  </div>
                  <div class="col-md-6 col-xl-4">
                    <label class="small mb-1 fw-bold">Categoría (<span class="text-danger">*</span>)</label>
                    <select required class="form-control" name="categorias_id" id="categorias_id">
                      <option default value="">Seleccione</option>
                      <?php foreach ($data['data-categorias'] as $key => $value) { ?>
                        <option value="<?= $value['categorias_id'] ?>"><?= $value['categorias_nombre'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row gx-3 mb-3">
                  <label class="fw-700 mb-2">RESUMEN DEL LIBRO</label>
                  <div class="col-md-12">
                    <label for="libro_resumen" class="small mb-1 fw-bold">Resumen corto</label>
                    <textarea class="form-control" placeholder="Este libro se describe como ..." id="libro_resumen" name="libro_resumen" rows="5"></textarea>
                  </div>
                </div>
                <div class="row gx-3 mb-3">
                  <label class="fw-700 mb-2">IMAGEN DEL LIBRO</label>
                  <div class="col-md-6">
                    <label class="small mb-1 fw-bold">Seleccionar imagen</label>
                    <input class="form-control" placeholder="seleccione foto" name="libro_imagen_add" type="file" id="libro_imagen_add">
                  </div>
                </div>
                <div class="mb-2">
                  <label class="fw-700 mb-2">TIPO LIBRO</label>
                  <?php foreach ($data['data-tipolibro'] as $key => $value) { ?>
                    <div class="form-check">
                      <input name="tipo_<?= $value['tipo_libro_id'] ?>" class="form-check-input update_tipo_libro" id="tipo_<?= $value['tipo_libro_id'] ?>" type="checkbox" value="<?= $value['tipo_libro_id'] ?>">
                      <label class="form-check-label" for="tipo_<?= $value['tipo_libro_id'] ?>"><?= $value['tipo_libro_nombre'] ?></label>
                    </div>
                  <?php } ?>
                </div>
                <!-- Submit button-->
                <div class="row">
                  <div class="col-12 text-start text-md-end">
                    <button class="btn btn-primary" type="submit"><i class="feather-save"></i> &nbsp; Guardar Cambios</button>
                    <a href="<?= base_url() ?>ConfiguracionLibros/libros" class="btn btn-secondary text-center"><i class="feather-x-circle"></i> &nbsp; Cancelar</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?= footerAdmin($data) ?>