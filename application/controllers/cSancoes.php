<?php
class CSancoes extends CI_Controller {
    
    public function read(){
        $this->load->model('mSancoes');
        foreach($this->mSancoes->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "value"=>$row->fNome,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                "sanData"=>$row->sanData,
                "sanMotivo"=>$row->sanMotivo,
                "sanObs"=>$row->sanObs,
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
        $sanData = $this->input->post('sanData');
        $sanMotivo = $this->input->post('sanMotivo');
        $sanObs = $this->input->post('sanObs');
        $this->load->model('mSancoes');
        if($this->mSancoes->mupdate($id,$sanData,$sanMotivo,$sanObs))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $id = $this->input->post('Funcionarios_id');
        $sanData = $this->input->post('sanData');
        $sanMotivo = $this->input->post('sanMotivo');
        $sanObs = $this->input->post('sanObs');
        $this->load->model('mSancoes');
        if($this->mSancoes->minsert($id,$sanData,$sanMotivo,$sanObs))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mSancoes');
            if($this->mSancoes->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}