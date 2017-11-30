<?php
  class Macademica_estudantes_disciplinas extends CI_Model{
      
      function mread_lista(){
          $this->db->select('disciplinas_estudantes.id,disciplinas_estudantes.estudantes_id,disciplinas_estudantes.disciplinas_id,
                disciplinas.dnome, disciplinas.dquantidadeshoras, disciplinas.dprecedencia1_id, disciplinas.dprecedencia2_id, disciplinas.dprecedencia3_id,
                disciplinas.destado, 
                disciplinas_duracao.ddnome,
                candidatos.cnome, candidatos.cnomes, candidatos.capelido, candidatos.cbi_passaporte,
                niveis.nnome, cursos.cnome as curso, periodos.pnome');
          $this->db->from('disciplinas_estudantes');
          $this->db->join('disciplinas','disciplinas_estudantes.disciplinas_id = disciplinas.id');
          $this->db->join('disciplinas_duracao','disciplinas.disciplinas_duracao_id = disciplinas_duracao.id');
          $this->db->join('estudantes','disciplinas_estudantes.estudantes_id = estudantes.id');
          $this->db->join('candidatos','estudantes.candidatos_id = candidatos.id');
          $this->db->join('niveis_cursos','estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "dnome" => $row->dnome,
                        "dquantidadeshoras" => $row->dquantidadeshoras,
                        "dprecedencia1_id" => $row->dprecedencia1_id,
                        "dprecedencia2_id" => $row->dprecedencia2_id,
                        "dprecedencia3_id" => $row->dprecedencia3_id,
                        "destado" => $row->destado,

                        "cnome" => $row->cnome,
                        "cnomes" => $row->cnomes,
                        "capelido" => $row->capelido,
                        "cbi_passaporte" => $row->cbi_passaporte,

                        "nnome" => $row->nnome,
                        "curso" => $row->curso,
                        "pnome" => $row->pnome,
                    );
                    $ord++;
                }
            }
            return $data;
      }
      //determinar semestre apartir del id de la disciplina
      function mdisciplina_semestre($idd){
          $this->db->select('disciplinas_semestres.semestres_id');
          $this->db->from('disciplinas');
          $this->db->join('disciplinas_semestres','disciplinas_semestres.disciplinas_id = disciplinas.id');
          $this->db->where('disciplinas.id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->semestres_id;
          }
      }
      //determinar ac apartir del id de la disciplina
      function mdisciplina_ac($idd){
          $this->db->select('disciplinas_ano_curricular.ano_curricular_id');
          $this->db->from('disciplinas');
          $this->db->join('disciplinas_ano_curricular','disciplinas_ano_curricular.disciplinas_id = disciplinas.id');
          $this->db->where('disciplinas.id', $idd);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ano_curricular_id;
          }
      }

      function mac($s){
          if($s == '1' || $s == '2')
            return '1';
          if($s == '3' || $s == '4')
            return '2';
          if($s == '5' || $s == '6')
            return '3';
          if($s == '7' || $s == '8')
            return '4';
          if($s == '9' || $s == '10')
            return '5';
      }
      //verificar si existe una entrada en disciplinas_estudantes
      function mexiste_d_e($bi,$idd){
        $this->db->select('id');
        $this->db->from('Disciplinas_Estudantes');
        $this->db->join('Estudantes','Disciplinas_Estudantes.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','Disciplinas_Estudantes.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('Disciplinas_Estudantes.Disciplinas_id', $idd);
        if($this->db->count_all_results() > 0)
            return "Sim";
        else
            return "Não";
      }
 /*     function mexiste_d_e_pauta($bi,$idd){
        $this->db->select('id');
        $this->db->from('Pautas');
        $this->db->join('Estudantes','Pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','Pautas.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('Pautas.Disciplinas_id', $idd);
        $this->db->where('Pautas.Disciplinas_id', $idd);
        if($this->db->count_all_results() > 0)
            return "Sim";
        else
            return "Não";
      }

      function mread_estudantes_disciplinas($bi,$idd){
        $this->db->select('id');
        $this->db->from('Disciplinas_Estudantes');
        $this->db->join('Estudantes','Disciplinas_Estudantes.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','Disciplinas_Estudantes.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('Disciplinas.Disciplinas_id', $idd);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return 
        }
      }
*/
      function mread_disc_semestre($bi,$n,$c,$p,$s){
          $this->load->model('mDisciplinas_Geracao');
          $this->load->model('mpautas');
          $this->load->model('mdisciplinas');
          $this->db->select('disciplinas.id ,disciplinas.dnome, disciplinas.dquantidadeshoras, disciplinas.dprecedencia1_id, 
            disciplinas.dprecedencia2_id, disciplinas.dprecedencia3_id,
            disciplinas.destado, 
            disciplinas_duracao.ddnome,
            niveis.nnome, cursos.cnome as curso, periodos.pnome');
          $this->db->from('disciplinas');
          $this->db->join('disciplinas_duracao','disciplinas.disciplinas_duracao_id = disciplinas_duracao.id');
          $this->db->join('niveis_cursos','disciplinas.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          $this->db->where('niveis.nnome', $n);
          $this->db->where('cursos.cnome', $c);
          $this->db->where('periodos.pnome', $p);
          //$this->db->where('disciplinas.destado', "on");
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                $pre1 = $this->mdisciplinas->mreadX($row->dprecedencia1_id);
                $pre2 = $this->mdisciplinas->mreadX($row->dprecedencia2_id);
                $pre3 = $this->mdisciplinas->mreadX($row->dprecedencia3_id);
                
                $semestre = "";
                if($row->ddnome == "Semestral")
                    $semestre = $this->mdisciplina_semestre($row->id);

                //determinar ano curricular do semestre parametro
                $ac = $this->mac($s);

                $ano_curricular = ""; 
                if($row->ddnome == "Anual"){
                    $ano_curricular = $this->mdisciplina_ac($row->id);
                }

                $d_geracao_id = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->id);
                $dgnome = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id);
                
                //ver si existe um est en la pauta
                if($this->mpautas->mexiste_est($bi,$row->id))
                    $ultimo_ano_lec = $this->mpautas->multimo_ano_lec($bi,$row->id);
                else
                    $ultimo_ano_lec = "";
                
                if($semestre == $s || $ano_curricular == $ac){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "dnome" => $row->dnome,
                        "ddnome" => $row->ddnome,
                        "dquantidadeshoras" => $row->dquantidadeshoras,
                        "dprecedencia1_id" => $pre1,
                        "dprecedencia2_id" => $pre2,
                        "dprecedencia3_id" => $pre3,
                        "destado" => $row->destado,
                        "estado" => $this->mpautas->mresultado_estudante_disciplina($bi,$row->id),
                        "nnome" => $row->nnome,
                        "curso" => $row->curso,
                        "pnome" => $row->pnome,
                        "bi" => $bi,
                        "activa" => $this->mexiste_d_e($bi,$row->id),
                        "d_geracao_id" => $d_geracao_id,
                        "dgnome" => $dgnome,
                        "repeticoes" => $this->mpautas->mrepeticoes($bi,$row->id),
                        "ano_lec" => $ultimo_ano_lec
                    );
                    $ord++;
                }
            }
            return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Organismos_Tutela');
          $this->db->where('Organismos_Tutela.otNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCandidato_id($id){
          $this->db->select('Organismos_Tutela_id');
          $this->db->from('Dados_Laborais');
          $this->db->where('Dados_Laborais.Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Organismos_Tutela_id;
          }
      }
      //actualizar ano de activacao
    function mupdate_aa($ide,$idd){
            $dados = array('ano_activacao'=>date('Y'));
            if($this->db->update('disciplinas_estudantes', $dados, array('estudantes_id'=>$ide,'disciplinas_id'=>$idd))){
                return true;
            }else
                return false;
    }
      
    function minsert($bi,$idd,$al){
        $this->load->model('mestudantes');
        $ide = $this->mestudantes->mreadIDxBI($bi);
        if($this->db->insert('disciplinas_estudantes', array('estudantes_id'=>$ide,'disciplinas_id'=>$idd,'ano_activacao'=>$al/*date('Y')*/)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($ide,$idd) {
        $this->load->model('mestudantes');
        //$ide = $this->mestudantes->mreadIDxBI($bi);
        if($this->db->delete('disciplinas_estudantes', array('estudantes_id' => $ide,'disciplinas_id'=>$idd)))  
            return true;
        else
            return false;
        
    }       
           
  }
