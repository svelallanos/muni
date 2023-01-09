var listaCategorias;

$(document).ready(function () {
  cargarListaCategorias();
  openModal();
  agregarCategorias();
  editarCategorias();
  eliminarCategorias();
});

function cargarListaCategorias() {
  listaCategorias = $("#tb_categorias").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectCategorias",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "categorias_nombre" },
      { data: "categorias_descripcion" },
      { data: "estado" },
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
        targets: 4
      }
    ]
  });
}

function openModal() {
  $(".btn_agregar_categorias").click(function () {
    $("#modal_agregar_categorias").modal("show");
  });

  $(document).on('click', '.btn_editar_categoria', function () {
    abrirLoadingModal();
    let categorias_id = $(this).attr("data-categorias_id");
    let categorias_nombre = $(this).attr("data-categorias_nombre");
    let categorias_descripcion = $(this).attr("data-categorias_descripcion");
    let categorias_estado = $(this).attr("data-categorias_estado");

    $("#categorias_nombre_edit").val(categorias_nombre);
    $("#categorias_descripcion_edit").val(categorias_descripcion);
    $("#categorias_estado_edit").val(categorias_estado);
    $("#form_categorias_editar").attr("data-categorias_id", categorias_id);
    cerrarLoadingModal();

    $("#modal_editar_categorias").modal("show");
  });

  $(document).on('click', '.btn_ver_categoria', function () {
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
}

function agregarCategorias() {
  $("#form_categorias").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_categorias");
    const formData = new FormData(form);

    const request = axios.post("agregarCategorias", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaCategorias.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_categorias").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarCategorias() {
  $("#form_categorias_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let categorias_id = $(this).attr("data-categorias_id");
    let form = document.getElementById("form_categorias_editar");
    const formData = new FormData(form);
    formData.append("categorias_id", categorias_id);

    const request = axios.post("editarCategorias", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaCategorias.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_categorias").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarCategorias() {
  $(document).on('click', '.btn_eliminar_categoria', function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar la categoría, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let categorias_id = $(this).attr("data-categorias_id");
        const formData = new FormData();
        formData.append("categorias_id", categorias_id);

        const request = axios.post("eliminarCategorias", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaCategorias.ajax.reload(() => cerrarLoadingModal());
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
