<?php
class CModalidades_Formacao extends CI_Controller {
    
    public function read(){
        $this->load->model('mModalidades_Formacao');
        foreach($this->mModalidades_Formacao->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "mfNome"=>$row->mfNome,
                "value"=>$row->mfNome,
                "mfCodigo"=>$row->mfCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function GetID() {
        $Nome = $this->input->post('mfNome');
        $this->load->model('mModalidades_Formacao');
        echo $this->mModalidades_Formacao->mGetID($Nome);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $mfNome = $request["mfNome"];
        $mfCodigo = $request["mfCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mModalidades_Formacao');

        if ($webix_operation == "insert"){
            if($this->mModalidades_Formacao->minsert($mfNome,$mfCodigo))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mModalidades_Formacao->mupdate($id,$mfNome,$mfCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mModalidades_Formacao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $mfNome = $this->input->post('mfNome');
        $mfCodigo = $this->input->post('mfCodigo');
        $this->load->model('mModalidades_Formacao');
        if($this->mModalidades_Formacao->mupdate($id,$mfNome,$mfCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        //$id = $this->input->post('Funcionarios_id');
        $mfNome = $this->input->post('mfNome');
        $mfCodigo = $this->input->post('mfCodigo');
        $this->load->model('mModalidades_Formacao');
        if($this->mModalidades_Formacao->minsert($mfNome,$mfCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mModalidades_Formacao');
            if($this->mModalidades_Formacao->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}