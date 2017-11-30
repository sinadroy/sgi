<?php
  class Mestudantes_turmas extends CI_Model{
      
      function mread(){
          $this->db->select('turmas.id,turmas.tNome,turmas.tCodigo,turmas.tCapacidade,
                  turmas.Ano_Curricular_id,Ano_Curricular.acNome,
                  turmas.niveis_cursos_id,niveis.nNome,cursos.cNome,periodos.pNome,
                  Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte');
          $this->db->from('turmas');
          $this->db->join('estudantes_turmas', 'turmas.Ano_Curricular_id = Ano_Curricular.id');
          $this->db->join('Estudantes', 'estudantes_turmas.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          
          $consulta = $this->db->get();
          $ord=1;
          foreach($consulta->result() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->tNome,
                "tNome"=>$row->tNome,
                "tCodigo"=>$row->tCodigo,
                "acNome"=>$row->acNome,
                "pNome"=>$row->pNome,
                "niveis_cursos_id"=>$row->niveis_cursos_id,
                "nNome"=>$row->nNome,
                "curso"=>$row->curso,
                "tCapacidade"=>$row->tCapacidade,

                "cNome"=>$row->cNome,
                "cNomes"=>$row->cNomes,
                "cApelido"=>$row->cApelido,
                "cBI_Passaporte"=>$row->cBI_Passaporte
            );
            $ord++;
          }
          return $al;
      }
      function mreadXncp($n,$c,$p){
          $this->db->select('turmas.id,turmas.tNome,turmas.tDescricao,turmas.tCodigo,turmas.tCapacidade,
                  turmas.Ano_Curricular_id,Ano_Curricular.acNome,
                  turmas.niveis_cursos_id,niveis.nNome,cursos.cNome,
                  periodos.pNome,
                  sessao.sesNome');
          $this->db->from('turmas');
          $this->db->join('Ano_Curricular', 'turmas.Ano_Curricular_id = Ano_Curricular.id');
          
          $this->db->join('niveis_cursos', 'turmas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->join('sessao', 'turmas.sessao_id = sessao.id');
          $this->db->where('niveis.id', $n);
          $this->db->where('cursos.id', $c);
          $this->db->where('periodos.id', $p);
          $consulta = $this->db->get();
          $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                $data[] = array(
                    "orden"=>$orden,
                    "id"=>$row->id,
                    "value"=>$row->tNome,
                    "tNome"=>$row->tNome,
                    "tCodigo"=>$row->tCodigo
                );
                $orden++;
            }
            return $data;
      }
      function mGetID($Nome){
          $this->db->select('turmas.id');
          $this->db->from('turmas');
          $this->db->where('turmas.tNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      public function total(){
        $this->db->select('turmas.id');
          $this->db->from('turmas');
        return $this->db->count_all_results();
      }
      function mupdate($id,$tNome,$tCodigo,$tDescricao,$acNome,$niveis_cursos_id,$sesNome,$tCapacidade){
            $dados = array('tNome'=>$tNome,'tCodigo'=>$tCodigo,'tDescricao'=>$tDescricao,'Ano_Curricular_id'=>$acNome,
                'niveis_cursos_id'=>$niveis_cursos_id,'sessao_id'=>$sesNome,'tCapacidade'=>$tCapacidade);
            if($this->db->update('turmas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo,$Descricao,$Ano_Curricular_id,$niveis_cursos_id,$sesNome,$tCapacidade){
        if($this->db->insert('turmas', array('tNome'=>$Nome,'tCodigo'=>$Codigo,'tDescricao'=>$Descricao,'Ano_Curricular_id'=>$Ano_Curricular_id,
                'niveis_cursos_id'=>$niveis_cursos_id,'sessao_id'=>$sesNome,'tCapacidade'=>$tCapacidade)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('turmas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
