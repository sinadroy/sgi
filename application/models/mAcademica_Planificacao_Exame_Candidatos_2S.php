<?php
  class MAcademica_Planificacao_Exame_Candidatos_2S extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mtotalCandidatosColocadosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id',$alAno);
        $this->db->where('niveis.id',$nNome);
        $this->db->where('cursos.id',$cNome);
        $this->db->where('periodos.id',$pNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id',$atcNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiData',$apeiData);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiHora',$apeiHora);
        return $this->db->count_all_results();
      }
      /*
        determinar total de candidatos colocados na turma utilizando los datos realaes de los parametros de busca
      */
      public function mtotalCandidatosColocadosXturma($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        // $this->db->where('anos_lectivos.alAno',$alAno);
        $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id',$alAno);
        $this->db->where('niveis.nNome',$nNome);
        $this->db->where('cursos.cNome',$cNome);
        $this->db->where('periodos.pNome',$pNome);
        $this->db->where('Academica_Turmas_Ingreso_2S.atcNome',$atcNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiData',$apeiData);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiHora',$apeiHora);
        return $this->db->count_all_results();
      }

      function mread($al){
          //Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          $this->db->select('Academica_Planificacao_Exame_Ingreso_2S.id,Academica_Planificacao_Exame_Ingreso_2S.apeiData,Academica_Planificacao_Exame_Ingreso_2S.apeiHora,
          anos_lectivos.alAno,
          Academica_Turmas_Ingreso_2S.atcNome,Academica_Turmas_Ingreso_2S.atcLocalizacao,
          niveis.nNome,cursos.cNome,periodos.pNome');
          $this->db->from('Academica_Planificacao_Exame_Ingreso_2S');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');

          $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id',$al);

          $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $totalCandidatos = $this->mtotalCandidatosColocadosXturma($al,$row->nNome,$row->cNome,$row->pNome,$row->atcNome,$row->apeiData,$row->apeiHora);
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
     
      function mread2($alAno,$nNome,$cNome,$pNome,$atcNome, $apeiData, $apeiHora){
        $this->db->select('niveis.nNome,cursos.cNome as curso, periodos.pNome,
            Academica_Planificacao_Exame_Candidatos_2S.id, Candidatos.cNome, Candidatos.cNomes, Candidatos.cApelido, Candidatos.cBI_Passaporte,
            Academica_Turmas_Ingreso_2S.atcNome, anos_lectivos.alAno,Academica_Planificacao_Exame_Ingreso_2S.apeiData,Academica_Planificacao_Exame_Ingreso_2S.apeiHora');
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
        if($alAno != "")
            $this->db->where('anos_lectivos.alAno',$alAno);
        if($nNome != "")
            $this->db->where('niveis.nNome',$nNome);
        if($cNome != "")
            $this->db->where('cursos.cNome',$cNome);
        if($pNome != "")
            $this->db->where('periodos.pNome',$pNome);
        if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso_2S.atcNome',$atcNome);
        if($apeiData != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiData',$apeiData);
        if($apeiHora != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiHora',$apeiHora);
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
            Academica_Planificacao_Exame_Candidatos_2S.id, Candidatos.cNome, Candidatos.cNomes, Candidatos.cApelido, Candidatos.cBI_Passaporte,
            Academica_Turmas_Ingreso_2S.atcNome, anos_lectivos.alAno,Academica_Planificacao_Exame_Ingreso_2S.apeiData,Academica_Planificacao_Exame_Ingreso_2S.apeiHora,
            Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra');
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
        if($alAno != "")
            $this->db->where('anos_lectivos.id',$alAno);
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id',$alAno);
            $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id',$alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        if($atcNome != "")
            $this->db->where('Academica_Turmas_Ingreso_2S.id',$atcNome);
        if($apeiData != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiData',$apeiData);
        if($apeiHora != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.apeiHora',$apeiHora);
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
          $this->db->select('Academica_Planificacao_Exame_Ingreso_2S.id,Academica_Planificacao_Exame_Ingreso_2S.apeiData');
          $this->db->from('Academica_Planificacao_Exame_Ingreso_2S');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
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
            $this->db->where('Academica_Turmas_Ingreso_2S.id',$atcNome);
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
          $this->db->select('Academica_Planificacao_Exame_Ingreso_2S.id,Academica_Planificacao_Exame_Ingreso_2S.apeiHora');
          $this->db->from('Academica_Planificacao_Exame_Ingreso_2S');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
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
            $this->db->where('Academica_Turmas_Ingreso_2S.id',$atcNome);
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
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        if($alAno != ""){
            // $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id', $alAno); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
            // $this->db->where('Candidatos.anos_lectivos_id', $alAno);
        }
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
        //$this->db->distinct();
        $this->db->select('Candidatos.id');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        if($alAno != "")
            // $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id',$alAno);
            $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id', $alAno); // aqui se usa o ano da tabela cursos_pretendidos nao de candidatos ni outro.
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id', $alAno);
        if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
        if($niveis_cursos_id != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id',$niveis_cursos_id);
        return $this->db->count_all_results();
      }
      /*
        determinar total de candidatos nao colocados
      */
      public function mtotalCandidatosNaoColocadosGeral($alAno,$nNome,$cNome,$pNome){
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
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        if($alAno != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id',$alAno);
        /*if($nNome != "")
            $this->db->where('niveis.id',$nNome);
        if($cNome != "")
            $this->db->where('cursos.id',$cNome);
        if($pNome != "")
            $this->db->where('periodos.id',$pNome);
            */
        if($niveis_cursos_id != "")
            $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id',$niveis_cursos_id);
        if($candidatos_id != "")
            $this->db->where('Candidatos.id',$candidatos_id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
      }
      //determinar si ya fue colocado version 2
      public function mDeterminarSeColocadoXid($alAno, $candidatos_id,$niveis_cursos_id){
        //Conseguir ID del niveis_cursos_id
        //$this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //$this->db->distinct();
        $this->db->select('Candidatos.id');
        $this->db->from('Academica_Planificacao_Exame_Candidatos_2S');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        //$this->db->join('Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.anos_lectivos_id',$alAno);
        $this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id',$niveis_cursos_id);
        $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id',$candidatos_id);
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
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso_2S');
        $planificacao_id = $this->MAcademica_Planificacao_Exame_Ingreso_2S->mreadX($alAno,$niveis_cursos_id,$atcNome,$apeiData,$apeiHora);
        //cargar candidatos del curso seleccionado
        $this->db->select('Candidatos.id,Candidatos.cNome');
        $this->db->from('Cursos_Pretendidos_2S');
        $this->db->join('Candidatos', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //teste
        //$this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        //$this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');

        $this->db->where('Cursos_Pretendidos_2S.anos_lectivos_id', $alAno);
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
            //if($capacidade_turma > 0 ){//&& $this->mDeterminarSeCandidatoColocadoXid($alAno,$nNome,$cNome,$pNome,$row->id) == false){
            if($ct > 0 && $this->mDeterminarSeColocadoXid($alAno, $row->id,$niveis_cursos_id) == false){
                $ct = $ct - 1;
                //$capacidade_turma--;
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

                if($this->minsert($alAno,$row->id,$planificacao_id,$cb_unico))
                    $contador++;
            }
        }
        if($contador > 0)
            return true;
        else
            return false;
      }
      
    function minsert($anos_lectivos_id,$candidatos_id,$planificacao_id,$CodigoBarra){
        if($this->db->insert('Academica_Planificacao_Exame_Candidatos_2S', array('Candidatos_id'=>$candidatos_id,
        'Academica_Planificacao_Exame_Ingreso_2S_id'=>$planificacao_id,'apecCodigoBarra'=>$CodigoBarra,
        'anos_lectivos_id'=>$anos_lectivos_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mExiste_CB($cb){
          $this->db->select('id');
          $this->db->from('Academica_Planificacao_Exame_Candidatos_2S');
          $this->db->where('apecCodigoBarra', $cb);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
    }      
}
