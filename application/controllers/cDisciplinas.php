<?php

class CDisciplinas extends CI_Controller {

    public function read_dpto(){
        $dpto = $this->input->get('dpto');
        $this->load->model('mDisciplinas');
		echo json_encode($this->mDisciplinas->mread_dpto($dpto));
    }
    
    public function readXduracao(){
        $cod = $this->input->get('dCodigo');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mreadXduracao($cod);
    }
    public function read_duracao_x_id(){
        $id = $this->input->post('id');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_duracao_x_id($id);
    }

    public function read_codigo(){
        $idd = $this->input->post('idd');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_codigo($idd);
    }

    public function readX() {
		$request = $_POST;
		$id = $request['id'];
		$this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mreadX($id);
	}

    public function read_ano_lectivo(){
        $idd = $this->input->post('idd');
        $idp = $this->input->post('idp');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_ano_lectivo($idp,$idd);
    }
    public function read_nivel(){
        $idd = $this->input->post('idd');
        $idp = $this->input->post('idp');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_nivel($idp,$idd);
    }
    public function read_curso(){
        $idd = $this->input->post('idd');
        $idp = $this->input->post('idp');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_curso($idp,$idd);
    }
    public function read_periodo(){
        $idd = $this->input->post('idd');
        $idp = $this->input->post('idp');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_periodo($idp,$idd);
    }
    public function read_ano_curricular(){
        $idd = $this->input->post('idd');
        $idp = $this->input->post('idp');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mread_ano_curricular($idp,$idd);
    }
    //


    public function readXancp(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('acNome');
        $this->load->model('mDisciplinas');
		echo json_encode($this->mDisciplinas->mreadXancp($ac,$n,$c,$p));
    }
    public function readX_ac_n_c_p(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('acNome');
        $this->load->model('mDisciplinas');
		echo json_encode($this->mDisciplinas->mreadX_ac_n_c_p($ac,$n,$c,$p));
    }

    public function readX_ac_n_c_p_g(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('acNome');
        $g = $this->input->get('dgNome');
        $this->load->model('mDisciplinas');
		echo json_encode($this->mDisciplinas->mreadX_ac_n_c_p_g($ac,$n,$c,$p,$g));
    }

    public function read() {
        $ord=1;
        $this->load->model('mDisciplinas_Ano_Curricular');
        $this->load->model('mSemestres');
        $this->load->model('mDisciplinas');
        $this->load->model('mDisciplinas_Geracao');
        foreach ($this->mDisciplinas->mread() as $row) {
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->id);
            $acId = $this->mDisciplinas_Ano_Curricular->mGetAnoIdC($row->id);
            $sNome = $this->mSemestres->mGetSem($row->id);
            $sId = $this->mSemestres->mGetIdSem($row->id);
            $d_geracao_id = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->id);
            $dgnome = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id);
            $al[] = array(
                "ord" => $ord,
                "id" => $row->id,
                "value" => $row->dNome,
                "dNome" => $row->dNome,
                "dCodigo" => $row->dCodigo,
                "dDescricao" => $row->dDescricao,
                "dNotaMaxima" => $row->dNotaMaxima,
                "dNotaMinima" => $row->dNotaMinima,
                "dCredito" => $row->dCredito,
                "dQuantidadesHoras" => $row->dQuantidadesHoras,
                "dEstado" => $row->dEstado,
                "Classificacao_id" => $row->Classificacao_id,
                "clNome" => $row->clNome,
                "Disciplinas_Duracao_id" => $row->Disciplinas_Duracao_id,
                //"Disciplinas_Duracao_id" => $row->Disciplinas_Duracao_id,
                "ddNome" => $row->ddNome,
                "nid" => $row->nid,
                "nNome" => $row->nNome,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "pid" => $row->pid,
                "pNome" => $row->pNome,
                "acNome" => ($acNome) ? $acNome : "-",
                "acId" => ($acNome) ? $acId : "-",
                "sNome" => ($sNome) ? $sNome : "-",
                "sId" => ($sNome) ? $sId : "-",
                "d_geracao_id" => $d_geracao_id,
                "dgnome" => $dgnome 
            );
            $ord++;
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function read_existem_precedencias() {
        $idd = $this->input->post('idd');
        $this->load->model('mdisciplinas');
        if($this->mdisciplinas->mread_existe_precedencia1($idd) || $this->mdisciplinas->mread_existe_precedencia2($idd) ||$this->mdisciplinas->mread_existe_precedencia3($idd))
            echo "true";
        else
            echo "false";
    }

    public function readXnome(){
        $dnome = $this->input->post('dnome');
        $this->load->model('mDisciplinas');
		echo $this->mDisciplinas->mreadXnome($dnome);
    }

    public function readXac() {
        //$n,$c,$p,$ac,$t
        $n = $this->input->post('nNome');
        $c = $this->input->post('cNome');
        $p = $this->input->post('pNome');
        $ac = $this->input->post('acNome');
        $t = $this->input->post('tNome');
        $this->load->model('mDisciplinas');
        foreach ($this->mDisciplinas->mreadXac($n, $c, $p, $ac, $t) as $row) {
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->id);
            $sNome = $this->mSemestres->mGetSem($row->id);
            $al[] = array(
                "id" => $row->id,
                "value" => $row->dNome,
                "dNome" => $row->dNome,
                "dCodigo" => $row->dCodigo,
                "dDescricao" => $row->dDescricao,
                "dNotaMaxima" => $row->dNotaMaxima,
                "dNotaMinima" => $row->dNotaMinima,
                "dCredito" => $row->dCredito,
                "dQuantidadesHoras" => $row->dQuantidadesHoras,
                "dEstado" => $row->dEstado,
                "Classificacao_id" => $row->Classificacao_id,
                "clNome" => $row->clNome,
                "Disciplinas_Duracao_id" => $row->Disciplinas_Duracao_id,
                "ddNome" => $row->ddNome,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "acNome" => ($acNome) ? $acNome : "-",
                "sNome" => ($sNome) ? $sNome : "-"
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    /*
     * obj: para leer solo las disciplinas de un anho semestre 
     * en el combo disciplinas/planificacao.
     */

    public function readXacncps(){
        $ac = $this->input->get('acNome');
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $s = $this->input->get('sNome');

        $this->load->model('mDisciplinas');
        $this->load->model('mDisciplinas_Ano_Curricular');
        $this->load->model('mSemestres');
        foreach ($this->mDisciplinas->mreadXacncps($ac, $n, $c, $p, $s) as $row) {
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->id);
            $sNome = $this->mSemestres->mGetSem($row->id);
            $al[] = array(
                "id" => $row->id,
                "value" => $row->dNome,
                "dNome" => $row->dNome,
                "dCodigo" => $row->dCodigo,
                "dDescricao" => $row->dDescricao,
                "dNotaMaxima" => $row->dNotaMaxima,
                "dNotaMinima" => $row->dNotaMinima,
                "dCredito" => $row->dCredito,
                "dQuantidadesHoras" => $row->dQuantidadesHoras,
                "dEstado" => $row->dEstado,
                "Classificacao_id" => $row->Classificacao_id,
                "clNome" => $row->clNome,
                "Disciplinas_Duracao_id" => $row->Disciplinas_Duracao_id,
                "ddNome" => $row->ddNome,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "acNome" => ($acNome) ? $acNome : "-",
                "sNome" => ($sNome) ? $sNome : "-"
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function update() {
        $id = $this->input->post('id');
        $nNome = $this->input->post('nNome');       $cNome = $this->input->post('cNome');
        $pNome = $this->input->post('pNome');       $dNome = $this->input->post('dNome');
        $dCodigo = $this->input->post('dCodigo');   $clNome = $this->input->post('clNome');
        $ddNome = $this->input->post('ddNome');     $acNome = $this->input->post('acNome');
        $sNome = $this->input->post('sNome');       $dDescricao = $this->input->post('dDescricao');
        $dNotaMinima = $this->input->post('dNotaMinima'); $dNotaMaxima = $this->input->post('dNotaMaxima');
        $dQuantidadesHoras = $this->input->post('dQuantidadesHoras');   $dCredito = $this->input->post('dCredito');
        $dEstado = $this->input->post('dEstado');   $dgnome = $this->input->post('dgnome');
        
        $this->load->model('mDisciplinas');
        if ($this->mDisciplinas->mupdate($id, $nNome, $cNome, $pNome, $dNome, $dCodigo, $clNome, $ddNome,$dDescricao, 
            $dNotaMinima, $dNotaMaxima, $dQuantidadesHoras, $dCredito, $dEstado, $dgnome)) {
            $this->load->model('mDisciplinas_Ano_Curricular');
            $this->load->model('mDisciplinas_Semestres');
            if ($this->mDisciplinas_Ano_Curricular->mupdate($id, $acNome)) {
                
                if($ddNome == "Anual" || $ddNome == '1')
                    $this->db->delete('disciplinas_semestres', array('Disciplinas_id' => $id));
                else{
                    $this->load->model('MDisciplinas_Semestres');
                    //ver si existe entrada para disciplina_semestre
                    $existe = $this->MDisciplinas_Semestres->mexiste($id);
                    //insert en disciplina_semestre el idd y el ids
                    if($existe)
                        $this->MDisciplinas_Semestres->mupdate($id, $sNome);
                    else
                       $this->MDisciplinas_Semestres->minsert($id, $sNome);
                }

                echo "true";
            } else
                echo "false";
        } else
            echo "false";
    }

    public function insert() {
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $pNome = $this->input->post('pNome');
        $dNome = $this->input->post('dNome');
        $dCodigo = $this->input->post('dCodigo');
        $dDescricao = $this->input->post('dDescricao');
        $dNotaMaxima = $this->input->post('dNotaMaxima');
        $dNotaMinima = $this->input->post('dNotaMinima');
        $dCredito = $this->input->post('dCredito');
        $dQuantidadesHoras = $this->input->post('dQuantidadesHoras');
        $dEstado = $this->input->post('dEstado');
        $clNome = $this->input->post('clNome');
        $ddNome = $this->input->post('ddNome');
        $sNome = $this->input->post('sNome');
        $acNome = $this->input->post('acNome');
        $dgnome = $this->input->post('dgnome');

        $this->load->model('mDisciplinas');
        $this->load->model('MDisciplinas_Ano_Curricular');
        $this->load->model('MDisciplinas_Semestres');
        //$this->load->model('mProfessores_Disciplinas');
        if ($this->mDisciplinas->minsert($nNome, $cNome, $pNome, $dNome, $dCodigo, $dDescricao, $dNotaMaxima, $dNotaMinima, $dCredito, $dQuantidadesHoras, $dEstado, $clNome, $ddNome, $dgnome)) {
            //insertar disciplinas_id en la tabla Professores_Disciplinas
            //$Disciplinas_id = $this->mDisciplinas->mGetID($dNome);
            //$this->mProfessores_Disciplinas->minsertPD($Disciplinas_id);
            //si es anual necesito solo del ano curricular
            if ($ddNome == "1") {
                $Disciplinas_id = $this->mDisciplinas->mGetID($dNome);
                $Ano_Curricular_id = $acNome;
                if ($this->MDisciplinas_Ano_Curricular->minsert($Disciplinas_id, $Ano_Curricular_id)) {
                    echo "true";
                }
            } elseif ($ddNome == "2") { //si es semestrar necesito de Ano_Curricular_id y semestres_id
                $Disciplinas_id = $this->mDisciplinas->mGetID($dNome);
                $Ano_Curricular_id = $acNome;
                $Semestres_id = $sNome;
                if ($this->MDisciplinas_Ano_Curricular->minsert($Disciplinas_id, $Ano_Curricular_id) && $this->MDisciplinas_Semestres->minsert($Disciplinas_id, $Semestres_id)) {
                    echo "true";
                }
            } elseif ($ddNome == "3") {
                echo "true";
            }
        } else {
            echo "false";
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id !== "") {
            $this->load->model('mDisciplinas');
            if ($this->mDisciplinas->mdelete($id))
                echo "true";
            else
                echo "false";
        }
    }

    //temporal
    public function getNCID() {
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $this->load->model('mDisciplinas');
        echo $this->mDisciplinas->getIDNiveis_Cursos($n, $c, $p);
    }

}
