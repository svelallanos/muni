var listaAutores;
var imgSeleccionada = 1;

$(document).ready(function () {
  cargarListaAutores();
  actualizarFoto();
  openModal();
  agregarAutores();
  editarAutores();
  eliminarAutores();
});

function cargarListaAutores() {
  listaAutores = $("#tb_autores").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectAutores",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "autores_imagen" },
      { data: "autores_nombre" },
      { data: "autores_estado" },
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
        class: "col-1 text-center",
        targets: 1,
      },
      {
        class: "col-8",
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

function actualizarFoto() {
  $(".cargar_imagen").click(function () {
    $("#autores_imagen_edit").click();
  });

  $("#autores_imagen_edit").change(function () {
    if (imgSeleccionada == 0) {
      $("#autores_imagen_edit").val("");
      return false;
    }

    $(".cargar_imagen").attr("disabled", true);
    $(".container_loader").removeClass("hide");
    $(".container_loader").addClass("show");

    iconLoader(".container_loader", "show");

    let inputFile = $("#autores_imagen_edit");
    if (inputFile.val() === "") {
      console.log("sin foto");
      return;
    }

    let autores_id = $("#form_autores_editar").attr("data-autores_id");
    let formData = new FormData();
    let files = inputFile[0].files[0];
    $("#autores_imagen_edit").val("");

    formData.append("fileprofile", files);
    formData.append("autores_id", autores_id);

    var request = axios.post("updateFotoPefilAutor", formData);

    request.then((res) => {
      if (res.data.status) {
        msgFlash("mensaje_file", res.data.msg, res.data.value, 5000);
        $(".autor_imagen_form").attr(
          "src",
          base_url + `Assets/images/autores/${res.data.name_foto}`
        );
        listaAutores.ajax.reload(() => {
          abrirLoadingModal();
          cerrarLoadingModal();
        });
      } else {
        msgFlash("mensaje_file", res.data.msg, res.data.value, 5000);
        if (res.data.name_foto != null) {
          $(".autor_imagen_form").attr(
            "src",
            base_url + `Assets/images/autores/${res.data.name_foto}`
          );
          listaAutores.ajax.reload(() => {
            abrirLoadingModal();
            cerrarLoadingModal();
          });
        }
      }

      iconLoader(".container_loader", "hide");
      $(".cargar_imagen").attr("disabled", false);
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function openModal() {
  $(".btn_agregar_autores").click(function () {
    $("#modal_agregar_autores").modal("show");
  });

  $(document).on("click", ".btn_editar_autores", function () {
    abrirLoadingModal();
    let autores_id = $(this).attr("data-autores_id");
    let autores_nombre = $(this).attr("data-autores_nombre");
    let autores_descripcion = $(this).attr("data-autores_descripcion");
    let autores_imagen = $(this).attr("data-autores_imagen");
    let autores_estado = $(this).attr("data-autores_estado");

    $("#autores_nombre_edit").val(autores_nombre);
    $("#autores_descripcion_edit").val(autores_descripcion);
    $("#autores_estado_edit").val(autores_estado);
    $(".autor_imagen_form").attr(
      "src",
      base_url + `Assets/images/autores/${autores_imagen}`
    );
    $("#form_autores_editar").attr("data-autores_id", autores_id);
    cerrarLoadingModal();

    $("#modal_editar_autores").modal("show");
  });

  $(document).on("click", ".btn_ver_autores", function () {
    abrirLoadingModal();
    let autores_nombre = $(this).attr("data-autores_nombre");
    let autores_descripcion = $(this).attr("data-autores_descripcion");
    let autores_imagen = $(this).attr("data-autores_imagen");
    let autores_estado = $(this).attr("data-autores_estado");

    $(".view_nombre_autor").html(autores_nombre);
    $(".view_descripcion_autor").html(autores_descripcion);

    estado = "Inactivo";
    color = "danger";
    if (autores_estado == 1) {
      estado = "Activo";
      color = "success";
    }
    $(".view_estado_autor").html(
      `<span class="badge fs-10 bg-${color}-soft text-${color}">${estado}</span>`
    );
    $(".view_image").attr(
      "src",
      base_url + `Assets/images/autores/${autores_imagen}`
    );
    cerrarLoadingModal();

    $("#modal_ver_autores").modal("show");
  });
}

function agregarAutores() {
  $("#form_autores").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_autores");
    const formData = new FormData(form);

    const request = axios.post("agregarAutores", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaAutores.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_autores").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarAutores() {
  $("#form_autores_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let autores_id = $(this).attr("data-autores_id");
    let form = document.getElementById("form_autores_editar");
    const formData = new FormData(form);
    formData.append("autores_id", autores_id);

    const request = axios.post("editarAutores", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaAutores.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_autores").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarAutores() {
  $(document).on("click", ".btn_eliminar_autores", function () {
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
        let autores_id = $(this).attr("data-autores_id");
        const formData = new FormData();
        formData.append("autores_id", autores_id);

        const request = axios.post("eliminarAutores", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaAutores.ajax.reload(() => cerrarLoadingModal());
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
