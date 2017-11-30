<?php
class CCategoriaFuncionarios extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mCategoriaFuncionarios');
        foreach($this->mCategoriaFuncionarios->mread() as $row){
            if($row->cfCodigo != '0' || $row->cfCodigo != '00' || $row->cfCodigo != '000')
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->cfNome,
                    "cfNome"=>$row->cfNome,
                    "cfCodigo"=>$row->cfCodigo,
                    "Grupos_Funcionarios_id"=>$row->Grupos_Funcionarios_id,
                    "gfNome"=>$row->gfNome
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
        $this->load->model('mCategoriaFuncionarios');
        foreach($this->mCategoriaFuncionarios->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->cfNome,
                "cfNome"=>$row->cfNome,
                "cfCodigo"=>$row->cfCodigo,
                "Grupos_Funcionarios_id"=>$row->Grupos_Funcionarios_id,
                "gfNome"=>$row->gfNome
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('cfNome');
        $this->load->model('mCategoriaFuncionarios');
        echo $this->mCategoriaFuncionarios->mGetID($Nome);
    }
    public function read_x_grupo() {
        $id = $this->input->get('id');
        $this->load->model('mCategoriaFuncionarios');
        echo json_encode($this->mCategoriaFuncionarios->mread_x_grupo($id));
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
        $cfNome = $this->input->post('cfNome');
        $cfCodigo = $this->input->post('cfCodigo');
        $Grupos_Funcionarios_id = $this->input->post('Grupos_Funcionarios_id');
        $this->load->model('mCategoriaFuncionarios');
        if($this->mCategoriaFuncionarios->mupdate($id,$cfNome,$cfCodigo,$Grupos_Funcionarios_id))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $cfNome = $this->input->post('cfNome');
        $cfCodigo = $this->input->post('cfCodigo');
        $Grupos_Funcionarios_id = $this->input->post('Grupos_Funcionarios_id');
        $this->load->model('mCategoriaFuncionarios');
        if($this->mCategoriaFuncionarios->minsert($cfNome,$cfCodigo,$Grupos_Funcionarios_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mCategoriaFuncionarios');
            if($this->mCategoriaFuncionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>