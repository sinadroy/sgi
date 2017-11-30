<?php
  class Mfinancas_propinas_dividas_imp extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($al,$alt,$n,$c,$p,$ac,$t,$mid,$mt,$utilizador)
    {
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
        $acNome = "";
        $tNome = "";
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
        
        $this->load->model('mpagamentos_propina');
		$Total_Record = count($this->mpagamentos_propina->mread_dividas_turmas($al,$alt,$n,$c,$p,$ac,$t,$mid,$mt));
        foreach ($this->mpagamentos_propina->mread_dividas_turmas($al,$alt,$n,$c,$p,$ac,$t,$mid,$mt) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $nNome = $value['nNome'];
            $curso = $value['curso'];
            $pNome = $value['pNome'];
            $acNome = $value['acNome'];
            $tNome = $value['tNome'];
            $divida = $value['divida'];
            //$eEstado_Matricula = $value['eEstado_Matricula'];
            $ord = $value['ord'];
            //if($eEstado_Matricula != "Conf.Mat.Esp.Pag" && $eEstado_Matricula != "Mat.Esp.Pag"){
                $contador++;
                if($contador <= 40){
                    $listaInscricao = $listaInscricao.'<tr> <td align="center">'.$ord.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="left">'.$cBI_Passaporte.'</td> <td align="center">'.$divida.'</td></tr>';
                }else{
                    $listaInscricao2 = $listaInscricao2.'<tr> <td align="center">'.$ord.'</td> <td align="left">'.$cNome.' '.$cNomes.' '.$cApelido.'</td> <td align="left">'.$cBI_Passaporte.'</td> <td align="center">'.$divida.'</td></tr>';
                }
            //}
            
            //$contador++;
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Propinas: Lista de Estudantes com Dívidas</h4><br> </td></tr>
                    </table>
                    <br>
                    <table border="0" align="left">
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td></tr>
                        <tr><td align="left"><b>Curso: </b>'.$curso.'</td></tr>
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                        <tr><td align="left"><b>Ano Curricular: </b>'.$acNome.'</td></tr>
                        <tr><td align="left"><b>Turma: </b>'.$tNome.'</td></tr>
                        <tr><td align="left"><b>Mês: </b>'.$mt.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td width="30" align="center">Nº</td> <td align="center" width="470"><b>Nome Completo</b></td> <td align="center" width="150"><b>BI/Passaporte</b></td><td align="center" width="70"><b>Dívida</b></td></tr>
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
                        <tr> <td width="30" align="center">Nº</td> <td align="center" width="470"><b>Nome Completo</b></td> <td align="center" width="150"><b>BI/Passaporte</b></td><td align="center" width="70"><b>Dívida</b></td></tr>
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
        $this->hpdf->Output('relatorios/Lista_Est_Dividas_Propinas.pdf','F');
        echo "true";
    }       
  }
