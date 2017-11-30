<?php
class CGrupoFuncionarios extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mGrupoFuncionarios');
        foreach($this->mGrupoFuncionarios->mread() as $row){
            if($row->gfCodigo != '0' || $row->gfCodigo != '00' || $row->gfCodigo != '000')
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->gfNome,
                    "gfNome"=>$row->gfNome,
                    "gfCodigo"=>$row->gfCodigo
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
        $this->load->model('mGrupoFuncionarios');
        foreach($this->mGrupoFuncionarios->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->gfNome,
                "gfNome"=>$row->gfNome,
                "gfCodigo"=>$row->gfCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $gfNome = $this->input->post('gfNome');
        $this->load->model('mGrupoFuncionarios');
        echo $this->mGrupoFuncionarios->mGetID($gfNome);
    }
    public function read_x_categorias() {
        $id = $this->input->get('id');
        $this->load->model('mGrupoFuncionarios');
        echo $this->mGrupoFuncionarios->mread_x_categorias($id);
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
        $gfNome = $this->input->post('gfNome');
        $gfCodigo = $this->input->post('gfCodigo');
        $this->load->model('mGrupoFuncionarios');
        if($this->mGrupoFuncionarios->mupdate($id,$gfNome,$gfCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $gfNome = $this->input->post('gfNome');
        $gfCodigo = $this->input->post('gfCodigo');
        $this->load->model('mGrupoFuncionarios');
        if($this->mGrupoFuncionarios->minsert($gfNome,$gfCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mGrupoFuncionarios');
            if($this->mGrupoFuncionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>