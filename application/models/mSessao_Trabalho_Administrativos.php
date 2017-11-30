<?php
  class MSessao_Trabalho_Administrativos extends CI_Model{
      
      function mread(){
          $this->db->select('Sessao_Trabalho_Administrativos.id,Sessao_Trabalho_Administrativos.stNome,Sessao_Trabalho_Administrativos.stCodigo');
          $this->db->from('Sessao_Trabalho_Administrativos');
          
          $consulta = $this->db->get();
          //$data = array();
          //$consulta->result_array()
          foreach($consulta->result() as $row){
              //$data[] = $row;
              $data[] = array(
                  "id"=>$row->id,
                  "stNome"=>$row->stNome,
                  "value"=>$row->stNome,
                  "stCodigo"=>$row->stCodigo,
              );
          }
        return $data;

          //return $consulta->result();
      }
      /*function mGetID($Nome){
          $this->db->select('Sessao_Trabalho_Administrativos.id');
          $this->db->from('Sessao_Trabalho_Administrativos');
          $this->db->where('Sessao_Trabalho_Administrativos.stNome', $Nome);
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
        $this->db->select('sessao.id');
          $this->db->from('sessao');
        return $this->db->count_all_results();
      }
      //Tiempos de aulas de una session
      public function taXses($idses){
        $this->db->select('temposaulas.id');
        $this->db->from('temposaulas');
        $this->db->where('temposaulas.sessao_id', $idses);
        //return $this->db->count_all_results();
        $consulta = $this->db->get();
        return $consulta->result();
      }*/
      function mupdate($id,$Nome,$Codigo){
            $dados = array('stNome' => $Nome,'stCodigo' => $Codigo);
            if($this->db->update('Sessao_Trabalho_Administrativos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Sessao_Trabalho_Administrativos', array('stNome' => $Nome,'stCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Sessao_Trabalho_Administrativos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
