<?php
  class MAcademica_Listas_Resultados_Exame_Acesso extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadX($alAno,$nNome,$cNome,$pNome){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Academica_Planificacao_Exame_Candidatos.id as apecid,Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra, 
            Academica_Planificacao_Exame_Candidatos.condicionado');
            $this->db->from('Candidatos');
            $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
            $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
            $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
            $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('niveis.id',$nNome);
            $this->db->where('cursos.id',$cNome);
            $this->db->where('periodos.id',$pNome);
            $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
            $this->db->order_by("cNome");
            $consulta = $this->db->get();
            $this->load->model('mDados_Academicos');
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                $data[] = array(
                    "orden"=>$orden,
                    "id"=>$row->id,
                    "apecid"=>$row->apecid,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "condicionado"=>$row->condicionado,
                    "condicionadoExcel"=>($row->condicionado == "on")?"Sim":"Não"
                );
                $orden++;
            }
            return $data;
      }

      /*
        Listar todos os candidatos Aprovados e Reprovados
      */
      public function mreadXtodos($alAno,$nNome,$cNome,$pNome, $provFormacao, $idade_minima,$idade_maxima){
            $this->load->model('MCandidatos');
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,Candidatos.cData_Nascimento,
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos.condicionado,
            anos_lectivos.alAno,
            niveis.nNome,
            cursos.cNome as curso,
            periodos.pNome');
            $this->db->distinct(true);
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
            $this->db->join('Dados_Academicos_Candidatos','Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');

            $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            $this->db->where('niveis.id',$nNome);
            $this->db->where('cursos.id',$cNome);
            $this->db->where('periodos.id',$pNome);
            $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
            if($provFormacao != "")
                $this->db->where('Dados_Academicos_Candidatos.Formacao_Provincias_id',$provFormacao);
            
            $this->db->order_by("cNome");
            $consulta = $this->db->get();
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                $idade = $this->MCandidatos->calculaEdad($row->cData_Nascimento);
                if($idade > $idade_minima && $idade < $idade_maxima){
                    $data[] = array(
                        "orden"=>$orden,
                        "id"=>$row->id,
                        "cNome"=>$row->cNome,
                        "cNomes"=>$row->cNomes,
                        "cApelido"=>$row->cApelido,
                        "cBI_Passaporte"=>$row->cBI_Passaporte,
                        //"cData_Nascimento"=>$row->cData_Nascimento,
                        "alAno"=>$row->alAno,
                        "nNome"=>$row->nNome,
                        "curso"=>$row->curso,
                        "pNome"=>$row->pNome,
                        "apecNota"=>$row->apecNota,
                        "apecCodigoBarra"=>$row->apecCodigoBarra,
                        "condicionado"=>$row->condicionado
                    );
                    $orden++;
                }
            }
            return $data;
      }

      function mupdate($apecid,$apecCodigoBarra,$apecNota,$condicionado){
            $dados = array('apecNota'=>$apecNota,'condicionado'=>$condicionado);
            if($this->db->update('Academica_Planificacao_Exame_Candidatos', $dados, array('id' => $apecid))){
                return true;
            }else
                return false;
      }
    /*  
    function minsert($candidatos_id,$planificacao_id,$CodigoBarra){
        if($this->db->insert('Academica_Planificacao_Exame_Candidatos', array('Candidatos_id'=>$candidatos_id,
        'Academica_Planificacao_Exame_Ingreso_id'=>$planificacao_id,'apecCodigoBarra'=>$CodigoBarra)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    
    function mdelete($id) {
        if($this->db->delete('Academica_Planificacao_Exame_Ingreso', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    */        
}
