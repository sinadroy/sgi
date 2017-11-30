<?php
class CFinancas_Pagamentos_Candidatos extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Pagamentos_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Candidatos->mread());
    }

    public function read_valor_total_inscricao(){
        $this->load->model('MFinancas_Pagamentos_Candidatos');
        echo $this->MFinancas_Pagamentos_Candidatos->mread_valor_total_inscricao().',00 kz';
    }

    public function Cancelar_Pagamento(){
        $request = $_POST;
        $id = @$request['id'];
        $tp = $request['tp'];
        $usuario = @$request['utilizadores_id'];
        $fppcData = date("Y").'-'.date("m").'-'.date('d');
        $this->load->model('MFinancas_Pagamentos_Candidatos');
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        //cancelar pagamento feito
        if($this->MFinancas_Pagamentos_Candidatos->mCancelar_Pagamento($id,$usuario)){
            //criar divida como pagamento pendiente
            if($this->MFinancas_Pagamentos_Pendientes_Candidatos->minsert($fppcData,"",$tp,$id))
                echo "true";
            else
                echo "false";
        }else
            echo "false";
    }
    
    public function read_candidato_X_idpag(){
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Candidatos');
        echo $this->MFinancas_Pagamentos_Candidatos->mread_candidato_X_idpag($id);
    }

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
}