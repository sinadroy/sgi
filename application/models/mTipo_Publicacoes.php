<?php
  class MTipo_Publicacoes extends CI_Model{
      
      function mread(){
          $this->db->select('Tipo_Publicacoes.id,Tipo_Publicacoes.tpubNome');
          $this->db->from('Tipo_Publicacoes');
          $consulta = $this->db->get();
          return $consulta->result();
      } 
      function mGetID($Nome){
          $this->db->select('Tipo_Publicacoes.id');
          $this->db->from('Tipo_Publicacoes');
          $this->db->where('Tipo_Publicacoes.tpubNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
  }
