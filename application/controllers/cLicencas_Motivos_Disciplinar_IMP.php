<?php
class CLicencas_Motivos_Disciplinar_IMP extends CI_Controller {
    
   public function imprimir(){
       $fid = $this->input->post('Funcionarios_id');
       $this->load->model('mLicencas_Motivos_Disciplinar_IMP');
       $this->mLicencas_Motivos_Disciplinar_IMP->criarPdf($fid);
       
       //     $response =  "{success:true, total: 0, data:''}";
       // echo $response;
    }
     
}