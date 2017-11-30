<?php
header('Content-Type: text/html; charset=UTF-8');
class CAcademica_Resultados_Exame_Acesso_2S extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function readNome(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadNome($nivel_acesso,$cb);
    }
    public function readNomes(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadNomes($nivel_acesso,$cb);
    }
    public function readApelido(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadApelido($nivel_acesso,$cb);
    }
    public function readBI(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadBI($nivel_acesso,$cb);
    }
    public function readNivel(){
        $request = $_POST;
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadNivel($cb);
    }
    public function readCurso(){
        $request = $_POST;
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadCurso($cb);
    }
    public function readPeriodo(){
        $request = $_POST;
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadPeriodo($cb);
    }
    public function readTurma(){
        $request = $_POST;
        $nivel_acesso = $request["nivel_acesso"];
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadTurma($nivel_acesso,$cb);
    }
    //mreadNota
    public function readNota(){
        $request = $_POST;
        $cb = $request["cb"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        echo $this->MAcademica_Resultados_Exame_Acesso_2S->mreadNota($cb);
    }

    public function crud(){
        $request = $_POST;
        $cb = @$request['cb'];
        $apecNota = $request["apecNota"];
        $user_sessao = $request["user_sessao"];

        $na = $request["na"];
        
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Resultados_Exame_Acesso_2S');
        
        if ($webix_operation == "update"){
            if($this->MAcademica_Resultados_Exame_Acesso_2S->mupdate($cb,$apecNota,$user_sessao,$na))
                echo "true"; 
            else
                echo "false";
        }
    }
}