<?php
class CAcademica_Inscricao_2_sessao extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readX(){
        $request = $_GET;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $Nota_Minima = @$request["Nota_Minima"];
        $this->load->model('MAcademica_Inscricao_2_sessao');
        echo json_encode($this->MAcademica_Inscricao_2_sessao->mreadX($alAno,$nNome,$cNome,$pNome,$Nota_Minima));
    }
    //mreadXatribuidos
    public function readXatribuidos(){
        $request = $_GET;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $this->load->model('MAcademica_Inscricao_2_sessao');
        echo json_encode($this->MAcademica_Inscricao_2_sessao->mreadXatribuidos($alAno,$nNome,$cNome,$pNome));
    }

    public function atribuir(){
        $request = $_POST;
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $Nota_Minima = @$request["Nota_Minima"];
        $this->load->model('MAcademica_Inscricao_2_sessao');
        if($this->MAcademica_Inscricao_2_sessao->matribuir($alAno,$nNome,$cNome,$pNome,$Nota_Minima))
            echo "true";
        else
            echo "false";
    }
}