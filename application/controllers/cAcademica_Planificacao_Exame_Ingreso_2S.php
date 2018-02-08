<?php
class CAcademica_Planificacao_Exame_Ingreso_2S extends CI_Controller {
    
    public function read(){
        $this->load->model('manos_lectivos');
        $alAct = $this->manos_lectivos->mGetID(date('Y'));
        $al = $this->input->get('al');
        $al = ($al)?$al:$alAct;
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso_2S');
        echo json_encode($this->MAcademica_Planificacao_Exame_Ingreso_2S->mread($al));
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];
        $apeiData = $request["apeiData"];
        $apeiHora = $request["apeiHora"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso_2S');

        if ($webix_operation == "insert"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->mupdate($id,$alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}