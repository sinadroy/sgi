<?php
  class Msecretaria_declaracao_sem_notas_mestrado extends CI_Model{
    
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

        //optener incremento e actualizarlo
        $this->load->model('Mdeclaracao_sem_notas_num_dec');
        $incremento = $this->Mdeclaracao_sem_notas_num_dec->mread();
        $this->Mdeclaracao_sem_notas_num_dec->mupdate($this->Mdeclaracao_sem_notas_num_dec->mread()+1);


        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        //get id curso
        $this->load->model('mcursos');
        $c_id = $this->mcursos->mGetID($curso);
        //get id niveis
        $this->load->model('mniveis');
        $n_id = $this->mniveis->getID($nnome);

        $this->load->model('Mdeclaracao_mestrado_configuracao');
        $titulo_visto = $this->Mdeclaracao_mestrado_configuracao->mread_titulo_visto($n_id,$c_id);
        $nome_visto = $this->Mdeclaracao_mestrado_configuracao->mread_nome_visto($n_id,$c_id);
        $nome_asignatura = $this->Mdeclaracao_mestrado_configuracao->mread_nome_asignatura($n_id,$c_id);

        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <p font-size: 14pt; font-family: Arial; text-align: justify;><b>'.$logotipo_titulo.'</b></p>
                </div>
                <br>
                <div align="center">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr><td>Criado nos termos do Decreto Nº 7/09, de 12 de Maio</td></tr>
                            <tr><td>Telefone nº 241221962 Caixa Postal nº 2376</td></tr>
                            <tr><td>Avenida Allioun Blondy Boye. Bairro Académico/Huambo - Angola NIF: 721 1001160</td></tr>
                        </table>
                </div>
                <p>======================================================================================</p>
				<div>
                    <table align="center" border="0">
                        <tr ><td border="0" align="center" width="600"> <p style="font-size: 15pt; font-family: Arial;"><b>COORDENAÇÃO DO CURSO DE MESTRADO</b></p> </td></tr>
                    </table>
                </div>
                <div>
                    <table align="center" border="0">
                        <tr ><td border="0" align="center" width="600"> <p style="font-size: 15pt; font-family: Arial;"><b>Informação Académica Nº '.$incremento.'/'.date('Y').'</b></p> </td></tr>
                    </table>
                </div>
				<br>
				<div align="left" width="400">
                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                        <tr><td  width="400"><p align="center" style="font-size: 10pt; font-family: Arial;">Visto <br> Director Geral<br> <br> <br><b>Mário José da Costa Rodrigues</b></p></td></tr>
                    </table>
                </div>
                <br>
                <div>
                    <p style="font-size: 12pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        <b>Mário José da Costa Rodrigues,</b> Director Geral do Instituto Superior de 
                        Ciências de Educação do Huambo. <br>Declaro em cumprimento do despacho exarado em 
                        requerimento que fica arquivado nessa secretaria que, <b>'.$cnome.' '.$cnomes.' 
                        '.$capelido.',</b> '.$portador.' do documento de identificação nº '.$cbi_passaporte.', 
                        passado pelo arquivo de identificação '.$artigo.' '.$cBI_Lugar_Emissao_Provincia_id.', 
                        em '.$cBI_Data_Emissao.'. <br><b>Frequenta o '.$acnome.' Ano do Curso de '.$curso.' no Ano Lectivo de '.date('Y').'</b>.
                    </p>
                </div>
                <br>
                <div>
                    <p style="font-size: 12pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        Esta informação destina-se para efeito de <b> '.$mnome.'</b><br>
                        E por ser verdade, e me ter sido solicitada, mandei passar a presente 
                        Informação que vai visada por mim Director Geral e pelo(a) Coordenador(a) do Curso 
                        e autenticada com carimbo a óleo em uso nesta Instituição de Ensino Superior.
                    </p>
                </div>
                <div>
                    <p style="font-size: 12pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        Coordenação do Curso de Mestrado em Ciências de Educação do Instituto Superior de Ciências de Educação do Educação do Huambo, no Huambo aos '.date("d").' de '.$mes.' de '.date('Y').'.
                    </p>
                </div>
                <br>
                <br>
                <div align="center">
                    <table align="center">
                        <tr>
                            <td width="600" height="10" align="center"><b><p style="font-size: 12pt; font-family: Arial;">O(A) Coordenador(a) do Curso</p></b></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="center"><p><b>______________________________</b></p></td>
                            
                        </tr>    
                        <tr>
                            <td width="300" height="10" align="center"><p style="font-size: 12pt; font-family: Arial;"><b>Maria Emilia Pepeka</b></p></td>
                        </tr>
                    </table>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/secretaria_declaracao_sem_nota_mestrado.pdf','F');
        echo "true";
    }       
  }
