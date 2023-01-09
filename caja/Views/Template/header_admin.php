<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= (isset($data['page_title']) ? $data['page_title'] : 'Sin nombre de página') ?></title>

  <link href="<?= media() ?>/css/general/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="<?= media() ?>/css/general/styles.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <link href="<?= media() ?>/css/general/feather.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= media() ?>/images/perfil_book3.png" />

  <link href="<?= media() ?>/css/general/style_customized.css?version=<?= getVerion() ?>" rel="stylesheet" />

  <?php if (isset($data['page_css']) && !empty($data['page_css'])) { ?>
    <link href="<?= media() ?>/css/<?= $data['page_css'] ?>.css?version=<?= getVerion() ?>" rel="stylesheet" />
  <?php } ?>

</head>

<body class="nav-fixed">
  <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?= base_url() ?>Inicio">BIBLIOTECA</a>
    <!-- Navbar Search Input-->
    <form class="form-inline me-auto d-none d-lg-block me-3">
      <div class="input-group input-group-joined input-group-solid">
        <input class="form-control pe-0" type="search" placeholder="buscar" aria-label="Search" />
        <div class="input-group-text"><i data-feather="search"></i></div>
      </div>
    </form>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
      <!-- Alerts Dropdown-->
      <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
          <h6 class="dropdown-header dropdown-notifications-header">
            <i class="me-2" data-feather="bell"></i>
            Alerts Center
          </h6>
          <!-- Example Alert 1-->
          <a class="dropdown-item dropdown-notifications-item" href="#!">
            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
            <div class="dropdown-notifications-item-content">
              <div class="dropdown-notifications-item-content-details">December 29, 2021</div>
              <div class="dropdown-notifications-item-content-text">This is an alert message. It's nothing serious, but it requires your attention.</div>
            </div>
          </a>
          <!-- Example Alert 2-->
          <a class="dropdown-item dropdown-notifications-item" href="#!">
            <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
            <div class="dropdown-notifications-item-content">
              <div class="dropdown-notifications-item-content-details">December 22, 2021</div>
              <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
            </div>
          </a>
          <!-- Example Alert 3-->
          <a class="dropdown-item dropdown-notifications-item" href="#!">
            <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="dropdown-notifications-item-content">
              <div class="dropdown-notifications-item-content-details">December 8, 2021</div>
              <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
            </div>
          </a>
          <!-- Example Alert 4-->
          <a class="dropdown-item dropdown-notifications-item" href="#!">
            <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
            <div class="dropdown-notifications-item-content">
              <div class="dropdown-notifications-item-content-details">December 2, 2021</div>
              <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
            </div>
          </a>
          <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
        </div>
      </li>
      <!-- User Dropdown-->
      <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= media() ?>/images/fotoperfil/<?= (empty($_SESSION['biblioteca']['usuarios_foto'])) ? 'sin_foto.png' : $_SESSION['biblioteca']['usuarios_foto'] ?>" /></a>
        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
          <h6 class="dropdown-header d-flex align-items-center">
            <img class="dropdown-user-img" src="<?= media() ?>/images/fotoperfil/<?= (empty($_SESSION['biblioteca']['usuarios_foto'])) ? 'sin_foto.png' : $_SESSION['biblioteca']['usuarios_foto'] ?>" />
            <div class="dropdown-user-details">
              <div class="dropdown-user-details-name text-uppercase"><?= $_SESSION['biblioteca']['usuarios_nombres'].' '.$_SESSION['biblioteca']['usuarios_paterno'] ?></div>
              <div class="dropdown-user-details-email mb-1"><?= $_SESSION['biblioteca']['usuarios_email'] ?></div>
              <div class="dropdown-user-details-roles">
                <?php foreach ($_SESSION['biblioteca']['roles'] as $key => $value) {
                  echo '<span class="badge bg-primary-soft text-primary">'.$value.'</span> ';
                } ?>
              </div>
            </div>
          </h6>
          <div class="dropdown-divider"></div>
          <!-- <a class="dropdown-item" href="#!">
            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
            Account
          </a> -->
          <a class="dropdown-item" href="<?= base_url() ?>logout">
            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
            Cerrar Sesión
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <?php require_once('./Views/Template/nav_admin.php'); ?>