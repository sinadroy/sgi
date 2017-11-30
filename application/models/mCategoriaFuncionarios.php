<?php
  class MCategoriaFuncionarios extends CI_Model{
      
      //var $id = '';
      var $cfNome = '';
      var $cfCodigo = '';
      var $Grupos_Funcionarios_id = '';
      
      function mread(){
          $this->db->select('Categorias_Funcionarios.id,Categorias_Funcionarios.cfNome,Categorias_Funcionarios.cfCodigo,
                  Categorias_Funcionarios.Grupos_Funcionarios_id,Grupos_Funcionarios.gfNome');
          $this->db->from('Categorias_Funcionarios');
          $this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mread_x_grupo($id){
          $this->db->select('Categorias_Funcionarios.id,Categorias_Funcionarios.cfNome,Categorias_Funcionarios.cfCodigo,
                  Categorias_Funcionarios.Grupos_Funcionarios_id,Grupos_Funcionarios.gfNome');
          $this->db->from('Categorias_Funcionarios');
          $this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $this->db->where('Grupos_Funcionarios.id', $id);
          $consulta = $this->db->get();
          //return $consulta->result();
          foreach($consulta->result() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->cfNome,
                "cfNome"=>$row->cfNome,
                "cfCodigo"=>$row->cfCodigo,
                "Grupos_Funcionarios_id"=>$row->Grupos_Funcionarios_id,
                "gfNome"=>$row->gfNome
            );
          }
          return $al;
      }
      function mGetID($Nome){
          $this->db->select('Categorias_Funcionarios.id');
          $this->db->from('Categorias_Funcionarios');
          $this->db->where('Categorias_Funcionarios.cfNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Categorias_Funcionarios.id');
          $this->db->from('Categorias_Funcionarios');
          $this->db->where('Categorias_Funcionarios.cfCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGet_Categoria($id){
          $this->db->select('Categorias_Funcionarios.cfNome');
          $this->db->from('Categorias_Funcionarios');
          $this->db->join('Funcionarios', 'Funcionarios.Categorias_Funcionarios_id = Categorias_Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cfNome;
          }
      }
      public function totalCategorias_Funcionarios(){
        $this->db->select('Categorias_Funcionarios.id');
          $this->db->from('Categorias_Funcionarios');
        return $this->db->count_all_results();
      }
      function mupdate($id,$cfNome,$cfCodigo,$Grupos_Funcionarios_id){
            $dadosCategorias_Funcionarios = array('cfNome' => $cfNome,'cfCodigo' => $cfCodigo,'Grupos_Funcionarios_id' => $Grupos_Funcionarios_id);
            if($this->db->update('Categorias_Funcionarios', $dadosCategorias_Funcionarios, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($cfNome,$cfCodigo,$Grupos_Funcionarios_id){
        if($this->db->insert('Categorias_Funcionarios', array('cfNome' => $cfNome,'cfCodigo' => $cfCodigo,'Grupos_Funcionarios_id' => $Grupos_Funcionarios_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Categorias_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
