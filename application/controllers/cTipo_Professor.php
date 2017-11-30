<?php
class CTipo_Professor extends CI_Controller {
    
    public function read(){
        $this->load->model('mTipo_Professor');
        foreach($this->mTipo_Professor->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->tpNome,
                "tpNome"=>$row->tpNome,
                "tpCodigo"=>$row->tpCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('tpNome');
        $this->load->model('mTipo_Professor');
        echo $this->mTipo_Professor->mGetID($Nome);
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
        $Nome = $this->input->post('tpNome');
        $Codigo = $this->input->post('tpCodigo');
        $this->load->model('mTipo_Professor');
        if($this->mTipo_Professor->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('tpNome');
        $Codigo = $this->input->post('tpCodigo');
        $this->load->model('mTipo_Professor');
        if($this->mTipo_Professor->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mTipo_Professor');
            if($this->mTipo_Professor->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    } 
}