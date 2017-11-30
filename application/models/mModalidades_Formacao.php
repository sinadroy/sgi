<?php
  class MModalidades_Formacao extends CI_Model{
      
      
      function mread(){
          $this->db->select('Modalidades_Formacao.id,Modalidades_Formacao.mfNome,Modalidades_Formacao.mfCodigo');
          $this->db->from('Modalidades_Formacao');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Modalidades_Formacao.id');
          $this->db->from('Modalidades_Formacao');
          $this->db->where('Modalidades_Formacao.mfNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      /*
      public function total(){
        $this->db->select('Ferias.id');
          $this->db->from('Ferias');
        return $this->db->count_all_results();
      }
       */
      function mupdate($id,$mfNome,$mfCodigo){
            $dados = array('mfNome' => $mfNome,'mfCodigo' => $mfCodigo);
            if($this->db->update('Modalidades_Formacao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($mfNome,$mfCodigo){
        if($this->db->insert('Modalidades_Formacao', array('mfNome'=>$mfNome,'mfCodigo'=>$mfCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Modalidades_Formacao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
