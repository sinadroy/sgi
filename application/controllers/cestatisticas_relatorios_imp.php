<?php

class Cestatisticas_relatorios_imp extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $al = $request['al'];
        $n = $request['n'];
        $c = $request['c'];
        $p = $request['p'];
        $ac = $request['ac'];
        $g = $request['g'];
        
        $this->load->model('mestatisticas_relatorios_imp');
        $this->mestatisticas_relatorios_imp->criarPdf($al,$n,$c,$p,$ac,$g);
    }
}