<?php
  class MLinguas extends CI_Model{
      
      function mread(){
          $this->db->select('Linguas.id,Linguas.linNome');
          $this->db->from('Linguas');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Linguas.id');
          $this->db->from('Linguas');
          $this->db->where('Linguas.linNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Linguas.id');
          $this->db->from('Linguas');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$linNome){
            $dados = array('linNome'=>$linNome);
            if($this->db->update('Linguas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($linNome){
        if($this->db->insert('Linguas', array('linNome'=>$linNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Linguas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
