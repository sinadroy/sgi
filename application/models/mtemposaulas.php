<?php
  class Mtemposaulas extends CI_Model{
      
      //var $id = '';
      var $cfNome = '';
      var $cfCodigo = '';
      var $Grupos_Funcionarios_id = '';
      
      function mread(){
          $this->db->select('temposaulas.id,temposaulas.taNome,temposaulas.taCodigo,temposaulas.taHoraInicio,
                  temposaulas.taHoraFim,temposaulas.sessao_id,sessao.sesNome');
          $this->db->from('temposaulas');
          $this->db->join('sessao', 'temposaulas.sessao_id = sessao.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Codigo){
          $this->db->select('temposaulas.id');
          $this->db->from('temposaulas');
          $this->db->where('temposaulas.taNome', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('temposaulas.id');
          $this->db->from('temposaulas');
        return $this->db->count_all_results();
      }
      function mupdate($id,$taNome,$taCodigo,$taHoraInicio,$taHoraFim,$sessao_id){
            $dados = array('taNome' => $taNome,'taCodigo' => $taCodigo,'taHoraInicio'=>$taHoraInicio
                    ,'taHoraFim'=>$taHoraFim,'sessao_id' => $sessao_id);
            if($this->db->update('temposaulas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($taNome,$taCodigo,$taHoraInicio,$taHoraFim,$sessao_id){
        if($this->db->insert('temposaulas', array('taNome' => $taNome,'taCodigo' => $taCodigo,
            'taHoraInicio'=>$taHoraInicio,'taHoraFim'=>$taHoraFim,'sessao_id' => $sessao_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('temposaulas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
