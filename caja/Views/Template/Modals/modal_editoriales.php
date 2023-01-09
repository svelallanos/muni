<!-- Modal -->
<div class="modal fade" id="modal_agregar_editoriales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR EDITORIAL</h1>
      </div>
      <form id="form_editoriales" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="editoriales_nombre">Nombre:</label>
              <input required class="form-control" name="editoriales_nombre" id="editoriales_nombre" type="text" placeholder="Editorial las ...">
            </div>
            <div class="mb-0">
              <label class="fw-bold" for="editoriales_descripcion">Descripción:</label>
              <textarea required class="form-control" id="editoriales_descripcion" name="editoriales_descripcion" rows="5" placeholder="La editorial tiene la funcion de ..."></textarea>
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
<div class="modal fade" id="modal_editar_editoriales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR EDITORIAL</h1>
      </div>
      <form id="form_editoriales_editar" data-editoriales_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="editoriales_nombre_edit">Nombre:</label>
              <input required class="form-control" name="editoriales_nombre_edit" id="editoriales_nombre_edit" type="text" placeholder="Editorial las ...">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="editoriales_descripcion_edit">Descripción:</label>
              <textarea required class="form-control" id="editoriales_descripcion_edit" name="editoriales_descripcion_edit" rows="5" placeholder="La editorial tiene la funcion de ..."></textarea>
            </div>
            <div class="mb-0">
              <label require class="fw-bold" for="editoriales_estado_edit">Estado:</label>
              <select class="form-control" id="editoriales_estado_edit" name="editoriales_estado_edit">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
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
<div class="modal fade" id="modal_ver_editoriales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h1 class="modal-title text-white fs-5 fw-500">DETALLE EDITORIAL</h1>
        <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 text-center p-4 py-0">
            <h1 class="view_nombre_editorial text-blue fw-700">jhdw</h1>
            <span class="view_estado_editorial">Activo </span>
            <p style="text-align: justify;" class="view_descripcion_editorial mb-0 mt-2">fwefwfwf </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>