<?php

class CExportar_Dados_Excel extends CI_Controller {
	
	
	
	
	/*    var $excel = '';        public function readListas(){        $this->load->library('excel');        $this->excel = new Excel();        //$this->excel->lread();        $this->excel->setOutputEncoding('CP1251');        $ficheiro = 'pautas/lista1.xls';        $this->excel->read($ficheiro);        //for($i=12;$i<=47;$i++){        //    echo $this->excel->sheets[0]['cells'][$i][1].'<br/>';        //}        for ($i = 1; $i <= $this->excel->sheets[0]['numRows']; $i++) {            for ($j = 1; $j <= $this->excel->sheets[0]['numCols']; $j++) {                    echo "\"".$this->excel->sheets[0]['cells'][$i][$j]."\",";            }            echo "\n";        }    }    */
	
	
	
	
	/*     * Generar mini pautas a partir de MiniPautaModelo     */
	
	
	public function Dados_Inscricao(){
		
		
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M'); 
		//ini_set('get_max_size', '20M');
	//	ini_set('max_execution_time', '300'); 
		ini_set('max_input_time', '300');
		
		ini_set('max_execution_time', '400');
		ini_set('max_input_time', '400');
		//ini_set('memory_limit', '256M');

		$this->load->library('excel');
		
		
		$this->load->library('excelw');
		
		
		//teste
		//$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		
		//$cacheSettings = array( 'memoryCacheSize' => '4MB');
		
		//PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
		
		//
		
		
		$objTpl = PHPExcel_IOFactory::load(APPPATH."/libraries/Modelos/Dados_Inscricao_Modelo.xlsx");
		
		
		$objTpl->setActiveSheetIndex(0);
		
		//s		et first sheet as active
		
		//g		et nome de curso por el ID
		
		
		/*  $nomeCurso = "";            $this->load->model('mcursos');            foreach($this->mcursos->mreadX($Curso) as $row){                $nomeCurso = $row->cnome;            }            */
		
		
		//t		raer datos de la BD y meter en excel
		$this->load->model('MCandidatos');
		$rowExcel = 2;
		foreach($this->MCandidatos->mreadDP() as $row){
			//dados pessoais
			$objTpl->getActiveSheet()->setCellValue('A'.$rowExcel, $row['ord']);
			$objTpl->getActiveSheet()->setCellValue('B'.$rowExcel, $row['cNome']);
			$objTpl->getActiveSheet()->setCellValue('C'.$rowExcel, $row['cNomes']);
			$objTpl->getActiveSheet()->setCellValue('D'.$rowExcel, $row['cApelido']);
			//Nome completo
			$objTpl->getActiveSheet()->setCellValue('E'.$rowExcel, $row['cNome'].' '.$row['cNomes'].' '.$row['cApelido']);
			$objTpl->getActiveSheet()->setCellValue('F'.$rowExcel, $row['cBI_Passaporte']);
			$objTpl->getActiveSheet()->setCellValue('G'.$rowExcel, $row['cBI_Data_Emissao']);
			$objTpl->getActiveSheet()->setCellValue('H'.$rowExcel, $row['provEmissao']);
			$objTpl->getActiveSheet()->setCellValue('I'.$rowExcel, $row['cData_Nascimento']);
			$objTpl->getActiveSheet()->setCellValue('J'.$rowExcel, $row['provNascimento']);
			$objTpl->getActiveSheet()->setCellValue('K'.$rowExcel, $row['munNascimento']);
			$objTpl->getActiveSheet()->setCellValue('L'.$rowExcel, $this->MCandidatos->calculaEdad($row['cData_Nascimento']));
			$objTpl->getActiveSheet()->setCellValue('M'.$rowExcel, $row['gNome']);
			$objTpl->getActiveSheet()->setCellValue('N'.$rowExcel, $row['ecNome']);
			$objTpl->getActiveSheet()->setCellValue('O'.$rowExcel, $row['ngNome']);
			$objTpl->getActiveSheet()->setCellValue('P'.$rowExcel, $row['cNome_Pai']);
			$objTpl->getActiveSheet()->setCellValue('Q'.$rowExcel, $row['cNome_Mae']);
			$rowExcel++;
		}
		
		
		//$		this->load->model('MCandidatos');
		
		
		$rowExcel = 3;
		foreach($this->MCandidatos->mreadDPRO() as $row){
			$objTpl->getActiveSheet()->setCellValue('R'.$rowExcel, $row['proNome']);
			$objTpl->getActiveSheet()->setCellValue('S'.$rowExcel, $row['trabNome']);
			$objTpl->getActiveSheet()->setCellValue('T'.$rowExcel, $row['tilNome']);
			$objTpl->getActiveSheet()->setCellValue('U'.$rowExcel, $row['otNome']);
			$objTpl->getActiveSheet()->setCellValue('V'.$rowExcel, $row['dlLocal_Trabalho']);
			$objTpl->getActiveSheet()->setCellValue('W'.$rowExcel, $row['dlCargo']);
			$rowExcel++;
		}
		
		
		//$		this->load->model('MCandidatos');
		
		
		$rowExcel = 3;
		foreach($this->MCandidatos->mreadDACA() as $row){
			$objTpl->getActiveSheet()->setCellValue('X'.$rowExcel, $row['paFormacao']);
			$objTpl->getActiveSheet()->setCellValue('Y'.$rowExcel, $row['provFormacao']);
			$objTpl->getActiveSheet()->setCellValue('Z'.$rowExcel, $row['hlfNome']);
			$objTpl->getActiveSheet()->setCellValue('AA'.$rowExcel, $row['efNome']);
			$objTpl->getActiveSheet()->setCellValue('AB'.$rowExcel, $row['Ano']);
			$objTpl->getActiveSheet()->setCellValue('AC'.$rowExcel, $row['Media']);
			$rowExcel++;
		}
		
		
		//$		this->load->model('MCandidatos');
		
		
		$rowExcel = 3;
		foreach($this->MCandidatos->mreadDLOC() as $row){
			$objTpl->getActiveSheet()->setCellValue('AD'.$rowExcel, $row['cTelefone']);
			$objTpl->getActiveSheet()->setCellValue('AE'.$rowExcel, $row['cEmail']);
			$objTpl->getActiveSheet()->setCellValue('AF'.$rowExcel, $row['paNome']);
			$objTpl->getActiveSheet()->setCellValue('AG'.$rowExcel, $row['provNome']);
			$objTpl->getActiveSheet()->setCellValue('AH'.$rowExcel, $row['munNome']);
			$objTpl->getActiveSheet()->setCellValue('AI'.$rowExcel, $row['baiNome']);
			$rowExcel++;
		}
		
		
		
		$objTpl->setActiveSheetIndex(1);
		
		
		//s		et first sheet as active
		//m		readto_Excel
		//$this->load->model('MCandidatos');
		
		$rowExcel = 2;
		
		foreach($this->MCandidatos->mreadto_Excel() as $row){
			
			$objTpl->getActiveSheet()->setCellValue('A'.$rowExcel, $row['ord']);
			
			$objTpl->getActiveSheet()->setCellValue('B'.$rowExcel, $row['cNome']);
			
			$objTpl->getActiveSheet()->setCellValue('C'.$rowExcel, $row['cNomes']);
			
			$objTpl->getActiveSheet()->setCellValue('D'.$rowExcel, $row['cApelido']);

			//$objTpl->getActiveSheet()->setCellValue('E'.$rowExcel, $row['cNome'].' '.$row['cNomes'].' '.$row['cApelido']);
			
			$objTpl->getActiveSheet()->setCellValue('F'.$rowExcel, $row['cBI_Passaporte']);
			
			$objTpl->getActiveSheet()->setCellValue('G'.$rowExcel, $row['nNome']);
			
			$objTpl->getActiveSheet()->setCellValue('H'.$rowExcel, $row['curso']);
			
			$objTpl->getActiveSheet()->setCellValue('I'.$rowExcel, $row['pNome']);
			
			$rowExcel++;
			
		}
		
		
		
		//p		repare download
		//$		filename=mt_rand(1,100000).'.xlsx';
		
		//j		ust some random filename
		$filename= 'Dados_Inscricao_Modelo.xlsx';
		
		
		header('Content-Type: application/vnd.ms-excel');
		
		
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		
		
		header('Cache-Control: max-age=0');
		
		
		//header('Content-Length: '.$length);
		
		
		
		$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');
		
		//d		ownloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');
		
		//s		end it to user, of course you can save it to disk also!
		//$objWriter->save(APPPATH."../relatorios/excel/".$filename);
		
		//O		KOK
		//e		cho "true";
		
		
	}
	
	
	
	
	/*    public function pautaFinal() {        
			$Ano = $this->input->get('Ano');        
			$Curso = $this->input->get('Curso');        
			$Periodo = $this->input->get('Periodo');        $Disciplina = $this->input->get('Disciplina');        $Turma = $this->input->get('Turma');                if($Ano != "" && $Curso != "" && $Periodo != "" && $Disciplina != "" && $Turma != "")        {           $this->load->library('excel');            $this->load->library('excelw');            $objTpl = PHPExcel_IOFactory::load(APPPATH."/libraries/pautas/PautaFinalModelo.xlsx");            $objTpl->setActiveSheetIndex(0);  //set first sheet as active            //$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date            //$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified            //traer datos de la BD            $this->load->model('mpautas');            $rowExcel = 3;            foreach($this->mpautas->mread($Ano,$Curso,$Periodo,$Disciplina,$Turma) as $row){                $objTpl->getActiveSheet()->setCellValue('B'.$rowExcel, $row->nome);                $rowExcel++;                            }            //prepare download            //$filename=mt_rand(1,100000).'.xlsx'; //just some random filename            $filename= 'pautaFinal'.$Ano.$Curso.$Periodo.$Disciplina.$Turma.'.xlsx';            header('Content-Type: application/vnd.ms-excel');            header('Content-Disposition: attachment;filename="'.$filename.'"');            header('Cache-Control: max-age=0');            $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)            $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!            //$objWriter->save(APPPATH."/libraries/pautas/".$filename); //OKOK                    }    }    */
	
	
}


?>