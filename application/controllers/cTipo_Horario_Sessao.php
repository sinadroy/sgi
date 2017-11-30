<?php
class CTipo_Horario_Sessao extends CI_Controller {
    
    public function read(){
        $this->load->model('MTipo_Horario_Sessao');
        echo json_encode($this->MTipo_Horario_Sessao->mread());
    }

    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        $stNome = $request["stNome"];
        $htNome = $request["htNome"];
        $Entrada = $request["Entrada"];
        $Saida = $request["Saida"];
        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MTipo_Horario_Sessao');
        if ($webix_operation == "insert"){
            if($this->MTipo_Horario_Sessao->minsert($htNome,$stNome,$Entrada,$Saida))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MTipo_Horario_Sessao->mupdate($id,$htNome,$stNome,$Entrada,$Saida))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MTipo_Horario_Sessao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}