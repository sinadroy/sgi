<?php
  class Mestatisticas extends CI_Model{
     ///////por escola de formacao 
    function mGet_total_X_efID($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');

        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.candidatos_id = candidatos.id');
        $this->db->join('Escola_Formacao', 'Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');

        if($id)
            $this->db->where('Escola_Formacao.id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mestudantes_x_ef($al,$al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id,efCodigoNome');
            $this->db->from('Escola_Formacao');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($this->mGet_total_X_efID($row->id,$al,$n,$c,$p) > 0){
                    $data[] = array(
                        "id" => $row->id,
                        "efCodigoNome"=> $row->efCodigoNome,
                        "quantidade" => $this->mGet_total_X_efID($row->id,$al,$n,$c,$p),
                        "color" => "#36abee"//:"#ee9e36",
                    );
                }
            }
            return $data;
    }
    
    /////// por provincias de formacao
    function mGet_total_X_pfID($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');

        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.candidatos_id = candidatos.id');
        $this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');

        if($id)
            $this->db->where('Provincias.id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mestudantes_x_pf($al,$al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id,provCodigoNome');
            $this->db->from('Provincias');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($this->mGet_total_X_pfID($row->id,$al,$n,$c,$p) > 0){
                    $data[] = array(
                        "id" => $row->id,
                        "provCodigoNome"=> $row->provCodigoNome,
                        "quantidade" => $this->mGet_total_X_pfID($row->id,$al,$n,$c,$p),
                        "color" => "#ee9e36"
                    );
                }
            }
            return $data;
    }
    
    function mGet_total_X_periodo_mat($id,$al){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        //$this->db->join('cursos_pretendidos', 'cursos_pretendidos.Candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('anos_lectivos.alAno', $al);
        $this->db->where('periodos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mGet_total_X_periodo_estadistica_mat($al){
        $al = ($al != "")?$al:date('Y');
        $this->db->select('periodos.id,periodos.pNome');
        $this->db->from('periodos');
        //$this->db->where('cursos.id', $Nome);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            $data[] = array(
              "id" => $row->id,
              "periodo"=> $row->pNome,
              "quantidade" => $this->mGet_total_X_periodo_mat($row->id,$al),
              "color" => ($row->pNome == "regular")?"#36abee":"#ee9e36",
          );
        }
        return $data;
    }

    function mGet_total_X_curso_mat($id,$al){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        //$this->db->join('cursos_pretendidos', 'cursos_pretendidos.Candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis_cursos', 'cursos_pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('anos_lectivos.alAno', $al);
        $this->db->where('cursos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_x_curso_estatisticas_mat($al){
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
              "quantidade" => $this->mGet_total_X_curso_mat($row->id,$al),
              "color" => "#e33fc7",
          );
        }
        return $data;
    }

    function mGet_total_X_efID_mat($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        //$this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');

        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.candidatos_id = candidatos.id');
        $this->db->join('Escola_Formacao', 'Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');

        if($id)
            $this->db->where('Escola_Formacao.id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mestudantes_x_ef_mat($al,$al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id,efCodigoNome');
            $this->db->from('Escola_Formacao');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($this->mGet_total_X_efID($row->id,$al,$n,$c,$p) > 0){
                    $data[] = array(
                        "id" => $row->id,
                        "efCodigoNome"=> $row->efCodigoNome,
                        "quantidade" => $this->mGet_total_X_efID_mat($row->id,$al,$n,$c,$p),
                        "color" => "#36abee"//:"#ee9e36",
                    );
                }
            }
            return $data;
    }

    function mGet_total_X_sexoID_mat($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        //$this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        if($id)
            $this->db->where('candidatos.generos_id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    //para estatisticas
    function mestudantes_x_sexo_mat($al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id, gNome, gCodigo');
            $this->db->from('Generos');
            //$this->db->join('Generos', 'candidatos.Generos_id = candidatos.id');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($row->gCodigo != 0){
                    $data[] = array(
                        "id" => $row->id,
                        "sexo"=> $row->gNome,
                        "quantidade" => $this->mGet_total_X_sexoID_mat($row->id,$al,$n,$c,$p),
                        "color" => ($row->id == 2)?"#36abee":"#ee9e36",
                    );
                }
            }
            return $data;
    }

    /////// por provincias de formacao
    function mGet_total_X_pfID_mat($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        //$this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');

        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.candidatos_id = candidatos.id');
        $this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');

        if($id)
            $this->db->where('Provincias.id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mestudantes_x_pf_mat($al,$al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id,provCodigoNome');
            $this->db->from('Provincias');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($this->mGet_total_X_pfID($row->id,$al,$n,$c,$p) > 0){
                    $data[] = array(
                        "id" => $row->id,
                        "provCodigoNome"=> $row->provCodigoNome,
                        "quantidade" => $this->mGet_total_X_pfID_mat($row->id,$al,$n,$c,$p),
                        "color" => "#ee9e36"
                    );
                }
            }
            return $data;
    }

    //Disciplina/Aproveitamento

    function mget_total_matriculados_disciplinas($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Pautas.id) as total ');
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
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_matriculados_femeninos($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Pautas.id) as total ');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Generos.gNome', 'Femenino');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_matriculados_masculinos($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Pautas.id) as total ');
		$this->db->from('Pautas');
        $this->db->join('Estudantes', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Generos.gNome', 'Masculino');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    //aprovados
    function mget_total_matriculados_aprovados($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Aprovado');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_matriculados_reprovados($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Reprovado');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    
    function maproveitamento($n,$c,$p,$al,$d,$g){
        $a[0] = 'Matriculados';
        $a[1] = 'Femenino';
        $a[2] = 'Masculino';
        $a[3] = 'Aprovados';
        $a[4] = 'Reprovados';
        $valor = 0;
        foreach ($a as $key => $value) {
            switch ($key) {
                case '0':
                    $valor = $this->mget_total_matriculados_disciplinas($n,$c,$p,$al,$d,$g);
                    break;
                case '1':
                    $valor = $this->mget_total_matriculados_femeninos($n,$c,$p,$al,$d,$g);
                    break;
                case '2':
                    $valor = $this->mget_total_matriculados_masculinos($n,$c,$p,$al,$d,$g);
                    break;
                case '3':
                    $valor = $this->mget_total_matriculados_aprovados($n,$c,$p,$al,$d,$g);
                    break;
                case '4':
                    $valor = $this->mget_total_matriculados_reprovados($n,$c,$p,$al,$d,$g);
                    break;
                default:
                    $valor = 0;
                    break;
            }

            $data[] = array(
                'ord' => $key++,
                'nome' => $value,
                'valor' => $valor
            );
        }
        return $data;
    }

    //Relatorios
    function mget_total_matriculados_reprovados_mas($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Reprovado');
        $this->db->where('Generos.gNome', 'Masculino');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_matriculados_reprovados_fem($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Reprovado');
        $this->db->where('Generos.gNome', 'Femenino');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }

    function mget_total_matriculados_aprovados_mas($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Aprovado');
        $this->db->where('Generos.gNome', 'Masculino');
        //$this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    function mget_total_matriculados_aprovados_fem($n,$c,$p,$al,$d,$g) {
		$this->db->select('count(Estudantes.id) as total ');
		$this->db->from('Estudantes');
        $this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
		$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('anos_lectivos.id', $al);
		$this->db->where('Disciplinas.id', $d);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->where('Pautas.estado', 'Aprovado');
        $this->db->where('Generos.gNome', 'Femenino');
		$consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    
    function mget_disciplinas_relatorio($al,$n,$c,$p,$ac,$g) {
		$this->db->select('Disciplinas.id,Disciplinas.dNome');
        $this->db->from('Disciplinas');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = Disciplinas.id');
        $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');

        $this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
        $this->db->where('Ano_Curricular.id', $ac);
        $this->db->where('Disciplinas.d_geracao_id', $g);
        $this->db->order_by('dNome','ASC');
        $consulta = $this->db->get();
        $ord = 1;
        $data = array();
        foreach($consulta->result() as $row) {
            $d = $row->id;
            $data[] = array(
                'ord' => $ord,
                'id' => $row->id,
                'dnome' => $row->dNome,
                //matriculados
                'mas1' => $this->mget_total_matriculados_masculinos($n,$c,$p,$al,$d,$g),
                'fem1' => $this->mget_total_matriculados_femeninos($n,$c,$p,$al,$d,$g),
                'total1' => $this->mget_total_matriculados_disciplinas($n,$c,$p,$al,$d,$g),
                //Reprovados
                'mas2' => $this->mget_total_matriculados_reprovados_mas($n,$c,$p,$al,$d,$g),
                'fem2' => $this->mget_total_matriculados_reprovados_fem($n,$c,$p,$al,$d,$g),
                'total2' => $this->mget_total_matriculados_reprovados($n,$c,$p,$al,$d,$g),
                //Aprovados
                'mas3' => $this->mget_total_matriculados_aprovados_mas($n,$c,$p,$al,$d,$g),
                'fem3' => $this->mget_total_matriculados_aprovados_fem($n,$c,$p,$al,$d,$g),
                'total3' => $this->mget_total_matriculados_aprovados($n,$c,$p,$al,$d,$g),
            );
            $ord++;
        }
        return $data;
    }
    
    //read for year old
    function mread_ii_total_iidades($al,$n,$c,$p, $ii, $if){
        $this->load->model('mcandidatos');
        $this->db->select('candidatos.id, candidatos.cData_Nascimento');
        $this->db->from('candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        if($al)
            $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $contador = 0;
        foreach($consulta->result() as $row) {
            $idade = $this->mcandidatos->calculaEdad($row->cData_Nascimento);
            if($idade >= $ii && $idade <= $if){
                $contador++;
            }
        }
        return $contador;
    }

    /*
     * Datos estatisticas idade.
    */
    function mread_ii($al,$n,$c,$p) {
        //intervalos de idades 18, 19-23, 24-28, 29-33, 34-39, 40-100
        $total[1] = $this->mread_ii_total_iidades($al,$n,$c,$p, 0, 18);
        $total[2] = $this->mread_ii_total_iidades($al,$n,$c,$p, 19, 23);
        $total[3] = $this->mread_ii_total_iidades($al,$n,$c,$p, 24, 28);
        $total[4] = $this->mread_ii_total_iidades($al,$n,$c,$p, 29, 33);
        $total[5] = $this->mread_ii_total_iidades($al,$n,$c,$p, 34, 39);
        $total[6] = $this->mread_ii_total_iidades($al,$n,$c,$p, 40, 100);

        $ii[1] = '18';
        $ii[2] = '19-23';
        $ii[3] = '24-28';
        $ii[4] = '29-33';
        $ii[5] = '34-39';
        $ii[6] = '40-100';

        for($i = 1; $i < 6; $i++){
            $data[] = array(
                'ord' => $i,
                'ii' => $ii[$i],
                'total' => $total[$i]
            );
            
        }
        return $data;
    }

    //para matriculados

    function extraer_ano_matricula($ide){
        $this->db->select('Estudantes.eData_Matricula');
        $this->db->from('Estudantes');
        $this->db->where('id', $ide);
        $consulta = $this->db->get();
        $data = '';
        foreach($consulta->result() as $row) {
            $data = $row->eData_Matricula;
        }
        $pedazo = explode("-", $data);
        return $pedazo[0];
    }

    //read for year old
    function mread_ii_total_iidades_matriculados($al,$n,$c,$p, $ii, $if){
        $this->load->model('mcandidatos');
        $this->db->select('Estudantes.id, candidatos.cData_Nascimento');
        $this->db->from('Estudantes');
        //$this->db->join('Pautas', 'Pautas.Estudantes_id = Estudantes.id');
		$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		//$this->db->join('Disciplinas', 'Pautas.Disciplinas_id = Disciplinas.id');
        //$this->db->join('anos_lectivos', 'Pautas.Anos_Lectivos_id = anos_lectivos.id');
		$this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        if($n)
            $this->db->where('niveis.id', $n);
        if($c)
            $this->db->where('cursos.id', $c);
        if($p)
		    $this->db->where('periodos.id', $p);
        $consulta = $this->db->get();
        $contador = 0;
        foreach($consulta->result() as $row) {
            $idade = $this->mcandidatos->calculaEdad($row->cData_Nascimento);
            if($idade >= $ii && $idade <= $if){
                if($al != "" && $al == $this->extraer_ano_matricula($row->id)){
                    $contador++;
                }
            }
        }
        return $contador;
    }

    /*
     * Datos estatisticas idade.
    */
    function mread_ii_matriculados($al,$n,$c,$p) {
        //intervalos de idades 18, 19-23, 24-28, 29-33, 34-39, 40-100
        $total[1] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 0, 18);
        $total[2] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 19, 23);
        $total[3] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 24, 28);
        $total[4] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 29, 33);
        $total[5] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 34, 39);
        $total[6] = $this->mread_ii_total_iidades_matriculados($al,$n,$c,$p, 40, 100);

        $ii[1] = '18';
        $ii[2] = '19-23';
        $ii[3] = '24-28';
        $ii[4] = '29-33';
        $ii[5] = '34-39';
        $ii[6] = '40-100';

        for($i = 1; $i < 6; $i++){
            $data[] = array(
                'ord' => $i,
                'ii' => $ii[$i],
                'total' => $total[$i]
            );
            
        }
        return $data;
    }
}
?>
