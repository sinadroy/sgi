<?php
  class MGerar_Codigo_Barra extends CI_Model{
    var $bc;
    public function criarCB($cb)
    {
        $this->load->library('bcgen');
        //date_default_timezone_set('UTC');
        $this->bcgen = new BarcodeGeneratorPNG();
        return $this->bcgen->getBarcode($cb, "C128"); //081231723897

        //teste
        //ver si ya existe un codigo de barra igual

        //
    }
/*
    function mExiste_CB($cb){
          $this->db->select('Candidatos.');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
    }
    */
  }
