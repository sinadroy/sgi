<?php
  class MSemestres extends CI_Model{
      
      function mread(){
          $this->db->select('Semestres.id,Semestres.sNome,Semestres.sDescricao');
          $this->db->from('Semestres');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Semestres.id');
          $this->db->from('Semestres');
          $this->db->where('Semestres.sNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetSem($idd){
          $this->db->select('Semestres.sNome');
          $this->db->from('Semestres');
          $this->db->join('disciplinas_semestres', 'disciplinas_semestres.Semestres_id = Semestres.id');
          $this->db->where('disciplinas_semestres.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->sNome;
          }
      }
      function mGetIdSem($idd){
          $this->db->select('Semestres.id');
          $this->db->from('Semestres');
          $this->db->join('disciplinas_semestres', 'disciplinas_semestres.Semestres_id = Semestres.id');
          $this->db->where('disciplinas_semestres.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
     /* function mGetSemEst($ide, $ids){
          $this->db->select('Estudantes.semestres_id, Estudantes.id');
          $this->db->from('Estudantes');
          $this->db->join('semestres', 'disciplinas_semestres.Semestres_id = Semestres.id');
          $this->db->join('financas_pagamaentos_conf_mat', 'disciplinas_semestres.Semestres_id = Semestres.id');
          $this->db->where('disciplinas_semestres.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->sNome;
          }
      }*/
      function mupdate($id,$Nome,$Descricao){
            $dados = array('sNome' => $Nome,'sDescricao' => $Descricao);
            if($this->db->update('Semestres', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Descricao){
        if($this->db->insert('Semestres', array('sNome' => $Nome,'sDescricao' => $Descricao)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Semestres', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
