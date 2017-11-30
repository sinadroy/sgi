<?php

class Cpautas_professores_imp extends CI_Controller {
    public function imprimir() {
        $al = $this->input->post('al');
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $p = $this->input->post('p');
        $d = $this->input->post('d');
        $idd = $this->input->post('idd');
        $this->load->model('Mpautas_professores_imp');
        $this->Mpautas_professores_imp->criarPdf($al,$n,$c,$p,$d,$idd);
    }
}
