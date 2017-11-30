<?php
  class MOrgao_Provendor_Bolsas extends CI_Model{
      
      
      function mread(){
          $this->db->select('Orgao_Provendor_Bolsas.id,Orgao_Provendor_Bolsas.opbNome,Orgao_Provendor_Bolsas.opbCodigo');
          $this->db->from('Orgao_Provendor_Bolsas');
          //$this->db->join('Funcionarios', 'Ferias.Funcionarios_id = Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Orgao_Provendor_Bolsas.id');
          $this->db->from('Orgao_Provendor_Bolsas');
          $this->db->where('Orgao_Provendor_Bolsas.opbNome', $Nome);
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
      function mupdate($id,$opbNome,$opbCodigo){
            $dados = array('opbNome' => $opbNome,'opbCodigo' => $opbCodigo);
            if($this->db->update('Orgao_Provendor_Bolsas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$opbNome,$opbCodigo){
        if($this->db->insert('Orgao_Provendor_Bolsas', array('opbNome' => $opbNome,'opbCodigo' => $opbCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Orgao_Provendor_Bolsas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
