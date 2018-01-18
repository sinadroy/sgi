<?php
class CPrecarios_Cursos extends CI_Controller {
    
    public function read(){
        $this->load->model('MPrecarios_Cursos');
        echo json_encode($this->MPrecarios_Cursos->mread());
    }
    
    public function GetID() {
        $nome = $this->input->post('nome');
        $this->load->model('MPrecarios_Cursos');
        echo $this->MPrecarios_Cursos->mGetID($nome);
    }

    public function existe() {
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $p = $this->input->post('p');
        $prec = $this->input->post('prec');
        $al = $this->input->post('al');
        
        $this->load->model('MPrecarios_Cursos');
        if($this->MPrecarios_Cursos->mexiste($n,$c,$p,$prec,$al) > 0)
            echo "true";
        else
            echo "false";
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $al = $this->input->post('al');
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $p = $this->input->post('p');
        $prec = $this->input->post('prec');
        $ncp_preco = $this->input->post('ncp_preco');
        $ncp_precou = $this->input->post('ncp_precou');
        $this->load->model('MPrecarios_Cursos');
        if($this->MPrecarios_Cursos->mupdate($id,$al,$n,$c,$p,$prec,$ncp_preco,$ncp_precou))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $al = $this->input->post('al');
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $p = $this->input->post('p');
        $prec = $this->input->post('prec');
        $ncp_preco = $this->input->post('ncp_preco');
        $ncp_precou = $this->input->post('ncp_precou');
        $this->load->model('MPrecarios_Cursos');
        if($this->MPrecarios_Cursos->minsert($al,$n,$c,$p,$prec,$ncp_preco,$ncp_precou))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
        $this->load->model('MPrecarios_Cursos');
            if($this->MPrecarios_Cursos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>