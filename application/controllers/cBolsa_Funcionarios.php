<?php
class CBolsa_Funcionarios extends CI_Controller {
    
    public function read(){
        $this->load->model('mBolsa_Funcionarios');
        foreach($this->mBolsa_Funcionarios->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->bolNome,
                "bolNome"=>$row->bolNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID(){
        $Nome = $this->input->post('bolNome');
        $this->load->model('mBolsa_Funcionarios');
        echo $this->mBolsa_Funcionarios->mGetID($Nome);
    }
}