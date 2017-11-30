<?php
  class MDepartamentos extends CI_Model{
      
      //var $id = '';
      var $depNome = '';
      var $depCodigo = '';
      //var $Provincias_id = '';
      
      function mread(){
          $this->db->select('Departamentos.id,Departamentos.depNome,Departamentos.depCodigo');
          $this->db->from('Departamentos');
          //$this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Departamentos.id');
          $this->db->from('Departamentos');
          $this->db->where('Departamentos.depNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Departamentos.id');
          $this->db->from('Departamentos');
          $this->db->where('Departamentos.depCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalDepartamentos(){
        $this->db->select('Departamentos.id,Departamentos.depNome,Departamentos.depCodigo');
          $this->db->from('Departamentos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dadosDepartamentos = array('depNome' => $Nome,'depCodigo' => $Codigo);
            if($this->db->update('Departamentos', $dadosDepartamentos, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Departamentos', array('depNome' => $Nome,'depCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Departamentos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
