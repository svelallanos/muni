<!-- Modal -->
<div class="modal fade" id="modal_agregar_autores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR AUTOR</h1>
      </div>
      <form id="form_autores" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="autores_nombre">Nombre:</label>
              <input required class="form-control" name="autores_nombre" id="autores_nombre" type="text" placeholder="Mario vargas ...">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="autores_descripcion">Descripción:</label>
              <textarea required class="form-control" id="autores_descripcion" name="autores_descripcion" rows="5" placeholder="Este autor se denomina ..."></textarea>
            </div>
            <div class="mb-0">
              <label class="fw-bold" for="autores_imagen">Seleccionar foto:</label>
              <input class="form-control" placeholder="seleccione foto" name="autores_imagen" type="file" id="autores_imagen">
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> &nbsp Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="feather-plus-circle"></i> &nbsp Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_editar_autores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR AUTOR</h1>
      </div>
      <form id="form_autores_editar" data-autores_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 text-center">
              <input class="form-control d-none" name="autores_imagen_edit" type="file" id="autores_imagen_edit">
              <img class="autor_imagen_form" src="<?= media() ?>/images/autores/sin_foto.png" alt="imagen">
              <div class="mt-2">JPG o PNG de un tamaño máximo de 3 MB</div>
              <div class="container_loader hide">
                <div class="cargando">
                  <div class="pelotas"></div>
                  <div class="pelotas"></div>
                  <div class="pelotas"></div>
                </div>
              </div>
              <button type="button" class="cargar_imagen mt-1 btn btn-sm btn-light text-primary border-primary"><i class="feather-upload"></i>&nbsp Cargar foto</button>
            </div>
            <div class="col-md-8">
              <div class="mb-3">
                <label class="fw-bold" for="autores_nombre_edit">Nombre:</label>
                <input required class="form-control" name="autores_nombre_edit" id="autores_nombre_edit" type="text" placeholder="Mario vargas ...">
              </div>
              <div class="mb-3">
                <label class="fw-bold" for="autores_descripcion_edit">Descripción:</label>
                <textarea required class="form-control" id="autores_descripcion_edit" name="autores_descripcion_edit" rows="5" placeholder="Este autor se denomina ..."></textarea>
              </div>
              <div class="mb-0">
                <label require class="fw-bold" for="autores_estado_edit">Estado:</label>
                <select class="form-control" id="autores_estado_edit" name="autores_estado_edit">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> &nbsp Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="feather-plus-circle"></i> &nbsp Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_ver_autores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h1 class="modal-title text-white fs-5 fw-500">DETALLE AUTOR</h1>
        <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <img class="autor_imagen_form view_image" src="<?= media() ?>/images/autores/sin_foto.png" alt="imagen">
          </div>
          <div class="col-md-12 text-center mt-2 p-4 py-2">
            <span class="view_estado_autor">Activo </span>
            <h1 class="view_nombre_autor">jhdw</h1>
            <p class="view_descripcion_autor mb-0">fwefwfwf </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>