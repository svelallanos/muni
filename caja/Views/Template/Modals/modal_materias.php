<!-- Modal -->
<div class="modal fade" id="modal_agregar_materias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title text-white fs-5 fw-500">AGREGAR NUEVA MATERIA</h1>
      </div>
      <form id="form_materia" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="materia">Nombre:</label>
              <input required class="form-control" name="materia" id="materia" type="text" placeholder="Ciencias de la computación ...">
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
<div class="modal fade" id="modal_editar_materia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title text-white fs-5 fw-500">EDITAR MATERIA</h1>
      </div>
      <form id="form_materia_editar" data-materias_id="" autocomplete="off">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label for="materia_edit">Palabra:</label>
              <input required class="form-control" name="materia_edit" id="materia_edit" type="text" placeholder="Ciencias de la computación ...">
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