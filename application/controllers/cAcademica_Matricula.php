<?php
class CAcademica_Matricula extends CI_Controller {
	
	public function read() {
		$this->load->model('MAcademica_Matricula');
		echo json_encode($this->MAcademica_Matricula->mread());
	}

	public function readXancp() {
		$request = $_GET;
		$alAno = date('Y');
		$nNome = $request['nNome'];
		$cNome = $request['cNome'];
		$pNome =$request['pNome'];
		$this->load->model('MAcademica_Matricula');
		echo json_encode($this->MAcademica_Matricula->mreadXancp($alAno,$nNome,$cNome,$pNome));
	}
}
