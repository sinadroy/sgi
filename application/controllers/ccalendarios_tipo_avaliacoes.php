<?php
class Ccalendarios_tipo_avaliacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('mcalendarios_tipo_avaliacoes');
        echo $this->mcalendarios_tipo_avaliacoes->mread();
    }
    
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $ava_nome = $request["ava_nome"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mcalendarios_tipo_avaliacoes');

        if ($webix_operation == "insert"){
            if($this->mcalendarios_tipo_avaliacoes->minsert($ava_nome))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->mcalendarios_tipo_avaliacoes->mupdate($id,$ava_nome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mcalendarios_tipo_avaliacoes->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
     
}
?>