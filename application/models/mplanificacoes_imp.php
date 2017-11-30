<?php
  class Mplanificacoes_imp extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($s)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('L','A4','pt','true','UTF-8');
        
        //DADOS GERAIS
        $pactividade = "";
        $pdescricao = "";
        $psupervisor = "";
        $pdatainicio = "";
        $pdatafim = "";
        $presposta = "";
        $pestado = "";
        $ord = "";
        $alAno = "";
        $fnome = "";
        $fnomes = "";
        $fapelido = "";

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
        
        $this->load->model('mplanificacoes');
		$Total_Record = count($this->mplanificacoes->msearch($s));
        foreach ($this->mplanificacoes->msearch($s) as $value) {
            $pactividade = $value['pactividade'];
            $pdescricao = $value['pdescricao'];
            $psupervisor = $value['psupervisor'];
            $pdatainicio = $value['pdatainicio'];
            $pdatafim = $value['pdatafim'];
            $presposta = $value['presposta'];
            $pestado = $value['pestado'];
            $ord = $value['ord'];
            $alAno = $value['alAno'];
            $fnome = $value['fnome'];
            $fnomes = $value['fnomes'];
            $fapelido = $value['fapelido'];

            $contador++;
            if($contador <= 20){
                $listaInscricao = $listaInscricao.'<tr> <td align="center">'.$ord.'</td> 
                                                        <td align="left">'.$alAno.'</td> 
                                                        <td align="left" width="100">'.$pactividade.'</td> 
                                                        <td align="left" width="180">'.$psupervisor.'</td>
                                                        <td align="left" width="180">'.$fnome.' '.$fapelido.'</td>
                                                        <td align="left">'.$pdatainicio.'</td>
                                                        <td align="left">'.$pdatafim.'</td>
                                                        <td align="left" width="200">'.$pdescricao.'</td>
                                                        <td align="left" width="100">'.$presposta.'</td>
                                                        <td align="left">'.$pestado.'</td>
                                                   </tr>';
            }else{
                $listaInscricao2 = $listaInscricao2.'<tr> <td align="center">'.$ord.'</td> 
                                                        <td align="left">'.$alAno.'</td> 
                                                        <td align="left" width="100">'.$pactividade.'</td> 
                                                        <td align="left" width="180">'.$psupervisor.'</td>
                                                        <td align="left" width="180">'.$fnome.' '.$fapelido.'</td>
                                                        <td align="left">'.$pdatainicio.'</td>
                                                        <td align="left">'.$pdatafim.'</td>
                                                        <td align="left" width="200">'.$pdescricao.'</td>
                                                        <td align="left" width="100">'.$presposta.'</td>
                                                        <td align="left">'.$pestado.'</td>
                                                </tr>';
            }
            
            
            //$contador++;
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <h4>Planificações</h4>
                    <p align="left"><b>Pesquisa:</b></p>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr> <td width="30" align="center">Nº</td> 
                             <td align="center" width="30"><b>Ano</b></td> 
                             <td align="center" width="100"><b>Actividade</b></td> 
                             <td align="center" width="180"><b>Supervisor</b></td> 
                             <td align="center" width="180"><b>Chefe Dpto.</b></td>
                             <td align="center" width="70"><b>Inicio</b></td>
                             <td align="center" width="70"><b>Fim</b></td>
                             <td align="center" width="200"><b>Descrição</b></td>
                             <td align="center" width="100"><b>Resposta</b></td>
                             <td align="center" width="50"><b>Estado</b></td>
                        </tr>
                        '.$listaInscricao.'
                    </table>
                </div>

            </page>
        ';
        if($Total_Record <= 7){
            $content = $content.'
                <div>
                    <br>
                    <table align="left" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><p>Director Geral: </p></td>
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

        if($contador > 7){
            $content = $content.'<page>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr>    
                        <td width="30" align="center">Nº</td> 
                        <td align="center" width="30"><b>Ano</b></td> 
                        <td align="center" width="100"><b>Actividade</b></td> 
                        <td align="center" width="180"><b>Supervisor</b></td> 
                        <td align="center" width="180"><b>Chefe Dpto.</b></td>
                        <td align="center" width="70"><b>Inicio</b></td>
                        <td align="center" width="70"><b>Fim</b></td>
                        <td align="center" width="200"><b>Descrição</b></td>
                        <td align="center" width="100"><b>Resposta</b></td>
                        <td align="center" width="50"><b>Estado</b></td>
                        </tr>
                        '.$listaInscricao2.'
                    </table>
                    <br>
                </div>
                
                <div>
                    <br>
                    <table align="left" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><p>Director Geral</p></td>
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
        $this->hpdf->Output('relatorios/planificacoes.pdf','F');
        echo '[{"success":"true"}]';
    }       
  }
