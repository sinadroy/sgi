<?php
class CNiveis extends CI_Controller {
    
    public function read(){
        $this->load->model('mniveis');
        $ord = 1;
        foreach($this->mniveis->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->nNome,
                    "nNome"=>$row->nNome,
                    "nCodigo"=>$row->nCodigo,
                    "nDescricao"=>$row->nDescricao,
            ); 
            $ord++;
        }
        $total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function read_dpto() {
        $dpto = $this->input->get('dpto');
        $this->load->model('mNiveis');
        echo json_encode($this->mNiveis->mread_dpto($dpto));
    }

    public function GetID() {
        $nNome = $this->input->post('nNome');
        $this->load->model('mNiveis');
        echo $this->mNiveis->getID($nNome);
    }
    
    public function update(){                       
            $id = $this->input->post('id');
            $nNome = $this->input->post('nNome');
            $nCodigo = $this->input->post('nCodigo');
            $nDescricao = $this->input->post('nDescricao');
            $this->load->model('mNiveis');
            if($this->mNiveis->mupdate($id,$nNome,$nCodigo,$nDescricao))
                echo "true"; 
            else
               echo "false";
    }
     
    public function insert(){
           $nNome = $this->input->post('nNome');
           $nCodigo = $this->input->post('nCodigo');
           $nDescricao = $this->input->post('nDescricao');
            
           $this->load->model('mNiveis');
           if($this->mNiveis->minsert($nNome,$nCodigo,$nDescricao))
               echo "true";
           else
               echo "false";
            
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mNiveis');
            if($this->mNiveis->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>