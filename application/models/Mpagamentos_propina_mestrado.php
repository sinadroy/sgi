<?php
  class Mpagamentos_propina_mestrado extends CI_Model{
      
      function mread(){
          $this->db->select('Pagamentos_Propina_Mestrado.id,ppData,ppHora,ppValor,
                Candidatos.cNome,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.id as cid, Estudantes.id as eid,
                Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id, Meses_Propina_Mestrado.mesNome');
          $this->db->from('Pagamentos_Propina_Mestrado');
          $this->db->join('Meses_Propina_Mestrado', 'Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id = Meses_Propina_Mestrado.id');
          $this->db->join('Estudantes', 'Pagamentos_Propina_Mestrado.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          
          $this->db->order_by('Meses_Propina_Mestrado_id','ASC');
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
                        //"Meses_Propina_id" => $row->Meses_Propina_id,

                        "mesNome" => $row->mesNome,

                        "cNome" => $row->cNome,
                        "cApelido" => $row->cApelido,
                        "cBI_Passaporte" => $row->cBI_Passaporte,

                        "ppData" => $row->ppData,
                        "ppHora" => $row->ppHora,
                        "ppValor" => $row->ppValor,

                        "alAno" => date('Y')
                    );
                    $ord++;
                }
            }
            return $data;
      }

      function mreadX($bi,$alano){
          $this->db->select('Pagamentos_Propina_Mestrado.id,ppData,ppHora,ppValor,
                Candidatos.cNome,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.id as cid, Estudantes.id as eid,
                Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id, Meses_Propina_Mestrado.mesNome,
                anos_lectivos.alAno');
          $this->db->from('Pagamentos_Propina_Mestrado');
          $this->db->join('Meses_Propina_Mestrado', 'Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id = Meses_Propina_Mestrado.id');
          $this->db->join('Estudantes', 'Pagamentos_Propina_Mestrado.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->join('anos_lectivos', 'Pagamentos_Propina_Mestrado.anos_lectivos_id = anos_lectivos.id');
          if($alano != "")
            $this->db->where('anos_lectivos.id', $alano);
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $this->db->order_by('Meses_Propina_Mestrado_id','ASC');
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

      

      /*
      ver preco de propina de nivesis_cursos para este BI
      */
      function mreadXvalor_propina($bi, $mes_a_pagar, $ano_a_pagar){
          //cargar el porciento de multa a aplicarse
          $this->load->model('mmultas_propina_mestrado');
          $porc = $this->mmultas_propina_mestrado->mread_porciento($mes_a_pagar, $ano_a_pagar);

          $this->db->select('niveis_cursos.ncPreco_Propina');
          $this->db->from('niveis_cursos');
          $this->db->join('Estudantes', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $consulta = $this->db->get();
          $data = array();
          //$multa = 0;
            foreach ($consulta->result() as $row) {
                 if($porc == 0){
                     return $row->ncPreco_Propina;
                 }else{
                     $multa = ($row->ncPreco_Propina * $porc) / 100;
                     return $row->ncPreco_Propina + $multa;
                 }
            }
      }
      //lo mismo de arriba pero por id_est
      function mreadXide_valor_propina($eid, $mes_a_pagar, $ano_a_pagar){
          //cargar el porciento de multa a aplicarse
          $this->load->model('mmultas_propina_mestrado');
          $porc = $this->mmultas_propina_mestrado->mread_porciento($mes_a_pagar, $ano_a_pagar);

          $this->db->select('niveis_cursos.ncPreco_Propina');
          $this->db->from('niveis_cursos');
          $this->db->join('Estudantes', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
          //$this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('Estudantes.id', $eid);
          $consulta = $this->db->get();
          $data = array();
          foreach ($consulta->result() as $row) {
                 if($porc == 0){
                     return $row->ncPreco_Propina;
                 }else{
                     $multa = ($row->ncPreco_Propina * 100) / $porc;
                     return $row->ncPreco_Propina + $multa;
                 }
          }
      }

      function mExiste_Pagamento($bi,$alAno){
          $this->db->select('Pagamentos_Propina_Mestrado.id');
          $this->db->from('Pagamentos_Propina_Mestrado');
          $this->db->join('Estudantes', 'Pagamentos_Propina_Mestrado.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->join('anos_lectivos', 'Pagamentos_Propina_Mestrado.anos_lectivos_id = anos_lectivos.id');
          $this->db->where('anos_lectivos.id', $alAno);
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
            return true;
          else{
              //get id estudante apartir del bi
              $this->load->model('MEstudantes');
              $eid = $this->MEstudantes->mreadIDxBI($bi);
              //get ano lectivo id apartir del ano actual
              //$this->load->model('MAnos_Lectivos');
              $alid = $alAno;//$this->MAnos_Lectivos->mGetID(date('Y'));
              // get id del usuario admin
              $this->load->model('mutilizadores');
              $uid = $this->mutilizadores->mreadXnome("admin");
              //date
              $ppData = date('Y-m-d');;
              //Hora
              $ppHora = date('H:i:s'); 
              //valor
              $ppValor = 0;
              //determinar financa_conta_id
              $this->load->model('mFinancas_Contas');
              $financa_conta_id = $this->mFinancas_Contas->mreadIDXNome("Sistema");
              //recorrer los meses activos de Meses_Propina para inserir pagamentos en 0
              $this->load->model('Mmeses_propina_mestrado');
              foreach ($this->Mmeses_propina_mestrado->mreadXactivos() as $row) {
                    //$row->id meses de propina id
                    $this->minsert($alid,$ppData,$ppHora,$ppValor,$row->id,$eid,$uid,2,$financa_conta_id);
              }
              return false;
         }
      }
      
      function mcancelar_pagamento($id,$utilizadores_id,$user,$cNome,$cApelido,$cBI_Passaporte){
          //get id financas_contas_id
        $this->load->model('mFinancas_Contas');
        $financa_conta_id = $this->mFinancas_Contas->mreadIDXNome("Sistema");
        $dados = array('ppValor'=>0,'utilizadores_id'=>$utilizadores_id,'Financas_Contas_id'=>$financa_conta_id);
        if($this->db->update('Pagamentos_Propina_Mestrado', $dados, array('id' => $id))){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Cancelar:Pagamento","Financa","Pag.Propinas.Mestrado",$user,"Estudante:".$cNome.' '.$cApelido.' BI:'.$cBI_Passaporte.' Cancelado com sucesso');
            return true;
        }else
            return false;
     }

     //pendiente 
     function mdt_divida($al,$n,$c,$p,$m,$bi){
          $this->db->select('Pagamentos_Propina_Mestrado.id,ppData,ppHora,ppValor,
                Candidatos.cNome,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.id as cid, Estudantes.id as eid,
                Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id, Meses_Propina_Mestrado.mesNome,
                anos_lectivos.alAno');
          $this->db->from('Pagamentos_Propina_Mestrado');
          $this->db->join('anos_lectivos', 'Pagamentos_Propina_Mestrado.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Meses_Propina_Mestrado', 'Pagamentos_Propina_Mestrado.Meses_Propina_Mestrado_id = Meses_Propina_Mestrado.id');
          $this->db->join('Estudantes', 'Pagamentos_Propina_Mestrado.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->where('anos_lectivos.id', $al);
          $this->db->where('niveis.id', $n);
          $this->db->where('cursos.id', $c);
          $this->db->where('periodos.id', $p);
          $this->db->where('ppValor >', 0);
          $this->db->where('Meses_Propina_Mestrado_id', $m);
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      //cargar pagamentos por ano lec, nivel, curso, periodo, turma
      function mread_dividas_turmas($al,$alt,$n,$c,$p,$ac,$t,$m,$mt){
          $this->db->select('Estudantes.id,Candidatos.cBI_Passaporte,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,
                niveis.nNome, cursos.cNome as curso, periodos.pNome, Ano_Curricular.acNome, turmas.tNome');
		$this->db->from('Estudantes');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
		$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
		$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
		$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
		
		$this->db->join('Ano_Curricular', 'Estudantes.Ano_Curricular_id = Ano_Curricular.id');
		$this->db->join('semestres', 'Estudantes.semestres_id = semestres.id');
		$this->db->join('turmas', 'Estudantes.turmas_id = turmas.id');
        
		$this->db->where('niveis.id', $n);
		$this->db->where('cursos.id', $c);
		$this->db->where('periodos.id', $p);
		$this->db->where('Estudantes.Ano_Curricular_id', $ac);
		$this->db->where('Estudantes.turmas_id', $t);

		$this->db->order_by('Candidatos.cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
            // verificar si el estudiante actual tiene divida
            if($this->mdt_divida($al,$n,$c,$p,$m,$row->cBI_Passaporte) == false){
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "cNome" => $row->cNome,
                    "cNomes" => $row->cNomes,
                    "cApelido" => $row->cApelido,
                    "cBI_Passaporte" => $row->cBI_Passaporte,
                    "nNome" => $row->nNome,
                    "curso" => $row->curso,
                    "pNome" => $row->pNome,
                    "acNome" => $row->acNome,
                    "tNome" => $row->tNome,
                    "divida" => $this->mreadXvalor_propina($row->cBI_Passaporte, $mt, $alt)
                );
            }
			$ord++;	
		}
		return $data;
      }

    function mupdate($id,$ppData,$ppHora,$ppValor,$utilizadores_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$fpcRefPagamento,$cNome,$bi,$user){
        $dados = array('ppData'=>$ppData,'ppHora'=>$ppHora,'ppValor'=>$ppValor,'utilizadores_id'=>$utilizadores_id,
                'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id,'Financas_Contas_id'=>$Financas_Contas_id,
                'fpcRefPagamento'=>$fpcRefPagamento);
        if($this->db->update('Pagamentos_Propina_Mestrado', $dados, array('id' => $id))){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Inserir:Pagamento","Financa","Pag.Propinas.Mestrado",$user,"Estudante:".$cNome.' BI:'.$bi.' inserido com sucesso');
            return true;
        }else
            return false;
    }
      
    function minsert($anos_lectivos_id,$ppData,$ppHora,$ppValor,$Meses_Propina_id,$Estudantes_id,$utilizadores_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id){
        $dados = array('anos_lectivos_id'=>$anos_lectivos_id,'ppData'=>$ppData,'ppHora'=>$ppHora,'ppValor'=>$ppValor,'Meses_Propina_Mestrado_id'=>$Meses_Propina_id,
            'Estudantes_id'=>$Estudantes_id,'utilizadores_id'=>$utilizadores_id,'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id,'Financas_Contas_id'=>$Financas_Contas_id);
        if($this->db->insert('Pagamentos_Propina_Mestrado', $dados))
        {
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
