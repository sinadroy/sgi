<?php
class CPaises extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mpaises');
        foreach($this->mpaises->mread() as $row){
            if($row->paCodigo != '0' || $row->paCodigo != '00' || $row->paCodigo != '000')
            {
                $al[] = array(
                "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->paNome,
                    "paNome"=>$row->paNome,
                    "paCodigo"=>$row->paCodigo
                ); 
                $ord++;
            }
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_combos(){
        $ord=1;
        $this->load->model('mpaises');
        foreach($this->mpaises->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->paNome,
                "paNome"=>$row->paNome,
                "paCodigo"=>$row->paCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    para evitar confuciones en candidatos y estudantes con pais de formacaion
    */
    public function readPF(){
        $this->load->model('mpaises');
        foreach($this->mpaises->mreadPF() as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->paFormacao,
                    "paFormacao"=>$row->paFormacao,
                    //"paCodigo"=>$row->paCodigo
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function GetID() {
        $paNome = $this->input->post('paNome');
        $this->load->model('mpaises');
        echo $this->mpaises->mGetID($paNome);
    }
    /*
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function update(){                       
            $id = $this->input->post('id');
            $paNome = $this->input->post('paNome');
            $paCodigo = $this->input->post('paCodigo');
            $this->load->model('mpaises');
            if($this->mpaises->mupdate($id,$paNome,$paCodigo))
                echo "true"; 
            else
               echo "false";
    }
     
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
     
}
?>