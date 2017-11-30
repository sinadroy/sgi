<?php

class CAcademica_Inscricao_2_sessao_IMP extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $a = $request['alAno'];
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $utilizador = $request['utilizador'];
        //$tipo_doc = $request['tipo_doc'];
        
        $this->load->model('MAcademica_Inscricao_2_sessao_IMP');
        $this->MAcademica_Inscricao_2_sessao_IMP->criarPdf($a,$n,$c,$p,$utilizador);
    }

}