<?php
class CHorarios extends CI_Controller {
    
    public function read(){
        //$al = array();
        $al = $this->input->get('alAno');
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $s = $this->input->get('sNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('acNome');
        $t = $this->input->get('tNome');
        $ses = $this->input->get('sesNome');
        
        $this->load->model('mDisciplinas');
        $this->load->model('mHorarios');
        foreach($this->mHorarios->mreadX($al,$n,$c,$s,$p,$ac,$t,$ses) as $row){
            $f2d = $this->mDisciplinas->mreadX($row->f2);
            $f3d = $this->mDisciplinas->mreadX($row->f3);
            $f4d = $this->mDisciplinas->mreadX($row->f4);
            $f5d = $this->mDisciplinas->mreadX($row->f5);
            $f6d = $this->mDisciplinas->mreadX($row->f6);
            
            $adata[] = array(
                "id"=>$row->id,
                "taNome"=>$row->taNome,
                "temposaulas_id"=>$row->temposaulas_id,
                "f2"=>($f2d)?$f2d:"-",
                "f3"=>($f3d)?$f3d:"-",
                "f4"=>($f4d)?$f4d:"-",
                "f5"=>($f5d)?$f5d:"-",
                "f6"=>($f6d)?$f6d:"-",
            );
            
        }
        //$total = count($al);
        $data = json_encode($adata);
        $response = $data;
        echo $response;
    }
    public function Iniciar_Apagar(){
        $al = $this->input->post('alAno');
        $n = $this->input->post('nNome');
        $c = $this->input->post('cNome');
        $s = $this->input->post('sNome');
        $p = $this->input->post('pNome');
        $ac = $this->input->post('acNome');
        $t = $this->input->post('tNome');
        $ses = $this->input->post('sesNome');
        
        //saber cuantos tiempos tiene la session selecionada
        $this->load->model("mSessao");
        //$NumTempos = $this->mSessao->taXses($ses);
        //apagar records
        $this->load->model('mHorarios');
        $this->mHorarios->mdelete($t);
        //insertar una entrada con disc bacia por cada tiempo
        // $j dias de la semana y $i tiempos de aulas
        $contador = 0;
        //for($j = 1; $j <= 5; $j++){
            //for($i = 1; $i <= $NumTempos; $i++){
            foreach ($this->mSessao->taXses($ses) as $value) {
                if($this->mHorarios->minsert($al,$n,$c,$s,$p,$ac,$t,$ses,$value->id,'')){
                    $contador++;
                }
            }
        //}
        if($contador > 0)
            echo "true";
        else
            echo "false";
    }
    //para obtener el id de un record de horario
    public function GetID() {
        //$al, $n, $c, $s, $p, $ac, $t, $ses,$ta
        $al = $this->input->get('alAno');
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        $s = $this->input->get('sNome');
        $p = $this->input->get('pNome');
        $ac = $this->input->get('acNome');
        $t = $this->input->get('tNome');
        $ses = $this->input->get('sesNome');
        $ta = $this->input->get('ta');
        $this->load->model('mHorarios');
        echo $this->mHorarios->mGetID($al, $n, $c, $s, $p, $ac, $t, $ses,$ta);
    }
    //teste temporal
    
    public function getIDnc(){
        $n = $this->input->get('nNome');
        $c = $this->input->get('cNome');
        
        $this->load->model('mHorarios');
        echo $this->mHorarios->getIDnc($n,$c);
    }
    //para precedencia 1
    public function readP1(){
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread() as $row){
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
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread() as $row){
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
        $this->load->model('mDisciplinas_Precedencias');
        foreach($this->mDisciplinas_Precedencias->mread() as $row){
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
            //$id = $this->input->post('id');
        $al = $this->input->post('alAno');
        $n = $this->input->post('nNome');
        $c = $this->input->post('cNome');
        $s = $this->input->post('sNome');
        $p = $this->input->post('pNome');
        $ac = $this->input->post('acNome');
        $t = $this->input->post('tNome');
        $ses = $this->input->post('sesNome');
        
        $daNome = $this->input->post('daNome');
        $taNome = $this->input->post('taNome');
        $dNome = $this->input->post('dNome');
            
        $this->load->model('mHorarios');
        //echo $al.','.$n.','.$c.','.$s.','.$p.','.$ac.','.$t.','.$ses.','.$daNome.','.$taNome.','.$dNome;
        if($this->mHorarios->mupdate($al,$n,$c,$s,$p,$ac,$t,$ses,$daNome,$taNome,$dNome))
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