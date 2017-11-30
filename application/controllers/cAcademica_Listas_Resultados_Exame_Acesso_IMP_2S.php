<?php

class CAcademica_Listas_Resultados_Exame_Acesso_IMP_2S extends CI_Controller {
    public function imprimir(){
        $request = $_POST;
        $a = $request['alAno'];
        $n = $request['nNome'];
        $c = $request['cNome'];
        $p = $request['pNome'];
        $utilizador = $request['utilizador'];
        $tipo_doc = $request['tipo_doc'];
        
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso_IMP_2S');
        $this->MAcademica_Listas_Resultados_Exame_Acesso_IMP_2S->criarPdf($a,$n,$c,$p,$utilizador,$tipo_doc);
    }

}