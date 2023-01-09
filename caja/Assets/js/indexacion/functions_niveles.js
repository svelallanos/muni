var listaNiveles;

$(document).ready(function () {
  cargarListaNiveles();
  openModal();
  agregarNiveles();
  editarNiveles();
  eliminarNiveles();
});

function cargarListaNiveles() {
  listaNiveles = $("#tb_niveles").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectNiveles",
      dataSrc: "",
    },
    columns: [
      { data: "numero" },
      { data: "niveles_descripcion" },
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
        class: "col-8",
        targets: 1,
      },
      {
        class: "col-1 text-center",
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
  $(".btn_agregar_niveles").click(function () {
    $("#modal_agregar_niveles").modal("show");
  });

  $(document).on('click', '.btn_editar_niveles', function () {
    abrirLoadingModal();
    let niveles_id = $(this).attr("data-niveles_id");
    let niveles_descripcion = $(this).attr("data-niveles_descripcion");
    let niveles_orden = $(this).attr("data-niveles_orden");

    $("#niveles_nombre_edit").val(niveles_descripcion);
    $("#niveles_orden_edit").val(niveles_orden);
    $("#form_niveles_editar").attr("data-niveles_id", niveles_id);
    cerrarLoadingModal();

    $("#modal_editar_niveles").modal("show");
  });
}

function agregarNiveles() {
  $("#form_niveles").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_niveles");
    const formData = new FormData(form);

    const request = axios.post("agregarNiveles", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaNiveles.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_niveles").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarNiveles() {
  $("#form_niveles_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let niveles_id = $(this).attr("data-niveles_id");
    let form = document.getElementById("form_niveles_editar");
    const formData = new FormData(form);
    formData.append("niveles_id", niveles_id);

    const request = axios.post("editarNiveles", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaNiveles.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_niveles").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarNiveles() {
  $(document).on('click', '.btn_eliminar_niveles', function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar el nivel, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let niveles_id = $(this).attr("data-niveles_id");
        const formData = new FormData();
        formData.append("niveles_id", niveles_id);

        const request = axios.post("eliminarNiveles", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaNiveles.ajax.reload(() => cerrarLoadingModal());
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
