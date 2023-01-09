<?php

require_once PATH_MODELS . 'UsuariosModel.php';
class Login extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    if (parent::verificarLogin()) {
      header('Location: ' . base_url() . 'Inicio');
      die;
    }

    $data['page_id'] = 1;
    $data['page_tag'] = "MDESV - Sistema Caja";
    $data['page_title'] = ":. Login - Sistema Caja";
    $data['page_name'] = "MDESV Sistema Caja";
    $data['page_css'] = "login/login";
    $data['page_function_js'] = "login/functions_login";
    $this->views->getView($this, "login", $data);
  }

  public function validarLogin()
  {
    $return = array(
      'status' => false,
      'title' => 'ERROR DE SESIÓN',
      'msg' => 'Error al momento de iniciar sesion en biblioteca.',
      'value' => 'error',
      'alert' => false
    );

    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST) || !isset($_POST['nombre_usuario']) || empty($_POST['nombre_usuario']) || !isset($_POST['pass_usuario']) || empty($_POST['pass_usuario'])) {
      runPageNofound();
    }

    if (parent::verificarLogin()) {
      $return['status'] = true;
      json($return);
    }

    $strUsuario = trim($_POST['nombre_usuario']);
    $strPassword = $_POST['pass_usuario'];

    if ($strUsuario == '' || $strPassword == '') {
      $return['status'] = false;
      $return['title'] = 'FALTA DATOS';
      $return['msg'] = 'Ingrese usuario y contraseña';
      $return['value'] = 'warning';
      json($return);
    }

    $usuarios = new UsuariosModel();

    // VERIFICAMOS QUE EXISTA EL USUARIO Y EL PASSWORD INGRESADO SEA CORRECTO EN BIBLIOTECA
    $seleccionar_usuario = $usuarios->selectUsuarioLogin($strUsuario);
    if ($seleccionar_usuario && password_verify($strPassword, $seleccionar_usuario['usuarios_password'])) {

      $bloqueado = $usuarios->selectMotivoUsuarioById($seleccionar_usuario['usuarios_id']);
      if (!empty($bloqueado)) {
        $return['alert'] = true;
        $return['motivoBloqueo'] = $bloqueado;
        json($return);
      }

      $_SESSION['biblioteca']['usuario_login'] = $seleccionar_usuario['usuarios_login'];
      $_SESSION['biblioteca']['usuario_dni'] = $seleccionar_usuario['usuarios_dni'];
      $_SESSION['biblioteca']['usuarios_nombres'] = $seleccionar_usuario['usuarios_nombres'];
      $_SESSION['biblioteca']['usuarios_paterno'] = $seleccionar_usuario['usuarios_paterno'];
      $_SESSION['biblioteca']['usuarios_materno'] = $seleccionar_usuario['usuarios_materno'];
      $_SESSION['biblioteca']['usuarios_email'] = $seleccionar_usuario['usuarios_email'];
      $_SESSION['biblioteca']['usuarios_foto'] = $seleccionar_usuario['usuarios_foto'];
      $_SESSION['biblioteca']['usuario_id'] = $seleccionar_usuario['usuarios_id'];
      $_SESSION['biblioteca']['roles'] = array();
      $_SESSION['biblioteca']['usuarios_intranet'] = false;
      $_SESSION['biblioteca']['login_biblioteca'] = true;
      $_SESSION['biblioteca']['update_pass'] = $seleccionar_usuario['usuarios_updatepassword'];

      $roles = $usuarios->getRoles($seleccionar_usuario['usuarios_id']);
      foreach ($roles as $key => $value) {
        array_push($_SESSION['biblioteca']['roles'], $value['roles_nombre']);
      }

      $return['status'] = true;
      json($return);
    }

    // VERIFICAMOS QUE EXISTA EL USUARIO Y EL PASSWORD INGRESADO SEA CORRECTO EN INTRANET
    $seleccionar_usuario = $usuarios->selectUsuarioIntranet($strUsuario);
    if ($seleccionar_usuario && password_verify($strPassword, $seleccionar_usuario['usuarios_password'])) {
      $bloqueado = $usuarios->selectMotivoUsuarioIntranetById($seleccionar_usuario['usuarios_id']);
      if (!empty($bloqueado)) {
        $return['alert'] = true;
        $return['motivoBloqueo'] = $bloqueado;
        json($return);
      }

      $_SESSION['biblioteca']['usuario_login'] = $seleccionar_usuario['usuarios_dni'];
      $_SESSION['biblioteca']['usuario_dni'] = $seleccionar_usuario['usuarios_dni'];
      $_SESSION['biblioteca']['usuarios_nombres'] = $seleccionar_usuario['usuarios_nombres'];
      $_SESSION['biblioteca']['usuarios_paterno'] = $seleccionar_usuario['usuarios_paterno'];
      $_SESSION['biblioteca']['usuarios_materno'] = $seleccionar_usuario['usuarios_materno'];
      $_SESSION['biblioteca']['usuarios_email'] = 'sincorreo@gmail.com';
      $_SESSION['biblioteca']['usuarios_foto'] = 'sin_foto.png';
      $_SESSION['biblioteca']['usuario_id'] = $seleccionar_usuario['usuarios_id'];
      $_SESSION['biblioteca']['roles'] = array('Usuario intranet');
      $_SESSION['biblioteca']['usuarios_intranet'] = true;
      $_SESSION['biblioteca']['login_biblioteca'] = true;
      $_SESSION['biblioteca']['update_pass'] = $seleccionar_usuario['usuarios_updatepassword'];

      $return['status'] = true;
      json($return);
    }

    $return['title'] = 'ERROR DE SESIÓN';
    $return['msg'] = 'Usuario o la contraseña es incorrecta.';
    $return['value'] = 'error';

    json($return);
  }
}
