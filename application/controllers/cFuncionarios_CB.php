<?php
class CFuncionarios_CB extends CI_Controller {
    
   public function imprimir(){
       $this->load->model('mFuncionarios_CB');
       echo '<div><img border="0" height="30" width="150" src="data:image/png;base64,' . base64_encode($this->mFuncionarios_CB->criarCB("123456")) . '"></div>';
    }
     
}