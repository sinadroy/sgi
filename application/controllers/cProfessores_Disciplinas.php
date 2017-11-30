<?php
class CProfessores_Disciplinas extends CI_Controller {
    
    public function read(){
        $this->load->model('mDisciplinas_Ano_Curricular');
        $this->load->model('mSemestres');
        $this->load->model('mProfessores_Disciplinas');
        foreach($this->mProfessores_Disciplinas->mread() as $row){
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->disciplinas_id);
            $sNome = $this->mSemestres->mGetSem($row->disciplinas_id);
            $ProfessorPP = $this->mProfessores_Disciplinas->mreadX($row->ProfessorP_id);
            $ProfessorA1 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA1_id);
            $ProfessorA2 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA2_id);
            $al[] = array(
                "id"=>$row->id,
                "alAno"=>$row->alAno,
                "nNome"=>$row->nNome,
                "cNome"=>$row->cNome,
                "pNome"=>$row->pNome,
                "acNome"=>($acNome)?$acNome:"-",
                "sNome"=>($sNome)?$sNome:"-",
                "tNome"=>$row->tNome,
                "disciplinas_id"=>$row->disciplinas_id,
                "dNome"=>$row->dNome,
                "dCodigo"=>$row->dCodigo,
                "ProfessorP_id"=>$row->ProfessorP_id,
                "ProfessorP"=>($ProfessorPP)?$ProfessorPP:"-",
                "ProfessorA1_id"=>$row->ProfessorA1_id,
                "ProfessorA1"=>($ProfessorA1)?$ProfessorA1:"-",
                "ProfessorA2_id"=>$row->ProfessorA2_id,
                "ProfessorA2"=>($ProfessorA2)?$ProfessorA2:"-",
                "anos_lectivos_id"=>$row->anos_lectivos_id
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //para segunda tabla de horarios la de abajo
    public function readXncpact(){
        $nNome = $this->input->get('nNome');
        $cNome = $this->input->get('cNome');
        $pNome = $this->input->get('pNome');
        $acNome = $this->input->get('acNome');
        $tNome = $this->input->get('tNome');
        
        $this->load->model('mDisciplinas_Ano_Curricular');
        $this->load->model('mSemestres');
        $this->load->model('mProfessores_Disciplinas');
        foreach($this->mProfessores_Disciplinas->mreadXncpact($nNome, $cNome, $pNome, $acNome, $tNome) as $row){
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->disciplinas_id);
            $sNome = $this->mSemestres->mGetSem($row->disciplinas_id);
            $ProfessorPP = $this->mProfessores_Disciplinas->mreadX($row->ProfessorP_id);
            $ProfessorA1 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA1_id);
            $ProfessorA2 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA2_id);
            $al[] = array(
                "id"=>$row->id,
                //"alAno"=>$row->alAno,
                "nNome"=>$row->nNome,
                "cNome"=>$row->cNome,
                "pNome"=>$row->pNome,
                "acNome"=>($acNome)?$acNome:"-",
                "sNome"=>($sNome)?$sNome:"-",
                "tNome"=>$row->tNome,
                "disciplinas_id"=>$row->disciplinas_id,
                "dNome"=>$row->dNome,
                "dCodigo"=>$row->dCodigo,
                "ProfessorP_id"=>$row->ProfessorP_id,
                "ProfessorP"=>($ProfessorPP)?$ProfessorPP:"-",
                "ProfessorA1_id"=>$row->ProfessorA1_id,
                "ProfessorA1"=>($ProfessorA1)?$ProfessorA1:"-",
                "ProfessorA2_id"=>$row->ProfessorA2_id,
                "ProfessorA2"=>($ProfessorA2)?$ProfessorA2:"-",
                "dQuantidadesHoras"=>$row->dQuantidadesHoras,
                "dQuantidadesHorasXsemanas"=>$row->dQuantidadesHoras/15
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_DiscXProf(){
        $id_prof = $this->input->get('id');
        $this->load->model('mProfessores_Disciplinas');
        $al = array();
        foreach($this->mProfessores_Disciplinas->mread_DiscXProf($id_prof) as $row){
            $al[] = array(
                "id"=>$row->id,
                "dNome"=>$row->dNome,
                "value"=>$row->dNome,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //leer profesor Principal
    public function readPP(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDP() as $row){
            $al[] = array(
                "id"=>$row->id,
                "ProfessorP"=>$row->fNome.' '.$row->fApelido,
                "value"=>$row->fNome.' '.$row->fApelido,
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //leer profesor Assistente 1
    public function readPA1(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDP() as $row){
            $al[] = array(
                "id"=>$row->id,
                "ProfessorA1"=>$row->fNome.' '.$row->fApelido,
                "value"=>$row->fNome.' '.$row->fApelido
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //leer profesor Assistente 2
    public function readPA2(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDP() as $row){
            $al[] = array(
                "id"=>$row->id,
                "ProfessorA2"=>$row->fNome.' '.$row->fApelido,
                "value"=>$row->fNome.' '.$row->fApelido
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    function get_primero_ultimo_nome($nome) {
        $SP = explode(" ", $nome);
        $npos = count($SP);
        if ($npos > 2) {
            $fNome = $SP[0];
            $fApelido = $SP[2];
        } else {
            $fNome = $SP[0];
            $fApelido = $SP[$npos - 1];
        }
        $result = array("fNome"=>$fNome,"fApelido"=>$fApelido);
        return $result;
    }
    
    public function GetID() {
        $Nome = $this->input->post('nome');
        $aPP = $this->get_primero_ultimo_nome($Nome);
        $this->load->model('mProfessores_Disciplinas');
        //echo $aPP['fNome'].':'.$aPP['fApelido'];
        echo $this->mProfessores_Disciplinas->mGetID($aPP['fNome'],$aPP['fApelido']);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        
        $alAno = $this->input->post('alAno');
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $pNome = $this->input->post('pNome');
        
        $tNome = $this->input->post('tNome');
        $dNome = $this->input->post('dNome');
        $ProfessorP = $this->input->post('ProfessorP');
        $ProfessorA1 = $this->input->post('ProfessorA1');
        $ProfessorA2 = $this->input->post('ProfessorA2');
        
        //$aPP = get_primero_ultimo_nome($ProfessorP);
        //$aPA1 = get_primero_ultimo_nome($ProfessorA1);
        //$aPA2 = get_primero_ultimo_nome($ProfessorA2);
        
        $this->load->model('mProfessores_Disciplinas');
        if($this->mProfessores_Disciplinas->mupdate($id,$alAno,$nNome,$cNome,$pNome,$tNome,$dNome,
                $ProfessorP,$ProfessorA1,$ProfessorA2))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $alAno = $this->input->post('alAno');
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $pNome = $this->input->post('pNome');
        $tNome = $this->input->post('tNome');
        $dNome = $this->input->post('dNome');
        $ProfessorP = $this->input->post('ProfessorP');
        $ProfessorA1 = $this->input->post('ProfessorA1');
        $ProfessorA2 = $this->input->post('ProfessorA2');
        
        $this->load->model('mProfessores_Disciplinas');
        if($this->mProfessores_Disciplinas->minsert($alAno, $nNome,$cNome,$pNome,$tNome,$dNome,
                $ProfessorP,$ProfessorA1,$ProfessorA2))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mProfessores_Disciplinas');
            if($this->mProfessores_Disciplinas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>