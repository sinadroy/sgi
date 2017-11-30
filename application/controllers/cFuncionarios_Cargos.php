<?php
class CFuncionarios_Cargos extends CI_Controller {
    
    public function read(){
        $this->load->model('MFuncionarios_Cargos');
        echo json_encode($this->MFuncionarios_Cargos->mread());
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $carNome = $request["carNome"];
        $carCodigo = $request["carCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MFuncionarios_Cargos');

        if ($webix_operation == "insert"){
            if($this->MFuncionarios_Cargos->minsert($carNome,$carCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MFuncionarios_Cargos->mupdate($id,$carNome,$carCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MFuncionarios_Cargos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}