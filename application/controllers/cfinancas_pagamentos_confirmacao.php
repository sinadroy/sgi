<?php
class Cfinancas_pagamentos_confirmacao extends CI_Controller {
    
    public function read(){
        $this->load->model('Mfinancas_pagamentos_confirmacao');
        echo json_encode($this->Mfinancas_pagamentos_confirmacao->mread());
    }
    public function readXcb_valor_total_confirmacao() {
        $request = $_POST;
        $cb = $request['cb'];
        $this->load->model('Mfinancas_pagamentos_confirmacao');
        echo $this->Mfinancas_pagamentos_confirmacao->mreadXcb_valor_total_confirmacao($cb);
    }
    public function Existe_Pagamento() {
        $bi = $this->input->post('bi');
        $s = $this->input->post('s');
        $this->load->model('Mfinancas_pagamentos_confirmacao');
        echo ($this->Mfinancas_pagamentos_confirmacao->mExiste_Pagamento($bi,$s))?"true":"false";
    }
    /*
    public function readX(){
        $request = $_GET;
        $bi = $request['bi'];
        $alano = $request['alano'];
        $this->load->model('Mpagamentos_propina');
        echo json_encode($this->Mpagamentos_propina->mreadX($bi,$alano));
    }
    public function read_dividas_turmas(){
        $request = $_GET;
        $alt = $request['alt']; 
        $al = $request['al'];
        $n = $request['n'];
        $c = $request['c'];
        $p = $request['p'];
        $ac = $request['ac'];
        $t = $request['t'];
        $m = $request['m'];
        $mt = $request['mt'];
        $this->load->model('Mpagamentos_propina');
        echo json_encode($this->Mpagamentos_propina->mread_dividas_turmas($al,$alt,$n,$c,$p,$ac,$t,$m,$mt));
    }
    */
    
    
    //cancelar_pagamento
   /* public function cancelar_pagamento(){
        $request = $_POST;
        $id = $request['id'];
        $cNome = $request['cNome'];
        $cApelido = $request['cApelido'];
        $cBI_Passaporte = $request['cBI_Passaporte'];
        //user id
        $user = $request["utilizadores_id"];
        $this->load->model("Mutilizadores");
        $utilizadores_id = $this->Mutilizadores->mGetID($user);

        $this->load->model('Mpagamentos_propina');
        echo ($this->Mpagamentos_propina->mcancelar_pagamento($id,$utilizadores_id,$user,$cNome,$cApelido,$cBI_Passaporte))?"true":"false";
    }
    */
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $fpddata = date('Y-m-d');
        $fpdhora = date('H:i:s'); 
        $fpdvalor = $request["total_pagar"];
        $fpdusuario = $request["utilizadores_id"];

        $fpdrefpagamento = $request["fpdrefpagamento"];
        $Estudantes_id = $request["Estudantes_id"];
        $semestres_id = $request["semestres_id"];
        $Financas_Forma_Pagamento_id = $request["Financas_Forma_Pagamento_id"];
        $Financas_Contas_id = $request["Financas_Contas_id"];
        
        $cnome = $request["cnome"];
        $bi = $request["bi"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mfinancas_pagamentos_confirmacao');

        if ($webix_operation == "insert"){
            if($this->Mfinancas_pagamentos_confirmacao->minsert($fpddata,$fpdhora,$fpdvalor,$fpdusuario,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mfinancas_pagamentos_confirmacao->mupdate($id,$fpddata,$fpdhora,$fpdvalor,$fpdusuario,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
               echo "false";
        } else 
            echo "false";
    } 
}