<?php
  class MReconhecimentos extends CI_Model{
      
      //var $id = '';
      var $recData = '';
      var $recMotivo = '';
      var $recObs = '';
      
      function mread(){
          $this->db->select('Reconhecimentos.id,Reconhecimentos.recData,Reconhecimentos.recMotivo,Reconhecimentos.recObs,
              Reconhecimentos.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Reconhecimentos');
          $this->db->join('Funcionarios', 'Reconhecimentos.Funcionarios_id = Funcionarios.id');
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
      public function totalReconhecimentos(){
        $this->db->select('Reconhecimentos.id');
          $this->db->from('Reconhecimentos');
        return $this->db->count_all_results();
      }
       
      function mupdate($id,$recData,$recMotivo,$recObs){
            $dados = array('recData' => $recData,'recMotivo' => $recMotivo,'recObs' => $recObs);
            if($this->db->update('Reconhecimentos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$recData,$recMotivo,$recObs){
        if($this->db->insert('Reconhecimentos', array('Funcionarios_id'=>$id,'recData'=>$recData,'recMotivo'=>$recMotivo,'recObs' => $recObs)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Reconhecimentos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
