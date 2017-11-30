<?php
class Cdeclaracao_sem_notas_num_dec extends CI_Controller {
    
    public function read(){
        $this->load->model('Mdeclaracao_sem_notas_num_dec');
        echo $this->Mdeclaracao_sem_notas_num_dec->mread();
    }
    
    public function update(){ 
            $this->load->model('Mdeclaracao_sem_notas_num_dec');
            if($this->Mdeclaracao_sem_notas_num_dec->mupdate($this->Mdeclaracao_sem_notas_num_dec->mread()+1))
                echo "true"; 
            else
               echo "false";
    }
  /*   
    public function insert(){
        $paNome = $this->input->post('paNome');
        $paCodigo = $this->input->post('paCodigo');
        $this->load->model('mpaises');
        if($this->mpaises->minsert($paNome,$paCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mpaises');
            if($this->mpaises->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     */
}
?>