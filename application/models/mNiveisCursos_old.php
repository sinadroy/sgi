<?php
  class MNiveisCursos extends CI_Model{
      
      //var $id = '';
      var $cursos_id = '';
      var $niveis_id = '';
      var $ncDuracao = '';
      var $ncPreco_Inscricao = '';
      var $ncPreco_Matricula = '';
      var $ncPreco_Propina = '';
      
      function mread(){
          $this->db->select('niveis_cursos.id,niveis_cursos.cursos_id,cursos.cNome,cursos.cCodigo,
                  niveis_cursos.niveis_id,niveis.nNome,niveis.nCodigo,
                  niveis_cursos.niveis_id,niveis_cursos.ncPreco_Inscricao,niveis_cursos.ncPreco_Matricula,
                  niveis_cursos.ncPreco_Propina,niveis_cursos.ncDuracao,periodos.pNome');
          $this->db->from('cursos');
          $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadX($n,$c){
          $this->db->select('niveis_cursos.id');
          $this->db->from('niveis_cursos');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadXncp($n,$c,$p){
          $this->db->select('niveis_cursos.id');
          $this->db->from('niveis_cursos');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalNiveisCursos(){
        $this->db->select('niveis_cursos.id');
          $this->db->from('niveis_cursos');
        return $this->db->count_all_results();
      }
      

      function mupdate($id,$cursos_id,$niveis_id,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina,$ncDuracao,$pNome){
        //$dadosCursos = array('cNome' => $cNome,'cCodigo' => $cCodigo);
        $dadosNiveisCursos = array('niveis_id' => $niveis_id,'cursos_id' => $cursos_id,'ncDuracao' => $ncDuracao,
            'ncPreco_Inscricao' => $ncPreco_Inscricao,'ncPreco_Matricula' => $ncPreco_Matricula,
            'ncPreco_Propina'=>$ncPreco_Propina,'periodos_id'=>$pNome);
            
        if($this->db->update('niveis_cursos', $dadosNiveisCursos, array('id' => $id))){
                //if($this->db->update('niveis_cursos', $dadosNiveisAcessos, array('id' => $id))){
            return true;
                //}
        }
        else
            return false;
          //}else
                  //return FALSE;
      }
      function existe($cursos_id,$niveis_id,$pNome) {
        $this->db->select('cursos_id,niveis_id');
        $this->db->from('niveis_cursos');
        $this->db->where('niveis_cursos.cursos_id', $cursos_id);
        $this->db->where('niveis_cursos.niveis_id', $niveis_id);
        $this->db->where('niveis_cursos.periodos_id', $pNome);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
      }  
    function minsert($cursos_id,$niveis_id,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina,$ncDuracao,$pNome){
        $dadosNiveisCursos = array('niveis_id' => $niveis_id,'cursos_id' => $cursos_id,'ncDuracao' => $ncDuracao,
            'ncPreco_Inscricao' => $ncPreco_Inscricao,'ncPreco_Matricula' => $ncPreco_Matricula,
            'ncPreco_Propina' => $ncPreco_Propina,'periodos_id'=>$pNome);
        if(!$this->existe($cursos_id, $niveis_id, $pNome))
        {
            if($this->db->insert('niveis_cursos', $dadosNiveisCursos))
            {
                return true;
            }
            else{
                return false;
            }
        }else
            return false;
           
    }
    function mdelete($id) {
        if($this->db->delete('niveis_cursos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
