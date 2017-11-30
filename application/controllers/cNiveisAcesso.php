<?php
class CNiveisAcesso extends CI_Controller {
    
    public function read(){
        //$rol = $this->input->post('rol');
        //$rol = 'admin';
        $this->load->model('mniveisacesso');
        $ord = 1;
        foreach($this->mniveisacesso->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "idna"=>$row->id,
                "value"=>$row->naNome,
                "naNome"=>$row->naNome,
                "naDescricao"=>$row->naDescricao,
            );
            $ord++;
        }
            //$total = count($al);
            //$x = (object)$al;
            $data = json_encode($al);
            $response = $data;
        
        echo $response;
    }
    public function getID() {
        $naNome = $this->input->post('naNome');
        $this->load->model('mNiveisAcesso');
        echo $this->mNiveisAcesso->getID($naNome);
    }
    public function update(){                       
            $id = $this->input->post('id');
            $naNome = $this->input->post('naNome');
            $naDescricao = $this->input->post('naDescricao');
            $this->load->model('mNiveisAcesso');
            if($this->mNiveisAcesso->mupdate($id,$naNome,$naDescricao))
                echo "true"; 
            else
               echo "false";
    }
    public function insert(){
           $naNome = $this->input->post('naNome');
           $naDescricao = $this->input->post('naDescricao');
            
           $this->load->model('mNiveisAcesso');
           if($this->mNiveisAcesso->minsert($naNome,$naDescricao))
               echo "true";
           else
               echo "false";
            
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mNiveisAcesso');
            if($this->mNiveisAcesso->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
}
?>