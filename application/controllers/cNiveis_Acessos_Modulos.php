<?php
class CNiveis_Acessos_Modulos extends CI_Controller {
    
    public function read(){
        $this->load->model('mNiveis_Acessos_Modulos');
        $ord = 1;
        foreach($this->mNiveis_Acessos_Modulos->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "ord"=>$ord,
                "naNome"=>$row->naNome,
                "mNome"=>$row->mNome,
                "smNome"=>$row->smNome
            );
            $ord++;
        }
        $total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
/*
    public function getID() {
        $naNome = $this->input->post('naNome');
        $this->load->model('mNiveisAcesso');
        echo $this->mNiveisAcesso->getID($naNome);
    }
    public function update(){                       
            $id = $this->input->post('id');
            $naNome = $this->input->post('naNome');
            $naDescricao = $this->input->post('naDescricao');
            $this->load->model('mNiveisAcesso');
            if($this->mNiveisAcesso->mupdate($id,$naNome,$naDescricao))
                echo "true"; 
            else
               echo "false";
    }
 * 
 */
    public function validar_insert($na,$m,$sm){
        $this->load->model('mNiveis_Acessos_Modulos');
        $encontro_ocurrencia = 0;
        foreach($this->mNiveis_Acessos_Modulos->mread() as $row){
            if($row->idna == $na && $row->idm == $m && $row->idsm == $sm){
                $encontro_ocurrencia++;
            }
        }
        if($encontro_ocurrencia == 0){
            return  true;
        }
        else{
            return  false; 
        }
    }
    public function insert(){
        $na = $this->input->post('Niveis_Acessos_id');
        $m = $this->input->post('Modulos_id');
        $sm = $this->input->post('sub_modulos_id');
        $this->load->model('mNiveis_Acessos_Modulos');
        if($this->validar_insert($na, $m, $sm))
        {
            if($this->mNiveis_Acessos_Modulos->minsert($na,$m,$sm)){
               echo "true";
            }
            else{ echo "false";}
        }else{
            echo "false";
        }
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mNiveis_Acessos_Modulos');
            if($this->mNiveis_Acessos_Modulos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
 
}
?>