<?php

class CFinancas_Exame_Recurso_Comprobativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        
        $id = @$request['id'];
        
        $fc_data = date('Y-m-d');;
        
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

        $user = $request["utilizadores_id"];
        
        $this->load->model('MFinancas_Exame_Recurso_Comprobativo');
        $this->MFinancas_Exame_Recurso_Comprobativo->criarPdf($id,$fc_data,$fc_hora,$fc_ref_pag,$fc_valor,$ffpNome,$contNumero,$anos_lectivos_id,$bi,$Estudantes_id,$user);
    }
}
