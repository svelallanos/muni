<!-- Modal -->
<div class="modal fade" id="modal_agregar_keywords" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR PALABRA CLAVE</h1>
      </div>
      <form id="form_keywords" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="keywords_palabra">Palabra:</label>
              <input required class="form-control" name="keywords_palabra" id="keywords_palabra" type="text" placeholder="Keyword 1">
            </div>
            <div class="mb-0">
              <label for="keywords_descripcion">Descripción:</label>
              <textarea required class="form-control" id="keywords_descripcion" name="keywords_descripcion" rows="5" placeholder="Se define como ..."></textarea>
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
<div class="modal fade" id="modal_editar_keywords" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR PALABRA CLAVE</h1>
      </div>
      <form id="form_keywords_editar" data-keywords_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="keywords_palabra_edit">Palabra:</label>
              <input required class="form-control" name="keywords_palabra_edit" id="keywords_palabra_edit" type="text" placeholder="Keyowrd 1">
            </div>
            <div class="mb-0">
              <label for="keywords_descripcion_edit">Descripción:</label>
              <textarea required class="form-control" id="keywords_descripcion_edit" name="keywords_descripcion_edit" rows="5" placeholder="Se define como ..."></textarea>
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
<div class="modal fade" id="modal_ver_keywords" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h1 class="modal-title text-white fs-5 fw-500">DETALLE PALABRA CLAVE</h1>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="keywords_palabra_view">Palabra:</label>
              <input disabled class="form-control" name="keywords_palabra_view" id="keywords_palabra_view" type="text" placeholder="Keyowrd 1">
            </div>
            <div class="mb-0">
              <label for="keywords_descripcion_view">Descripción:</label>
              <textarea disabled class="form-control" id="keywords_descripcion_view" name="keywords_descripcion_view" rows="7" placeholder="Se define como ..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> &nbsp Cancelar</button>
        </div>
    </div>
  </div>
</div>