<?php

class CAcademica_Distribuicao_Candidatos_IMP extends CI_Controller {
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
        
        $this->load->model('MAcademica_Distribuicao_Candidatos_IMP');
        $this->MAcademica_Distribuicao_Candidatos_IMP->criarPdf($a,$n,$c,$p,$t,$d,$h,$utilizador);
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