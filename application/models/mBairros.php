<?php
  class MBairros extends CI_Model{
      
      //var $id = '';
      var $baiNome = '';
      var $baiCodigo = '';
      var $Municipios_id = '';
      
      function mread(){
          $this->db->select('Bairros.id,Bairros.baiNome,Bairros.baiCodigo,
                  Bairros.Municipios_id,Municipios.munNome');
          $this->db->from('Bairros');
          $this->db->join('Municipios', 'Bairros.Municipios_id = Municipios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
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
      public function totalBairros(){
        $this->db->select('Bairros.id');
          $this->db->from('Bairros');
        return $this->db->count_all_results();
      }
      function mupdate($id,$baiNome,$baiCodigo,$Municipios_id){
            $dadosBairros = array('baiNome' => $baiNome,'baiCodigo' => $baiCodigo,'Municipios_id' => $Municipios_id);
            if($this->db->update('Bairros', $dadosBairros, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($baiNome,$baiCodigo,$Municipios_id){
        if($this->db->insert('Bairros', array('baiNome' => $baiNome,'baiCodigo' => $baiCodigo,'Municipios_id' => $Municipios_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Bairros', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
