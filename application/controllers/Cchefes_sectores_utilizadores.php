<?php
class Cchefes_sectores_utilizadores extends CI_Controller {
    
    public function read(){
        $this->load->model('Mchefes_sectores_utilizadores');
        echo json_encode($this->Mchefes_sectores_utilizadores->mread());
    }
    public function read_fid(){
        $this->load->model('Mchefes_sectores_utilizadores');
        echo json_encode($this->Mchefes_sectores_utilizadores->mread_fid());
    }
    public function read_dpto_id(){
        $idu = $this->input->post('idu');
        $this->load->model('Mchefes_sectores_utilizadores');
        echo $this->Mchefes_sectores_utilizadores->mread_dpto_id($idu);
    }
    public function get_id(){
        $fnome = $this->input->get('fnome');
        $fapelido = $this->input->get('fapelido');
        $this->load->model('Mchefes_sectores_utilizadores');
        echo json_encode($this->Mchefes_sectores_utilizadores->mget_id($fnome,$fapelido));
    }
    public function existe(){
        $id = $this->input->post('id');
        $this->load->model('Mchefes_sectores_utilizadores');
        if($this->Mchefes_sectores_utilizadores->mexiste($id))
            echo "true";
        else
            echo "false";
    }
    public function GetIDXCandidato_id() {
        $Nome = $this->input->post('id');
        $this->load->model('mOrganismos_Tutela');
        echo $this->mOrganismos_Tutela->mGetIDXCandidato_id($Nome);
    }
    public function dpto_x_bi(){
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $bi = $this->input->post('bi');
        $this->load->model('Mchefes_sectores_utilizadores');
        echo $this->Mchefes_sectores_utilizadores->mdpto_x_bi($n,$c,$bi);
    }
    public function comprobar_departamento_usuario(){
        $n = $this->input->post('n');
        $c = $this->input->post('c');
        $bi = $this->input->post('bi');

        //$dpto_est = $this->input->post('dpto');
        $user = $this->input->post('user');
        //$dpto_est = $dpto_est;
        $this->load->model('Mchefes_sectores_utilizadores');
        if($this->Mchefes_sectores_utilizadores->mcomprobar_departamento_usuario(/*$dpto_est,*/$user, $n,$c,$bi))
            echo "true";
        else
            echo "false";
    }
    //
    public function dt_se_chefe_departamento(){
        $user = $this->input->post('login');
        $this->load->model('Mchefes_sectores_utilizadores');
        if($this->Mchefes_sectores_utilizadores->mdt_se_chefe_departamento($user))
            echo "true";
        else
            echo "false";
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $funcionarios_id = @$request["funcionarios_id"];
        $utilizadores_id = @$request["utilizadores_id"];
        $sectores_id = @$request["sectores_id"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mchefes_sectores_utilizadores');

        if ($webix_operation == "insert"){
            if($this->Mchefes_sectores_utilizadores->minsert($funcionarios_id,$utilizadores_id,$sectores_id))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mchefes_sectores_utilizadores->mupdate($id,$funcionarios_id,$utilizadores_id,$sectores_id))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->Mchefes_sectores_utilizadores->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}