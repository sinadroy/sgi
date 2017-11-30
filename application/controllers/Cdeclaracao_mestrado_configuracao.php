<?php
class Cdeclaracao_mestrado_configuracao extends CI_Controller {
    
    public function read(){
        $this->load->model('Mdeclaracao_mestrado_configuracao');
        echo json_encode($this->Mdeclaracao_mestrado_configuracao->mread());
    }
    public function read_titulo_visto(){
        $this->load->model('Mdeclaracao_mestrado_configuracao');
        echo json_encode($this->Mdeclaracao_mestrado_configuracao->mread_titulo_visto());
    }
    public function read_nome_visto(){
        $this->load->model('Mdeclaracao_mestrado_configuracao');
        echo json_encode($this->Mdeclaracao_mestrado_configuracao->mread_nome_visto());
    }
    public function read_nome_asignatura(){
        $this->load->model('Mdeclaracao_mestrado_configuracao');
        echo json_encode($this->Mdeclaracao_mestrado_configuracao->mread_nome_asignatura());
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $nnome = $request["nnome"];
        $cnome = $request["cnome"];
        $titulo_visto = $request["titulo_visto"];
        $nome_visto = $request["nome_visto"];
        $nome_asignatura = $request["nome_asignatura"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mdeclaracao_mestrado_configuracao');

        if ($webix_operation == "insert"){
            if($this->Mdeclaracao_mestrado_configuracao->minsert($nnome,$cnome,$titulo_visto,$nome_visto,$nome_asignatura))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mdeclaracao_mestrado_configuracao->mupdate($id,$nnome,$cnome,$titulo_visto,$nome_visto,$nome_asignatura))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->Mdeclaracao_mestrado_configuracao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}