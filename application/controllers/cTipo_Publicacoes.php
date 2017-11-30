<?php
class CTipo_Publicacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('mTipo_Publicacoes');
        foreach($this->mTipo_Publicacoes->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->tpubNome,
                "tpubNome"=>$row->tpubNome
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID(){
        $Nome = $this->input->post('tpubNome');
        $this->load->model('mTipo_Publicacoes');
        echo $this->mTipo_Publicacoes->mGetID($Nome);
    }
}