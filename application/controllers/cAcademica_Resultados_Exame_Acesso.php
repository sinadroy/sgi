<?php
header('Content-Type: text/html; charset=UTF-8');
class CAcademica_Resultados_Exame_Acesso extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readNome(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        //$c = $request["cNome"];
        //$p = $request["pNome"];
        //$s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadNome($nivel_acesso,$cb/*,$c,$p,$s*/);
    }
    public function readNomes(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        //$c = $request["cNome"];
        //$p = $request["pNome"];
        //$s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadNomes($nivel_acesso,$cb/*,$c,$p,$s*/);
    }
    public function readApelido(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadApelido($nivel_acesso,$cb/*,$c,$p,$s*/);
    }
    public function readBI(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadBI($nivel_acesso,$cb/*,$c,$p,$s*/);
    }
    public function readNivel(){
        $request = $_POST;
        $cb = $request["cb"];
        //$cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadNivel($cb/*,$c,$p,$s*/);
    }
    public function readCurso(){
        $request = $_POST;
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadCurso($cb/*,$c,$p,$s*/);
    }
    public function readPeriodo(){
        $request = $_POST;
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadPeriodo($cb/*,$c,$p,$s*/);
    }
    public function readTurma(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadTurma($nivel_acesso,$cb/*,$c,$p,$s*/);
    }
    //mreadNota
    public function readNota(){
        $request = $_POST;
        $cb = $request["cb"];
        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        echo $this->MAcademica_Resultados_Exame_Acesso->mreadNota($cb/*,$c,$p,$s*/);
    }

    public function crud(){
        $request = $_POST;
        $cb = @$request['cb'];
        $apecNota = $request["apecNota"];
        $user_sessao = $request["user_sessao"];
        $bi = $request["bi"];

        // $c = $request["cNome"];
        // $p = $request["pNome"];
        // $s = $request["atcNome"];

        $na = $request["na"];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso');
        
        if ($webix_operation == "update"){
            if($this->MAcademica_Resultados_Exame_Acesso->mupdate($cb,$apecNota,$user_sessao,$bi,$na))
                echo "true"; 
            else
                echo "false";
        }
    }
}