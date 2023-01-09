<!-- Modal agregar editorial-->
<div class="modal fade" id="modal_add_edditorial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_edditorialLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-700" id="modal_add_edditorialLabel">Vincular Editorial</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mensaje_editorial mb-2"></div>
        <div class="row">
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Lista de editoriales disponibles</p>
          <div class="col-md-12 mb-2">
            <table id="tabla_editoriales" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Editorial vinculada</p>
          <div class="col-md-12">
            <form id="form_eliminar_editorial" data-libro_id="<?= $data['data-libro']['libro_id'] ?>">
              <div class="input-group mb-0">
                <input disabled type="text" value="<?= $data['data-editorial'] ?>" class="form-control delete_editorial">
                <button class="btn btn-danger" type="submit"><i class="feather-trash-2"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal agregar autores-->
<div class="modal fade" id="modal_add_autores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_autoresLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-700">Vincular Autores</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mensaje_autores mb-2"></div>
        <div class="row">
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Lista de autores disponibles</p>
          <div class="col-md-12 mb-4">
            <table id="tabla_autores_disponibles" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Autores vinculados</p>
          <div class="col-md-12 mb-2">
            <table id="tabla_autores_vinculados" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
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
</div>

<!-- Modal agregar keywords-->
<div class="modal fade" id="modal_add_keywords" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_keywordsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-700">Vincular palabras claves</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mensaje_keywords mb-2"></div>
        <div class="row">
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Lista de palabras claves disponibles</p>
          <div class="col-md-12 mb-4">
            <table id="tabla_keywords_disponibles" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Palabras claves vinculadas</p>
          <div class="col-md-12 mb-2">
            <table id="tabla_keywords_vinculados" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
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
</div>

<!-- Modal agregar materias-->
<div class="modal fade" id="modal_add_materias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_materiasLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-700">Vincular Materias</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mensaje_materias mb-2"></div>
        <div class="row">
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Lista de materias disponibles</p>
          <div class="col-md-12 mb-4">
            <table id="tabla_materias_disponibles" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <p class="text-decoration-underline fw-bold text-primary text-center fs-5">Materias vinculadas</p>
          <div class="col-md-12 mb-2">
            <table id="tabla_materias_vinculados" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRE</th>
                  <th>ACCIONES</th>
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
</div>

<div class="modal fade" id="modal_add_titulos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_titulosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 fw-500 text-white">Agregar títulos</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_add_titulos">
        <div class="modal-body">
          <div class="mensaje_titulos mb-2"></div>
          <div class="row">
            <div class="col-md-12">
              <h1 class="text-center fw-700 text-primary mb-3"><?= $data['data-libro']['libro_titulo'] ?></h1>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label class="fw-500" for="detalle_niveles_titulo">Título del libro</label>
                <textarea required class="form-control" placeholder="Introducción ..." name="detalle_niveles_titulo" id="detalle_niveles_titulo" rows="2"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="fw-500" for="niveles_id">Nivel</label>
                <select required class="form-control" id="niveles_id" name="niveles_id">
                  <?php foreach ($data['data-niveles'] as $key => $value) { ?>
                    <option value="<?= $value['niveles_id'] ?>"><?= $value['niveles_descripcion'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="fw-500" for="paginas_id">Página</label>
                <select required class="form-control" id="paginas_id" name="paginas_id">
                  <?php foreach ($data['data-paginas'] as $key => $value) { ?>
                    <option value="<?= $value['paginas_id'] ?>"><?= $value['paginas_nombre'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 d-none dependencia_show">
              <label class="fw-500" for="detalle_niveles_dependencia">Dependencia</label>
              <div class="input-group mb-3">
                <input disabled type="text" class="form-control" data-dependencia_id="0" id="detalle_niveles_dependencia" name="detalle_niveles_dependencia" placeholder="Sin dependencia">
                <button title="Agregar dependencia" class="__btn_add_dependencia btn btn-secondary" type="button" id="button-addon2"><i class="feather-link"></i></button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="box-button text-end">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="feather-x-circle"></i>&nbsp Cancelar</button>
              <button type="submit" class="btn btn-primary"><i class="feather-plus-circle"></i>&nbsp Guardar</button>
            </div>
          </div>
        </div>
      </form>
      
      <div class="modal-footer">
        <div class="lista_table w-100">
          <div class="row">
            <table id="lista_titulos_control" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>TITULOS</th>
                  <th>NIVEL</th>
                  <th>ACCIONES</th>
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
</div>

<div class="modal fade" id="modal_titulos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_add_titulosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-pink">
        <h1 class="modal-title fs-5 fw-500 text-white">Lista de títulos</h1>
        <button type="button" class="btn-close bg-white btn_cerrar_titulo"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table id="tb_titulos" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>TÍTULO</th>
                  <th>NIVEL</th>
                  <th>ACCIONES</th>
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
</div>

<!-- Modal -->
<div class="modal fade" id="modal_editar_titulos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title fs-5 fw-700">Editar Título</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-gray-100">
        <form id="form_editar_titulo" data-detalle_niveles_id="">
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label class="fw-bold" for="detalle_niveles_titulo_edit">Título:</label>
                <textarea required placeholder="Nombre del título" class="form-control" name="detalle_niveles_titulo_edit" id="detalle_niveles_titulo_edit" rows="5"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="button-control text-end">
              <button type="submit" class="btn btn-success"><i class="feather-plus-circle"></i>&nbsp Guardar Cambios</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>