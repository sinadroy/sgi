<?php
  class Mestatisticas_relatorios_imp extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($al,$n,$c,$p,$ac,$g)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('L','A4','pt','true','UTF-8');
        
        //DADOS GERAIS
        $ord = "";
        $id = "";
        $dnome = "";
        //matriculados
        $mas1 = "";
        $fem1 = "";
        $total1 = "";
        //Reprovados
        $mas2 = "";
        $fem2 = "";
        $total2 = "";
        //Aprovados
        $mas3 = "";
        $fem3 = "";
        $total3 = "";

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

        $lista = "";
        $lista2 = "";
        $contador = 0;
        $this->load->model('mestatisticas');
		
        $Total_Record = count($this->mestatisticas->mget_disciplinas_relatorio($al,$n,$c,$p,$ac,$g));
        foreach ($this->mestatisticas->mget_disciplinas_relatorio($al,$n,$c,$p,$ac,$g) as $value) {
            //$ord = $value['ord'];
            $ord = $value['ord'];
            $id = $value['id'];
            $dnome = $value['dnome'];
            //matriculados
            $mas1 = $value['mas1'];
            $fem1 = $value['fem1'];
            $total1 = $value['total1'];
            //Reprovados
            $mas2 = $value['mas2'];
            $fem2 = $value['fem2'];
            $total2 = $value['total2'];
            //Aprovados
            $mas3 = $value['mas3'];
            $fem3 = $value['fem3'];
            $total3 = $value['total3'];

            $contador++;
            if($contador <= 15){
                $lista = $lista.'<tr> 
                                    <td align="center">'.$ord.'</td> 
                                    <td align="left">'.$dnome.'</td>

                                    <td align="left">'.$mas1.'</td> 
                                    <td align="left">'.$fem1.'</td>
                                    <td align="left">'.$total1.'</td>

                                    <td align="left">'.$mas2.'</td> 
                                    <td align="left">'.$fem2.'</td>
                                    <td align="left">'.$total2.'</td>

                                    <td align="left">'.$mas3.'</td> 
                                    <td align="left">'.$fem3.'</td>
                                    <td align="left">'.$total3.'</td>
                                </tr>';
                }else{
                    $lista2 = $lista2.'<tr> 
                                        <td align="center">'.$ord.'</td> 
                                        <td align="left">'.$dnome.'</td>

                                        <td align="left">'.$mas1.'</td> 
                                        <td align="left">'.$fem1.'</td>
                                        <td align="left">'.$total1.'</td>

                                        <td align="left">'.$mas2.'</td> 
                                        <td align="left">'.$fem2.'</td>
                                        <td align="left">'.$total2.'</td>

                                        <td align="left">'.$mas3.'</td> 
                                        <td align="left">'.$fem3.'</td>
                                        <td align="left">'.$total3.'</td>
                                    </tr>';
                }
        }

        $this->load->model('mniveis');
        $nNome = $this->mniveis->getNome($n);
        $this->load->model('MAnos_Lectivos');
        $alAno = $this->MAnos_Lectivos->mreadX($al);
        $this->load->model('mcursos');
        $cNome = $this->mcursos->mGetNome($c);
        $this->load->model('mperiodos');
        $pNome = $this->mperiodos->mGetNome($p);
        $this->load->model('Mdisciplinas_geracao');
        $gNome = $this->Mdisciplinas_geracao->mGetNomeXid($g);
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Disciplinas Relatorio</h4><br> </td></tr>
                    </table>
                    <br>
                    <table border="0" align="left">
                        <tr><td align="left"><b>Ano Lectivo: </b>'.$alAno.'</td></tr>
                        <tr><td align="left"><b>N&iacute;vel: </b>'.$nNome.'</td></tr>
                        <tr><td align="left"><b>Curso: </b>'.$cNome.'</td></tr>
                        <tr><td align="left"><b>Per&iacute;odo: </b>'.$pNome.'</td></tr>
                        <tr><td align="left"><b>Ano Curricular: </b>'.$ac.'</td></tr>
                        <tr><td align="left"><b>Geração: </b>'.$gNome.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> 
                            <td colspan="2">Disciplinas</td> 
                            <td colspan="3">Nº Estudantes matriculados</td> 
                            <td colspan="3">Nº Estudantes Reprovados</td>
                            <td colspan="3">Nº Estudantes Aprovados</td>  
                        </tr>
                        <tr> 
                            <td align="center" width="30">Nº</td> 
                            <td align="center" width="400">Nome</td>

                            <td align="center">Mat.Masc.</td> 
                            <td align="center">Mat.Femi.</td>
                            <td align="center">Mat.Total</td>

                            <td align="center">Rep.Masc.</td> 
                            <td align="center">Rep.Femi.</td>
                            <td align="center">Rep.Total</td>

                            <td align="center">Apr.Masc.</td> 
                            <td align="center">Apr.Femi.</td>
                            <td align="center">Apr.Total</td>
                        </tr>
                        '.$lista.'
                    </table>
                    <br>
                </div>

            </page>
        ';
        if($Total_Record <= 15){
            $content = $content.'
                <div>
                    <br>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
            ';
        }

        if($contador > 15){
            $content = $content.'<page>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" width="30">Nº</td> 
                            <td align="center" width="400">Disciplina</td>

                            <td align="center">Mat.Masc.</td> 
                            <td align="center">Mat.Feme.</td>
                            <td align="center">Mat.Total</td>

                            <td align="center">Rep.Masc.</td> 
                            <td align="center">Rep.Feme.</td>
                            <td align="center">Rep.Total</td>

                            <td align="center">Apr.Masc.</td> 
                            <td align="center">Apr.Feme.</td>
                            <td align="center">Apr.Total</td>
                        </tr>
                        '.$lista2.'
                    </table>
                    <br>
                </div>
                
                <div>
                    <br>
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
        $this->hpdf->Output('relatorios/estatisticas_relatorio_disciplinas.pdf','F');
        echo "true";
    }       
  }
