<?php

class MHorarios extends CI_Model {

    function mread() {
        $this->db->select('horarios.id,niveis.nNome,niveis_cursos.niveis_id,
                cursos.cNome,niveis_cursos.cursos_id,
                anos_lectivos.alAno,horarios.anos_lectivos_id,
                periodos.pNome,niveis_cursos.periodos_id,
                turmas.tNome,horarios.turmas_id,
                semestres.sNome,horarios.semestres_id,
                Dia_Semana.dsNome,horarios.Dia_Semana_id,
                temposaulas.taNome,horarios.temposaulas_id,
                Disciplinas.dNome
          ');
        $this->db->from('horarios');
        $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Dia_Semana', 'horarios.Dia_Semana_id = Dia_Semana.id');
        $this->db->join('temposaulas', 'horarios.temposaulas_id = temposaulas.id');
        $this->db->join('turmas', 'horarios.turmas_id = turmas.id');
        $this->db->join('Ano_Curricular', 'turmas.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->join('semestres', 'horarios.semestres_id = semestres.id');
        $this->db->join('Disciplinas', 'horarios.Disciplinas_id = Disciplinas.id');
        $this->db->join('anos_lectivos', 'horarios.anos_lectivos_id = anos_lectivos.id');
        $consulta = $this->db->get();
        return $consulta->result();
    }

    /*
      function mreadX($al,$n,$c,$s,$p,$ac,$t,$ses){
      $this->db->select('horarios.id,niveis.nNome,niveis_cursos.niveis_id,
      cursos.cNome,niveis_cursos.cursos_id,
      anos_lectivos.alAno,horarios.anos_lectivos_id,
      periodos.pNome,niveis_cursos.periodos_id,
      turmas.tNome,horarios.turmas_id,
      semestres.sNome,horarios.semestres_id,
      Dia_Semana.dsNome,horarios.Dia_Semana_id,
      temposaulas.taNome,horarios.temposaulas_id,
      sessao.sesNome,horarios.sessao_id,
      Disciplinas.dNome
      ');
      $this->db->from('horarios');
      $this->db->join('niveis_cursos', 'horarios.niveis_cursos_id = niveis_cursos.id');
      $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
      $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
      $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
      $this->db->join('Dia_Semana', 'horarios.Dia_Semana_id = Dia_Semana.id');
      $this->db->join('temposaulas', 'horarios.temposaulas_id = temposaulas.id');
      $this->db->join('turmas', 'horarios.Turmas_id = turmas.id');
      $this->db->join('Ano_Curricular', 'horarios.Ano_Curricular_id = Ano_Curricular.id');
      $this->db->join('semestres', 'horarios.Semestres_id = semestres.id');
      $this->db->join('disciplinas', 'horarios.Disciplinas_id = disciplinas.id');
      $this->db->join('anos_lectivos', 'horarios.Anos_Lectivos_id = anos_lectivos.id');
      $this->db->join('sessao', 'horarios.sessao_id = sessao.id');
      $this->db->where('horarios.anos_lectivos_id', $al);
      $this->db->where('niveis_cursos.niveis_id', $n);
      $this->db->where('niveis_cursos.cursos_id', $c);
      $this->db->where('horarios.Semestres_id', $s);
      $this->db->where('niveis_cursos.periodos_id', $p);
      $this->db->where('horarios.Ano_Curricular_id', $ac);
      $this->db->where('horarios.Turmas_id', $t);
      $this->db->where('horarios.sessao_id', $ses);
      $consulta = $this->db->get();
      return $consulta->result();
      }
     */

    //para horarios1 nueva version
    function mreadX($al, $n, $c, $s, $p, $ac, $t, $ses) {
        $this->db->select('horarios1.id,
                niveis.nNome,niveis_cursos.niveis_id,
                cursos.cNome,niveis_cursos.cursos_id,
                anos_lectivos.alAno,horarios1.anos_lectivos_id,
                periodos.pNome,niveis_cursos.periodos_id,
                turmas.tNome,horarios1.turmas_id,
                semestres.sNome,horarios1.semestres_id,
                
                temposaulas.taNome,horarios1.temposaulas_id,
                sessao.sesNome,horarios1.sessao_id,
                horarios1.f2,horarios1.f3,horarios1.f4,horarios1.f5,horarios1.f6
          ');
        $this->db->from('horarios1');
        $this->db->join('niveis_cursos', 'horarios1.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('Dia_Semana', 'horarios.Dia_Semana_id = Dia_Semana.id');
        $this->db->join('temposaulas', 'horarios1.temposaulas_id = temposaulas.id');
        $this->db->join('turmas', 'horarios1.Turmas_id = turmas.id');
        $this->db->join('Ano_Curricular', 'horarios1.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->join('semestres', 'horarios1.Semestres_id = semestres.id');
        //$this->db->join('disciplinas', 'horarios.Disciplinas_id = disciplinas.id');
        $this->db->join('anos_lectivos', 'horarios1.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('sessao', 'horarios1.sessao_id = sessao.id');
        $this->db->where('horarios1.anos_lectivos_id', $al);
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('horarios1.Semestres_id', $s);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('horarios1.Ano_Curricular_id', $ac);
        $this->db->where('horarios1.Turmas_id', $t);
        $this->db->where('horarios1.sessao_id', $ses);
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    function mGetID($al, $n, $c, $s, $p, $ac, $t, $ses,$ta) {
        $this->db->select('horarios1.id');
        $this->db->from('horarios1');
        $this->db->join('niveis_cursos', 'horarios1.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('Dia_Semana', 'horarios.Dia_Semana_id = Dia_Semana.id');
        $this->db->join('temposaulas', 'horarios1.temposaulas_id = temposaulas.id');
        $this->db->join('turmas', 'horarios1.Turmas_id = turmas.id');
        $this->db->join('Ano_Curricular', 'horarios1.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->join('semestres', 'horarios1.Semestres_id = semestres.id');
        //$this->db->join('disciplinas', 'horarios.Disciplinas_id = disciplinas.id');
        $this->db->join('anos_lectivos', 'horarios1.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('sessao', 'horarios1.sessao_id = sessao.id');
        $this->db->where('horarios1.anos_lectivos_id', $al);
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('horarios1.Semestres_id', $s);
        //$this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('horarios1.Ano_Curricular_id', $ac);
        $this->db->where('horarios1.Turmas_id', $t);
        $this->db->where('horarios1.sessao_id', $ses);
        $this->db->where('horarios1.temposaulas_id', $ta);
        $this->db->where('horarios1.sessao_id', $ses);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->id;
        }
    }
    
    //cargar la disciplina
    function mGetDisciplina($al, $n, $c, $s, $p, $t, $dsN, $ta) {
        $this->db->select('Disciplinas.dNome');
        $this->db->from('horarios');
        $this->db->join('niveis_cursos', 'niveis_cursos.cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Dia_Semana', 'horarios.Dia_Semana_id = Dia_Semana.id');
        $this->db->join('temposaulas', 'horarios.temposaulas_id = temposaulas.id');
        $this->db->join('turmas', 'horarios.turmas_id = turmas.id');
        //$this->db->join('Ano_Curricular', 'turmas.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->join('semestres', 'horarios.semestres_id = semestres.id');
        $this->db->join('Disciplinas', 'horarios.Disciplinas_id = Disciplinas.id');
        $this->db->join('anos_lectivos', 'horarios.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('horarios.anos_lectivos_id', $al);
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('horarios.semestres_id', $s);
        $this->db->where('periodos.id', $p);
        //$this->db->where('Ano_Curricular.id', $ac);
        $this->db->where('turmas.id', $t);
        $this->db->where('Dia_Semana.dsNumero', $dsN);
        $this->db->where('horarios.temposaulas_id', $ta);
        $consulta = $this->db->get();
        //return $consulta->result();
        foreach ($consulta->result() as $value) {
            return $value->dNome;
        }
    }

    public function totalNiveisCursos() {
        $this->db->select('niveis_cursos.id');
        $this->db->from('niveis_cursos');
        return $this->db->count_all_results();
    }

    function existe($cursos_id, $niveis_id) {
        $this->db->select('cursos_id,niveis_id');
        $this->db->from('niveis_cursos');
        $this->db->where('niveis_cursos.cursos_id', $cursos_id);
        $this->db->where('niveis_cursos.niveis_id', $niveis_id);
        if ($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }

    //coger id de niveis_cursos
    function getIDnc($cursos_id, $niveis_id) {
        $this->db->select('niveis_cursos.id');
        $this->db->from('niveis_cursos');
        $this->db->where('niveis_cursos.cursos_id', $cursos_id);
        $this->db->where('niveis_cursos.niveis_id', $niveis_id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->id;
        }
    }

    function mupdate($al, $n, $c, $s, $p, $ac, $t, $ses, $daNome, $taNome, $dNome) {
        if ($this->existe($c, $n)) {
            $nc_id = $this->getIDnc($c, $n);
            $horario_id = $this->mGetID($al, $n, $c, $s, $p, $ac, $t, $ses,$taNome);
            if ($daNome == '1') {
                $dados = array('anos_lectivos_id' => $al, 'niveis_cursos_id' => $nc_id, 'semestres_id' => $s,
                    'Ano_Curricular_id' => $ac, 'turmas_id' => $t, 'sessao_id' => $ses,
                    'temposaulas_id' => $taNome, 'f2' => $dNome);
            }elseif($daNome == '2'){
                $dados = array('anos_lectivos_id' => $al, 'niveis_cursos_id' => $nc_id, 'semestres_id' => $s,
                    'Ano_Curricular_id' => $ac, 'turmas_id' => $t, 'sessao_id' => $ses,
                    'temposaulas_id' => $taNome, 'f3' => $dNome);
            }elseif($daNome == '3'){
                $dados = array('anos_lectivos_id' => $al, 'niveis_cursos_id' => $nc_id, 'semestres_id' => $s,
                    'Ano_Curricular_id' => $ac, 'turmas_id' => $t, 'sessao_id' => $ses,
                    'temposaulas_id' => $taNome, 'f4' => $dNome);
            }elseif($daNome == '4'){
                $dados = array('anos_lectivos_id' => $al, 'niveis_cursos_id' => $nc_id, 'semestres_id' => $s,
                    'Ano_Curricular_id' => $ac, 'turmas_id' => $t, 'sessao_id' => $ses,
                    'temposaulas_id' => $taNome, 'f5' => $dNome);
            }elseif($daNome == '5'){
                $dados = array('anos_lectivos_id' => $al, 'niveis_cursos_id' => $nc_id, 'semestres_id' => $s,
                    'Ano_Curricular_id' => $ac, 'turmas_id' => $t, 'sessao_id' => $ses,
                    'temposaulas_id' => $taNome, 'f6' => $dNome);
            }
            if ($this->db->update('horarios1', $dados, array('id' => $horario_id))) {
                return true;
            } else
                return false;
        } else
            return FALSE;
    }

    function minsert($al, $n, $c, $s, $p, $ac, $t, $ses, $ta, $d) {
        if ($this->existe($c, $n)) {
            $nc_id = $this->getIDnc($c, $n);
            $dados = array('anos_lectivos_id' => $al, 'Turmas_id' => $t, 'Semestres_id' => $s,
                'f2' => $d, 'f3' => $d, 'f4' => $d, 'f5' => $d, 'f6' => $d,
                'niveis_cursos_id' => $nc_id, 'temposaulas_id' => $ta, 'Ano_Curricular_id' => $ac, 'sessao_id' => $ses);
            if ($this->db->insert('horarios1', $dados)) {
                return true;
            } else
                return false;
        }
    }

    function mdelete($idt) {
        if ($this->db->delete('horarios1', array('Turmas_id' => $idt)))
            return true;
        else
            return false;
    }

}

?>
