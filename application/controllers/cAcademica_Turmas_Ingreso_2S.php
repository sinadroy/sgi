<?php
class CAcademica_Turmas_Ingreso_2S extends CI_Controller {
    
    public function read(){
        $this->load->model('mAcademica_Turmas_Ingreso_2S');
        echo json_encode($this->mAcademica_Turmas_Ingreso_2S->mread());
    }

    public function readCapacidadeTurma(){
        $request = $_POST;
        $turma = $request['turma'];
        $this->load->model('mAcademica_Turmas_Ingreso_2S');
        echo $this->mAcademica_Turmas_Ingreso_2S->mreadCapacidadeTurma($turma);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $atcNome = $request["atcNome"];
        $atcCodigo = $request["atcCodigo"];
        $atcCapacidade = $request["atcCapacidade"];
        $atcLocalizacao = $request["atcLocalizacao"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Turmas_Ingreso_2S');

        if ($webix_operation == "insert"){
            if($this->MAcademica_Turmas_Ingreso_2S->minsert($atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MAcademica_Turmas_Ingreso_2S->mupdate($id,$atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MAcademica_Turmas_Ingreso_2S->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}