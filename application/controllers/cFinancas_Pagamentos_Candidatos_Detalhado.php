<?php
class CFinancas_Pagamentos_Candidatos_Detalhado extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Pagamentos_Candidatos_Detalhado');
        echo json_encode($this->MFinancas_Pagamentos_Candidatos_Detalhado->mread());
    }
}