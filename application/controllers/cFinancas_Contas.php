<?php
class CFinancas_Contas extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Contas');
        echo json_encode($this->MFinancas_Contas->mread());
    }
    /*
        determinar lista de contas por banco
    */
    public function readXbanco(){
        $request = $_GET;
        $id = $request['id'];
        $this->load->model('MFinancas_Contas');
        echo json_encode($this->MFinancas_Contas->mreadXbanco($id));
    }
    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        //Dados Pessoais
        $contNome = $request['contNome'];
        $contNumero = $request['contNumero'];
        $contNatureza = $request['contNatureza'];
        $contDescricao = $request['contDescricao'];
        $bancNome = $request['bancNome'];

        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MFinancas_Contas');
        if ($webix_operation == "insert"){
            if($this->MFinancas_Contas->minsert($contNome, $contNumero, $contNatureza, $contDescricao,$bancNome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MFinancas_Contas->mupdate($id,$contNome, $contNumero, $contNatureza, $contDescricao,$bancNome))
                    echo "true"; 
                else
                    echo "false"; 
        } else if ($webix_operation == "delete"){
            if($this->MFinancas_Contas->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}