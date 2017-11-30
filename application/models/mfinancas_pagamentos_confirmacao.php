<?php
  class Mfinancas_pagamentos_confirmacao extends CI_Model{
      
      function mread(){
          $this->db->select('financas_pagamaentos_conf_mat.id,fpddata,fpdhora,fpdvalor,fpdusuario,fpdrefpagamento,Candidatos.cNome,Candidatos.cApelido,
            Candidatos.cBI_Passaporte,
            semestres.snome,
            Financas_Forma_Pagamento.ffpNome,
            Financas_Contas.contNome,Financas_Contas.contNumero,
            niveis.nNome,cursos.cNome as curso,periodos.pNome');
          $this->db->from('financas_pagamaentos_conf_mat');
          $this->db->join('Financas_Forma_Pagamento', 'financas_pagamaentos_conf_mat.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
          $this->db->join('Financas_Contas', 'financas_pagamaentos_conf_mat.Financas_Contas_id = Financas_Contas.id');
          $this->db->join('semestres', 'financas_pagamaentos_conf_mat.semestres_id = semestres.id');
          $this->db->join('Estudantes', 'financas_pagamaentos_conf_mat.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');

          $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
          
          $this->db->order_by('fpddata','DESC');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,

                        "cNome" => $row->cNome,
                        "cApelido" => $row->cApelido,
                        "cBI_Passaporte" => $row->cBI_Passaporte,

                        "fpddata" => $row->fpddata,
                        "fpdhora" => $row->fpdhora,
                        "fpdvalor" => $row->fpdvalor,
                        "fpdusuario" => $row->fpdusuario,
                        "fpdrefpagamento" => $row->fpdrefpagamento,
                        "snome" => $row->snome,
                        "ffpNome" => $row->ffpNome,
                        "contNome" => $row->contNome,
                        "contNumero" => $row->contNumero,

                        "nNome" => $row->nNome,
                        "curso" => $row->curso,
                        "pNome" => $row->pNome,
                    );
                    $ord++;
            }
            return $data;
      }

      function mExiste_Pagamento($bi,$s){
          $this->db->from('financas_pagamaentos_conf_mat');
          $this->db->join('Financas_Forma_Pagamento', 'financas_pagamaentos_conf_mat.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
          $this->db->join('Financas_Contas', 'financas_pagamaentos_conf_mat.Financas_Contas_id = Financas_Contas.id');
          $this->db->join('semestres', 'financas_pagamaentos_conf_mat.semestres_id = semestres.id');
          $this->db->join('Estudantes', 'financas_pagamaentos_conf_mat.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');

          $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $this->db->where('semestres.id', $s);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      //
        function mreadXcb_valor_total_confirmacao($cb)
        {
            $this->db->select('niveis_cursos.ncPreco_Confirmacao');
            $this->db->from('Candidatos');
            $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
            //$this->db->where('Estudantes.eEstado_Matricula', "Conf.Mat.Esp.Pag");
            $this->db->where('Candidatos.id', $cb);
            $consulta = $this->db->get();
            $total_pagar = 0;
            foreach ($consulta->result() as $row) {
                $total_pagar = $row->ncPreco_Confirmacao;
            }
            return $total_pagar;
        }

      function mreadX($bi,$alano){
          $this->db->select('Pagamentos_Propina.id,Pagamentos_Propina.ppData,Pagamentos_Propina.ppHora,Pagamentos_Propina.ppValor,
                Candidatos.cNome,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.id as cid, Estudantes.id as eid,
                Pagamentos_Propina.Meses_Propina_id, Meses_Propina.mesNome,
                anos_lectivos.alAno');
          $this->db->from('Pagamentos_Propina');
          $this->db->join('Meses_Propina', 'Pagamentos_Propina.Meses_Propina_id = Meses_Propina.id');
          $this->db->join('Estudantes', 'Pagamentos_Propina.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->join('anos_lectivos', 'Pagamentos_Propina.anos_lectivos_id = anos_lectivos.id');
          if($alano != "")
            $this->db->where('anos_lectivos.id', $alano);
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $this->db->order_by('Meses_Propina_id','ASC');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "cid" => $row->cid,
                        "eid" => $row->eid,

                        "mesNome" => $row->mesNome,

                        "cNome" => $row->cNome,
                        "cApelido" => $row->cApelido,
                        "cBI_Passaporte" => $row->cBI_Passaporte,

                        "ppData" => $row->ppData,
                        "ppHora" => $row->ppHora,
                        "ppValor" => $row->ppValor,

                        "alAno" => $row->alAno
                    );
                    $ord++;
                }
            }
            return $data;
      }
      
      function mcancelar_pagamento($id,$utilizadores_id,$user,$cNome,$cApelido,$cBI_Passaporte){
          //get id financas_contas_id
        $this->load->model('mFinancas_Contas');
        $financa_conta_id = $this->mFinancas_Contas->mreadIDXNome("Sistema");
        $dados = array('ppValor'=>0,'utilizadores_id'=>$utilizadores_id,'Financas_Contas_id'=>$financa_conta_id);
        if($this->db->update('Pagamentos_Propina', $dados, array('id' => $id))){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Cancelar:Pagamento","Financa","Pag.Propinas",$user,"Estudante:".$cNome.' '.$cApelido.' BI:'.$cBI_Passaporte.' Cancelado com sucesso');
            return true;
        }else
            return false;
     }

    function mupdate($id,$fpddata,$fpdhora,$fpdvalor,$fpdusuario,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome){
        $dados = array('fpddata'=>$fpddata,'fpdhora'=>$fpdhora,'fpdvalor'=>$fpdvalor,'fpdusuario'=>$fpdusuario,'fpdrefpagamento'=>$fpdrefpagamento,
            'Estudantes_id'=>$Estudantes_id,'semestres_id'=>$semestres_id,'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id,'Financas_Contas_id'=>$Financas_Contas_id);
        if($this->db->update('financas_pagamaentos_conf_mat', $dados, array('id' => $id))){
            //$this->load->model('MAuditorias_Financas');
            //$this->MAuditorias_Financas->minsert("Inserir:Pagamento","Financa","Pag.Conf.Pag",$user,"Estudante:".$cNome.' BI:'.$bi.' inserido com sucesso');
            return true;
        }else
            return false;
    }
      
    function minsert($fpddata,$fpdhora,$fpdvalor,$fpdusuario,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome){
        $dados = array('fpddata'=>$fpddata,'fpdhora'=>$fpdhora,'fpdvalor'=>$fpdvalor,'fpdusuario'=>$fpdusuario,'fpdrefpagamento'=>$fpdrefpagamento,
            'Estudantes_id'=>$Estudantes_id,'semestres_id'=>$semestres_id,'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id,'Financas_Contas_id'=>$Financas_Contas_id);
        if($this->db->insert('financas_pagamaentos_conf_mat', $dados))
        {
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Inserir:Pagamento","Financa","Pag.Conf.Mat",$fpdusuario,"Estudante:".$cnome.' BI:'.$bi.' inserido com sucesso');
            return true;
        }else{
            return false;
        }
           
    }
    /*
    function mdelete($id) {
        if($this->db->delete('Organismos_Tutela', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
    */       
  }
