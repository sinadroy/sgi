<?php

class CFinancas_Pagamentos_Inscricao_2S_Comprovativo_IMP extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $data = $request['data'];
        $hora = $request['hora'];
        $utilizadores_id = $request['utilizadores_id'];
        //crear codigo de barra unico para cada comprobativo
        //Formato CB "I Data Hora"
        $codigo = "I ".$data." ".$hora;
        $this->load->model('mGerar_Codigo_Barra');
        $codigo_barra = $this->mGerar_Codigo_Barra->criarCB($codigo);
        //registrar pago pendiente

        $this->load->model('mFinancas_Pagamentos_Inscricao_2S_Comprovativo_IMP');
        $this->mFinancas_Pagamentos_Inscricao_2S_Comprovativo_IMP->criarPdf($id,$codigo_barra,$codigo,$utilizadores_id);
    }
}
