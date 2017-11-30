<?php

class CAcademica_Listas_Resultados_Exame_Acesso_IMP extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $a = $request['alAno'];
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $utilizador = $request['utilizador'];
        $tipo_doc = $request['tipo_doc'];

        $provFormacao = $request['provFormacao'];
        $idade_minima = $request['idade_minima'];
        $idade_maxima = $request['idade_maxima'];
        
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso_IMP');
        $this->MAcademica_Listas_Resultados_Exame_Acesso_IMP->criarPdf($a,$n,$c,$p,$utilizador,$tipo_doc,$provFormacao,$idade_minima,$idade_maxima);
    }

}