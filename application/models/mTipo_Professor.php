<?php
  class MTipo_Professor extends CI_Model{
      
      function mread(){
          $this->db->select('Tipo_Professor.id,Tipo_Professor.tpNome,Tipo_Professor.tpCodigo');
          $this->db->from('Tipo_Professor');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Tipo_Professor.id');
          $this->db->from('Tipo_Professor');
          $this->db->where('Tipo_Professor.tpNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Tipo_Professor.id');
          $this->db->from('Tipo_Professor');
          $this->db->where('Tipo_Professor.tpCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Tipo_Professor.id');
          $this->db->from('Tipo_Professor');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('tpNome' => $Nome,'tpCodigo' => $Codigo);
            if($this->db->update('Tipo_Professor', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Tipo_Professor', array('tpNome' => $Nome,'tpCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Tipo_Professor', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
}
