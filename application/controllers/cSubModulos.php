<?php
class CSubModulos extends CI_Controller {
    //mreadXid
    public function readXid(){
        $modulo_id = $this->input->get('modulo');
        $this->load->model('mSubModulos');
        foreach($this->mSubModulos->mreadXid($modulo_id) as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->smNome,
                    "smNome"=>$row->smNome,
                    "smCodigo"=>$row->smCodigo
            );
        }
            $total = count($al);
            $data = json_encode($al);
            $response = $data;
            echo $response;
    }

    public function read(){
        $modulo_num = $this->input->get('modulo');
        $usuario = $this->input->get('usuario');
        $this->load->model('mSubModulos');
        //determinar totales
        $this->load->model('mutilizadores');
        $totalUsuarios = $this->mutilizadores->totalUsuarios();
        $this->load->model('mniveis');
        $totalNiveis = $this->mniveis->totalNiveis();
        $this->load->model('mpaises');
        $totalPaises = $this->mpaises->totalPaises();
        $this->load->model('mferias');
        $totalFerias = $this->mferias->totalFerias();
        $this->load->model('mfuncionarios');
        $totalFuncionarios = $this->mfuncionarios->totalFuncionarios();
        $this->load->model('mautorizacao_saida');
        $totalSaidas = $this->mautorizacao_saida->totalSaidas();
        $this->load->model('mLicencas');
        $totalLicencas = $this->mLicencas->totalLicencas();
        $this->load->model('mEm_Formacao_Funcionarios');
        $totalEmFormacao = $this->mEm_Formacao_Funcionarios->total();
        $this->load->model('mFormacao_Funcionarios');
        $totalFormacao_Funcionarios = $this->mFormacao_Funcionarios->total();
        $this->load->model('mOutras_Formacoes');
        $totalOutras_Formacoes = $this->mOutras_Formacoes->total();
        $this->load->model('mPublicacoes');
        $totalPublicacoes = $this->mPublicacoes->total();
        $this->load->model('mEventos');
        $totalEventos = $this->mEventos->total();
        $this->load->model('mLinguas_Funcionarios');
        $totalLinguas_Funcionarios = $this->mLinguas_Funcionarios->total();
        
        //foreach($this->mSubModulos->mread($modulo_num) as $row){
        foreach($this->mSubModulos->mgetAccess($modulo_num,$usuario)as $row){
            if($row->smCodigo == "0101"){
                $total = $totalUsuarios;
            }else if($row->smCodigo == "0102"){ 
                $total = $totalNiveis;
            }else if($row->smCodigo == "0103"){
                $total = $totalPaises;
            }else if($row->smCodigo == "0201"){
                $total = $totalFuncionarios;
            }else if($row->smCodigo == "0202"){
                $total = $totalFerias;
            }else if($row->smCodigo == "0203"){
                $total = $totalSaidas;
            }else if($row->smCodigo == "0204"){
                $total = $totalLicencas;
            }else if($row->smCodigo == "0207"){
                $total = $totalEmFormacao;
            }else if($row->smCodigo == "0208"){
                $total = $totalFormacao_Funcionarios;
            }else if($row->smCodigo == "0211"){
                $total = $totalOutras_Formacoes;
            }else if($row->smCodigo == "0209"){
                $total = $totalPublicacoes;
            }else if($row->smCodigo == "0210"){
                $total = $totalEventos;
            }else if($row->smCodigo == "0212"){
                $total = $totalLinguas_Funcionarios;
            }
            else{
                $total = 0;
            }
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->smNome,
                    "smNome"=>$row->smNome,
                    "smCodigo"=>$row->smCodigo,
                    "badge"=>  $total
            ); 
        }
            $total = count($al);
            //$x = (object)$al;
            $data = json_encode($al);
            $response = $data;
        
        echo $response;
    }
    public function readAll(){
        $this->load->model('mSubModulos');
        foreach($this->mSubModulos->mreadAll() as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->smNome,
                    "smNome"=>$row->smNome,
                    "smCodigo"=>$row->smCodigo,
                    //"badge"=>  $total
            ); 
        }
        $total = count($al);
        //$x = (object)$al;
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
/*
    public function getID() {
        $naNome = $this->input->post('naNome');
        $this->load->model('mNiveisAcesso');
        echo $this->mNiveisAcesso->getID($naNome);
    }
    public function update(){                       
            $id = $this->input->post('id');
            $naNome = $this->input->post('naNome');
            $naDescricao = $this->input->post('naDescricao');
            $this->load->model('mNiveisAcesso');
            if($this->mNiveisAcesso->mupdate($id,$naNome,$naDescricao))
                echo "true"; 
            else
               echo "false";
    }
    public function insert(){
           $naNome = $this->input->post('naNome');
           $naDescricao = $this->input->post('naDescricao');
            
           $this->load->model('mNiveisAcesso');
           if($this->mNiveisAcesso->minsert($naNome,$naDescricao))
               echo "true";
           else
               echo "false";
            
        }
 * 
 */
}
?>