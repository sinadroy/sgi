<?php
class CBI_Lugar_Emissao_Provincias extends CI_Controller {
    /*
    public function read(){
        $this->load->model('mGeneros');
        foreach($this->mGeneros->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->gNome,
                "gNome"=>$row->gNome,
                "gCodigo"=>$row->gCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('gNome');
        $this->load->model('mGeneros');
        echo $this->mGeneros->mGetID($Nome);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $gNome = $this->input->post('gNome');
        $gCodigo = $this->input->post('gCodigo');
        $this->load->model('mGeneros');
        if($this->mGeneros->mupdate($id,$gNome,$gCodigo))
            echo "true"; 
        else
            echo "false";
    }
    */ 
    public function insert(){
        $Provincias_id = $this->input->post('Provincias_id');
        $Funcionarios_id = $this->input->post('Funcionarios_id');
        $this->load->model('mBI_Lugar_Emissao_Provincias');
        if($this->mBI_Lugar_Emissao_Provincias->minsert($Provincias_id,$Funcionarios_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mGeneros');
            if($this->mGeneros->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>