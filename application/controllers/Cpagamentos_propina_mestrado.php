<?php
class Cpagamentos_propina_mestrado extends CI_Controller {
    
    public function read(){
        $this->load->model('Mpagamentos_propina_mestrado');
        echo json_encode($this->Mpagamentos_propina_mestrado->mread());
    }
    public function readX(){
        $request = $_GET;
        $bi = $request['bi'];
        $alano = $request['alano'];
        $this->load->model('Mpagamentos_propina_mestrado');
        echo json_encode($this->Mpagamentos_propina_mestrado->mreadX($bi,$alano));
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
        $this->load->model('Mpagamentos_propina_mestrado');
        echo json_encode($this->Mpagamentos_propina_mestrado->mread_dividas_turmas($al,$alt,$n,$c,$p,$ac,$t,$m,$mt));
    }
    //mreadXvalor_propina
    public function readXvalor_propina(){
        $request = $_POST;
        $bi = $request['bi'];
        $mes_a_pagar = $request['mes_a_pagar'];
        $ano_a_pagar = $request['ano_a_pagar'];
        $this->load->model('Mpagamentos_propina_mestrado');
        echo $this->Mpagamentos_propina_mestrado->mreadXvalor_propina($bi, $mes_a_pagar, $ano_a_pagar);
    }
    public function Existe_Pagamento() {
        $bi = $this->input->post('bi');
        $alAno = $this->input->post('alAno');
        $this->load->model('Mpagamentos_propina_mestrado');
        echo ($this->Mpagamentos_propina_mestrado->mExiste_Pagamento($bi,$alAno))?"true":"false";
    }
    //cancelar_pagamento
    public function cancelar_pagamento(){
        $request = $_POST;
        $id = $request['id'];
        $cNome = $request['cNome'];
        $cApelido = $request['cApelido'];
        $cBI_Passaporte = $request['cBI_Passaporte'];
        //user id
        $user = $request["utilizadores_id"];
        $this->load->model("Mutilizadores");
        $utilizadores_id = $this->Mutilizadores->mGetID($user);

        $this->load->model('Mpagamentos_propina_mestrado');
        echo ($this->Mpagamentos_propina_mestrado->mcancelar_pagamento($id,$utilizadores_id,$user,$cNome,$cApelido,$cBI_Passaporte))?"true":"false";
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        //date
        $ppData = date('Y-m-d');;
        //Hora
        $ppHora = date('H:i:s'); 
        $ppValor = $request["ppValor"];

        $anos_lectivos_id = $request["anos_lectivos_id"];
        //mes id
        $mesNome = $request["mesNome"];
        $this->load->model("Mmeses_propina_mestrado");
        $Meses_Propina_id = $this->Mmeses_propina_mestrado->mGetID($mesNome);

        $Estudantes_id = $request["Estudantes_id"];

        //user id
        $user = $request["utilizadores_id"];
        $this->load->model("Mutilizadores");
        $utilizadores_id = $this->Mutilizadores->mGetID($user);

        $Financas_Forma_Pagamento_id = $request["Financas_Forma_Pagamento_id"];
        $Financas_Contas_id = $request["Financas_Contas_id"];

        $fpcRefPagamento = $request["fpcRefPagamento"];

        $cNome = $request["cNome"];
        $bi = $request["bi"];

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mpagamentos_propina_mestrado');

        if ($webix_operation == "insert"){
            if($this->Mpagamentos_propina_mestrado->minsert($id,$anos_lectivos_id,$ppData,$ppHora,$ppValor,$Meses_Propina_id,$Estudantes_id,$utilizadores_id))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->Mpagamentos_propina_mestrado->mupdate($id,$ppData,$ppHora,$ppValor,$utilizadores_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$fpcRefPagamento,$cNome,$bi,$user))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
           /* if($this->Mpagamentos_propina->mdelete($id))
                echo "true"; 
            else*/
               echo "false";
        } else 
            echo "false";
    } 
}