<?php
class CDisciplinas_Precedencias extends CI_Controller {
    
    public function read(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('ac');
        $ord = 1;
        $this->load->model('mDisciplinas_Precedencias');
        $this->load->model('mDisciplinas_Ano_Curricular');
        $this->load->model('mDisciplinas_Geracao');
        foreach($this->mDisciplinas_Precedencias->mread($n,$c,$p,$ac) as $row){
            $acNome = $this->mDisciplinas_Ano_Curricular->mGetAnoC($row->id);
            $dPrecedencia1 = ($row->dPrecedencia1_id != "" || $row->dPrecedencia1_id != NULL || $row->dPrecedencia1_id != "0")?$this->mDisciplinas_Precedencias->mreadX($row->dPrecedencia1_id):"-";
            $dPrecedencia2 = ($row->dPrecedencia2_id != "" || $row->dPrecedencia2_id != null || $row->dPrecedencia2_id != "0")?$this->mDisciplinas_Precedencias->mreadX($row->dPrecedencia2_id):"-";
            $dPrecedencia3 = ($row->dPrecedencia3_id != "" || $row->dPrecedencia2_id != NULL || $row->dPrecedencia3_id != "0")?$this->mDisciplinas_Precedencias->mreadX($row->dPrecedencia3_id):"-";

            $d_geracao_id = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->id);
            $dgnome = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id);
            //p1
            $d_geracao_id_p1 = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->dPrecedencia1_id);
            $dgnome_p1 = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id_p1);
            //p2
            $d_geracao_id_p2 = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->dPrecedencia2_id);
            $dgnome_p2 = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id_p2);
            //p3
            $d_geracao_id_p3 = $this->mDisciplinas_Geracao->mGetGeracaoXidd($row->dPrecedencia3_id);
            $dgnome_p3 = $this->mDisciplinas_Geracao->mGetNomeXid($d_geracao_id_p3);

            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "nid"=>$row->nid,
                "nNome"=>$row->nNome,
                "cid"=>$row->cid,
                "cNome"=>$row->cNome,
                "pid"=>$row->pid,
                "pNome"=>$row->pNome,
                "acNome"=>($acNome)?$acNome:"-",
                "acId" => $row->Ano_Curricular_id,
                "dNome"=>$row->dNome,
                "dCodigo"=>$row->dCodigo,
                "dPrecedencia1_id"=>$row->dPrecedencia1_id,
                "dPrecedencia1"=>($dPrecedencia1)?$dPrecedencia1:"-",
                "dPrecedencia2_id"=>$row->dPrecedencia2_id,
                "dPrecedencia2"=>($dPrecedencia2)?$dPrecedencia2:"-",
                "dPrecedencia3_id"=>$row->dPrecedencia3_id,
                "dPrecedencia3"=>($dPrecedencia3)?$dPrecedencia3:"-",
                "d_geracao_id" => $d_geracao_id,
                "dgnome" => $dgnome,
                //p1
                "d_geracao_id_p1" => $d_geracao_id_p1,
                "dgnome_p1" => $dgnome_p1,
                //p2
                "d_geracao_id_p2" => $d_geracao_id_p2,
                "dgnome_p2" => $dgnome_p2,
                //p3
                "d_geracao_id_p3" => $d_geracao_id_p3,
                "dgnome_p3" => $dgnome_p3,
            ); 
            $ord++;
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('dNome');
        $this->load->model('mDisciplinas_Precedencias');
        echo $this->mDisciplinas_Precedencias->mGetID($Nome);
    }
    
    //para precedencia 1
    public function readP1(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('ac');
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread_on($n,$c,$p,$ac) as $row){
            $al[] = array(
                "id"=>$row->id,
                "dPrecedencia1"=>$row->dNome,
                "value"=>$row->dNome,
                "dCodigo"=>$row->dCodigo
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //para precedencia 2
    public function readP2(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('ac');
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread_on($n,$c,$p,$ac) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->dNome,
                "dPrecedencia2"=>$row->dNome,
                "dCodigo"=>$row->dCodigo
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    //para precedencia 3
    public function readP3(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('ac');
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread_on($n,$c,$p,$ac) as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->dNome,
                "dPrecedencia3"=>$row->dNome,
                "dCodigo"=>$row->dCodigo
            ); 
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function update(){                       
            $id = $this->input->post('id');
            //$nNome = $this->input->post('nNome');
            //$cNome = $this->input->post('cNome');
            //$pNome = $this->input->post('pNome');
            $dNome = $this->input->post('dNome');
            //$dCodigo = $this->input->post('dCodigo');
            $dPrecedencia1 = $this->input->post('dPrecedencia1');
            $dPrecedencia2 = $this->input->post('dPrecedencia2');
            $dPrecedencia3 = $this->input->post('dPrecedencia3');
            
            $this->load->model('mDisciplinas_Precedencias');
            if($this->mDisciplinas_Precedencias->mupdate($id,$dPrecedencia1,$dPrecedencia2,$dPrecedencia3))
                echo "true"; 
            else
               echo "false";
    }
     
    public function insert(){
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
            
        $this->load->model('mDisciplinas');
        $this->load->model('MDisciplinas_Ano_Curricular');
        $this->load->model('MDisciplinas_Semestres');
        if($this->mDisciplinas->minsert($nNome,$cNome,$pNome,$dNome,$dCodigo,$dDescricao,$dNotaMaxima,$dNotaMinima,$dCredito,
                    $dQuantidadesHoras,$dEstado,$clNome,$ddNome))
        {
           //si es anual necesito solo del ano curricular
           if($ddNome == "1")
           {
               $Disciplinas_id = $this->mDisciplinas->mGetID($dNome);
               $Ano_Curricular_id = $acNome;
               if($this->MDisciplinas_Ano_Curricular->minsert($Disciplinas_id,$Ano_Curricular_id))
               {
                 echo "true";
               }
           }elseif($ddNome == "2"){ //si es semestrar necesito de Ano_Curricular_id y semestres_id
               $Disciplinas_id = $this->mDisciplinas->mGetID($dNome);
               $Ano_Curricular_id = $acNome;
               $Semestres_id = $sNome;
               if($this->MDisciplinas_Ano_Curricular->minsert($Disciplinas_id,$Ano_Curricular_id) && $this->MDisciplinas_Semestres->minsert($Disciplinas_id,$Semestres_id))
               {
                 echo "true";
               }
           }elseif($ddNome == "3"){
               echo "true";
           }
        }
        else{
           echo "false";
        }
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mDisciplinas_Precedencias');
            if($this->mDisciplinas_Precedencias->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
    //temporal
    public function getNCID(){
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $this->load->model('mDisciplinas');
        echo $this->mDisciplinas->getIDNiveis_Cursos($n,$c,$p);
    }
     
}