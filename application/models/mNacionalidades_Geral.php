<?php
  class MNacionalidades_Geral extends CI_Model{
      
      function mread(){
          $this->db->select('id,ngNome');
          $this->db->from('Nacionalidades_Geral');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ngNome" => $row->ngNome,
                "value" => $row->ngNome
            );
        }
        return $data;
      }
      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Nacionalidades_Geral');
          $this->db->where('ngNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
          
  }
