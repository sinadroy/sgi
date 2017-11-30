<?php
  class MDisciplinas_Duracao extends CI_Model{
      
      function mread(){
          $this->db->select('Disciplinas_Duracao.id,Disciplinas_Duracao.ddNome,Disciplinas_Duracao.ddCodigo');
          $this->db->from('Disciplinas_Duracao');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Disciplinas_Duracao.id');
          $this->db->from('Disciplinas_Duracao');
          $this->db->where('Disciplinas_Duracao.ddNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetDuracao_Disciplina($Nome){
          $this->db->select('Disciplinas_Duracao.ddNome');
          $this->db->from('Disciplinas_Duracao');
          $this->db->join('Disciplinas', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->where('Disciplinas.id', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ddNome;
          }
      }
      function mGetDuracao_DisciplinaXcodigo($dcodigo){
          $this->db->select('Disciplinas_Duracao.ddNome');
          $this->db->from('Disciplinas_Duracao');
          $this->db->join('Disciplinas', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->where('Disciplinas.dCodigo', $dcodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ddNome;
          }
      }
      function mGetDuracao_DisciplinaXid($idd){
          $this->db->select('Disciplinas_Duracao.ddNome');
          $this->db->from('Disciplinas_Duracao');
          $this->db->join('Disciplinas', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->where('Disciplinas.id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ddNome;
          }
      }
      
      function mGetIDXCodigo($Codigo){
          $this->db->select('Disciplinas_Duracao.id');
          $this->db->from('Disciplinas_Duracao');
          $this->db->where('Disciplinas_Duracao.ddCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Disciplinas_Duracao.id');
          $this->db->from('Disciplinas_Duracao');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('ddNome' => $Nome,'ddCodigo' => $Codigo);
            if($this->db->update('Disciplinas_Duracao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Disciplinas_Duracao', array('ddNome' => $Nome,'ddCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Disciplinas_Duracao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
