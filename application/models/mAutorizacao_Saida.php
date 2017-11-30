<?php
  class MAutorizacao_Saida extends CI_Model{
      
      //var $id = '';
      var $autData_Inicio = '';
      var $autData_Fin = '';
      var $autMotivo = '';
      
      function mread(){
          $this->db->select('Autorizacao_Saida.id,Autorizacao_Saida.autData_Inicio,Autorizacao_Saida.autData_Fin,
                  Autorizacao_Saida.autMotivo,Autorizacao_Saida.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,
                  Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Autorizacao_Saida');
          $this->db->join('Funcionarios', 'Autorizacao_Saida.Funcionarios_id = Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      /*
      function mreadXMunicipio($id){
          $this->db->select('Bairros.id,Bairros.baiNome,Bairros.baiCodigo,
                  Bairros.Municipios_id,Municipios.munNome');
          $this->db->from('Bairros');
           $this->db->join('Municipios', 'Bairros.Municipios_id = Municipios.id');
          $this->db->where('Bairros.Municipios_id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Bairros.id');
          $this->db->from('Bairros');
          $this->db->where('Bairros.baiNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($baiCodigo){
          $this->db->select('Bairros.id');
          $this->db->from('Bairros');
          $this->db->where('Bairros.baiCodigo', $baiCodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
       */
      public function totalSaidas(){
        $this->db->select('Autorizacao_Saida.id');
          $this->db->from('Autorizacao_Saida');
        return $this->db->count_all_results();
      }
       
      function mupdate($id,$autData_Inicio,$autData_Fin,$autMotivo){
            $dados = array('autData_Inicio' => $autData_Inicio,'autData_Fin' => $autData_Fin,'autMotivo' => $autMotivo);
            if($this->db->update('Autorizacao_Saida', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$autData_Inicio,$autData_Fin,$autMotivo){
        if($this->db->insert('Autorizacao_Saida', array('Funcionarios_id'=>$id,'autData_Inicio' => $autData_Inicio,'autData_Fin' => $autData_Fin,'autMotivo' => $autMotivo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Autorizacao_Saida', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
