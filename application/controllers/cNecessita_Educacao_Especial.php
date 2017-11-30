<?php
class CNecessita_Educacao_Especial extends CI_Controller {
    
    public function read(){
        $this->load->model('MNecessita_Educacao_Especial');
        echo json_encode($this->MNecessita_Educacao_Especial->mread());
    } 
    public function GetID() {
        $Nome = $this->input->post('neeNome');
        $this->load->model('MNecessita_Educacao_Especial');
        echo $this->MNecessita_Educacao_Especial->mGetID($Nome);
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $neeNome = $request["neeNome"];
        $neeCodigo = $request["neeCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MNecessita_Educacao_Especial');

        if ($webix_operation == "insert"){
            if($this->MNecessita_Educacao_Especial->minsert($neeNome,$neeCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MNecessita_Educacao_Especial->mupdate($id,$neeNome,$neeCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MNecessita_Educacao_Especial->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}