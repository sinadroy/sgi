<?php
class CDisciplinas_Duracao extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mDisciplinas_Duracao');
        foreach($this->mDisciplinas_Duracao->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->ddNome,
                "ddNome"=>$row->ddNome,
                "ddCodigo"=>$row->ddCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('ddNome');
        $this->load->model('mDisciplinas_Duracao');
        echo $this->mDisciplinas_Duracao->mGetID($Nome);
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
        $Nome = $this->input->post('ddNome');
        $Codigo = $this->input->post('ddCodigo');
        $this->load->model('mDisciplinas_Duracao');
        if($this->mDisciplinas_Duracao->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('ddNome');
        $Codigo = $this->input->post('ddCodigo');
        $this->load->model('mDisciplinas_Duracao');
        if($this->mDisciplinas_Duracao->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mDisciplinas_Duracao');
            if($this->mDisciplinas_Duracao->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>