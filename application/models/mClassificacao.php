<?php
  class MClassificacao extends CI_Model{
      
      function mread(){
          $this->db->select('Classificacao.id,Classificacao.clNome,Classificacao.clCodigo,
              Classificacao.clPercentagem,Classificacao.clObservacao');
          $this->db->from('Classificacao');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Classificacao.id');
          $this->db->from('Classificacao');
          $this->db->where('Classificacao.clNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Classificacao.id');
          $this->db->from('Classificacao');
          $this->db->where('Classificacao.clCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Classificacao.id');
          $this->db->from('Classificacao');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo,$Percentagem,$Observacao){
            $dados = array('clNome' => $Nome,'clCodigo' => $Codigo,'clPercentagem'=> $Percentagem,
                'clObservacao'=>$Observacao);
            if($this->db->update('Classificacao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo,$Percentagem,$Observacao){
        if($this->db->insert('Classificacao', array('clNome' => $Nome,'clCodigo' => $Codigo,'clPercentagem'=> $Percentagem,
                'clObservacao'=>$Observacao)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Classificacao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
