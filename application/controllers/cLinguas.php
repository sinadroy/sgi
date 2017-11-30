<?php
class CLinguas extends CI_Controller {
    
    public function read(){
        $this->load->model('mLinguas');
        foreach($this->mLinguas->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->linNome,
                "linNome"=>$row->linNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $linNome = $this->input->post('linNome');
        $this->load->model('mLinguas');
        echo $this->mLinguas->mGetID($linNome);
    }
    public function update(){                       
        $id = $this->input->get('id');
        $linNome = $this->input->get('linNome');
        
        $this->load->model('mLinguas');
        if($this->mLinguas->mupdate($id,$linNome))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        //$id = $this->input->post('id');
        $linNome = $this->input->get('linNome');
        
        $this->load->model('mLinguas');
        if($this->mLinguas->minsert($linNome))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mLinguas');
            if($this->mLinguas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}