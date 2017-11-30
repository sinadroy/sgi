<?php
class Cdocumentos extends CI_Controller {
    
    public function read(){
        $this->load->model('mdocumentos');
        echo json_encode($this->mdocumentos->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $tdnome = $request["tdnome"];
        $tdvalor = $request["tdvalor"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mdocumentos');

        if ($webix_operation == "insert"){
            if($this->mdocumentos->minsert($tdnome,$tdvalor))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mdocumentos->mupdate($id,$tdnome,$tdvalor))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mdocumentos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}