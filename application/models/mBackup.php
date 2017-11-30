<?php
  class MBackup extends CI_Model{
      
      function mread(){
          $this->db->select('id,bNome,data,hora');
          $this->db->from('Backup');
          //$this->db->join('Municipios', 'Bairros.Municipios_id = Municipios.id');
          $this->db->order_by('data,hora','DESC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('id');
          $this->db->from('Backup');
        return $this->db->count_all_results();
      }
      
      function minsert($bNome,$data,$hora){
        if($this->db->insert('Backup', array('bNome' => $bNome,'data' => $data,'hora' => $hora)))
        {
            return true;
        }else{
            return false;
        }
           
     }
     function mdelete($id) {
        if($this->db->delete('Backup', array('id' => $id)))  
            return true;
        else
            return false;
        
     }       
  }
?>
