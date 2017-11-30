<?php
class CUniversidades extends CI_Controller {
    
    public function read(){
        $this->load->model('mUniversidades');
        foreach($this->mUniversidades->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "univNome"=>$row->univNome,
                "value"=>$row->univNome,
                "univCodigo"=>$row->univCodigo,
                "paNome"=>$row->paNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function read_x_pais(){
        $pid = $this->input->get('paNome');
        $this->load->model('mUniversidades');
        foreach($this->mUniversidades->mread_x_pais($pid) as $row){
            $al[] = array(
                "id"=>$row->id,
                "univNome"=>$row->univNome,
                "value"=>$row->univNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function GetID() {
        $univNome = $this->input->post('univNome');
        $this->load->model('mUniversidades');
        echo $this->mUniversidades->mGetID($univNome);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $univNome = $request["univNome"];
        $univCodigo = $request["univCodigo"];
        $paNome = $request["paNome"];
        //
        if(!is_numeric($paNome)){
            $this->load->model('mpaises');
            $paNome = $this->mpaises->mGetID($paNome);
        }
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mUniversidades');

        if ($webix_operation == "insert"){
            if($this->mUniversidades->minsert($univNome,$univCodigo,$paNome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mUniversidades->mupdate($id,$univNome,$univCodigo,$paNome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mUniversidades->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $univNome = $this->input->post('univNome');
        $univCodigo = $this->input->post('univCodigo');
        $this->load->model('mUniversidades');
        if($this->mGraus_Pretendidos->mupdate($id,$univNome,$univCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        //$id = $this->input->post('Funcionarios_id');
        $univNome = $this->input->post('univNome');
        $univCodigo = $this->input->post('univCodigo');
        $this->load->model('mUniversidades');
        if($this->mUniversidades->minsert($univNome,$univCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mUniversidades');
            if($this->mUniversidades->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}