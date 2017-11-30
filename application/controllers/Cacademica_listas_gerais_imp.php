<?php

class Cacademica_listas_gerais_imp extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $ac = $request['ac'];
        $t = $request['t'];
        $s = $request['s'];
        $utilizador = $request['utilizador'];
        
        $this->load->model('Macademica_listas_gerais_imp');
        $this->Macademica_listas_gerais_imp->criarPdf($n,$c,$p,$ac, $t, $s, $utilizador);
    }
/*
    public function teste()
    {
        $this->load->model('mCandidatos');
        foreach ($this->mCandidatos->mreadXncp('1','1','1') as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $cEstado = $value['cEstado'];
            $alAno = $value['alAno'];
            //$contador++;
            echo $cNome;
        }
    }
    */ 
}