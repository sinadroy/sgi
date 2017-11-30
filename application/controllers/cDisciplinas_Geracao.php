<?php
class Cdisciplinas_geracao extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('Mdisciplinas_geracao');
        foreach($this->Mdisciplinas_geracao->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->dgnome,
                "dgnome"=>$row->dgnome,
                "dgano_inicio"=>$row->dgano_inicio,
                "dgano_fin"=>$row->dgano_fin
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function get_dgnome() {
        $idd = $this->input->post('idd');
        $this->load->model('Mdisciplinas_geracao');
        echo $this->Mdisciplinas_geracao->mget_dgnome($idd);
    }

    public function GetID() {
        $Nome = $this->input->post('dgnome');
        $this->load->model('Mdisciplinas_geracao');
        echo $this->Mdisciplinas_geracao->mGetID($Nome);
    }
    public function GetGeracao_DisciplinaXcodigo() {
        $codigo = $this->input->get('dcodigo');
        $this->load->model('Mdisciplinas_geracao');
        echo $this->Mdisciplinas_geracao->mGetGeracao_DisciplinaXcodigo($codigo);
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
        $dgnome = $this->input->post('dgnome');
        $dgano_inicio = $this->input->post('dgano_inicio');
        $dgano_fin = $this->input->post('dgano_fin');
        $this->load->model('Mdisciplinas_geracao');
        if($this->Mdisciplinas_geracao->mupdate($id,$dgnome,$dgano_inicio,$dgano_fin))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $dgnome = $this->input->post('dgnome');
        $dgano_inicio = $this->input->post('dgano_inicio');
        $dgano_fin = $this->input->post('dgano_fin');
        $this->load->model('Mdisciplinas_geracao');
        if($this->Mdisciplinas_geracao->minsert($dgnome,$dgano_inicio,$dgano_fin))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('Mdisciplinas_geracao');
            if($this->Mdisciplinas_geracao->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>