<?php

class MProfessores_Disciplinas extends CI_Model {

    function mread() {
        $this->db->select('niveis.nNome,cursos.cNome,periodos.pNome,
                Professores_Disciplinas.id,disciplinas.dNome,disciplinas.dCodigo,Professores_Disciplinas.disciplinas_id,
                Professores_Disciplinas.ProfessorP_id,
                Professores_Disciplinas.ProfessorA1_id,Professores_Disciplinas.ProfessorA2_id,
                Professores_Disciplinas.turmas_id,turmas.tNome,
                anos_lectivos.alAno,Professores_Disciplinas.anos_lectivos_id');
        $this->db->from('Disciplinas');
        $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('turmas', 'Professores_Disciplinas.turmas_id = turmas.id');

        $this->db->join('anos_lectivos', 'Professores_Disciplinas.anos_lectivos_id = anos_lectivos.id');
        $consulta = $this->db->get();
        return $consulta->result();
    }
    //cargar las disciplinas de un prof especifico
    function mread_DiscXProf($id_prof) {
        $this->db->select('Disciplinas.id,Disciplinas.dNome');
        $this->db->from('Disciplinas');
        $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
        $this->db->where('Professores_Disciplinas.ProfessorP_id', $id_prof);
        $consulta = $this->db->get();
        return $consulta->result();
    }

    function mread_ProfXDisc($idd) {
        $this->db->select('Funcionarios.fNome,Funcionarios.fApelido');
        $this->db->from('Funcionarios');
        $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.ProfessorP_id = Funcionarios.id');
        //$this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Funcionarios.id');
        $this->db->where('Professores_Disciplinas.disciplinas_id', $idd);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->fNome.' '.$value->fApelido;
        }
    }

/*
    function mGetID($nome) {
        $this->db->select('Funcionarios.id');
        $this->db->from('Funcionarios');
        $this->db->where('Funcionarios.fNome', $nome);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->id;
        }
    }
 *
 */
    function mGetID($nome,$ape) {
        $this->db->select('Funcionarios.id');
        $this->db->from('Funcionarios');
        $this->db->where('Funcionarios.fNome', $nome);
        $this->db->where('Funcionarios.fApelido', $ape);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->id;
        }
    }
    function mreadX($id) {
        $this->db->select('Funcionarios.fNome,Funcionarios.fApelido');
        $this->db->from('Funcionarios');
        $this->db->where('Funcionarios.id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->fNome . ' ' . $value->fApelido;
        }
    }

    //para relatorio por professores
    function mreadXncpac($nNome, $cNome, $pNome, $acNome) {
        $this->db->select('niveis.nNome,cursos.cNome,periodos.pNome,
                Professores_Disciplinas.id,disciplinas.dNome,disciplinas.dCodigo,Professores_Disciplinas.disciplinas_id,
                Professores_Disciplinas.ProfessorP_id,
                Professores_Disciplinas.ProfessorA1_id,Professores_Disciplinas.ProfessorA2_id,
                Professores_Disciplinas.turmas_id,turmas.tNome');
        $this->db->from('Disciplinas');
        $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('turmas', 'Professores_Disciplinas.turmas_id = turmas.id');
        $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
        $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->where('niveis.nNome', $nNome);
        $this->db->where('cursos.cNome', $cNome);
        $this->db->where('periodos.pNome', $pNome);
        $this->db->where('Ano_Curricular.acNome', $acNome);
        $consulta = $this->db->get();
        return $consulta->result();
    }
    //para segunda tabla de horarios la de abajo
    function mreadXncpact($nNome, $cNome, $pNome, $acNome, $tNome) {
        $this->db->select('niveis.nNome,cursos.cNome,periodos.pNome,
                Professores_Disciplinas.id,disciplinas.dNome,disciplinas.dCodigo,Professores_Disciplinas.disciplinas_id,disciplinas.dQuantidadesHoras,
                Professores_Disciplinas.ProfessorP_id,
                Professores_Disciplinas.ProfessorA1_id,Professores_Disciplinas.ProfessorA2_id,
                Professores_Disciplinas.turmas_id,turmas.tNome');
        $this->db->from('Disciplinas');
        $this->db->join('Professores_Disciplinas', 'Professores_Disciplinas.disciplinas_id = Disciplinas.id');
        $this->db->join('niveis_cursos', 'Disciplinas.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('turmas', 'Professores_Disciplinas.turmas_id = turmas.id');
        $this->db->join('Disciplinas_Ano_Curricular', 'Disciplinas_Ano_Curricular.disciplinas_id = disciplinas.id');
        $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->where('niveis_cursos.niveis_id', $nNome);
        $this->db->where('niveis_cursos.cursos_id', $cNome);
        $this->db->where('niveis_cursos.periodos_id', $pNome);
        $this->db->where('Disciplinas_Ano_Curricular.Ano_Curricular_id', $acNome);
        $this->db->where('Professores_Disciplinas.turmas_id', $tNome);
        $consulta = $this->db->get();
        return $consulta->result();
    }

    function mupdate($id, $alAno, $nNome, $cNome, $pNome, $tNome, $dNome, $PP, $PA1, $PA2) {
        //localizar id de prof
        //$idPP = $this->mGetID($fNomeP, $fApelidoP);
        //$idPA1 = $this->mGetID($fNomeA1, $fApelidoA1);
        //$idPA2 = $this->mGetID($fNomeA2, $fApelidoA2);
        
        $dados = array('disciplinas_id' => $dNome, 'ProfessorP_id' => $PP, 'ProfessorA1_id' => $PA1
            , 'ProfessorA2_id' => $PA2, 'anos_lectivos_id'=>$alAno);
        if ($this->db->update('Professores_Disciplinas', $dados, array('id' => $id))) {
            return true;
        }else
            return false;
    }

    function minsert($alAno, $nNome, $cNome, $pNome, $tNome, $dNome, $ProfessorP, $ProfessorA1, $ProfessorA2) {
        if ($this->db->insert('Professores_Disciplinas', array('disciplinas_id' => $dNome, 'ProfessorP_id' => $ProfessorP,
                    'ProfessorA1_id' => $ProfessorA1, 'ProfessorA2_id' => $ProfessorA2, 'turmas_id' => $tNome,
                    'anos_lectivos_id'=>$alAno))) {
            return true;
        } else {
            return false;
        }
    }

    function mdelete($id) {
        if ($this->db->delete('Professores_Disciplinas', array('id' => $id)))
            return true;
        else
            return false;
    }

    //Insertar automaticamente disciplinas_id en Professores por Disciplinas
    function minsertPD($Disciplinas_id) {
        if ($this->db->insert('Professores_Disciplinas', array('Disciplinas_id' => $Disciplinas_id))) {
            return true;
        } else {
            return false;
        }
    }

}
