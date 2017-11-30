<?php
class CProvincias extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mread() as $row){
            if($row->provCodigo != '0' || $row->provCodigo != '00' || $row->provCodigo != '000')
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->provNome,
                    "provNome"=>$row->provNome,
                    "artigo"=>$row->artigo,
                    "provCodigo"=>$row->provCodigo,
                    "paNome"=>$row->paNome,
                    "provCodigoNome"=>$row->provCodigoNome
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
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->provNome,
                "provNome"=>$row->provNome,
                "provCodigo"=>$row->provCodigo,
                "paNome"=>$row->paNome,
                "provCodigoNome"=>$row->provCodigoNome
            );
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //para cargar prov por pais
    public function readXP(){
        $id = $this->input->get('id');
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mreadXP($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->provNome,
                "provNome"=>$row->provNome,
                "provCodigo"=>$row->provCodigo,
                "provCodigoNome"=>$row->provCodigoNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    Para diferenciar en Candidatos y estudantes la provincia de nascimento
    */
    public function readPN(){
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mreadPN() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->provNascimento,
                "provNascimento"=>$row->provNascimento,
                //"provCodigo"=>$row->provCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    Para diferenciar en Candidatos y estudantes la provincia de formacao
    */
    public function readPF(){
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mreadPF() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->provFormacao,
                "provFormacao"=>$row->provFormacao,
                //"provCodigo"=>$row->provCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    Para Candidatos, evitando conflictos con provNome
    */
    public function read_Provincia_Emissao(){
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->provNome,
                "provEmissao"=>$row->provNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function readXPais(){
        $id = $this->input->get('id');
        $this->load->model('mProvincias');
        foreach($this->mProvincias->mreadXPais($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->provNascimento,
                "provNome"=>$row->provNascimento,
                "provCodigo"=>$row->provCodigo,
                "provCodigoNome"=>$row->provCodigoNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $provNome = $this->input->post('provNome');
        $this->load->model('mProvincias');
        echo $this->mProvincias->mGetID($provNome);
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
        $provNome = $this->input->post('provNome');
        $artigo = $this->input->post('artigo');
        $provCodigo = $this->input->post('provCodigo');
        $paNome = $this->input->post('paNome');
        $provCodigoNome = $this->input->post('provCodigoNome');
        $this->load->model('mProvincias');
        if($this->mProvincias->mupdate($id,$provNome,$provCodigo,$paNome,$artigo,$provCodigoNome))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $provNome = $this->input->post('provNome');
        $artigo = $this->input->post('artigo');
        $provCodigo = $this->input->post('provCodigo');
        $paNome = $this->input->post('paNome');
        $provCodigoNome = $this->input->post('provCodigoNome');
        $this->load->model('mProvincias');
        if($this->mProvincias->minsert($provNome,$provCodigo,$artigo,$paNome,$provCodigoNome))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mProvincias');
            if($this->mProvincias->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>