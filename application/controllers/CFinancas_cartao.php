<?php
class CFinancas_cartao extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_cartao');
        echo json_encode($this->MFinancas_cartao->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $fc_data = date('Y-m-d');
        $fc_hora = date("G:i:s");
        $fc_ref_pag = $request["fc_ref_pag"];
        $fc_valor = $request["fc_valor"];
        $ffpNome = $request["ffpNome"];
        $Financas_Forma_Pagamento_id = $ffpNome; // convertir esto en id
        $contNumero = $request["contNumero"];
        $this->load->model('MFinancas_Contas');
        $Financas_Contas_id = $contNumero;// $this->MFinancas_Contas->mreadIDXNome($contNumero); // convertir esto en id
        $this->load->model('manos_lectivos');
        $anos_lectivos_id = $this->manos_lectivos->mGetID(date('Y'));
        $bi = $request['bi'];
        $this->load->model('mestudantes');
        $Estudantes_id = $this->mestudantes->mget_idXbi($bi); // convertir esto en id

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MFinancas_cartao');

        if ($webix_operation == "insert"){
            if($this->MFinancas_cartao->minsert($fc_data,$fc_hora,$fc_ref_pag,$fc_valor,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$anos_lectivos_id,$Estudantes_id))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MFinancas_cartao->mupdate($id,$fc_data,$fc_hora,$fc_ref_pag,$fc_valor,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$anos_lectivos_id,$Estudantes_id))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MFinancas_cartao->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    } 
}