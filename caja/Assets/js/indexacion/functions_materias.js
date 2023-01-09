var listaMaterias;

$(document).ready(function () {
  cargarListaMaterias();
  openModal();
  agregarMaterias();
  editarMaterias();
  eliminarMaterias();
});

function cargarListaMaterias() {
  listaMaterias = $("#tb_materias").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: languajeDefault,
    ajax: {
      url: "selectMaterias",
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
        class: "col-9",
        targets: 1,
      },
      {
        class: "col-2",
        targets: 2,
      }
    ]
  });
}

function openModal() {
  $(".btn_agregar_materias").click(function () {
    $("#modal_agregar_materias").modal("show");
  });

  $(document).on('click', '.btn_editar_materia', function () {
    abrirLoadingModal();
    let materias_id = $(this).attr("data-materias_id");
    let materias_nombre = $(this).attr("data-materias_nombre");

    $("#materia_edit").val(materias_nombre);
    $("#form_materia_editar").attr("data-materias_id", materias_id);
    cerrarLoadingModal();

    $("#modal_editar_materia").modal("show");
  });
}

function agregarMaterias() {
  $("#form_materia").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_materia");
    const formData = new FormData(form);

    const request = axios.post("agregarMaterias", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        form.reset();
        listaMaterias.ajax.reload(() => cerrarLoadingModal());
        $("#modal_agregar_materias").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarMaterias() {
  $("#form_materia_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let materias_id = $(this).attr("data-materias_id");
    let form = document.getElementById("form_materia_editar");
    const formData = new FormData(form);
    formData.append("materias_id", materias_id);

    const request = axios.post("editarMaterias", formData);

    request.then((res) => {
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        listaMaterias.ajax.reload(() => cerrarLoadingModal());
        $("#modal_editar_materia").modal("hide");
      } else {
        cerrarLoadingModal();
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarMaterias() {
  $(document).on('click', '.btn_eliminar_materia', function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar la materia, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        abrirLoadingModal();
        let materias_id = $(this).attr("data-materias_id");
        const formData = new FormData();
        formData.append("materias_id", materias_id);

        const request = axios.post("eliminarMaterias", formData);

        request.then((res) => {
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            listaMaterias.ajax.reload(() => cerrarLoadingModal());
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
