<?php
  class MDisciplinas_Precedencias extends CI_Model{
      
      function mread($n,$c,$p,$ac){
          $this->db->select('Disciplinas.id,Disciplinas.dNome,Disciplinas.dCodigo,
                  Disciplinas.dPrecedencia1_id,Disciplinas.dPrecedencia2_id,Disciplinas.dPrecedencia3_id,
                  niveis.id as nid,niveis.nNome,cursos.id as cid, cursos.cNome,periodos.id as pid,periodos.pNome,
                  Disciplinas_Ano_Curricular.Ano_Curricular_id');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = Disciplinas.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          if($n != "")
                $this->db->where('niveis.id', $n);
          if($c != "")
                $this->db->where('cursos.id', $c);
          if($p != "")
                $this->db->where('periodos.id', $p);
          if($ac != "")
                $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);

          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mread_on($n,$c,$p,$ac){
          $this->db->select('Disciplinas.id,Disciplinas.dNome,Disciplinas.dCodigo,
                  Disciplinas.dPrecedencia1_id,Disciplinas.dPrecedencia2_id,Disciplinas.dPrecedencia3_id,
                  niveis.id as nid,niveis.nNome,cursos.id as cid, cursos.cNome,periodos.id as pid,periodos.pNome,
                  Disciplinas_Ano_Curricular.Ano_Curricular_id');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = Disciplinas.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('Disciplinas.dEstado', 'on');
          if($n != "")
                $this->db->where('niveis.id', $n);
          if($c != "")
                $this->db->where('cursos.id', $c);
          if($p != "")
                $this->db->where('periodos.id', $p);
          if($ac != "")
                $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);

          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.dNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadX($id){
          $this->db->select('Disciplinas.dNome');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dNome;
          }
      }
      
      function mupdate($id,$dPrecedencia1_id,$dPrecedencia2_id,$dPrecedencia3_id){
        $dados = array('dPrecedencia1_id'=>$dPrecedencia1_id,'dPrecedencia2_id'=>$dPrecedencia2_id,'dPrecedencia3_id'=>$dPrecedencia3_id);
        if($this->db->update('Disciplinas', $dados, array('id' => $id))){
            return true;
        }
        else
            return false;
      }
      
    function minsert($dPrecedencia1_id,$dPrecedencia2_id,$dPrecedencia3_id){
        $dados = array('dPrecedencia1_id'=>$dPrecedencia1_id,'dPrecedencia2_id'=>$dPrecedencia2_id,'dPrecedencia3_id'=>$dPrecedencia3_id);
        if($this->db->insert('Disciplinas', $dados))
        {
            return true;
        }
        else{
            return false;
        }
    }
    //este delete solo apaga as precedencias
    function mdelete($id) {
       $dados = array('dPrecedencia1_id'=>"",'dPrecedencia2_id'=>"",'dPrecedencia3_id'=>"");
        if($this->db->update('Disciplinas', $dados, array('id' => $id))){
            return true;
        }
        else
            return false;
    }        
}
