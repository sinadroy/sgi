<?php

class Cpauta_professor extends CI_Controller {
	
	public function exportar(){
		$al = $this->input->get('al');
		$n = $this->input->get('n');
		$c = $this->input->get('c');
		$p = $this->input->get('p');
		$ac = $this->input->get('ac');
		$idd = $this->input->get('idd');
		$d = $this->input->get('d');
		$cod = $this->input->get('cod');
		$g = $this->input->get('g');

		//ver duracao disciplina
		$this->load->model('Mdisciplinas_Duracao');
        $td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXcodigo($cod);

		date_default_timezone_set('UTC');

		//converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

		//Professor
        $this->load->model('mProfessores_Disciplinas');
        $professor = 'Professor: '.$this->mProfessores_Disciplinas->mread_ProfXDisc($idd);

		// data e hora de impresao
		$data_hora_imp = 'Data hora de impressão: '.date("d").' de '.$mes.' de '.date('Y').', '.date("G:i:s");

		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M');
		ini_set('max_execution_time', '400');
		ini_set('max_input_time', '400');

		$this->load->library('excel');
        $this->load->library('excelw');
		// Create new PHPExcel object
		//$objPHPExcel = new Excel();//PHPExcel();
		if($td == "Anual")
			$filename = APPPATH."/libraries/Modelos/Pauta_Modelo_Anual.xlsx";
		elseif($td == "Semestral")
			$filename = APPPATH."/libraries/Modelos/Pauta_Modelo_Semestral.xlsx";

		$objPHPExcel = PHPExcel_IOFactory::load($filename);
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Yordanis Arencibia Lopez")
									->setLastModifiedBy("Yordanis Arencibia Lopez")
									->setTitle("Office 2007 XLSX Test Document")
									->setSubject("Office 2007 XLSX Test Document")
									->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									->setKeywords("office 2007 openxml php")
									->setCategory("pauta");
		// Create a first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//ano lectivo
		$objPHPExcel->getActiveSheet()->setCellValue('K7', $al);
		//Nivel
		$objPHPExcel->getActiveSheet()->setCellValue('B6', $n);
		//Curso
		$objPHPExcel->getActiveSheet()->setCellValue('B7', $c);
		//Periodo
		$objPHPExcel->getActiveSheet()->setCellValue('B8', $p);
		//Ano Curricular
		$objPHPExcel->getActiveSheet()->setCellValue('K8', $ac);
		//Disciplina
		$objPHPExcel->getActiveSheet()->setCellValue('D6', $d);
		//Codigo
		$objPHPExcel->getActiveSheet()->setCellValue('D7', $cod);
		//Geracao
		$objPHPExcel->getActiveSheet()->setCellValue('D8', $g);

		//Professor
		$objPHPExcel->getActiveSheet()->setCellValue('B131', $professor);

		//$data_hora_imp
		$objPHPExcel->getActiveSheet()->setCellValue('C135', $data_hora_imp);
		//$objPHPExcel->getActiveSheet()->setCellValue('B1', "NOME");

		// Rows to repeat at top
		//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);
		$this->load->model('mpautas');
		$rowExcel = 10;
		foreach($this->mpautas->mreadXdisciplina_login_pautas($n,$c,$p,$al,$idd) as $row){
			// colocar datos basicos
			$nome = $row->cNome." ".$row->cNomes." ".$row->cApelido;
			$bi = $row->cBI_Passaporte;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowExcel, $nome);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowExcel, $bi);
			//colocar nota pp1 si existe esta en D10
			if($row->pp1)
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowExcel, $row->pp1);
			//
			// colocar nota pp2 si existe
			if($row->pp2)
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowExcel, $row->pp2);
			//
			// ver si la disc es anual
			if($td == "Anual"){
				// colocar pp3 si la disc es anual.
				if($row->pp3)
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowExcel, $row->pp3);
				//
				//Exame final para disc. Anuales
				if($row->ef)
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowExcel, $row->ef);
				//
				//recurso para disc. Anuales
				if($row->recurso)
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowExcel, $row->recurso);
				//
				//recurso para disc. Anuales
				if($row->especial)
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$rowExcel, $row->especial);
				//
			}elseif($td == "Semestral") {
				//Exame final para disc. Anuales
				if($row->ef)
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowExcel, $row->ef);
				//
				//recurso para disc. Anuales
				if($row->recurso)
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowExcel, $row->recurso);
				//
				//recurso para disc. Anuales
				if($row->especial)
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowExcel, $row->especial);
				//
			}
			

			$rowExcel++;
		}
		/*if($this->mDisciplinas->mreadXduracao($cod) == "Anual"){
			$filename= 'Pauta_Modelo.xlsx';
		}else{*/
			$filename= 'Pauta_Modelo.xlsx';
		//}
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	public function importar(){
		$username = $this->input->get('username');

        //ini_set('max_execution_time', 120);
        ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M');
		ini_set('max_input_time', 400);
        //ini_set('upload_tmp_dir', APPPATH."/libraries/pautas/temporales");

        ini_set('max_execution_time', 120);
		//$destination = realpath('./files');
		
        $destination = realpath(APPPATH."/libraries/pautas"); //para copiar aqui temporalmente la pauta cargda.
        if (isset($_FILES['upload'])){
            $file = $_FILES['upload'];
            $filename = $destination."/".preg_replace("|[\\\/]|", "", $file["name"]);
            //check that file name is valid
            if ($filename !== "" && !file_exists($filename)){
                move_uploaded_file($file["tmp_name"], $filename);
                //leer excel
                //PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
                $this->load->library('excel');
                $this->load->library('excelw');
                $objTpl = PHPExcel_IOFactory::load($filename);
                $objTpl->setActiveSheetIndex(0);

                //ano lectivo
                $alnome = $objTpl->getActiveSheet()->getCell('K7');
                $this->load->model('mAnos_Lectivos');
                $Anos_Lectivos_id = $this->mAnos_Lectivos->mGetID($alnome);
                //Disciplina
                $dcodigo = $objTpl->getActiveSheet()->getCell('D7');
				
				//preparando para comprobaciones de calendarios
				$this->load->model('Mcalendarios_avaliacoes');
				$data = date('Y-m-d');
				$alAno = date('Y');

                $this->load->model('mDisciplinas');
                $Disciplinas_id = $this->mDisciplinas->mreadXcodigo($dcodigo);
                // recorrer por bi e pp1
                $this->load->model('mPautas');
                $this->load->model('mEstudantes');
                $this->load->model('Mdisciplinas_geracao');
                $this->load->model('Mdisciplinas_Duracao');
                $i = 10;//donde inicia el 1er bi, 1ra linea
                while(strlen($objTpl->getActiveSheet()->getCell('C'.$i)) > 1){
                    //Estudante
                    $bi = $objTpl->getActiveSheet()->getCell('C'.$i);
                    $Estudantes_id = $this->mEstudantes->mget_idXbi($bi);
					//usuario logeado apartir de la session.
					$username = $this->session->userdata('username');
					
					//actualizar pp1
					$pp1 = (strlen($objTpl->getActiveSheet()->getCell('D'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('D'.$i)->getValue():0;
					//comprobar planificacion en el calendario.
					if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"pp1")){
						//$pp1 = intval($pp1);
						$this->mPautas->mupdate_pp1($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1,$bi,$username);
					}
					//actualizar pp2
					$pp2 = (strlen($objTpl->getActiveSheet()->getCell('E'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('E'.$i)->getValue():0;
                    if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"pp2")){
						$this->mPautas->mupdate_pp2($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp2,$bi,$username);
					}
                    //si la disciplina es anual leer la 3ra evaluacion
                    $pp3 = 0;
                    if($this->mDisciplinas->mreadXduracao($dcodigo) == "Anual"){
						$pp3 = (strlen($objTpl->getActiveSheet()->getCell('F'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('F'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"pp3")){
							//actualizar pp3
							$this->mPautas->mupdate_pp3($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp3,$bi,$username);
						}
						$ef = (strlen($objTpl->getActiveSheet()->getCell('H'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('H'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"ef")){
							//actualizar EF
							$this->mPautas->mupdate_ef($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$ef,$bi,$username);
						}
						$recurso = (strlen($objTpl->getActiveSheet()->getCell('J'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('J'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"recurso")){
							//actualizar recurso
							$this->mPautas->mupdate_recurso($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$recurso,$bi,$username);
						}
						$especial = (strlen($objTpl->getActiveSheet()->getCell('K'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('K'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"especial")){
							//actualizar especial
							$this->mPautas->mupdate_especial($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$especial,$bi,$username);
						}
						//actualizar estado
						//ver geracao de la disciplina
						$d_geracao_id = $this->Mdisciplinas_geracao->mGetGeracao_DisciplinaXcodigo($dcodigo);
						//ver duracao disciplina
						$td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXcodigo($dcodigo);
						//consultar el estado de la disciplina mediante la duracion y la generacion
						//print_r($pp1);
						$estado = $this->mPautas->mdeterminar_estado($d_geracao_id,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial);
						$this->mPautas->mupdate_estado($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$estado);
						$i++;
					}elseif($this->mDisciplinas->mreadXduracao($dcodigo) == "Semestral"){ //si es semestral
						//actualizar EF
						$ef = (strlen($objTpl->getActiveSheet()->getCell('G'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('G'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"ef")){
							//echo "EF: ".$objTpl->getActiveSheet()->getCell('G'.$i);
							$this->mPautas->mupdate_ef($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$ef,$bi,$username);
						}
						$recurso = (strlen($objTpl->getActiveSheet()->getCell('I'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('I'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"recurso")){
							//actualizar recurso
							//echo "recurso: ".$objTpl->getActiveSheet()->getCell('I'.$i);
							$this->mPautas->mupdate_recurso($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$recurso,$bi,$username);
						}
						$especial = (strlen($objTpl->getActiveSheet()->getCell('J'.$i)) > 0)?$objTpl->getActiveSheet()->getCell('J'.$i)->getValue():0;
						if($this->Mcalendarios_avaliacoes->mpertenece($data,$alAno,"especial")){
							//actualizar especial
							//echo "esp: ".$objTpl->getActiveSheet()->getCell('J'.$i);
							$this->mPautas->mupdate_especial($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$especial,$bi,$username);
						}
						//actualizar estado
						//ver geracao de la disciplina
						$d_geracao_id = $this->Mdisciplinas_geracao->mGetGeracao_DisciplinaXcodigo($dcodigo);
						//ver duracao disciplina
						$td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXcodigo($dcodigo);
						//consultar el estado de la disciplina mediante la duracion y la generacion
						//print_r($pp1);
						$estado = $this->mPautas->mdeterminar_estado($d_geracao_id,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial);
						$this->mPautas->mupdate_estado($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$estado);
						$i++;
					}
                }
                //por ultimo borro el archivo temporal de la pauta
                if(delete_files(APPPATH."/libraries/pautas/")){
                   echo "true";
                }
            } else {
                //$res = array("status" => "error");
                echo "false";
            }
        }
        
    }
}