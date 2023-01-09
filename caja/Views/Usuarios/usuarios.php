<?php headerAdmin($data) ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="inicio">Mantenimientos</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12 border border-2 border-secondary rounded p-2 mb-4">
              <a href="nuevo" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i> &nbsp Agregar</a>
              <button class="btn btn-danger"><i class="fa-solid fa-file-contract"></i> &nbsp Reporte</button>
            </div>

            <table id="lista_usuarios" class="display compact w-100">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>NOMBRES</th>
                  <th>DNI</th>
                  <th>CREACIÓN</th>
                  <th>ROLES</th>
                  <th>ESTADO</th>
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
  </section>

</main><!-- End #main -->
<?php footerAdmin($data) ?>