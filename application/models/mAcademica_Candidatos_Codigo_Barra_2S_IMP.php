<?php
  class MAcademica_Candidatos_Codigo_Barra_2S_IMP extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($a,$n,$c,$p,$t,$d,$h,$utilizador)
    {
        ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M'); 
		//ini_set('get_max_size', '20M');
	//	ini_set('max_execution_time', '300'); 
		ini_set('max_input_time', '300');
		
		ini_set('max_execution_time', '400');
		ini_set('max_input_time', '400');

        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        
        //DADOS GERAIS
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $fidade = "";
        $cEstado = "";
        $alAno = "";
        $curso = "";
        $nNome = "";
        $pNome = "";

        //converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        

        //cargar modelo para codigo de barra
        $this->load->model('MGerar_Codigo_Barra');

        $pagina = "";
        //$contador = 1;
        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        foreach ($this->MAcademica_Planificacao_Exame_Candidatos_2S->mread22($a,$n,$c,$p,$t,$d,$h) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            //$cEstado = $value['cEstado'];
            $alAno = $value['alAno'];
            $curso = $value['curso'];
            $nNome = $value['nNome'];
            $pNome = $value['pNome'];
            $atcNome = $value['atcNome'];
            $apeiData = $value['apeiData'];
            $apeiHora = $value['apeiHora'];
            $apecCodigoBarra = $value['apecCodigoBarra'];
            //$contador++;
            $codigo_barra_generado =$this->MGerar_Codigo_Barra->criarCB($apecCodigoBarra);
            $pagina = $pagina.'
                <page>
                    <div align="center">
                        <br>
                        <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                        <b>'.$logotipo_titulo.'</b><br>
                        <br>
                        <br>
                        <table align="center" border="1">
                            <tr ><td border="0" align="center" width="600"> <h4>Exame de Acesso 2º Sessão: C&oacute;digo de Barra</h4><br> </td></tr>
                        </table>
                        <br>
                        <br>
                        <table border="0" align="center">
                            <tr><td align="left"><b>Nome: </b>'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td width="100"></td>  <td align="left"><b>Ano Lectivo: </b>'.$alAno.'</td></tr>
                            <tr><td align="left"><b>BI: </b>'.$cBI_Passaporte.'</td> <td width="100"></td> <td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td></tr>
                            <tr><td align="left"><b>Sala: </b>'.$atcNome.'</td> <td width="100"></td> <td align="left"><b>Curso: </b>'.$curso.'</td></tr>
                            <tr><td align="left"><b>Data: </b>'.$apeiData.'</td> <td width="100"></td> <td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                            <tr><td align="left"><b>Hora: </b>'.$apeiHora.'</td></tr>
                        </table>
                        
                        <div align="center"><img align="center" border="0" height="25" width="140" src="data:image/png;base64,' . base64_encode($codigo_barra_generado) . '"></div>
                        <br>
                        <br>
                    </div>
                    <div><p>=================================================================================================</p></div>
                    <div align="center">
                        <br>
                        <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                        <b>'.$logotipo_titulo.'</b><br>
                        <br>
                        <br>
                        <table align="center" border="1">
                            <tr ><td border="0" align="center" width="600"> <h4>Exame de Acesso 2º Sessão: C&oacute;digo de Barra</h4><br> </td></tr>
                        </table>
                        <br>
                        <br>
                        <table border="0" align="center">
                            <tr><td align="left"><b>Nome: </b>'./*base64_encode($cNome.' '.$cNomes.' '.$cApelido)*/'*****'.'</td> <td width="100"></td>  <td align="left"><b>Ano Lectivo: </b>'.$alAno.'</td></tr>
                            <tr><td align="left"><b>BI: </b>'.base64_encode($cBI_Passaporte).'</td> <td width="100"></td> <td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td></tr>
                            <tr><td align="left"><b>Sala: </b>'./*base64_encode($atcNome)*/'*****'.'</td> <td width="100"></td> <td align="left"><b>Curso: </b>'.$curso.'</td></tr>
                            <tr><td align="left"><b>Data: </b>'./*base64_encode($apeiData)*/'*****'.'</td> <td width="100"></td> <td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                            <tr><td align="left"><b>Hora: </b>'./*base64_encode($apeiHora)*/'*****'.'</td></tr>
                        </table>
                        <div align="center"><img align="center" border="0" height="25" width="140" src="data:image/png;base64,' . base64_encode($codigo_barra_generado) . '"></div>
                        <br>
                    </div>
                </page>
            ';
        }
        
        $this->hpdf->WriteHTML($pagina);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Academica_Candidatos_Codigo_Barra_2S_IMP.pdf','F');
        echo "true";
    }       
  }
