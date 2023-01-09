<!-- Modal -->
<div class="modal fade" id="modal_ver_usuario_intranet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title fw-700" id="exampleModalLabel">USUARIO INTRANET</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="card border-info w-100">
          <!-- <div class="card-header">DETALLE</div> -->
          <div class="card-body row p-2">
            <div class="col-6">
              <img class="w-100" src="<?= media() ?>/images/usuario_intranet.png" alt="">
            </div>
            <div class="col-6 border-start border-2">
              <h5 class="text-center card-title fw-700" style="text-decoration: underline;">DETALLE</h5>
              <div class="row">
                <label class="ver_nombre"></label>
                <label class="ver_dni"></label>
                <label class="ver_rol"></label>
                <label class="ver_estado"></label>
                <label class="ver_fecha"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>