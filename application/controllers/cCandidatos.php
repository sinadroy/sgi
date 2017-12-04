<?php
class CCandidatos extends CI_Controller {
	
	public function apagar_nao_matriculados(){
		$this->load->model('MCandidatos');
		$this->MCandidatos->no_matriculados();
		echo "duplicados apagados com succeso";
	}

	public function calculaEdad() {
		
		$dataN = $this->input->post('dataN');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->calculaEdad($dataN);
		
	}
	
	public function Get_telXCandidato_id() {
		
		$Nome = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mGet_telXCandidato_id($Nome);
		
	}
	
	public function Get_emailXCandidato_id() {
		
		$Nome = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mGet_emailXCandidato_id($Nome);
		
	}
	
	public function read_total(){
		$this->load->model('MCandidatos');
		echo $this->MCandidatos->mread_total();
	}

	public function readto_Excel(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadto_Excel());
		
	}

	public function readDP(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDP($al,$i,$l));
		
	}

	public function readDP_search(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		$x = $this->input->get('x');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDP_search($al,$i,$l,$x));
		
	}

	public function readDPE(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDPE());
		
	}
	
	public function readDPRO(){
		
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDPRO($al,$i,$l));
		
	}

	public function readDPRO_search(){
		
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		$x = $this->input->get('x');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDPRO_search($al,$i,$l,$x));
		
	}

	public function readDPROE(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDPROE());
		
	}
	
	public function readDACA(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDACA($al,$i,$l));
		
	}

	public function readDACA_search(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		$x = $this->input->get('x');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDACA_search($al,$i,$l,$x));
		
	}

	public function readDACAE(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDACAE());
		
	}
	
	public function readDLOC(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDLOC($al,$i,$l));
		
	}

	public function readDLOC_search(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		$x = $this->input->get('x');

		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDLOC_search($al,$i,$l,$x));
		
	}

	public function readDLOCE(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDLOCE());
		
	}
	
	public function readDInscricao(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDInscricao($al,$i,$l));
		
	}

	public function readDInscricao_search(){
		$al = ($this->input->get('ano'))?$this->input->get('ano'):date('Y');
		$i = $this->input->get('i');
		$l = $this->input->get('l');
		$x = $this->input->get('x');
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDInscricao_search($al,$i,$l,$x));
		
	}

	public function readDInscricao_Financas(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDInscricao_Financas());
		
	}
	
	public function readDInscricaoEspPag(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDInscricaoEspPag());
		
	}
	
	public function readNomeXID() {
		
		$id = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadNomeXID($id);
		
	}
	
	public function readApelidoXID(){
		
		$id = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadApelidoXID($id);
		
	}
	
	public function readBI(){
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadBI());
		
	}
	
	public function readDInscricaoXncp(){
		
		$request = $_GET;
		
		$n = @$request['nNome'];
		
		$c = @$request['cNome'];
		
		$p = @$request['pNome'];

		$al = @$request['alAno'];
		
		$this->load->model('MCandidatos');
		
		echo json_encode($this->MCandidatos->mreadDInscricaoXncp($n,$c,$p,$al));
		
	}
	
	public function readNomeCompletoXID(){
		
		$id = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadNomeCompletoXID($id);
		
	}
	
	public function readNomeCompletoXcb(){
		
		$cb = $this->input->post('cb');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadNomeCompletoXCB($cb);
		
	}
	
	//m	readBIxID
	public function readBIxID(){
		
		$id = $this->input->post('id');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadBIxID($id);
		
	}
	
	public function readBIxCB(){
		
		$cb = $this->input->post('cb');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadBIxCB($cb);
		
	}
	
	public function readIDxCB(){
		
		$cb = $this->input->post('cb');
		
		$this->load->model('MCandidatos');
		
		echo $this->MCandidatos->mreadIDxCB($cb);
		
	}
	
	//p	ara financas
	public function readIDxBI(){
		
		$bi = $this->input->post('bi');
		
		$this->load->model('MCandidatos');
		
		//$existe_bi = $this->MCandidatos->mreadIDxBICount($bi);
		$existe_bi = $this->MCandidatos->mExiste_BI($bi);
		
		if($existe_bi){
			
			$retorno = $this->MCandidatos->mreadIDxBI($bi);
			
			echo $retorno;
		}
		else
			echo "false";
		
		
	}
	//ver sis ya existe este BI en la BD
	public function Existe_BI() {
		$bi = $this->input->post('bi');
		$this->load->model('MCandidatos');
		if($this->MCandidatos->mExiste_BI($bi))
			echo "true";
		else
			echo "false";
	}
	
	public function readIDxCodigo_Barra(){
		
		$bi = $this->input->post('cb');
		
		$this->load->model('MCandidatos');
		
		$existe_bi = $this->MCandidatos->mreadIDxCodigo_Barra_Count($bi);
		
		if($existe_bi > 0){
			
			$retorno = $this->MCandidatos->mreadIDxCodigo_Barra($bi);
			
			echo $retorno;
			
		}
		else
		echo "false";
		
		
	}
	
	public function crud_tranferencia(){
		
		$request = $_POST; 
		$id = @$request['id'];
		$cNome = $request['cNome'];
		$cNomes = $request['cNomes'];
		$cApelido = $request['cApelido'];
		$gNome = $request['gNome'];
		$ngNome = $request['ngNome'];
		$cNome_Pai = $request['cNome_Pai'];
		$cNome_Mae = $request['cNome_Mae'];
		$cBI_Passaporte = $request['cBI_Passaporte'];
		$cBI_Data_Emissao = $request['cBI_Data_Emissao'];
		$cBI_Lugar_Emissao_Provincia_id = $request['provEmissao'];
		$ecNome = $request['ecNome'];
		$cData_Nascimento = $request['cData_Nascimento'];
		$Nascimento_Provincias_id = $request['provNascimento'];
		$Nascimento_Municipios_id = $request['munNascimento'];
		$Necessita_Educacao_Especial_id = $request['neeNome'];
		//profissionais
		$trabNome = @$request['trabNome'];
		$proNome = @$request['proNome'];
		$tilNome = @$request['tilNome'];
		$dlLocal_Trabalho = @$request['dlLocal_Trabalho'];
		$otNome = @$request['otNome'];
		$dlCargo = @$request['dlCargo'];
		//academicos
		$Formacao_Pais_id = @$request['paFormacao'];
		$Formacao_Provincias_id = @$request['provFormacao'];
		$hlfNome = @$request['hlfNome'];
		$Opcao = @$request['Opcao'];
		$Media = @$request['Media'];
		$Escola = @$request['efNome'];
		$Ano = @$request['Ano'];
		//localizacao
		$cTelefone = $request['cTelefone'];
		$cEmail = $request['cEmail'];
		$Pais_id = $request['paNome'];
		$Provincias_id = $request['provNome'];
		$Municipios_id = $request['munNome'];
		$Bairros_id = $request['baiNome'];
		//outros dados
		$Ano_actual_id = $request['ano'];
		//utilizadores
		$usuario = $request['usuario'];

		//ano lectivo de ingreso
		$alIngreso = $request['alIngreso'];

		//webix_operation
		$webix_operation = $request["webix_operation"];
		//dados matricula
		$n = $request['nNome'];
		$c = $request['curso'];
		$p = $request['pNome'];
		$ac = $request['acNome'];
		$s = $request['sNome'];
		$t = $request['tNome'];

		$this->load->model('MAuditorias_Academicas');
		$this->load->model('MCandidatos');
		if($webix_operation == "insert"){
			if($this->MCandidatos->minsert($cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
			$ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id,
			//dados profissionais
			$trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo,
			//dados academicos
			$Formacao_Pais_id, $Formacao_Provincias_id, $hlfNome, $Opcao, $Media, $Escola, $Ano,
			//dados localizacao
			$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id, $Ano_actual_id,
			//usuario
			$usuario))
			{
				//determinar id por BI
				$existe_bi = $this->MCandidatos->mreadIDxBICount($cBI_Passaporte);
				if($existe_bi > 0){
					$Candidatos_id = $this->MCandidatos->mreadIDxBI($cBI_Passaporte);
					//adicionar estudante
					$this->load->model('MEstudantes');
					if($this->MEstudantes->minsert($Candidatos_id,$n,$c,$p,$ac,$s,$t))
						echo "true";
				}
					
			}else
				echo "false";
		}
		else if ($webix_operation == "update"){
			
			$dp = "true";
			
			$dpro = "true";
			
			$daca = "true";
			
			$dloc = "true";
			
			if($this->MCandidatos->mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
			$ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id))
			$dp = "true";
			
			else
			$dp = "false";
			
			if($this->MCandidatos->mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo))
			$dpro = "true";
			
			else
			$dpro = "false";
			
			if($this->MCandidatos->mupdateDACA($id,$Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola,$Ano))
			$daca = "true";
			
			else
			$daca = "false";
			
			if($this->MCandidatos->mupdateDLOC($id,$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id))
			$dloc = "true";
			
			else
			$dloc = "false";
			
			if($dp == "true" && $dpro == "true" && $daca == "true" && $dloc == "true")
			{
				
				//r				egistrar log
				$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Actualizado com sucesso');
				
				echo "true";
				
			}
			else{
				
				$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Erro actualizado dados');
				
				echo "false";
				
			}
			
			
			/* $request = $_GET;             $tipo_update = @$request['tu'];            if($tipo_update == "DP"){                if($this->MCandidatos->mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,                                            $ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id))                    echo "true";                 else                    echo "false";                }elseif($tipo_update == "DPRO"){                if($this->MCandidatos->mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo))                    echo "true";                 else                    echo "false";              }elseif($tipo_update == "DACA"){                if($this->MCandidatos->mupdateDACA($id,$Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola,$Ano))                    echo "true";                 else                    echo "false";              }elseif($tipo_update == "DLOC"){                if($this->MCandidatos->mupdateDLOC($id,$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id))                    echo "true";                 else                    echo "false";              } */
			
		}
		else if ($webix_operation == "delete"){
			
			if($this->MCandidatos->mdelete($id)){
				
				$this->MAuditorias_Academicas->minsert("Apagar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Apagado com sucesso');
				
				echo "true";
				
			}
			
			else{
				
				$this->MAuditorias_Academicas->minsert("Apagar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Erro apagando dados');
				
				echo "false";
				
			}
			
		}
		else 
		echo "false";
		
	}
	
	public function crud(){
		
		$request = $_POST; 
		$id = @$request['id'];
		$cNome = $request['cNome'];
		$cNomes = $request['cNomes'];
		$cApelido = $request['cApelido'];
		$gNome = $request['gNome'];
		$ngNome = $request['ngNome'];
		$cNome_Pai = $request['cNome_Pai'];
		$cNome_Mae = $request['cNome_Mae'];
		$cBI_Passaporte = $request['cBI_Passaporte'];
		$cBI_Data_Emissao = $request['cBI_Data_Emissao'];
		$cBI_Lugar_Emissao_Provincia_id = $request['provEmissao'];
		$ecNome = $request['ecNome'];
		$cData_Nascimento = $request['cData_Nascimento'];
		$Nascimento_Provincias_id = $request['provNascimento'];
		$Nascimento_Municipios_id = $request['munNascimento'];
		$Necessita_Educacao_Especial_id = $request['neeNome'];
		//profissionais
		$trabNome = @$request['trabNome'];
		$proNome = @$request['proNome'];
		$tilNome = @$request['tilNome'];
		$dlLocal_Trabalho = @$request['dlLocal_Trabalho'];
		$otNome = @$request['otNome'];
		$dlCargo = @$request['dlCargo'];
		//academicos
		$Formacao_Pais_id = @$request['paFormacao'];
		$Formacao_Provincias_id = @$request['provFormacao'];
		$hlfNome = @$request['hlfNome'];
		$Opcao = @$request['Opcao'];
		$Media = @$request['Media'];
		$Escola = @$request['efNome'];
		$Ano = @$request['Ano'];
		//localizacao
		$cTelefone = $request['cTelefone'];
		$cEmail = $request['cEmail'];
		$Pais_id = $request['paNome'];
		$Provincias_id = $request['provNome'];
		$Municipios_id = $request['munNome'];
		$Bairros_id = $request['baiNome'];
		//outros dados
		$this->load->model('manos_lectivos');
		$Ano_actual_id = $this->manos_lectivos->mGetID(date('Y'));//$request['ano'];
		//utilizadores
		$usuario = $request['usuario'];
		//webix_operation
		$webix_operation = $request["webix_operation"];
		
		$this->load->model('MAuditorias_Academicas');
		$this->load->model('MCandidatos');
		if($webix_operation == "insert"){
			if($this->MCandidatos->minsert($cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
			$ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id,
			//dados profissionais
			$trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo,
			//dados academicos
			$Formacao_Pais_id, $Formacao_Provincias_id, $hlfNome, $Opcao, $Media, $Escola, $Ano,
			//dados localizacao
			$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id, $Ano_actual_id,
			//usuario
			$usuario))
			{
				
				echo "true";
				
			}
			
			else
			echo "false";
			
		}
		else if ($webix_operation == "update"){
			
			$dp = "true";
			
			$dpro = "true";
			
			$daca = "true";
			
			$dloc = "true";
			
			if($this->MCandidatos->mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
			$ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id))
			$dp = "true";
			
			else
			$dp = "false";
			
			if($this->MCandidatos->mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo))
			$dpro = "true";
			
			else
			$dpro = "false";
			
			if($this->MCandidatos->mupdateDACA($id,$Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola,$Ano))
			$daca = "true";
			
			else
			$daca = "false";
			
			if($this->MCandidatos->mupdateDLOC($id,$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id))
			$dloc = "true";
			
			else
			$dloc = "false";
			
			if($dp == "true" && $dpro == "true" && $daca == "true" && $dloc == "true")
			{
				
				//r				egistrar log
				$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Actualizado com sucesso');
				
				echo "true";
				
			}
			else{
				
				$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Erro actualizado dados');
				
				echo "false";
				
			}
			
			
			/* $request = $_GET;             $tipo_update = @$request['tu'];            if($tipo_update == "DP"){                if($this->MCandidatos->mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,                                            $ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id))                    echo "true";                 else                    echo "false";                }elseif($tipo_update == "DPRO"){                if($this->MCandidatos->mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo))                    echo "true";                 else                    echo "false";              }elseif($tipo_update == "DACA"){                if($this->MCandidatos->mupdateDACA($id,$Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola,$Ano))                    echo "true";                 else                    echo "false";              }elseif($tipo_update == "DLOC"){                if($this->MCandidatos->mupdateDLOC($id,$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id))                    echo "true";                 else                    echo "false";              } */
			
		}
		else if ($webix_operation == "delete"){
			
			if($this->MCandidatos->mdelete($id)){
				
				$this->MAuditorias_Academicas->minsert("Apagar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Apagado com sucesso');
				
				echo "true";
				
			}
			
			else{
				
				$this->MAuditorias_Academicas->minsert("Apagar:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Erro apagando dados');
				
				echo "false";
				
			}
			
		}
		else 
		echo "false";
		
	}
	
	
	//s	alvar la foto que se tira en funcionarios
	public function salvarFoto(){
		
		//i		d del funcionario selecionado
		$id = $this->input->get('id');
		
		$foto_codigo = md5(time()).rand(383,1000);
		
		//u		pload photo
		$estado = false;
		
		if(move_uploaded_file($_FILES['webcam']['tmp_name'], 'Fotos/Candidatos/'.$foto_codigo.'.jpg')){
			
			$estado = true;
			
		}
		
		//s		alvar codigo en la BD
		$this->load->model('mCandidatos');
		
		if($estado == true && $this->mCandidatos->msalvarFoto($id,$foto_codigo))
		{
			
			echo "true";
			
		}
		
	}
	
	//c	argar el codigo de la foto guardada para mostrar foto
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

	public function actualizar_inscicao() {
		
		$bi = $this->input->post('bi');
		$al = date('Y');//$this->input->post('al');

		$this->load->model('mCandidatos');
		$this->load->model('mestudantes');

		//comprobar que no sea estudiante.
		if(!$this->mestudantes->existe_bi($bi)){ //si no existe como estudante significa que e so candidato
			//coger BI y localizarlo para ver si se inscribio en otro ano.
			if($this->mCandidatos->existe_bi($bi)){
				//si fue inscrito en anos anteriores, actualizarle el campo ano_lec_insc.
				if($this->mCandidatos->mactualizar_inscicao($bi,$al)){
					//ponerlo en estado "Espera de pagamento" para que pague de nuevo en financas.

					echo "true";
				}else
					echo "false";
			}else
				echo "false";
		}else
			echo "false";
	}
	
}
