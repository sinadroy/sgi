<?php
class CAcademica_Listas_Resultados_Exame_Acesso_2S extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readX(){
        $request = $_GET;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso_2S');
        echo json_encode($this->MAcademica_Listas_Resultados_Exame_Acesso_2S->mreadX($alAno,$nNome,$cNome,$pNome));
    }
    

    public function crud(){
        $request = $_POST;
        $apecCodigoBarra = @$request['apecCodigoBarra'];
        $apecNota = $request["apecNota"];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso_2S');
        /*
        if ($webix_operation == "insert"){
            if($this->MAcademica_Planificacao_Exame_Ingreso->minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true";
            else
                echo "false";

        } else */ 
        if ($webix_operation == "update"){
            if($this->MAcademica_Listas_Resultados_Exame_Acesso_2S->mupdate($apecCodigoBarra,$apecNota))
                echo "true"; 
            else
                echo "false";
        }
    }
}