<?php
  class MEstado_Civil extends CI_Model{
      
      var $ecNome = '';
      var $ecCodigo = '';
      
      function mread(){
          $this->db->select('Estado_Civil.id,Estado_Civil.ecNome,Estado_Civil.ecCodigo');
          $this->db->from('Estado_Civil');
          //$this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Estado_Civil.id');
          $this->db->from('Estado_Civil');
          $this->db->where('Estado_Civil.ecNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Estado_Civil.id');
          $this->db->from('Estado_Civil');
          $this->db->where('Estado_Civil.ecCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalEstado_Civil(){
        $this->db->select('Estado_Civil.id');
          $this->db->from('Estado_Civil');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('ecNome' => $Nome,'ecCodigo' => $Codigo);
            if($this->db->update('Estado_Civil', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Estado_Civil', array('ecNome' => $Nome,'ecCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Estado_Civil', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
