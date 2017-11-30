<?php
  class MAcademica_Distribuicao_Candidatos_2S_IMP extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($a,$n,$c,$p,$t,$d,$h,$utilizador)
    {
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
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        $listaInscricao = "";
        $listaInscricao2 = "";
        $contador = 1;
        $this->load->model('MAcademica_Planificacao_Exame_Candidatos_2S');
        $Total_Record = count($this->MAcademica_Planificacao_Exame_Candidatos_2S->mread22($a,$n,$c,$p,$t,$d,$h));
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
            $orden = $value['orden'];
            $contador++;
            if($contador <= 40){
                $listaInscricao = $listaInscricao.'<tr> <td align="center" width="30">'.$orden.'</td> <td align="left" width="470">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td></tr>';
            }else
                $listaInscricao2 = $listaInscricao2.'<tr> <td align="center" width="30">'.$orden.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td></tr>';
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Listas: Distribui&ccedil;&atilde;o por Sala Exame de Acesso 2º Sess&atilde;o.</h4><br> </td></tr>
                    </table>
                    <br>
                    <table border="0" align="left">
                        <tr><td align="left"><b>Ano Lectivo: </b>'.$alAno.'</td> <td width="100"></td>  <td align="left"><b>Sala: </b>'.$atcNome.'</td></tr>
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td> <td width="100"></td> <td align="left"><b>Data: </b>'.$apeiData.'</td></tr>
                        <tr><td align="left"><b>Curso: </b>'.$curso.'</td> <td width="100"></td> <td align="left"><b>Hora: </b>'.$apeiHora.'</td></tr>
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td align="center" width="30"><b>Nº</b></td> <td align="center" width="470"><b>Nome Completo</b></td> <td  width="240"><b>BI/Passaporte</b></td></tr>
                        '.$listaInscricao.'
                    </table>
                    <br>
                </div>
            </page>
        ';
        if($Total_Record <= 40){
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
                        <tr> <td align="center" width="30"><b>Nº</b></td> <td align="center" width="470"><b>Nome Completo</b></td> <td  width="240"><b>BI/Passaporte</b></td></tr>
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
        $this->hpdf->Output('relatorios/Academica_Distribuicao_Candidatos_2S_IMP.pdf','F');
        echo "true";
    }       
  }
