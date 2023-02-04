<?php

class Categorias extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }

  public function categorias()
  {
    parent::verificarLogin(true);

    $data['page_id'] = 34;
    $data['page_tag'] = "MDESV - Sistema Caja";
    $data['page_title'] = ":. Categorias - Sistema Caja";
    $data['page_name'] = "MDESV Sistema Caja";
    // $data['page_css'] = "inicio/inicio";

    $this->views->getView($this, "categorias", $data);
  }
}