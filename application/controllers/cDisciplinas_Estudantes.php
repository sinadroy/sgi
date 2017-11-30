<?php
class CDisciplinas_Estudantes extends CI_Controller {
	
	public function read() {
		$this->load->model('MDisciplinas_Estudantes');
		echo json_encode($this->MDisciplinas_Estudantes->mread());
	}
	
	public function crud(){
		
		$request = $_POST; 
		$id = @$request['id'];
		$Estudantes_id = @$request['Estudantes_id'];
		$Disciplinas_id = @$request['Disciplinas_id'];
		//
		$webix_operation = $request["webix_operation"];
		
		$this->load->model('MDisciplinas_Estudantes');
		
		if($webix_operation == "insert"){
			
			if($this->MDisciplinas_Estudantes->minsert($Estudantes_id,$Disciplinas_id))
			{
				echo "true";
			}else
				echo "false";
			
		}else if ($webix_operation == "update"){
			
			if($this->MDisciplinas_Estudantes->mupdate($id,$Estudantes_id,$Disciplinas_id))
				echo "true";
			else
				echo "false";
		}
		else if ($webix_operation == "delete"){
			
			if($this->MDisciplinas_Estudantes->mdelete($id))
				echo "true";
			else
				echo "false";
		}
		else 
			echo "false";
		
	}
	
}
