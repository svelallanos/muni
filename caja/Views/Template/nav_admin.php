<div id="layoutSidenav_nav">
  <nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
      <div class="nav accordion" id="accordionSidenav">
        <!-- Sidenav Menu Heading (Account)-->
        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
        <div class="sidenav-menu-heading d-sm-none">NOTIFICACIONES</div>
        <a class="nav-link d-sm-none" href="#!">
          <div class="nav-link-icon"><i data-feather="bell"></i></div>
          Alertas
          <span class="badge bg-warning-soft text-warning ms-auto">4 Nuevos!</span>
        </a>
        <!-- Apartado de solo mantenimientos -->
        <?php if (verificarPermiso($data, 6) || verificarPermiso($data, 7) || verificarPermiso($data, 10) || verificarPermiso($data, 8) || verificarPermiso($data, 9) || verificarPermiso($data, 1) || verificarPermiso($data, 2) || verificarPermiso($data, 11)) { ?>
          <div class="sidenav-menu-heading">Configuraciones</div>
        <?php } ?>
        <!-- Modulo de mantenimientos de libros-->
        <?php if (verificarPermiso($data, 6) || verificarPermiso($data, 7) || verificarPermiso($data, 10)) { ?>
          <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLibrosMantenimiento" aria-expanded="false" aria-controls="collapseLibrosMantenimiento">
            <div class="nav-link-icon"><i class="feather-server"></i></div>
            Config. Libros
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLibrosMantenimiento" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
              <?php if (verificarPermiso($data, 6)) { ?>
                <a class="nav-link" href="<?= base_url() ?>ConfiguracionLibros/libros">Libros</a>
              <?php } ?>
              <?php if (verificarPermiso($data, 7)) { ?>
                <a class="nav-link" href="<?= base_url() ?>ConfiguracionLibros/autores">Autores</a>
              <?php } ?>
              <?php if (verificarPermiso($data, 10)) { ?>
                <a class="nav-link" href="<?= base_url() ?>ConfiguracionLibros/editoriales">Editoriales</a>
              <?php } ?>
            </nav>
          </div>
        <?php } ?>
        <!-- Modulo de mantenimientos -->
        <?php if (verificarPermiso($data, 8) || verificarPermiso($data, 9) || verificarPermiso($data, 1) || verificarPermiso($data, 2) || verificarPermiso($data, 11)) { ?>
          <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseMantenimientos" aria-expanded="false" aria-controls="collapseMantenimientos">
            <div class="nav-link-icon"><i class="fa-solid fa-gears"></i></div>
            Mantenimientos
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseMantenimientos" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
              <?php if (verificarPermiso($data, 2)) { ?>
                <a class="nav-link" href="<?= base_url() ?>Usuarios/lista_usuario">
                  Usuarios
                  <span class="badge bg-primary-soft text-primary ms-auto">Admin</span>
                </a>
              <?php } ?>
              <?php if (verificarPermiso($data, 1)) { ?>
                <a class="nav-link" href="<?= base_url() ?>Roles">
                  Roles
                  <span class="badge bg-primary-soft text-primary ms-auto">Admin</span>
                </a>
              <?php } ?>
              <?php if (verificarPermiso($data, 8)) { ?>
                <a class="nav-link" href="<?= base_url() ?>Usuarios/bloqueos">
                  Bloqueos
                  <span class="badge bg-primary-soft text-primary ms-auto">Admin</span>
                </a>
              <?php } ?>
              <?php if (verificarPermiso($data, 9)) { ?>
                <a class="nav-link" href="<?= base_url() ?>Usuarios/permisos_personalizados">
                  Permisos personalizados
                  <span class="badge bg-primary-soft text-primary ms-auto">Admin</span>
                </a>
              <?php } ?>
              <?php if (verificarPermiso($data, 11)) { ?>
                <a class="nav-link" href="<?= base_url() ?>indexacionLibros/elementos">
                  Indexación de libros
                  <span class="badge bg-primary-soft text-primary ms-auto">Admin</span>
                </a>
              <?php } ?>
            </nav>
          </div>
        <?php } ?>



        <!-- Fin del modulo de mantenimientos -->
        <!-- Sidenav Heading (Custom)-->
        <?php if (verificarPermiso($data, 22) || verificarPermiso($data, 23)) { ?>
          <div class="sidenav-menu-heading">BIBLIOTECA FISICA</div>
        <?php } ?>
        <!-- Sidenav Accordion (Flows)-->
        <?php if (verificarPermiso($data, 22) || verificarPermiso($data, 23)) { ?>
          <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#biblioteca_item" aria-expanded="false" aria-controls="biblioteca_item">
            <div class="nav-link-icon"><i class="fa-solid fa-book-atlas"></i></div>
            Biblioteca
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
        <?php } ?>
        <div class="collapse" id="biblioteca_item" data-bs-parent="#accordionSidenav">
          <nav class="sidenav-menu-nested nav">
            <?php if (verificarPermiso($data, 22)) { ?>
              <a class="nav-link" href="#">Reservas</a>
            <?php } ?>
            <?php if (verificarPermiso($data, 23)) { ?>
              <a class="nav-link" href="#">Prestamos</a>
            <?php } ?>
          </nav>
        </div>
        <div class="sidenav-menu-heading">BIBLIOTECA DIGITAL</div>
        <?php if (verificarPermiso($data, 25)) { ?>
          <a class="nav-link" href="<?= base_url() ?>Inicio">
            <div class="nav-link-icon"><i class="fa-solid fa-house"></i></div>
            Inicio
          </a>
        <?php } ?>
        <?php if (verificarPermiso($data, 21)) { ?>
          <a class="nav-link" href="<?= base_url() ?>BusquedaInteligente/motorBusqueda">
            <div class="nav-link-icon"><i class="feather-search"></i></div>
            Búsqueda Inteligente
          </a>
        <?php } ?>
        <?php if (verificarPermiso($data, 25)) { ?>
          <a class="nav-link" href="#libros">
            <div class="nav-link-icon"><i class="feather-book"></i></div>
            Libros
          </a>
          <a class="nav-link" href="#categorias">
            <div class="nav-link-icon"><i class="feather-bookmark"></i></div>
            Categorías
          </a>
          <a class="nav-link" href="#autores">
            <div class="nav-link-icon"><i class="feather-user"></i></div>
            Autores
          </a>
          <a class="nav-link" href="#editoriales">
            <div class="nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
            Editoriales
          </a>
          <a class="nav-link" href="#repositorios">
            <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
            Repositorios
          </a>
          <a class="nav-link" href="#enlaces">
            <div class="nav-link-icon"><i class="feather-link"></i></div>
            Enlaces académicos
          </a>
        <?php } ?>
      </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
      <div class="sidenav-footer-content">
        <div class="sidenav-footer-subtitle">Conectado como:</div>
        <div class="sidenav-footer-title text-success">
          <?php foreach ($_SESSION['biblioteca']['roles'] as $key => $value) {
            echo '<span class="badge bg-primary-soft text-primary">' . $value . '</span> ';
          } ?>
        </div>
      </div>
    </div>
  </nav>
</div>