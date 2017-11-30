<?php
class CSemestres extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mSemestres');
        foreach($this->mSemestres->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->sNome,
                "sNome"=>$row->sNome,
                "sDescricao"=>$row->sDescricao
            );
            $ord++; 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('sNome');
        $this->load->model('mSemestres');
        echo $this->mSemestres->mGetID($Nome);
    }

    public function dt_ano($s) {
        switch($s){
            case '1': return 1; break;
            case '2': return 1; break;
            case '3': return 2; break;
            case '4': return 2; break;
            case '5': return 3; break;
            case '6': return 3; break;
            case '7': return 4; break;
            case '8': return 4; break;
            case '9': return 5; break;
            case '10': return 5; break;
        }
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
        $sNome = $this->input->post('sNome');
        $sDescricao = $this->input->post('sDescricao');
        $this->load->model('mSemestres');
        if($this->mSemestres->mupdate($id,$sNome,$sDescricao))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('sNome');
        $Descricao = $this->input->post('sDescricao');
        $this->load->model('mSemestres');
        if($this->mSemestres->minsert($Nome,$Descricao))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mSemestres');
            if($this->mSemestres->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}