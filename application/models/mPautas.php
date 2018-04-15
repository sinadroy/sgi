<?php
class MPautas extends CI_Model {
	
	function mread() {
		$this->db->select('Pautas.id,Pautas.pp1,Pautas.pp2,Pautas.pp3,Pautas.ef,Pautas.recurso,Pautas.especial,Pautas.estado,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Disciplinas.id as did,Disciplinas.dNome');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
        $this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
          return $consulta->result();
	}
	// para declaracao com notas
	function mread_resultXncpac_est($n,$c,$p,$eid,$ac) {
		$this->db->select('disciplinas.id, disciplinas.dNome, disciplinas.dCodigo, 
			pautas.pp1, pautas.pp2, pautas.pp3, pautas.ef, pautas.recurso, pautas.especial, 
			estudantes.id as eid, anos_lectivos.alAno, Disciplinas.d_geracao_id, Disciplinas_Duracao.ddNome');
		$this->db->from('Pautas');
		$this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.Disciplinas_id = disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
		$this->db->where('niveis_id', $n);
		$this->db->where('cursos_id', $c);
		$this->db->where('periodos_id', $p);
		$this->db->where('estudantes.id', $eid);
		$this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $ac);
        $this->db->order_by('dNome','ASC');
		$consulta = $this->db->get();
		$arr = array();
		$ord = 1;
		foreach($consulta->result() as $row){
            $arr[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "dNome" => $row->dNome,
				"dCodigo" => $row->dCodigo,
				"pp1" => $row->pp1,
				"pp2" => $row->pp2,
				"pp3" => $row->pp3,
                "ef" => $row->ef,
                "recurso" => $row->recurso,
                "especial" => $row->especial,
				"eid" => $row->eid,
				"alAno" => $row->alAno,
				"d_geracao_id" => $row->d_geracao_id,
				"ddNome" => $row->ddNome
			);
            $ord++;
		}
		return $arr;
	}

	function mreadXdisciplina($n,$c,$p,$al,$d,$g) {
		$this->db->select('Pautas.id,Pautas.pp1,Pautas.pp2,Pautas.pp3,Pautas.ef,Pautas.recurso,Pautas.especial,Pautas.estado,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Disciplinas.id as did,Disciplinas.dNome, Disciplinas.d_geracao_id');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		//$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
		$this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        return $consulta->result();
	}
	function mreadXdisciplina_login_pautas($n,$c,$p,$al,$d) {
		$this->db->select('Pautas.id,Pautas.pp1,Pautas.pp2,Pautas.pp3,Pautas.ef,Pautas.recurso,Pautas.especial,Pautas.estado,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Disciplinas.id as did,Disciplinas.dNome, Disciplinas.dCodigo');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		//$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->where('niveis.nNome', $n);
		$this->db->where('cursos.cNome', $c);
		$this->db->where('periodos.pNome', $p);
		$this->db->where('anos_lectivos.alAno', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        return $consulta->result();
	}

	function mresultado_estudante_disciplina($bi,$idd){
		$this->db->select('Pautas.estado');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->where('Candidatos.cbi_passaporte', $bi);
		$this->db->where('Disciplinas.id', $idd);
		$consulta = $this->db->get();
		$data = array();
		foreach ($consulta->result() as $row) {
			if($row->estado)
				return $row->estado;
			else
				return 'Reprovado';		
		}
	}

	//verificar si existe una entrada en disciplinas_estudantes
      function mexiste_est($bi,$idd){
        $this->db->select('id');
        $this->db->from('pautas');
        $this->db->join('Estudantes','pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','pautas.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('pautas.Disciplinas_id', $idd);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
      }
	  //
	  function multimo_ano_lec($bi,$idd){
		    $this->db->select('ano_activacao');
			$this->db->from('Disciplinas_Estudantes');
			$this->db->join('Estudantes','Disciplinas_Estudantes.Estudantes_id = Estudantes.id');
        	$this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        	$this->db->join('Disciplinas','Disciplinas_Estudantes.Disciplinas_id = Disciplinas.id');
			$this->db->where('Candidatos.cBI_Passaporte', $bi);
			$this->db->where('Disciplinas_Estudantes.Disciplinas_id', $idd);
			$consulta = $this->db->get();
			foreach ($consulta->result() as $row) {
				return $row->ano_activacao;	
			}
	  }

	  function mrepeticoes($bi,$idd){
        $this->db->select('id');
        $this->db->from('pautas');
        $this->db->join('Estudantes','pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','pautas.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('pautas.Disciplinas_id', $idd);
        return $this->db->count_all_results();
      }

	  function mread_estado_est_disc($ide,$idd){
        $this->db->select('Pautas.estado');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
        //$this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->where('Pautas.Estudantes_id', $ide);
        $this->db->where('Pautas.Disciplinas_id', $idd);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			return $row->estado;	
		}
      }
	  function calcula_porciento($total, $porciento){
		  /*
		  * 30 ---> 100%
		  * ?  ---> 60
		  * parte = (total * porciento) / 100
		  */ 
		/*  $x = $porciento/100;
		  $parte = $total * $x;
		  //echo $parte.'<br>';
		*/
		$parte = ($total * $porciento) / 100;
		  return $parte;
	  }
	  function mdeterminar_estado($d_geracao_id,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial){
        /*
			- Se selecionas Anual como duração tem que inserir o porcento de todas as avaliações, 
			- se se selecciona Semestral se desabilita a terceira avaliação ja que neste caso são so 2.
			- Se se coloca 100% a uma avaliação se interpreta como que é nota seca e não depende de nenhuma outra.
			- Se se coloca deja 0% significa que esa nota não será utilizada, exemplo uma disciplina de curta duração que so tenha uma parcelar e um exame final nesse caso fica a 2da e terceira avaliação em 0, a 1ra pode ser 60% e o exame final 40%.
			- Se alguma nota de Exame Final, Recurso ou Outra tem um porcento diferente de 0 ou de 100 o sistema vai somar os porcento dessa nota com o porcento das parcelares que estem activas.
		*/
		$this->load->model('mpautas_configuracao');
		$pc_pp1 = $this->mpautas_configuracao->mGet_Porcento_pp1($d_geracao_id, $td);
		$pc_pp2 = $this->mpautas_configuracao->mGet_Porcento_pp2($d_geracao_id, $td);
		$pc_pp3 = $this->mpautas_configuracao->mGet_Porcento_pp3($d_geracao_id, $td);
		$pc_ef = $this->mpautas_configuracao->mGet_Porcento_ef($d_geracao_id, $td);
		$pc_recurso = $this->mpautas_configuracao->mGet_Porcento_recurso($d_geracao_id, $td);
		$pc_especial = $this->mpautas_configuracao->mGet_Porcento_especial($d_geracao_id, $td);
		
		//$a = @intval($pp1,10);
		//$b = intval($pc_pp1,10);
		$parte_pp1 = $this->calcula_porciento($pp1, $pc_pp1);
		//$parte_pp1 = @$this->calcula_porciento(10, 20);
		//echo $parte_pp1.' = total: '.$pp1.', porciento: '.$pc_pp1;
		$parte_pp2 = $this->calcula_porciento($pp2, $pc_pp2);
		$parte_pp3 = $this->calcula_porciento($pp3, $pc_pp3);
		$mp = $parte_pp1 + $parte_pp2 + $parte_pp3;
		$parte_ef = $this->calcula_porciento($ef, $pc_ef);
		$mf = round(($mp + $parte_ef),1);
		//echo $mp.'<br>';
		//si etapa de exame final
		if($recurso == 0 && $especial == 0){ //si la nota a procesar es ef
			if($mf >= 9.5)
				return "Aprovado";
			else
				return "Reprovado";
		}

		//si porciento recurso es > 0 y < 100 significa que no es nota seca, se suma todo
		if($recurso != 0 && $especial == 0){ //si la nota a procesar es recurso
			//echo '<br>'.$pc_recurso.'<br>';
			if($pc_recurso > 0 && $pc_recurso < 100){ //si recurso no es nota seca
				
				$parte_recurso = $this->calcula_porciento($recurso, $pc_recurso);
				$mf = round(($mp + $parte_recurso),1);
				if($mf >= 9.5)
					return "Aprovado";
				else
					return "Reprovado";
			}else{ //si recurso es nota seca
				//echo $recurso;
				if($recurso >= 9.5){
					//echo "entro";
					return "Aprovado";
				}
				else
					return "Reprovado";
			}
		}
		
		//si porciento especial es > 0 y < 100 significa que no es nota seca, se suma todo
		if($especial != 0){
			if($pc_especial > 0 && $pc_especial < 100){ //si especial no es nota seca
				$parte_especial = $this->calcula_porciento($especial, $pc_especial);
				$mf = $mp + $parte_especial;
				if($mf > 9.5)
					return "Aprovado";
				else
					return "Reprovado";
			}else{ //si especial es nota seca
				if($especial > 9.5)
					return "Aprovado";
				else
					return "Reprovado";
			}
		}
     }
	
	 function mdeterminar_nota_final($d_geracao_id,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial){
        $this->load->model('mpautas_configuracao');
		$pc_pp1 = $this->mpautas_configuracao->mGet_Porcento_pp1($d_geracao_id, $td);
		$pc_pp2 = $this->mpautas_configuracao->mGet_Porcento_pp2($d_geracao_id, $td);
		$pc_pp3 = $this->mpautas_configuracao->mGet_Porcento_pp3($d_geracao_id, $td);
		$pc_ef = $this->mpautas_configuracao->mGet_Porcento_ef($d_geracao_id, $td);
		$pc_recurso = $this->mpautas_configuracao->mGet_Porcento_recurso($d_geracao_id, $td);
		$pc_especial = $this->mpautas_configuracao->mGet_Porcento_especial($d_geracao_id, $td);
		
		$parte_pp1 = $this->calcula_porciento($pp1, $pc_pp1);
		$parte_pp2 = $this->calcula_porciento($pp2, $pc_pp2);
		$parte_pp3 = $this->calcula_porciento($pp3, $pc_pp3);
		$mp = $parte_pp1 + $parte_pp2 + $parte_pp3;
		$parte_ef = $this->calcula_porciento($ef, $pc_ef);
		$mf = $mp + $parte_ef;
		
		return $mf;
     }

	/*    
    *Insertar en la tabla estudiantes los datos:    
    *Candidatos_id    
    *niveis_cursos_id    
    *Data_Matricula    
    */
	function minsert($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado){
		//
		//$this->load->model('MAuditorias_Academicas');


        $dados = array('Anos_Lectivos_id'=>$Anos_Lectivos_id,'Estudantes_id'=>$Estudantes_id, 'Disciplinas_id'=>$Disciplinas_id, 
			'pp1'=>$pp1,'pp2'=>$pp2,'pp3'=>$pp3,'ef'=>$ef,'recurso'=>$recurso,'especial'=>$especial,'estado'=>$estado);
        if ($this->db->insert('Pautas', $dados)){
            //$this->MAuditorias_Academicas->minsert("Inserir:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Inserido com sucesso');
			return true;

		}
        else
            return false;
	}
	/*
	* ver si existe candidato/estudante/pauta
	*/
	function existe_candidato_estudante_pauta($ide,$idd,$aid){
        //ver id de una disc apartir del codigo
	/*	$this->db->select('id');
		$this->db->from('Disciplinas');
		$this->db->where('dCodigo', $disc_codigo);
		$consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
			$idd = $row->id;	
		}
		*/
		//ver ano id apartir de alnome
		/*$this->load->model('mAnos_Lectivos');
		$ano_lectivo_id = $this->mAnos_Lectivos->mGetID($ano_lectivo);
		*/
		//
		$this->db->select('id');
        $this->db->from('pautas');
        $this->db->join('Estudantes','pautas.Estudantes_id = Estudantes.id');
        //$this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','pautas.Disciplinas_id = Disciplinas.id');
        //$this->db->where('Candidatos.cBI_Passaporte', $bi);
		$this->db->where('Estudantes.id', $ide);
        $this->db->where('pautas.Disciplinas_id', $idd);
		$this->db->where('pautas.Anos_Lectivos_id', $aid);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }
	/*
    *******Actualizar pp1
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_pp1($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			
			$dados = array('pp1'=>$pp1);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
					$this->load->model('MAuditorias_Academicas');
					$this->MAuditorias_Academicas->minsert("Update:Pauta:pp1","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', pp1='.$pp1);
				return true;
			}else
				return false;
		}else
			return false;
	}
	/*
    *******Actualizar pp2
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_pp2($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp2,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('pp2'=>$pp2);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				$this->load->model('MAuditorias_Academicas');
				$this->MAuditorias_Academicas->minsert("Update:Pauta:pp2","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', pp2='.$pp2);
				return true;
			}else
				return false;
		}else
			return false;
	}
	/*
    *******Actualizar pp3
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_pp3($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp3,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('pp3'=>$pp3);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				$this->load->model('MAuditorias_Academicas');
				$this->MAuditorias_Academicas->minsert("Update:Pauta:pp3","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', pp3='.$pp3);
				return true;
			}else
				return false;
		}else
			return false;
	}
	/*
    *******Actualizar ef
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_ef($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$ef,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('ef'=>$ef);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				$this->load->model('MAuditorias_Academicas');
				$this->MAuditorias_Academicas->minsert("Update:Pauta:ef","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', ef='.$ef);
				return true;
			}else
				return false;
		}else
			return false;
	}
	/*
    *******Actualizar recurso
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_recurso($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$recurso,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('recurso'=>$recurso);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				$this->load->model('MAuditorias_Academicas');
				$this->MAuditorias_Academicas->minsert("Update:Pauta:recurso","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', recurso='.$recurso);
				return true;
			}else
				return false;
		}else
			return false;
	}
	/*
    *******Actualizar especial
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_especial($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$especial,$bi,$username) {
		//obt disc nome
		$this->load->model('mdisciplinas');
		$dnome = $this->mdisciplinas->mreadX($Disciplinas_id);
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('especial'=>$especial);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				$this->load->model('MAuditorias_Academicas');
				$this->MAuditorias_Academicas->minsert("Update:Pauta:especial","Professores","Pautas",$username,"Excel import: Est.ID:".$Estudantes_id.', Est.BI: '.$bi.' Disc='.$dnome.', especial='.$especial);
				return true;
			}else
				return false;
		}else
			return false;
	}
	
	/*
    *******Actualizar especial
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Actualizar dados
	* 3- Registrar em auditorias.
    */
	function mupdate_estado($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$estado) {
		//1
		if($this->existe_candidato_estudante_pauta($Estudantes_id,$Disciplinas_id,$Anos_Lectivos_id)){
			//2
			$dados = array('estado'=>$estado);
			if ($this->db->update('Pautas', $dados, array('Anos_Lectivos_id'=>$Anos_Lectivos_id, 'Estudantes_id'=>$Estudantes_id, 
				'Disciplinas_id'=>$Disciplinas_id))) {
				return true;
			}else
				return false;
		}else
			return false;
	}

	function mread_valor_actual($id,$ta,$nv) {
		$this->db->select('id, '.$ta.','.$ta.'_data_upd');
		$this->db->from('Pautas');
		$this->db->where('id', $id);
		$consulta = $this->db->get();
		foreach($consulta->result() as $row){
			//echo $row->$ta;
			
			if($row->$ta.'_data_upd' == null || $row->$ta.'_data_upd' == '' || $row->$ta == 0)
				return true;
			elseif($row->$ta.'_data_upd' != null && $nv == $row->$ta)
				return true;
			elseif($row->$ta.'_data_upd' != null && $row->$ta == 0)
				return true;
			else
				return false;
			
        }
	}

	function mupdate($id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado,$usuario,$dnome,$enome) {
		$data = date('Y-m-d');
		$dados = array('pp1'=>$pp1,
						'pp1_data_upd'=>$data,
						'pp2'=>$pp2,
						'pp2_data_upd'=>$data,
						'pp3'=>$pp3,
						'pp3_data_upd'=>$data,
						'ef'=>$ef,
						'ef_data_upd'=>$data,
						'recurso'=>$recurso,
						'recurso_data_upd'=>$data,
						'especial'=>$especial,
						'especial_data_upd'=>$data,
						'estado'=>$estado);
		if ($this->db->update('Pautas', $dados, array('id' => $id))) {
			$this->load->model('MAuditorias_Academicas');
			$this->MAuditorias_Academicas->minsert("Update:Pauta","Professores","Pautas",$usuario,"PautaID:".$id.', Disc='.$dnome.', Est='.$enome.', pp1='.$pp1.', pp2='.$pp2.', pp3='.$pp3.', ef='.$ef.', recurso='.$recurso.', Outra='.$especial.', estado='.$estado);
			return true;
		}else
		    return false;
	}
	
	function mcancelar_matricula_disciplina($ide,$idd) {
		if($this->db->delete('Pautas', array('Estudantes_id' => $ide, 'Disciplinas_id' => $idd)))
			return true;
		else
			return false;
	}

	function mdelete($id) {
		if($this->db->delete('Pautas', array('id' => $id)))
			return true;
		else
			return false;
	}
}