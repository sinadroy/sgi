<?php
class Cestudantes_turmas extends CI_Controller {
    
    public function read(){
        $this->load->model('Mestudantes_turmas');
        echo json_encode($this->Mestudantes_turmas->mread());
    }
    public function readXncp() {
        $request = $_GET;
		$n = $request['nNome'];
		$c = $request['cNome'];
        $p = $request['pNome'];
		$this->load->model('mTurmas');
		echo json_encode($this->mTurmas->mreadXncp($n,$c,$p));
	}
    public function GetID() {
        $Nome = $this->input->post('tNome');
        $this->load->model('mTurmas');
        echo $this->mTurmas->mGetID($Nome);
    }
     
}
?>