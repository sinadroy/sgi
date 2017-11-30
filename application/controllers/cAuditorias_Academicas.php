<?php
class CAuditorias_Academicas extends CI_Controller {
    
    public function read(){
        $this->load->model('mAuditorias_Academicas');
        echo json_encode($this->mAuditorias_Academicas->mread());
    }
   
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $audOperacao = $request["audOperacao"];
        $mNome = $request["mNome"];
        $smNome = $request["smNome"];
        $uUsuario = $request["usuario"];
        $audDescricao = $request["audDescricao"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mAuditorias_Academicas');

        if ($webix_operation == "insert"){
            if($this->mAuditorias_Academicas->minsert($audOperacao,$mNome,$smNome,$uUsuario,$audDescricao))
                echo "true";
            else
                echo "false";
        } else 
            echo "false";
    }
}