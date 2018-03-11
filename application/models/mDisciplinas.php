<?php
  class MDisciplinas extends CI_Model{
      
      function mread(){
          $this->db->select('Disciplinas.id,Disciplinas.dNome,Disciplinas.dCodigo,
                  Disciplinas.dDescricao,Disciplinas.dNotaMaxima,Disciplinas.dNotaMinima,
                  Disciplinas.dCredito,Disciplinas.dQuantidadesHoras,
                  Disciplinas.dPrecedencia1_id,Disciplinas.dPrecedencia2_id,Disciplinas.dPrecedencia3_id,
                  Disciplinas.dEstado,
                  Disciplinas.Classificacao_id,Classificacao.clNome,
                  Disciplinas.Disciplinas_Duracao_id,Disciplinas_Duracao.ddNome,
                  niveis.id as nid,niveis.nNome,cursos.id as cid,cursos.cNome,periodos.id as pid,periodos.pNome');
          $this->db->from('Disciplinas');
          $this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          $this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }

      //listar disciplinas por departamento
      function mread_dpto($dpto){
        $this->db->select('Disciplinas.id,Disciplinas.dNome,Disciplinas.dCodigo');
        $this->db->from('Disciplinas');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->where('niveis_cursos.departamentos_id', $dpto);
        $consulta = $this->db->get();
        foreach($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "dNome" => $row->dNome,
                "value" => $row->dNome,
                "dCodigo" => $row->dCodigo
            );
        }
        return $data;
    }

      function mread_codigo($idd){
          $this->db->select('Disciplinas.dCodigo');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->dCodigo;
          }
      }

      //ano lectivo de la disciplina
      function mread_ano_lectivo($idp,$idd){
          $this->db->select_max('anos_lectivos.alAno');
          $this->db->from('Professores_Disciplinas');
          $this->db->join('anos_lectivos', 'Professores_Disciplinas.anos_lectivos_id = anos_lectivos.id');
          $this->db->where('Professores_Disciplinas.ProfessorP_id', $idp);
          $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->alAno;
          }
      }
      function mread_nivel($idp,$idd){
          $this->db->select('niveis.nNome');
          $this->db->from('Disciplinas');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
          $this->db->where('Professores_Disciplinas.ProfessorP_id', $idp);
          $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->nNome;
          }
      }
      function mread_curso($idp,$idd){
          $this->db->select('cursos.cNome');
          $this->db->from('Disciplinas');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
          $this->db->where('Professores_Disciplinas.ProfessorP_id', $idp);
          $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cNome;
          }
      }
      function mread_periodo($idp,$idd){
          $this->db->select('periodos.pNome');
          $this->db->from('Disciplinas');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
          $this->db->where('Professores_Disciplinas.ProfessorP_id', $idp);
          $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->pNome;
          }
      }
      function mread_ano_curricular($idp,$idd){
          $this->db->select('Ano_Curricular.acnome');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = Disciplinas.id');
          $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
          $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
          $this->db->where('Professores_Disciplinas.ProfessorP_id', $idp);
          $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->acnome;
          }
      }
      function mread_ano_curricular_X_idd($idd){
          $this->db->select('Ano_Curricular.id');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = Disciplinas.id');
          $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
          $this->db->where('Disciplinas.id', $idd);
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

      function mread_existe_precedencia1($idd){
        $this->db->select('dPrecedencia1_id');
		$this->db->from('Disciplinas');
        $this->db->where('Disciplinas.id', $idd);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->dPrecedencia1_id;	
		}
      }
      function mread_existe_precedencia2($idd){
        $this->db->select('dPrecedencia2_id');
		$this->db->from('Disciplinas');
        $this->db->where('Disciplinas.id', $idd);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->dPrecedencia2_id;	
		}
      }
      function mread_existe_precedencia3($idd){
        $this->db->select('dPrecedencia3_id');
		$this->db->from('Disciplinas');
        $this->db->where('Disciplinas.id', $idd);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->dPrecedencia3_id;	
		}
      }

      function mreadXnome($nome){
          $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.dnome', $nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadXcodigo($codigo){
          $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
          $this->db->where('Disciplinas.dCodigo', $codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadXduracao($codigo){
          $this->db->select('Disciplinas_Duracao.ddNome');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->where('Disciplinas.dCodigo', $codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ddNome;
          }
      }
      function mread_duracao_x_id($id){
            $this->db->select('Disciplinas_Duracao.ddNome');
            $this->db->from('Disciplinas');
            $this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
            $this->db->where('Disciplinas.id', $id);
            $consulta = $this->db->get();
            foreach($consulta->result() as $value) {
                return $value->ddNome;
            }
      }
      function mreadXancp($ac,$n,$c,$p) {
          $this->db->select('Disciplinas.id, Disciplinas.dnome');
          $this->db->from('Disciplinas');
          //$this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          //$this->db->join('disciplinas_semestres', 'disciplinas_semestres.disciplinas_id = disciplinas.id');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $consulta = $this->db->get();
          /*
          $data = array();
          foreach($consulta->result() as $row) {
              $data[] = array(
                "id" => $row->id
			);
          }*/
          return $consulta->result();
      }
    
    function mreadX_ac_n_c_p2($ac,$n,$c,$p) {
        $this->db->select('Disciplinas.id, Disciplinas.dnome');
        $this->db->from('Disciplinas');
        $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
        $this->db->where('Disciplinas.dEstado', "on");
        $consulta = $this->db->get();
        return $consulta->result();
    }

      function mreadX_ac_n_c_p($ac,$n,$c,$p) {
          $this->db->select('Disciplinas.id, Disciplinas.dnome');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $this->db->where('Disciplinas.dEstado', "on");
          $consulta = $this->db->get();
          return $consulta->result();
      }

      function mreadX_ac_n_c_p_g($ac,$n,$c,$p,$g) {
          $this->db->select('Disciplinas.id, Disciplinas.dnome');
          $this->db->from('Disciplinas');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $this->db->where('Disciplinas.dEstado', "on");
          $this->db->where('Disciplinas.d_geracao_id', $g);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      /*
      //new matricula
      function mreadXXXXX($) {
          $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
          //$this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          //$this->db->join('disciplinas_semestres', 'disciplinas_semestres.disciplinas_id = disciplinas.id');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              $data[] = array(
                "id" => $row->id
			);
          }
          return $data;
      }

      function mreadXncp_matricula($n,$c,$p) {
          $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
          //$this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          //$this->db->join('disciplinas_semestres', 'disciplinas_semestres.disciplinas_id = disciplinas.id');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('niveis_cursos.periodos_id', $p);
          //$this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              $data[] = array(
                "id" => $row->id
			);
          }
          return $data;
      }
      */
      //readXac
      function mreadXac($n,$c,$p,$ac,$t) {
          $this->db->select('Disciplinas.id,Disciplinas.dNome');
          $this->db->from('Disciplinas');
          $this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          $this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //mreadXacncp($ac,$n,$c,$p,$s)
     /*
     * obj: para leer solo las disciplinas de un anho semestre 
     * en el combo disciplinas/planificacao.
    */   
    function mreadXacncps($ac,$n,$c,$p,$s){
          $this->db->select('Disciplinas.id,Disciplinas.dNome,Disciplinas.dCodigo,
                  Disciplinas.dDescricao,Disciplinas.dNotaMaxima,Disciplinas.dNotaMinima,
                  Disciplinas.dCredito,Disciplinas.dQuantidadesHoras,
                  Disciplinas.dPrecedencia1_id,Disciplinas.dPrecedencia2_id,Disciplinas.dPrecedencia3_id,
                  Disciplinas.dEstado,
                  Disciplinas.Classificacao_id,Classificacao.clNome,
                  Disciplinas.Disciplinas_Duracao_id,Disciplinas_Duracao.ddNome,
                  niveis.nNome,cursos.cNome,periodos.pNome');
          $this->db->from('Disciplinas');
          $this->db->join('Classificacao', 'Disciplinas.Classificacao_id = Classificacao.id');
          $this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.Disciplinas_id = Disciplinas.id');
          $this->db->join('disciplinas_semestres', 'disciplinas_semestres.Disciplinas_id = Disciplinas.id');
          $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis_cursos.niveis_id', $n);
          $this->db->where('niveis_cursos.cursos_id', $c);
          $this->db->where('niveis_cursos.periodos_id', $p);
          $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
          $this->db->where('niveis_cursos.cursos_id', $c);
          
          $this->db->where('disciplinas_semestres.Semestres_id', $s);
          $this->db->or_where('Disciplinas_Duracao.ddNome',"Anual"); //leer las disc anuales
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
      public function total(){
        $this->db->select('Disciplinas.id');
          $this->db->from('Disciplinas');
        return $this->db->count_all_results();
      }
      function mupdate($id, $nNome, $cNome, $pNome, $dNome, $dCodigo, $clNome, $ddNome,$dDescricao, 
            $dNotaMinima, $dNotaMaxima, $dQuantidadesHoras, $dCredito, $dEstado, $dgnome){
        
        $dados = array('dNome'=>$dNome,'dCodigo'=>$dCodigo,'dDescricao'=>$dDescricao,'dNotaMaxima'=>$dNotaMaxima,
            'dNotaMinima'=>$dNotaMinima,'dCredito'=>$dCredito, 'dQuantidadesHoras'=>$dQuantidadesHoras,'dEstado'=>$dEstado,
            'Disciplinas_Duracao_id'=>$ddNome,'Classificacao_id'=>$clNome, 'd_geracao_id'=>$dgnome);
            
        if($this->db->update('Disciplinas', $dados, array('id' => $id))){
            
            return true;
        }
        else
            return false;
      }
    //obter o id de nivel_curso
    function getIDNiveis_Cursos($n,$c,$p) {
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
      
    function minsert($nNome,$cNome,$pNome,$dNome,$dCodigo,$dDescricao,$dNotaMaxima,$dNotaMinima,$dCredito,
                    $dQuantidadesHoras,$dEstado,$clNome,$ddNome, $dgnome){
        $ncID = $this->getIDNiveis_Cursos($nNome,$cNome,$pNome);
        if($ncID != ""){
           $dados = array('niveis_cursos_id'=>$ncID,'dNome'=>$dNome,'dCodigo'=>$dCodigo,'dDescricao'=>$dDescricao,'dNotaMaxima'=>$dNotaMaxima,
            'dNotaMinima'=>$dNotaMinima,'dCredito'=>$dCredito, 'dQuantidadesHoras'=>$dQuantidadesHoras,
            'Disciplinas_Duracao_id'=>$ddNome,'Classificacao_id'=>$clNome, 'd_geracao_id'=>$dgnome);
            if($this->db->insert('Disciplinas', $dados))
            {
                return true;
            }
            else{
                return false;
            }             
        }else{
            return false;
        }
    }
    function mdelete($id) {
        if($this->db->delete('Disciplinas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
