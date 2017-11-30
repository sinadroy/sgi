<?php
class CClassificacao extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mClassificacao');
        foreach($this->mClassificacao->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->clNome,
                "clNome"=>$row->clNome,
                "clCodigo"=>$row->clCodigo,
                "clPercentagem"=>$row->clPercentagem,
                "clObservacao"=>$row->clObservacao
            );
            $ord++; 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('clNome');
        $this->load->model('mClassificacao');
        echo $this->mClassificacao->mGetID($Nome);
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
        $Nome = $this->input->post('clNome');
        $Codigo = $this->input->post('clCodigo');
        $clPercentagem = $this->input->post('clPercentagem');
        $clObservacao = $this->input->post('clObservacao');
        $this->load->model('mClassificacao');
        if($this->mClassificacao->mupdate($id,$Nome,$Codigo,$clPercentagem,$clObservacao))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('clNome');
        $Codigo = $this->input->post('clCodigo');
        $clPercentagem = $this->input->post('clPercentagem');
        $clObservacao = $this->input->post('clObservacao');
        $this->load->model('mClassificacao');
        if($this->mClassificacao->minsert($Nome,$Codigo,$clPercentagem,$clObservacao))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mClassificacao');
            if($this->mClassificacao->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>