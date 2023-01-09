$(document).ready(function () {
  $("#form_login").submit(function (e) {
    e.preventDefault();

    let form = document.getElementById("form_login");
    const formData = new FormData(form);

    let strUsuario = document.querySelector("#nombre_usuario").value.trim();
    let strPassword = document.querySelector("#pass_usuario").value.trim();

    if (strUsuario == "" || strPassword == "") {
      Swal.fire("FALTA DATOS", "Ingrese usuario y contraseña.", "warning");
      return;
    }

    abrirLoadingModal();
    const request = axios.post("Login/validarLogin", formData);

    request.then((res) => {
      console.log(res.data);
      if (res.data.status) {
        location.reload();
      } else {
        cerrarLoadingModal();
        if(res.data.alert){
          res.data.motivoBloqueo.forEach(element => {
            console.log(element);
          });
        }else{
          $('#modal_login').modal('show');
        }
      }
    });

    request.catch(error => {
      console.log(error);
    });
  });
});
