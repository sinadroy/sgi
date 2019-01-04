<?php
class CPagamentos_Comprobativo_Prec extends CI_Controller {
    
    public function read(){
        $this->load->model('MPagamentos_Comprobativo_Prec');
        echo json_encode($this->MPagamentos_Comprobativo_Prec->mread());
    }
    public function read_precario_cartao(){
        $id_ncp = $this->input->post('id_ncp');
        $this->load->model('MPagamentos_Comprobativo_Prec');
        echo $this->MPagamentos_Comprobativo_Prec->mread_precario(1, $id_ncp);
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $pagamentos_comprobativo_id = $request['pagamentos_comprobativo_id'];
        $precario_id = $request['precario_id'];

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MPagamentos_Comprobativo_Prec');

        if ($webix_operation == "insert"){
            if($this->MPagamentos_Comprobativo_Prec->minsert($pagamentos_comprobativo_id,$precario_id))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MPagamentos_Comprobativo_Prec->mupdate($id,$pagamentos_comprobativo_id,$precario_id))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MPagamentos_Comprobativo_Prec->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}