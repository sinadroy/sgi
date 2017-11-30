<?php
  class MFuncionarios_CB extends CI_Model{
    var $bc;
    public function criarCB($cb)
    {
        $this->load->library('bcgen');
        //date_default_timezone_set('UTC');
        $this->bcgen = new BarcodeGeneratorPNG();
        return $this->bcgen->getBarcode($cb, "C128"); //081231723897
    }    
  }
