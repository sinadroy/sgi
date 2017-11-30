<?php
class Cpautas_configuracao extends CI_Controller {
    
    public function read(){
        $this->load->model('mpautas_configuracao');
        echo json_encode($this->mpautas_configuracao->mread());
    }

    public function get_porcento_pp1(){
        $d_geracao_id = $this->input->get('d_geracao_id');
        $td = $this->input->get('td');
        $this->load->model('mpautas_configuracao');
        echo $this->mpautas_configuracao->mGet_Porcento_pp1($d_geracao_id, $td);
    }
    public function get_porcento_pp2(){
        $d_geracao_id = $this->input->post('d_geracao_id');
        $td = $this->input->post('td');
        $this->load->model('mpautas_configuracao');
        echo $this->mpautas_configuracao->mGet_Porcento_pp2($d_geracao_id, $td);
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $dgnome = $request["dgnome"];
        $td = $request["td"];
        $pp1 = $request["pp1"];
        $pp2 = $request["pp2"];
        $pp3 = $request["pp3"];
        $ef = $request["ef"];
        $recurso = $request["recurso"];
        $especial = $request["especial"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mpautas_configuracao');

        if ($webix_operation == "insert"){
            if($this->mpautas_configuracao->minsert($dgnome,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mpautas_configuracao->mupdate($id,$dgnome,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mpautas_configuracao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}