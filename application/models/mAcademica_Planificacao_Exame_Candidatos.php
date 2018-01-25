<?php
  class MAcademica_Planificacao_Exame_Candidatos extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mtotalCandidatosColocadosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        // $this->db->where('Candidatos.anos_lectivos_id',$alAno);
        $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $alAno); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
        $this->db->where('niveis.id',$nNome);
        $this->db->where('cursos.id',$cNome);
        $this->db->where('periodos.id',$pNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id',$atcNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiData',$apeiData);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiHora',$apeiHora);
        return $this->db->count_all_results();
      }
      /*
        determinar total de candidatos colocados na turma utilizando los datos realaes de los parametros de busca
      */
      public function mtotalCandidatosColocadosXturma($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->where('anos_lectivos.alAno',$alAno);
        $this->db->where('niveis.nNome',$nNome);
        $this->db->where('cursos.cNome',$cNome);
        $this->db->where('periodos.pNome',$pNome);
        $this->db->where('Academica_Turmas_Ingreso.atcNome',$atcNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiData',$apeiData);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiHora',$apeiHora);
        return $this->db->count_all_results();
      }

      function mread($al){
          //echo 'desp:'.$al.'</br>';
          //Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          $this->db->select('Academica_Planificacao_Exame_Ingreso.id,Academica_Planificacao_Exame_Ingreso.apeiData,Academica_Planificacao_Exame_Ingreso.apeiHora,
          anos_lectivos.alAno, Academica_Turmas_Ingreso.atcNome, Academica_Turmas_Ingreso.atcLocalizacao, niveis.nNome, cursos.cNome, periodos.pNome');
          $this->db->from('Academica_Planificacao_Exame_Ingreso');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');

          $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id',$al);

          $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $totalCandidatos = $this->mtotalCandidatosColocadosXturma($row->alAno,$row->nNome,$row->cNome,$row->pNome,$row->atcNome,$row->apeiData,$row->apeiHora);
              //echo $totalCandidatos;
              //echo $row->alAno;
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "alAno"=>$row->alAno,
                  "apeiData"=>$row->apeiData,
                  "apeiHora"=>$row->apeiHora,
                  "nNome"=>$row->nNome,
                  "cNome"=>$row->cNome,
                  "pNome"=>$row->pNome,
                  "atcNome"=>$row->atcNome,
                  "atcLocalizacao"=>$row->atcLocalizacao,
                  "totalCandidatos"=>$totalCandidatos
              );
              $orden++;
          }
        return $data;
      }
      /*
      function mread($alAno,$nNome,$cNome,$pNome,$atcNome){
        $this->db->select('niveis.nNome,cursos.cNome as curso, periodos.pNome,
            Academica_Planificacao_Exame_Candidatos.id, Candidatos.cNome, Candidatos.cNomes, Candidatos.cApelido, Candidatos.cBI_Passaporte,
            Academica_Turmas_Ingreso.atcNome, anos_lectivos.alAno,Academica_Planificacao_Exame_Ingreso.apeiData,Academica_Planificacao_Exame_Ingreso.apeiHora');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
        if($alAno != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id',$alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso.atcNome',$atcNome);
        $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "alAno"=>$row->alAno,
                  "nNome"=>$row->nNome,
                  "curso"=>$row->curso,
                  "pNome"=>$row->pNome,
                  "apeiData"=>$row->apeiData,
                  "apeiHora"=>$row->apeiHora,
                  
                  "cNome"=>$row->cNome,
                  "cNomes"=>$row->cNomes,
                  "cApelido"=>$row->cApelido,
                  "cBI_Passaporte"=>$row->cBI_Passaporte,
                  "atcNome"=>$row->atcNome,
                  //"atcLocalizacao"=>$row->atcLocalizacao
              );
              $orden++;
          }
        return $data;
      }
      */
      function mread2($alAno,$nNome,$cNome,$pNome,$atcNome, $apeiData, $apeiHora){
        $this->db->select('niveis.nNome,cursos.cNome as curso, periodos.pNome,
            Academica_Planificacao_Exame_Candidatos.id, Candidatos.cNome, Candidatos.cNomes, Candidatos.cApelido, Candidatos.cBI_Passaporte,
            Academica_Turmas_Ingreso.atcNome, anos_lectivos.alAno,Academica_Planificacao_Exame_Ingreso.apeiData,Academica_Planificacao_Exame_Ingreso.apeiHora');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
        if($alAno != "")
            $this->db->where('anos_lectivos.alAno',$alAno);
        if($nNome != "")
            $this->db->where('niveis.nNome',$nNome);
        if($cNome != "")
            $this->db->where('cursos.cNome',$cNome);
        if($pNome != "")
            $this->db->where('periodos.pNome',$pNome);
        if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso.atcNome',$atcNome);
        if($apeiData != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiData',$apeiData);
        if($apeiHora != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiHora',$apeiHora);
        $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "alAno"=>$row->alAno,
                  "nNome"=>$row->nNome,
                  "curso"=>$row->curso,
                  "pNome"=>$row->pNome,
                  "apeiData"=>$row->apeiData,
                  "apeiHora"=>$row->apeiHora,
                  
                  "cNome"=>$row->cNome,
                  "cNomes"=>$row->cNomes,
                  "cApelido"=>$row->cApelido,
                  "cBI_Passaporte"=>$row->cBI_Passaporte,
                  "atcNome"=>$row->atcNome,
                  //"atcLocalizacao"=>$row->atcLocalizacao
              );
              $orden++;
          }
        return $data;
      }

      /*
        para cargar todo lo que se necesita en listas por turmas utilizando los parametros como IDs
      */
      function mread22($alAno,$nNome,$cNome,$pNome,$atcNome, $apeiData, $apeiHora){
        $this->db->select('niveis.nNome,cursos.cNome as curso, periodos.pNome,
            Academica_Planificacao_Exame_Candidatos.id, Candidatos.cNome, Candidatos.cNomes, Candidatos.cApelido, Candidatos.cBI_Passaporte,
            Academica_Turmas_Ingreso.atcNome, anos_lectivos.alAno,Academica_Planificacao_Exame_Ingreso.apeiData,Academica_Planificacao_Exame_Ingreso.apeiHora,
            Academica_Planificacao_Exame_Candidatos.apecCodigoBarra');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
        if($alAno != "")
            $this->db->where('anos_lectivos.id',$alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso.id',$atcNome);
        if($apeiData != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiData',$apeiData);
        if($apeiHora != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.apeiHora',$apeiHora);
        //$this->db->order_by("cNome");
        $this->db->order_by('cNome','ASC');
        $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "alAno"=>$row->alAno,
                  "nNome"=>$row->nNome,
                  "curso"=>$row->curso,
                  "pNome"=>$row->pNome,
                  "apeiData"=>$row->apeiData,
                  "apeiHora"=>$row->apeiHora,
                  "apecCodigoBarra"=>$row->apecCodigoBarra,
                  "cNome"=>$row->cNome,
                  "cNomes"=>$row->cNomes,
                  "cApelido"=>$row->cApelido,
                  "cBI_Passaporte"=>$row->cBI_Passaporte,
                  "atcNome"=>$row->atcNome,
                  //"atcLocalizacao"=>$row->atcLocalizacao
              );
              $orden++;
          }
        return $data;
      }
      /*
        funcao para Datas planificadas para una turma
      */
      function mreadDatasPlanificadasXancpt($alAno,$nNome,$cNome,$pNome,$atcNome){
          //Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          $this->db->select('Academica_Planificacao_Exame_Ingreso.id,Academica_Planificacao_Exame_Ingreso.apeiData');
          $this->db->from('Academica_Planificacao_Exame_Ingreso');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          if($alAno != "")
            $this->db->where('anos_lectivos.id',$alAno);
          if($nNome != "")
            $this->db->where('niveis.id',$nNome);
          if($cNome != "")
            $this->db->where('cursos.id',$cNome);
          if($pNome != "")
            $this->db->where('periodos.id',$pNome);
          if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso.id',$atcNome);
          $consulta = $this->db->get();
          //$orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "id"=>$row->id,
                  "value"=>$row->apeiData,
                  "apeiData"=>$row->apeiData,
              );
              //$orden++;
          }
        return $data;

          //return $consulta->result();
      }

      /*
        funcao para Horas planificadas para una turma
      */
      function mreadHorasPlanificadasXancpt($alAno,$nNome,$cNome,$pNome,$atcNome){
          //Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          $this->db->select('Academica_Planificacao_Exame_Ingreso.id,Academica_Planificacao_Exame_Ingreso.apeiHora');
          $this->db->from('Academica_Planificacao_Exame_Ingreso');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          if($alAno != "")
            $this->db->where('anos_lectivos.id',$alAno);
          if($nNome != "")
            $this->db->where('niveis.id',$nNome);
          if($cNome != "")
            $this->db->where('cursos.id',$cNome);
          if($pNome != "")
            $this->db->where('periodos.id',$pNome);
          if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso.id',$atcNome);
          $consulta = $this->db->get();
          //$orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "id"=>$row->id,
                  "value"=>$row->apeiHora,
                  "apeiHora"=>$row->apeiHora,
              );
              //$orden++;
          }
        return $data;

          //return $consulta->result();
      }

      /*
        determinar total de estudantes por nivel, curso e periodo
      */
      public function mtotalCandidatosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome){
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        if($alAno != ""){
            $this->db->where('cursos_pretendidos.cp_ano_lec_insc', $alAno); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
            $this->db->where('Candidatos.ano_lec_insc', $alAno);
        }
            // $this->db->where('Candidatos.anos_lectivos_id',$alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        return $this->db->count_all_results();
      }

      

      /*
        determinar total de candidatos colocados de forma geral
      */
      public function mtotalCandidatosColocadosGeral($alAno,$nNome,$cNome,$pNome){
        //Conseguir ID del niveis_cursos_id
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

        // convertir ano actual en id
        $this->load->model('MAnos_Lectivos');
        $al_id = $this->MAnos_Lectivos->mGetID($alAno);

        //$this->db->distinct();
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        if($alAno != ""){
            $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $alAno); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id', $alAno);
            $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id', $al_id);
        }
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id',$alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        if($niveis_cursos_id != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
        return $this->db->count_all_results();
      }
      /*
        determinar total de candidatos nao colocados
      */
      public function mtotalCandidatosNaoColocadosGeral($alAno,$nNome,$cNome,$pNome){
          // echo 'total'.$this->mtotalCandidatosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome).'<br>';
          // echo 'colocados'.$this->mtotalCandidatosColocadosGeral($alAno,$nNome,$cNome,$pNome).'<br>';
        return $this->mtotalCandidatosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome) - $this->mtotalCandidatosColocadosGeral($alAno,$nNome,$cNome,$pNome);
      }
      /*
        determinar se um candidatos_id fui colocado antes 
      */
      public function mDeterminarSeCandidatoColocadoXid($alAno,$nNome,$cNome,$pNome,$candidatos_id){
        //Conseguir ID del niveis_cursos_id
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //$this->db->distinct();
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        if($alAno != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id',$alAno);
        /*if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);*/
        if($niveis_cursos_id != "") 
            $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
        if($candidatos_id != "")
            $this->db->where('Academica_Planificacao_Exame_Candidatos.Candidatos_id',$candidatos_id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
      }
      //determinar si ya fue colocado version 2
      public function mDeterminarSeColocadoXid($candidatos_id,$niveis_cursos_id){
        //Conseguir ID del niveis_cursos_id
        //$this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //$this->db->distinct();
        $this->db->select('Candidatos.id');
        $this->db->from('Academica_Planificacao_Exame_Candidatos');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        //$this->db->join('Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        //$this->db->where('Candidatos.anos_lectivos_id',$alAno);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
        $this->db->where('Academica_Planificacao_Exame_Candidatos.Candidatos_id',$candidatos_id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
      }
      /*
        atribuir candidatos a turma
      */
      public function mAtrinuirCandidatosTurma($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora,$capacidade_turma){
        //Conseguir ID del niveis_cursos_id
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //conseguir ID de la planificacion a que corresponden estos parametros
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso');
        $planificacao_id = $this->MAcademica_Planificacao_Exame_Ingreso->mreadX($alAno,$niveis_cursos_id,$atcNome,$apeiData,$apeiHora);
        //cargar candidatos del curso seleccionado
        $this->db->select('Candidatos.id,Candidatos.cNome');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //teste
        //$this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        //$this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');

        $this->db->where('Candidatos.anos_lectivos_id', $alAno);
        $this->db->where('niveis_cursos.niveis_id', $nNome);
        $this->db->where('niveis_cursos.cursos_id', $cNome);
        $this->db->where('niveis_cursos.periodos_id', $pNome);
        //teste
        //$this->db->where('Cursos_Pretendidos.niveis_cursos_id', $niveis_cursos_id);
        //$this->db->where('Academica_Planificacao_Exame_Ingreso.id', $planificacao_id);
        $this->db->order_by('cNome','ASC');
        $consulta = $this->db->get();
        $data = array();
        $contador = 0;
        $ct = $capacidade_turma;
        foreach ($consulta->result() as $row) {
            if($ct > 0 && $this->mDeterminarSeColocadoXid($row->id,$niveis_cursos_id) == false){
                $ct = $ct - 1;
                //gerar codigo de barra de 6 digitos
                //$CodigoBarra = chr(rand(ord("A"), ord("Z"))).rand(0, 9).chr(rand(ord("A"), ord("Z"))).rand(0, 9).chr(rand(ord("A"), ord("Z"))).rand(0, 9);

                //para criar codigo de barra unico
                $cb_unico = "";
                do{
                    $CodigoBarra = chr(rand(ord("A"), ord("Z"))).rand(0, 9).chr(rand(ord("A"), ord("Z"))).rand(0, 9).chr(rand(ord("A"), ord("Z"))).rand(0, 9);
                    if($this->mExiste_CB($CodigoBarra) == false)
                        $cb_unico = $CodigoBarra;
                }
                while($this->mExiste_CB($CodigoBarra));

                if($this->minsert($row->id,$planificacao_id,$CodigoBarra))
                    $contador++;
            }
        }
        if($contador > 0)
            return true;
        else
            return false;
      }
      
    function minsert($candidatos_id,$planificacao_id,$CodigoBarra){
        if($this->db->insert('Academica_Planificacao_Exame_Candidatos', array('Candidatos_id'=>$candidatos_id,
        'Academica_Planificacao_Exame_Ingreso_id'=>$planificacao_id,'apecCodigoBarra'=>$CodigoBarra)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    /*
    function mdelete($id) {
        if($this->db->delete('Academica_Planificacao_Exame_Ingreso', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    */ 
    function mExiste_CB($cb){
        $this->db->select('id');
        $this->db->from('Academica_Planificacao_Exame_Candidatos');
        $this->db->where('apecCodigoBarra', $cb);
        if($this->db->count_all_results() > 0)
          return true;
        else
          return false;
    }       
}
