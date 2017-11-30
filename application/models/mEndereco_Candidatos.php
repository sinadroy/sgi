<?php
  class MEndereco_Candidatos extends CI_Model{
      
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
      function mGet_paisXCandidato_id($id){
          $this->db->select('Pais_id');
          $this->db->from('Endereco_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Pais_id;
          }
      }
      function mGet_provXCandidato_id($id){
          $this->db->select('Provincias_id');
          $this->db->from('Endereco_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Provincias_id;
          }
      }
      function mGet_munXCandidato_id($id){
          $this->db->select('Municipios_id');
          $this->db->from('Endereco_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Municipios_id;
          }
      }
      function mGet_bairroXCandidato_id($id){
          $this->db->select('Bairros_id');
          $this->db->from('Endereco_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Bairros_id;
          }
      }
      
  }
