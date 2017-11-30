<?php
  class MRegime extends CI_Model{
      
      //var $id = '';
      //var $gfNome = '';
      //var $gfCodigo = '';
      //var $Provincias_id = '';
      
      function mread(){
          $this->db->select('sessao.id,sessao.sesNome,sessao.sesCodigo');
          $this->db->from('sessao');
          //$this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('sessao.id');
          $this->db->from('sessao');
          $this->db->where('sessao.sesNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('sessao.id');
          $this->db->from('sessao');
          $this->db->where('sessao.sesCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('sessao.id,sessao.sesNome,sessao.sesCodigo');
          $this->db->from('sessao');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('sesNome' => $Nome,'sesCodigo' => $Codigo);
            if($this->db->update('sessao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('sessao', array('sesNome' => $Nome,'sesCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('sessao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
