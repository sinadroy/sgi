<?php
class CPeriodos extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mPeriodos');
        foreach($this->mPeriodos->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->pNome,
                "pNome"=>$row->pNome,
                "pCodigo"=>$row->pCodigo
            );
            $ord++; 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('pNome');
        $this->load->model('mPeriodos');
        echo $this->mPeriodos->mGetID($Nome);
    }
    public function Get_total_X_periodo_estadistica() {
        $al = $this->input->get('al');
        $this->load->model('mperiodos');
        echo json_encode($this->mperiodos->mGet_total_X_periodo_estadistica($al));
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
        $Nome = $this->input->post('pNome');
        $Codigo = $this->input->post('pCodigo');
        $this->load->model('mPeriodos');
        if($this->mPeriodos->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('pNome');
        $Codigo = $this->input->post('pCodigo');
        $this->load->model('mPeriodos');
        if($this->mPeriodos->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mPeriodos');
            if($this->mPeriodos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}