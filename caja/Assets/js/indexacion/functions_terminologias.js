var ListaTerminologias;
var ListaDependencias;

$(document).ready(function () {
  filtrarTerminologias();
  cargarListaTerminologias();
  openModal();
  agregarTerminologias();
  agregarDependencia();
  editarTerminologias();
  eliminarTerminologia();
  eliminarDependencia();
});

function cargarListaTerminologias() {
  ListaTerminologias = $("#tb_terminologias").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectTerminologias",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "terminologias_nombre" },
      { data: "terminologias_descripcion" },
      { data: "terminologias_dependencia" },
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
        class: "col-3",
        targets: 1,
      },
      {
        class: "col-6",
        targets: 2,
      },
      {
        class: "col-1 text-center",
        targets: 3,
      },
      {
        class: "col-1 text-center",
        targets: 4,
      },
    ],
  });
}

function listaAllDependencias() {
  ListaDependencias = $("#tb_dependencias").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectDependencias",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "terminologias_nombre" },
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

function agregarDependencia() {
  $(document).on("click", ".__agregar_terminologia", function () {
    let terminologias_id = $(this).attr("data-terminologias_id");
    let terminologias_nombre = $(this).attr("data-terminologias_nombre");

    $("#terminologias_dependencia").attr(
      "data-dependencia_id",
      terminologias_id
    );
    $("#terminologias_dependencia").val(terminologias_nombre);
    cerrarModal();
  });
}

function cerrarModal() {
  abrirLoadingModal();
  $("#modal_listterminologia").modal("hide");
  $("#modal_agregar_terminologias").modal("show");
  cerrarLoadingModal();
}

function openModal() {
  $(".btn_agregar_terminologia").click(function () {
    abrirLoadingModal();
    $(".bg_header").removeClass("bg-warning");
    $(".text_header").html("AGREGAR TERMINOLOGÍA");
    $(".terminologia_append").attr("id", "form_terminologias");
    $(".boton_guardar").removeClass("bg-primary");
    $(".boton_guardar").html(
      '<i class="feather-plus-circle"></i> &nbsp Guardar'
    );

    let form = document.getElementById("form_terminologias");
    form.reset();

    $("#modal_agregar_terminologias").modal("show");
    cerrarLoadingModal();
  });

  $(".btn_dependencia").click(function () {
    abrirLoadingModal();
    listaAllDependencias();
    $("#modal_agregar_terminologias").modal("hide");
    $("#modal_listterminologia").modal("show");
    cerrarLoadingModal();
  });

  $(document).on("click", ".btn_editar_terminologias", function () {
    abrirLoadingModal();
    let terminologias_id = $(this).attr("data-terminologias_id");
    const formData = new FormData();

    formData.append("terminologias_id", terminologias_id);

    const request = axios.post("selectTerminologia", formData);

    request.then((res) => {
      if (res.data.status) {
        $(".bg_header").addClass("bg-warning");
        $(".text_header").html("EDITAR TERMINOLOGÍA");
        $(".terminologia_append").attr("id", "editar_terminologia");
        $(".boton_guardar").addClass("bg-primary");
        $(".boton_guardar").html(
          '<i class="feather-plus-circle"></i> &nbsp Actualizar'
        );

        $(".terminologia_append").attr(
          "data-terminologias_id",
          res.data.data.terminologias_id
        );
        $("#terminologias_dependencia").attr(
          "data-dependencia_id",
          res.data.data.terminologias_id_dos
        );
        $("#terminologias_nombre").val(res.data.data.terminologias_nombre);
        $("#terminologias_dependencia").val(
          res.data.data.terminologias_nombre_dos
        );
        $("#terminologias_descripcion").val(
          res.data.data.terminologias_descripcion
        );

        $("#modal_agregar_terminologias").modal("show");
        cerrarLoadingModal();
      } else {
        cerrarLoadingModal();
        msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      }
    });

    // $("#form_categorias_editar").attr("data-categorias_id", categorias_id);
    // cerrarLoadingModal();

    // $("#modal_editar_categorias").modal("show");
  });

  $(document).on("click", ".btn_ver_categoria", function () {
    abrirLoadingModal();
    let categorias_nombre = $(this).attr("data-categorias_nombre");
    let categorias_descripcion = $(this).attr("data-categorias_descripcion");
    let categorias_estado = $(this).attr("data-categorias_estado");

    $("#categorias_nombre_view").val(categorias_nombre);
    $("#categorias_descripcion_view").val(categorias_descripcion);
    $("#categorias_estado_view").val(categorias_estado);
    cerrarLoadingModal();

    $("#modal_ver_categorias").modal("show");
  });

  $(".btn_cerrar").click(function () {
    cerrarModal();
  });
}

function filtrarTerminologias() {
  $(".btn_filtrar_terminologias").click(function () {
    ListaTerminologias = $("#tb_terminologias").DataTable({
      aProcessing: true,
      aServerSide: true,
      language: languajeDefault,
      ajax: {
        url: "selectFilterTerminologias",
        dataSrc: "",
      },
      columns: [
        { data: "numero" },
        { data: "terminologias_nombre" },
        { data: "terminologias_descripcion" },
        { data: "terminologias_dependencia" },
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
          class: "col-3",
          targets: 1,
        },
        {
          class: "col-6",
          targets: 2,
        },
        {
          class: "col-1 text-center",
          targets: 3,
        },
        {
          class: "col-1 text-center",
          targets: 4,
        },
      ],
    });
  });

  $(".btn_filtrar_terminologias_nenos").click(function () {
    cargarListaTerminologias();
  });
}

function agregarTerminologias() {
  $(document).on("submit", "#form_terminologias", function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let dependencia_id = $("#terminologias_dependencia").attr(
      "data-dependencia_id"
    );
    let form = document.getElementById("form_terminologias");
    const formData = new FormData(form);
    formData.append("dependencia_id", dependencia_id);

    const request = axios.post("agregarTerminologias", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      // $("#modal_agregar_terminologias").modal("hide");
      if (res.data.status) {
        $('#terminologias_nombre').val('');
        ListaTerminologias.ajax.reload(() => cerrarLoadingModal());
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarTerminologias() {
  $(document).on("submit", "#editar_terminologia", function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let terminologias_id = $(this).attr("data-terminologias_id");
    let dependencia_id = $("#terminologias_dependencia").attr(
      "data-dependencia_id"
    );
    let form = document.getElementById("editar_terminologia");
    const formData = new FormData(form);
    formData.append("dependencia_id", dependencia_id);
    formData.append("terminologias_id", terminologias_id);

    const request = axios.post("editarTerminologias", formData);

    request.then((res) => {
      if (res.data.status) {
        form.reset();
        msgFlash("mensaje", res.data.msg, res.data.value, 5000);
        $("#modal_agregar_terminologias").modal("hide");
        cargarListaTerminologias();
      } else {
        Swal.fire("ALERTA", res.data.msg, res.data.value);
      }
      cerrarLoadingModal();
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarDependencia() {
  $(document).on("click", ".btn_eliminar_dependencia", function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar la dependencia de esta terminología, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let terminologias_id = $(this).attr("data-terminologias_id");
        const formData = new FormData();
        formData.append("terminologias_id", terminologias_id);

        const request = axios.post("eliminarDependencia", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            cargarListaTerminologias();
          }
          cerrarLoadingModal();
        });

        request.catch((error) => {
          console.log(error);
        });
      }
    });
  });
}

function eliminarTerminologia() {
  $(document).on("click", ".btn_eliminar_terminologias", function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar la terminología, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let terminologias_id = $(this).attr("data-terminologias_id");
        const formData = new FormData();
        formData.append("terminologias_id", terminologias_id);

        const request = axios.post("eliminarTerminologia", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            cargarListaTerminologias();
          }
          cerrarLoadingModal();
        });

        request.catch((error) => {
          console.log(error);
        });
      }
    });
  });
}
