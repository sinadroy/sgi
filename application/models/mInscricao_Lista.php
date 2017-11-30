<?php
  class MInscricao_Lista extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($n, $c, $p, $al ,$utilizador)
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
        $ord = "";

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
        $contador = 0;
        $this->load->model('mCandidatos');
        $Total_Record = count($this->mCandidatos->mreadXncp($n,$c,$p));
        foreach ($this->mCandidatos->mreadXncpal($n,$c,$p,$al) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $cEstado = $value['cEstado'];
            $alAno = $value['alAno'];
            $curso = $value['curso'];
            $nNome = $value['nNome'];
            $pNome = $value['pNome'];
            $ord = $value['ord'];
            $contador++;
            if($contador <= 40){
                $listaInscricao = $listaInscricao.'<tr> <td align="center">'.$ord.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="left">'.$cBI_Passaporte.'</td></tr>';
            }else{
                $listaInscricao2 = $listaInscricao2.'<tr> <td align="center">'.$ord.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="left">'.$cBI_Passaporte.'</td></tr>';
            }
            //$contador++;
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Lista de candidatos inscritos</h4><br> </td></tr>
                    </table>
                    <br>
                    <table border="0" align="left">
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td></tr>
                        <tr><td align="left"><b>Curso: </b>'.$curso.'</td></tr>
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                        <tr><td align="left"><b>Ano Lectivo: </b>'.$al.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td width="30" align="center">Nº</td> <td align="center" width="500"><b>Nome Completo</b></td> <td align="center" width="200"><b>BI/Passaporte</b></td></tr>
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
                        <tr> <td width="30" align="center">Nº</td> <td align="center" width="500"><b>Nome Completo</b></td> <td align="center" width="200"><b>BI/Passaporte</b></td></tr>
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
        $this->hpdf->Output('relatorios/Inscricao_Lista.pdf','F');
        echo "true";
    }       
  }
