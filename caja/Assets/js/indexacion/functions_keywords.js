var listaKeywords;

$(document).ready(function () {
  cargarListaKeywords();
  openModal();
  agregarKeywords();
  editarKeywords();
  eliminarKeywords();
});

function cargarListaKeywords() {
  listaKeywords = $("#tb_keywords").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectKeywords",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "keywords_nombre" },
      { data: "keywords_descripcion" },
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
        class: "col-2 text-center",
        targets: 3,
      }
    ]
  });
}

function openModal() {
  $(".btn_agregar_keywords").click(function () {
    $("#modal_agregar_keywords").modal("show");
  });

  $(document).on('click', '.btn_editar_keyword', function () {
    abrirLoadingModal();
    let keywords_id = $(this).attr("data-keywords_id");
    let keywords_nombre = $(this).attr("data-keywords_nombre");
    let keywords_descripcion = $(this).attr("data-keywords_descripcion");

    $("#keywords_palabra_edit").val(keywords_nombre);
    $("#keywords_descripcion_edit").val(keywords_descripcion);
    $("#form_keywords_editar").attr("data-keywords_id", keywords_id);
    cerrarLoadingModal();

    $("#modal_editar_keywords").modal("show");
  });

  $(document).on('click', '.btn_ver_keyword', function () {
    abrirLoadingModal();
    let keywords_nombre = $(this).attr("data-keywords_nombre");
    let keywords_descripcion = $(this).attr("data-keywords_descripcion");

    $("#keywords_palabra_view").val(keywords_nombre);
    $("#keywords_descripcion_view").val(keywords_descripcion);
    cerrarLoadingModal();

    $("#modal_ver_keywords").modal("show");
  });
}

function agregarKeywords() {
  $("#form_keywords").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_keywords");
    const formData = new FormData(form);

    const request = axios.post("agregarKeywords", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaKeywords.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_keywords").modal("hide");
      }else{
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarKeywords() {
  $("#form_keywords_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let keywords_id = $(this).attr("data-keywords_id");
    let form = document.getElementById("form_keywords_editar");
    const formData = new FormData(form);
    formData.append("keywords_id", keywords_id);

    const request = axios.post("editarKeywords", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaKeywords.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_keywords").modal("hide");
      }else{
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarKeywords() {
  $(document).on('click', '.btn_eliminar_keyword', function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar la palabra clave, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let keywords_id = $(this).attr("data-keywords_id");
        const formData = new FormData();
        formData.append("keywords_id", keywords_id);

        const request = axios.post("eliminarKeywords", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaKeywords.ajax.reload(() => cerrarLoadingModal());
          }else{
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
