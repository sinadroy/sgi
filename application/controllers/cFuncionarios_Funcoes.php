<?php
class CFuncionarios_Funcoes extends CI_Controller {
    
    public function read(){
        $this->load->model('MFuncionarios_Funcoes');
        echo json_encode($this->MFuncionarios_Funcoes->mread());
    }
    public function read_combos(){
        $this->load->model('MFuncionarios_Funcoes');
        echo json_encode($this->MFuncionarios_Funcoes->mread_combos());
    }

    public function GetID(){
        $request = $_POST;
        $funcNome = $request['funcNome'];
        $this->load->model('MFuncionarios_Funcoes');
        echo $this->MFuncionarios_Funcoes->mGetID($funcNome);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $funcNome = $request["funcNome"];
        $funcCodigo = $request["funcCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MFuncionarios_Funcoes');

        if ($webix_operation == "insert"){
            if($this->MFuncionarios_Funcoes->minsert($funcNome,$funcCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MFuncionarios_Funcoes->mupdate($id,$funcNome,$funcCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MFuncionarios_Funcoes->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}