<?php

class CFinancas_Inscricao_Comprobativo extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $data = $request['data'];
        $hora = $request['hora'];
        //crear codigo de barra unico para cada comprobativo
        //Formato CB "I Data Hora"
        $codigo = "IA ".$data." ".$hora;
        $this->load->model('mGerar_Codigo_Barra');
        $codigo_barra = $this->mGerar_Codigo_Barra->criarCB($codigo);

        $this->load->model('mFinancas_Inscricao_Comprobativo');
        $this->mFinancas_Inscricao_Comprobativo->criarPdf($id,$codigo_barra);
    }
}
