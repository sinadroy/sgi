<?php
  class MAnos_Lectivos extends CI_Model{
      
      function mread(){
          $this->db->select('anos_lectivos.id,anos_lectivos.alAno');
          $this->db->from('anos_lectivos');
          $this->db->order_by('alAno','DESC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadX($id){
          $this->db->select('anos_lectivos.alAno');
          $this->db->from('anos_lectivos');
          $this->db->where('anos_lectivos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->alAno;
          }
      }
      function mGetID($Nome){
          $this->db->select('anos_lectivos.id');
          $this->db->from('anos_lectivos');
          $this->db->where('anos_lectivos.alAno', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      public function total(){
        $this->db->select('anos_lectivos.id');
          $this->db->from('anos_lectivos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$alAno){
            $dados = array('alAno' => $alAno);
            if($this->db->update('anos_lectivos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($alAno){
        if($this->db->insert('anos_lectivos', array('alAno' => $alAno)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('anos_lectivos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
