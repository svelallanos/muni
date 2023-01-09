<!-- Modal -->
<div class="modal fade" id="modal_agregar_parrafos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR PARRAFOS</h1>
      </div>
      <form id="form_parrafo" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="parrafo_nombre">Nombre:</label>
              <input required class="form-control" name="parrafo_nombre" id="parrafo_nombre" type="text" placeholder="Párrafo 1">
            </div>
            <div>
              <label for="parrafo_orden">Número de orden:</label>
              <input required min="1" class="form-control" name="parrafo_orden" id="parrafo_orden" type="number" placeholder="000001">
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
<div class="modal fade" id="modal_editar_parrafos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR PARRAFO</h1>
      </div>
      <form id="form_parrafo_editar" data-parrafos_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="parrafo_nombre_edit">Nombre:</label>
              <input required class="form-control" name="parrafo_nombre_edit" id="parrafo_nombre_edit" type="text" placeholder="Párrafo 1">
            </div>
            <div>
              <label for="parrafo_orden_edit">Número de orden:</label>
              <input required min="1" class="form-control" name="parrafo_orden_edit" id="parrafo_orden_edit" type="number" placeholder="000001">
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