<?php
class CEscola_Formacao_Opcao extends CI_Controller {
    
    public function read(){
        $this->load->model('MEscola_Formacao_Opcao');
        echo json_encode($this->MEscola_Formacao_Opcao->mread());
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $efNome = $request["efNome"];
        $opcNome = $request["opcNome"];
        
        if(!is_numeric($opcNome)){
            $this->load->model('MOpcao');
            $opcNome = $this->MOpcao->mreadX($opcNome);
        }
        if(!is_numeric($efNome)){
            $this->load->model('MEscola_Formacao');
            $efNome = $this->MEscola_Formacao->mreadX($efNome);
        }
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MEscola_Formacao_Opcao');

        if ($webix_operation == "insert"){
            if($this->MEscola_Formacao_Opcao->minsert($efNome,$opcNome))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MEscola_Formacao_Opcao->mupdate($id,$efNome,$opcNome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MEscola_Formacao_Opcao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}