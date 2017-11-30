<?php
  class MCargos extends CI_Model{
      
      //var $cNome = '';
      //var $cCodigo = '';
      //var $nNome = '';
      //var $ncDuracao = '';
      //var $ncPreco_Inscricao = '';
      //var $ncPreco_Matricula = '';
      //var $ncPreco_Propina = '';
      
      function mread(){
          $this->db->select('Cargos.id,Cargos.carNome,Cargos.carCodigo');
          $this->db->from('Cargos');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Cargos.id');
          $this->db->from('Cargos');
          $this->db->where('Cargos.carNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      /*
      function mGetIDXCodigo($cCodigo){
          $this->db->select('cursos.id');
          $this->db->from('cursos');
          $this->db->where('cursos.cCodigo', $cCodigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalCursos(){
        $this->db->select('cursos.id,cursos.cNome,cursos.cCodigo');
          $this->db->from('cursos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$cNome,$cCodigo){
            $dadosCursos = array('cNome' => $cNome,'cCodigo' => $cCodigo);
            //$dadosNiveisAcessos = array('niveis_id' => $nNome,'cursos_id' => $idCurso,'ncDuracao' => $ncDuracao,
            //'ncPreco_Inscricao' => $ncPreco_Inscricao,'ncPreco_Matricula' => $ncPreco_Matricula,'ncPreco_Propina' => $ncPreco_Propina);
            
            if($this->db->update('cursos', $dadosCursos, array('id' => $id))){
                //if($this->db->update('niveis_cursos', $dadosNiveisAcessos, array('id' => $id))){
                    return true;
                //}
            }
            else
                  return false;
          //}else
                  //return FALSE;
      }
      
    function minsert($cNome,$cCodigo){
        if($this->db->insert('cursos', array('cNome' => $cNome,'cCodigo' => $cCodigo)))
        {
            return true;
        }
        else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('cursos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    */   
           
  }
?>
