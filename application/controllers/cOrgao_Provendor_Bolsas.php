<?php
class COrgao_Provendor_Bolsas extends CI_Controller {
    
    public function read(){
        $this->load->model('mOrgao_Provendor_Bolsas');
        foreach($this->mOrgao_Provendor_Bolsas->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "opbNome"=>$row->opbNome,
                "value"=>$row->opbNome,
                "opbCodigo"=>$row->opbCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function GetID() {
        $Nome = $this->input->post('opbNome');
        $this->load->model('mOrgao_Provendor_Bolsas');
        echo $this->mOrgao_Provendor_Bolsas->mGetID($Nome);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $opbNome = $this->input->post('opbNome');
        $opbCodigo = $this->input->post('opbCodigo');
        $this->load->model('mOrgao_Provendor_Bolsas');
        if($this->mOrgao_Provendor_Bolsas->mupdate($id,$opbNome,$opbCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        //$id = $this->input->post('Funcionarios_id');
        $opbNome = $this->input->post('opbNome');
        $opbCodigo = $this->input->post('opbCodigo');
        $this->load->model('mOrgao_Provendor_Bolsas');
        if($this->mOrgao_Provendor_Bolsas->minsert($opbNome,$opbCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mOrgao_Provendor_Bolsas');
            if($this->mOrgao_Provendor_Bolsas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}