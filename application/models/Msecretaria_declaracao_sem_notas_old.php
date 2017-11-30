<?php
  class Msecretaria_declaracao_sem_notas extends CI_Model{
    //cargar numero de la declaracao
    function mread(){
        $this->db->select('num_declaracao');
        $this->db->from('declaracao_sem_notas_num_declaracao');
        $consulta = $this->db->get();
        foreach($consulta->result() as $value) {
            return $value->num_declaracao;
        }
    }
    //actualizar numero de la declaracao
    function mupdate($num_declaracao){
        $dados = array('num_declaracao' => $num_declaracao);
        if($this->db->update('declaracao_sem_notas_num_declaracao', $dados, array('id' => 1))){
            return true;
        }else
            return false;
    }
    
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


        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <p font-size: 16pt; font-family: Arial; text-align: justify;><b>'.$logotipo_titulo.'</b></p>
                </div>
                <br>
                <div align="center">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr><td>Criado nos termos do Decreto Nº 7/09, de 12 de Maio</td></tr>
                            <tr><td>Telefone nº 241221962 Caixa Postal nº 2376</td></tr>
                            <tr><td>Mouzinho de Albuquerque. Bairro Académico/Huambo - Angola NIF: 721 1001160</td></tr>
                        </table>
                </div>
                <p>=================================================================================================</p>
                <br>
                <div>
                    <table align="center" border="0">
                        <tr ><td border="0" align="center" width="600"> <p style="font-size: 17pt; font-family: Arial;"><b>Declaração N.º '.$this->mread().'/'.date('Y').'</b></p> </td></tr>
                    </table>
                </div>
                <div align="left" width="400">
                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                        <tr><td  width="400"><p align="center" style="font-size: 12pt; font-family: Arial;">Visto <br> Director Geral Adjunto para Área Académica <br><br> <b>Afonso Vindassi Manuel</b></p></td></tr>
                    </table>
                </div>
                <div>
                    <p style="font-size: 14pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        <b>Afonso Vindassi Manuel,</b> Director Geral Adjunto para Área Académica do 
                        Instituto Superior de Ciências de Educação do Huambo. Declaro em 
                        cumprimento do despacho exarado em requerimento que fica arquivado 
                        nessa secretaria que, <b>'.$cnome.' '.$cnomes.' '.$capelido.',</b> '.$portador.' do documento 
                        de identificação N.º '.$cbi_passaporte.', passado pelo arquivo de identificação 
                        '.$artigo.' '.$cBI_Lugar_Emissao_Provincia_id.', em '.$cBI_Data_Emissao.'. Frequenta o '.$acnome.' Ano do Curso de 
                        '.$nnome.' em Ciências de Educação, Opção '.$curso.', Período '.$pnome.'.
                    </p>
                </div>
                <br>
                <div>
                    <p style="font-size: 14pt; font-family: Arial;text-align: justify; line-height: 150%;">
                        Esta declaração destina-se para efeitos: '.$mnome.'<br>
                        E por ser verdade, e me ter sido solicitada, mandei passar a presente 
                        Declaração que vai visada por mim Director Geral Adjunto para 
                        Área Académica e pelo Chefe de Departamento para os Assuntos Académicos 
                        e autenticada com carimbo a óleo em uso nesta Instituição de Ensino Superior. 
                    </p>
                </div>
                <div>
                    <p style="font-size: 14pt; font-family: Arial; text-align: justify; line-height: 150%;">
                        Departamento para os Assuntos Académico do Instituto Superior de Ciências de Educação do '.$logo_pie_firma.', aos '.date("d").' de '.$mes.' de '.date('Y').'.
                    </p>
                </div>
                <br>
                <br>
                <div align="center">
                    <table align="center">
                        <tr>
                            <td width="600" height="10" align="center"><b><p style="font-size: 12pt; font-family: Arial;">Chefe do Departamento para os Assuntos Académicos</p></b></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="center"><p><b>_________________________</b></p></td>
                        </tr>    
                        
                    </table>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/secretaria_declaracao_sem_nota.pdf','F');
        $this->mupdate($this->mread()+1);
        echo "true";
    }       
  }
