<?php
  class MBolsa_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Bolsa_Funcionarios.id,Bolsa_Funcionarios.bolNome');
          $this->db->from('Bolsa_Funcionarios');
          $consulta = $this->db->get();
          return $consulta->result();
      } 
      function mGetID($Nome){
          $this->db->select('Bolsa_Funcionarios.id');
          $this->db->from('Bolsa_Funcionarios');
          $this->db->where('Bolsa_Funcionarios.bolNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
  }
