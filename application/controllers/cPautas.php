<?php
class CPautas extends CI_Controller {
    
    public function read(){
        $ord = 1;
        $this->load->model('mpautas');
        foreach($this->mpautas->mread() as $row){
            $al[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "did" => $row->did,
                "dNome" => $row->dNome,
				"pp1" => $row->pp1,
				"pp2" => $row->pp2,
				"pp3" => $row->pp3,
				"ef" => $row->ef,
				"recurso" => $row->recurso,
				"especial" => $row->especial,
				"estado" => $row->estado,
			);
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function readXdisciplina(){
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $al = $this->input->get('al');
        $d = $this->input->get('d');
        $g = $this->input->get('g');
        $ord = 1;
        //$arr = array();
        $this->load->model('mpautas');
        foreach($this->mpautas->mreadXdisciplina($n,$c,$p,$al,$d,$g) as $row){
            $arr[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "did" => $row->did,
                "dNome" => $row->dNome,
				"pp1" => $row->pp1,
				"pp2" => $row->pp2,
				"pp3" => $row->pp3,
				"ef" => $row->ef,
				"recurso" => $row->recurso,
				"especial" => $row->especial,
				"estado" => $row->estado,
			);
            $ord++;
        }
        $data = json_encode($arr);
        $response = $data;
        echo $response;
    }

    public function readXdisciplina_login_pautas(){
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $al = $this->input->get('al');
        $d = $this->input->get('d');
        
        //ver duracao disciplina
		$this->load->model('Mdisciplinas_Duracao');
        $td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXid($d);
        //echo 'Duracion:'.$td.'</br>';
        //ver geracao de la disciplina
        $this->load->model('Mdisciplinas_geracao');
        $d_geracao_id = $this->Mdisciplinas_geracao->mGetGeracaoXidd($d);
        //echo 'geracao_id:'.$d_geracao_id.'</br>';
        //porciento ef
        $this->load->model('mpautas_configuracao');
        $pc_pp1 = $this->mpautas_configuracao->mGet_Porcento_pp1($d_geracao_id, $td);
        //echo 'pc_pp1:'.$pc_pp1.'</br>';
        $pc_pp2 = $this->mpautas_configuracao->mGet_Porcento_pp2($d_geracao_id, $td);
        //echo 'pc_pp2:'.$pc_pp2.'</br>';
        $pc_pp3 = $this->mpautas_configuracao->mGet_Porcento_pp3($d_geracao_id, $td);
        //echo 'pc_pp3:'.$pc_pp3.'</br>';
        $pc_ef = $this->mpautas_configuracao->mGet_Porcento_ef($d_geracao_id, $td);
        //echo 'pc_ef:'.$pc_ef.'</br>';


        $ord = 1;
        //$arr = array();
        $this->load->model('mpautas');
        foreach($this->mpautas->mreadXdisciplina_login_pautas($n,$c,$p,$al,$d) as $row){
            //mp
            if($td == "Anual")
                $mp = ($row->pp1 + $row->pp2 + $row->pp3)/3;
            elseif($td == "Semestral")
                $mp = ($row->pp1+$row->pp2)/2;
            
            $parte_pp1 = $this->mpautas->calcula_porciento($row->pp1, $pc_pp1);
		    $parte_pp2 = $this->mpautas->calcula_porciento($row->pp2, $pc_pp2);
		    $parte_pp3 = $this->mpautas->calcula_porciento($row->pp3, $pc_pp3);
		    $pc60 = $parte_pp1+$parte_pp2+$parte_pp3;
            //mf
            $parte_ef = $this->mpautas->calcula_porciento($row->ef, $pc_ef);
		    $mf = $pc60 + $parte_ef;  

            $arr[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "did" => $row->did,
                "dNome" => $row->dNome,
				"pp1" => $row->pp1,1,
				"pp2" => $row->pp2,1,
				"pp3" => $row->pp3,1,
                "mp" => round($mp,2),
				"ef" => $row->ef,
                "mf" => round($mf,1),
				"recurso" => $row->recurso,
				"especial" => $row->especial,
				"estado" => $row->estado,
			);
            $ord++;
        }
        $data = json_encode($arr);
        $response = $data;
        echo $response;
    }

    public function existe_est() {
        $bi = $this->input->post('bi');
        $idd = $this->input->post('idd');
        $this->load->model('mpautas');
        if($this->mpautas->mexiste_est($bi,$idd))
            echo "true";
        else
            echo "false";
    }
    public function calcula_porciento() {
        $total = $this->input->get('total');
        $pc = $this->input->get('pc');
        $this->load->model('mpautas');
        echo $this->mpautas->calcula_porciento($total, $pc);
    }
    
    public function read_estado_est_disc() {
        $ide = $this->input->post('ide');
        $idd = $this->input->post('idd');
        $this->load->model('mpautas');
        $retorno = $this->mpautas->mread_estado_est_disc($ide,$idd);
        if($retorno == "Reprovado" || $retorno == "" || is_null($retorno))
            echo "Reprovado";
        else
            echo "Aprovado";
        
        //echo $this->mpautas->mread_estado_est_disc($ide,$idd);
    }
    
    /*
    public function update(){                       
            $id = $this->input->post('id');
            $paNome = $this->input->post('paNome');
            $paCodigo = $this->input->post('paCodigo');
            $this->load->model('mpaises');
            if($this->mpaises->mupdate($id,$paNome,$paCodigo))
                echo "true"; 
            else
               echo "false";
    }
     */
     public function insert_inicializar(){
        //$ano_actual = date('Y');
        $ano_actual = $this->input->post('al');
        $this->load->model('MAnos_Lectivos');
        $Anos_Lectivos_id = $this->MAnos_Lectivos->mGetID($ano_actual);//$this->input->post('Anos_Lectivos_id');
        $Estudantes_id = $this->input->post('Estudantes_id');
        $Disciplinas_id = $this->input->post('Disciplinas_id');
        $pp1 = 0;//$this->input->post('pp1');
        $pp2 = 0;//$this->input->post('pp2');
        $pp3 = 0;//$this->input->post('pp3');
        $ef = 0;//$this->input->post('ef');
        $recurso = 0;//$this->input->post('recurso');
        $especial = 0;//$this->input->post('especial');
        $estado = "Reprovado";//$this->input->post('estado');
        $this->load->model('mpautas');
        if($this->mpautas->minsert($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado))
           echo "true";
        else
           echo "false";    
    }

    public function insert(){
        //$Anos_Lectivos_id = $this->input->post('Anos_Lectivos_id');
        $Estudantes_id = $this->input->post('Estudantes_id');
        $Disciplinas_id = $this->input->post('Disciplinas_id');
        $pp1 = $this->input->post('pp1');
        $pp2 = $this->input->post('pp2');
        $pp3 = $this->input->post('pp3');
        $ef = $this->input->post('ef');
        $recurso = $this->input->post('recurso');
        $especial = $this->input->post('especial');
        $estado = $this->input->post('estado');
        $this->load->model('mpaises');
        if($this->mpaises->minsert($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado))
           echo "true";
        else
           echo "false";    
    }
   /* public function insert_inicializar(){
        $ano_actual = date('Y');
        $this->load->model('MAnos_Lectivos');
        $Anos_Lectivos_id = $this->MAnos_Lectivos->mGetID($ano_actual);//$this->input->post('Anos_Lectivos_id');
        $Estudantes_id = $this->input->post('Estudantes_id');
        $Disciplinas_id = $this->input->post('Disciplinas_id');
        $pp1 = 0;//$this->input->post('pp1');
        $pp2 = 0;//$this->input->post('pp2');
        $pp3 = 0;//$this->input->post('pp3');
        $ef = 0;//$this->input->post('ef');
        $recurso = 0;//$this->input->post('recurso');
        $especial = 0;//$this->input->post('especial');
        $estado = "Reprovado";//$this->input->post('estado');
        $this->load->model('mpautas');
        if($this->mpautas->minsert($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado))
           echo "true";
        else
           echo "false";    
    }
    */
    public function cancelar_matricula_disciplina(){
        $ide = $this->input->post('ide');
        $idd = $this->input->post('idd');
        if($ide && $idd)
        {
            $this->load->model('mpautas');
            if($this->mpautas->mcancelar_matricula_disciplina($ide,$idd))
                echo "true"; 
            else
               echo "false";           
        }
    }

    /*
    *******Actualizar pp1
    * 1- ver si existe el est en la pauta para esa disciplina, sinao o chefe de dpto tem que activar esa disc.
    * 2- Registrar em auditorias.
    */
    public function update_pp1(){
        $ide = $this->input->post('ide');
        $idd = $this->input->post('idd');
        if($ide && $idd)
        {
            $this->load->model('mpautas');
            if($this->mpautas->mupdate_pp1($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1))
                echo "true"; 
            else
               echo "false";           
        }
    }

    public function update(){
        $id = $this->input->post('id');
        $idd = $this->input->post('idd');
        $pp1 = $this->input->post('pp1');
        $pp2 = $this->input->post('pp2');
        $pp3 = $this->input->post('pp3');
        $ef = $this->input->post('ef');
        $recurso = $this->input->post('recurso');
        $especial = $this->input->post('especial');
        //$estado = $this->input->post('estado');
        $usuario = $this->input->post('usuario');
        $dnome = $this->input->post('dnome');
        $enome = $this->input->post('enome');

        $this->load->model('mpautas');
        $this->load->model('Mdisciplinas_geracao');
        $this->load->model('Mdisciplinas_Duracao');
        
        $pp1_old = $this->mpautas->mread_valor_actual($id,'pp1',$pp1);
        //echo $pp1_old.'<br>';
        $pp2_old = $this->mpautas->mread_valor_actual($id,'pp2',$pp2);
        $pp3_old = $this->mpautas->mread_valor_actual($id,'pp3',$pp3);
        $ef_old = $this->mpautas->mread_valor_actual($id,'ef',$ef);
        $recurso_old = $this->mpautas->mread_valor_actual($id,'recurso',$recurso);
        $especial_old = $this->mpautas->mread_valor_actual($id,'especial',$especial);
        //para controlar que los profes no actualicen las notas
        //if($pp1_old && $pp2_old && $pp3_old && $ef_old && $recurso_old && $especial_old){
            //ver geracao de la disciplina
            $d_geracao_id = $this->Mdisciplinas_geracao->mGetGeracaoXidd($idd);
            //ver duracao disciplina
            $td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXid($idd);
            $estado = $this->mpautas->mdeterminar_estado($d_geracao_id,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial);
            if($this->mpautas->mupdate($id,$pp1,$pp2,$pp3,$ef,$recurso,$especial,$estado,$usuario,$dnome,$enome))
                echo "true"; 
            else
                echo "false";
        //}else
          //  echo "false";
    }
}
?>