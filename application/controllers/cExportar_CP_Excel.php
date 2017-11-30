<?php

class CExportar_CP_Excel extends CI_Controller {
	
	public function Dados_Inscricao(){
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		//date_default_timezone_set('Europe/London');

		/** Include PHPExcel */
		///////require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
		$this->load->library('excel');
		//$this->load->library('excelw');

		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
		if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
			die($cacheMethod . " caching method is not available" . EOL);
		}
		//echo date('H:i:s') , " Enable Cell Caching using " , $cacheMethod , " method" , EOL;

		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M'); 
		//ini_set('get_max_size', '20M');
	//	ini_set('max_execution_time', '300'); 
		ini_set('max_input_time', '300');
		
		ini_set('max_execution_time', '400');
		ini_set('max_input_time', '400');

		// Create new PHPExcel object
		//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
		$objPHPExcel = new Excel();//PHPExcel();

		// Set document properties
		//echo date('H:i:s') , " Set properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("Yordanis Arencibia Lopez")
									->setLastModifiedBy("Yordanis Arencibia Lopez")
									->setTitle("Office 2007 XLSX Test Document")
									->setSubject("Office 2007 XLSX Test Document")
									->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									->setKeywords("office 2007 openxml php")
									->setCategory("Test result file");


		// Create a first sheet
		//echo date('H:i:s') , " Add data" , EOL;
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "ORD");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "NOME");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "NOMES");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "APELIDO");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "NOME COMPLETO");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "BI/PASSAPORTE");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "BI DATA EMISSÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "BI PROVINCIA EMISSÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "DATA NASCIMENTO");
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "PROVINCIA NASCIMENTO");
		$objPHPExcel->getActiveSheet()->setCellValue('K1', "NATURALIDADE");
		$objPHPExcel->getActiveSheet()->setCellValue('L1', "IDADE");
		$objPHPExcel->getActiveSheet()->setCellValue('M1', "GENERO");
		$objPHPExcel->getActiveSheet()->setCellValue('N1', "ESTADO CIVIL");
		$objPHPExcel->getActiveSheet()->setCellValue('O1', "NACIONALIDADE");
		$objPHPExcel->getActiveSheet()->setCellValue('P1', "NOME PAI");
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', "NOME MAE");
		
		$objPHPExcel->getActiveSheet()->setCellValue('R1', "PROFISSÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('S1', "TRABALHADOR");
		$objPHPExcel->getActiveSheet()->setCellValue('T1', "TIPO INSTITUIÇÃO LABORAL");
		$objPHPExcel->getActiveSheet()->setCellValue('U1', "ORGANISMO TUTELA");
		$objPHPExcel->getActiveSheet()->setCellValue('V1', "LOCAL TRABALHO");
		$objPHPExcel->getActiveSheet()->setCellValue('W1', "CARGO");
		$objPHPExcel->getActiveSheet()->setCellValue('X1', "PAÍS FORMAÇÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('Y1', "PROVINCIA FORMAÇÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('Z1', "HABILITAÇÃO LITERARIA");
		$objPHPExcel->getActiveSheet()->setCellValue('AA1', "ESCOLA FORMAÇÃO");
		$objPHPExcel->getActiveSheet()->setCellValue('AB1', "ANO");
		$objPHPExcel->getActiveSheet()->setCellValue('AC1', "MÉDIA");
		$objPHPExcel->getActiveSheet()->setCellValue('AD1', "TELEFONE");// 
		$objPHPExcel->getActiveSheet()->setCellValue('AE1', "EMAIL");//
		$objPHPExcel->getActiveSheet()->setCellValue('AF1', "PAÍS");//
		$objPHPExcel->getActiveSheet()->setCellValue('AG1', "PROVINCIA");
		$objPHPExcel->getActiveSheet()->setCellValue('AH1', "MUNICIPIO");
		$objPHPExcel->getActiveSheet()->setCellValue('AI1', "BAIRRO");

		$objPHPExcel->getActiveSheet()->setCellValue('AJ1', "NÍVEL");
		$objPHPExcel->getActiveSheet()->setCellValue('AK1', "CURSO");
		$objPHPExcel->getActiveSheet()->setCellValue('AL1', "PERÍODO");

		// Rows to repeat at top
		//echo date('H:i:s') , " Rows to repeat at top" , EOL;
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);


		// Add data
	/*	for ($i = 2; $i <= 5000; $i++) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "FName $i")
										->setCellValue('B' . $i, "LName $i")
										->setCellValue('C' . $i, "PhoneNo $i")
										->setCellValue('D' . $i, "FaxNo $i")
										->setCellValue('E' . $i, true);
		}
	*/
		$this->load->model('MCandidatos');
		$rowExcel = 3;
		foreach($this->MCandidatos->mreadto_Excel() as $row){
			//dados pessoais
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowExcel, $row['ord']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowExcel, $row['cNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowExcel, $row['cNomes']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowExcel, $row['cApelido']);
			//Nome completo
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowExcel, $row['cNome'].' '.$row['cNomes'].' '.$row['cApelido']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowExcel, $row['cBI_Passaporte']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowExcel, $row['cBI_Data_Emissao']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowExcel, $row['provEmissao']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowExcel, $row['cData_Nascimento']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowExcel, $row['provNascimento']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$rowExcel, $row['munNascimento']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$rowExcel, $this->MCandidatos->calculaEdad($row['cData_Nascimento']));
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$rowExcel, $row['gNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$rowExcel, $row['ecNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$rowExcel, $row['ngNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$rowExcel, $row['cNome_Pai']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowExcel, $row['cNome_Mae']);
			//
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$rowExcel, $row['proNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$rowExcel, $row['trabNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$rowExcel, $row['tilNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$rowExcel, $row['otNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$rowExcel, $row['dlLocal_Trabalho']);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$rowExcel, $row['dlCargo']);
			//
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$rowExcel, $row['paFormacao']);
			$objPHPExcel->getActiveSheet()->setCellValue('Y'.$rowExcel, $row['provFormacao']);
			$objPHPExcel->getActiveSheet()->setCellValue('Z'.$rowExcel, $row['hlfNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AA'.$rowExcel, $row['efNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AB'.$rowExcel, $row['Ano']);
			$objPHPExcel->getActiveSheet()->setCellValue('AC'.$rowExcel, $row['Media']);
			//
			$objPHPExcel->getActiveSheet()->setCellValue('AD'.$rowExcel, $row['cTelefone']);
			$objPHPExcel->getActiveSheet()->setCellValue('AE'.$rowExcel, $row['cEmail']);
			$objPHPExcel->getActiveSheet()->setCellValue('AF'.$rowExcel, $row['paNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AG'.$rowExcel, $row['provNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$rowExcel, $row['munNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AI'.$rowExcel, $row['baiNome']);

			$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$rowExcel, $row['nNome']);
			$objPHPExcel->getActiveSheet()->setCellValue('AK'.$rowExcel, $row['curso']);
			$objPHPExcel->getActiveSheet()->setCellValue('AL'.$rowExcel, $row['pNome']);
			$rowExcel++;
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
		//$callStartTime = microtime(true);

		$filename= 'Dados_Inscricao_CP_Modelo.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$objWriter->save('php://output');
		//$callEndTime = microtime(true);
		//$callTime = $callEndTime - $callStartTime;

		//echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
		//echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
		// Echo memory usage
		//echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


		// Echo memory peak usage
		//echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

		// Echo done
		//echo date('H:i:s') , " Done writing file" , EOL;
		//echo 'File has been created in ' , getcwd() , EOL;
	}
}