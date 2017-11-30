<?php
  class MSancoes extends CI_Model{
      
      //var $id = '';
      var $recData = '';
      var $recMotivo = '';
      var $recObs = '';
      
      function mread(){
          $this->db->select('Sancoes.id,Sancoes.sanData,Sancoes.sanMotivo,Sancoes.sanObs,
              Sancoes.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Sancoes');
          $this->db->join('Funcionarios', 'Sancoes.Funcionarios_id = Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      /*
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
       */
      public function totalSancoes(){
        $this->db->select('Sancoes.id');
          $this->db->from('Sancoes');
        return $this->db->count_all_results();
      }
       
      function mupdate($id,$sanData,$sanMotivo,$sanObs){
            $dados = array('sanData' => $sanData,'sanMotivo' => $sanMotivo,'sanObs' => $sanObs);
            if($this->db->update('Sancoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$sanData,$sanMotivo,$sanObs){
        if($this->db->insert('Sancoes', array('Funcionarios_id'=>$id,'sanData'=>$sanData,'sanMotivo'=>$sanMotivo,'sanObs' => $sanObs)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Sancoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
