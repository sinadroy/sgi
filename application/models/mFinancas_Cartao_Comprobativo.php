<?php
  class MFinancas_Cartao_Comprobativo extends CI_Model{
    
    var $hpdf = '';

    public function criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id)
    {
        $Candidatos_id = $id;
        //registrar registrar_pagamento_inscricao
        $data = date('Y')."-".date("m").'-'.date("d");
        $hoy = getdate();
        $fpcHora = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        //utilizador id
        $this->load->model('mutilizadores');
        $this->load->model('mestudantes');
        $eid = $this->mestudantes->get_idXcandidatos_id($Candidatos_id);
        $uid = $this->mutilizadores->mreadXnome($utilizadores_id);

        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        //DADOS GERAIS
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $nNome = "";
        $cNome = "";
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

        $lista = "";

        //$contador = 1;
        $this->load->model('mEstudantes');
        $this->load->model('MFinancas_cartao');
        //$bi = $this->getBI($id);
        foreach ($this->MFinancas_cartao->mreadX_id($id) as $value) {
            $cNome = $value['cnome'];
            $cNomes = $value['cnomes'];
            $cApelido = $value['capelido'];
            $cBI_Passaporte = $value['cbi_passaporte'];
            $nNome = $value['nNome'];
            $curso = $value['curso'];
            $pNome = $value['pNome'];
            $fc_data = $value['fc_data'];
            $fc_hora = $value['fc_hora'];
            $fc_ref_pag = $value['fc_ref_pag'];
            $fc_valor = $value['fc_valor'];
            $ffpNome = $value['ffpNome'];
            $contNumero = $value['contNumero'];
            $alAno = $value['alAno'];
            //$contador++;
            $lista = $lista.'
                <tr><td align="left">'.$nNome.'</td> <td align="left">'.$curso.'</td><td>'.$pNome.'</td><td>'.$fc_valor.',00 Kz</td></tr>
            ';
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h3>Finan&ccedil;as Comprovativo de Cartão de Estudante</h3><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$cBI_Passaporte.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.date('Y').'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o</b></td></tr>
                        '.$lista.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$fc_valor.'</b></td></tr>
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
                        <tr ><td border="0" align="center" width="600"> <h3>Finan&ccedil;as Comprovativo de Cartão de Estudante</h3><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$cBI_Passaporte.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.date('Y').'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o</b></td></tr>
                        '.$lista.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$fc_valor.'</b></td></tr>
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
        $this->hpdf->Output('relatorios/Financas_Cartao_Comprovativo.pdf','F');
        echo "true";
    }       
  }
