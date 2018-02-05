<?php
class CAcademica_Turmas_Ingreso_2S extends CI_Controller {
    
    public function read(){
        $request = $_GET;
		$al = '';
		$this->load->model('mAnos_lectivos');
		if(isset($request['al'])){
			$al = $request['al'];
		}else{
			$al = $this->mAnos_lectivos->mGetID(date('Y'));
        }
        
        $this->load->model('mAcademica_Turmas_Ingreso_2S');
        echo json_encode($this->mAcademica_Turmas_Ingreso_2S->mread($al));
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
        $al = $request["alAno"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        // si el ano lectivo es anterior al ano actual del sistema no permitir alteraciones.
		$this->load->model('manos_lectivos');
        $al2 = $this->manos_lectivos->mreadX($al);
        
        $this->load->model('MAcademica_Turmas_Ingreso_2S');

        if ($webix_operation == "insert"){
            if($this->MAcademica_Turmas_Ingreso_2S->minsert($atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MAcademica_Turmas_Ingreso_2S->mupdate($id,$atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al))
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