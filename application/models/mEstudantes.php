<?php
class MEstudantes extends CI_Model {

	function mreadX($id) {
		$this->db->select('Candidatos.cNome,Candidatos.cApelido');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->where('Estudantes.id', $id);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->cNome.' '.$row->cApelido;
		}
	}

	function mget_idXbi($bi) {
		$this->db->select('Estudantes.id');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}

	//select niveis_cursos_id apartir de nivel cursos y periodo
    function get_ncp_id($n,$c,$p){
        $this->db->select('niveis_cursos.id');
        $this->db->from('niveis_cursos');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }

	function read_estado($cid,$n,$c,$p){
		$ncp_id = $this->get_ncp_id($n,$c,$p);
        $this->db->select('eEstado_Matricula1');
        $this->db->from('Estudantes');
        $this->db->where('Candidatos_id', $cid);
        $this->db->where('niveis_cursos_id', $ncp_id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            if($row->eEstado_Matricula1 == "Mat.Esp.Pag" || $row->eEstado_Matricula1 == "Mat.Aceite")
				return $row->eEstado_Matricula1;
			else
				return "Não Matriculado";
        }
    }

	function read_sexo($eid){
		$this->db->select('gnome');
        $this->db->from('candidatos');
		$this->db->join('estudantes', 'estudantes.candidatos_id = candidatos.id');
		$this->db->join('generos', 'candidatos.generos_id = generos.id');
        $this->db->where('estudantes.id', $eid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->gnome;
        }
    }

	function read_ano_lec_inscricao($ide){
		$this->db->select('alano');
        $this->db->from('candidatos');
		$this->db->join('estudantes', 'estudantes.candidatos_id = candidatos.id');
		$this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('estudantes.id', $ide);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->alano;
        }
    }

	//Numero Universitario
	function insert_numero_universitario($ide,$nu){
		//ver ano de inscricao
		$ano_lect_insc = $this->read_ano_lec_inscricao($ide);
		$nu = $nu.$ano_lect_insc[2].$ano_lect_insc[3];
		$dados = array('e_num_univ'=>$nu);
        if($this->db->update('Estudantes', $dados, array('id' => $ide))){
        	return true;
        }else
        	return false;
	}
	function existe_numero_universitario($ide){
          $this->db->select('e_num_univ');
          $this->db->from('Estudantes');
          $this->db->where('id', $ide);
          $consulta = $this->db->get();
		  foreach ($consulta->result() as $row) {
				if($row->e_num_univ != "")
					return true;
				else
					return false;
		  }
	}
	function mread_numero_universitario($ide){
		$this->db->select('e_num_univ');
		$this->db->from('Estudantes');
		$this->db->where('id', $ide);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->e_num_univ;
		}
  }

	function mread() {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome,
			Estudantes.eEstado_Matricula1,
			cursos.cDescricao,
			Estudantes.e_num_univ');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			//ver si ya existe el numero universitario
			//if($this->existe_numero_universitario($row->id)){
				//crear el numero universitario
				$nu = $row->id.'-'.$row->cDescricao.'/';
				$this->insert_numero_universitario($row->id,$nu);
			//}

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
				"tNome" => $row->tNome,
				"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
				"e_num_univ"=> $row->e_num_univ
			);
			$ord++;	
		}
		return $data;
	}

	function mreadXturma($n,$c,$p,$ac,$t) {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome,
			Estudantes.eEstado_Matricula1,
			Estudantes.e_num_univ');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('Estudantes.Ano_Curricular_id', $ac);
		$this->db->where('Estudantes.turmas_id', $t);

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
				"tNome" => $row->tNome,
				"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
				"e_num_univ"=> $row->e_num_univ
			);
			$ord++;	
		}
		return $data;
	}

	function mreadXturma2($n,$c,$p,$ac,$t,$s) {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome,
			Estudantes.eEstado_Matricula1,
			Estudantes.e_num_univ,
			cursos.cDescricao');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('Estudantes.Ano_Curricular_id', $ac);
		$this->db->where('Estudantes.turmas_id', $t);
		$this->db->where('Estudantes.semestres_id', $s);

		$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$this->load->model('Mfinancas_pagamentos_confirmacao');
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			list($ano_mat, $mes, $dia) = preg_split('[-]', $row->eData_Matricula); // para coger el ano de matricula
			if($n != 1 || $this->Mfinancas_pagamentos_confirmacao->mExiste_Pagamento($row->cBI_Passaporte,$s) || $ano_mat == date('Y')){
				$nu = $row->id.'-'.$row->cDescricao.'/';
				$this->insert_numero_universitario($row->id,$nu);

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
					"tNome" => $row->tNome,
					"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
					"eData_Matricula" => $row->eData_Matricula,
					"e_num_univ"=> $row->e_num_univ
				);
				$ord++;
			}	
		}
		return $data;
	}

	function mread_est_disc($n,$c,$p,$ac,$t) {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome,
			Estudantes.eEstado_Matricula1');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('Estudantes.Ano_Curricular_id', $ac);
		$this->db->where('Estudantes.turmas_id', $t);

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
				"tNome" => $row->tNome,
				"eEstado_Matricula"=>($row->eEstado_Matricula == "Conf.Mat.Esp.Pag" || $row->eEstado_Matricula == "Conf.Mat.Aceite")?$row->eEstado_Matricula:$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
			);
			$ord++;	
		}
		return $data;
	}

	function mread_conf_mat_financas() {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('Estudantes.eEstado_Matricula', "Conf.Mat.Esp.Pag");
		$this->db->or_where('Estudantes.eEstado_Matricula', "Conf.Mat.Aceite");

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
				"tNome" => $row->tNome,
				"eEstado_Matricula"=>$row->eEstado_Matricula,
				"eData_Matricula" => $row->eData_Matricula,
			);
			$ord++;	
		}
		return $data;
	}
	function mread_mat_financas() {
		$this->db->select('Estudantes.id,Estudantes.eEstado_Matricula1,Estudantes.eData_Matricula,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome as curso,periodos.pNome,
			Ano_Curricular.acNome,
			semestres.sNome,
			turmas.tNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('Estudantes.eEstado_Matricula1', "Mat.Esp.Pag");
		$this->db->or_where('Estudantes.eEstado_Matricula1', "Mat.Aceite");

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
				"tNome" => $row->tNome,
				"eEstado_Matricula1"=>$row->eEstado_Matricula1,
				"eData_Matricula" => $row->eData_Matricula,
			);
			$ord++;	
		}
		return $data;
	}
	function mreadXano_curricular($id) {
		$this->db->select('Ano_Curricular.acNome');
		$this->db->from('Estudantes');
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		//$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		//$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
		$this->db->where('Estudantes.id', $id);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
                return $row->acNome;
		}
	}
	function mreadXano_curricular_id($id) {
		$this->db->select('Ano_Curricular.id');
		$this->db->from('Estudantes');
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		//$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		//$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
		$this->db->where('Estudantes.id', $id);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
                return $row->id;
		}
	}
	function mreadXsemestre($id) {
		$this->db->select('semestres.sNome');
		$this->db->from('Estudantes');
		//$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		//$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
		$this->db->where('Estudantes.id', $id);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
                return $row->sNome;
		}
	}
	//Get_NivelXCandidato_id
	function mGet_NivelXCandidato_id($cid) {
		$this->db->select('niveis.id');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}
	function mGet_Nivel_NomeXCandidato_id($cid) {
		$this->db->select('niveis.nnome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->nnome;
		}
	}
	function mGet_CursoXCandidato_id($cid) {
		$this->db->select('cursos.id');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}
	function mGet_Curso_NomeXCandidato_id($cid) {
		$this->db->select('cursos.cnome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->cnome;
		}
	}
	function mGet_PeriodoXCandidato_id($cid) {
		$this->db->select('periodos.id');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}
	function mGet_Periodo_NomeXCandidato_id($cid) {
		$this->db->select('periodos.pnome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->pnome;
		}
	}
	function mget_nivel_bi($bi) {
		$this->db->select('niveis.nNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->nNome;
		}
	}
	function mget_curso_bi($bi) {
		$this->db->select('cursos.cNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->cNome;
		}
	}
	function mget_periodo_bi($bi) {
		$this->db->select('periodos.pNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->pNome;
		}
	}
	function mget_precio_conf_mat_bi($bi) {
		$this->db->select('ncPreco_Confirmacao');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->ncPreco_Confirmacao;
		}
	}
	function mGet_PeriodoXEstudante_id($bi) {
		$this->db->select('periodos.id');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}

	function mGet_ACXCandidato_id($cid) {
		$this->db->select('Ano_Curricular.id');
		$this->db->from('Estudantes');
        $this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}
	function mGet_AC_NomeXCandidato_id($cid) {
		$this->db->select('Ano_Curricular.acnome');
		$this->db->from('Estudantes');
        $this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->acnome;
		}
	}

	function mGet_TurmaXCandidato_id($cid) {
		$this->db->select('turmas.id');
		$this->db->from('Estudantes');
        $this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}

	function mGet_Turma_NomeXCandidato_id($cid) {
		$this->db->select('turmas.tnome');
		$this->db->from('Estudantes');
        $this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->tnome;
		}
	}

	function mGet_SemestreXCandidato_id($cid) {
		$this->db->select('semestres.id');
		$this->db->from('Estudantes');
        $this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
		}
	}
	function mGet_Semestre_NomeXCandidato_id($cid) {
		$this->db->select('semestres.snome');
		$this->db->from('Estudantes');
        $this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->where('Estudantes.Candidatos_id', $cid);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->snome;
		}
	}

	function Existe($Candidatos_id){
          $this->db->select('id');
          $this->db->from('Estudantes');
          $this->db->where('Candidatos_id', $Candidatos_id);
          if($this->db->count_all_results() > 0)
		  	return true;
		else
			return false;
    }
	function existe_bi($bi){
          $this->db->select('Estudantes.id');
          $this->db->from('Estudantes');
		  $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
		  	return true;
		else
			return false;
    }
	function get_idXcandidatos_id($Candidatos_id){
        $this->db->select('id');
        $this->db->from('Estudantes');
        $this->db->where('Candidatos_id', $Candidatos_id);
		//$this->db->where('niveis_cursos_id', $ncp_id);
        $consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->id;
		}
    }
	function get_id($Candidatos_id,$ncp_id){
        $this->db->select('id');
        $this->db->from('Estudantes');
        $this->db->where('Candidatos_id', $Candidatos_id);
		$this->db->where('niveis_cursos_id', $ncp_id);
        $consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->id;
		}
    }
	function mreadIDxBI($bi){
          $this->db->select('Estudantes.id');
          $this->db->from('Estudantes');
		  $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
                return $value->id;
          }
    }

	function par($num){
		if($num % 2 == 0)
			return true;
		else
			return false;
	}

	function mtranferir_estudante($id,$ac,$s,$td){
		//logica
		if($this->par($s)){
			$s++;
			$ac++;
		}else
			$s++;
		$dados = array('Ano_Curricular_id'=>$ac, 'semestres_id'=>$s, 'turmas_id'=>$td);
		if ($this->db->update('Estudantes', $dados, array('id' => $id))) {
			return true;
		}else
		    return false;
	}

	function mvoltar_estudante($id,$ac,$s,$td){
		//logica
		if($s > 1){ //para evitar que alguien regrese un estudiante de semestre 1 a semestre 0...
			if($this->par($s)){
				$s--;
			}else{
				$s--;
				$ac--;
			}
		}
		$dados = array('Ano_Curricular_id'=>$ac, 'semestres_id'=>$s, 'turmas_id'=>$td);
		if ($this->db->update('Estudantes', $dados, array('id' => $id))) {
			return true;
		}else
		    return false;
	}

	/*    
    *Insertar en la tabla estudiantes los datos:    
    *Candidatos_id    
    *niveis_cursos_id    
    *Data_Matricula    
    */
	function minsert_matricula($Candidatos_id,$n,$c,$p,$turmas_id){
		$niveis_cursos_id = $this->get_ncp_id($n,$c,$p);

		$this->load->model('MAnos_Lectivos');
		$ano_lectivo_id = $this->MAnos_Lectivos->mGetID(date('Y'));
		
		$audData = date("Y/m/d");
        // $audHora = date('H:i:s', time());
		// $this->load->model('MDisciplinas');
		// $this->load->model('MDisciplinas_Estudantes');
		// $this->load->model('MPautas');
        $dados = array('Candidatos_id'=>$Candidatos_id, 'niveis_cursos_id'=>$niveis_cursos_id, 'eData_Matricula'=>$audData, 
					   'eEstado_Matricula1'=>"Mat.Esp.Pag", 'Ano_Curricular_id'=>1, 'semestres_id'=>1, 'turmas_id'=>$turmas_id);
        if ($this->db->insert('Estudantes', $dados)){
			/*
			$Estudantes_id = $this->get_id($Candidatos_id,$niveis_cursos_id);
			//leer las disciplinas del 1 ano curriular
			$contador = 0;
			foreach($this->MDisciplinas->mreadXancp(1,$n,$c,$p) as $value){
				//insertar en disciplinas_estudantes 
				//$this->MDisciplinas_Estudantes->minsert($Estudantes_id,$value->id);
				//crar la pauta con las disciplinas con nota 0 cada una
				//$this->MPautas->minsert($ano_lectivo_id,$Estudantes_id,$value->id,0);
				$contador++;
			}
			*/
			return true;
		}    
        else
            return false;
	}

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
	
	//anular matricula temporalmente
	function mdelete($id) {
		//if($this->db->delete('Estudantes', array('id' => $id)))
		/*
		if()
			return true;
		else
			return false;
		*/
	}
	function cambiar_estado($id,$cEstado){
        $dados = array('eEstado_Matricula'=>$cEstado);
        
        if ($this->db->update('Estudantes', $dados, array('Candidatos_id' => $id))) {
            return true;
        } else
            return false;
    }
	function cambiar_estado_matricula($id,$cEstado){
        $dados = array('eEstado_Matricula1'=>$cEstado);
        
        if ($this->db->update('Estudantes', $dados, array('Candidatos_id' => $id))) {
            return true;
        } else
            return false;
    }
}