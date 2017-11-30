<?php
class CFinancas_Bancos extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Bancos');
        echo json_encode($this->MFinancas_Bancos->mread());
    }
   

    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        //Dados Pessoais
        $bancNome = $request['bancNome'];
        $bancCodigo = $request['bancCodigo'];
        $bancDescricao = @$request['bancDescricao'];

        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MFinancas_Bancos');
        if ($webix_operation == "insert"){
            if($this->MFinancas_Bancos->minsert($bancNome, $bancCodigo, $bancDescricao))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MFinancas_Bancos->mupdate($id,$bancNome, $bancCodigo, $bancDescricao))
                    echo "true"; 
                else
                    echo "false"; 
        } else if ($webix_operation == "delete"){
            if($this->MFinancas_Bancos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }

}