<?php
require_once(PATH_MODELS . "UsuariosModel.php");
require_once(PATH_MODELS . "PermisosModel.php");
require_once(PATH_MODELS . "RolesModel.php");
require_once(PATH_MODELS . "LoginModel.php");

class Controllers
{
  public function __construct($session = true)
  {
    if ($session) {
      session_start();
    }

    $this->views = new Views();
    $this->loadModel();
    $this->isLogin();

    $this->datosUserBiblioteca = $this->defineDatosUserBiblioteca();
    $this->validarUpdatePassword();
    $this->validarUltimoLoad();

    $this->permisosUser = $this->getPermisos();
  }

  public function loadModel()
  {
    $model = get_class($this) . "Model";
    $routClass = "Models/" . $model . ".php";
    if (file_exists($routClass)) {
      require_once($routClass);
      $this->model = new $model();
    }
  }

  public function verificarPermiso(int $idPermiso, bool $redirigir = false)
  {
    if (isset($this->permisosUser[$idPermiso])) {
      return true;
    } else {
      if ($redirigir) {
        location();
      } else {
        return false;
      }
    }
  }

  public function validarUltimoLoad()
  {
    if ($this->isLogin) {
      if (isset($_SESSION['biblioteca']['last_load'])) {
        $now = new DateTime('NOW');
        $lastLoad = $_SESSION['biblioteca']['last_load'];

        $lastLoad->add(new DateInterval('PT' . TIME_SESSION['horas'] . 'H' . TIME_SESSION['minutos'] . 'M'));

        if ($now > $lastLoad) {
          unset($_SESSION['biblioteca']);
          location('login');
        } else {
          $_SESSION['biblioteca']['last_load'] = new DateTime('NOW');
        }
      } else {
        $_SESSION['biblioteca']['last_load'] = new DateTime('NOW');
      }
    }
  }

  public function isLogin()
  {
    if (isset($_SESSION['biblioteca']['login_biblioteca']) && $_SESSION['biblioteca']['login_biblioteca'] == true) {
      $this->isLogin = true;
    } else {
      $this->isLogin = false;

      if (isset($_SESSION)) {
        unset($_SESSION['biblioteca']);
      }
    }
  }

  public function defineDatosUserBiblioteca()
  {
    $datosUserBiblioteca = array(
      'usuarios_nombres' => 'Invitado #2022',
      'usuarios_materno' => '',
      //'usuarios_dni' => '0',
      'usuarios_paterno' => ''
    );

    if ($this->isLogin) {

      $usuarios = new UsuariosModel();
      $sesion_biblioteca  = true;
      if (!$_SESSION['biblioteca']['usuarios_intranet']) {
        $datosUserBiblioteca = $usuarios->selectUsuarioLogin($_SESSION['biblioteca']['usuario_login']);
      } else {
        $datosUserBiblioteca = $usuarios->selectUsuarioIntranet($_SESSION['biblioteca']['usuario_login']);
        $sesion_biblioteca  = false;
      }

      if ($datosUserBiblioteca) {
        // Validar si el usuarios esta bloqueado
        if ($sesion_biblioteca) {
          $bloqueado = $usuarios->selectMotivoUsuarioById($datosUserBiblioteca['usuarios_id']);
        } else {
          $bloqueado = $usuarios->selectMotivoUsuarioIntranetById($datosUserBiblioteca['usuarios_id']);
        }

        if (!empty($bloqueado) || $datosUserBiblioteca['usuarios_estado'] != 1) {
          $this->isLogin = false;
          unset($_SESSION['biblioteca']);
        }
      } else {
        $this->isLogin = false;
        unset($_SESSION['biblioteca']);
      }
    }

    return $datosUserBiblioteca;
  }
  public function validarUpdatePassword()
  {
    if ($this->isLogin) {
      $sessionDate = $_SESSION['biblioteca']['update_pass'];
      $dbDate = $this->datosUserBiblioteca['usuarios_updatepassword'];

      if ($sessionDate != $dbDate) {
        unset($_SESSION['biblioteca']);
        location('login');
      }
    }
  }

  public function getPermisos()
  {
    if (!$this->isLogin) {
      return array();
    } else {
      $permisosModel = new PermisosModel();
      $array = array();

      if ($_SESSION['biblioteca']['usuarios_intranet']) {
        $permisosIntranet = $permisosModel->getPermisosRolById(4);
        foreach ($permisosIntranet as $key => $value) {
          $array[$value['permiso_id']] = true;
        }
      } else {
        $permisos = $permisosModel->getPermisos($this->datosUserBiblioteca['usuarios_id']);
        $permisosUsuario = $permisosModel->getPermisosUsuario($this->datosUserBiblioteca['usuarios_id']);

        foreach ($permisos as $key => $value) {
          $array[$value['permiso_id']] = true;
        }

        foreach ($permisosUsuario as $key => $value) {
          $array[$value['permiso_id']] = true;
        }
      }

      return $array;
    }
  }

  public function verificarLogin(bool $redirigir = false)
  {
    if ($this->isLogin) {
      return true;
    } else {
      unset($_SESSION['biblioteca']);
      if ($redirigir) {
        location('login');
      } else {
        return false;
      }
    }
  }
}
