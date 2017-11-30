<?php
  class MTipo_Instituicao_Laboral extends CI_Model{
      
      function mread(){
          $this->db->select('Tipo_Instituicao_Laboral.id,Tipo_Instituicao_Laboral.tilNome');
          $this->db->from('Tipo_Instituicao_Laboral');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            if($row->id != 1){
                $data[] = array(
                    "id" => $row->id,
                    "tilNome" => $row->tilNome,
                    "value" => $row->tilNome
                );
            }
        }
        return $data;
      }
      
      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Tipo_Instituicao_Laboral');
          $this->db->where('Tipo_Instituicao_Laboral.tilNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCandidato_id($id){
          $this->db->select('Tipo_Instituicao_Laboral_id');
          $this->db->from('Dados_Laborais');
          $this->db->where('Dados_Laborais.Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Tipo_Instituicao_Laboral_id;
          }
      }
      /*
      function mGetIDXCodigo($Codigo){
          $this->db->select('Periodos.id');
          $this->db->from('Periodos');
          $this->db->where('Periodos.pCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Periodos.id');
          $this->db->from('Periodos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('pNome' => $Nome,'pCodigo' => $Codigo);
            if($this->db->update('Periodos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Periodos', array('pNome' => $Nome,'pCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Periodos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
     */      
  }
