<?php
    header('Content-Type: text/html; charset=UTF-8');
  class MAcademica_Resultados_Exame_Acesso_2S extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadNome($nivel_acesso,$cb){
            $this->db->select('Candidatos.cNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cNome:md5($row->cNome);
            }
      }
      public function mreadNomes($nivel_acesso,$cb){
            $this->db->select('Candidatos.cNomes');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cNomes:md5($row->cNomes);
            }
      }
      public function mreadApelido($nivel_acesso,$cb){
            $this->db->select('Candidatos.cApelido');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cApelido:md5($row->cApelido);
            }
      }
      public function mreadBI($nivel_acesso,$cb){
            $this->db->select('Candidatos.cBI_Passaporte');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cBI_Passaporte:md5($row->cBI_Passaporte);
            }
      }
      /*
      select Academica_Turmas_Ingreso.atcNome
from Academica_Planificacao_Exame_Candidatos inner join Candidatos on (Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id)
inner join Academica_Planificacao_Exame_Ingreso on (Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id)
inner join niveis_cursos on(Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id)
inner join niveis on(niveis_cursos.niveis_id = niveis.id)
inner join cursos on(niveis_cursos.cursos_id = cursos.id)
inner join periodos on(niveis_cursos.Periodos_id = periodos.id)
inner join Academica_Turmas_Ingreso on(Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id)
where Academica_Planificacao_Exame_Candidatos.apecCodigoBarra = 'X0E9H3'
      */
      public function mreadNivel($cb){
            $this->db->select('niveis.nNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.id = Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->nNome;
            }
      }
      public function mreadCurso($cb){
            $this->db->select('cursos.cNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.id = Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->cNome;
            }
      }
      public function mreadPeriodo($cb){
            $this->db->select('periodos.pNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.id = Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->pNome;
            }
      }
      public function mreadTurma($nivel_acesso,$cb){
            $this->db->select('Academica_Turmas_Ingreso_2S.atcNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.id = Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->atcNome:md5($row->atcNome);
            }
      }

      public function mreadNota($cb){
            $this->db->select('Academica_Planificacao_Exame_Candidatos_2S.apecNota');
            $this->db->from('Academica_Planificacao_Exame_Candidatos_2S'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.id = Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso_2S', 'Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->apecNota;
            }
      }

      function mupdate($cb,$apecNota,$user_sessao,$na){
          $this->load->model('MCandidatos');
          //$candidatos_id = $this->MCandidatos->mreadIDxCB($cb);
          $candidatos_bi = $this->MCandidatos->mreadBIxCB_i2s($cb);

            $dados = array('apecNota'=>$apecNota);
            if($this->db->update('Academica_Planificacao_Exame_Candidatos_2S', $dados, array('apecCodigoBarra' => $cb))){
                $this->load->model('MAuditorias_Academicas');
                $this->MAuditorias_Academicas->minsert("Inserir:Nota Ex. Acesso 2S","Academica","Res. Exame Acesso 2S",$user_sessao,"Estudante BI: ".$candidatos_bi.' Nota: '.$apecNota.' Inserido com sucesso');
                return true;
            }else
                return false;
      }       
}
