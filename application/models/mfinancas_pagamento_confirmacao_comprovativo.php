<?php
  class Mfinancas_pagamento_confirmacao_comprovativo extends CI_Model{
    
    var $hpdf = '';
    
    public function criarPdf($id,$total_pagar,$utilizadores_id,$fpdrefpagamento,$Estudantes_id,$semestres_id,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$bi,$cnome)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        
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

        $listaDT = "";

        //registrar registrar_pagamento_inscricao
        $data = date('Y')."-".date("m").'-'.date("d");
        $hoy = getdate();
        $fpcHora = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        $this->load->model('MFinancas_Tipo_Pagamento');
        $ftpNome = $this->MFinancas_Tipo_Pagamento->mreadXtipo("Confirmação Matrícula");
      
        $this->load->model('mestudantes');
        $nNome = $this->mestudantes->mget_nivel_bi($bi);
        $curso = $this->mestudantes->mget_curso_bi($bi);
        $pNome = $this->mestudantes->mget_periodo_bi($bi);
        $ncPreco_Confirmacao = $this->mestudantes->mget_precio_conf_mat_bi($bi);
        $ac = $this->mestudantes->mreadXano_curricular($Estudantes_id);

        $listaDT = $listaDT.'
                <tr><td align="left">'.$nNome.'</td> <td align="left">'.$curso.'</td><td>'.$pNome.'</td><td>'.$ncPreco_Confirmacao.',00 Kz</td></tr>
            ';
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h4>Finan&ccedil;as Comprovativo de Confirma&ccedil;&atilde;o</h4><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cnome.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$bi.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.date('Y').'</td> </tr>
                        <tr> <td border="0" align="left">Ano Curricular: '.$ac.'</td> </tr>
                        <tr> <td border="0" align="left">Semestre: '.$semestres_id.'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaDT.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$total_pagar.'</b></td></tr>
                    </table>
                    <br>
                </div>
                
                <div>
                    <table>
                        <tr ><td border="0" align="left"> Funcionario: '.$utilizadores_id.'</td></tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                    <br>
                </div>
                <div>
                <p>================================================================================================</p>
                </div>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h3>Finan&ccedil;as Comprovativo de Confirma&ccedil;&atilde;o</h3><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cnome.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$bi.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.date('Y').'</td> </tr>
                        <tr> <td border="0" align="left">Ano Curricular: '.$ac.'</td> </tr>
                        <tr> <td border="0" align="left">Semestre: '.$semestres_id.'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaDT.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$total_pagar.'</b></td></tr>
                    </table>
                    <br>
                </div>
              
                <div>
                    <table>
                        <tr ><td border="0" align="left"> Funcionario: '.$utilizadores_id.'</td></tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                    <br>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Financas_Confirmacao_Comprovativo.pdf','F');
        echo "true";
    }       
  }
