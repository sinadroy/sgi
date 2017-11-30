<?php

class Cfinancas_pagamento_confirmacao_comprovativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $total_pagar = $request['total_pagar'];
        $utilizadores_id = $request['utilizadores_id'];
        $fpdrefpagamento = $request['fpdrefpagamento'];
        $Estudantes_id = $request['Estudantes_id'];
        $semestres_id = $request['semestres_id'];
        $Financas_Forma_Pagamento_id = $request['Financas_Forma_Pagamento_id'];
        $Financas_Contas_id = $request['Financas_Contas_id'];
        $bi = $request['bi'];
        $cnome = $request['cnome'];
        $this->load->model('Mfinancas_pagamento_confirmacao_comprovativo');
        $this->Mfinancas_pagamento_confirmacao_comprovativo->criarPdf($id,$total_pagar,$utilizadores_id,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome);
    }
}
