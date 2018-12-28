<?php
class CFinancas_cartao extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_cartao');
        echo json_encode($this->MFinancas_cartao->mread());
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $fc_data = $request["fc_data"];
        $fc_hora = $request["fc_hora"];
        $fc_ref_pag = $request["fc_ref_pag"];
        $fc_valor = $request["fc_valor"];
        $ffpNome = $request["ffpNome"];
        $contNumero = $request["contNumero"];
        $alAno = $request["alAno"];
        $cnome = $request["cnome"];
        $cnomes = $request["cnomes"];
        $cbi_passaporte = $request["cbi_passaporte"];

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