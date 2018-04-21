<?php
  class Msecretaria_declaracao_com_notas_mestrado extends CI_Model{
    
    public function criarPdf($id,$eid,$cnome,$cnomes,$capelido,$cbi_passaporte,$cBI_Data_Emissao,$cBI_Lugar_Emissao_Provincia_id,
        $acnome,$nnome, $curso, $pnome, $mnome, $tipo_documentos_id)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8', array(15, 5, 15, 5));

        //converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

        //apagar documento pendiente
        $this->load->model('Mdocumentos_pendientes');
        //$this->Mdocumentos_pendientes->minsert($td,$eid);
        $this->Mdocumentos_pendientes->mdelete($tipo_documentos_id,$eid);

        //ver sexo del estudante
        $this->load->model('Mestudantes');
        $sexo = $this->Mestudantes->read_sexo($eid);
        $portador = 'portador';
        if($sexo == 'Femenino')
            $portador = 'portadora';
        elseif($sexo == 'Masculino')
            $portador = 'portador';
        
        //optener artigo da provincia
        $this->load->model('Mprovincias');
        $artigo = $this->Mprovincias->mget_artigo($cBI_Lugar_Emissao_Provincia_id);

        // get estudante number
        $num_univ = $this->Mestudantes->mread_numero_universitario($eid);

        //optener incremento e actualizarlo
        $this->load->model('Mdeclaracao_sem_notas_num_dec');
        $incremento = $this->Mdeclaracao_sem_notas_num_dec->mread_com_notas();
        $this->Mdeclaracao_sem_notas_num_dec->mupdate_com_notas($this->Mdeclaracao_sem_notas_num_dec->mread_com_notas()+1);

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        // cargar disciplinas notas de 1er ano
        $this->load->model('mniveis');
        $n = $this->mniveis->getID($nnome);
        $this->load->model('mcursos');
        $c = $this->mcursos->mGetID($curso);
        $this->load->model('mperiodos');
        $p = $this->mperiodos->mGetID($pnome);
        $this->load->model('mano_curricular');
        $ac = $this->mano_curricular->mGetID($acnome);
        
        $this->load->model('mpautas');
        $td_1 = '';
        $count_1 = count($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,1));
        $nota_1 = 0;
        $contador1 = 0;
        if($count_1 > 0) {
            foreach ($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,1) as $value) {
                // $nota_1 = ($value['especial'] > 0) ? $value['especial'] : ($value['recurso'] > 0) ? $value['recurso'] : $value['ef'];
                $nota_1 = $this->mpautas->mdeterminar_nota_final($value['d_geracao_id'],$value['ddNome'],$value['pp1'],$value['pp2'],$value['pp2'],$value['ef'],$value['recurso'],$value['especial']);
                $contador1 = $contador1 + $nota_1;
                $td_1 = $td_1.'<tr> <td>'.$value['dNome'].'</td> <td>'.$value['alAno'].'</td> <td>'.round($nota_1,1).'</td> </tr>';
            }
        }
        $td_2 = '';
        $count_2 = count($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,2));
        $nota_2 = 0;
        $contador2 = 0;
        if($count_2 > 0) {
            foreach ($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,2) as $value) {
                // $nota_2 = ($value['especial'] > 0) ? $value['especial'] : ($value['recurso'] > 0) ? $value['recurso'] : $value['ef'];
                $nota_2 = $this->mpautas->mdeterminar_nota_final($value['d_geracao_id'],$value['ddNome'],$value['pp1'],$value['pp2'],$value['pp2'],$value['ef'],$value['recurso'],$value['especial']);
                $contador2 = $contador2 + $nota_2;
                $td_2 = $td_2.'<tr> <td>'.$value['dNome'].'</td> <td>'.$value['alAno'].'</td> <td>'.round($nota_2,1).'</td> </tr>';
            }
        }
        $td_3 = '';
        $count_3 = count($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,3));
        $nota_3 = 0;
        $contador3 = 0;
        if($count_3 > 0) {
            foreach ($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,3) as $value) {
                // $nota_3 = ($value['especial'] > 0) ? $value['especial'] : ($value['recurso'] > 0) ? $value['recurso'] : $value['ef'];
                $nota_3 = $this->mpautas->mdeterminar_nota_final($value['d_geracao_id'],$value['ddNome'],$value['pp1'],$value['pp2'],$value['pp2'],$value['ef'],$value['recurso'],$value['especial']);
                $contador3 = $contador3 + $nota_3;
                $td_3 = $td_3.'<tr> <td>'.$value['dNome'].'</td> <td>'.$value['alAno'].'</td> <td>'.round($nota_3,1).'</td> </tr>';
            }
        }
        $td_4 = '';
        $count_4 = count($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,4));
        $nota_4 = 0;
        $contador4 = 0;
        if($count_4 > 0) {
            foreach ($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,4) as $value) {
                // $nota_4 = ($value['especial'] > 0) ? $value['especial'] : ($value['recurso'] > 0) ? $value['recurso'] : $value['ef'];
                $nota_4 = $this->mpautas->mdeterminar_nota_final($value['d_geracao_id'],$value['ddNome'],$value['pp1'],$value['pp2'],$value['pp2'],$value['ef'],$value['recurso'],$value['especial']);
                $contador4 = $contador4 + $nota_4;
                $td_4 = $td_4.'<tr> <td>'.$value['dNome'].'</td> <td>'.$value['alAno'].'</td> <td>'.round($nota_4,1).'</td> </tr>';
            }
        }
        $td_5 = '';
        $count_5 = count($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,5));
        $nota_5 = 0;
        $contador5 = 0;
        if($count_5 > 0) {
            foreach ($this->mpautas->mread_resultXncpac_est($n,$c,$p,$eid,5) as $value) {
                // $nota_5 = ($value['especial'] > 0) ? $value['especial'] : ($value['recurso'] > 0) ? $value['recurso'] : $value['ef'];
                $nota_5 = $this->mpautas->mdeterminar_nota_final($value['d_geracao_id'],$value['ddNome'],$value['pp1'],$value['pp2'],$value['pp2'],$value['ef'],$value['recurso'],$value['especial']);
                $contador5 = $contador5 + $nota_5;
                $td_5 = $td_5.'<tr> <td>'.$value['dNome'].'</td> <td>'.$value['alAno'].'</td> <td>'.round($nota_5,1).'</td> </tr>';
            }
        }

        $total_disc = $count_1 + $count_2 + $count_3 + $count_4 + $count_5;
        $total_notas = $contador1 + $contador2 + $contador3 + $contador4 + $contador5;
        $mf = $total_disc != 0 ? round($total_notas / $total_disc, 1) : 0;

        // contriur tablas de anos dinamicamente
        $table1 = '';
        if ($ac - 1 >= 1) {
            $table1 = $table1.'
            <table align="left" border="0.5" cellpadding="0" cellspacing="0">
                <tr style="background: #999;">
                    <td colspan=3 align="center">1º Ano</td>
                </tr>
                <tr style="background: #999;">
                    <td width="220">Designação</td> <td width="220">Ano</td> <td width="220">Nota</td>
                </tr>
                '.$td_1.'
            </table><br>';
        }
        $table2 = '';
        if ($ac - 1 >= 2) {
            $table2 = $table2.'
            <table align="left" border="0.5" cellpadding="0" cellspacing="0">
                <tr style="background: #999;">
                    <td colspan=3 align="center">2º Ano</td>
                </tr>
                <tr style="background: #999;">
                    <td width="220">Designação</td> <td width="220">Ano</td> <td width="220">Nota</td>
                </tr>
                '.$td_2.'
            </table><br>
            ';
        }
        $table3 = '';
        if ($ac - 1 >= 3) {
            $table3 = $table3.'
            <table align="left" border="0.5" cellpadding="0" cellspacing="0">
                <tr style="background: #999;">
                    <td colspan=3 align="center">3º Ano</td>
                </tr>
                <tr style="background: #999;">
                    <td width="220">Designação</td> <td width="220">Ano</td> <td width="220">Nota</td>
                </tr>
                '.$td_3.'
            </table><br>
            ';
        }
        $table4 = '';
        if ($ac - 1 >= 4) {
            $table4 = $table4.'
            <table align="left" border="0.5" cellpadding="0" cellspacing="0">
                <tr style="background: #999;">
                    <td colspan=3 align="center">4º Ano</td>
                </tr>
                <tr style="background: #999;">
                    <td width="220">Designação</td> <td width="220">Ano</td> <td width="220">Nota</td>
                </tr>
                '.$td_4.'
            </table><br>
            ';
        }
        $table5 = '';
        if ($ac - 1 >= 5) {
            $table5 = $table5.'
            <table align="left" border="0.5" cellpadding="0" cellspacing="0">
                <tr style="background: #999;">
                    <td colspan=3 align="center">5º Ano</td>
                </tr>
                <tr style="background: #999;">
                    <td width="220">Designação</td> <td width="220">Ano</td> <td width="220">Nota</td>
                </tr>
                '.$td_5.'
            </table><br>
            ';
        }

        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <p font-size: 16pt; font-family: Arial; text-align: justify;><b>'.$logotipo_titulo.'</b></p>
                </div>
                <br>
                <div align="center">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr><td>Criado nos termos do Decreto Nº 07/09, de 12 de Maio de 2012</td></tr>
                            <tr><td>Telefone nº 241221961 Caixa Postal nº 2376</td></tr>
                            <tr><td>Avenida Allioun Blondy Beye, Bairro Académico/Huambo - Angola NIF: 721 1001160</td></tr>
                        </table>
                </div>
                <p>=================================================================================================</p>
                <div>
                    <table align="center" border="0">
                        <tr ><td border="0" align="center" width="600"> <p style="font-size: 15pt; font-family: Arial;"><b>Declaração N.º '.$incremento.'/'.date('Y').'</b></p> </td></tr>
                    </table>
                </div>
				<br>
                <div align="left" width="400">
                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                        <tr><td  width="400"><p align="center" style="font-size: 10pt; font-family: Arial;">Visto <br><br> Director Geral Adjunto para Área Académica <br><br> <b>Afonso Vindassi Manuel</b></p></td></tr>
                    </table>
                </div>
				
                <div>
                    <p style="font-size: 12pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        <b>Afonso Vindassi Manuel,</b> Director Geral Adjunto para Área Académica do 
                        Instituto Superior de Ciências de Educação do Huambo. Declaro em cumprimento do despacho exarado 
                        em requerimento que fica arquivado nessa secretaria que, <b>'.$cnome.' '.$cnomes.' '.$capelido.',</b> 
                        '.$portador.' do documento de identificação N.º '.$cbi_passaporte.', passado pelo arquivo de identificação 
                        '.$artigo.' '.$cBI_Lugar_Emissao_Provincia_id.', em '.$cBI_Data_Emissao.', no curso de <b>Ciências de Educação</b>, 
                        opção de <b>'.$curso.'</b>, período <b>'.$pnome.'</b>, com número Universitário <b>'.$num_univ.'</b>, 
                        concluiu o ano curricular '.--$ac.' com a seguinte classificação:
                    </p>
                </div>
                <br>
                    '.$table1.'
                    '.$table2.'
                    '.$table3.'
                    '.$table4.'
                    '.$table5.'
                <div>
                    <p style="font-size: 12pt; font-family: Arial;text-align: justify; line-height: 150%;">
                        Média: '.$mf.' Valores
                    </p>   
                </div>
                <div>
                    <p style="font-size: 12pt; font-family: Arial;text-align: justify; line-height: 150%;">
                        Esta declaração destina-se para efeito de <b>'.$mnome.'</b> E por ser verdade, e 
                        me ter sido solicitada, mandei passar a presente declaração que vai assinada por 
                        mim Director Geral Adjunto para Área Académica e pelo Chefe de Departamento para 
                        os Assuntos Académicos e autenticada com carimbo a óleo em uso nesta Instituição 
                        de Ensino Superior. 
                    </p>
                </div>
                <div>
                    <p style="font-size: 12pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        Departamento para os Assuntos Académicos do Instituto Superior de Ciências de Educação do '.$logo_pie_firma.', no Huambo aos '.date("d").' de '.$mes.' de '.date('Y').'.
                    </p>
                </div>
                <br>
                <br>
                <div align="center">
                    <table align="center">
                        <tr>
                            <td width="600" height="10" align="center"><b><p style="font-size: 12pt; font-family: Arial;">O Chefe do Departamento para os Assuntos Académicos</p></b></td>
                        </tr>
						<br>
                        <tr>
                            <td width="300" height="10" align="center"><p><b>_________________________</b></p></td>
                        </tr>  
						<tr>
                            <td width="600" height="10" align="center"><b><p style="font-size: 12pt; font-family: Arial;">Frutuoso Sanjimba Sanjala Chacussanga</p></b></td>
                        </tr>						
                        
                    </table>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/secretaria_declaracao_com_nota_mestrado.pdf','F');
        echo "true";
    }       
  }
