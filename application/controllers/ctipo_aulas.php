<?php
class Ctipo_aulas extends CI_Controller {
    
    public function read(){
        $this->load->model('Mtipo_aulas');
        echo json_encode($this->Mtipo_aulas->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $tanome = $request["tanome"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mtipo_aulas');

        if ($webix_operation == "insert"){
            if($this->Mtipo_aulas->minsert($tanome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mtipo_aulas->mupdate($id,$tanome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->Mtipo_aulas->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}