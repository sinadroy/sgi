<?php
class CAuditorias_Professores extends CI_Controller {
    
    public function read(){
        $i = $this->input->get('i');
        $l = $this->input->get('l');
        $this->load->model('mAuditorias_Professores');
        echo json_encode($this->mAuditorias_Professores->mread($i, $l));
    }
    public function read_search(){
        $i = $this->input->get('i');
        $l = $this->input->get('l');
        $x = $this->input->get('x');
        $this->load->model('mAuditorias_Professores');
        echo json_encode($this->mAuditorias_Professores->mread_search($i, $l,$x));
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
        $this->load->model('mAuditorias_Professores');

        if ($webix_operation == "insert"){
            if($this->mAuditorias_Professores->minsert($audOperacao,$mNome,$smNome,$uUsuario,$audDescricao))
                echo "true";
            else
                echo "false";
        } else 
            echo "false";
    }
}