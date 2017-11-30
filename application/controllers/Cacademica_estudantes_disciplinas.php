<?php
class Cacademica_estudantes_disciplinas extends CI_Controller {
    
    public function read(){
        $this->load->model('macademica_estudantes_disciplinas');
        echo json_encode($this->macademica_estudantes_disciplinas->mread());
    }
    public function read_disc_semestre(){
        $bi = $this->input->get('bi');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $s = $this->input->get('s');
        $this->load->model('macademica_estudantes_disciplinas');
        echo json_encode($this->macademica_estudantes_disciplinas->mread_disc_semestre($bi,$n,$c,$p,$s));
    }
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mOrganismos_Tutela');
        echo $this->mOrganismos_Tutela->mGetIDXCandidato_id($Nome);
    }
    public function existe_d_e() {
        $bi = $this->input->post('bi');
        $idd = $this->input->post('idd');
        $this->load->model('macademica_estudantes_disciplinas');
        if($this->macademica_estudantes_disciplinas->mexiste_d_e($bi,$idd) == "Sim")
            echo "true";
        else
            echo "false";
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $idd = $request["idd"];
        $bi = @$request["bi"];
        $al = @$request['al'];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('macademica_estudantes_disciplinas');

        if ($webix_operation == "insert"){
            if($this->macademica_estudantes_disciplinas->minsert($bi,$idd,$al))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->macademica_estudantes_disciplinas->mupdate_aa($id,$idd))
                echo "true"; 
            else
               echo "false";
        } else if ($webix_operation == "delete"){
            if($this->macademica_estudantes_disciplinas->mdelete($id,$idd))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}