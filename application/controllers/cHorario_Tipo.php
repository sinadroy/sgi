<?php
class CHorario_Tipo extends CI_Controller {
    
    public function read(){
        $this->load->model('MHorario_Tipo');
        echo json_encode($this->MHorario_Tipo->mread());
    }

    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        $htNome = $request["htNome"];
        $htCodigo = $request["htCodigo"];
        $htDescricao = $request["htDescricao"];
        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MHorario_Tipo');
        if ($webix_operation == "insert"){
            if($this->MHorario_Tipo->minsert($htNome,$htCodigo,$htDescricao))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MHorario_Tipo->mupdate($id,$htNome,$htCodigo,$htDescricao))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MHorario_Tipo->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}