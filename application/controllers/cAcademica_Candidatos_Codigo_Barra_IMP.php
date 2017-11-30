<?php

class CAcademica_Candidatos_Codigo_Barra_IMP extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $a = $request['alAno'];
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $t = $request['atcNome'];
        $d = $request['apeiData'];
        $h = $request['apeiHora'];
        $utilizador = $request['utilizador'];
        
        $this->load->model('MAcademica_Candidatos_Codigo_Barra_IMP');
        $this->MAcademica_Candidatos_Codigo_Barra_IMP->criarPdf($a,$n,$c,$p,$t,$d,$h,$utilizador);
    }
}