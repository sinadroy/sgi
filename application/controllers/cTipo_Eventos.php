<?php
class CTipo_Eventos extends CI_Controller {
    
    public function read(){
        $this->load->model('mTipo_Eventos');
        foreach($this->mTipo_Eventos->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->teNome,
                "teNome"=>$row->teNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID(){
        $Nome = $this->input->post('teNome');
        $this->load->model('mTipo_Eventos');
        echo $this->mTipo_Eventos->mGetID($Nome);
    }
}