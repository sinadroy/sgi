<?php
class CLicencas_Motivos extends CI_Controller {
    
    public function read(){
        $this->load->model('MLicencas_Motivos');
        echo json_encode($this->MLicencas_Motivos->mread());
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $lmNome = $request["lmNome"];
        $lmCodigo = $request["lmCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MLicencas_Motivos');

        if ($webix_operation == "insert"){
            if($this->MLicencas_Motivos->minsert($lmNome,$lmCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MLicencas_Motivos->mupdate($id,$lmNome,$lmCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MLicencas_Motivos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}