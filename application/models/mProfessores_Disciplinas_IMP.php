<?php

class MProfessores_Disciplinas_IMP extends CI_Model {

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

    public function criarPdf($al,$acNome) {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('L', 'A4', 'pt', 'true', 'UTF-8');

        $mes = $this->dtMes(date('m'));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        //formacao funcionarios
        $nNome = "";
        $cNome = "";
        $pNome = "";
        $tNome = "";
        $dNome = "";
        $dCodigo = "";
        $ProfessorP = "";
        $ProfessorA1 = "";
        $ProfessorA2 = "";
        $lista = "";

        foreach ($al as $value) {
            $nNome = $value['nNome'];
            $cNome = $value['cNome'];
            $pNome = $value['pNome'];
            $tNome = $value['tNome'];
            $dNome = $value['dNome'];
            $dCodigo = $value['dCodigo'];
            $ProfessorP = $value['ProfessorP'];
            $ProfessorA1 = $value['ProfessorA1'];
            $ProfessorA2 = $value['ProfessorA2'];

            $lista = $lista . '
                <tr>
                    <td align="left">' . $tNome . '</td>
                    <td align="left">' . $dNome . '</td>
                    <td align="left">' . $dCodigo . '</td>
                    <td align="left">' . $ProfessorP . '</td>
                    <td align="left">' . $ProfessorA1 . '</td>
                    <td align="left">' . $ProfessorA2 . '</td>
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
                        <tr><td border="0" align="center" width="600"><h4>PROFESSORES POR DISCIPLINAS</h4></td></tr>
                    </table>
                    <br>
                </div>
                <div align="left">
                    <h5>N&iacute;vel Acad&ecirc;mico: '.$nNome.', Curso: '.$cNome.', Periodo: '.$pNome.', Ano Curricular: '.$acNome.'</h5>
                </div>
                <div width="100%">
                    <table align="center" border="1" cellpadding="0" cellspacing="0" style="overflow:hidden;">
                        <H6><tr bgcolor="gray">
                                <td>Turma</td>
                                <td width="230">Disciplina</td>
                                <td>C&oacute;digo</td>
                                <td width="230">Professor Principal</td>    
                                <td width="230">Professor A1</td>
                                <td width="230">Professor A2</td>
                            </tr>
                        ' . $lista . '
                        </H6>
                    </table>
                    <br>
                </div>
                <div>
                    <br>
                    <table align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td><p><b>'.$logo_pie_firma.', ' . date("d") . ' de ' . $mes . ' de ' . date('Y') . '.</b></p></td>
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
        /* ob_start(); 
          require_once '../teste1.html';
          $html = ob_get_clean();
         */
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Professores_Disciplinas.pdf', 'F');
        echo "true";
    }

}
