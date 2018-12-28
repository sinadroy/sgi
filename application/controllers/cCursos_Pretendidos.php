<?php
class CCursos_Pretendidos extends CI_Controller {
    
    public function read(){
        $request = $_GET;
        $al = @$request['ano'];
        if($al)
            $al = $al;
        else
            $al = date('Y');
        $i = $request['i'];
        $l = $request['l'];
        $this->load->model('MCursos_Pretendidos');
        echo json_encode($this->MCursos_Pretendidos->mread($al,$i,$l));
    }
    public function read_search(){
        $request = $_GET;
        $al = $request['ano'];
        $i = $request['i'];
        $l = $request['l'];
        $x = $request['x'];
        $this->load->model('MCursos_Pretendidos');
        echo json_encode($this->MCursos_Pretendidos->mread_search($al,$i,$l,$x));
    }
    //verificar si ya existe un registro igual para este usuario
    public function Existe(){
        $request = $_POST;
        $cBI_Passaporte = $request['bi'];
        $nNome = $request['nNome'];
        $cNome = $request['cNome'];
        $pNome = $request['pNome'];
        $this->load->model('MCursos_Pretendidos');
        if($this->MCursos_Pretendidos->Existe($cBI_Passaporte, $nNome, $cNome, $pNome))
            echo "true";
        else
            echo "false";
    }

    /*
        Para Financas/Inscricao pagamentos de Inscricao
    */
    public function read_ncpXid(){
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MCursos_Pretendidos');
        echo json_encode($this->MCursos_Pretendidos->mread_ncpXid());
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        //$cNome = $request['cNome'];
        //$cApelido = $request['cApelido'];
        $cBI_Passaporte = @$request['bi'];
        $nNome = @$request['nNome'];
        $cNome = @$request['cNome'];
        $pNome = @$request['pNome'];
        $cp_ano_lec_insc = date('Y');
        $usuario = @$request['usuario'];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAuditorias_Academicas');
        $this->load->model('MCursos_Pretendidos');
        if ($webix_operation == "insert"){
            if($this->MCursos_Pretendidos->minsert($cBI_Passaporte,$nNome,$cNome,$pNome, $cp_ano_lec_insc)){
                $this->MAuditorias_Academicas->minsert("Atribuir:Curso Pretendido","Academica","Inscrição",$usuario,"BI:".$cBI_Passaporte.', n&iacute;vel: '.$nNome.', curso: '.$cNome.', per&iacute;odo: '.$pNome);
                echo "true";
            }else
                echo "false";
        } else if ($webix_operation == "update"){
            $request = $_GET;
                if($this->MCursos_Pretendidos->mupdate($id,$cBI_Passaporte,$nNome,$cNome,$pNome)){
                    $this->MAuditorias_Academicas->minsert("Actualizar:Curso Pretendido","Academica","Inscrição",$usuario,"BI:".$cBI_Passaporte.', n&iacute;vel: '.$nNome.', curso: '.$cNome.', per&iacute;odo: '.$pNome);
                    echo "true"; 
                }else
                    echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MCursos_Pretendidos->mdelete($id)){
                $this->MAuditorias_Academicas->minsert("Apagar:Curso Pretendido","Academica","Inscrição",$usuario,"BI:".$cBI_Passaporte.', n&iacute;vel: '.$nNome.', curso: '.$cNome.', per&iacute;odo: '.$pNome);
                echo "true"; 
            }
            else
               echo "false";
        } else 
            echo "false";
    }

    //salvar la foto que se tira en funcionarios
    public function salvarFoto(){
        //id del funcionario selecionado
        $id = $this->input->get('id');
        $foto_codigo = md5(time()).rand(383,1000);
        //upload photo
        $estado = false;
        if(move_uploaded_file($_FILES['webcam']['tmp_name'], 'Fotos/Candidatos/'.$foto_codigo.'.jpg')){
            $estado = true;
        }
        //salvar codigo en la BD
        $this->load->model('mCandidatos');
        if($estado == true && $this->mCandidatos->msalvarFoto($id,$foto_codigo))
        {
            echo "true";
        }
    }
    //cargar el codigo de la foto guardada para mostrar foto
    public function cargarFoto() {
        $id = $this->input->post('id');
        $this->load->model('mCandidatos');
        echo $this->mCandidatos->mcargarFoto($id);
    }
    public function cargarFotoCB() {
        $id = $this->input->post('id');
        $this->load->model('mCandidatos');
        echo $this->mCandidatos->mcargarFotoCB($id);
    }
}