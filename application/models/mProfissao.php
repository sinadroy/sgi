<?php
  class MProfissao extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Profissao.id,Profissao.proNome,Profissao.proCodigo');
          $this->db->from('Profissao');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            if($row->id != 1){
                $data[] = array(
                    "ord" => $ord,
                    "id" => $row->id,
                    "proNome" => $row->proNome,
                    "value" => $row->proNome,
                    "proCodigo" => $row->proCodigo
                );
                $ord++;
            }
        }
        return $data;
      }
      
      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Profissao');
          $this->db->where('Profissao.proNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCandidato_id($id){
          $this->db->select('Profissao_id');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Profissao_id;
          }
      }
      
      function mupdate($id,$proNome,$proCodigo){
            $dados = array('proNome' => $proNome,'proCodigo' => $proCodigo);
            if($this->db->update('Profissao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Profissao', array('proNome' => $Nome,'proCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Profissao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }     
  }
