<?php
class CHabilitacoes_Literarias extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mHabilitacoes_Literarias');
        foreach($this->mHabilitacoes_Literarias->mread() as $row){
            if($row->hlfCodigo != "0" || $row->hlfCodigo != "00" || $row->hlfCodigo != "000")
            {
                $al[] = array(
                    "id"=>$row->id,
                    "ord"=>$ord,
                    "value"=>$row->hlfNome,
                    "hlfNome"=>$row->hlfNome,
                    "hlfCodigo"=>$row->hlfCodigo
                ); 
                $ord++;
            }
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_combos(){
        $ord=1;
        $this->load->model('mHabilitacoes_Literarias');
        foreach($this->mHabilitacoes_Literarias->mread() as $row){
                $al[] = array(
                    "id"=>$row->id,
                    "ord"=>$ord,
                    "value"=>$row->hlfNome,
                    "hlfNome"=>$row->hlfNome,
                    "hlfCodigo"=>$row->hlfCodigo
                ); 
                $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('hlfNome');
        $this->load->model('mHabilitacoes_Literarias');
        echo $this->mHabilitacoes_Literarias->mGetID($Nome);
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
        $hlfNome = $this->input->post('hlfNome');
        $hlfCodigo = $this->input->post('hlfCodigo');
        $this->load->model('mHabilitacoes_Literarias');
        if($this->mHabilitacoes_Literarias->mupdate($id,$hlfNome,$hlfCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('hlfNome');
        $Codigo = $this->input->post('hlfCodigo');
        $this->load->model('mHabilitacoes_Literarias');
        if($this->mHabilitacoes_Literarias->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mHabilitacoes_Literarias');
            if($this->mHabilitacoes_Literarias->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>