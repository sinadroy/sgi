<?php
class CPagamentos_Comprobativo extends CI_Controller {
    
    public function read(){
        $this->load->model('MPagamentos_Comprobativo');
        echo json_encode($this->MPagamentos_Comprobativo->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $pc_nome = $request['pc_nome'];
        $pc_descricao = $request['pc_descricao'];

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MPagamentos_Comprobativo');

        if ($webix_operation == "insert"){
            if($this->MPagamentos_Comprobativo->minsert($pc_nome,$pc_descricao))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MPagamentos_Comprobativo->mupdate($id,$pc_nome,$pc_descricao))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MPagamentos_Comprobativo->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}