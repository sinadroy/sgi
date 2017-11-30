<?php
  class MTipo_Eventos extends CI_Model{
      
      function mread(){
          $this->db->select('Tipo_Evento.id,Tipo_Evento.teNome');
          $this->db->from('Tipo_Evento');
          $consulta = $this->db->get();
          return $consulta->result();
      } 
      function mGetID($Nome){
          $this->db->select('Tipo_Evento.id');
          $this->db->from('Tipo_Evento');
          $this->db->where('Tipo_Evento.teNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
  }
