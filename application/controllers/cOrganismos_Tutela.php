<?php
class COrganismos_Tutela extends CI_Controller {
    
    public function read(){
        $this->load->model('mOrganismos_Tutela');
        echo json_encode($this->mOrganismos_Tutela->mread());
    }
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mOrganismos_Tutela');
        echo $this->mOrganismos_Tutela->mGetIDXCandidato_id($Nome);
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $otNome = $request["otNome"];
        $otCodigo = $request["otCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mOrganismos_Tutela');

        if ($webix_operation == "insert"){
            if($this->mOrganismos_Tutela->minsert($otNome,$otCodigo))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mOrganismos_Tutela->mupdate($id,$otNome,$otCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mOrganismos_Tutela->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}