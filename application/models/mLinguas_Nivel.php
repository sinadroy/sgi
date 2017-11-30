<?php
  class MLinguas_Nivel extends CI_Model{
      
      function mread(){
          $this->db->select('Linguas_Nivel.id,Linguas_Nivel.lnNome');
          $this->db->from('Linguas_Nivel');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Linguas_Nivel.id');
          $this->db->from('Linguas_Nivel');
          $this->db->where('Linguas_Nivel.lnNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Linguas_Nivel.id');
          $this->db->from('Linguas_Nivel');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$linNome){
            $dados = array('lnNome'=>$linNome);
            if($this->db->update('Linguas_Nivel', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($lnNome){
        if($this->db->insert('Linguas_Nivel', array('lnNome'=>$linNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Linguas_Nivel', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
