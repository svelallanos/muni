<?= headerAdmin($data) ?>
<div id="layoutSidenav_content">
  <main>
    <header class="py-2 mb-4 bg-gray-400 sticky-top">
      <div class="container-xl px-4">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <label for="" class="fw-500"><i class="fa-solid fa-house"></i>&nbsp <?= (isset($data['page_name'])) ? $data['page_name'] : 'Sin nombre de página.' ?></label>
          </div>
          <div class="col-md-6 text-end">
            <a href="<?= base_url() ?>indexacionLibros/terminologias" class="btn btn-purple"><i class="fa-solid fa-reply-all"></i>&nbsp Regresar</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
      <div class="row">
        <div class="col-md-8 p-4 hoja border border-2 border-primary lift">
          <div class="card card-collapsable card_principal">
            <a class="card-header p-1" href="#id_<?= $data['conocimiento']['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $data['conocimiento']['terminologias_id'] ?>">
              <div><i class="feather-chevron-right"></i> <?= $data['conocimiento']['terminologias_nombre'] ?></div>
              <div class="card-collapsable-arrow">
                <i class="fas fa-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="id_<?= $data['conocimiento']['terminologias_id'] ?>">
              <div class="card-body padding_0"><?= $data['conocimiento']['terminologias_descripcion'] ?></div>
            </div>
          </div>
          <?php foreach ($data['conocimiento']['hijos'] as $key_1 => $value_1) { ?>
            <div class="card card-collapsable card_principal">
              <a class="card-header p-1" href="#id_<?= $value_1['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $value_1['terminologias_id'] ?>">
                <div>&nbsp &nbsp <?= ($key_1 + 1) ?>. <?= $value_1['terminologias_nombre'] ?></div>
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse" id="id_<?= $value_1['terminologias_id'] ?>">
                <div class="card-body padding_0"><?= $value_1['terminologias_descripcion'] ?></div>
              </div>
            </div>
            <?php foreach ($value_1['hijos'] as $key_2 => $value_2) { ?>
              <div class="card card-collapsable card_principal">
                <a class="card-header p-1" href="#id_<?= $value_2['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $value_2['terminologias_id'] ?>">
                  <div>&nbsp &nbsp &nbsp &nbsp <?= ($key_1 + 1) . '.' . ($key_2 + 1) ?>. <?= $value_2['terminologias_nombre'] ?></div>
                  <div class="card-collapsable-arrow">
                    <i class="fas fa-chevron-down"></i>
                  </div>
                </a>
                <div class="collapse" id="id_<?= $value_2['terminologias_id'] ?>">
                  <div class="card-body padding_0"><?= $value_2['terminologias_descripcion'] ?></div>
                </div>
              </div>
              <?php foreach ($value_2['hijos'] as $key_3 => $value_3) { ?>
                <div class="card card-collapsable card_principal">
                  <a class="card-header p-1" href="#id_<?= $value_3['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $value_3['terminologias_id'] ?>">
                    <div>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?= ($key_1 + 1) . '.' . ($key_2 + 1) . '.' . ($key_3 + 1) ?>. <?= $value_3['terminologias_nombre'] ?></div>
                    <div class="card-collapsable-arrow">
                      <i class="fas fa-chevron-down"></i>
                    </div>
                  </a>
                  <div class="collapse" id="id_<?= $value_3['terminologias_id'] ?>">
                    <div class="card-body padding_0"><?= $value_3['terminologias_descripcion'] ?></div>
                  </div>
                </div>
                <?php foreach ($value_3['hijos'] as $key_4 => $value_4) { ?>
                  <div class="card card-collapsable card_principal">
                    <a class="card-header p-1" href="#id_<?= $value_4['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $value_4['terminologias_id'] ?>">
                      <div>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?= ($key_1 + 1) . '.' . ($key_2 + 1) . '.' . ($key_3 + 1) . '.' . ($key_4 + 1) ?>. <?= $value_4['terminologias_nombre'] ?></div>
                      <div class="card-collapsable-arrow">
                        <i class="fas fa-chevron-down"></i>
                      </div>
                    </a>
                    <div class="collapse" id="id_<?= $value_4['terminologias_id'] ?>">
                      <div class="card-body padding_0"><?= $value_4['terminologias_descripcion'] ?></div>
                    </div>
                  </div>
                  <?php foreach ($value_4['hijos'] as $key_5 => $value_5) { ?>
                    <div class="card card-collapsable card_principal">
                      <a class="card-header p-1" href="#id_<?= $value_5['terminologias_id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="id_<?= $value_5['terminologias_id'] ?>">
                        <div>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?= ($key_1 + 1) . '.' . ($key_2 + 1) . '.' . ($key_3 + 1) . '.' . ($key_4 + 1). '.' . ($key_5 + 1) ?>. <?= $value_5['terminologias_nombre'] ?></div>
                        <div class="card-collapsable-arrow">
                          <i class="fas fa-chevron-down"></i>
                        </div>
                      </a>
                      <div class="collapse" id="id_<?= $value_5['terminologias_id'] ?>">
                        <div class="card-body padding_0"><?= $value_5['terminologias_descripcion'] ?></div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>
        <div class="d-none d-md-block text-center col-md-4">
          <img class="lift img-fluid w-100 border border-2 border-cyan img_concepto mb-2" src="<?= media() ?>/images/hoja_3.jpg" alt="">
          La <b>terminología</b> es una disciplina que se dedica a la recopilación, descripción y presentación de los términos propios de los campos de especialidad.
        </div>
      </div>
    </div>
  </main>
  <?php footerAdmin($data); ?>