<?php
  class Mpautas_professores_imp extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($al,$n,$c,$p,$d,$idd)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('L','A4','pt','true','UTF-8');
        
        //converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

        //
        $this->load->model('mdisciplinas');
        $ac = $this->mdisciplinas->mread_ano_curricular_X_idd($idd);

        //
        $this->load->model('mdisciplinas_geracao');
        $g = $this->mdisciplinas_geracao->mget_dgnome($idd);

        //
        $this->load->model('mProfessores_Disciplinas');
        $professor = $this->mProfessores_Disciplinas->mread_ProfXDisc($idd);

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        //
        //ver duracao disciplina
		$this->load->model('Mdisciplinas_Duracao');
        $td = $this->Mdisciplinas_Duracao->mGetDuracao_DisciplinaXid($idd);
        //ver geracao de la disciplina
        $this->load->model('Mdisciplinas_geracao');
        $d_geracao_id = $this->Mdisciplinas_geracao->mGetGeracaoXidd($idd);
        //porciento ef
        $this->load->model('mpautas_configuracao');
        $pc_pp1 = $this->mpautas_configuracao->mGet_Porcento_pp1($d_geracao_id, $td);
		$pc_pp2 = $this->mpautas_configuracao->mGet_Porcento_pp2($d_geracao_id, $td);
		$pc_pp3 = $this->mpautas_configuracao->mGet_Porcento_pp3($d_geracao_id, $td);
		$pc_ef = $this->mpautas_configuracao->mGet_Porcento_ef($d_geracao_id, $td);

        $lista = "";
        $lista2 = "";
        $contador = 0;
        $this->load->model('mpautas');
        foreach ($this->mpautas->mreadXdisciplina_login_pautas($n,$c,$p,$al,$idd) as $value) {

            //mp
            if($td == "Anual")
                $mp = ($value->pp1 + $value->pp2 + $value->pp3)/3;
            elseif($td == "Semestral")
                $mp = ($value->pp1+$value->pp2)/2;
            
            $parte_pp1 = $this->mpautas->calcula_porciento($value->pp1, $pc_pp1);
		    $parte_pp2 = $this->mpautas->calcula_porciento($value->pp2, $pc_pp2);
		    $parte_pp3 = $this->mpautas->calcula_porciento($value->pp3, $pc_pp3);
		    $pc60 = $parte_pp1+$parte_pp2+$parte_pp3;
            //mf
            $parte_ef = $this->mpautas->calcula_porciento($value->ef, $pc_ef);
		    $mf = $pc60 + $parte_ef;

            $id = $value->id;
            $orden = $contador+1;
            $cNome = $value->cNome;
            $cApelido = $value->cApelido;
            $cBI_Passaporte = $value->cBI_Passaporte;
            $pp1 = round($value->pp1,1);
            $pp2 = round($value->pp2,1);
            $pp3 = round($value->pp3,1);
            $media = round($mp,0);
            $ef = round($value->ef,1);
            $media_total = round($mf,0);
            $recurso = round($value->recurso,1);
            $especial = round($value->especial,1);
            $estado = $value->estado;
            $cod = $value->dCodigo;

            $contador++;
            if($contador <= 25){
                $lista = $lista.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$pp1.'</td> <td align="center">'.$pp2.'</td> <td align="center">'.$pp3.'</td> <td align="center">'.$media.'</td> <td align="center">'.$ef.'</td> <td align="center">'.$media_total.'</td> <td align="center">'.$recurso.'</td> <td align="center">'.$especial.'</td> <td align="center">'.$estado.'</td></tr>';
            }else
                $lista2 = $lista2.'<tr> <td align="center">'.$orden.'</td> <td align="left">'.$cNome.' '.$cApelido.'</td> <td align="center">'.$cBI_Passaporte.'</td> <td align="center">'.$pp1.'</td> <td align="center">'.$pp2.'</td> <td align="center">'.$pp3.'</td> <td align="center">'.$media.'</td> <td align="center">'.$ef.'</td> <td align="center">'.$media_total.'</td> <td align="center">'.$recurso.'</td> <td align="center">'.$especial.'</td> <td align="center">'.$estado.'</td></tr>';
            
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                  <!--  <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h3>Listas: Resultados Exame de Acesso.</h3><br> </td></tr>
                    </table>
                    <br> 
                    -->
                    <table border="0" align="left">
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$n.'</td>   <td width="20"></td>  <td align="left"><b>Disciplina: </b>'.$d.'</td>   <td width="20"></td>    <td align="left"><b>Ano Lectivo: </b>'.$al.'</td>  </tr>
                        <tr><td align="left"><b>Curso: </b>'.$c.'</td>          <td width="20"></td>  <td align="left"><b>Código: </b>'.$cod.'</td>     <td width="20"></td>    <td align="left"><b>Ano Curricular: </b>'.$ac.'</td> </tr>    
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$p.'</td> <td width="20"></td>    <td align="left"><b>Geração: </b>'.$g.'</td>    <td width="20"></td>    </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td align="center" width="30">Nº</td> <td align="left" width="360"><b>Nome Completo</b></td> <td width="130" align="center"><b>BI/Passaporte</b></td> <td  width="45" align="center"><b>1PP</b></td> <td  width="45" align="center"><b>2PP</b></td> <td  width="45" align="center"><b>3PP</b></td> <td  width="50" align="center"><b>Media</b></td> <td  width="50" align="center"><b>Exame</b></td> <td  width="55" align="center"><b>Media F</b></td> <td  width="55" align="center"><b>Recurso</b></td> <td  width="50" align="center"><b>Outra</b></td> <td  width="85" align="center"><b>Resultado</b></td> </tr>
                        '.$lista.'
                    </table>
                    <br>
                </div>
            
        ';
        if($contador <= 25){
            $content = $content.'
                <div>
                    <br>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left" width="300"><p><b>Professor: '.$professor.'</b></p> </td> <td align="right" width="750"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
                </page>
            ';
        }else{
            $content = $content.'</page>';
        }

        if($contador > 25){
            $content = $content.'
            <page>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td align="center" width="30">Nº</td> <td align="left" width="360"><b>Nome Completo</b></td> <td width="130" align="center"><b>BI/Passaporte</b></td> <td  width="45" align="center"><b>1PP</b></td> <td  width="45" align="center"><b>2PP</b></td> <td  width="45" align="center"><b>3PP</b></td> <td  width="50" align="center"><b>Media</b></td> <td  width="50" align="center"><b>Exame</b></td> <td  width="55" align="center"><b>Media F</b></td> <td  width="55" align="center"><b>Recurso</b></td> <td  width="50" align="center"><b>Outra</b></td> <td  width="85" align="center"><b>Resultado</b></td> </tr>
                        '.$lista2.'
                    </table>
                    <br>
                </div>
                
                <div>
                    <br>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left" width="300"><p><b>Professor: '.$professor.'</b></p> </td> <td align="right" width="750"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
            </page>';
        }
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/pauta_professor.pdf','F');
        echo "true";
    }       
  }
