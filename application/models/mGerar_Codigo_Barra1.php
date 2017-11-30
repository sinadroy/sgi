<?php
  class MGerar_Codigo_Barra1 extends CI_Model{
    var $bc;
    public function criarCB($cb)
    {
        $this->load->library('bcgen1');
        //date_default_timezone_set('UTC');
        $this->bcgen = new BarcodeGeneratorHTML();
        return $this->bcgen->getBarcode($cb, "C128"); //081231723897
    }
  }
