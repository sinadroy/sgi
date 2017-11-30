<?php
class Cmultas_propina extends CI_Controller {
    
    public function read(){
        $this->load->model('mmultas_propina');
        echo json_encode($this->mmultas_propina->mread());
    }
    public function mreadIdXMes() {
        $mesnome = $this->input->post('mesnome');
        $this->load->model('mmultas_propina');
        echo $this->mmultas_propina->mreadIdXMes($mesNome);
    }

    public function read_porciento() {
        $mes_a_pagar = $this->input->post('mes_a_pagar');
        $ano_a_pagar = $this->input->post('ano_a_pagar');
        $this->load->model('mmultas_propina');
        echo $this->mmultas_propina->mread_porciento($mes_a_pagar, $ano_a_pagar);
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $mp_data_inicio = @$request["mp_data_inicio"];
        $mp_data_fin = @$request["mp_data_fin"];
        $mp_porciento = @$request["mp_porciento"];
        $meses_propina_id = @$request["mesnome"];

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mmultas_propina');

        if(!is_numeric($meses_propina_id))
            $meses_propina_id = $this->mmultas_propina->mreadIdXMes($meses_propina_id);

        if ($webix_operation == "insert"){
            if($this->mmultas_propina->minsert($mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id))
                echo "true";
            else
                echo "false";
                
        } else if ($webix_operation == "update"){
            if($this->mmultas_propina->mupdate($id,$mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mmultas_propina->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
                echo "false";
    } 
}