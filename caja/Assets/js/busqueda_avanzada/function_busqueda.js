$(document).ready(function () {
  buscarConcepto();
});

function buscarConcepto() {
  $("#form_busqueda_avanzada").submit(function (e) {
    e.preventDefault();
    $('.__generar_reporte').addClass('d-none');
    let texto = $("#texto").val();
    if (texto == "" || texto == null) {
      msgFlash(
        "mensaje_buscador",
        "Ingrese el concepto a buscar",
        "warning",
        5000
      );
      return;
    }

    let form = document.getElementById("form_busqueda_avanzada");
    const formData = new FormData(form);

    formData.append("texto", texto);

    abrirLoadingModal();
    const request = axios.post("buscarconcepto", formData);

    request.then((res) => {
      cerrarLoadingModal();
      console.log(res.data);
      if (res.data.status) {
        let htmlTitulos = `<h1 class="text-decoration-underline text-indigo text-center fw-700 mb-2">CONCEPTOS RELACIONADOS</h1>`;
        let conceptos = ``;
        let contRes = 0;
        res.data.data.forEach((element) => {
          conceptos += `<div class="col-md-12 d-flex flex-column mb-2 lift p-3">
                          <div class="ver_libro d-flex justify-content-between">
                            <label class="fw-bold text-primary">${element.libro.libro_titulo}</label>
                            <a target="_blank" href="${base_url}BusquedaInteligente/verBook?libro_id=${element.libro.libro_id}&concepto_id=${element.concepto_id}&ter_asociado=${element.ter_asociado}" data-bs-toggle="tooltip" data-bs-placement="left" title="Clic aquí para ver en el libro" class="btn btn-teal btn-sm"><i class="feather-eye"></i>&nbsp Ver libro</a>
                          </div>
                          <label class="text-black fw-bold">${element.ter_asociado}</label>
                          <p style="text-align: justify;" class="box-concepto m-0">
                            ${element.concepto}
                          </p>
                        </div>`;
          contRes = contRes + 1;
        });
        htmlTitulos += `<label class="mb-3"><span class="fw-bold text-pink">${contRes}</span> resultados.</label>`;

        htmlTitulos += conceptos;

        $('.__generar_reporte').attr('href', base_url+'BusquedaInteligente/reporte?texto='+texto);
        $('.__generar_reporte').removeClass('d-none');
        $(".box_resultado").html(htmlTitulos);
      } else {
        $(".box_resultado").html(`<label>${res.data.msg}.</label>`);
      }
    });

    request.catch((error) => {
      console.log(error);
    });
  });
}
