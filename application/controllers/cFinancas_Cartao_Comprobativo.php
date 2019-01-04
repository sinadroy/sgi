<?php

class CFinancas_Cartao_Comprobativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $total_pagar = $request['total_pagar'];
        $bancNome = $request['bancNome'];
        $contNumero = $request['contNumero'];
        $ffpNome = $request['ffpNome'];
        $fpcRefPagamento = $request['fpcRefPagamento'];
        $utilizadores_id = $request['utilizadores_id'];
        
        $this->load->model('MFinancas_Cartao_Comprobativo');
        $this->MFinancas_Cartao_Comprobativo->criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id);
    }
}
