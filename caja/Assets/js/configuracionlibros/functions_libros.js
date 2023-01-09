var listaLibros;
var imgSeleccionada = 1;

$(document).ready(function () {
  cargarListaLibros();
  actualizarFoto();
  openModal();
  agregarLibro();
  editarLibro();
  eliminarAutores();
});

function cargarListaLibros() {
  listaLibros = $("#tb_libros").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectLibros",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "libro_imagen" },
      { data: "libro_titulo" },
      { data: "tipo_libro" },
      { data: "libro_estado" },
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
        class: "col-5",
        targets: 2,
      },
      {
        class: "col-2 text-center",
        targets: 3,
      },
      {
        class: "col-1 text-center",
        targets: 4,
      },
      {
        class: "col-2 text-center",
        targets: 5,
      },
    ],
  });
}

function actualizarFoto() {
  $(".cargar_imagen_libro").click(function () {
    $("#libro_imagen_form").click();
  });

  $("#libro_imagen_form").change(function () {
    if (imgSeleccionada == 0) {
      $("#libro_imagen_form").val("");
      return false;
    }

    $(".cargar_imagen_libro").attr("disabled", true);
    $(".container_loader").removeClass("hide");
    $(".container_loader").addClass("show");

    iconLoader(".container_loader", "show");

    let inputFile = $("#libro_imagen_form");
    if (inputFile.val() === "") {
      console.log("sin foto");
      return;
    }

    let libro_id = $("#form_editar_libro").attr("data-libro_id");
    let formData = new FormData();
    let files = inputFile[0].files[0];
    $("#libro_imagen_form").val("");

    formData.append("fileprofile", files);
    formData.append("libro_id", libro_id);

    var request = axios.post("updateFotoPefilLibro", formData);

    request.then((res) => {
      if (res.data.status) {
        msgFlash("mensaje_file", res.data.msg, res.data.value, 5000);
        $("#libro_imagen").attr(
          "src",
          base_url + `Assets/images/libros/${res.data.name_foto}`
        );
      } else {
        msgFlash("mensaje_file", res.data.msg, res.data.value, 5000);
        if (res.data.name_foto != null) {
          $("#libro_imagen").attr(
            "src",
            base_url + `Assets/images/libros/${res.data.name_foto}`
          );
        }
      }

      iconLoader(".container_loader", "hide");
      $(".cargar_imagen_libro").attr("disabled", false);
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
}

function agregarLibro() {
  $("#form_agregar_libro").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_agregar_libro");
    const formData = new FormData(form);

    const request = axios.post("agregarLibro", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
      }
      cerrarLoadingModal();
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarLibro() {
  $("#form_editar_libro").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let libro_id = $(this).attr("data-libro_id");
    let form = document.getElementById("form_editar_libro");
    const formData = new FormData(form);
    formData.append("libro_id", libro_id);

    const request = axios.post("editarLibro", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      cerrarLoadingModal();
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
            listaLibros.ajax.reload(() => cerrarLoadingModal());
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
