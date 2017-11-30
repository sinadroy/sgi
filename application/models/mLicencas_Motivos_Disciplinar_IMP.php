<?php
  class MLicencas_Motivos_Disciplinar_IMP extends CI_Model{
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
    
      public function criarPdf($fid)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        
        $mes = $this->dtMes(date('m'));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();
        
        //formacao funcionarios
        $this->load->model('mFuncionarios'); 
        $fNome = $this->mFuncionarios->mreadNomeXID($fid);
        $fNomes = $this->mFuncionarios->mreadNomesXID($fid);
        $fApelido = $this->mFuncionarios->mreadApelidoXID($fid);
        //$fBI_Passaporte = "";

        $this->load->model('mLicencas'); 
        $total_dias = $this->mLicencas->mCalcular_Total_Dias($fid);
        $tatal_dias_texto = "";
        $data_inicio = $this->mLicencas->mGet_Data_Inicio($fid);
        $data_fin = $this->mLicencas->mGet_Data_Fin($fid);
        $ano_lectivo = date('Y');
        $this->load->model('MCategoriaFuncionarios');
        $categoria_funcionario = $this->MCategoriaFuncionarios->mGet_Categoria($fid);
        
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
                    <br>
                    <br>
                    <table align="center" border="1">
                        <tr><td border="0" align="center" width="600"><h4>DEPARTAMENTO DE RECURSOS HUMANOS</h4></td></tr>
                    </table>
                    <br>
                </div>
                <div>
                    <table align="center" border="0">
                        <tr><td border="0" align="center" width="600"><h4><b>Guia de Licen&ccedil;a Disciplinar nº ___/ISCED-HBO/'.$ano_lectivo.'.</b></h4></td></tr>
                    </table>
                    <br>
                </div>
                <div>
                    <table align="center" border="0">
                        <tr>
                        <td width="600">
                        <h4><p>
                            Para os devidos efeitos, faz-se saber que est&aacute; em gozo de
                            '.$total_dias.' dias de licen&ccedil;a disciplinar a partir do dia 
                            '.$data_inicio.' referente ao ano '.$ano_lectivo.', 
                            Sr(a) '.$fNome.' '.$fNomes.' '.$fApelido.', funcion&aacute;rio
                            desta institui&ccedil;&atilde;o com a categoria de '.$categoria_funcionario.'.
                            <br>
                            <br>
                            O trabalhador em causa dever&aacute; apresentar-se ao local de
                            trabalho dia '.$data_fin.'.
                            <br>
                            <br>
                        </p></h4>
                        </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table align="center" width="600" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td align="center"><p><b>Huambo, '.date("d").' de '.$mes.' de '.date('Y').'.</b></p></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <br>
                    <table align="center" width="600" border="0" cellpadding="0" cellspacing="0">
                        
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
                            <td width="300" height="20" align="center"><p>O Secretario Geral:<br></p></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="center"><p><b>_________________________</b></p></td>
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
        $this->hpdf->Output('relatorios/mLicencas_Motivos_Disciplinar_IMP.pdf','F');
        echo "true";
    }    
  }
