<?php
class CModulos extends CI_Controller {
    
    public function read(){
        //$rol = $this->input->post('rol');
        //$rol = 'admin';
        $this->load->model('mModulos');
        foreach($this->mModulos->mread() as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->mNome,
                    "mNome"=>$row->mNome,
                    "mDescricao"=>$row->mDescricao,
            ); 
        }
            $total = count($al);
            //$x = (object)$al;
            $data = json_encode($al);
            $response = $data;
        
        echo $response;
    }

    public function getAccess(){
        $modulo = $this->input->post('modulo');
        $usuario = $this->input->post('usuario');
        $this->load->model('mModulos');
        if($this->mModulos->mgetAccess($modulo,$usuario))
            echo "true";
        else
            echo "false";
    }
}
?>