<?php
class CDeclaracaoMotivo extends CI_Controller {
    
    public function read(){
        $this->load->model('MDeclaracaoMotivo');
        echo json_encode($this->MDeclaracaoMotivo->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $mnome = $request["mnome"];
        $mcodigo = $request["mcodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MDeclaracaoMotivo');

        if ($webix_operation == "insert"){
            if($this->MDeclaracaoMotivo->minsert($mnome,$mcodigo))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MDeclaracaoMotivo->mupdate($id,$mnome,$mcodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MDeclaracaoMotivo->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}