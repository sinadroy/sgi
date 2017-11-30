<?php
class CLicencas extends CI_Controller {
    
    public function read(){
        $this->load->model('mLicencas');
        foreach($this->mLicencas->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "value"=>$row->fNome,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                "liceData_Inicio"=>$row->liceData_Inicio,
                "liceData_Fin"=>$row->liceData_Fin,
                "lmNome"=>$row->lmNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $lmNome = $this->input->post('lmNome');
        $this->load->model('mLicencas');
        echo $this->mLicencas->mGetID($lmNome);
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
        $Funcionarios_id = $this->input->post('Funcionarios_id');
        $liceData_Inicio = $this->input->post('liceData_Inicio');
        $liceData_Fin = $this->input->post('liceData_Fin');
        $lmNome = $this->input->post('lmNome');
        $this->load->model('mLicencas');
        if($this->mLicencas->mupdate($id,$Funcionarios_id,$liceData_Inicio,$liceData_Fin,$lmNome))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $id = $this->input->post('Funcionarios_id');
        $liceData_Inicio = $this->input->post('liceData_Inicio');
        $liceData_Fin = $this->input->post('liceData_Fin');
        $lmNome = $this->input->post('lmNome');
        $this->load->model('mLicencas');
        if($this->mLicencas->minsert($id,$liceData_Inicio,$liceData_Fin,$lmNome))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mLicencas');
            if($this->mLicencas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}