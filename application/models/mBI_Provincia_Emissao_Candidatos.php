<?php
  class MBI_Provincia_Emissao_Candidatos extends CI_Model{
      
      function mread(){
          $this->db->select('BI_Provincia_Emissao_Candidatos.id,Provincias.provNome');
          $this->db->from('BI_Provincia_Emissao_Candidatos');
          $this->db->join('Provincias', 'BI_Provincia_Emissao_Candidatos.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "provNome" => $row->provNome,
                "value" => $row->provNome
            );
        }
        return $data;
      }

      function mGetID($Nome){
          $this->db->select('BI_Provincia_Emissao_Candidatos.id,Provincias.provNome');
          $this->db->from('BI_Provincia_Emissao_Candidatos');
          $this->db->join('Provincias', 'BI_Provincia_Emissao_Candidatos.Provincias_id = Provincias.id');
          $this->db->where('Provincias.provNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
          
  }
