<?php
class CAcademica_Turmas_Ingreso extends CI_Controller {
	
	
	public function read(){
		
		$request = $_GET;
		
		$al = @$request['al'];
		
		$this->load->model('mAcademica_Turmas_Ingreso');
		
		echo json_encode($this->mAcademica_Turmas_Ingreso->mread($al));
		
	}
	
	
	public function readCapacidadeTurma(){
		
		$request = $_POST;
		
		$turma = $request['turma'];
		
		$this->load->model('mAcademica_Turmas_Ingreso');
		
		echo $this->mAcademica_Turmas_Ingreso->mreadCapacidadeTurma($turma);
		
	}
	
	
	
	
	public function crud(){
		
		$request = $_POST;
		
		$id = @$request['id'];
		
		$atcNome = $request["atcNome"];
		
		$atcCodigo = $request["atcCodigo"];
		
		$atcCapacidade = $request["atcCapacidade"];
		
		$atcLocalizacao = $request["atcLocalizacao"];
		
		$al = $request["alAno"];
		
		//w		ebix_operation
		$webix_operation = $request["webix_operation"];
		
		//s		i el ano lectivo es anterior al ano actual del sistema no permitir alteraciones.
		$this->load->model('manos_lectivos');
		
		$al2 = $this->manos_lectivos->mreadX($al);
		
		//if($al2 >= date('Y')){
			
			$this->load->model('MAcademica_Turmas_Ingreso');
			
			
			if ($webix_operation == "insert"){
				
				if($this->MAcademica_Turmas_Ingreso->minsert($atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al))
				echo "true";
				
				else
				echo "false";
				
				
			}
			else if ($webix_operation == "update"){
				
				if($this->MAcademica_Turmas_Ingreso->mupdate($id,$atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al))
				echo "true";
				
				else
				echo "false";
				
			}
			else if ($webix_operation == "delete"){
				
				if($this->MAcademica_Turmas_Ingreso->mdelete($id))
				echo "true";
				
				else
				echo "false";
				
			}
			else 
			echo "false";
			
        //}else
        //    echo "false";
		
	}
	
}
