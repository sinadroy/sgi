<?php
class COpcao extends CI_Controller {
    
    public function read(){
        $this->load->model('MOpcao');
        echo json_encode($this->MOpcao->mread());
    }
    public function readXtipo(){
        $request = $_GET;
        $escola = $request['escola'];
        $this->load->model('MOpcao');
        echo json_encode($this->MOpcao->mreadXtipo($escola));
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $opcNome = $request["opcNome"];
        $opcCodigo = $request["opcCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MOpcao');

        if ($webix_operation == "insert"){
            if($this->MOpcao->minsert($opcNome,$opcCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MOpcao->mupdate($id,$opcNome,$opcCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MOpcao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}