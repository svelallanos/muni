var idSeleccionado = '';

$(document).ready(function () {
    marcarConcepto();
});

function marcarConcepto() {
    $('.btnConcepto').click(function () {
        let id = $(this).attr('data-id');

        if (idSeleccionado != '') {
            $('#concepto_'+idSeleccionado).removeAttr('class');
        }

        idSeleccionado = id;
        $('#concepto_' + id).addClass('marcar_concepto');
    });
}