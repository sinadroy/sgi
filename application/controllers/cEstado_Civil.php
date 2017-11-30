<?php
class CEstado_Civil extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mEstado_Civil');
        foreach($this->mEstado_Civil->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->ecNome,
                "ecNome"=>$row->ecNome,
                "ecCodigo"=>$row->ecCodigo
            );
            $ord++; 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('ecNome');
        $this->load->model('mEstado_Civil');
        echo $this->mEstado_Civil->mGetID($Nome);
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
        $Nome = $this->input->post('ecNome');
        $Codigo = $this->input->post('ecCodigo');
        $this->load->model('mEstado_Civil');
        if($this->mEstado_Civil->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('ecNome');
        $Codigo = $this->input->post('ecCodigo');
        $this->load->model('mEstado_Civil');
        if($this->mEstado_Civil->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mEstado_Civil');
            if($this->mEstado_Civil->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>