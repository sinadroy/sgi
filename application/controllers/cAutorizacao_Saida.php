<?php
class CAutorizacao_Saida extends CI_Controller {
    
    public function read(){
        $this->load->model('mAutorizacao_Saida');
        foreach($this->mAutorizacao_Saida->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "value"=>$row->fNome,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                "autData_Inicio"=>$row->autData_Inicio,
                "autData_Fin"=>$row->autData_Fin,
                "autMotivo"=>$row->autMotivo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    //readXMunicipio
    public function readXMunicipio(){
        $id = $this->input->get('id');
        $this->load->model('mBairros');
        foreach($this->mBairros->mreadXMunicipio($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->baiNome,
                "baiNome"=>$row->baiNome,
                "baiCodigo"=>$row->baiCodigo,
                "Municipios_id"=>$row->Municipios_id,
                "munNome"=>$row->munNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $baiNome = $this->input->post('baiNome');
        $this->load->model('mBairros');
        echo $this->mBairros->mGetID($baiNome);
    }
    
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function update(){                       
        $id = $this->input->post('id');
        $autData_Inicio = $this->input->post('autData_Inicio');
        $autData_Fin = $this->input->post('autData_Fin');
        $autMotivo = $this->input->post('autMotivo');
        $this->load->model('mAutorizacao_Saida');
        if($this->mAutorizacao_Saida->mupdate($id,$autData_Inicio,$autData_Fin,$autMotivo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $id = $this->input->post('Funcionarios_id');
        $autData_Inicio = $this->input->post('autData_Inicio');
        $autData_Fin = $this->input->post('autData_Fin');
        $autMotivo = $this->input->post('autMotivo');
        $this->load->model('mAutorizacao_Saida');
        if($this->mAutorizacao_Saida->minsert($id,$autData_Inicio,$autData_Fin,$autMotivo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mAutorizacao_Saida');
            if($this->mAutorizacao_Saida->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}