<?php
class CAcademica_Planificacao_Exame_Candidatos_2S extends CI_Controller {
    /*
        para cargar la grid de distribuicao
    */
    public function read(){
        $this->load->model('manos_lectivos');
        $alAct = $this->manos_lectivos->mGetID(date('Y'));
        $al = $this->input->get('al');
        $al = ($al)?$al:$alAct;
        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo json_encode($this->MAcademica_Planificacao_Exame_Candidatos_2S->mread($al));
    }
    /*
        para cargar las listas por salas
    */
    public function read22(){
        $request = $_GET;
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];
        $apeiData = $request["apeiData"];
        $apeiHora = $request["apeiHora"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo json_encode($this->MAcademica_Planificacao_Exame_Candidatos_2S->mread22($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora));
    }
  /*  public function read(){
        $request = $_GET;
        //$id = @$request['id'];
        $alAno = @$request["alAno"];
        $nNome = @$request["nNome"];
        $cNome = @$request["cNome"];
        $pNome = @$request["pNome"];
        $atcNome = @$request["atcNome"];
        $this->load->model('MAcademica_Planificacao_Exame_Candidatos');
        echo json_encode($this->MAcademica_Planificacao_Exame_Candidatos->mread($alAno,$nNome,$cNome,$pNome,$atcNome));
    }
*/
    public function readDatasPlanificadasXancpt(){
        $request = $_GET;
        //$id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo json_encode($this->MAcademica_Planificacao_Exame_Candidatos_2S->mreadDatasPlanificadasXancpt($alAno,$nNome,$cNome,$pNome,$atcNome));
    }

    public function readHorasPlanificadasXancpt(){
        $request = $_GET;
        //$id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo json_encode($this->MAcademica_Planificacao_Exame_Candidatos_2S->mreadHorasPlanificadasXancpt($alAno,$nNome,$cNome,$pNome,$atcNome));
    }

    public function totalCandidatosXNiveisCursosPeriodo(){
        $request = $_POST;
        //$id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo $this->MAcademica_Planificacao_Exame_Candidatos_2S->mtotalCandidatosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome);
        //json_encode($this->MAcademica_Planificacao_Exame_Candidatos->mreadHorasPlanificadasXancpt($alAno,$nNome,$cNome,$pNome,$atcNome));
    }

    public function totalCandidatosColocadosXNiveisCursosPeriodo(){
        $request = $_POST;
        //$id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];
        $apeiData = $request["apeiData"];
        $apeiHora = $request["apeiHora"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo $this->MAcademica_Planificacao_Exame_Candidatos_2S->mtotalCandidatosColocadosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora);
    }
    public function teste(){
        //$request = $_POST;
        //$id = @$request['id'];
        $alAno = 1;
        $nNome = 1;
        $cNome = 2;
        $pNome = 1;
        $atcNome = 11;
        $apeiData = "2016-11-09";
        $apeiHora = "12:10:00";
        //capacidade_turma:5
        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo $this->MAcademica_Planificacao_Exame_Candidatos_2S->mtotalCandidatosColocadosXNiveisCursosPeriodo($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora);
        /*if($this->MAcademica_Planificacao_Exame_Candidatos->mDeterminarSeCandidatoColocadoXid($alAno,$nNome,$cNome,$pNome,2))
            echo true;
        else
            echo false;
        */
        //echo $this->MAcademica_Planificacao_Exame_Candidatos->mtotalCandidatosColocadosGeral($alAno,$nNome,$cNome,$pNome);
       /* $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso');
        echo $this->MAcademica_Planificacao_Exame_Ingreso->mreadX($alAno,$niveis_cursos_id,$atcNome,$apeiData,$apeiHora);
        */
    }
    //mtotalCandidatosNaoColocadosGeral($alAno,$nNome,$cNome,$pNome)
    public function totalCandidatosNaoColocadosGeral(){
        $request = $_POST;
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        echo $this->MAcademica_Planificacao_Exame_Candidatos_2S->mtotalCandidatosNaoColocadosGeral($alAno,$nNome,$cNome,$pNome);
    }

    public function atrinuirCandidatosTurma(){
        $request = $_POST;
        //$id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];
        $apeiData = $request["apeiData"];
        $apeiHora = $request["apeiHora"];
        $capacidade_turma = $request["capacidade_turma"];

        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        if($this->MAcademica_Planificacao_Exame_Candidatos_2S->mAtrinuirCandidatosTurma($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora,$capacidade_turma))
            echo "true";
        else
            echo "false";
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $alAno = $request["alAno"];
        $nNome = $request["nNome"];
        $cNome = $request["cNome"];
        $pNome = $request["pNome"];
        $atcNome = $request["atcNome"];
        $apeiData = $request["apeiData"];
        $apeiHora = $request["apeiHora"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAcademica_Planificacao_Exame_Ingreso_2S');

        if ($webix_operation == "insert"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->mupdate($id,$alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MAcademica_Planificacao_Exame_Ingreso_2S->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}