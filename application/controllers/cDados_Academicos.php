<?php
class CDados_Academicos extends CI_Controller {
    /*
    public function read(){
        $this->load->model('mTrabalhador');
        echo json_encode($this->mTrabalhador->mread());
    } 
    */
    public function Get_pfXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_pfXCandidato_id($Nome);
    }
    public function Get_provfXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_provfXCandidato_id($Nome);
    }
    public function Get_hlXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_hlXCandidato_id($Nome);
    }
    public function Get_efXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_efXCandidato_id($Nome);
    }
    public function Get_opcXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_opcXCandidato_id($Nome);
    }
    public function Get_anoXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_anoXCandidato_id($Nome);
    }
    public function Get_mediaXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mDados_Academicos');
        echo $this->mDados_Academicos->mGet_mediaXCandidato_id($Nome);
    }
}