<?php

class CInscricao_Lista extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $al = $request['alAno'];
        $utilizador = $request['utilizador'];
        
        $this->load->model('mInscricao_Lista');
        $this->mInscricao_Lista->criarPdf($n,$c,$p,$al,$utilizador);
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