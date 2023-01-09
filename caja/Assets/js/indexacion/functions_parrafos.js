$(document).ready(function () {
  openModal();
  agregarParrafo();
  editarParrafo();
  eliminarParrafo();
});

function openModal() {
  $(".btn_agregar_parrafos").click(function () {
    $("#modal_agregar_parrafos").modal("show");
  });

  $(".btn_editar_parrafo").click(function () {
    abrirLoadingModal();
    let parrafos_descripcion = $(this).attr("data-parrafos_descripcion");
    let parrafos_orden = $(this).attr("data-parrafos_orden");
    let parrafos_id = $(this).attr("data-parrafos_id");

    $("#parrafo_nombre_edit").val(parrafos_descripcion);
    $("#parrafo_orden_edit").val(parrafos_orden);
    $("#form_parrafo_editar").attr("data-parrafos_id", parrafos_id);
    cerrarLoadingModal();

    $("#modal_editar_parrafos").modal("show");
  });
}

function agregarParrafo() {
  $("#form_parrafo").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();

    let form = document.getElementById("form_parrafo");
    const formData = new FormData(form);

    const request = axios.post("agregarParrafos", formData);

    request.then((res) => {
      cerrarLoadingModal();

      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        $("#modal_agregar_parrafos").modal("hide");
        uploadPage("#close_page", true);
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function editarParrafo() {
  $("#form_parrafo_editar").submit(function (e) {
    e.preventDefault();

    abrirLoadingModal();
    let parrafos_id = $(this).attr("data-parrafos_id");
    let form = document.getElementById("form_parrafo_editar");
    const formData = new FormData(form);
    formData.append("parrafos_id", parrafos_id);

    const request = axios.post("editarParrafo", formData);

    request.then((res) => {
      cerrarLoadingModal();
      msgFlash("mensaje", res.data.msg, res.data.value, 5000);
      if (res.data.status) {
        $("#modal_editar_parrafos").modal("hide");
        uploadPage("#close_page", true);
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}

function eliminarParrafo() {
  $(".btn_eliminar_parrafo").click(function () {
    Swal.fire({
      title: "ELIMINAR REGISTRO",
      text: "¿Estas seguro de eliminar el párrafo, no podras revertir esto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ok",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {

        abrirLoadingModal();
        let parrafos_id = $(this).attr("data-parrafos_id");
        const formData = new FormData();
        formData.append("parrafos_id", parrafos_id);

        const request = axios.post("eliminarParrafo", formData);

        request.then((res) => {
          cerrarLoadingModal();
          msgFlash("mensaje", res.data.msg, res.data.value, 5000);
          if (res.data.status) {
            uploadPage("#close_page", true);
          }
        });

        request.catch((error) => {
          console.log(error);
        });
      }
    });
  });
}
