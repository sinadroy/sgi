<?php
class MFinancas_Pagamentos_Pendientes_Candidatos extends CI_Model {
    
    function mExiste_Pag($cid,$tpag){
          $this->db->select('id');
          $this->db->from('Financas_Pagamentos_Pendientes_Candidatos');
          $this->db->where('Candidatos_id', $cid);
          $this->db->where('Financas_Tipo_Pagamento_id', $tpag);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
    }
    /*
     * Cargar Datos de inscricao para modulo financas/inscricao apartir del codigo de barra
    */
    function mreadXcb($cb){
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        if($cb != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $cb);
            $this->db->where('Candidatos.id', $cb);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->alAno,
                "fppcCodigoBarra"=>$row->fppcCodigoBarra,
                "value"=>$row->fppcCodigoBarra,
            );
        }
        return $data;
    }
    /*
        para interface de pagamento de inscricao em financas
    */
    function mread_ncpXid($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $id);
            $this->db->where('Candidatos.id', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao" =>  $row->ncPreco_Inscricao
            );
        }
        return $data;
    }
    /*
        para interface de pagamento de confirmacao de matricula em financas
    */
    function mread_ncpXid_CM($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Confirmacao');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        //$this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.eEstado_Matricula', "Conf.Mat.Esp.Pag");
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $id);
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Confirmacao" =>  $row->ncPreco_Confirmacao
            );
        }
        return $data;
    }

    /*
        para interface de pagamento de matricula em financas
    */
    function mread_ncpXid_M($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Matricula');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        //$this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.eEstado_Matricula1', "Mat.Esp.Pag");
        if($id != ""){
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Financas_Tipo_Pagamento_id', 4); //Matricula
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Matricula" =>  $row->ncPreco_Matricula
            );
        }
        return $data;
    }

    /*
        para interface de pagamento de inscricao em financas
    */
    function mread_ncpXid2($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado2s', "Espera de Pagamento");
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $id);
            //$this->db->where('Candidatos.id', $id);
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao" =>  $row->ncPreco_Inscricao
            );
        }
        return $data;
    }
    /*
    para pagamento de inscricao 2 sessao por BI
    */
    function mread_ncpXid3($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao2s');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado2s', "Espera de Pagamento");
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $id);
            //$this->db->where('Candidatos.id', $id);
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $id);
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao2s" =>  $row->ncPreco_Inscricao2s
            );
        }
        return $data;
    }

    /*
        para ver si ya existe um pagamento de un candidato y de un tipo especifico, para evitar duplicado
    */
    function mExiste_Pag_Pendiente($Candidatos_id, $Financas_Tipo_Pagamento_id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        $this->db->where('Candidatos.id', $Candidatos_id);
        $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Financas_Tipo_Pagamento_id', $Financas_Tipo_Pagamento_id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }

    /*
        para saber estado actual del candidato
    */
    function mread_estado_pagamento($id)
    {
        $this->db->select('Candidatos.cEstado');
        $this->db->from('Candidatos');
        $this->db->where('Candidatos.id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row){
              return $row->cEstado;
        }
    }

    /*
        para saber estado actual del candidato
    */
    function mread_estado_pagamento_estudantes($id)
    {
        $this->db->select('Estudantes.eEstado_Matricula');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row){
              return $row->eEstado_Matricula;
        }
    }
    function mread_estado_pagamento_estudantes_matricula($id)
    {
        $this->db->select('Estudantes.eEstado_Matricula1');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row){
              return $row->eEstado_Matricula1;
        }
    }
    /*
        para interface de pagamento de inscricao em financas
    */
    function mreadXcb_valor_total_inscricao($cb)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        if($cb != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $cb);
            $this->db->where('Candidatos.id', $cb);
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar += $row->ncPreco_Inscricao;
        }
        return $total_pagar;
    }

    function mreadXcb_valor_total_inscricao_2S($cb)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado2s', "Espera de Pagamento");
        $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Financas_Tipo_Pagamento_id', 2);
        if($cb != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $cb);
            //$this->db->where('Candidatos.id', $cb);
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $cb);
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar += $row->ncPreco_Inscricao;
        }
        return $total_pagar;
    }
    /*
    para pagamento de inscricao segunda sessao
    */
    function mreadXcb_valor_total_inscricao_2S1($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao2s');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.cEstado2s', "Espera de Pagamento");
        $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Financas_Tipo_Pagamento_id', 2);
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $cb);
            //$this->db->where('Candidatos.id', $cb);
            $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id', $id);
            
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar += $row->ncPreco_Inscricao2s;
        }
        return $total_pagar;
    }
    /*
    para pagamento de inscricao segunda sessao
    */
    function mreadXcb_valor_total_inscricao_2S_REIMP($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome,
            niveis_cursos.ncPreco_Inscricao2s');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos_2S', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        //$this->db->where('Candidatos.cEstado2s', "Espera de Pagamento");
        $this->db->where('Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id', 2);
        if($id != ""){
            //$this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $cb);
            //$this->db->where('Candidatos.id', $cb);
            $this->db->where('Financas_Pagamentos_Candidatos.Candidatos_id', $id);
            
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar += $row->ncPreco_Inscricao2s;
        }
        return $total_pagar;
    }
    /*
        para interface de pagamento de confirmacao de matricula em financas
    */
    function mreadXcb_valor_total_confirmacao($cb)
    {
        $this->db->select('niveis_cursos.ncPreco_Confirmacao');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.eEstado_Matricula', "Conf.Mat.Esp.Pag");
        if($cb != ""){
            $this->db->where('Candidatos.id', $cb);
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar = $row->ncPreco_Confirmacao;
        }
        return $total_pagar;
    }

    

    /*
        para interface de pagamento de confirmacao de matricula em financas
    */
    function mreadXcb_valor_total_matricula($cb)
    {
        $this->db->select('niveis_cursos.ncPreco_Matricula');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Estudantes.eEstado_Matricula1', "Mat.Esp.Pag");
        if($cb != ""){
            $this->db->where('Candidatos.id', $cb);
        }
        $consulta = $this->db->get();
        $total_pagar = 0;
        foreach ($consulta->result() as $row) {
              $total_pagar = $row->ncPreco_Matricula;
        }
        return $total_pagar;
    }
    /*
        Inserir pagamento pendiente
        fppcData,fppcCodigoBarra,Financas_Tipo_Pagamento_id,Candidatos_id,
    */
    function minsert($fppcData,$fppcCodigoBarra,$Financas_Tipo_Pagamento_id,$Candidatos_id){
        //Tabla Candidato
        $pag = array('fppcData'=>$fppcData,'fppcCodigoBarra'=>$fppcCodigoBarra,'Financas_Tipo_Pagamento_id'=>$Financas_Tipo_Pagamento_id,'Candidatos_id'=>$Candidatos_id);
        
        if ($this->db->insert('Financas_Pagamentos_Pendientes_Candidatos', $pag)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    Retornar candidatos_id
    */
   /* function getCandidatos_id($id){
        $this->db->select('Cursos_Pretendidos.Candidatos_id');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $cid = $row->Candidatos_id;
        }
        return $cid;
    }*/
    /*
        APAGAR PAGAMENTO PENDIENTE
    */
    function mdelete($id){
        //$cid = $this->getCandidatos_id($id);
        if($this->db->delete('Financas_Pagamentos_Pendientes_Candidatos', array('Candidatos_id' => $id)))
            return true;
        else
            return false;
    }
}

?>
