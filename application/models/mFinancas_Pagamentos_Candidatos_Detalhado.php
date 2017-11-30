<?php
class MFinancas_Pagamentos_Candidatos_Detalhado extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('Financas_Pagamentos_Candidatos.id,Financas_Pagamentos_Candidatos.fpcCodigoBarra,
        Financas_Pagamentos_Candidatos.fpcData,Financas_Pagamentos_Candidatos.fpcHora,
        Financas_Pagamentos_Candidatos.fpcValor,Financas_Pagamentos_Candidatos.fpcRefPagamento,
        
        Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id,Financas_Tipo_Pagamento.ftpNome,
        
        Financas_Pagamentos_Candidatos.Financas_Forma_Pagamento_id, Financas_Forma_Pagamento.ffpNome,
        
        Financas_Pagamentos_Candidatos.Financas_Contas_id, Financas_Contas.contNumero, Financas_Contas.contNome,

        Financas_Contas.Financas_Bancos_id, Financas_Bancos.bancNome,
        
        Candidatos.cNome, Candidatos.cApelido, Candidatos.cBI_Passaporte,
        
        utilizadores.uNome, utilizadores.uApelido, utilizadores.uUsuario');
        $this->db->from('Financas_Pagamentos_Candidatos');
        $this->db->join('Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('utilizadores', 'Financas_Pagamentos_Candidatos.utilizadores_id = utilizadores.id');

        $this->db->join('Financas_Tipo_Pagamento', 'Financas_Pagamentos_Candidatos.Financa_Tipo_Pagamento_id = Financas_Tipo_Pagamento.id');
        $this->db->join('Financas_Forma_Pagamento', 'Financas_Pagamentos_Candidatos.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
        $this->db->join('Financas_Contas', 'Financas_Pagamentos_Candidatos.Financas_Contas_id = Financas_Contas.id');
        $this->db->join('Financas_Bancos', 'Financas_Contas.Financas_Bancos_id = Financas_Bancos.id');
        $this->db->order_by('fpcData,fpcHora','DESC');
        $consulta = $this->db->get();
        $ord = 1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
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

                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,

                "uNome" => $row->uNome,
                "uApelido" => $row->uApelido,
                "uUsuario" => $row->uUsuario,
            );
            $ord++;
        }
        return $data;
    }
    
    
    function minsert($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                $ftpNome,$ffpNome,$contNumero,$utilizadores_id){
        //Tabla Candidato
        $pag = array('Candidatos_id'=>$Candidatos_id, 'fpcCodigoBarra'=>$fpcCodigoBarra, 'fpcData'=>$fpcData, 'fpcHora'=>$fpcHora, 'fpcValor'=>$fpcValor, 'fpcRefPagamento'=>$fpcRefPagamento,
                     'Financa_Tipo_Pagamento_id'=>$ftpNome, 'Financas_Forma_Pagamento_id'=>$ffpNome, 'Financas_Contas_id'=>$contNumero,
                     'utilizadores_id'=>$utilizadores_id);
        
        if ($this->db->insert('Financas_Pagamentos_Candidatos', $pag))
            return true;
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
