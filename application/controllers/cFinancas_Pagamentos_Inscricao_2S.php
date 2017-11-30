<?php
class CFinancas_Pagamentos_Inscricao_2S extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Pagamentos_Inscricao_2S');
        echo json_encode($this->MFinancas_Pagamentos_Inscricao_2S->mread());
    }
/*
    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        //Dados Pessoais
        $fpcCodigoBarra = $request['fpcCodigoBarra'];
        $fpcData = $request['fpcData'];
        $fpcHora = $request['fpcHora'];
        $fpcValor = $request['fpcValor'];
        $fpcRefPagamento = $request['fpcRefPagamento'];
        $ftpNome = $request['ftpNome'];
        $ffpNome = $request['ffpNome'];
        $contNumero = $request['contNumero'];
        $contNome = $request['contNome'];
        $bancNome = $request['bancNome'];

        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MFinancas_Pagamentos_Candidatos');
        if ($webix_operation == "insert"){
            if($this->MFinancas_Pagamentos_Candidatos->minsert($fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                                                                $ftpNome,$ffpNome,$contNumero,$contNome,$bancNome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MFinancas_Pagamentos_Candidatos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
    */
}