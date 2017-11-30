<?php
class CComunicados extends CI_Controller {
    
    public function read(){
        $this->load->model('mComunicados');
        echo json_encode($this->mComunicados->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $comTitulo = $request["comTitulo"];
        $comConteudo = $request["comConteudo"];
        $comData = $request["comData"];
        $comHora = $request["comHora"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mComunicados');

        if ($webix_operation == "insert"){
            if($this->mComunicados->minsert($comTitulo,$comConteudo,$comData,$comHora))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mComunicados->mupdate($id,$comTitulo,$comConteudo,$comData,$comHora))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mComunicados->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}