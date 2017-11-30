<?php
class CNacionalidades_Geral extends CI_Controller {
    
    public function read(){
        $this->load->model('mNacionalidades_Geral');
        echo json_encode($this->mNacionalidades_Geral->mread());
    } 
    public function GetID() {
        $Nome = $this->input->post('ngNome');
        $this->load->model('mNacionalidades_Geral');
        echo $this->mNacionalidades_Geral->mGetID($Nome);
    }
}