<?php

class Cfinancas_propinas_dividas_imp extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $al = $request['al'];
        $alt = $request['alt'];
        $n = $request['n'];
        $c = $request['c'];
        $p = $request['p'];
        $ac = $request['ac'];
        $t = $request['t'];
        $mid = $request['mid'];
        $mt = $request['mt'];
        $utilizador = $request['utilizador'];
        
        $this->load->model('Mfinancas_propinas_dividas_imp');
        $this->Mfinancas_propinas_dividas_imp->criarPdf($al,$alt,$n,$c,$p,$ac,$t,$mid,$mt,$utilizador);
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