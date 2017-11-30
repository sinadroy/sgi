<?php
class CMunicipios extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mMunicipios');
        foreach($this->mMunicipios->mread() as $row){
            if($row->munCodigo != '0' || $row->munCodigo != '00' || $row->munCodigo != '000')
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->munNome,
                    "munNome"=>$row->munNome,
                    "munCodigo"=>$row->munCodigo,
                    "Provincias_id"=>$row->Provincias_id,
                    "provNome"=>$row->provNome
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
        $this->load->model('mMunicipios');
        foreach($this->mMunicipios->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->munNome,
                "munNome"=>$row->munNome,
                "munCodigo"=>$row->munCodigo,
                "Provincias_id"=>$row->Provincias_id,
                "provNome"=>$row->provNome
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    para diferenciar el municipio de dir con el de nascimento
    */
    public function readMN(){
        $this->load->model('mMunicipios');
        foreach($this->mMunicipios->mreadMN() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->munNascimento,
                "munNascimento"=>$row->munNascimento,
                "munCodigo"=>$row->munCodigo,
                "Provincias_id"=>$row->Provincias_id,
                "provNome"=>$row->provNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //readXProvincia
    public function readXProvincia(){
        $id = $this->input->get('id');
        $this->load->model('mMunicipios');
        foreach($this->mMunicipios->mreadXProvincias($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->munNome,
                "munNome"=>$row->munNome,
                "munNascimento"=>$row->munNome,
                "munCodigo"=>$row->munCodigo,
                "Provincias_id"=>$row->Provincias_id,
                "provNome"=>$row->provNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function GetID() {
        $munNome = $this->input->post('munNome');
        $this->load->model('mMunicipios');
        echo $this->mMunicipios->mGetID($munNome);
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
        $munNome = $this->input->post('munNome');
        $munCodigo = $this->input->post('munCodigo');
        $Provincias_id = $this->input->post('Provincias_id');
        $this->load->model('mMunicipios');
        if($this->mMunicipios->mupdate($id,$munNome,$munCodigo,$Provincias_id))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $munNome = $this->input->post('munNome');
        $munCodigo = $this->input->post('munCodigo');
        $Provincias_id = $this->input->post('Provincias_id');
        $this->load->model('mMunicipios');
        if($this->mMunicipios->minsert($munNome,$munCodigo,$Provincias_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mMunicipios');
            if($this->mMunicipios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>