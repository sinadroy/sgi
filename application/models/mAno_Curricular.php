<?php
  class MAno_Curricular extends CI_Model{
      
      function mread(){
          $this->db->select('Ano_Curricular.id,Ano_Curricular.acNome,Ano_Curricular.acCodigo');
          $this->db->from('Ano_Curricular');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Ano_Curricular.id');
          $this->db->from('Ano_Curricular');
          $this->db->where('Ano_Curricular.acNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Ano_Curricular.id');
          $this->db->from('Ano_Curricular');
          $this->db->where('Ano_Curricular.acCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Ano_Curricular.id');
          $this->db->from('Ano_Curricular');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('acNome' => $Nome,'acCodigo' => $Codigo);
            if($this->db->update('Ano_Curricular', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Ano_Curricular', array('acNome' => $Nome,'acCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Ano_Curricular', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
