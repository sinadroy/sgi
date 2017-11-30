<?php
class CBairros extends CI_Controller {
    
    public function read(){
        $ord = 1;
        $this->load->model('mBairros');
        foreach($this->mBairros->mread() as $row){
            if($row->baiCodigo != '0' || $row->baiCodigo != '00' || $row->baiCodigo != '000')
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->baiNome,
                    "baiNome"=>$row->baiNome,
                    "baiCodigo"=>$row->baiCodigo,
                    "Municipios_id"=>$row->Municipios_id,
                    "munNome"=>$row->munNome
                );
                $ord++;
            }
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_combos(){
        $ord = 1;
        $this->load->model('mBairros');
        foreach($this->mBairros->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->baiNome,
                "baiNome"=>$row->baiNome,
                "baiCodigo"=>$row->baiCodigo,
                "Municipios_id"=>$row->Municipios_id,
                "munNome"=>$row->munNome
            );
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
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
    /*
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function update(){                       
        $id = $this->input->post('id');
        $baiNome = $this->input->post('baiNome');
        $baiCodigo = $this->input->post('baiCodigo');
        $Municipios_id = $this->input->post('Municipios_id');
        $this->load->model('mBairros');
        if($this->mBairros->mupdate($id,$baiNome,$baiCodigo,$Municipios_id))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $baiNome = $this->input->post('baiNome');
        $baiCodigo = $this->input->post('baiCodigo');
        $Municipios_id = $this->input->post('Municipios_id');
        $this->load->model('mBairros');
        if($this->mBairros->minsert($baiNome,$baiCodigo,$Municipios_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mBairros');
            if($this->mBairros->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>