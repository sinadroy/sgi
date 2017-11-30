<?php
  class Mtipo_aulas extends CI_Model{
      
      function mread(){
          $this->db->select('id,tanome');
          $this->db->from('tipo_aulas');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "tanome" => $row->tanome,
                        "value" => $row->tanome,
                        //"mcodigo" => $row->mcodigo
                    );
                    $ord++;
            }
            return $data;
      }

      function mreadXid($id){
          $this->db->select('tanome');
          $this->db->from('tipo_aulas');
          $this->db->where('id', $id);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                return $row->tanome;    
            }
      }

      function mupdate($id,$tanome){
            $dados = array('tanome'=>$tanome);
            if($this->db->update('tipo_aulas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($tanome){
        if($this->db->insert('tipo_aulas', array('tanome'=>$tanome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('tipo_aulas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
