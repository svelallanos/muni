<!-- Modal -->
<div class="modal fade" id="modal_agregar_categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR CATEGORÍA</h1>
      </div>
      <form id="form_categorias" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="categorias_nombre">Nombre:</label>
              <input required class="form-control" name="categorias_nombre" id="categorias_nombre" type="text" placeholder="Programa de estudio de ...">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="categorias_descripcion">Descripción:</label>
              <textarea required class="form-control" id="categorias_descripcion" name="categorias_descripcion" rows="5" placeholder="Se define como ..."></textarea>
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
<div class="modal fade" id="modal_editar_categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR CATEGORÍA</h1>
      </div>
      <form id="form_categorias_editar" data-categorias_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="categorias_nombre_edit">Nombre:</label>
              <input required class="form-control" name="categorias_nombre_edit" id="categorias_nombre_edit" type="text" placeholder="Programa de estudio de ...">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="categorias_descripcion_edit">Descripción:</label>
              <textarea required class="form-control" id="categorias_descripcion_edit" name="categorias_descripcion_edit" rows="5" placeholder="Se define como ..."></textarea>
            </div>
            <div class="mb-0">
              <label class="fw-bold" for="categorias_estado_edit">Estado</label>
              <select class="form-control" id="categorias_estado_edit" name="categorias_estado_edit">
                <option value="1">Activo</option>
                <option value="2">Desactivado</option>
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
<div class="modal fade" id="modal_ver_categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h1 class="modal-title text-white fs-5 fw-500">DETALLE CATEGORÍA</h1>
      </div>
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="categorias_nombre_view">Nombre:</label>
              <input disabled class="form-control" name="categorias_nombre_view" id="categorias_nombre_view" type="text" placeholder="Programa de estudio de ...">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="categorias_descripcion_view">Descripción:</label>
              <textarea disabled class="form-control" id="categorias_descripcion_view" name="categorias_descripcion_view" rows="5" placeholder="Se define como ..."></textarea>
            </div>
            <div class="mb-0">
              <label class="fw-bold" for="categorias_estado_view">Estado</label>
              <select disabled class="form-control" id="categorias_estado_view" name="categorias_estado_view">
                <option value="1">Activo</option>
                <option value="2">Desactivado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> &nbsp Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>