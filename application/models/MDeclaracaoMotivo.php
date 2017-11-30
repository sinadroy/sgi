<?php
  class MDeclaracaoMotivo extends CI_Model{
      
      function mread(){
          $this->db->select('motivo.id,motivo.mnome,motivo.mcodigo');
          $this->db->from('motivo');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "mnome" => $row->mnome,
                        "value" => $row->mnome,
                        "mcodigo" => $row->mcodigo
                    );
                    $ord++;
            }
            return $data;
      }

      function mreadXid($id){
          $this->db->select('motivo.mnome');
          $this->db->from('motivo');
          $this->db->where('id', $id);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                return $row->mnome;    
            }
      }

      function mupdate($id,$mnome,$mcodigo){
            $dados = array('mnome'=>$mnome,'mcodigo'=>$mcodigo);
            if($this->db->update('motivo', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($mnome,$mcodigo){
        if($this->db->insert('motivo', array('mnome'=>$mnome,'mcodigo'=>$mcodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('motivo', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
