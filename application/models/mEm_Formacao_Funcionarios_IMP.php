<?php
  class MEm_Formacao_Funcionarios_IMP extends CI_Model{
    function dtMes($mes) {
        $nome = "";
        switch ($mes) {
            case '1':
                $nome = "Janeiro";
                break;
            case '2':
                $nome = "Fevereiro";
                break;
            case '3':
                $nome = "Mar&ccedil;o";
                break;
            case '4':
                $nome = "Abril";
                break;
            case '5':
                $nome = "Maio";
                break;
            case '6':
                $nome = "Junho";
                break;
            case '7':
                $nome = "Julho";
                break;
            case '8':
                $nome = "Agosto";
                break;
            case '9':
                $nome = "Setembro";
                break;
            case '10':
                $nome = "Outubro";
                break;
            case '11':
                $nome = "Novembro";
                break;
            case '12':
                $nome = "Dezembro";
                break;
            default:
                $nome = "Janeiro";
                break;
        }
        return $nome;
    }
    
      public function criarPdf($al)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('L','A4','pt','true','UTF-8');
        
        $mes = $this->dtMes(date('m'));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();
        
        //formacao funcionarios
        $fNome = "";
        $fNomes = "";
        $fApelido = "";
        $fBI_Passaporte = "";
        
        $ffCurso = "";
        $ffOpcao = "";
        $ffWeb_Site_Univ = "";
        $ffEmail_Secretaria = "";
        $ffAno_Inicio = "";
        $ffAno_Fin = "";
        $bolNome = "";
        $ffTema_Tese = "";
        //$Graus_Pretendidos_id = "";
        $gpNome = "";
        $univNome = "";
        $opbNome = "";
        $mfNome = "";
        $paNome = "";
        $ffCidade = "";
        
        $listaFormacoes = "";
        
        foreach ($al as $value3) {
            $fNome = $value3['fNome'];
            $fNomes = $value3['fNomes'];
            $fApelido = $value3['fApelido'];
            $fBI_Passaporte = $value3['fBI_Passaporte'];
                    
            $ffCurso = $value3['ffCurso'];
            $ffOpcao= $value3['ffOpcao'];
            $ffWeb_Site_Univ=$value3['ffWeb_Site_Univ'];
            $ffEmail_Secretaria=$value3['ffEmail_Secretaria'];
            $ffAno_Inicio=$value3['ffAno_Inicio'];
            $ffAno_Fin=$value3['ffAno_Fin'];
            $bolNome=$value3['bolNome'];
            $ffTema_Tese=$value3['ffTema_Tese'];
            $gpNome=$value3['gpNome'];
            $univNome=$value3['univNome'];
            $opbNome=$value3['opbNome'];
            $mfNome=$value3['mfNome'];
            $paNome=$value3['paNome'];
            $ffCidade=$value3['ffCidade'];
            
            $listaFormacoes = $listaFormacoes.'
                <tr>
                    <td rowspan="2" align="left">'.$fNome.' '.$fNomes.' '.$fApelido.'</td>
                    <td rowspan="2" align="center">'.$fBI_Passaporte.'</td> 
                    <td align="center">'.$ffAno_Inicio.'</td> 
                    <td align="left">'.$ffCurso.'</td>
                    <td align="left">'.$univNome.'</td>
                    <td align="left">'.$paNome.'</td>
                </tr>
                <tr>
                    <td align="center">'.$ffAno_Fin.'</td>
                    <td align="left">'.$ffOpcao.'</td>
                    <td align="left">'.$bolNome.'</td>
                    <td align="left">'.$ffCidade.'</td>
                </tr>
            ';
        }
        
        $content = '
            <!DOCTYPE html>
            <html>
                <head>
                    
                </head>
                <body>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr><td border="0" align="center" width="600"><h4>FUNCION&Aacute;RIOS EM FORMA&Ccedil;&Atilde;O</h4></td></tr>
                    </table>
                    <br>
                </div>
                <div width="100%">
                    <table align="center" border="1" cellpadding="0" cellspacing="0" style="overflow:hidden;">
                        <H6><tr bgcolor="gray">
                                <td width="350">Nome</td>
                                <td>BI</td>
                                <td>Ano Inicio/Fim</td>    
                                <td width="300">Curso/Op&ccedil;&atilde;o</td>
                                <td width="200">Universidade/Bolsa</td>
                                <td>Pais/Cidade</td>
                            </tr>
                        '.$listaFormacoes.'
                        </H6>
                    </table>
                    <br>
                </div>
                <div>
                    <br>
                    <table align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"><p><b>_________________________</b></p></td>
                        </tr>    
                        <tr>
                            <td width="300" height="20" align="left"><p>Funcion&aacute;rio:</p></td>
                        </tr>
                    </table>
                </div>
                </body>
            </html>
        ';
        //Recogemos el contenido de la vista
	/*ob_start(); 
	require_once '../teste1.html';
	$html = ob_get_clean();
        */
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Em_Formacao_Funcionarios.pdf','F');
        echo "true";
    }    
  }
