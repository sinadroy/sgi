<?php
  class MBI_Lugar_Emissao_Provincias extends CI_Model{
      
      var $Provincias_id = '';
      var $Funcionarios_id = '';
      /*
      function mread(){
          $this->db->select('Generos.id,Generos.gNome,Generos.gCodigo');
          $this->db->from('Generos');
          //$this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Generos.id');
          $this->db->from('Generos');
          $this->db->where('Generos.gNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Generos.id');
          $this->db->from('Generos');
          $this->db->where('Generos.gCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalGeneros(){
        $this->db->select('Generos.id');
          $this->db->from('Generos');
        return $this->db->count_all_results();
      }*/
      function mGetID($idf){
          $this->db->select('id');
          $this->db->from('BI_Lugar_Emissao_Provincias');
          $this->db->where('Funcionarios_id', $idf);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mupdate($Provincias_id,$Funcionarios_id){
            $dados = array('Provincias_id' => $Provincias_id);
            if($this->db->update('BI_Lugar_Emissao_Provincias', $dados, array('Funcionarios_id' => $Funcionarios_id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Provincias_id,$Funcionarios_id){
        if($this->db->insert('BI_Lugar_Emissao_Provincias', array('Provincias_id' => $Provincias_id,'Funcionarios_id' => $Funcionarios_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('BI_Lugar_Emissao_Provincias', array('Funcionarios_id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
