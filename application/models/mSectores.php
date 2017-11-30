<?php
  class MSectores extends CI_Model{
      
      //var $id = '';
      var $secNome = '';
      var $secCodigo = '';
      var $Departamentos_id = '';
      
      function mread(){
          $this->db->select('Sectores.id,Sectores.secNome,Sectores.secCodigo,
                  Sectores.Departamentos_id,Departamentos.depNome');
          $this->db->from('Sectores');
          $this->db->join('Departamentos', 'Sectores.Departamentos_id = Departamentos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mread_x_dep($id){
          $this->db->select('Sectores.id,Sectores.secNome,Sectores.secCodigo,
                  Sectores.Departamentos_id,Departamentos.depNome');
          $this->db->from('Sectores');
          $this->db->join('Departamentos', 'Sectores.Departamentos_id = Departamentos.id');
          $this->db->where('Departamentos.id', $id);
          $consulta = $this->db->get();
          //return $consulta->result();
          foreach($consulta->result() as $row){
                $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->secNome,
                    "secNome"=>$row->secNome,
                    "secCodigo"=>$row->secCodigo,
                    "Departamentos_id"=>$row->Departamentos_id,
                    "depNome"=>$row->depNome
                );
          }
          return $al;
      }
      function mGetID($Nome){
          $this->db->select('Sectores.id');
          $this->db->from('Sectores');
          $this->db->where('Sectores.secNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Sectores.id');
          $this->db->from('Sectores');
          $this->db->where('Sectores.secCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalSectores(){
        $this->db->select('Sectores.id');
          $this->db->from('Sectores');
        return $this->db->count_all_results();
      }
      function mupdate($id,$secNome,$secCodigo,$Departamentos_id){
            $dadosSectores = array('secNome' => $secNome,'secCodigo' => $secCodigo,'Departamentos_id' => $Departamentos_id);
            if($this->db->update('Sectores', $dadosSectores, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($secNome,$secCodigo,$Departamentos_id){
        if($this->db->insert('Sectores', array('secNome' => $secNome,'secCodigo' => $secCodigo,'Departamentos_id' => $Departamentos_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Sectores', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
