<?php
  class Mdisciplinas_geracao extends CI_Model{
      
      function mread(){
          $this->db->select('d_geracao.id,d_geracao.dgnome,d_geracao.dgano_inicio,d_geracao.dgano_fin');
          $this->db->from('d_geracao');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('d_geracao.id');
          $this->db->from('d_geracao');
          $this->db->where('d_geracao.dgnome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetNomeXid($id){
          $this->db->select('d_geracao.dgnome');
          $this->db->from('d_geracao');
          $this->db->where('d_geracao.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dgnome;
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
      //geracao de una disc por el codigo
      function mGetGeracao_DisciplinaXcodigo($codigo){
          $this->db->select('d_geracao.id');
          $this->db->from('d_geracao');
          $this->db->join('Disciplinas', 'Disciplinas.d_geracao_id = d_geracao.id');
          $this->db->where('Disciplinas.dCodigo', $codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('d_geracao.id');
          $this->db->from('d_geracao');
        return $this->db->count_all_results();
      }
      function mGetGeracaoXidd($idd){
          $this->db->select('Disciplinas.d_geracao_id');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->d_geracao_id;
          }
      }
      function mget_dgnome($idd){
          $idg = $this->mGetGeracaoXidd($idd);

          $this->db->select('d_geracao.dgnome');
          $this->db->from('d_geracao');
          $this->db->where('d_geracao.id', $idg);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dgnome;
          }
      }
      function mupdate($id,$dgnome,$dgano_inicio,$dgano_fin){
            $dados = array('dgnome' => $dgnome,'dgano_inicio' => $dgano_inicio,'dgano_fin' => $dgano_fin);
            if($this->db->update('d_geracao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($dgnome,$dgano_inicio,$dgano_fin){
        if($this->db->insert('d_geracao', array('dgnome' => $dgnome,'dgano_inicio' => $dgano_inicio,'dgano_fin' => $dgano_fin)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('d_geracao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
