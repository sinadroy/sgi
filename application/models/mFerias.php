<?php
  class MFerias extends CI_Model{
      
      //var $id = '';
      var $ferData_Inicio = '';
      var $ferData_Fin = '';
      
      function mread(){
          $this->db->select('Ferias.id,Ferias.ferData_Inicio,Ferias.ferData_Fin,
                  Ferias.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,
                  Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Ferias');
          $this->db->join('Funcionarios', 'Ferias.Funcionarios_id = Funcionarios.id');
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
      public function totalFerias(){
        $this->db->select('Ferias.id');
          $this->db->from('Ferias');
        return $this->db->count_all_results();
      }
       
      function mupdate($id,$ferData_Inicio,$ferData_Fin){
            $dados = array('ferData_Inicio' => $ferData_Inicio,'ferData_Fin' => $ferData_Fin);
            if($this->db->update('Ferias', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$ferData_Inicio,$ferData_Fin){
        if($this->db->insert('Ferias', array('Funcionarios_id' => $id,'ferData_Inicio' => $ferData_Inicio,'ferData_Fin' => $ferData_Fin)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Ferias', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
