<?php
class CPrecarios extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('MPrecarios');
        echo json_encode($this->MPrecarios->mread());
    }
    
    public function GetID() {
        $nome = $this->input->post('nome');
        $this->load->model('MPrecarios');
        echo $this->MPrecarios->mGetID($nome);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $precnome = $this->input->post('precnome');
        $preccodigo = $this->input->post('preccodigo');
        $precdescricao = $this->input->post('precdescricao');
        $this->load->model('MPrecarios');
        if($this->MPrecarios->mupdate($id,$precnome,$preccodigo,$precdescricao))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $precnome = $this->input->post('precnome');
        $preccodigo = $this->input->post('preccodigo');
        $precdescricao = $this->input->post('precdescricao');
        $this->load->model('MPrecarios');
        if($this->MPrecarios->minsert($precnome,$preccodigo,$precdescricao))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
        $this->load->model('MPrecarios');
            $this->load->model('MPrecarios');
            if($this->MPrecarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>