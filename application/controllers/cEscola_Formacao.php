<?php
class CEscola_Formacao extends CI_Controller {
    
    public function read(){
        $this->load->model('MEscola_Formacao');
        echo json_encode($this->MEscola_Formacao->mread());
    }
    public function readXtipo(){
        $request = $_GET;
        $tipo = $request['tipo'];
        $this->load->model('MEscola_Formacao');
        echo json_encode($this->MEscola_Formacao->mreadXtipo($tipo));
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $efNome = $request["efNome"];
        $efCodigo = $request["efCodigo"];
        $Habilitacoes_Literarias_Candidatos_id = $request["hlfNome"];
        $efCodigoNome = $request["efCodigoNome"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MEscola_Formacao');

        if ($webix_operation == "insert"){
            if($this->MEscola_Formacao->minsert($efNome,$efCodigo,$Habilitacoes_Literarias_Candidatos_id,$efCodigoNome))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MEscola_Formacao->mupdate($id,$efNome,$efCodigo,$Habilitacoes_Literarias_Candidatos_id,$efCodigoNome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MEscola_Formacao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}