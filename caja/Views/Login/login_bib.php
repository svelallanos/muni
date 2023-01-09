<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= (isset($data['page_title']) ? $data['page_title'] : 'Sin nombre de página') ?></title>
  <link rel="icon" type="image/x-icon" href="<?= media() ?>/images/perfil_book3.png" />
  <link href="<?= media() ?>/css/general/styles.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <link href="<?= media() ?>/css/general/feather.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= media() ?>/images/perfil_book3.png" />

  <link href="<?= media() ?>/css/general/style_customized.css?version=<?= getVerion() ?>" rel="stylesheet" />

  <?php if (isset($data['page_css']) && !empty($data['page_css'])) { ?>
    <link href="<?= media() ?>/css/<?= $data['page_css'] ?>.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <?php } ?>
  <title>Este es el Login</title>
</head>

<body>
  <div class="container-fluid">
    <div class="container position-relative">
      <div class="box-card-login position-absolute top-50 start-50 translate-middle">
        <div class="row box-item m-0">
          <div class="col-md-7 box-descripcion">
            <img class="" src="<?= media() ?>/images/perfil_book.png" alt="">
            <label> Repositorio y Biblioteca San Lucas</label>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure iusto est, eos nam nesciunt neque aspernatur suscipit atque facere, ut quasi non hic accusantium quisquam fugiat doloremque. Iste, iure quia.</p>
            <div class="box-redes">
              <a title="Página de facebook" href="https://www.facebook.com/iessanlucas" target="_blank" class="btn btn-white btn-icon">
                <i class="feather-facebook"></i>
              </a>
              <a title="Página de youtube" href="https://www.youtube.com/channel/UC_3ehZ6z2qNFZJIaxbgg8pg" target="_blank" class="btn btn-danger btn-icon">
                <i class="feather-youtube"></i>
              </a>
              <a title="Página de instagram" href="https://www.instagram.com/institutosanlucas/" target="_blank" class="btn btn-yellow btn-icon">
                <i class="feather-instagram"></i>
              </a>
              <a title="Página web del instituto san lucas" href="https://instituto.aesanlucas.edu.pe/" target="_blank" class="btn btn-green btn-icon">
                <i class="feather-chrome"></i>
              </a>
            </div>
          </div>
          <div class="col-md-5 box-logeo">
            <div class="row">
              <img src="https://aesanlucas.edu.pe/intranet/Assets/images/logo_inst_small.png">
              <h1>Bienvenidos</h1>
              <form id="form_login" autocomplete="off">
                <div class="mb-3 box-input">
                  <span class="icon"><i class="feather-user"></i></span>
                  <input name="nombre_usuario" id="nombre_usuario" required placeholder="Nombre de usuario" class="form-control input-dis" type="text">
                </div>
                <div class="mb-3 box-input">
                  <span class="icon"><i class="feather-lock"></i></span>
                  <input name="pass_usuario" id="pass_usuario" required placeholder="Contraseña" class="form-control input-dis" type="password">
                </div>
                <div class="dis-button">
                  <button type="submit">Iniciar Sesion</button>
                </div>
              </form>
              <div class="dis-alert p-2" role="alert">
                <span class="fw-500">NOTA:</span> Si eres estudiante, tu usuario y contraseña son los mismos que de intranet.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php printHTMLRequired() ?>

  <script type="text/javascript">
    var base_url = '<?= base_url() ?>';
  </script>

  <script src="<?= media() ?>/js/general/sweetalert2@11.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/all.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/jquery-3.6.0.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/feather.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/bootstrap.bundle.min.js?version=<?= getVerion() ?>"></script>
  <script src="<?= media() ?>/js/general/axios.min.js?version=<?= getVerion() ?>"></script>

  <script src="<?= media() ?>/js/general/filerequired.js?version=<?= getVerion() ?>"></script>

  <?php if (isset($data['page_function_js']) && !empty($data['page_function_js'])) { ?>
    <script src="<?= media() ?>/js/<?= $data['page_function_js'] ?>.js?version=<?= getVerion() ?>"></script>
  <?php } ?>

  <!-- Modal de alertas de sesion -->
  <?php getModal('modal_login', $data) ?>
  <!-- Fin de alertas -->
</body>

</html>