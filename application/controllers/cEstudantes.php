<?php
class CEstudantes extends CI_Controller {
	
	public function read() {
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mread());
	}

	public function readX() {
		$request = $_POST;
		$id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mreadX($id);
	}

	public function get_idXbi() {
		$request = $_POST;
		$bi = $request['bi'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mget_idXbi($bi);
	}
	public function read_numero_universitario() {
		$request = $_POST;
		$ide = $request['ide'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mread_numero_universitario($ide);
	}

	//mread_mat_financas
	public function read_mat_financas() {
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mread_mat_financas());
	}

	public function read_conf_mat_financas() {
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mread_conf_mat_financas());
	}

	//
	public function readXturma() {
		$request = $_GET;
		$n = $request['n'];
		$c = $request['c'];
		$p = $request['p'];
		$ac = $request['ac'];
		$t = $request['t'];
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mreadXturma($n,$c,$p,$ac,$t));
	}

	public function readXturma2() {
		$request = $_GET;
		$n = $request['n'];
		$c = $request['c'];
		$p = $request['p'];
		$ac = $request['ac'];
		$t = $request['t'];
		$s = $request['s'];
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mreadXturma2($n,$c,$p,$ac,$t,$s));
	}

	public function read_est_disc() {
		$request = $_GET;
		$n = $request['n'];
		$c = $request['c'];
		$p = $request['p'];
		$ac = $request['ac'];
		$t = $request['t'];
		$this->load->model('MEstudantes');
		echo json_encode($this->MEstudantes->mread_est_disc($n,$c,$p,$ac,$t));
	}

	//mreadXano_curricular($id)
	public function readXano_curricular() {
		$request = $_POST;
		$id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mreadXano_curricular($id);
	}
	public function readXano_curricular_id() {
		$request = $_POST;
		$id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mreadXano_curricular_id($id);
	}
	public function readXsemestre() {
		$request = $_POST;
		$id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mreadXsemestre($id);
	}

	public function teste() {
		$this->load->model('MDisciplinas');
		foreach($this->MDisciplinas->mreadXancp(1,1,5,1) as $value){
			echo $value->id;
		}
	}

	public function Get_NivelXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_NivelXCandidato_id($Candidatos_id);
	}
	public function Get_Nivel_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_Nivel_NomeXCandidato_id($Candidatos_id);
	}

	public function Get_CursoXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_CursoXCandidato_id($Candidatos_id);
	}
	public function Get_Curso_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_Curso_NomeXCandidato_id($Candidatos_id);
	}

	//Get_PeriodoXCandidato_id
	public function Get_PeriodoXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_PeriodoXCandidato_id($Candidatos_id);
	}
	public function Get_Periodo_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_Periodo_NomeXCandidato_id($Candidatos_id);
	}
	public function Get_PeriodoXEstudante_id(){
		$request = $_POST;
		$bi = $request['bi'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_PeriodoXEstudante_id($bi);
	}

	public function Get_ACXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_ACXCandidato_id($Candidatos_id);
	}
	public function Get_AC_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_AC_NomeXCandidato_id($Candidatos_id);
	}

	public function Get_TurmaXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_TurmaXCandidato_id($Candidatos_id);
	}
	public function Get_Turma_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_Turma_NomeXCandidato_id($Candidatos_id);
	}

	public function Get_SemestreXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_SemestreXCandidato_id($Candidatos_id);
	}

	public function Get_Semestre_NomeXCandidato_id(){
		$request = $_POST;
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		echo $this->MEstudantes->mGet_Semestre_NomeXCandidato_id($Candidatos_id);
	}

	public function Existe() {
		$request = $_POST; 
		$Candidatos_id = $request['id'];
		$this->load->model('MEstudantes');
		if($this->MEstudantes->Existe($Candidatos_id))
			echo "true";
		else
			echo "false";
	}
	
	public function insert_matricula(){
		$request = $_POST; 
		//$id = @$request['id'];
		$Candidatos_id = $request['Candidatos_id'];
		$n = $request['nNome'];
		$c = $request['cNome'];
		$p = $request['pNome'];
		$turmas_id = $request['turma_id'];
		
		$this->load->model('MEstudantes');
		if($this->MEstudantes->minsert_matricula($Candidatos_id,$n,$c,$p,$turmas_id))
		{
			echo "true";
		}else
			echo "false";
	}

	public function insert_tranferencia(){
		$request = $_POST;
		$Candidatos_id = @$request['Candidatos_id'];
		$n = @$request['nNome'];
		$c = @$request['cNome'];
		$p = @$request['pNome'];

		$ac = @$request['acNome'];
		$s = @$request['sNome'];
		$t = @$request['tNome'];
		
		$this->load->model('MEstudantes');
		if($this->MEstudantes->minsert($Candidatos_id,$n,$c,$p,$ac,$s,$t))
		{
			//insert estudante

			echo "true";
		}else
			echo "false";
	}

	//para tranferir um estudante de um semestre para o proximo
	public function tranferir_estudante(){
		$request = $_POST;
		$id = @$request['id'];
		$ac = @$request['acNome'];
		$s = @$request['sNome'];
		$user = @$request['user'];
		$bi = @$request['bi'];
		$td = @$request['td'];
		$this->load->model('MAuditorias_Academicas');
		$this->load->model('MEstudantes');
		if($id && $ac && $s && $td){
			if($this->MEstudantes->mtranferir_estudante($id,$ac,$s,$td))
			{
				$this->MAuditorias_Academicas->minsert("Tranferir:Estudante","Academica","Estudantes/Disciplinas",$user,"Estudante BI: ".$bi." tranferido de semestre ".$s." para ".($s+1)." para turma id: "+ $td+" Actualizado com sucesso");
				echo "true";
			}else
				echo "false";
		}else
			echo "false";
		
	}
	public function voltar_estudante(){
		$request = $_POST;
		$id = @$request['id'];
		$ac = @$request['acNome'];
		$s = @$request['sNome'];
		$user = @$request['user'];
		$bi = @$request['bi'];
		$td = @$request['td'];
		$this->load->model('MAuditorias_Academicas');
		$this->load->model('MEstudantes');
		
		if($id && $ac && $s && $td) {
			if($this->MEstudantes->mvoltar_estudante($id,$ac,$s,$td))
			{
				$this->MAuditorias_Academicas->minsert("Voltar:Estudante","Academica","Estudantes/Disciplinas",$user,"Estudante BI: ".$bi." tranferido de semestre ".$s." para ".($s-1)." Actualizado com sucesso");
				echo "true";
			} else
				echo "false";
		} else
			echo "false";
	}
	
	public function crud(){
		
		$request = $_POST; 
		$id = @$request['id'];
		$Candidatos_id = @$request['Candidatos_id'];
		$n = @$request['nNome'];
		$c = @$request['cNome'];
		$p = @$request['pNome'];

		$ac = @$request['acNome'];
		$s = @$request['sNome'];
		$t = @$request['tNome'];
		//
		$webix_operation = $request["webix_operation"];
		
		$this->load->model('MEstudantes');
		//$this->load->model('MCandidatos');
		
		if($webix_operation == "insert"){
			
			if($this->MEstudantes->minsert($Candidatos_id,$n,$c,$p,$ac,$s,$t))
			{
					echo "true";
			}else
				echo "false";
			
		}else if ($webix_operation == "update"){
			
			if($this->MEstudantes->mupdate($id,$Candidatos_id,$n,$c,$p,$ac,$s,$t))
				echo "true";
			else
				echo "false";
		}
		else if ($webix_operation == "delete"){
			
			if($this->MEstudantes->mdelete($id))
				echo "true";
			else
				echo "false";
		}
		else 
			echo "false";
		
	}
	
}
