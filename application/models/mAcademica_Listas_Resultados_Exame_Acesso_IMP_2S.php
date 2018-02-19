<?php
  class MAcademica_Listas_Resultados_Exame_Acesso_IMP_2S extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($a,$n,$c,$p,$utilizador,$tipo_doc)
    {
        ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '20M');
		ini_set('download_max_filesize', '20M');
		ini_set('post_max_size', '20M'); 
		//ini_set('get_max_size', '20M'); 
		ini_set('max_input_time', '500');
        ini_set('max_execution_time', '500');
        
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        
        //DADOS GERAIS
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $alAno = "";
        $curso = "";
        $nNome = "";
        $pNome = "";
        $apecNota = "";
        //converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        //
        $this->load->model('mNiveisCursos');
        $nota_minima_ea = $this->mNiveisCursos->mread_nota_minima_2s($n,$c,$p);

        $listaInscricao = "";
        $listaInscricao2 = "";
        if($tipo_doc == "1")
            $tipo = "Admitido";
        elseif($tipo_doc == "2"){
            $tipo = "Não Admitido";
        }else
            $tipo = "Todos";
        $contador = 0;
        $this->load->model('MAcademica_Listas_Resultados_Exame_Acesso_2S');
        foreach ($this->MAcademica_Listas_Resultados_Exame_Acesso_2S->mreadXtodos($a,$n,$c,$p) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $alAno = $value['alAno'];
            $curso = $value['curso'];
            $nNome = $value['nNome'];
            $pNome = $value['pNome'];
            $pNome = $value['pNome'];
            $orden = $value['orden'];
            $apecNota = $value['apecNota'];
            $estado = ($apecNota < $nota_minima_ea)?"Não Admitido":"Admitido";
            if($tipo == $estado){
                $contador++;
                if($contador <= 40){
                    $listaInscricao = $listaInscricao.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$apecNota.'</td> <td align="center">'.$estado.'</td></tr>';
                }else
                    $listaInscricao2 = $listaInscricao2.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$apecNota.'</td> <td align="center">'.$estado.'</td></tr>';
            }
            if($tipo == "Todos"){
                $contador++;
                if($contador <= 40){
                    $listaInscricao = $listaInscricao.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$apecNota.'</td> <td align="center">'.$estado.'</td></tr>';
                }else
                    $listaInscricao2 = $listaInscricao2.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$apecNota.'</td> <td align="center">'.$estado.'</td></tr>';
            }
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Listas: Resultados Exame de Acesso 2º Sess&atilde;o.</h4><br> </td></tr>
                    </table>
                    <br>
                    <table border="0" align="left">
                        <tr><td align="left"><b>Ano Lectivo: </b>'.$alAno.'</td></tr>
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td> </tr>
                        <tr><td align="left"><b>Curso: </b>'.$curso.'</td> </tr>
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td align="center" width="30"><b>Nº</b></td> <td align="center" width="390"><b>Nome Completo</b></td> <td  width="165"><b>BI/Passaporte</b></td> <td  width="55"><b>Nota</b></td> <td  width="90"><b>Estado</b></td></tr>
                        '.$listaInscricao.'
                    </table>
                    <br>
                </div>
            </page>
        ';
        if($contador <= 40){
            $content = $content.'
                <div>
                    <br>
                    <table align="left" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><p>Funcion&aacute;rio: '.$utilizador.'</p></td>
                        </tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
            ';
        }
        if($contador > 40){
            $content = $content.'<page>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td align="center" width="30"><b>Nº</b></td> <td align="center" width="390"><b>Nome Completo</b></td> <td  width="165"><b>BI/Passaporte</b></td> <td  width="55"><b>Nota</b></td> <td  width="90"><b>Estado</b></td></tr>
                        '.$listaInscricao2.'
                    </table>
                    <br>
                </div>
                
                <div>
                    <br>
                    <table align="left" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><p>Funcion&aacute;rio: '.$utilizador.'</p></td>
                        </tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
            </page>';
        }
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Academica_Listas_Resultados_Exame_Acesso_IMP_2S.pdf','F');
        echo "true";
    }       
  }
