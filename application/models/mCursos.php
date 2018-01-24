<?php
  class MCursos extends CI_Model{
      
      //var $id = '';
      var $cNome = '';
      var $cCodigo = '';
      var $nNome = '';
      var $ncDuracao = '';
      var $ncPreco_Inscricao = '';
      var $ncPreco_Matricula = '';
      var $ncPreco_Propina = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      /*
      function mread(){
          $this->db->select('niveis_cursos.id,cursos.cNome,cursos.cCodigo,cursos.cDescricao,
                  niveis_cursos.ncPreco_Inscricao,niveis_cursos.ncPreco_Matricula,niveis_cursos.ncPreco_Propina,
                  niveis_cursos.ncDuracao,niveis.nNome');
          $this->db->from('cursos');
          $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
       */
      function mread(){
          $this->db->select('cursos.id,cursos.cNome,cursos.cCodigo,cursos.cDescricao,cursos.cCodigoNome');
          $this->db->from('cursos');
          //$this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
          //$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }

      function mread_dpto($dpto) {
        $this->db->select('cursos.id,cursos.cNome,cursos.cCodigo,cursos.cDescricao,cursos.cCodigoNome');
        $this->db->from('cursos');
        $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->where('niveis_cursos.departamentos_id', $dpto);
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->cNome,
                "cNome"=>$row->cNome,
                "cCodigo"=>$row->cCodigo,
                "cDescricao"=>$row->cDescricao,
            );
        }
        return $al;
    }

      function mreadXn($n) {
		$this->db->select('cursos.id,cursos.cNome,cursos.cCodigo,cursos.cDescricao,cursos.cCodigoNome');
		$this->db->from('cursos');
        $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->where('niveis.id', $n);
        $this->db->order_by('cNome','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			$data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "value"=>$row->cNome,
                "cNome"=>$row->cNome,
                "cCodigo"=>$row->cCodigo,
                "cDescricao"=>$row->cDescricao,
                "cCodigoNome"=>$row->cCodigoNome
			);
			$ord++;	
		}
		return $data;
	}
      /*
      select count(candidatos.id) as total from candidatos
        inner join cursos_pretendidos on(cursos_pretendidos.Candidatos_id = candidatos.id)
        inner join niveis_cursos on(cursos_pretendidos.niveis_cursos_id = niveis_cursos.id)
        inner join cursos on(niveis_cursos.cursos_id = cursos.id)
        where cursos.id = 5
      */
      function mGet_total_X_cursoID($id,$al){
          $this->db->select('count(candidatos.id) as total');
          $this->db->from('candidatos');
          $this->db->join('cursos_pretendidos', 'cursos_pretendidos.Candidatos_id = candidatos.id');
          $this->db->join('niveis_cursos', 'cursos_pretendidos.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
          // $this->db->where('anos_lectivos.alAno', $al);
          $this->db->where('cursos_pretendidos.cp_ano_lec_insc', $al); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
          $this->db->where('cursos.id', $id);
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              return $row->total;
          }
      }

      function mGet_total_X_curso_estadistica($al){
          $al = ($al != "")?$al:date('Y');
          $this->db->select('cursos.id,cursos.cNome,cursos.cDescricao,cursos.cCodigoNome');
          $this->db->from('cursos');
          //$this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = cursos.id');
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              $data[] = array(
                "id" => $row->id,
                "codigo"=> $row->cCodigoNome,
                "quantidade" => $this->mGet_total_X_cursoID($row->id,$al),
                "color" => "#e33fc7",
            );
          }
          return $data;
      }

      function mGetID($Nome){
          $this->db->select('cursos.id');
          $this->db->from('cursos');
          $this->db->where('cursos.cNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetNome($id){
        $this->db->select('cursos.cNome');
        $this->db->from('cursos');
        $this->db->where('cursos.id', $id);
        $consulta = $this->db->get();
        foreach($consulta->result() as $value) {
            return $value->cNome;
        }
    }
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
      function mupdate($id,$cNome,$cCodigo,$cDescricao,$cCodigoNome){
            $dadosCursos = array('cNome' => $cNome,'cCodigo' => $cCodigo, 'cDescricao' => $cDescricao, 'cCodigoNome'=>$cCodigoNome);
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
      /*
      function minsert($cNome,$cCodigo,$nNome,$ncDuracao,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina){
        if($this->db->insert('cursos', array('cNome' => $cNome,'cCodigo' => $cCodigo)))
        {
            $idCurso = $this->mGetID($cNome);
            if($this->db->insert('niveis_cursos', array('niveis_id' => $nNome,'cursos_id' => $idCurso,'ncDuracao' => $ncDuracao,
            'ncPreco_Inscricao' => $ncPreco_Inscricao,'ncPreco_Matricula' => $ncPreco_Matricula,'ncPreco_Propina' => $ncPreco_Propina)))
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
       * 
       */
    function minsert($cNome,$cCodigo,$cDescricao,$cCodigoNome){
        if($this->db->insert('cursos', array('cNome' => $cNome,'cCodigo' => $cCodigo, 'cDescricao' => $cDescricao, 'cCodigoNome'=>$cCodigoNome)))
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
       
           
  }
?>
