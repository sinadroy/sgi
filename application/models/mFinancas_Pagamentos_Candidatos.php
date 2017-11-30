<?php
class MFinancas_Pagamentos_Candidatos extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('Financas_Pagamentos_Candidatos.id  as fpc_id, Candidatos.id, Financas_Pagamentos_Candidatos.fpcCodigoBarra,
        Financas_Pagamentos_Candidatos.fpcData,Financas_Pagamentos_Candidatos.fpcHora,
        Financas_Pagamentos_Candidatos.fpcValor,Financas_Pagamentos_Candidatos.fpcRefPagamento,
        
        Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id,Financas_Tipo_Pagamento.ftpNome,
        
        Financas_Pagamentos_Candidatos.Financas_Forma_Pagamento_id, Financas_Forma_Pagamento.ffpNome,
        
        Financas_Pagamentos_Candidatos.Financas_Contas_id, Financas_Contas.contNumero, Financas_Contas.contNome,

        Financas_Contas.Financas_Bancos_id, Financas_Bancos.bancNome');
        $this->db->from('Financas_Pagamentos_Candidatos');

        $this->db->join('Financas_Tipo_Pagamento', 'Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id = Financas_Tipo_Pagamento.id');
        $this->db->join('Financas_Forma_Pagamento', 'Financas_Pagamentos_Candidatos.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
        $this->db->join('Financas_Contas', 'Financas_Pagamentos_Candidatos.Financas_Contas_id = Financas_Contas.id');
        $this->db->join('Financas_Bancos', 'Financas_Contas.Financas_Bancos_id = Financas_Bancos.id');
        $this->db->join('Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->order_by('fpcData,fpcHora','DESC');
        $consulta = $this->db->get();
        $ord = 1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "fpc_id"=> $row->fpc_id,
                "ord" => $ord,
                "fpcCodigoBarra" => $row->fpcCodigoBarra,
                "fpcData" => $row->fpcData,
                "fpcHora" => $row->fpcHora,
                "fpcValor" => $row->fpcValor,
                "fpcRefPagamento" => $row->fpcRefPagamento,
                "ftpNome" => $row->ftpNome,
                "ffpNome" => $row->ffpNome,
                "contNumero" => $row->contNumero,
                "contNome" => $row->contNome,
                "bancNome" => $row->bancNome,
            );
            $ord++;
        }
        return $data;
    }

    //$this->db->select_sum('age');
    function mread_valor_total_inscricao() {
        $this->db->select_sum('fpcValor');
        $this->db->from('Financas_Pagamentos_Candidatos');
        $this->db->where('Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id', 1);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
                $valor_total_inscricao = $row->fpcValor;
        }
        return $valor_total_inscricao;
    }

    function mread_pag_X_candidato($id) {
        $this->db->select('Financas_Pagamentos_Candidatos.id');
        $this->db->from('Financas_Pagamentos_Candidatos');
        //$this->db->join('Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->where('Financas_Pagamentos_Candidatos.Candidatos_id', $id);
        $this->db->where('Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id', 1);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }
    
    function mCancelar_Pagamento($id,$usuario) {

        $pag_id = $this->mread_pag_X_candidato($id);
        $this->load->model('MAuditorias_Financas');
        $this->load->model('mCandidatos');

        $cNome = $this->mCandidatos->mreadNomeXID($id);
        $cApelido = $this->mCandidatos->mreadApelidoXID($id);

        if($this->db->delete('Financas_Pagamentos_Candidatos', array('id' => $pag_id)) && $this->mCandidatos->cambiar_estado($id,"Espera de Pagamento")){
            $this->MAuditorias_Financas->minsert("Cancelar Pagamento Insc.","Financa","FInscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Pagamento cancelado com sucesso');
            return true;
        }
        else
            return false;
    }
    
    function minsert($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id){

        $this->load->model('mCandidatos');
        $cNome = $this->mCandidatos->mreadNomeXID($Candidatos_id);
        $cApelido = $this->mCandidatos->mreadApelidoXID($Candidatos_id);

        //Tabla Candidato
        $pag = array('Candidatos_id'=>$Candidatos_id, 'fpcCodigoBarra'=>$fpcCodigoBarra, 'fpcData'=>$fpcData, 'fpcHora'=>$fpcHora, 'fpcValor'=>$fpcValor, 'fpcRefPagamento'=>$fpcRefPagamento,
                     'Financa_Tipo_Pagamento_id'=>$ftpNome, 'Financas_Forma_Pagamento_id'=>$ffpNome, 'Financas_Contas_id'=>$contNumero,
                     'utilizadores_id'=>$uid);
        
        if ($this->db->insert('Financas_Pagamentos_Candidatos', $pag)){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Inserir Pagamento Insc.","Financa","FInscrição",$utilizadores_id,"Candidato:".$cNome.' '.$cApelido.' Pagamento com sucesso');
            return true;
        }
        else
            return false;
        
    }
    function minsert_confirmacao($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id){

        $this->load->model('mCandidatos');
        $cNome = $this->mCandidatos->mreadNomeXID($Candidatos_id);
        $cApelido = $this->mCandidatos->mreadApelidoXID($Candidatos_id);

        //Tabla Candidato
        $pag = array('Candidatos_id'=>$Candidatos_id, 'fpcCodigoBarra'=>$fpcCodigoBarra, 'fpcData'=>$fpcData, 'fpcHora'=>$fpcHora, 'fpcValor'=>$fpcValor, 'fpcRefPagamento'=>$fpcRefPagamento,
                     'Financa_Tipo_Pagamento_id'=>$ftpNome, 'Financas_Forma_Pagamento_id'=>$ffpNome, 'Financas_Contas_id'=>$contNumero,
                     'utilizadores_id'=>$uid);
        
        if ($this->db->insert('Financas_Pagamentos_Candidatos', $pag)){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Inserir Pagamento.","Financa","FConfirmação",$utilizadores_id,"Candidato:".$cNome.' '.$cApelido.' Pagamento com sucesso');
            return true;
        }
        else
            return false;
        
    }

    function minsert_matricula($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id){

        $this->load->model('mCandidatos');
        $cNome = $this->mCandidatos->mreadNomeXID($Candidatos_id);
        $cApelido = $this->mCandidatos->mreadApelidoXID($Candidatos_id);

        //Tabla Candidato
        $pag = array('Candidatos_id'=>$Candidatos_id, 'fpcCodigoBarra'=>$fpcCodigoBarra, 'fpcData'=>$fpcData, 'fpcHora'=>$fpcHora, 'fpcValor'=>$fpcValor, 'fpcRefPagamento'=>$fpcRefPagamento,
                     'Financa_Tipo_Pagamento_id'=>$ftpNome, 'Financas_Forma_Pagamento_id'=>$ffpNome, 'Financas_Contas_id'=>$contNumero,
                     'utilizadores_id'=>$uid);
        
        if ($this->db->insert('Financas_Pagamentos_Candidatos', $pag)){
            $this->load->model('MAuditorias_Financas');
            $this->MAuditorias_Financas->minsert("Inserir Pagamento.","Financa","FMatrícula",$utilizadores_id,"Estudante:".$cNome.' '.$cApelido.' Pagamento com sucesso');
            return true;
        }
        else
            return false;
        
    }

    function mdelete($id) {
        if($this->db->delete('Financas_Pagamentos_Candidatos', array('id' => $id)))
            return true;
        else
            return false;
    }

}

?>
