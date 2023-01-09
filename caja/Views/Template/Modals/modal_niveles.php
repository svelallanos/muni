<!-- Modal -->
<div class="modal fade" id="modal_agregar_niveles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR NUEVO NIVEL</h1>
      </div>
      <form id="form_niveles" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="niveles_nombre">Nombre:</label>
              <input required class="form-control" name="niveles_nombre" id="niveles_nombre" type="text" placeholder="Nivel 000001">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="niveles_orden">Orden:</label>
              <input min="1" required class="form-control" name="niveles_orden" id="niveles_orden" type="number" placeholder="000001">
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
<div class="modal fade" id="modal_editar_niveles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR NIVEL</h1>
      </div>
      <form id="form_niveles_editar" data-niveles_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="fw-bold" for="niveles_nombre_edit">Nombre:</label>
              <input required class="form-control" name="niveles_nombre_edit" id="niveles_nombre_edit" type="text" placeholder="Nivel 000001">
            </div>
            <div class="mb-3">
              <label class="fw-bold" for="niveles_orden_edit">Orden:</label>
              <input min="1" required class="form-control" name="niveles_orden_edit" id="niveles_orden_edit" type="number" placeholder="000001">
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