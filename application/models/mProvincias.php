<?php
  class MProvincias extends CI_Model{
      
      //var $id = '';
      var $provNome = '';
      var $provCodigo = '';
      
      function mread(){
          $this->db->select('Provincias.id,Provincias.provNome,Provincias.artigo,Provincias.provCodigo,
            Provincias.provCodigoNome,Pais.paNome');
          $this->db->join('Pais', 'Provincias.Pais_id = Pais.id');
          $this->db->from('Provincias');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para cargar provincias por pais para combos
      function mreadXP($id){
          $this->db->select('Provincias.id,Provincias.provNome,Provincias.provCodigo,Provincias.provCodigoNome');
          $this->db->from('Provincias');
           $this->db->join('Pais', 'Provincias.Pais_id = Pais.id');
          $this->db->where('Provincias.Pais_id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadPN(){
          $this->db->select('Provincias.id,Provincias.provNome as provNascimento,Provincias.provCodigo,Provincias.provCodigoNome');
          $this->db->from('Provincias');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadPF(){
          $this->db->select('Provincias.id,Provincias.provNome as provFormacao,Provincias.provCodigo,Provincias.provCodigoNome');
          $this->db->from('Provincias');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //readXPais
      function mreadXPais($id){
          $this->db->select('Provincias.id,Provincias.provNome as provNascimento,Provincias.provCodigo,,Provincias.provCodigoNome');
          $this->db->from('Provincias');
           $this->db->join('Pais', 'Provincias.Pais_id = Pais.id');
          $this->db->where('Provincias.Pais_id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Provincias.id');
          $this->db->from('Provincias');
          $this->db->where('Provincias.provNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($provCodigo){
          $this->db->select('Provincias.id');
          $this->db->from('Provincias');
          $this->db->where('Provincias.provCodigo', $provCodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetNomeXID($id){
          $this->db->select('Provincias.provNome');
          $this->db->from('Provincias');
          $this->db->where('Provincias.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->provNome;
          }
      }
      function mget_artigo($Nome){
          $this->db->select('Provincias.artigo');
          $this->db->from('Provincias');
          $this->db->where('Provincias.provNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->artigo;
          }
      }
      public function totalProvincias(){
        $this->db->select('Provincias.id,Provincias.provNome,Provincias.provCodigo');
          $this->db->from('Provincias');
        return $this->db->count_all_results();
      }
      function mupdate($id,$provNome,$provCodigo,$paNome,$artigo,$provCodigoNome){
            if(!is_numeric($paNome)){
                $this->load->model('mpaises');
                $paNome = $this->mpaises->mGetID($paNome);
            }
            $dadosProvincias = array('provNome' => $provNome,'artigo' => $artigo,'provCodigo' => $provCodigo,'Pais_id' => $paNome, 'provCodigoNome'=>$provCodigoNome);
            if($this->db->update('Provincias', $dadosProvincias, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($provNome,$provCodigo,$artigo,$paNome,$provCodigoNome){
        if($this->db->insert('Provincias', array('provNome' => $provNome,'artigo' => $artigo,'provCodigo' => $provCodigo,'Pais_id' => $paNome, 'provCodigoNome'=>$provCodigoNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Provincias', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
