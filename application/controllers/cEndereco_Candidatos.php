<?php
class CEndereco_Candidatos extends CI_Controller {
    /*
    public function read(){
        $this->load->model('mTrabalhador');
        echo json_encode($this->mTrabalhador->mread());
    } 
    */
    public function Get_paisXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('MEndereco_Candidatos');
        echo $this->MEndereco_Candidatos->mGet_paisXCandidato_id($Nome);
    }
    public function Get_provXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('MEndereco_Candidatos');
        echo $this->MEndereco_Candidatos->mGet_provXCandidato_id($Nome);
    }
    public function Get_munXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('MEndereco_Candidatos');
        echo $this->MEndereco_Candidatos->mGet_munXCandidato_id($Nome);
    }
    public function Get_bairroXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('MEndereco_Candidatos');
        echo $this->MEndereco_Candidatos->mGet_bairroXCandidato_id($Nome);
    }
    
}