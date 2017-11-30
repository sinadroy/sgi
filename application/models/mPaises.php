<?php
  class MPaises extends CI_Model{
      
      //var $id = '';
      var $paNome = '';
      var $paCodigo = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread(){
          $this->db->select('Pais.id,Pais.paNome,Pais.paCodigo');
          $this->db->from('Pais');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mreadPF(){
          $this->db->select('Pais.id,Pais.paNome as paFormacao,Pais.paCodigo');
          $this->db->from('Pais');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Pais.id');
          $this->db->from('Pais');
          $this->db->where('Pais.paNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($paCodigo){
          $this->db->select('Pais.id');
          $this->db->from('Pais');
          $this->db->where('Pais.paCodigo', $cCodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalPaises(){
        $this->db->select('Pais.id,Pais.paNome,Pais.paCodigo');
          $this->db->from('Pais');
        return $this->db->count_all_results();
      }
      function mupdate($id,$paNome,$paCodigo){
            $dadosPaises = array('paNome' => $paNome,'paCodigo' => $paCodigo);
            if($this->db->update('Pais', $dadosPaises, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($paNome,$paCodigo){
        if($this->db->insert('Pais', array('paNome' => $paNome,'paCodigo' => $paCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Pais', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
