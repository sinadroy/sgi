<?php
  class MMunicipios extends CI_Model{
      
      //var $id = '';
      var $munNome = '';
      var $munCodigo = '';
      var $Provincias_id = '';
      
      function mread(){
          $this->db->select('Municipios.id,Municipios.munNome,Municipios.munCodigo,
                  Municipios.Provincias_id,Provincias.provNome');
          $this->db->from('Municipios');
          $this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadMN(){
          $this->db->select('Municipios.id,Municipios.munNome as munNascimento,Municipios.munCodigo,
                  Municipios.Provincias_id,Provincias.provNome');
          $this->db->from('Municipios');
          $this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadXProvincias($id){
          $this->db->select('Municipios.id,Municipios.munNome,Municipios.munCodigo,
                  Municipios.Provincias_id,Provincias.provNome');
          $this->db->from('Municipios');
           $this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
          $this->db->where('Municipios.Provincias_id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Municipios.id');
          $this->db->from('Municipios');
          $this->db->where('Municipios.munNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($munCodigo){
          $this->db->select('Municipios.id');
          $this->db->from('Municipios');
          $this->db->where('Municipios.munCodigo', $munCodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalMunicipios(){
        $this->db->select('Municipios.id,Municipios.munNome,Municipios.munCodigo');
          $this->db->from('Municipios');
        return $this->db->count_all_results();
      }
      function mupdate($id,$munNome,$munCodigo,$Provincias_id){
            $dadosMunicipios = array('munNome' => $munNome,'munCodigo' => $munCodigo,'Provincias_id' => $Provincias_id);
            if($this->db->update('Municipios', $dadosMunicipios, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($munNome,$munCodigo,$Provincias_id){
        if($this->db->insert('Municipios', array('munNome' => $munNome,'munCodigo' => $munCodigo,'Provincias_id' => $Provincias_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Municipios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
