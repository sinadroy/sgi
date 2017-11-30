<?php

class Cplanificacoes_imp extends CI_Controller {
    public function imprimir(){
        $request = $_GET;
        $s = @$request['s'];
        
        $this->load->model('Mplanificacoes_imp');
        $this->Mplanificacoes_imp->criarPdf($s);
    }
}