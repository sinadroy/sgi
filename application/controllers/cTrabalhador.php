<?php
class CTrabalhador extends CI_Controller {
    
    public function read(){
        $this->load->model('mTrabalhador');
        echo json_encode($this->mTrabalhador->mread());
    } 
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mTrabalhador');
        echo $this->mTrabalhador->mGetIDXCandidato_id($Nome);
    }
}