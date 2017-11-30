<?php
class CGeneros extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mGeneros');
        foreach($this->mGeneros->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->gNome,
                "gNome"=>$row->gNome,
                "gCodigo"=>$row->gCodigo
            );
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function estudantes_x_sexo() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('mGeneros');
        echo json_encode($this->mGeneros->mestudantes_x_sexo($al,$n,$c,$p));
    }

    public function GetID() {
        $Nome = $this->input->post('gNome');
        $this->load->model('mGeneros');
        echo $this->mGeneros->mGetID($Nome);
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
        $gNome = $this->input->post('gNome');
        $gCodigo = $this->input->post('gCodigo');
        $this->load->model('mGeneros');
        if($this->mGeneros->mupdate($id,$gNome,$gCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $gNome = $this->input->post('gNome');
        $gCodigo = $this->input->post('gCodigo');
        $this->load->model('mGeneros');
        if($this->mGeneros->minsert($gNome,$gCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mGeneros');
            if($this->mGeneros->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>