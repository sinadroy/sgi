<?php
class CHabilitacoes_Literarias_Candidatos extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mHabilitacoes_Literarias_Candidatos');
        foreach($this->mHabilitacoes_Literarias_Candidatos->mread() as $row){
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
        $this->load->model('mHabilitacoes_Literarias_Candidatos');
        echo $this->mHabilitacoes_Literarias_Candidatos->mGetID($Nome);
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
        $this->load->model('mHabilitacoes_Literarias_Candidatos');
        if($this->mHabilitacoes_Literarias_Candidatos->mupdate($id,$hlfNome,$hlfCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('hlfNome');
        $Codigo = $this->input->post('hlfCodigo');
        $this->load->model('mHabilitacoes_Literarias_Candidatos');
        if($this->mHabilitacoes_Literarias_Candidatos->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mHabilitacoes_Literarias_Candidatos');
            if($this->mHabilitacoes_Literarias_Candidatos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>