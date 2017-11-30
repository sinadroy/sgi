<?php
class CGraus_Pretendidos extends CI_Controller {
    
    public function read(){
        $this->load->model('mGraus_Pretendidos');
        foreach($this->mGraus_Pretendidos->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "gpNome"=>$row->gpNome,
                "value"=>$row->gpNome,
                "gpCodigo"=>$row->gpCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function GetID() {
        $baiNome = $this->input->post('gpNome');
        $this->load->model('mGraus_Pretendidos');
        echo $this->mGraus_Pretendidos->mGetID($baiNome);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $gpNome = $this->input->post('gpNome');
        $gpCodigo = $this->input->post('gpCodigo');
        $this->load->model('mGraus_Pretendidos');
        if($this->mGraus_Pretendidos->mupdate($id,$gpNome,$gpCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        //$id = $this->input->post('Funcionarios_id');
        $gpNome = $this->input->post('gpNome');
        $gpCodigo = $this->input->post('gpCodigo');
        $this->load->model('mGraus_Pretendidos');
        if($this->mGraus_Pretendidos->minsert($gpNome,$gpCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mGraus_Pretendidos');
            if($this->mGraus_Pretendidos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}