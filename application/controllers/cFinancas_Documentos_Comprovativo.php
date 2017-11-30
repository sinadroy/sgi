<?php

class CFinancas_Documentos_Comprovativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $total_pagar = $request['total_pagar'];
        $bancNome = $request['bancNome'];
        $contNumero = $request['contNumero'];
        $ffpNome = $request['ffpNome'];
        $fpcRefPagamento = @$request['fpcRefPagamento'];
        $utilizadores_id = $request['utilizadores_id'];
        $td = $request['td'];
        $efeito = $request['efeito'];

        //cambiar estado do candidato
        //$this->load->model('MEstudantes');
        //$this->MEstudantes->cambiar_estado($id,"Conf.Mat.Aceite");
        
        $this->load->model('MFinancas_Documentos_Comprovativo');
        $this->MFinancas_Documentos_Comprovativo->criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id,$td,$efeito);
    }
}
