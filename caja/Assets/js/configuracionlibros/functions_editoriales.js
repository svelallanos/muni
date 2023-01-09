var listaEditoriales;
var imgSeleccionada = 1;

$(document).ready(function () {
  cargarListaEditoriales();
  openModal();
  agregarEditoriales();
  editarEditoriales();
  eliminarEditoriales();
});

function cargarListaEditoriales() {
  listaEditoriales = $("#tb_editoriales").DataTable({
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
      { data: "editoriales_descripcion" },
      { data: "editoriales_estado" },
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

function openModal() {
  $(".btn_agregar_editoriales").click(function () {
    $("#modal_agregar_editoriales").modal("show");
  });

  $(document).on("click", ".btn_editar_editoriales", function () {
    abrirLoadingModal();
    let editoriales_id = $(this).attr("data-editoriales_id");
    let editoriales_nombre = $(this).attr("data-editoriales_nombre");
    let editoriales_descripcion = $(this).attr("data-editoriales_descripcion");
    let editoriales_estado = $(this).attr("data-editoriales_estado");

    $("#editoriales_nombre_edit").val(editoriales_nombre);
    $("#editoriales_descripcion_edit").val(editoriales_descripcion);
    $("#editoriales_estado_edit").val(editoriales_estado);
    $("#form_editoriales_editar").attr("data-editoriales_id", editoriales_id);
    cerrarLoadingModal();

    $("#modal_editar_editoriales").modal("show");
  });

  $(document).on("click", ".btn_ver_editoriales", function () {
    abrirLoadingModal();
    let editoriales_nombre = $(this).attr("data-editoriales_nombre");
    let editoriales_descripcion = $(this).attr("data-editoriales_descripcion");
    let editoriales_estado = $(this).attr("data-editoriales_estado");

    $(".view_nombre_editorial").html(editoriales_nombre);
    $(".view_descripcion_editorial").html(editoriales_descripcion);

    estado = "Inactivo";
    color = "danger";
    if (editoriales_estado == 1) {
      estado = "Activo";
      color = "success";
    }
    $(".view_estado_editorial").html(
      `<span class="badge fs-10 bg-${color}-soft text-${color}">${estado}</span>`
    );

    cerrarLoadingModal();

    $("#modal_ver_editoriales").modal("show");
  });
}

function agregarEditoriales() {
  $("#form_editoriales").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_editoriales");
    const formData = new FormData(form);

    const request = axios.post("agregarEditoriales", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaEditoriales.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_editoriales").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarEditoriales() {
  $("#form_editoriales_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let editoriales_id = $(this).attr("data-editoriales_id");
    let form = document.getElementById("form_editoriales_editar");
    const formData = new FormData(form);
    formData.append("editoriales_id", editoriales_id);

    const request = axios.post("editarEditoriales", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaEditoriales.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_editoriales").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarEditoriales() {
  $(document).on("click", ".btn_eliminar_editoriales", function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar el autor, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let editoriales_id = $(this).attr("data-editoriales_id");
        const formData = new FormData();
        formData.append("editoriales_id", editoriales_id);

        const request = axios.post("eliminarEditoriales", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaEditoriales.ajax.reload(() => cerrarLoadingModal());
          } else {
            cerrarLoadingModal();
          }
        });

        request.catch((error) => {
          console.log(error);
        });
      }
    });
  });
}
