<?php
  class MOrganismos_Tutela extends CI_Model{
      
      function mread(){
          $this->db->select('Organismos_Tutela.id,Organismos_Tutela.otNome,Organismos_Tutela.otCodigo');
          $this->db->from('Organismos_Tutela');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "otNome" => $row->otNome,
                        "value" => $row->otNome,
                        "otCodigo" => $row->otCodigo
                    );
                    $ord++;
                }
            }
            return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Organismos_Tutela');
          $this->db->where('Organismos_Tutela.otNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCandidato_id($id){
          $this->db->select('Organismos_Tutela_id');
          $this->db->from('Dados_Laborais');
          $this->db->where('Dados_Laborais.Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Organismos_Tutela_id;
          }
      }
      function mupdate($id,$otNome,$otCodigo){
            $dados = array('otNome'=>$otNome,'otCodigo'=>$otCodigo);
            if($this->db->update('Organismos_Tutela', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($otNome,$otCodigo){
        if($this->db->insert('Organismos_Tutela', array('otNome'=>$otNome,'otCodigo'=>$otCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Organismos_Tutela', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
