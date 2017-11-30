<?php
  class MAcademica_Inscricao_2_sessao extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadX($alAno,$nNome,$cNome,$pNome,$Nota_Minima){
          if($alAno != "" && $nNome != "" && $cNome != "" && $pNome != "" && $Nota_Minima != ""){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
            $nc_nota_minima = $this->MNiveisCursos->mread_nota_minima($nNome,$cNome,$pNome);
            $this->db->select('Candidatos.id,Candidatos.cSessao,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
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
            //$this->db->where('Candidatos.cSessao',1);
            if($alAno != "")
                $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            if($nNome != "")
                $this->db->where('niveis.id',$nNome);
            if($cNome != "")    
                $this->db->where('cursos.id',$cNome);
            if($pNome != "")    
                $this->db->where('periodos.id',$pNome);
            if($niveis_cursos_id != "")
                $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
            if($Nota_Minima != ""){
                $this->db->where('Academica_Planificacao_Exame_Candidatos.apecNota >',$Nota_Minima);
                $this->db->where('Academica_Planificacao_Exame_Candidatos.apecNota <',$nc_nota_minima);
            }
            $this->db->order_by("apecNota","DESC");
            $consulta = $this->db->get();
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                if($row->condicionado != "on"){
                    $data[] = array(
                    "orden"=>$orden,
                    "id"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "cSessao"=>$row->cSessao,
                    "condicionado"=>$row->condicionado,
                    "condicionadoExcel"=>($row->condicionado == "on")?"Sim":"Não"
                );
                $orden++;
                }
            }
            return $data;
          }else{
              $data2 = array();
              return $data2;
          }
            
      }

      public function mreadXatribuidos($alAno,$nNome,$cNome,$pNome){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cSessao,Candidatos.cEstado,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra,
            niveis.nNome,cursos.cNome as curso,periodos.pNome, anos_lectivos.alAno');
            $this->db->from('Candidatos');
            $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
            //$this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
            $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
            $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
            $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
            if($alAno != "")
                $this->db->where('Candidatos.anos_lectivos_id',$alAno);
            if($nNome != "")
                $this->db->where('niveis.id',$nNome);
            if($cNome != "")    
                $this->db->where('cursos.id',$cNome);
            if($pNome != "")    
            $this->db->where('periodos.id',$pNome);
            if($niveis_cursos_id != ""){
                $this->db->where('Cursos_Pretendidos_2S.niveis_cursos_id',$niveis_cursos_id);
                $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
            }
            $this->db->where('Candidatos.cSessao',2);
            
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
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "cSessao"=>$row->cSessao,
                    "cEstado"=>$row->cEstado,
                    "alAno"=>$row->alAno,
                    "nNome"=>$row->nNome,
                    "curso"=>$row->curso,
                    "pNome"=>$row->pNome,
                );
                $orden++;
            }
            return $data;
      }

      public function matribuir($alAno,$nNome,$cNome,$pNome,$Nota_Minima){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
            $nc_nota_minima = $this->MNiveisCursos->mread_nota_minima($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
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
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecNota >',$Nota_Minima);
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecNota <',$nc_nota_minima);
            $contador = 0;
            $consulta = $this->db->get();
            foreach($consulta->result() as $row){
                $candidato_id = $row->id;
                $existe_cp = $this->mExiste_CP($candidato_id,$niveis_cursos_id);
                if($row->condicionado != "on" && $existe_cp == false){
                    if($this->mupdate_candidatos($candidato_id) && $this->minsert_cursos_pretendidos_2S($candidato_id,$niveis_cursos_id)){
                        if($this->mExiste_Divida($candidato_id) == false)
                            $this->registrar_pagamento($candidato_id);
                        $contador++;
                    }
                }
            }
            if($contador > 0)
                return true;
            else
                return false;
      }

        function mupdate_candidatos($id){
            $dados = array('cSessao' => 2,'cEstado2s' => "Espera de Pagamento");
            if($this->db->update('Candidatos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
        }

        function mExiste_CP($candidatos_id,$niveis_cursos_id){
            $this->db->select('id');
            $this->db->from('Cursos_Pretendidos_2S');
            $this->db->where('Candidatos_id', $candidatos_id);
            $this->db->where('niveis_cursos_id', $niveis_cursos_id);
            if($this->db->count_all_results() > 0)
                return true;
            else
                return false;
        }
        function minsert_cursos_pretendidos_2S($candidatos_id,$niveis_cursos_id){
            //$existe_cp = $this->mExiste_CP($candidatos_id,$niveis_cursos_id);

            if($this->db->insert('Cursos_Pretendidos_2S', array('Candidatos_id'=>$candidatos_id,'niveis_cursos_id'=>$niveis_cursos_id)))
            {
                return true;
            }else{
                return false;
            }
            
        }

        function mExiste_Divida($candidatos_id){
            $this->db->select('id');
            $this->db->from('Financas_Pagamentos_Pendientes_Candidatos');
            $this->db->where('Candidatos_id', $candidatos_id);
            $this->db->where('Financas_Tipo_Pagamento_id', 2);
            if($this->db->count_all_results() > 0)
                return true;
            else
                return false;
        }
        /*
        registrar pagamento pendiente
        */
        function registrar_pagamento($Candidatos_id){
            $fppcData = date("Y").'-'.date("m").'-'.date('d');
            $hora = date("G:i:s");
            //gerar codigo de barra
            $fppcCodigoBarra = "i2 ".$fppcData." ".$hora;
            //$this->load->model('mGerar_Codigo_Barra');
            //$fppcCodigoBarra = $this->mGerar_Codigo_Barra->criarCB($codigo);
            
            $Financas_Tipo_Pagamento_id = "2"; //Inscrição 2 sessao
            $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
            if($this->MFinancas_Pagamentos_Pendientes_Candidatos->minsert($fppcData,$fppcCodigoBarra,$Financas_Tipo_Pagamento_id,$Candidatos_id))
                return true;
            else
                return false;
        }
             
}
