<?php
class CLinguas_Nivel extends CI_Controller {
    
    public function read(){
        $this->load->model('mLinguas_Nivel');
        foreach($this->mLinguas_Nivel->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->lnNome,
                "lnNome"=>$row->lnNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('lnNome');
        $this->load->model('mLinguas_Nivel');
        echo $this->mLinguas_Nivel->mGetID($Nome);
    }
    public function update(){                       
        $id = $this->input->get('id');
        $lnNome = $this->input->get('lnNome');
        
        $this->load->model('mLinguas_Nivel');
        if($this->mLinguas_Nivel->mupdate($id,$lnNome))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        //$id = $this->input->post('id');
        $lnNome = $this->input->get('lnNome');
        
        $this->load->model('mLinguas_Nivel');
        if($this->mLinguas_Nivel->minsert($lnNome))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mLinguas_Nivel');
            if($this->mLinguas_Nivel->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}