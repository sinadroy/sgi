<?php
class CSessao extends CI_Controller {
    
    public function read(){
        $this->load->model('mSessao');
        foreach($this->mSessao->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->sesNome,
                "sesNome"=>$row->sesNome,
                "sesCodigo"=>$row->sesCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID(){
        $Nome = $this->input->post('sesNome');
        $this->load->model('mSessao');
        echo $this->mSessao->mGetID($Nome);
    }
    /*
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function update(){                       
        $id = $this->input->post('id');
        $Nome = $this->input->post('sesNome');
        $Codigo = $this->input->post('sesCodigo');
        $this->load->model('mSessao');
        if($this->mSessao->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('sesNome');
        $Codigo = $this->input->post('sesCodigo');
        $this->load->model('mSessao');
        if($this->mSessao->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mSessao');
            if($this->mSessao->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}