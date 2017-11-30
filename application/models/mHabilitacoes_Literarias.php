<?php
  class MHabilitacoes_Literarias extends CI_Model{
      
      //var $id = '';
      var $hlfNome = '';
      var $hlfCodigo = '';
      //var $Grupos_Funcionarios_id = '';
      
      function mread(){
          $this->db->select('id,hlfNome,hlfCodigo');
          $this->db->from('Habilitacoes_Literarias_Funcionarios');
          //$this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Habilitacoes_Literarias_Funcionarios.id');
          $this->db->from('Habilitacoes_Literarias_Funcionarios');
          $this->db->where('Habilitacoes_Literarias_Funcionarios.hlfNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Habilitacoes_Literarias_Funcionarios.id');
          $this->db->from('Habilitacoes_Literarias_Funcionarios');
          $this->db->where('Habilitacoes_Literarias_Funcionarios.hlfCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalHabilitacoes_Literarias(){
        $this->db->select('Habilitacoes_Literarias_Funcionarios.id');
          $this->db->from('Habilitacoes_Literarias_Funcionarios');
        return $this->db->count_all_results();
      }
      function mupdate($id,$hlfNome,$hlfCodigo){
            $dadosHabilitacoes_Literarias = array('hlfnome' => $hlfNome,'hlfCodigo' => $hlfCodigo);
            if($this->db->update('Habilitacoes_Literarias_Funcionarios', $dadosHabilitacoes_Literarias, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($hlfNome,$hlfCodigo){
        if($this->db->insert('Habilitacoes_Literarias_Funcionarios', array('hlfNome' => $hlfNome,'hlfCodigo' => $hlfCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Habilitacoes_Literarias_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
