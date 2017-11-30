<?php
class CAcademica_Presencas_Exame_Acesso_2S extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readX(){
        $request = $_GET;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $this->load->model('MAcademica_Presencas_Exame_Acesso_2S');
        echo json_encode($this->MAcademica_Presencas_Exame_Acesso_2S->mreadX($alAno,$nNome,$cNome,$pNome));
    }
    
    public function readXpresente(){
        $request = $_POST;
        $codigo_barra = $request["cb"];
        $this->load->model('MAcademica_Presencas_Exame_Acesso_2S');
        if($this->MAcademica_Presencas_Exame_Acesso_2S->mreadXpresente($codigo_barra))
            echo "true";
        else
            echo "false";
    }

    public function crud(){
        $request = $_POST;
        $apecCodigoBarra = @$request['apecCodigoBarra'];
        $apecEstado = $request["apecEstado"];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Presencas_Exame_Acesso_2S');
        /*
        if ($webix_operation == "insert"){
            if($this->MAcademica_Planificacao_Exame_Ingreso->minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true";
            else
                echo "false";

        } else */ 
        if ($webix_operation == "update"){
            if($this->MAcademica_Presencas_Exame_Acesso_2S->mupdate($apecCodigoBarra,$apecEstado))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MAcademica_Presencas_Exame_Acesso_2S->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}