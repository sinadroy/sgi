<?php
class CTipo_Instituicao_Laboral extends CI_Controller {
    
    public function read(){
        $this->load->model('mTipo_Instituicao_Laboral');
        echo json_encode($this->mTipo_Instituicao_Laboral->mread());
    } 
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mTipo_Instituicao_Laboral');
        echo $this->mTipo_Instituicao_Laboral->mGetIDXCandidato_id($Nome);
    }
}