<?php
class CProfissao extends CI_Controller {
    
    public function read(){
        $this->load->model('mProfissao');
        echo json_encode($this->mProfissao->mread());
    } 
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mProfissao');
        echo $this->mProfissao->mGetIDXCandidato_id($Nome);
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $proNome = $request["proNome"];
        $proCodigo = $request["proCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mProfissao');

        if ($webix_operation == "insert"){
            if($this->mProfissao->minsert($proNome,$proCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->mProfissao->mupdate($id,$proNome,$proCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mProfissao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}