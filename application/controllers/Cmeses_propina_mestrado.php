<?php
class Cmeses_propina_mestrado extends CI_Controller {
    
    public function read(){
        $this->load->model('Mmeses_propina_mestrado');
        echo json_encode($this->Mmeses_propina_mestrado->mread());
    }
    public function GetID() {
        $Nome = $this->input->post('id');
        $this->load->model('Mmeses_propina_mestrado');
        echo $this->Mmeses_propina_mestrado->mGetID($Nome);
    }
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $mesNome = $request["mesNome"];
        $mesEstado = $request["mesEstado"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mmeses_propina_mestrado');

        if ($webix_operation == "insert"){
            /*if($this->Mmeses_propina->minsert($otNome,$otCodigo))
                echo "true";
            else */
                echo "false";
                
        } else if ($webix_operation == "update"){
            if($this->Mmeses_propina_mestrado->mupdate($id,$mesNome,$mesEstado))
                echo "true"; 
            else
                echo "false";
        }/* else if ($webix_operation == "delete"){
            if($this->Mmeses_propina->mdelete($id))
                echo "true"; 
            else
               echo "false";
        }*/ else 
                echo "false";
    } 
}