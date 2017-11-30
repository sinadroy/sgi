<?php
class Ccalendarios_avaliacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('Mcalendarios_avaliacoes');
        echo json_encode($this->Mcalendarios_avaliacoes->mread());
    }

    public function pertenece(){
        $data = date('Y-m-d');
        $alAno = date('Y');
        $ava_nome = $this->input->post('ava_nome');
        $this->load->model('Mcalendarios_avaliacoes');
        if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,$ava_nome))
            echo "true";
        else
            echo "false";
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $alAno = $request["alAno"];
        $ca_data_inicio = $request["ca_data_inicio"];
        $ca_data_fim = $request["ca_data_fim"];
        $ava_nome = $request["ava_nome"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mcalendarios_avaliacoes');

        if ($webix_operation == "insert"){
            if($this->Mcalendarios_avaliacoes->minsert($alAno,$ca_data_inicio,$ca_data_fim,$ava_nome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mcalendarios_avaliacoes->mupdate($id,$alAno,$ca_data_inicio,$ca_data_fim,$ava_nome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->Mcalendarios_avaliacoes->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}