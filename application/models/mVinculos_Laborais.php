<?php
  class MVinculos_Laborais extends CI_Model{
      
      //var $id = '';
      var $vlNome = '';
      var $vlCodigo = '';
      //var $Grupos_Funcionarios_id = '';
      
      function mread(){
          $this->db->select('Vinculos_Laborais.id,Vinculos_Laborais.vlNome,Vinculos_Laborais.vlCodigo');
          $this->db->from('Vinculos_Laborais');
          //$this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Vinculos_Laborais.id');
          $this->db->from('Vinculos_Laborais');
          $this->db->where('Vinculos_Laborais.vlNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Vinculos_Laborais.id');
          $this->db->from('Vinculos_Laborais');
          $this->db->where('Vinculos_Laborais.vlCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalVinculos_Laborais(){
        $this->db->select('Vinculos_Laborais.id');
          $this->db->from('Vinculos_Laborais');
        return $this->db->count_all_results();
      }
      function mupdate($id,$vlNome,$vlCodigo){
            $dadosVinculos_Laborais = array('vlNome' => $vlNome,'vlCodigo' => $vlCodigo);
            if($this->db->update('Vinculos_Laborais', $dadosVinculos_Laborais, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($vlNome,$vlCodigo){
        if($this->db->insert('Vinculos_Laborais', array('vlNome' => $vlNome,'vlCodigo' => $vlCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Vinculos_Laborais', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
