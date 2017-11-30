<?php
  class MDados_Laborais extends CI_Model{
      
    /*  function mread(){
          $this->db->select('Trabalhador.id,Trabalhador.trabNome');
          $this->db->from('Trabalhador');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "trabNome" => $row->trabNome,
                "value" => $row->trabNome
            );
        }
        return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Trabalhador');
          $this->db->where('Trabalhador.trabNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      */
      function mGet_ltXCandidato_id($id){
          $this->db->select('dlLocal_Trabalho');
          $this->db->from('Dados_Laborais');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dlLocal_Trabalho;
          }
      }

      function mGet_cargoXCandidato_id($id){
          $this->db->select('dlCargo');
          $this->db->from('Dados_Laborais');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dlCargo;
          }
      }
          
  }
