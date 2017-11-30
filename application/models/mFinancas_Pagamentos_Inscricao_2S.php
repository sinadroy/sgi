<?php
class MFinancas_Pagamentos_Inscricao_2S extends CI_Model {

    /*
     * lista de pagamentoi de candidatos de segunda sessao 
    */
    function mread() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado2s');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('Candidatos.cSessao',2);
        $consulta = $this->db->get();
        $data = array();
        $ord = 1;
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "ord" => $ord,
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado2s" => $row->cEstado2s,
                "alAno" => $row->alAno
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Personales
    */
 /*   function mread() {
        $this->db->select('Financas_Pagamentos_Candidatos.id,Financas_Pagamentos_Candidatos.fpcCodigoBarra,
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
        
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
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
*/
}

?>
