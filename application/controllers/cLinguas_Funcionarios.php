<?php
class CLinguas_Funcionarios extends CI_Controller {
    
    public function read(){
        $this->load->model('mLinguas_Funcionarios');
        foreach($this->mLinguas_Funcionarios->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "linguas_id"=>$row->linguas_id,
                "linNome"=>$row->linNome,
                
                "linguas_nivel_id"=>$row->linguas_nivel_id,
                "lnNome"=>$row->lnNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_x_id(){
        $id = $this->input->get('id');
        $this->load->model('mLinguas_Funcionarios');
        foreach($this->mLinguas_Funcionarios->mreadXid($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "linguas_id"=>$row->linguas_id,
                "linNome"=>$row->linNome,
                
                "linguas_nivel_id"=>$row->linguas_nivel_id,
                "lnNome"=>$row->lnNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function update(){                       
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        
        $linguas_id = $this->input->post('linguas_id');
        $linguas_nivel_id = $this->input->post('linguas_nivel_id');
        
        $this->load->model('mLinguas_Funcionarios');
        if($this->mLinguas_Funcionarios->mupdate($id,$Funcionarios_id,$linguas_id,$linguas_nivel_id))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $linguas_id = $this->input->post('linguas_id');
        $linguas_nivel_id = $this->input->post('linguas_nivel_id');
        
        $this->load->model('mLinguas_Funcionarios');
        if($this->mLinguas_Funcionarios->minsert($Funcionarios_id,$linguas_id,$linguas_nivel_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mLinguas_Funcionarios');
            if($this->mLinguas_Funcionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}