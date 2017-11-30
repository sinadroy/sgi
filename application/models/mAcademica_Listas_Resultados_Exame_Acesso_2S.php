<?php
  class MAcademica_Listas_Resultados_Exame_Acesso_2S extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadX($alAno,$nNome,$cNome,$pNome){
            $this->load->model('MNiveisCursos');
            $this->load->model('MDados_Academicos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Academica_Planificacao_Exame_Candidatos_2S.apecNota, Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra');
            $this->db->from('Candidatos');
            $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
            $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
            $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('niveis.id',$nNome);
            $this->db->where('cursos.id',$cNome);
            $this->db->where('periodos.id',$pNome);
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id',$niveis_cursos_id);
            
            $consulta = $this->db->get();
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                $prov = $this->MDados_Academicos->mreadProvinciaXcandidato($row->id);
                $data[] = array(
                    "orden"=>$orden,
                    "id"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$prov
                );
                $orden++;
            }
            return $data;
      }

      /*
        Listar todos os candidatos Aprovados e Reprovados
      */
      public function mreadXtodos($alAno,$nNome,$cNome,$pNome){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Academica_Planificacao_Exame_Candidatos_2S.apecNota, Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra,
            anos_lectivos.alAno,
            niveis.nNome,
            cursos.cNome as curso,
            periodos.pNome');
            $this->db->from('Candidatos');
            $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
            $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
            $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
            $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
            $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
            $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('niveis.id',$nNome);
            $this->db->where('cursos.id',$cNome);
            $this->db->where('periodos.id',$pNome);
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id',$niveis_cursos_id);
            
            $consulta = $this->db->get();
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                $data[] = array(
                    "orden"=>$orden,
                    "id"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "alAno"=>$row->alAno,
                    "nNome"=>$row->nNome,
                    "curso"=>$row->curso,
                    "pNome"=>$row->pNome,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra
                );
                $orden++;
            }
            return $data;
      }

      function mupdate($apecCodigoBarra,$apecNota){
            $dados = array('apecNota'=>$apecNota);
            if($this->db->update('Academica_Planificacao_Exame_Candidatos_2S', $dados, array('apecCodigoBarra' => $apecCodigoBarra))){
                return true;
            }else
                return false;
      }       
}
