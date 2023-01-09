<!-- Modal -->
<div class="modal fade" id="modal_agregar_terminologias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg_header bg-primary">
        <h1 class="modal-title text_header text-white fs-5 fw-500">AGREGAR TERMINOLOGÍA</h1>
      </div>
      <form class="terminologia_append" id="form_terminologias" autocomplete="off" data-terminologias_id="">
        <div class="modal-body">
          <div class="alert alert-cyan alert-solid p-2" role="alert"><span class="fw-700">Nota : </span>La cantidad de indexaciones solo está permitido a 6 conceptos.</div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="fw-bold" for="terminologias_nombre">Terminología:</label>
                <input required class="form-control" name="terminologias_nombre" id="terminologias_nombre" type="text" placeholder="Ciencia de ...">
              </div>
            </div>
            <div class="col-md-6">
              <label class="fw-bold" for="terminologias_dependencia">Dependencia:</label>
              <div class="input-group mb-3">
                <input disabled data-dependencia_id="0" id="terminologias_dependencia" type="text" class="form-control" placeholder="Ninguna">
                <button class="btn btn-cyan btn_dependencia" type="button"><i class="fa-regular fa-hand-pointer"></i></button>
              </div>
            </div>
            <div class="mb-0">
              <label class="fw-bold" for="terminologias_descripcion">Descripción:</label>
              <textarea required class="form-control" id="terminologias_descripcion" name="terminologias_descripcion" rows="5" placeholder="Se define como ..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> &nbsp Cancelar</button>
          <button type="submit" class="btn btn-success boton_guardar"><i class="feather-plus-circle"></i> &nbsp Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="modal_ver_categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
</div> -->

<!-- Modal -->
<div class="modal fade" id="modal_listterminologia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-500">LISTA DE TERMINOLOGÍAS</h1>
        <button class="btn-close btn_cerrar" type="button"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <table id="tb_dependencias" class="display compact w-100">
            <thead>
              <tr>
                <th>N°</th>
                <th>TERMINOLOGÍA</th>
                <th>ACCIÓN</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>