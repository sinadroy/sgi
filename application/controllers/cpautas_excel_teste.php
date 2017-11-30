<?php

class Cpautas_excel extends CI_Controller {
    
    //var $excel = '';
    //var $phpe_reader = '';
    //var $phpe_writer = '';
    
    public function readPauta(){
        //ini_set('max_execution_time', 120);
        ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M');
		ini_set('max_input_time', 400);
        //ini_set('upload_tmp_dir', APPPATH."/libraries/pautas/temporales");

        ini_set('max_execution_time', 120);
        //$destination = realpath('./files');
        $destination = realpath(APPPATH."/libraries/pautas");
        if (isset($_FILES['upload'])){
            $file = $_FILES['upload'];
            $filename = $destination."/".preg_replace("|[\\\/]|", "", $file["name"]);
            //$sname = md5($file["name"]);
            //check that file name is valid
            if ($filename !== "" && !file_exists($filename)){
                move_uploaded_file($file["tmp_name"], $filename);
                //$res = array("status" => "server", "sname" => $sname);
                //echo $filename;
                //leer excel
                $this->load->library('excel');
                $this->load->library('excelw');
                //$objTpl = PHPExcel_IOFactory::load(APPPATH."/libraries/pautas/teste1.xlsx");
                $objTpl = PHPExcel_IOFactory::load($filename);
                $objTpl->setActiveSheetIndex(0);
                /////////echo $objTpl->getActiveSheet()->getCell('A1');

                //por ultimo borro el archivo temporal de la pauta
                if(delete_files(APPPATH."/libraries/pautas/")){
                    //ano lectivo
                    $alnome = $objTpl->getActiveSheet()->getCell('L7');
                    $this->load->model('mAnos_Lectivos');
                    $Anos_Lectivos_id = $this->mAnos_Lectivos->mGetID($Nome);
                    //Disciplina
                    $dcodigo = $objTpl->getActiveSheet()->getCell('D7');
                    $this->load->model('mDisciplinas');
                    $Disciplinas_id = $this->mDisciplinas->mreadXcodigo($codigo);
                    // recorrer por bi e pp1
                    $this->load->model('mPautas');
                    $this->load->model('mEstudantes');
                    $i = 10;//donde inicia el 1er bi, 1ra linea
                    while($objTpl->getActiveSheet()->getCell('C'.$i) !== ""){
                        $pp1 = $objTpl->getActiveSheet()->getCell('D'.$i);
                        //Estudante
                        $bi = $objTpl->getActiveSheet()->getCell('C'.$i);
                        $Estudantes_id = $this->mEstudantes->mget_idXbi($bi);
                        //actualizar pp1 na pauta
                        $this->mPautas->mupdate_pp1($Anos_Lectivos_id,$Estudantes_id,$Disciplinas_id,$pp1);
                        $i++;
                    }
                    //echo "true";
                }
            } else {
                //$res = array("status" => "error");
                echo "false";
            }
        }
        
    }
    /*
     * Generar mini pautas a partir de MiniPautaModelo
     */
    public function miniPauta(){
        $Ano = $this->input->get('Ano');
        $Curso = $this->input->get('Curso');
        $Periodo = $this->input->get('Periodo');
        $Disciplina = $this->input->get('Disciplina');
        $Turma = $this->input->get('Turma');
        
        if($Ano != "" && $Curso != "" && $Periodo != "" && $Disciplina != "" && $Turma != "")
        {
           $this->load->library('excel');
            $this->load->library('excelw');
            $objTpl = PHPExcel_IOFactory::load(APPPATH."/libraries/pautas/MiniPautaModelo.xlsx");
            $objTpl->setActiveSheetIndex(0);  //set first sheet as active
            //Get nome de Disciplina a partir do ID
            $nomeDisciplina = "";
            $this->load->model('mdisciplinas');
            foreach ($this->mdisciplinas->mreadX($Disciplina) as $row) {
                $nomeDisciplina = $row->dnome;
            }
            //Get nome docente a partir do id da disciplina
            $nomeDocente = "";
            $this->load->model('mdocentes');
            foreach($this->mdocentes->mreadDocenteXDisciplina($Disciplina) as $row){
                $nomeDocente = $row->nome; 
            }
            //Get periodo nome a partir del ID
            $nomePeriodo = "";
            $this->load->model('mperiodos');
            foreach($this->mperiodos->mreadX($Periodo) as $row){
                $nomePeriodo = $row->pnome;
            }
            //get nome de curso por el ID
            $nomeCurso = "";
            $this->load->model('mcursos');
            foreach($this->mcursos->mreadX($Curso) as $row){
                $nomeCurso = $row->cnome;
            }
            //traer datos de la BD
            $this->load->model('mpautas');
            $rowExcel = 13;
            foreach($this->mpautas->mread($Ano,$Curso,$Periodo,$Disciplina,$Turma) as $row){
                $objTpl->getActiveSheet()->setCellValue('C'.$rowExcel, $row->nome /*Nome estudante*/);
                $objTpl->getActiveSheet()->setCellValue('B'.$rowExcel, $row->numerouniversitario /*Nome estudante*/);
                //Curso: ___________  Ano:   2016   Período:____Noite_________
                $objTpl->getActiveSheet()->setCellValue('B7', "Curso: ".$nomeCurso."  Ano:   ".$Ano."   Período: ".$nomePeriodo);
                //$nomeDocente
                $objTpl->getActiveSheet()->setCellValue('B8', "Docente: ".$nomeDocente);
                //$nomeDisciplina
                $objTpl->getActiveSheet()->setCellValue('F8', "Disciplina: ".$nomeDisciplina);
                $rowExcel++;
            }
            //prepare download
            //$filename=mt_rand(1,100000).'.xlsx'; //just some random filename
            $filename= 'MiniPauta'.$Ano.$Curso.$Periodo.$Disciplina.$Turma.'.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
            $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
            //$objWriter->save(APPPATH."/libraries/pautas/".$filename); //OKOK
            
        }
    }
    public function pautaFinal() {
        $Ano = $this->input->get('Ano');
        $Curso = $this->input->get('Curso');
        $Periodo = $this->input->get('Periodo');
        $Disciplina = $this->input->get('Disciplina');
        $Turma = $this->input->get('Turma');
        
        if($Ano != "" && $Curso != "" && $Periodo != "" && $Disciplina != "" && $Turma != "")
        {
           $this->load->library('excel');
            $this->load->library('excelw');
            $objTpl = PHPExcel_IOFactory::load(APPPATH."/libraries/pautas/PautaFinalModelo.xlsx");
            $objTpl->setActiveSheetIndex(0);  //set first sheet as active

            //$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
            //$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified


            //traer datos de la BD
            $this->load->model('mpautas');
            $rowExcel = 3;
            foreach($this->mpautas->mread($Ano,$Curso,$Periodo,$Disciplina,$Turma) as $row){
                $objTpl->getActiveSheet()->setCellValue('B'.$rowExcel, $row->nome /*Nome estudante*/);
                $rowExcel++;
                /* $al[] = array(
                        "id"=>$row->id,
                        "nome"=>$row->nome,
                        "numerouniversitario"=>$row->numerouniversitario,
                        "dnome"=>$row->dnome,
                        "notafinal"=>$row->notafinal,
                        "estado"=>$row->estado,
                        "obs"=>$row->obs,
                        "usuarioupdate"=>$row->usuarioupdate,
                        "dataupdate"=>$row->dataupdate,
                        "horaupdate"=>$row->horaupdate
                    );
                    * 
                    */
            }
            //prepare download
            //$filename=mt_rand(1,100000).'.xlsx'; //just some random filename
            $filename= 'pautaFinal'.$Ano.$Curso.$Periodo.$Disciplina.$Turma.'.xlsx';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
            $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
            //$objWriter->save(APPPATH."/libraries/pautas/".$filename); //OKOK
            
        }
    }
}
?>