<?php
class Cmultas_propina_mestrado extends CI_Controller {
    
    public function read(){
        $this->load->model('mmultas_propina_mestrado');
        echo json_encode($this->mmultas_propina_mestrado->mread());
    }
    public function mreadIdXMes() {
        $mesnome = $this->input->post('mesnome');
        $this->load->model('mmultas_propina_mestrado');
        echo $this->mmultas_propina_mestrado->mreadIdXMes($mesNome);
    }

    public function read_porciento() {
        $mes_a_pagar = $this->input->post('mes_a_pagar');
        $ano_a_pagar = $this->input->post('ano_a_pagar');
        $this->load->model('mmultas_propina_mestrado');
        echo $this->mmultas_propina_mestrado->mread_porciento($mes_a_pagar, $ano_a_pagar);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $mp_data_inicio = @$request["mp_data_inicio"];
        $mp_data_fin = @$request["mp_data_fin"];
        $mp_porciento = @$request["mp_porciento"];
        $meses_propina_id = @$request["mesnome"];

        // webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mmultas_propina_mestrado');

        if(!is_numeric($meses_propina_id))
            $meses_propina_id = $this->mmultas_propina_mestrado->mreadIdXMes($meses_propina_id);

        if ($webix_operation == "insert"){
            if($this->mmultas_propina_mestrado->minsert($mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id))
                echo "true";
            else
                echo "false";
                
        } else if ($webix_operation == "update"){
            if($this->mmultas_propina_mestrado->mupdate($id,$mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mmultas_propina_mestrado->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
                echo "false";
    } 
}