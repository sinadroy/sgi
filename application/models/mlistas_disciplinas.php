<?php
class MListas_Disciplinas extends CI_Model {
	
	function mread() {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			Estudantes.eEstado_Matricula1');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		
		$this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
        
		$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			$data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "nNome" => $row->nNome,
                "curso" => $row->curso,
				"pNome" => $row->pNome,
				"acNome" => $row->acNome,
				"sNome" => $row->sNome,
				"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
			);
			$ord++;	
		}
		return $data;
	}

	function mread_x_ncpacd($n,$c,$p,$ac,$d) {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome, semestres.sNome, Estudantes.eEstado_Matricula1');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		
		$this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
        $this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('Ano_Curricular.id', $ac);
		$this->db->where('Disciplinas.id', $d);

		$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			$data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "nNome" => $row->nNome,
                "curso" => $row->curso,
				"pNome" => $row->pNome,
				"acNome" => $row->acNome,
				"sNome" => $row->sNome,
				//"tNome" => $row->tNome,
				"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
			);
			$ord++;	
		}
		return $data;
	}

	
/*
	function minsert($Candidatos_id,$n,$c,$p,$ac,$s,$t){
		$niveis_cursos_id = $this->get_ncp_id($n,$c,$p);
		$audData = date("Y/m/d");
        //$audHora = date('H:i:s', time());
        $dados = array('Candidatos_id'=>$Candidatos_id, 'niveis_cursos_id'=>$niveis_cursos_id, 'eData_Matricula'=>$audData, 'eEstado_Matricula'=>"Conf.Mat.Esp.Pag", 
					'Ano_Curricular_id'=>$ac, 'semestres_id'=>$s, 'turmas_id'=>$t);
        if ($this->db->insert('Estudantes', $dados))
            return true;
        else
            return false;
	}
	
	function mupdate($id,$Candidatos_id,$n,$c,$p,$ac,$s,$t) {
		$niveis_cursos_id = $this->get_ncp_id($n,$c,$p);
		$audData = date("Y/m/d");
		$dados = array('niveis_cursos_id'=>$niveis_cursos_id, 'eData_Matricula'=>$audData, //'eEstado_Matricula'=>"Conf.Mat.Esp.Pag", 
					'Ano_Curricular_id'=>$ac, 'semestres_id'=>$s, 'turmas_id'=>$t);
		if ($this->db->update('Estudantes', $dados, array('Candidatos_id' => $Candidatos_id))) {
			return true;
		}else
		    return false;
	}
	
	*/
	
}