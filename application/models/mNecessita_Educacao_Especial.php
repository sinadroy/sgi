<?php
  class MNecessita_Educacao_Especial extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('id,neeNome,neeCodigo');
          $this->db->from('Necessita_Educacao_Especial');
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                $data[] = array(
                    "ord" => $ord,
                    "id" => $row->id,
                    "neeNome" => $row->neeNome,
                    "value" => $row->neeNome,
                    "neeCodigo" => $row->neeCodigo,
                );
                $ord++;
            }
            return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Necessita_Educacao_Especial');
          $this->db->where('neeNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }

      function mupdate($id,$neeNome,$neeCodigo){
            $dados = array('neeNome'=>$neeNome,'neeCodigo'=>$neeCodigo);
            if($this->db->update('Necessita_Educacao_Especial', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($neeNome,$neeCodigo){
        if($this->db->insert('Necessita_Educacao_Especial', array('neeNome'=>$neeNome,'neeCodigo'=>$neeCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Necessita_Educacao_Especial', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
          
  }
