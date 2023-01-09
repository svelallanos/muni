var listaEditoriales;
var listaAutoresDisponibles;
var listaAutoresVinculados;
var listaKeyowrdsDisponibles;
var listaKeyowrdsVinculados;
var listaMateriasDisponibles;
var listaMateriasVinculados;
var listaTitulos;
var tb_listaTitulos;

$(document).ready(function () {
  openModals();
  agregarEditorial();
  eliminarEditorial();
  agregarAutores();
  eliminarAutores();
  agregarKeywords();
  eliminarKeywords();
  agregarMaterias();
  eliminarMaterias();
  agregarTitulos();
  editarTitulos();
});

function subNivelChange() {
  $("#niveles_id").change(function () {
    let valor = $(this).val();

    if (valor != 1) {
      $(".dependencia_show").removeClass("d-none");
    } else {
      $(".dependencia_show").addClass("d-none");
    }
  });

  $(".__btn_add_dependencia").click(function () {
    $("#modal_titulos").modal("show");
    $("#modal_add_titulos").modal("hide");
  });
}

function cerrarListTitulos() {
  $(".btn_cerrar_titulo").click(function () {
    $("#modal_titulos").modal("hide");
    $("#modal_add_titulos").modal("show");
  });
}

function openModals() {
  $(".btn_add_editorial").click(function () {
    abrirLoadingModal();
    cargarEditoriales();
    $("#modal_add_edditorial").modal("show");
    cerrarLoadingModal();
  });

  $(".btn_add_autores").click(function () {
    abrirLoadingModal();
    cargarAutores();
    $("#modal_add_autores").modal("show");
    cerrarLoadingModal();
  });

  $(".btn_add_keywords").click(function () {
    abrirLoadingModal();
    cargarKeywords();
    $("#modal_add_keywords").modal("show");
    cerrarLoadingModal();
  });

  $(".btn_add_materias").click(function () {
    abrirLoadingModal();
    cargarMaterias();
    $("#modal_add_materias").modal("show");
    cerrarLoadingModal();
  });

  $(".btn_add_titulos").click(function () {
    abrirLoadingModal();
    subNivelChange();
    cerrarListTitulos();
    cargarTitulos();
    cargarListaTitulos();
    $("#modal_add_titulos").modal("show");
    cerrarLoadingModal();
  });

  $(document).on("click", ".__btn_seleccionar_dependencia_titulo", function () {
    let dependencia_id = $(this).attr("data-detalle_niveles_id");
    let dependencia_titulo = $(this).attr("data-detalle_niveles_titulo");

    $("#detalle_niveles_dependencia").attr(
      "data-dependencia_id",
      dependencia_id
    );
    $("#detalle_niveles_dependencia").val(dependencia_titulo);

    $("#modal_titulos").modal("hide");
    $("#modal_add_titulos").modal("show");
  });

  $(document).on("click", ".__btn_editar_titulo", function () {
    abrirLoadingModal();
    let detalle_niveles_id = $(this).attr("data-detalle_niveles_id");
    let detalle_niveles_titulo = $(this).attr("data-detalle_niveles_titulo");

    $("#detalle_niveles_titulo_edit").val(detalle_niveles_titulo);
    $("#form_editar_titulo").attr(
      "data-detalle_niveles_id",
      detalle_niveles_id
    );

    cerrarLoadingModal();
    $("#modal_editar_titulos").modal("show");
  });
}

function cargarEditoriales() {
  listaEditoriales = $("#tabla_editoriales").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectEditoriales",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "editoriales_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });
}

function cargarTitulos() {
  let libro_id = $("#data_libro_id").attr("data-libro_id");

  listaTitulos = $("#tb_titulos").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectTitulos",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "detalle_niveles_titulo" },
      { data: "niveles_orden" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-9",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
      {
        class: "col-1 text-center",
        targets: 3,
      },
    ],
  });
}

function cargarListaTitulos() {
  let libro_id = $("#data_libro_id").attr("data-libro_id");

  tb_listaTitulos = $("#lista_titulos_control").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectTitulosControl",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "detalle_niveles_titulo" },
      { data: "niveles_orden" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-9",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
      {
        class: "col-1 text-center",
        targets: 3,
      },
    ],
  });
}

function cargarAutores() {
  let libro_id = $("#data_libro_id").attr("data-libro_id");

  listaAutoresDisponibles = $("#tabla_autores_disponibles").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectAutoresDisponibles",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "autores_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });

  listaAutoresVinculados = $("#tabla_autores_vinculados").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectAutoresVinculados",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "autores_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });
}

function cargarKeywords() {
  let libro_id = $("#data_libro_id").attr("data-libro_id");

  listaKeyowrdsDisponibles = $("#tabla_keywords_disponibles").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectKeyowrdsDisponibles",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "keywords_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });

  listaKeyowrdsVinculados = $("#tabla_keywords_vinculados").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectKeywordsVinculados",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "keywords_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });
}

function cargarMaterias() {
  let libro_id = $("#data_libro_id").attr("data-libro_id");

  listaMateriasDisponibles = $("#tabla_materias_disponibles").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectMateriasDisponibles",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "materias_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });

  listaMateriasVinculados = $("#tabla_materias_vinculados").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectMateriasVinculados",
      data: { libro_id: libro_id },
      type: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "materias_nombre" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    Order: [[0, "desc"]],
    columnDefs: [
      {
        class: "col-1 text-center",
        targets: 0,
      },
      {
        class: "col-10",
        targets: 1,
      },
      {
        class: "col-1 text-center",
        targets: 2,
      },
    ],
  });
}

function agregarEditorial() {
  $(document).on("click", ".__btn_agregar_editoriales", function () {
    let editoriales_id = $(this).attr("data-editoriales_id");
    let libro_id = $("#form_eliminar_editorial").attr("data-libro_id");

    const formData = new FormData();
    formData.append("editoriales_id", editoriales_id);
    formData.append("libro_id", libro_id);

    abrirLoadingModal();
    const request = axios.post("agregarEditorial", formData);

    request.then((res) => {
      msgFlash("mensaje_editorial", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        $(".delete_editorial").val(res.data.data);
        uploadPage("#close_page", true);
      }

      cerrarLoadingModal();
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarEditorial() {
  $("#form_eliminar_editorial").submit(function (e) {
    e.preventDefault();

    let libro_id = $(this).attr("data-libro_id");
    const formData = new FormData();

    formData.append("libro_id", libro_id);

    abrirLoadingModal();
    const request = axios.post("eliminarEditorial", formData);

    request.then((res) => {
      msgFlash("mensaje_editorial", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        $(".delete_editorial").val("Vacío");
        uploadPage("#close_page", true);
      }
      cerrarLoadingModal();
    });
  });
}

function agregarAutores() {
  $(document).on("click", ".__btn_agregar_autores", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let autores_id = $(this).attr("data-autores_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("autores_id", autores_id);

    abrirLoadingModal();
    const request = axios.post("agregarAutores", formData);

    request.then((res) => {
      msgFlash("mensaje_autores", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaAutoresDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaAutoresVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}

function agregarKeywords() {
  $(document).on("click", ".__btn_agregar_keywords", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let keywords_id = $(this).attr("data-keywords_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("keywords_id", keywords_id);

    abrirLoadingModal();
    const request = axios.post("agregarKeywords", formData);

    request.then((res) => {
      msgFlash("mensaje_keywords", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaKeyowrdsDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaKeyowrdsVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}

function agregarMaterias() {
  $(document).on("click", ".__btn_agregar_materias", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let materias_id = $(this).attr("data-materias_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("materias_id", materias_id);

    abrirLoadingModal();
    const request = axios.post("agregarMaterias", formData);

    request.then((res) => {
      msgFlash("mensaje_materias", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaMateriasDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaMateriasVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function agregarTitulos() {
  $("#form_add_titulos").submit(function (e) {
    e.preventDefault();

    let form = document.getElementById("form_add_titulos");
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let niveles_id = $("#niveles_id").val();
    const formData = new FormData(form);

    formData.append("libro_id", libro_id);

    if (niveles_id != 1) {
      let dependencia_id = $("#detalle_niveles_dependencia").attr(
        "data-dependencia_id"
      );
      if (dependencia_id == 0) {
        Swal.fire(
          "ALERTA",
          "Por favor seleccionar la dependencia del título del libro.",
          "warning"
        );
        return;
      }

      formData.append("dependencia_id", dependencia_id);
    }

    abrirLoadingModal();
    const request = axios.post("agregarTitulos", formData);

    request.then((res) => {
      msgFlash("mensaje_titulos", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaTitulos.ajax.reload(() => {
          cerrarLoadingModal();
        });
        tb_listaTitulos.ajax.reload(() => {
          cerrarLoadingModal();
        });
        form.reset();
        uploadPage("#close_page", true);

        $(".dependencia_show").addClass("d-none");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarTitulos() {
  $("#form_editar_titulo").submit(function (e) {
    e.preventDefault();

    let form = document.getElementById("form_editar_titulo");
    let detalle_niveles_id = $(this).attr("data-detalle_niveles_id");
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    const formData = new FormData(form);

    formData.append("detalle_niveles_id", detalle_niveles_id);
    formData.append("libro_id", libro_id);

    abrirLoadingModal();

    const request = axios.post("editarTitulos", formData);

    request.then((res) => {
      msgFlash("mensaje_titulos", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaTitulos.ajax.reload(() => {
          cerrarLoadingModal();
        });
        tb_listaTitulos.ajax.reload(() => {
          cerrarLoadingModal();
        });
        $("#modal_editar_titulos").modal("hide");
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}

function eliminarAutores() {
  $(document).on("click", ".__btn_eliminar_autores", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let detalle_autor_id = $(this).attr("data-detalle_autor_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("detalle_autor_id", detalle_autor_id);

    abrirLoadingModal();
    const request = axios.post("eliminarAutores", formData);

    request.then((res) => {
      msgFlash("mensaje_autores", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaAutoresDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaAutoresVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}

function eliminarKeywords() {
  $(document).on("click", ".__btn_eliminar_keywords", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let detalle_keywords_id = $(this).attr("data-detalle_keywords_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("detalle_keywords_id", detalle_keywords_id);

    abrirLoadingModal();
    const request = axios.post("eliminarKeywords", formData);

    request.then((res) => {
      msgFlash("mensaje_keywords", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaKeyowrdsDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaKeyowrdsVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}

function eliminarMaterias() {
  $(document).on("click", ".__btn_eliminar_materias", function () {
    let libro_id = $("#data_libro_id").attr("data-libro_id");
    let detalle_materias_id = $(this).attr("data-detalle_materias_id");

    const formData = new FormData();
    formData.append("libro_id", libro_id);
    formData.append("detalle_materias_id", detalle_materias_id);

    abrirLoadingModal();
    const request = axios.post("eliminarMaterias", formData);

    request.then((res) => {
      msgFlash("mensaje_materias", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaMateriasDisponibles.ajax.reload(() => {
          cerrarLoadingModal();
        });
        listaMateriasVinculados.ajax.reload(() => {
          cerrarLoadingModal();
        });
        uploadPage("#close_page", true);
      } else {
        cerrarLoadingModal();
      }
    });
  });
}
