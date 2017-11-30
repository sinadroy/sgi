<?php
  class MGrupoFuncionarios extends CI_Model{
      
      //var $id = '';
      var $gfNome = '';
      var $gfCodigo = '';
      //var $Provincias_id = '';
      
      function mread(){
          $this->db->select('Grupos_Funcionarios.id,Grupos_Funcionarios.gfNome,Grupos_Funcionarios.gfCodigo');
          $this->db->from('Grupos_Funcionarios');
          //$this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Grupos_Funcionarios.id');
          $this->db->from('Grupos_Funcionarios');
          $this->db->where('Grupos_Funcionarios.gfNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Grupos_Funcionarios.id');
          $this->db->from('Grupos_Funcionarios');
          $this->db->where('Grupos_Funcionarios.gfCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalGrupos_Funcionarios(){
        $this->db->select('Grupos_Funcionarios.id,Grupos_Funcionarios.gfNome,Grupos_Funcionarios.gfCodigo');
          $this->db->from('Grupos_Funcionarios');
        return $this->db->count_all_results();
      }
      function mupdate($id,$gfNome,$gfCodigo){
            $dadosGrupos_Funcionarios = array('gfNome' => $gfNome,'gfCodigo' => $gfCodigo);
            if($this->db->update('Grupos_Funcionarios', $dadosGrupos_Funcionarios, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($gfNome,$gfCodigo){
        if($this->db->insert('Grupos_Funcionarios', array('gfNome' => $gfNome,'gfCodigo' => $gfCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Grupos_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
