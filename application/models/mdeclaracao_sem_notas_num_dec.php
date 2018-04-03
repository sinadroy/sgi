<?php
  class Mdeclaracao_sem_notas_num_dec extends CI_Model{
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread(){
          $this->db->select('num_declaracao');
          $this->db->from('declaracao_sem_notas_num_declaracao');
          $this->db->where('id', 1);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->num_declaracao;
          }
      }
      
      function mupdate($num_declaracao){
            $dadosPaises = array('num_declaracao' => $num_declaracao);
            if($this->db->update('declaracao_sem_notas_num_declaracao', $dadosPaises, array('id' => 1))){
                return true;
            }else
                return false;
      }

      function mread_com_notas(){
        $this->db->select('num_declaracao');
        $this->db->from('declaracao_sem_notas_num_declaracao');
        $this->db->where('id', 2);
        $consulta = $this->db->get();
        foreach($consulta->result() as $value) {
            return $value->num_declaracao;
        }
    }
    
    function mupdate_com_notas($num_declaracao){
          $dadosPaises = array('num_declaracao' => $num_declaracao);
          if($this->db->update('declaracao_sem_notas_num_declaracao', $dadosPaises, array('id' => 2))){
              return true;
          }else
              return false;
    } 
           
  }
?>
