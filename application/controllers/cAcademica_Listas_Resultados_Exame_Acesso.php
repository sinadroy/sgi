<?php
class CAcademica_Listas_Resultados_Exame_Acesso extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readX(){
        $request = $_GET;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso');
        echo json_encode($this->MAcademica_Listas_Resultados_Exame_Acesso->mreadX($alAno,$nNome,$cNome,$pNome));
    }
    

    public function crud(){
        $request = $_POST;
        $apecCodigoBarra = @$request['apecCodigoBarra'];
        $apecNota = $request["apecNota"];
        $condicionado = $request["condicionado"];
        $apecid = $request["apecid"];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso');
        /*
        if ($webix_operation == "insert"){
            if($this->MAcademica_Planificacao_Exame_Ingreso->minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true";
            else
                echo "false";

        } else */ 
        if ($webix_operation == "update"){
            if($this->MAcademica_Listas_Resultados_Exame_Acesso->mupdate($apecid,$apecCodigoBarra,$apecNota,$condicionado))
                echo "true"; 
            else
                echo "false";
        }
    }
}