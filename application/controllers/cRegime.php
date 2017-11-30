<?php
class CRegime extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mRegime');
        foreach($this->mRegime->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->sesNome,
                "sesNome"=>$row->sesNome,
                "sesCodigo"=>$row->sesCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('sesNome');
        $this->load->model('mRegime');
        echo $this->mRegime->mGetID($Nome);
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
        $sesNome = $this->input->post('sesNome');
        $sesCodigo = $this->input->post('sesCodigo');
        $this->load->model('mRegime');
        if($this->mRegime->mupdate($id,$sesNome,$sesCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $sesNome = $this->input->post('sesNome');
        $sesCodigo = $this->input->post('sesCodigo');
        $this->load->model('mRegime');
        if($this->mRegime->minsert($sesNome,$sesCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mRegime');
            if($this->mRegime->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>