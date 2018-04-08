<?php
class Cdocumentos_pendientes extends CI_Controller {
    
    public function read(){
        $this->load->model('mdocumentos_pendientes');
        echo json_encode($this->mdocumentos_pendientes->mread());
    }
    public function read_mestrado(){
        $this->load->model('mdocumentos_pendientes');
        echo json_encode($this->mdocumentos_pendientes->mread_mestrado());
    }
    public function read_com_notas(){
        $this->load->model('mdocumentos_pendientes');
        echo json_encode($this->mdocumentos_pendientes->mread_com_notas());
    }
    public function read_com_notas_concluicao(){
        $this->load->model('mdocumentos_pendientes');
        echo json_encode($this->mdocumentos_pendientes->mread_com_notas_concluicao());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mdocumentos_pendientes');

        if ($webix_operation == "insert"){
            if($this->mdocumentos_pendientes->minsert($tdnome,$tdvalor))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mdocumentos_pendientes->mupdate($id,$tdnome,$tdvalor))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mdocumentos_pendientes->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}