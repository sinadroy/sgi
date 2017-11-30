<?php
class CRegistro_Funcionarios extends CI_Controller {
    public function read(){
        $this->load->model('MRegistro_Funcionarios');
        echo json_encode($this->MRegistro_Funcionarios->mread());
    }  
}