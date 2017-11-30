<?php
  class MEnderecos_Funcionarios extends CI_Model{
      
      
      function mread_pais($id){
          $this->db->select('Pais.id');
          $this->db->from('Pais');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }

      function mread_provincia($id){
          $this->db->select('Enderecos_Funcionarios.Provincias_id');
          $this->db->from('Enderecos_Funcionarios');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Provincias_id;
          }
      }

      function mread_municipio($id){
          $this->db->select('Enderecos_Funcionarios.Municipios_id');
          $this->db->from('Enderecos_Funcionarios');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Municipios_id;
          }
      }

      function mread_bairro($id){
          $this->db->select('Enderecos_Funcionarios.Bairros_id');
          $this->db->from('Enderecos_Funcionarios');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Bairros_id;
          }
      }

      function mread_telefone1($id){
          $this->db->select('fTelefone');
          $this->db->from('Funcionarios');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fTelefone;
          }
      }
      function mread_telefone2($id){
          $this->db->select('fTelefone1');
          $this->db->from('Funcionarios');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fTelefone1;
          }
      }
      function mread_mail($id){
          $this->db->select('fEmail');
          $this->db->from('Funcionarios');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fEmail;
          }
      }
      
      function mupdate_contacto($fTelefone,$fTelefone1,$fEmail,$Funcionarios_id){
            $dados = array('fTelefone' => $fTelefone,'fTelefone1' => $fTelefone1,'fEmail' => $fEmail);
            if($this->db->update('Funcionarios', $dados, array('id' => $Funcionarios_id))){
                return true;
            }else
                return false;
      }

      function mupdate($Pais_id,$Provincias_id,$Municipios_id,$Bairros_id,$Funcionarios_id){
            $dados = array('Pais_id' => $Pais_id,'Provincias_id' => $Provincias_id,'Municipios_id' => $Municipios_id,'Bairros_id' => $Bairros_id);
            if($this->db->update('Enderecos_Funcionarios', $dados, array('Funcionarios_id' => $Funcionarios_id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Pais_id,$Provincias_id,$Municipios_id,$Bairros_id,$Funcionarios_id){
        if($this->db->insert('Enderecos_Funcionarios', array('Pais_id' => $Pais_id,'Provincias_id' => $Provincias_id,'Municipios_id' => $Municipios_id,'Bairros_id' => $Bairros_id,'Funcionarios_id' => $Funcionarios_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Enderecos_Funcionarios', array('Funcionarios_id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
