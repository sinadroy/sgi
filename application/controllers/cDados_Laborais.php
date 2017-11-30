<?php
class CDados_Laborais extends CI_Controller {
    /*
    public function read(){
        $this->load->model('mTrabalhador');
        echo json_encode($this->mTrabalhador->mread());
    } 
    */
    public function Get_ltXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Laborais');
        echo $this->mDados_Laborais->mGet_ltXCandidato_id($Nome);
    }
    public function Get_cargoXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Laborais');
        echo $this->mDados_Laborais->mGet_cargoXCandidato_id($Nome);
    }
}