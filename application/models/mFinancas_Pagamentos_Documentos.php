<?php
class MFinancas_Pagamentos_Documentos extends CI_Model {

    
    
    function minsert($fpdData,$fpdHora,$fpdValor,$fpdusuario,$Estudantes_id,
            $Financas_Forma_Pagamento_id, $Financas_Contas_id, $tipo_documentos_id, $motivo_id, $fpdrefpagamento){

        //Tabla Candidato
        $pag = array('fpddata'=>$fpdData, 'fpdhora'=>$fpdHora, 'fpdvalor'=>$fpdValor, 'fpdusuario'=>$fpdusuario,
                     'Estudantes_id'=>$Estudantes_id, 'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id, 'Financas_Contas_id'=>$Financas_Contas_id,
                     'tipo_documentos_id'=>$tipo_documentos_id, 'motivo_id'=>$motivo_id, 'fpdrefpagamento'=>$fpdrefpagamento);
        
        if ($this->db->insert('financas_pagamaentos_documentos', $pag)){
            //$this->load->model('MAuditorias_Financas');
            //$this->MAuditorias_Financas->minsert("Inserir Pagamento Insc.","Financa","FInscrição",$utilizadores_id,"Candidato:".$cNome.' '.$cApelido.' Pagamento com sucesso');
            return true;
        }
        else
            return false;
        
    }

    
    

    function mdelete($id) {
        if($this->db->delete('financas_pagamaentos_documentos', array('id' => $id)))
            return true;
        else
            return false;
    }

}

?>
