<?php
  class MTrabalhador extends CI_Model{
      
      function mread(){
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
      function mGetIDXCandidato_id($id){
          $this->db->select('Trabalhador_id');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Trabalhador_id;
          }
      }
          
  }
